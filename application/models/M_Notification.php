<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Notification extends CI_Model
{
    public function showAllNotification()
    {
        $this->db->select('*');
        $this->db->from('notification');
        $this->db->join('user', 'notification.user_id = user.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function showNotificationById()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->db->select('*');
        if ($data['user']['role_id'] == 2) {
            $this->db->where('user_id', '0');
        } else {
            $this->db->where('user_id', $data['user']['id']);
        }
        // $this->db->or_where('user_id', 'all');
        $this->db->order_by('date_notification', 'DESC');
        $query = $this->db->get('notification');
        return $query->result();
    }
}
