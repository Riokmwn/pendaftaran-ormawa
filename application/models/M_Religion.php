<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Religion extends CI_Model
{
    public function showAllReligion()
    {
        $this->db->select('*');
        $query = $this->db->get('religion');
        return $query->result();
    }

    public function showReligionById($id_religion)
    {
        $this->db->select('*');
        $this->db->where('id_religion', $id_religion);
        $query = $this->db->get('religion');
        return $query->row_array();
    }

    public function addReligion()
    {
        $field = array(
            'name_religion' => ucfirst($this->input->post('name'))
        );
        $this->db->insert('religion', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editReligion()
    {
        $id = $this->input->get('id');
        $this->db->where('id_religion', $id);
        $query = $this->db->get('religion');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateReligion()
    {
        $id = $this->input->post('Id');
        $field = array(
            'name_religion' => ucfirst($this->input->post('name')),
        );
        $this->db->where('id_religion', $id);
        $this->db->update('religion', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteReligion()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_religion', $id);
        $this->db->delete('religion');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
