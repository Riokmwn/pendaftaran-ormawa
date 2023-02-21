<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Menu extends CI_Model
{
    private $_table = "user_menu";

    public $id;
    public $menu;
    public $menu_name;
    public $order_by;

    public function rules()
    {
        return [
            [
                'field' => 'menu',
                'label' => 'Menu',
                'rules' => 'required'
            ],

            [
                'field' => 'menu_name',
                'label' => 'Menu Name',
                'rules' => 'required'
            ]
        ];
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->menu = $post["menu"];
        $this->menu_name = $post["menu_name"];
        $this->order_by = '0';
        return $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }


    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";
        return $this->db->query($query)->result_array();
    }
}
