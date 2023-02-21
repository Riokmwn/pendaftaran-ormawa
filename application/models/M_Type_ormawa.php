<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Type_ormawa extends CI_Model
{
    public function showAllTypeOrmawa()
    {
        $this->db->select('*');
        $query = $this->db->get('type_ormawa');
        return $query->result();
    }

    public function showTypeOrmawaById($id_type_ormawa)
    {
        $this->db->select('*');
        $this->db->where('id_type_ormawa', $id_type_ormawa);
        $query = $this->db->get('type_ormawa');
        return $query->row_array();
    }

    public function addTypeOrmawa()
    {
        $field = array(
            'name_type_ormawa' => ucfirst($this->input->post('name'))
        );
        $this->db->insert('type_ormawa', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editTypeOrmawa()
    {
        $id = $this->input->get('id');
        $this->db->where('id_type_ormawa', $id);
        $query = $this->db->get('type_ormawa');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateTypeOrmawa()
    {
        $id = $this->input->post('Id');
        $field = array(
            'name_type_ormawa' => ucfirst($this->input->post('name')),
        );
        $this->db->where('id_type_ormawa', $id);
        $this->db->update('type_ormawa', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTypeOrmawa()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_type_ormawa', $id);
        $this->db->delete('type_ormawa');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
