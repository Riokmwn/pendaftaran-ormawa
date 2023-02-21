<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Activity extends CI_Model
{
    public function showAllActivity()
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->join('ormawa', 'activity.ormawa_id = ormawa.id_ormawa');
        $this->db->join('category_activity', 'activity.category_id = category_activity.id_category_activity');
        $query = $this->db->get();
        return $query->result();
    }

    public function showActivityById($id_activity)
    {
        $this->db->select('*');
        $this->db->where('id_activity', $id_activity);
        $query = $this->db->get('activity');
        return $query->row_array();
    }

    public function showActivityByCategory($id_category_activity)
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->join('category_activity', 'activity.category_id = category_activity.id_category_activity');
        $this->db->where('category_activity.id_category_activity', $id_category_activity);
        $query = $this->db->get();
        return $query->result();
    }

    public function showActivityByOrmawa($id_activity_ormawa)
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->join('ormawa', 'activity.ormawa_id = ormawa.id_ormawa');
        $this->db->join('category_activity', 'activity.category_id = category_activity.id_category_activity');
        $this->db->where('ormawa.id_ormawa', $id_activity_ormawa);
        $query = $this->db->get();
        return $query->result();
    }

    public function showActivityByPeriod($id_activity_period)
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->join('period', 'activity.period_id = period.id_period');
        $this->db->where('period.id_period', $id_activity_period);
        $query = $this->db->get();
        return $query->result();
    }

    public function addActivity($document)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        if ($data['user']['role_id'] == 2) {
            $author_id = '1';
        } else {
            $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
            $author_id = $data['myOrmawa']['ormawa_id'];
        }

        $field = array(
            'title_activity' => ucfirst($this->input->post('title')),
            'content_activity' => $this->input->post('content'),
            'start_date_activity' => $this->input->post('start_date'),
            'end_date_activity' => $this->input->post('end_date'),
            'document_activity' => $document,
            'category_id' => $this->input->post('category'),
            'ormawa_id' => $author_id
        );
        $this->db->insert('activity', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editActivity()
    {
        $id = $this->input->get('id');
        $this->db->where('id_activity', $id);
        $query = $this->db->get('activity');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateActivity($document)
    {
        $id = $this->input->post('Id');
        $field = array(
            'id_activity' => ucfirst($this->input->post('Id')),
            'title_activity' => $this->input->post('title'),
            'content_activity' => $this->input->post('content'),
            'start_date_activity' => $this->input->post('start_date'),
            'end_date_activity' => $this->input->post('end_date'),
            'document_activity' => $document,
            'category_id' => $this->input->post('category')
        );
        $this->db->where('id_activity', $id);
        $this->db->update('activity', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteActivity()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_activity', $id);
        $this->db->delete('activity');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function terimaActivity()
    {
        $id = $this->input->get('id');
        $field = array(
            'status_documet_activity' => 2,
        );
        $this->db->where('id_activity', $id);
        $this->db->update('activity', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tolakActivity($id = NULL)
    {
        // $id = $this->input->get('id');
        $field = array(
            'status_documet_activity' => 3,
        );
        $this->db->where('id_activity', $id);
        $this->db->update('activity', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function countActivityById($id)
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->where('activity.ormawa_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
