<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Type_document extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Type_document');
    }

    // type document
    public function type_document()
    {
        $data['title'] = 'Manajemen tipe dokumen';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/type_document', $data);
        $this->load->view('templates/footer');
    }

    public function showAllTypeDocument()
    {
        $result = $this->M_Type_document->showAllTypeDocument();
        echo json_encode($result);
    }

    //pemisah
    // public function showTypeDocument()
    // {
    //     $result = $this->M_Type_document->showAllTypeDocument();
    //     echo json_encode($result);
    // }

    public function addTypeDocument()
    {
        $result = $this->M_Type_document->addTypeDocument();
        $msg['type'] = 'add';
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function editTypeDocument()
    {
        $result = $this->M_Type_document->editTypeDocument();
        echo json_encode($result);
    }

    public function updateTypeDocument()
    {
        $result = $this->M_Type_document->updateTypeDocument();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deleteTypeDocument()
    {
        $result = $this->M_Type_document->deleteTypeDocument();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }
}
