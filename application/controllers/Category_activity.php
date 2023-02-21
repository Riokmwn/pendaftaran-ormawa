<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Category_activity');
        is_logged_in();
    }

    public function category_activity()
    {
        $data['title'] = 'Manajemen tipe kegiatan';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/category_activity', $data);
        $this->load->view('templates/footer');
    }

    public function showAllCategoryActivity()
    {
        $result = $this->M_Category_activity->showAllCategoryActivity();
        echo json_encode($result);
    }

    public function addCategoryActivity()
    {
        $result = $this->M_Category_activity->addCategoryActivity();
        $msg['type'] = 'add';
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function editCategoryActivity()
    {
        $result = $this->M_Category_activity->editCategoryActivity();
        echo json_encode($result);
    }

    public function updateCategoryActivity()
    {
        $result = $this->M_Category_activity->updateCategoryActivity();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deleteCategoryActivity()
    {
        $result = $this->M_Category_activity->deleteCategoryActivity();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }
}
