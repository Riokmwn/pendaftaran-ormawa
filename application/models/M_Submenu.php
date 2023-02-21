<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Submenu extends CI_Model
{
    private $_table = "user_sub_menu";

    public $id;
    public $menu_id;
    public $title;
    public $url;
    public $icon;
    public $is_active;
    public $order_by;


    public function rules()
    {
        return [
            [
                'field' => 'menu_id',
                'label' => 'menu_id',
                'rules' => 'required'
            ],

            [
                'field' => 'title',
                'label' => 'title',
                'rules' => 'required'
            ],

            [
                'field' => 'url',
                'label' => 'url',
                'rules' => 'required'
            ],

            [
                'field' => 'icon',
                'label' => 'icon',
                'rules' => 'required'
            ],

            // [
            //     'field' => 'is_active',
            //     'label' => 'is_active',
            //     'rules' => 'required'
            // ],
        ];
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->menu_id = $post["menu_id"];
        $this->title = $post["title"];
        $this->url = $post["url"];
        $this->icon = $post["icon"];
        $this->is_active = $post["is_active"];
        return $this->db->update('user_sub_menu', $this, array('id' => $post['id']));
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function deleteSubmenu($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}
