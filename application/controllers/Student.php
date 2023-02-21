<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Student');
        $this->load->model('M_Member_ormawa');
        $this->load->model('M_Ormawa');
        $this->load->model('M_Prodi');
        $this->load->model('M_Gender');
        $this->load->model('M_Religion');
        $this->load->model('M_Document');
        $this->load->model('M_Type_document');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('student/index', $data);
        $this->load->view('templates/footer');
    }

    public function student_registration_status()
    {
        $data['title'] = 'Status pendaftaran anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('student/student_registration_status', $data);
        $this->load->view('templates/footer');
    }

    public function student_membership()
    {
        $data['title'] = 'Keanggotaan';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('student/student_membership', $data);
        $this->load->view('templates/footer');
    }

    public function showOrmawaByStudent($id_ormawa_student)
    {
        $result = $this->M_Member_ormawa->showOrmawaByStudent($id_ormawa_student);
        echo json_encode($result);
    }

    public function showOrmawaByMember()
    {
        $result = $this->M_Member_ormawa->showOrmawaByMember();
        echo json_encode($result);
    }

    public function showStudentByOrmawa($id_student_ormawa)
    {
        $result = $this->M_Student->showStudentByOrmawa($id_student_ormawa);
        echo json_encode($result);
    }

    public function showStudentByPeriod($id_period)
    {
        $result = $this->M_Student->showStudentByPeriod($id_period);
        echo json_encode($result);
    }

    // public function showOrmawa()
    // {
    //     $result = $this->M_Student->showOrmawaByStudent();
    //     echo json_encode($result);
    // }

    public function student_activity()
    {
        $data['title'] = 'Aktivitas ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('student/student_activity', $data);
        $this->load->view('templates/footer');
    }

    public function student_document()
    {
        $data['title'] = 'Dokumen';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['id'] = $data['user']['id'];
        $data['type_document'] = $this->M_Type_document->showAllTypeDocument();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('student/student_document', $data);
        $this->load->view('templates/footer');
    }

    // public function showDocumentByUser($id)
    // {
    //     $result = $this->M_Document->showDocumentByUser($id);
    //     echo json_encode($result);
    // }

    public function addDocument()
    {
        // $result = $this->M_Article->addArticle();
        // echo json_encode($result);

        $config['upload_path'] = "./assets/document/";
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("document")) {
            $data = array('upload_data' => $this->upload->data());

            $document = $data['upload_data']['file_name'];

            $result = $this->M_Document->addDocument($document);
            $msg['type'] = 'add';
            $msg['success'] = false;
            if ($result) {
                $msg['success'] = true;
            }

            echo json_encode($msg);
        } else {
            $msg['success'] = false;
        }
    }

    public function deleteDocument()
    {
        $result = $this->M_Document->deleteDocument();
        echo json_encode($result);
    }

    public function student_list_ormawa()
    {
        $data['title'] = 'Daftar Ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['hmps'] = $this->M_Ormawa->showHmpsByProdiReadyToRegister(substr($this->session->userdata('id'), 0, 3));
        $data['ukm'] = $this->M_Ormawa->showAllUkm();
        $data['ukk'] = $this->M_Ormawa->showAllUkk();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('student/student_list_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function student_registration_ormawa($id_ormawa)
    {
        $data['title'] = 'Pendaftaran calon anggota';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['gender'] = $this->M_Gender->showGenderById($data['user']['gender_id']);
        $data['religion'] = $this->M_Religion->showReligionById($data['user']['religion_id']);
        $data['document'] = $this->M_Document->showDocumentByStudent($data['user']['id']);
        $data['prodi'] = $this->M_Prodi->showStudentByProdi($data['user']['id']);
        $data['student'] = $this->M_Prodi->showStudentProdi($data['user']['id']);
        $data['ormawa'] = $this->M_Ormawa->showOrmawaById($id_ormawa);
        $data['id'] = $id_ormawa;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('student/student_registration_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function registration_student_to_ormawa($id)
    {
        $this->M_Student->registration_student_to_ormawa($id);
        redirect('student/student_list_ormawa');
    }

    public function showAllCandidateStatus()
    {
        $result = $this->M_Student->showAllCandidateStatus();
        echo json_encode($result);
    }

    public function edit()
    {
        $data['title'] = 'Ubah profil';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Ubah password';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/change_password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/change_password');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/change_password');
                }
            }
        }
    }
}
