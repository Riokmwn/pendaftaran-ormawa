<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Work_program extends CI_Model
{
    public function showAllWorkProgram()
    {
        $this->db->select('*');
        $this->db->from('work_program');
        $this->db->join('category_activity', 'work_program.category_id = category_activity.id_category_activity');
        $this->db->join('ormawa', 'work_program.ormawa_id = ormawa.id_ormawa');
        $query = $this->db->get();
        return $query->result();
    }

    public function showWorkProgramById($id_work_program)
    {
        $this->db->select('*');
        $this->db->where('id_work_program', $id_work_program);
        $query = $this->db->get('work_program');
        return $query->row_array();
    }

    public function showWorkProgramByOrmawa($id_work_program_period)
    {
        $this->db->select('*');
        $this->db->from('work_program');
        $this->db->join('category_activity', 'work_program.category_id = category_activity.id_category_activity');
        $this->db->join('ormawa', 'work_program.ormawa_id = ormawa.id_ormawa');
        $this->db->where('ormawa.id_ormawa', $id_work_program_period);
        $query = $this->db->get();
        return $query->result();
    }

    public function showWorkProgramByPeriod($id_work_program_period)
    {
        $this->db->select('*');
        $this->db->from('work_program');
        $this->db->join('period', 'work_program.period_id = period.id_period');
        $this->db->where('period.id_period', $id_work_program_period);
        $query = $this->db->get();
        return $query->result();
    }

    public function addWorkProgram($document)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
        $author_id = $data['myOrmawa']['ormawa_id'];

        $field = array(
            'title_work_program' => ucfirst($this->input->post('title')),
            'content_work_program' => $this->input->post('content'),
            'date_work_program' => $this->input->post('date'),
            'document_work_program' => $document,
            'category_id' => $this->input->post('category'),
            'status_document_work_program' => 1,
            'ormawa_id' => $author_id
        );
        $this->db->insert('work_program', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editWorkProgram()
    {
        $id = $this->input->get('id');
        $this->db->where('id_work_program', $id);
        $query = $this->db->get('work_program');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateWorkProgram($document)
    {
        $id = $this->input->post('Id');
        $field = array(
            'id_work_program' => ucfirst($this->input->post('Id')),
            'title_work_program' => $this->input->post('title'),
            'content_work_program' => $this->input->post('content'),
            'date_work_program' => $this->input->post('date'),
            'category_id' => $this->input->post('category'),
            'document_work_program' => $document
        );
        $this->db->where('id_work_program', $id);
        $this->db->update('work_program', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteWorkProgram()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_work_program', $id);
        $this->db->delete('work_program');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function terimaWorkProgram()
    {
        $id = $this->input->get('id');
        $field = array(
            'status_document_work_program' => 2,
        );
        $this->db->where('id_work_program', $id);
        $this->db->update('work_program', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tolakWorkProgram($id = NULL)
    {
        // $id = $this->input->get('id');
        $field = array(
            'status_document_work_program' => 3,
        );
        $this->db->where('id_work_program', $id);
        $this->db->update('work_program', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function countWorkProgramById($id)
    {
        $this->db->select('*');
        $this->db->from('work_program');
        $this->db->where('work_program.ormawa_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
