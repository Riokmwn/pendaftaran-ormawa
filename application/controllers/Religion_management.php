<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Religion_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Religion');
    }

    // Religion Management
    public function user_religion()
    {
        $data['title'] = 'Manajemen agama';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/user_religion', $data);
        $this->load->view('templates/footer');
    }

    public function showAllReligion()
    {
        $result = $this->M_Religion->showAllReligion();
        echo json_encode($result);
    }

    public function addReligion()
    {
        $result = $this->M_Religion->addReligion();
        $msg['type'] = 'add';
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function editReligion()
    {
        $result = $this->M_Religion->editReligion();
        echo json_encode($result);
    }

    public function updateReligion()
    {
        $result = $this->M_Religion->updateReligion();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deleteReligion()
    {
        $result = $this->M_Religion->deleteReligion();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }
}
