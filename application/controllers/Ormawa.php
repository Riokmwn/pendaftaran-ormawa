<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ormawa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Ormawa');
        $this->load->model('M_Student');
        $this->load->model('M_Period');
        // $this->load->model('M_Prodi');
        $this->load->model('M_Document');
        $this->load->model('M_Type_document');
        $this->load->model('M_Member_ormawa');

        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        // $data['jumlahMahasiswa'] = $this->db->get('student')->num_rows();
        // $data['jumlahArticle'] = $this->db->get_where('article', ['author_id !=' => 1])->num_rows();
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/index', $data);
        $this->load->view('templates/footer');
    }

    //member ormawa
    public function member_ormawa()
    {
        $data['title'] = 'Anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        // $data['prodi'] = $this->M_Prodi->showAllProdi();
        $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id'),])->row_array();
        $data['ormawa_id'] = $data['member_ormawa']['ormawa_id'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/member_ormawa', $data);
        $this->load->view('templates/footer');
    }


    // Dashboard Submission For Student To Ormawa
    public function proses_and_accept_candidate()
    {
        $data['title'] = 'Calon anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/proses_and_accept_candidate', $data);
        $this->load->view('templates/footer');
    }

    // Submission By Student
    public function submission_member_ormawa()
    {
        $data['title'] = 'Pengajuan anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/submission_member_ormawa', $data);
        $this->load->view('templates/footer');
    }

    // Submission Student
    public function registration_member_ormawa()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
        // $data['status']=$this->db->get_where('registration_student_to_ormawa', ['status'])
        $result = $this->M_Student->showStudentRegistrationMemberOrmawa($data['member_ormawa']['ormawa_id']);
        echo json_encode($result);
    }

    // Accept Student
    public function accept_member_ormawa()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
        // $data['status']=$this->db->get_where('registration_student_to_ormawa', ['status'])
        $result = $this->M_Student->showStudentProsesMemberOrmawa($data['member_ormawa']['ormawa_id']);
        echo json_encode($result);
    }

    // public function candidate_member_ormawa($id_student)
    // {
    //     $data['title'] = 'Calon anggota ormawa';
    //     $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

    //     $data['mahasiswa'] = $this->M_Student->showStudentById($id_student);

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('ormawa/candidate_member_ormawa', $data);
    //     $this->load->view('templates/footer');
    // }


    // Student File's
    public function submission_candidate($id_student)
    {
        $data['title'] = 'Calon anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['mahasiswa'] = $this->M_Student->showStudentById($id_student);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/submission_candidate', $data);
        $this->load->view('templates/footer');
    }

    // Proccess Student
    public function add_proses_member($id = null)
    {
        $data['title'] = 'Pengajuan anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['id'] = $id;
        $data['id_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        $data['member'] = $this->M_Member_ormawa->submission_candidate($data['id_ormawa']['ormawa_id'], $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/add_proses_member', $data);
        $this->load->view('templates/footer');
    }

    public function add_candidate_to_proses()
    {   
       

        $value_input = array(
            'id_ormawa' => $this->input->post('id_ormawa'),
            'member' => $this->input->post('member')
        );
        
        $this->M_Member_ormawa->intoProsesCandidate($value_input);
        redirect('ormawa/submission_member_ormawa/' . $this->input->post('id_period'));
    }

    public function deleteCandidate()
    {
        $value_input = array(
            'id_ormawa' => $this->input->post('id_ormawa'),
            'member' => $this->input->post('member')
        );

        $result = $this->M_Member_ormawa->deleteCandidate($value_input);
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }
    // End Proccess 



    public function accept_candidate($id = null)
    {
        $data['title'] = 'Proses penerimaan anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['id'] = $id;
        $data['id_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        $data['member'] = $this->M_Member_ormawa->submission_candidate($data['id_ormawa']['ormawa_id'], $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/accept_candidate', $data);
        $this->load->view('templates/footer');
    }

    // Proccess Student
    public function add_student_to_member($id = null)
    {
        $data['title'] = 'Proses penerimaan anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['id'] = $id;
        $data['id_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        $data['member'] = $this->M_Member_ormawa->student_to_member($data['id_ormawa']['ormawa_id'], $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/add_student_to_member', $data);
        $this->load->view('templates/footer');
    }

    public function add_candidate_to_member()
    {
        $value_input = array(
            'id_ormawa' => $this->input->post('id_ormawa'),
            'member' => $this->input->post('member')
        );

        $this->M_Member_ormawa->intoProsesMember($value_input);
        redirect('ormawa/accept_candidate/' . $this->input->post('id_period'));
    }

    public function delete_candidate_to_member()
    {
        $value_input = array(
            'id_ormawa' => $this->input->post('id_ormawa'),
            'member' => $this->input->post('member')
        );

        $result = $this->M_Member_ormawa->delete_candidate_to_member($value_input);
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }
    // End Proccess

    public function sendRegistrationOrmawa($id)
    {
        $result = $this->M_Ormawa->sendRegistrationOrmawa($id);
        redirect('ormawa/');
    }


    public function add_member_ormawa()
    {
        $data['title'] = 'Calon anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/add_member_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function accept_member()
    {
        $data['title'] = 'Calon anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/accept_member', $data);
        $this->load->view('templates/footer');
    }



    //activity ormawa
    public function activity_ormawa()
    {
        $data['title'] = 'Aktivitas';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/activity_ormawa', $data);
        $this->load->view('templates/footer');
    }



    //homepage
    public function homepage_ormawa()
    {
        $data['title'] = 'Konfigurasi';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        $data['ormawa'] = $this->db->get_where('ormawa', ['id_ormawa' => $data['myOrmawa']['ormawa_id']])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('visi_mission', 'Vision_mission', 'required|trim');

        // var_dump($this->form_validation->run());
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ormawa/homepage_ormawa', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $visi_mission = $this->input->post('visi_mission');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '10240';
                $config['upload_path'] = './assets/img/header/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['ormawa']['image_ormawa'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/header/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image_ormawa', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $upload_structure = $_FILES['image_structure']['name'];

            if ($upload_structure) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '10240';
                $config['upload_path'] = './assets/img/structure/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image_structure')) {
                    $old_image = $data['ormawa']['organization_structure_ormawa'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/structure/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('organization_structure_ormawa', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $upload_logo = $_FILES['image_logo']['name'];

            if ($upload_logo) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '10240';
                $config['upload_path'] = './assets/img/logo_ormawa/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image_logo')) {
                    $old_image = $data['ormawa']['logo_ormawa'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/logo_ormawa/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('logo_ormawa', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->db->set('name_ormawa', $name);
            $this->db->set('description_ormawa', $description);
            $this->db->set('visi_mission_ormawa', $visi_mission);
            $this->db->where('id_ormawa', $data['myOrmawa']['ormawa_id']);
            $this->db->update('ormawa');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('ormawa/homepage_ormawa');
        }
    }

    public function content_homepage()
    {
        $data['title'] = 'Konten';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        $data['ormawa'] = $this->db->get_where('ormawa', ['id_ormawa' => $data['myOrmawa']['ormawa_id']])->row_array();
        $data['image'] = $this->db->get_where('content_homepage', ['ormawa_id' => $data['ormawa']['id_ormawa']])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/content_homepage', $data);
        $this->load->view('templates/footer');
    }

    public function showAllContentHomepageByOrmawa()
    {
        $result = $this->M_Ormawa->showAllContentHomepageByOrmawa();
        echo json_encode($result);
    }

    public function addContentHomepage()
    {
        $config['upload_path'] = "./assets/img/content/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("image")) {
            $data = array('upload_data' => $this->upload->data());

            $image = $data['upload_data']['file_name'];

            $result = $this->M_Ormawa->addContentHomepage($image);
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

    public function deleteContentHomepage()
    {
        $result = $this->M_Ormawa->deleteContentHomepage();
        echo json_encode($result);
    }


    //requirement
    public function add_requirement()
    {
        $data['title'] = 'Tambah persyaratan';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        $data['ormawa'] = $this->db->get_where('ormawa', ['id_ormawa' => $data['myOrmawa']['ormawa_id']])->row_array();

        $this->form_validation->set_rules('requirement', 'Requirement', 'required|trim');

        // var_dump($this->form_validation->run());
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ormawa/add_requirement', $data);
            $this->load->view('templates/footer');
        } else {
            $requirement = $this->input->post('requirement');

            $this->db->set('requirement_ormawa', $requirement);
            $this->db->where('id_ormawa', $data['myOrmawa']['ormawa_id']);
            $this->db->update('ormawa');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('ormawa/');
        }
    }



    //article
    public function post_new_article()
    {
        $data['title'] = 'Artikel';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/post_new_article', $data);
        $this->load->view('templates/footer');
    }



    // Periods
    public function period_ormawa($id = null)
    {
        $data['title'] = 'Periode dan anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['id_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        // var_dump($data['id_ormawa']['ormawa_id']);
        // die();
        $data['id'] = $id;

        if ($data['user']['role_id'] != 1) {
            $data['head'] = $this->M_Member_ormawa->showMemberOrmawaByOrmawaNoAdmin($data['id_ormawa']['ormawa_id']);
            $data['ormawa_id'] = $data['id_ormawa']['ormawa_id'];
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/period_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function showAllPeriod()
    {
        $result = $this->M_Period->showAllPeriod();
        echo json_encode($result);
    }

    public function showAllPeriodByOrmawa($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if ($data['user']['role_id'] == 1 || $data['user']['role_id'] == 2) {
            $id = $id;
        } else {
            $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
            $id = $data['member_ormawa']['ormawa_id'];
        }

        $result = $this->M_Period->showAllPeriodByOrmawa($id);
        echo json_encode($result);
    }

    public function periodHead()
    {
        $result = $this->M_Period->periodHead();
        echo json_encode($result);
    }

    public function addPeriod()
    {
        $result = $this->M_Period->addPeriod();
        echo json_encode($result);
    }

    public function editPeriod()
    {
        $result = $this->M_Period->editPeriod();
        echo json_encode($result);
    }

    public function updatePeriod()
    {
        $result = $this->M_Period->updatePeriod();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function deletePeriod()
    {
        $result = $this->M_Period->deletePeriod();
        echo json_encode($result);
    }



    // Member ormawa period
    public function member_ormawa_period($id = null)
    {
        $data['title'] = 'Periode dan anggota ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['id'] = $id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/member_ormawa_period', $data);
        $this->load->view('templates/footer');
    }

    public function add_to_member_ormawa()
    {
        $value_input = array(
            'id_ormawa' => $this->input->post('id_ormawa'),
            'id_period' => $this->input->post('id_period'),
            'member' => $this->input->post('member')
        );

        $this->M_Period->intoMemberOrmawa($value_input);
        redirect('ormawa/member_ormawa_period/' . $this->input->post('id_period'));
    }

    public function add_member_period_ormawa($id = null)
    {
        $data['title'] = 'Tambah Anggota Periode Ormawa';
        $data['id'] = $id;
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['id_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        $data['member'] = $this->M_Member_ormawa->showMemberOrmawaByOrmawaNoPeriod($data['id_ormawa']['ormawa_id'], $id);
        // echo "<pre>";
        // var_dump($data['id_ormawa']);
        // echo "</pre>";
        // die();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ormawa/add_member_period_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function showMemberByPeriod($member_period)
    {
        $result = $this->M_Period->showMemberByPeriod($member_period);
        // echo "<pre>";
        // var_dump($result);
        // echo "</pre>";
        // die();
        echo json_encode($result);
    }

    //show student by ormawa
    public function showMemberOrmawaByOrmawaNoAdmin($id_member_by_ormawa)
    {
        $result = $this->M_Member_ormawa->showMemberOrmawaByOrmawaNoAdmin($id_member_by_ormawa);
        echo json_encode($result);
    }

    public function editMember()
    {
        $result = $this->M_Student->editStudent();
        echo json_encode($result);
    }

    public function nonActiveMemberByOrmawa()
    {
        $result = $this->M_Student->nonActiveMemberByOrmawa();
        echo json_encode($result);
    }
}
