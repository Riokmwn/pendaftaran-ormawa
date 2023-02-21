<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Staff_ormawa extends CI_Model
{
    public function showAllStaffOrmawa()
    {
        $this->db->select('*');
        $this->db->from('staff_ormawa');
        $this->db->join('user', 'staff_ormawa.user_id = user.id');
        $this->db->join('ormawa', 'staff_ormawa.ormawa_id = ormawa.id_ormawa');
        $this->db->join('member_ormawa', 'user.id = member_ormawa.user_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function showStaffOrmawaById($id_staff_ormawa)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id_staff_ormawa);
        $query = $this->db->get('staff_ormawa');
        return $query->row_array();
    }

    public function editStaffOrmawa()
    {
        $id = $this->input->get('id');
        $this->db->from('staff_ormawa');
        $this->db->join('user', 'staff_ormawa.user_id = user.id');
        $this->db->join('religion', 'user.religion_id = religion.id_religion');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('ormawa', 'staff_ormawa.ormawa_id = ormawa.id_ormawa');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function deleteStaffOrmawa()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('user_id', $id);
        $this->db->delete('staff_ormawa');
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->db->where('user_id', $id);
        $this->db->delete('member_ormawa');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
