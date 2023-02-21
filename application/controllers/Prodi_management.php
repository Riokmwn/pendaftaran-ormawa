<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Prodi');
        $this->load->model('M_Student');
    }

    // Prodi Management
    public function prodi()
    {
        $data['title'] = 'Manajemen program studi';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/prodi', $data);
        $this->load->view('templates/footer');
    }

    public function showAllProdi()
    {
        $result = $this->M_Prodi->showAllProdi();
        echo json_encode($result);
    }

    public function addProdi()
    {
        $result = $this->M_Prodi->addProdi();
        $msg['type'] = 'add';
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function editProdi()
    {
        $result = $this->M_Prodi->editProdi();
        echo json_encode($result);
    }

    public function updateProdi()
    {
        $result = $this->M_Prodi->updateProdi();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deleteProdi()
    {
        $result = $this->M_Prodi->deleteProdi();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }

    public function showStudentByProdi($id_prodi_student)
    {
        $result = $this->M_Prodi->showStudentByProdi($id_prodi_student);
        echo json_encode($result);
    }
}
