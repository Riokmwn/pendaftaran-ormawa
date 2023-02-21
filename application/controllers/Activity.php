<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Activity');
        $this->load->model('M_Category_activity');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Aktivitas';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['category'] = $this->M_Category_activity->showAllCategoryActivity();
        if ($data['user']['role_id'] != 1 && $data['user']['role_id'] != 2) {
            $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id'),])->row_array();
            if ($data['member_ormawa'] != null) {
                $data['ormawa_id'] = $data['member_ormawa']['ormawa_id'];
            }
        } else {
            $data['ormawa_id'] = '';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('activity/index', $data);
        $this->load->view('templates/footer');
    }

    public function showAllActivity()
    {
        $result = $this->M_Activity->showAllActivity();
        echo json_encode($result);
    }

    public function showActivityByCategory($id_category_activity)
    {
        $result = $this->M_Activity->showActivityByCategory($id_category_activity);
        echo json_encode($result);
    }

    public function showActivityByOrmawa($id_activity_ormawa)
    {
        $result = $this->M_Activity->showActivityByOrmawa($id_activity_ormawa);
        echo json_encode($result);
    }

    public function showActivityByPeriod($id_activity_period)
    {
        $result = $this->M_Activity->showActivityByPeriod($id_activity_period);
        echo json_encode($result);
    }

    public function showActivityByPka($id_activity_pka)
    {
        $result = $this->M_Activity->showActivityByPka($id_activity_pka);
        echo json_encode($result);
    }


    public function before_activity()
    {
        $data['title'] = 'Aktivitas';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['category'] = $this->M_Category_activity->showAllCategoryActivity();
        if ($data['user']['role_id'] != 1 && $data['user']['role_id'] != 2) {
            $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id'),])->row_array();
            if ($data['member_ormawa'] != null) {
                $data['ormawa_id'] = $data['member_ormawa']['ormawa_id'];
            }
        } else {
            $data['ormawa_id'] = '';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('activity/before_activity', $data);
        $this->load->view('templates/footer');
    }

    public function countActivityById($id)
    {
        $result = $this->M_Activity->countActivityById($id);
        echo json_encode($result);
    }

    public function activity_of_ormawa($id_ormawa)
    {
        $data['title'] = 'Aktivitas';
        $data['id_ormawa'] = $id_ormawa;
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('activity/activity_of_ormawa', $data);
        $this->load->view('templates/footer');
    }

    // pemisah

    // public function showActivityByOrmawa()
    // {
    //     $result = $this->M_Activity->showActivityByOrmawa();
    //     echo json_encode($result);
    // }

    public function addActivity()
    {
        // $result = $this->M_Activity->addActivity();
        // echo json_encode($result);

        $config['upload_path'] = "./assets/document/lpj/";
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("document")) {
            $data = array('upload_data' => $this->upload->data());

            $document = $data['upload_data']['file_name'];

            $result = $this->M_Activity->addActivity($document);
            $msg['type'] = 'add';
            $msg['success'] = false;
            if ($result) {
                redirect('Activity');
            }
            // echo json_encode($msg);
        } else {
            // var_dump('no');
            // die();
            $msg['success'] = false;
                redirect('Activity');
        }
    }

    public function editActivity()
    {
        $result = $this->M_Activity->editActivity();
        echo json_encode($result);
    }

    public function updateActivity()
    {
        $config['upload_path'] = "./assets/document/lpj/";
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("document")) {
            $data = array('upload_data' => $this->upload->data());

            $document = $data['upload_data']['file_name'];

            $result = $this->M_Activity->updateActivity($document);
            $msg['type'] = 'add';
            $msg['success'] = false;
            if ($result) {
                redirect('Activity');
            }
            // echo json_encode($msg);
        } else {
            $document = $this->input->post('nama_dokumen');
            $result = $this->M_Activity->updateActivity($document);
            redirect('Activity');
        }
    }

    public function deleteActivity()
    {
        $result = $this->M_Activity->deleteActivity();
        echo json_encode($result);
    }

    public function terimaActivity()
    {
        $result = $this->M_Activity->terimaActivity();
        echo json_encode($result);
    }

    public function tolakActivity()
    {
        $result = $this->M_Activity->tolakActivity();
        // echo json_encode($result);
    }
}
