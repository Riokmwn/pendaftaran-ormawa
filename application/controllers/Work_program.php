<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Work_program extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Work_program');
        $this->load->model('M_Category_activity');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Program kerja';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['category'] = $this->M_Category_activity->showAllCategoryActivity();

        if ($data['user']['role_id'] != 1 && $data['user']['role_id'] != 2) {
            $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id'),])->row_array();
            $data['ormawa_id'] = $data['member_ormawa']['ormawa_id'];
        } else {
            $data['ormawa_id'] = '';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('program/index', $data);
        $this->load->view('templates/footer');
    }

    public function work_program_of_ormawa($id)
    {
        $data['title'] = 'Program kerja';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['category'] = $this->M_Category_activity->showAllCategoryActivity();

        $data['ormawa_id'] = $id;


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('program/program_registration_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function showAllWorkProgram()
    {
        $result = $this->M_Work_program->showAllWorkProgram();
        echo json_encode($result);
    }

    public function showWorkProgramByPeriod($id_work_program_period)
    {
        $result = $this->M_Work_program->showWorkProgramByPeriod($id_work_program_period);
        echo json_encode($result);
    }

    public function showWorkProgramByOrmawa($id_work_program_ormawa)
    {
        $result = $this->M_Work_program->showWorkProgramByOrmawa($id_work_program_ormawa);
        echo json_encode($result);
    }


    public function before_work_program()
    {
        $data['title'] = 'Program kerja';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['category'] = $this->M_Category_activity->showAllCategoryActivity();

        if ($data['user']['role_id'] != 1 && $data['user']['role_id'] != 2) {
            $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id'),])->row_array();
            $data['ormawa_id'] = $data['member_ormawa']['ormawa_id'];
        } else {
            $data['ormawa_id'] = '';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('program/before_work_program', $data);
        $this->load->view('templates/footer');
    }

    public function countWorkProgramById($id)
    {
        $result = $this->M_Work_program->countWorkProgramById($id);
        echo json_encode($result);
    }

    public function work_program_by_ormawa($id_ormawa)
    {
        $data['title'] = 'Program Kerja';
        $data['id_ormawa'] = $id_ormawa;
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('work_program/work_program_of_ormawa', $data);
        $this->load->view('templates/footer');
    }


    //pemisah
    // public function showWorkProgramByOrmawa()
    // {
    //     $result = $this->M_Work_program->showWorkProgramByOrmawa();
    //     echo json_encode($result);
    // }

    public function addWorkProgram()
    {
        $config['upload_path'] = "./assets/document/proposal/";
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("document")) {
            $data = array('upload_data' => $this->upload->data());

            $document = $data['upload_data']['file_name'];

            $result = $this->M_Work_program->addWorkProgram($document);
            $msg['type'] = 'add';
            $msg['success'] = false;
            if ($result) {
                redirect('Work_program');
            }
            // echo json_encode($msg);
        } else {
            var_dump('no');
            die();
            $msg['success'] = false;
        }
    }

    public function editWorkProgram()
    {
        $result = $this->M_Work_program->editWorkProgram();
        echo json_encode($result);
    }

    public function updateWorkProgram()
    {

        $config['upload_path'] = "./assets/document/proposal/";
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("document")) {
            $data = array('upload_data' => $this->upload->data());

            $document = $data['upload_data']['file_name'];

            $result = $this->M_Work_program->updateWorkProgram($document);
            $msg['type'] = 'add';
            $msg['success'] = false;
            if ($result) {
                redirect('Work_program');
            }
            // echo json_encode($msg);
        } else {
            $document = $this->input->post('nama_dokumen');
            $result = $this->M_Work_program->updateWorkProgram($document);
            redirect('Work_program');
        }
    }

    public function terimaWorkProgram()
    {
        $result = $this->M_Work_program->terimaWorkProgram();
        echo json_encode($result);
    }

    public function tolakWorkProgram()
    {
        $result = $this->M_Work_program->tolakWorkProgram();
        // echo json_encode($result);
    }

    public function deleteWorkProgram()
    {
        $result = $this->M_Work_program->deleteWorkProgram();
        echo json_encode($result);
    }
}
