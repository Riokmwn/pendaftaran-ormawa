<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_ormawa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Member_ormawa');
        is_logged_in();
    }

    // public function index()
    // {
    //     $data['title'] = 'Artikel';
    //     $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('article/index', $data);
    //     $this->load->view('templates/footer');
    // }

    public function showAllMemberOrmawa()
    {
        $result = $this->M_Member_ormawa->showAllMemberOrmawa();
        echo json_encode($result);
    }

    public function showMemberOrmawaByOrmawa($id_member_by_ormawa)
    {
        $result = $this->M_Member_ormawa->showMemberOrmawaByOrmawa($id_member_by_ormawa);
        echo json_encode($result);
    }

    public function showMemberOrmawaByPeriod($id_member_ormawa_period)
    {
        $result = $this->M_Member_ormawa->showMemberOrmawaByPeriod($id_member_ormawa_period);
        echo json_encode($result);
    }
}
