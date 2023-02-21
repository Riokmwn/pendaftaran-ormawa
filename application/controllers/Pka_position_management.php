<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pka_position_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Position_pka');
    }

    // Pka Position Management
    public function pka_position()
    {
        $data['title'] = 'Manajemen jabatan PKA';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/pka_position', $data);
        $this->load->view('templates/footer');
    }

    public function showAllPositionPka()
    {
        $result = $this->M_Position_pka->showAllPositionPka();
        echo json_encode($result);
    }

    public function addPosition()
    {
        $result = $this->M_Position_pka->addPosition();
        $msg['type'] = 'add';
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function editPosition()
    {
        $result = $this->M_Position_pka->editPosition();
        echo json_encode($result);
    }

    public function updatePosition()
    {
        $result = $this->M_Position_pka->updatePosition();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deletePosition()
    {
        $result = $this->M_Position_pka->deletePosition();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }

    // public function showUserByPosition()
    // {
    //     $result = $this->M_Position_pka->showUserByPosition();
    //     echo json_encode($result);
    // }
}
