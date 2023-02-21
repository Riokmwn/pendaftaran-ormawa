<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_gender_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Gender');
    }

    // User Gender Management
    public function user_gender()
    {
        $data['title'] = 'Manajemen jenis kelamin';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/user_gender', $data);
        $this->load->view('templates/footer');
    }

    public function showAllGender()
    {
        $result = $this->M_Gender->showAllGender();
        echo json_encode($result);
    }

    //pemisah

    // public function showAllGender()
    // {
    //     $result = $this->M_Gender->select_all();
    //     echo json_encode($result);
    // }

    public function addGender()
    {
        $result = $this->M_Gender->addGender();
        $msg['type'] = 'add';
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function editGender()
    {
        $result = $this->M_Gender->editGender();
        echo json_encode($result);
    }

    public function updateGender()
    {
        $result = $this->M_Gender->updateGender();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deleteGender()
    {
        $result = $this->M_Gender->deleteGender();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }
}
