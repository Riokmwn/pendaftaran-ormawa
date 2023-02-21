<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Category_activity extends CI_Model
{
    public function showAllCategoryActivity()
    {
        $this->db->select('*');
        $query = $this->db->get('category_activity');
        return $query->result();
    }

    public function showCategoryActivityById($id_category_activity)
    {
        $this->db->select('*');
        $this->db->where('id_category_activity', $id_category_activity);
        $query = $this->db->get('category_activity');
        return $query->row_array();
    }

    public function addCategoryActivity()
    {
        $field = array(
            'name_category_activity' => ucfirst($this->input->post('name'))
        );
        $this->db->insert('category_activity', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editCategoryActivity()
    {
        $id = $this->input->get('id');
        $this->db->where('id_category_activity', $id);
        $query = $this->db->get('category_activity');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateCategoryActivity()
    {
        $id = $this->input->post('Id');
        $field = array(
            'name_category_activity' => ucfirst($this->input->post('name')),
        );
        $this->db->where('id_category_activity', $id);
        $this->db->update('category_activity', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCategoryActivity()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_category_activity', $id);
        $this->db->delete('category_activity');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
