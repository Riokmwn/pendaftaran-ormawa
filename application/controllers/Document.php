<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Document');
        $this->load->model('M_Type_document');
        $this->load->model('M_Ormawa');
        $this->load->model('M_Work_program');
    }

    public function index()
    {
        $data['title'] = 'Dokumen';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['type_document'] = $this->M_Type_document->showAllTypeDocument();
        $data['id'] = $data['user']['id'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('document/index', $data);
        $this->load->view('templates/footer');
    }

    public function re_registration_ormawa()
    {
        $data['title'] = 'Daftar Ulang Ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        $data['ormawa'] = $this->db->get_where('ormawa', ['id_ormawa' => $data['myOrmawa']['ormawa_id']])->row_array();
        $data['ad_art'] = $this->M_Document->showDocumentTypeAdArt($data['ormawa']['id_ormawa']);
        $data['id'] = $data['ormawa']['id_ormawa'];
        $data['proker'] = $this->M_Work_program->showWorkProgramByOrmawa($data['myOrmawa']['ormawa_id']);
        $data['work_program'] = $this->M_Work_program->showWorkProgramByOrmawa($data['myOrmawa']['ormawa_id']);
        // echo '<pre>';
        // var_dump($data['work_program']);
        // echo '<pre>';
        // die();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('document/re_registration_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function re_registration_of_ormawa($id)
    {
        $data['title'] = 'Daftar Ulang Ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id')])->row_array();
        $data['ormawa'] = $this->db->get_where('ormawa', ['id_ormawa' => $id])->row_array();
        $data['work_program'] = $this->M_Work_program->showWorkProgramByOrmawa($data['ormawa']['id_ormawa']);

        $data['ad_art'] = $this->M_Document->showDocumentTypeAdArt($data['ormawa']['id_ormawa']);
        // if ($data['ad_art'] == null) {
        //     $data['ad_art'] = 'this_empty';
        // }
        $data['id'] = $id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('document/re_registration_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function candidate_document($id)
    {
        $data['title'] = 'Dokumen';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['type_document'] = $this->M_Type_document->showAllTypeDocument();
        $data['id'] = $id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('document/document_candidate', $data);
        $this->load->view('templates/footer');
    }

    public function ormawa_list_registration()
    {
        $data['title'] = 'Daftar ormawa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        // $data['ormawa'] = $this->M_Ormawa->showAllOrmawa();
        $data['hmps'] = $this->M_Ormawa->showAllHmpsToRegist();
        $data['ukm'] = $this->M_Ormawa->showAllUkmToRegist();
        $data['ukk'] = $this->M_Ormawa->showAllUkkToRegist();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('document/list_registration_ormawa', $data);
        $this->load->view('templates/footer');
    }

    public function showAllDocument()
    {
        $result = $this->M_Document->showAllDocument();
        echo json_encode($result);
    }

    public function showDocumentByType($id_document_type)
    {
        $result = $this->M_Document->showDocumentByType($id_document_type);
        echo json_encode($result);
    }

    public function showDocumentByOrmawa($id_document_ormawa)
    {
        $result = $this->M_Document->showDocumentByOrmawa($id_document_ormawa);
        echo json_encode($result);
    }

    public function showDocumentByPeriod($id_document_period)
    {
        $result = $this->M_Document->showDocumentByPeriod($id_document_period);
        echo json_encode($result);
    }

    public function showDocumentByStudent($id_document_student)
    {
        $result = $this->M_Document->showDocumentByStudent($id_document_student);
        echo json_encode($result);
    }

    //pemisah

    public function showDocumentByUser($id)
    {
        $result = $this->M_Document->showDocumentByUser($id);
        echo json_encode($result);
    }

    // public function showDocumentByOrmawa($id)
    // {
    //     $result = $this->M_Document->showDocumentByOrmawa($id);
    //     echo json_encode($result);
    // }

    public function showAllDocumentOfOrmawa()
    {
        $result = $this->M_Document->showAllDocumentOfOrmawa();
        echo json_encode($result);
    }

    public function addDocument()
    {
        $config['upload_path'] = "./assets/document/";
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("document")) {
            $data = array('upload_data' => $this->upload->data());

            $document = $data['upload_data']['file_name'];

            $result = $this->M_Document->addDocument($document);
            $msg['type'] = 'add';
            $msg['success'] = false;
            if ($result) {
                $msg['success'] = true;
            }

            echo json_encode($msg);
        } else {
            $msg['success'] = false;
        }
    }

    public function deleteDocument()
    {
        $result = $this->M_Document->deleteDocument();
        echo json_encode($result);
    }
}
