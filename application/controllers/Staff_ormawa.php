<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_ormawa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Staff_ormawa');
    }

    public function staff_ormawa()
    {
        $data['title'] = 'Manajemen staff ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/user_staff_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function showAllStaffOrmawa()
    {
        $result = $this->M_Staff_ormawa->showAllStaffOrmawa();
        echo json_encode($result);
    }

    public function editStaffOrmawa()
    {
        $result = $this->M_Staff_ormawa->editStaffOrmawa();
        echo json_encode($result);
    }

    public function deleteStaffOrmawa()
    {
        $result = $this->M_Staff_ormawa->deleteStaffOrmawa();
        echo json_encode($result);
    }
}
