<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ormawa_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Ormawa');
        $this->load->model('M_Student');
        $this->load->model('M_Prodi');
    }

    // Ormawa Management
    public function ormawa()
    {
        $data['title'] = 'Manajemen organisasi mahasiswa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['category'] = $this->db->get('type_ormawa')->result();
        $data['prodi'] = $this->M_Prodi->showAllProdi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function showAllOrmawa()
    {
        $result = $this->M_Ormawa->showAllOrmawa();
        echo json_encode($result);
    }

    public function showPeriodByOrmawa($id_period_ormawa)
    {
        $result = $this->M_Ormawa->showPeriodByOrmawa($id_period_ormawa);
        echo json_encode($result);
    }

    public function addOrmawa()
    {
        $result = $this->M_Ormawa->addOrmawa();
        $msg['type'] = 'add';
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function editOrmawa()
    {
        $result = $this->M_Ormawa->editOrmawa();
        echo json_encode($result);
    }

    public function updateOrmawa()
    {
        $result = $this->M_Ormawa->updateOrmawa();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deleteOrmawa()
    {
        $result = $this->M_Ormawa->deleteOrmawa();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }

    public function showStudentByOrmawa($id_student_ormawa)
    {
        $result = $this->M_Student->showStudentByOrmawa($id_student_ormawa);
        echo json_encode($result);
    }

    public function acceptRegistrationOrmawa($id)
    {
        $result = $this->M_Ormawa->acceptRegistrationOrmawa($id);
        redirect('document/ormawa_list_registration');
    }

    public function declineRegistrationOrmawa($id)
    {
        $result = $this->M_Ormawa->declineRegistrationOrmawa($id);
        redirect('document/ormawa_list_registration');
    }
}
