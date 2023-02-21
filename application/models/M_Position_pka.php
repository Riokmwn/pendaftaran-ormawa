<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Position_pka extends CI_Model
{
    public function showAllPositionPka()
    {
        $this->db->select('*');
        $query = $this->db->get('pka_position');
        return $query->result();
    }

    public function showPositionPkaById($id_pka_position)
    {
        $this->db->select('*');
        $this->db->where('id_pka_position', $id_pka_position);
        $query = $this->db->get('pka_position');
        return $query->row_array();
    }

    public function addPosition()
    {
        $field = array(
            'name_pka_position' => ucfirst($this->input->post('position'))
        );
        $this->db->insert('pka_position', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editPosition()
    {
        $id = $this->input->get('id');
        $this->db->where('id_pka_position', $id);
        $query = $this->db->get('pka_position');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updatePosition()
    {
        $id = $this->input->post('Id');
        $field = array(
            'name_pka_position' => ucfirst($this->input->post('position')),
        );
        $this->db->where('id_pka_position', $id);
        $this->db->update('pka_position', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePosition()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_pka_position', $id);
        $this->db->delete('pka_position');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
