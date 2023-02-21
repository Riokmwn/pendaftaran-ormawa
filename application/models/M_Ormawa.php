<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Ormawa extends CI_Model
{
    public function showAllOrmawa()
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $query = $this->db->get();
        return $query->result();
    }

    public function showHmpsByProdi($prodi)
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $this->db->where('type_ormawa_id', 1);
        $this->db->where('prodi_id', $prodi);
        $query = $this->db->get();
        return $query->result();
    }

    public function showHmpsByProdiReadyToRegister($prodi)
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $this->db->join('member_ormawa', 'ormawa.id_ormawa = member_ormawa.ormawa_id');
        $this->db->join('user', 'member_ormawa.user_id = user.id');
        $this->db->where('user.role_id =', 3);
        $this->db->where('ormawa.is_active_ormawa =', 1);
        $this->db->where('ormawa.prodi_id', $prodi);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function showAllHmpsToRegist()
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $this->db->where('type_ormawa_id', 1);
        $this->db->order_by('ormawa.name_ormawa', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function showAllUkmToRegist()
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $this->db->where('type_ormawa_id', 2);
        $this->db->order_by('ormawa.name_ormawa', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function showAllUkkToRegist()
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $this->db->where('type_ormawa_id', 3);
        $this->db->order_by('ormawa.name_ormawa', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function showAllUkm()
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $this->db->where('ormawa.is_active_ormawa =', 1);
        $this->db->where('type_ormawa_id', 2);
        $this->db->order_by('ormawa.name_ormawa', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function showAllUkk()
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $this->db->where('ormawa.is_active_ormawa =', 1);
        $this->db->where('type_ormawa_id', 3);
        $this->db->order_by('ormawa.name_ormawa', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function showOrmawaById($id_ormawa)
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $this->db->join('member_ormawa', 'ormawa.id_ormawa = member_ormawa.ormawa_id');
        $this->db->join('user', 'member_ormawa.user_id = user.id');
        $this->db->where('user.role_id =', 3);
        $this->db->where('id_ormawa', $id_ormawa);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function showPeriodByOrmawa($id_period_ormawa)
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->join('period', 'ormawa.period_id = period.id_period');
        $this->db->where('period.id_period', $id_period_ormawa);
        $query = $this->db->get();
        return $query->result();
    }

    public function showOrmawaOnly()
    {
        $this->db->select('*');
        $this->db->from('ormawa');
        $this->db->where('type_ormawa_id !=', '0');
        $query = $this->db->get();
        return $query->result();
    }

    public function addOrmawa()
    {
        if (!$this->input->post('is_active')) {
            $status = 0;
        } else {
            $status = 1;
        }

        $prodi = $this->input->post('prodi');
        if ($this->input->post('category') != 1) {
            $prodi = '0';
        }
        $field = array(
            'name_ormawa' => ucfirst($this->input->post('name')),
            'type_ormawa_id' => $this->input->post('category'),
            'is_active_ormawa' => $status,
            'image_ormawa' => 'default.jpg',
            'organization_structure_ormawa' => 'default.jpg',
            'logo_ormawa' => 'default.jpg',
            'date_ormawa' => date('Y-m-d'),
            'prodi_id' => $prodi
        );



        $this->db->insert('ormawa', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editOrmawa()
    {
        $id = $this->input->get('id');
        $this->db->from('ormawa');
        $this->db->join('type_ormawa', 'ormawa.type_ormawa_id = type_ormawa.id_type_ormawa');
        $this->db->where('id_ormawa', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateOrmawa()
    {
        // var_dump($this->input->post());
        // die();
        $id = $this->input->post('Id');

        $lama = $this->db->get_where('ormawa', ['id_ormawa' => $id])->row_array();
        $field = array(
            'name_ormawa' => ucfirst($this->input->post('name')),
            'type_ormawa_id' => $this->input->post('category'),
            'is_active_ormawa' => $this->input->post('is_active'),
            'prodi_id' => $this->input->post('prodi')
        );
        $this->db->where('id_ormawa', $id);
        $this->db->update('ormawa', $field);

        if ($lama['is_active_ormawa'] != $this->input->post('is_active')) {
            $data = array(
                'date_ormawa' => date('Y-m-d')
            );
            $this->db->where('id_ormawa', $id);
            $this->db->update('ormawa', $data);
        }
        return true;
        // if ($this->db->affected_rows() > 0) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function deleteOrmawa()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_ormawa', $id);
        $this->db->delete('ormawa');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function showAllContentHomepageByOrmawa()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
        $user_id = $data['myOrmawa']['ormawa_id'];

        $this->db->select('*');
        $this->db->from('content_homepage');
        $this->db->join('ormawa', 'content_homepage.ormawa_id = ormawa.id_ormawa');
        $this->db->where('content_homepage.ormawa_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function addContentHomepage($image)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
        $user_id = $data['myOrmawa']['ormawa_id'];

        $field = array(
            'ormawa_id' => $user_id,
            'image_content_homepage' => $image,
        );
        $this->db->insert('content_homepage', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteContentHomepage()
    {
        $id = $this->input->get('id');
        $this->db->where('id_content_homepage', $id);
        $this->db->delete('content_homepage');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function acceptRegistrationOrmawa($id)
    {
        $data['ormawa'] = $this->db->get_where('staff_ormawa', ['ormawa_id' => $id])->row_array();
        $notif = array(
            'text_notification' => 'Pengajuan daftar ulang telah <span class="text-success">diterima</span> oleh staff PKA.',
            'user_id' => $data['ormawa']['user_id']
        );
        $this->db->insert('notification', $notif);
    }

    public function declineRegistrationOrmawa($id)
    {
        $data['ormawa'] = $this->db->get_where('staff_ormawa', ['ormawa_id' => $id])->row_array();
        $notif = array(
            'text_notification' => 'Pengajuan daftar ulang telah <span class="text-danger">ditolak</span> oleh staff PKA.',
            'user_id' => $data['ormawa']['user_id']
        );
        $this->db->insert('notification', $notif);
    }

    public function sendRegistrationOrmawa($id)
    {
        $ormawa = $this->db->get_where('ormawa', ['id_ormawa' => $id])->row_array();
        $notif = array(
            'text_notification' => '' . $ormawa['name_ormawa'] . ' Telah Mengajukan Daftar Ulang Organisasi, silahkan cek menu daftar ulang organisasi .',
            'user_id' => 'pka'
        );
        $this->db->insert('notification', $notif);
    }
}
