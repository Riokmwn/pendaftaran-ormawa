<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pka_user_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Pka');
    }

    // Pka User Management
    public function user_pka_position($id = null)
    {
        $data['title'] = 'Manajemen akun PKA';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/user_pka_position', $data, $id);
        $this->load->view('templates/footer');
    }

    public function user_pka($id = null)
    {
        $data['title'] = 'Karyawan PKA';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/user_pka', $data, $id);
        $this->load->view('templates/footer');
    }

    public function showAllPka()
    {
        $result = $this->M_Pka->showAllPka();
        echo json_encode($result);
    }

    public function showPkaByPosition($id_pka_position)
    {
        $result = $this->M_Pka->showPkaByPosition($id_pka_position);
        echo json_encode($result);
    }

    //pemisah
    // public function showAllPKA($id = null)
    // {
    //     $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
    //     if ($data['user']['id'] == 1) {
    //         $result = $this->M_Pka->showAllPKAByPosition($id);
    //     } else {
    //         $result = $this->M_Pka->showAllPKA();
    //     }
    //     echo json_encode($result);
    // }

    public function detailPka()
    {
        $result = $this->M_Pka->detailPka();
        echo json_encode($result);
    }

    public function deletePka()
    {
        $result = $this->M_Pka->deletePka();
        echo json_encode($result);
    }
}
