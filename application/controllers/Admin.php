<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        // $data['jumlahMahasiswa'] = $this->db->get('student')->num_rows();
        // $data['jumlahPka'] = $this->db->get('pka')->num_rows();
        // $data['jumlahOrmawa'] = $this->db->get_where('ormawa', ['type_ormawa_id !=' => 0])->num_rows();
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {
        $data['title'] = 'Hak Akses';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Hak Akses';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function mainConfig()
    {
        $data['title'] = 'Halaman utama';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['main_config'] = $this->db->get('main_config')->row_array();
        $data['information_config'] = $this->db->get('information_config')->row_array();

        $this->form_validation->set_rules('application_name', 'Application_name', 'required|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('title_2', 'Title_2', 'required|trim');
        $this->form_validation->set_rules('campus_name', 'Campus_name', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('description_2', 'Description_2', 'required|trim');

        $this->form_validation->set_rules('address', 'address', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim');
        $this->form_validation->set_rules('phone', 'phone', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/main_config', $data);
            $this->load->view('templates/footer');
        } else {
            $application_name = $this->input->post('application_name');
            $title = $this->input->post('title');
            $title_2 = $this->input->post('title_2');
            $campus_name = $this->input->post('campus_name');
            $description = $this->input->post('description');
            $description_2 = $this->input->post('description_2');
            $address = $this->input->post('address');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');

            // cek jika ada gambar yang akan diupload
            $upload_header = $_FILES['header']['name'];

            if ($upload_header) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '10240';
                $config['upload_path'] = './assets/img/header/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('header')) {
                    $old_image = $data['main_config']['header'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/header/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('header', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $upload_logo_campus = $_FILES['logo_campus']['name'];

            if ($upload_logo_campus) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '10240';
                $config['upload_path'] = './assets/img/logo_campus/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo_campus')) {
                    $old_image = $data['main_config']['logo_campus_main_config'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/logo_campus/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('logo_campus_main_config', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $upload_logo_application = $_FILES['logo_application']['name'];

            if ($upload_logo_application) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '10240';
                $config['upload_path'] = './assets/img/logo_application/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo_application')) {
                    $old_image = $data['main_config']['logo_application_main_config'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/logo_application/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('logo_application_main_config', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->db->set('application_name_main_config', $application_name);
            $this->db->set('title_main_config', $title);
            $this->db->set('title_2_main_config', $title_2);
            $this->db->set('campus_name_main_config', $campus_name);
            $this->db->set('description_main_config', $description);
            $this->db->set('description_2_main_config', $description_2);
            $this->db->where('id_main_config', 1);
            $this->db->update('main_config');


            $this->db->set('address_information_config', $address);
            $this->db->set('email_information_config', $email);
            $this->db->set('phone_information_config', $phone);
            $this->db->where('id_information_config', 1);
            $this->db->update('information_config');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('admin/mainConfig');
        }
    }
}
