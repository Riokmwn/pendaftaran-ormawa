<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Period extends CI_Model
{
    public function showAllPeriod()
    {
        $this->db->select('*');
        $this->db->from('period');
        $this->db->join('user', 'period.user_id = user.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function showPeriodById($id_period)
    {
        $this->db->select('*');
        $this->db->where('id_period', $id_period);
        $query = $this->db->get('period');
        return $query->row_array();
    }

    public function showHead($head)
    {
        $this->db->select('*');
        $this->db->from('member_ormawa');
        $this->db->join('user', 'member_ormawa.user_id = user.id');
        $this->db->where('member_ormawa.user_id', $head);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function showMemberByPeriod($member_period)
    {
        $this->db->select('*');
        $this->db->from('mewmber_ormawa');
        $this->db->join('user', 'member_ormawa.user_id = user.id');
        $this->db->join('student', 'user.id = student.user_id');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        $this->db->join('religion', 'user.religion_id = religion.id_religion');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('period', 'member_ormawa.period_id = period.id_period');
        $this->db->where('member_ormawa.period_id', $member_period);
        $this->db->where('member_ormawa.is_active_member_ormawa !=', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function addPeriod()
    {
        $field = array(
            'id_period' => ucfirst($this->input->post('Id')),
            'name_period' => ucfirst($this->input->post('name')),
            'ormawa_id' => ($this->input->post('ormawa_id')),
            'user_id' => ($this->input->post('head'))
        );
        $this->db->insert('period', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editPeriod()
    {
        $id = $this->input->get('id');
        $this->db->where('id_period', $id);
        $query = $this->db->get('period');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updatePeriod()
    {
        $id = $this->input->post('Id');
        $field = array(
            // 'id_period' => $this->input->post('Id'),
            'name_period' => ucfirst($this->input->post('name')),
            'user_id' => $this->input->post('head')
        );
        $this->db->where('id_period', $id);
        $this->db->update('period', $field);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePeriod()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_period', $id);
        $this->db->delete('period');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function intoMemberOrmawa($value_input)
    {
        // var_dump($this->input->post('member'));
        // die();

        if ($value_input) {
            foreach ($value_input['member'] as $data) {
                $field = array(
                    'period_id' => $this->input->post('id_period')
                );
                $this->db->where('ormawa_id', $value_input['id_ormawa']);
                $this->db->where('user_id', $data);
                $this->db->update('member_ormawa', $field);
            }
        } else {
            return false;
        }
    }

    public function showAllPeriodByOrmawa($ormawa_id)
    {
        $this->db->select('*');
        $this->db->from('period');
        $this->db->join('user', 'period.user_id = user.id');
        $this->db->where('period.ormawa_id', $ormawa_id);
        $query = $this->db->get();
        return $query->result();
    }
}
