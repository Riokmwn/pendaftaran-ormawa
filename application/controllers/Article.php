<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Article');
        $this->load->model('M_Ormawa');
        is_logged_in();
    }

    public function index($id_ormawa = null)
    {
        $data['title'] = 'Artikel';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if ($data['user']['role_id'] != 1 && $data['user']['role_id'] != 2) {
            $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id'),])->row_array();
            $data['ormawa_id'] = $data['member_ormawa']['ormawa_id'];
        } else {
            $data['ormawa_id'] = '';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('article/index', $data);
        $this->load->view('templates/footer');
    }

    public function showAllArticle()
    {
        $result = $this->M_Article->showAllArticle();
        echo json_encode($result);
    }

    public function showArticleByOrmawa($id_article_ormawa)
    {
        $result = $this->M_Article->showArticleByOrmawa($id_article_ormawa);
        echo json_encode($result);
    }

    public function showArticleByPeriod($id_article_period)
    {
        $result = $this->M_Article->showArticleByPeriod($id_article_period);
        echo json_encode($result);
    }

    public function showArticleByPka()
    {
        $result = $this->M_Article->showArticleByPka();
        echo json_encode($result);
    }

    public function countArticleById($id)
    {
        $result = $this->M_Article->countArticleById($id);
        echo json_encode($result);
    }

    public function before_article()
    {
        $data['title'] = 'Artikel';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if ($data['user']['role_id'] != 1 && $data['user']['role_id'] != 2) {
            $data['member_ormawa'] = $this->db->get_where('member_ormawa', ['user_id' => $this->session->userdata('id'),])->row_array();
            $data['ormawa_id'] = $data['member_ormawa']['ormawa_id'];
        } else {
            $data['ormawa_id'] = '';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('article/before_article', $data);
        $this->load->view('templates/footer');
    }

    public function article_of_ormawa($id_ormawa)
    {
        $data['title'] = 'Artikel';
        $data['id_ormawa'] = $id_ormawa;
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('article/article_of_ormawa', $data);
        $this->load->view('templates/footer');
    }


    // pemisah

    // public function showArticleByOrmawa()
    // {
    //     $result = $this->M_Article->showArticleByOrmawa();
    //     echo json_encode($result);
    // }

    public function addArticle()
    {
        // $result = $this->M_Article->addArticle();
        // echo json_encode($result);

        $config['upload_path'] = "./assets/img/article/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("image")) {
            $data = array('upload_data' => $this->upload->data());

            $image = $data['upload_data']['file_name'];

            $result = $this->M_Article->addArticle($image);
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

    public function editArticle()
    {
        $result = $this->M_Article->editArticle();
        echo json_encode($result);
    }

    public function updateArticle()
    {
        // $result = $this->M_Article->updateArticle();
        // $msg['success'] = false;
        // $msg['type'] = 'edit';
        // if ($result) {
        //     $msg['success'] = true;
        // }

        // echo json_encode($msg);

        $config['upload_path'] = "./assets/img/article/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("image")) {
            $data = array('upload_data' => $this->upload->data());

            $image = $data['upload_data']['file_name'];
        } else {
            $old_image = $this->db->get_where('article', ['id_article' => $this->input->post('Id')])->row_array();
            $image = $old_image['image_article'];
        }
        $content = $this->input->post('content');
        $result = $this->M_Article->updateArticle($image, $content);
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deleteArticle()
    {
        $result = $this->M_Article->deleteArticle();
        echo json_encode($result);
    }

    public function publishArticle($id_article, $id_ormawa)
    {
        $result = $this->M_Article->publishArticle($id_article, $id_ormawa);
        echo json_encode($result);
    }
}
