<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Type_document extends CI_Model
{
    public function showAllTypeDocument()
    {
        $this->db->select('*');
        $query = $this->db->get('type_document');
        return $query->result();
    }

    public function showTypeDocumentById($id_type_document)
    {
        $this->db->select('*');
        $this->db->where('id_type_document', $id_type_document);
        $query = $this->db->get('type_document');
        return $query->row_array();
    }

    public function addTypeDocument()
    {
        $field = array(
            'name_type_document' => ucfirst($this->input->post('name'))
        );
        $this->db->insert('type_document', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editTypeDocument()
    {
        $id = $this->input->get('id');
        $this->db->where('id_type_document', $id);
        $query = $this->db->get('type_document');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateTypeDocument()
    {
        $id = $this->input->post('Id');
        $field = array(
            'name_type_document' => ucfirst($this->input->post('name')),
        );
        $this->db->where('id_type_document', $id);
        $this->db->update('type_document', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTypeDocument()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_type_document', $id);
        $this->db->delete('type_document');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
