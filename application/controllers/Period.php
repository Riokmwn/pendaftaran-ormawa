<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Period extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Period');
    }

    // public function ormawa()
    // {
    //     $data['title'] = 'Manajemen organisasi mahasiswa';
    //     $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
    //     $data['category'] = $this->db->get('type_ormawa')->result();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('management/ormawa', $data);
    //     $this->load->view('templates/footer');
    // }

    public function showAllPeriod()
    {
        $result = $this->M_Period->showAllPeriod();
        echo json_encode($result);
    }
}
