<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Ormawa');
        $this->load->model('M_Type_ormawa');
        $this->load->model('M_Article');
    }

    public function index()
    {
        $data['ormawa'] = $this->M_Ormawa->showAllOrmawa();
        $data['article'] = $this->M_Article->showAllArticlePublished();
        $data['category'] = $this->M_Type_ormawa->showAllTypeOrmawa();
        $data['config'] = $this->db->get_where('information_config',  array('page_information_config' => 'home'))->row_array();
        $data['main_config'] = $this->db->get('main_config')->row_array();
        $data['title'] = 'Halaman Utama';

        $this->load->view('home/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('home/footer', $data);
    }

    public function ormawa()
    {
        $data['ormawa'] = $this->M_Ormawa->showOrmawaOnly();
        $data['category'] = $this->M_Type_ormawa->showAllTypeOrmawa();
        $data['config'] = $this->db->get_where('information_config',  array('page_information_config' => 'home'))->row_array();
        $data['main_config'] = $this->db->get('main_config')->row_array();

        $data['title'] = 'Halaman Ormawa';
        $this->load->view('home/header', $data);
        $this->load->view('home/ormawa', $data);
        $this->load->view('home/footer', $data);
    }

    public function ormawa_profile($id)
    {
        $data['ormawa'] = $this->M_Ormawa->showOrmawaById($id);
        $data['article'] = $this->db->get_where('article',  array('user_id' => $id, 'status_article' => 2))->result();
        $data['content'] = $this->db->get_where('content_homepage',  array('ormawa_id' => $id))->result();

        $data['config'] = $this->db->get_where('information_config',  array('page_information_config' => 'home'))->row_array();
        $data['main_config'] = $this->db->get('main_config')->row_array();

        $data['title'] = 'Profil Ormawa';
        $this->load->view('home/header', $data);
        $this->load->view('home/ormawa_profile', $data);
        $this->load->view('home/footer', $data);
    }

    public function article_grid()
    {
        $data['article'] = $this->M_Article->showAllArticlePublished();
        // echo '<pre>';
        // var_dump($data['article']);
        // echo '<pre>';
        // die();

        $data['config'] = $this->db->get_where('information_config',  array('page_information_config' => 'home'))->row_array();
        $data['main_config'] = $this->db->get('main_config')->row_array();

        $data['title'] = 'Halaman Artikel';
        $this->load->view('home/header', $data);
        $this->load->view('home/article_grid', $data);
        $this->load->view('home/footer', $data);
    }

    public function article_detail($id)
    {
        $data['article'] = $this->M_Article->showArticleById($id);
        $data['config'] = $this->db->get_where('information_config',  array('page_information_config' => 'home'))->row_array();
        $data['main_config'] = $this->db->get('main_config')->row_array();

        $data['title'] = 'Detail Artikel';
        $this->load->view('home/header', $data);
        $this->load->view('home/article_detail', $data);
        $this->load->view('home/footer', $data);
    }
}
