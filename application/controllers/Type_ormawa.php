<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Type_ormawa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Type_ormawa');
    }

    // type document
    public function type_ormawa()
    {
        $data['title'] = 'Manajemen tipe ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/type_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function showAllTypeOrmawa()
    {
        $result = $this->M_Type_ormawa->showAllTypeOrmawa();
        echo json_encode($result);
    }

    public function addTypeOrmawa()
    {
        $result = $this->M_Type_ormawa->addTypeOrmawa();
        $msg['type'] = 'add';
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function editTypeOrmawa()
    {
        $result = $this->M_Type_ormawa->editTypeOrmawa();
        echo json_encode($result);
    }

    public function updateTypeOrmawa()
    {
        $result = $this->M_Type_ormawa->updateTypeOrmawa();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deleteTypeOrmawa()
    {
        $result = $this->M_Type_ormawa->deleteTypeOrmawa();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }
}
