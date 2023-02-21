<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pka extends CI_Model
{
    public function showAllPka()
    {
        $this->db->select('*');
        $this->db->from('pka');
        $this->db->join('user', 'pka.user_id = user.id');
        $this->db->join('pka_position', 'pka.position_id = pka_position.id_pka_position');
        $this->db->where('user.role_id', 2);
        $query = $this->db->get();
        return $query->result();
    }

    public function showPkaById($id_pka)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id_pka);
        $query = $this->db->get('pka');
        return $query->row_array();
    }

    public function showPkaByPosition($id_pka_position)
    {
        $this->db->select('*');
        $this->db->from('pka');
        $this->db->join('user', 'pka.user_id = user.id');
        $this->db->join('pka_position', 'pka.position_id = pka_position.id_pka_position');
        $this->db->where('position_id', $id_pka_position);
        $this->db->where('user.role_id', 2);
        $query = $this->db->get();
        return $query->result();
    }

    public function detailPka()
    {
        $id = $this->input->get('id');
        $this->db->join('user', 'pka.user_id = user.id');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('religion', 'user.religion_id = religion.id_religion');
        $this->db->join('pka_position', 'pka.position_id = pka_position.id_pka_position');
        $this->db->where('user_id', $id);
        $query = $this->db->get('pka');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function deletePka()
    {
        $id = $this->input->get('id');
        $this->db->where('user_id', $id);
        $this->db->delete('pka');
        $this->db->where('id', $id);
        $this->db->delete('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
