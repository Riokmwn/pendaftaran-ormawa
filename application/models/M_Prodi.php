<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Prodi extends CI_Model
{
    public function showAllProdi()
    {
        $this->db->select('*');
        $query = $this->db->get('prodi');
        return $query->result();
    }

    public function showProdiById($id_prodi)
    {
        $this->db->select('*');
        $this->db->where('id_prodi', $id_prodi);
        $query = $this->db->get('prodi');
        return $query->row_array();
    }

    public function addProdi()
    {
        $field = array(
            'id_prodi' => ucfirst($this->input->post('Id')),
            'name_prodi' => ucfirst($this->input->post('name'))
        );
        $this->db->insert('prodi', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editProdi()
    {
        $id = $this->input->get('id');
        $this->db->where('id_prodi', $id);
        $query = $this->db->get('prodi');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateProdi()
    {
        $id = $this->input->post('firstId');
        $field = array(
            'id_prodi' => $this->input->post('Id'),
            'name_prodi' => ucfirst($this->input->post('name'))
        );
        $this->db->where('id_prodi', $id);
        $this->db->update('prodi', $field);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProdi()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_prodi', $id);
        $this->db->delete('prodi');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function showStudentByProdi($id_prodi_student)
    {
        $this->db->select('*');
        $this->db->from('student');
        $this->db->join('user', 'student.user_id = user.id');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        $this->db->where('prodi.id_prodi', $id_prodi_student);
        $query = $this->db->get();
        return $query->result();
    }

    public function showStudentProdi($id_student_prodi)
    {
        $this->db->select('*');
        $this->db->from('student');
        $this->db->join('user', 'student.user_id = user.id');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        $this->db->where('student.user_id', $id_student_prodi);
        $query = $this->db->get();
        return $query->row_array();
    }
}
