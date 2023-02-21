<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Gender extends CI_Model
{
    public function showAllGender()
    {
        $this->db->select('*');
        $query = $this->db->get('gender');
        return $query->result();
    }

    public function showGenderById($id_gender)
    {
        $this->db->select('*');
        $this->db->where('id_gender', $id_gender);
        $query = $this->db->get('gender');
        return $query->row_array();
    }

    public function addGender()
    {
        $field = array(
            'id_gender' => ucfirst($this->input->post('Id')),
            'name_gender' => ucfirst($this->input->post('gender'))
        );
        $this->db->insert('gender', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editGender()
    {
        $id = $this->input->get('id');
        $this->db->where('id_gender', $id);
        $query = $this->db->get('gender');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateGender()
    {
        $id = $this->input->post('firstId');
        $field = array(
            'name_gender' => ucfirst($this->input->post('gender')),
            'id_gender' => ucfirst($this->input->post('Id')),

        );
        $this->db->where('id_gender', $id);
        $this->db->update('gender', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteGender()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_gender', $id);
        $this->db->delete('gender');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
