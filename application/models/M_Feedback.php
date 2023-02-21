<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Feedback extends CI_Model
{
    public function showAllFeedback()
    {
        $this->db->select('*');
        $this->db->from('feedback');
        $this->db->join('article', 'feedback.post_id = id_article');
        $query = $this->db->get();
        return $query->result();
    }

    public function showFeedbackById($tipe)
    {
        $id = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('feedback');
        $this->db->where('post_id', $id);
        $this->db->where('category_id', $tipe);
        $query = $this->db->get();
        return $query->result();
    }

    public function addFeedback()
    {
        $field = array(
            'content_feedback' => $this->input->post('feedback'),
            'category_id' => $this->input->post('category_id'),
            'post_id' => $this->input->post('post_id'),
        );
        $this->db->insert('feedback', $field);
        $data = array(
            'status_article' => 3,
        );
        $this->db->where('id_article', $this->input->post('post_id'));
        $this->db->update('article', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
