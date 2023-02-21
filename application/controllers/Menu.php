<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("M_Menu");
        $this->load->model("M_Submenu");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Manajemen menu';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'menu' => $this->input->post('menu'),
                'menu_name' => $this->input->post('menu_name')
            );
            $this->db->insert('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function edit($id = null)
    {
        $data['title'] = 'Manajemen menu';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if (!isset($id)) redirect('Menu/index');

        $menu = $this->M_Menu;
        $validation = $this->form_validation;
        $validation->set_rules($menu->rules());

        if ($validation->run()) {
            $menu->update();
            redirect('menu');
        }

        $data["menu"] = $menu->getById($id);
        if (!$data["menu"]) redirect('Menu/index');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->M_Menu->delete($id)) {
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Manajemen submenu';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->model('M_Menu', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon')
                // 'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Submenu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function editSubmenu($id = null)
    {
        $data['title'] = 'Manajemen submenu';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        if (!isset($id)) redirect('Menu/submenu');

        $submenu = $this->M_Submenu;
        $validation = $this->form_validation;
        $validation->set_rules($submenu->rules());

        if ($validation->run()) {
            $submenu->update();
            redirect('menu/submenu');
        }

        $data["submenu"] = $submenu->getById($id);
        if (!$data["submenu"]) redirect('Menu/submenu');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit_submenu', $data);
        $this->load->view('templates/footer');
    }

    public function deleteSubmenu($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->M_Submenu->deleteSubmenu($id)) {
            redirect('menu/submenu');
        }
    }
}
