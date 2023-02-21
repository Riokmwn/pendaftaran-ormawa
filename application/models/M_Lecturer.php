<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Lecturer extends CI_Model
{
    public function showAllLecturer()
    {
        $this->db->select('*');
        $this->db->from('lecturer');
        $this->db->join('user', 'lecturer.user_id = user.id');
        $this->db->join('ormawa', 'lecturer.ormawa_id = ormawa.id_ormawa');
        $query = $this->db->get();
        return $query->result();
    }

    public function showLecturerById($id_lecturer)
    {
        $this->db->select('*');
        $this->db->where('id_lecturer', $id_lecturer);
        $query = $this->db->get('lecturer');
        return $query->row_array();
    }

    public function showLecturerByOrmawa($id_lecturer_ormawa)
    {
        $this->db->select('*');
        $this->db->from('lecturer');
        $this->db->join('ormawa', 'lecturer.ormawa_id = ormawa.id_ormawa');
        $this->db->where('ormawa.id_ormawa', $id_lecturer_ormawa);
        $query = $this->db->get();
        return $query->result();
    }

    public function editLecturer()
    {
        $id = $this->input->get('id');
        $this->db->from('lecturer');
        $this->db->join('user', 'lecturer.user_id = user.id');
        $this->db->join('religion', 'user.religion_id = religion.id_religion');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('ormawa', 'lecturer.ormawa_id = ormawa.id_ormawa');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function deleteLecturer()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('user_id', $id);
        $this->db->delete('lecturer');
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
