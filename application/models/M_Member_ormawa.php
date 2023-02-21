<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Member_ormawa extends CI_Model
{
    public function showAllMemberOrmawa()
    {
        $this->db->select('*');
        $query = $this->db->get('member_ormawa');
        return $query->result();
    }

    public function showMemberOrmawaById($id_member_ormawa)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id_member_ormawa);
        $query = $this->db->get('member_ormawa');
        return $query->row_array();
    }

    public function showMemberOrmawaByOrmawa($id_member_by_ormawa)
    {
        $this->db->select('*');
        $this->db->from('member_ormawa');
        $this->db->join('ormawa', 'member_ormawa.ormawa_id = ormawa.id_ormawa');
        $this->db->join('user', 'member_ormawa.user_id = user.id');
        $this->db->where('ormawa.id_ormawa', $id_member_by_ormawa);
        $query = $this->db->get();
        return $query->result();
    }

    public function showMemberOrmawaByOrmawaNoAdmin($id_member_by_ormawa = null)
    {
        $this->db->select('*');
        $this->db->from('member_ormawa');
        $this->db->join('ormawa', 'member_ormawa.ormawa_id = ormawa.id_ormawa');
        $this->db->join('user', 'member_ormawa.user_id = user.id');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('religion', 'user.religion_id = religion.id_religion');
        $this->db->join('student', 'user.id = student.user_id');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        $this->db->where('ormawa.id_ormawa', $id_member_by_ormawa);
        $this->db->where('user.role_id !=', 3);
        $this->db->where('user.role_id !=', 5);
        $query = $this->db->get();
        return $query->result();
    }

    public function x()
    {
        $this->db->select('a.*, b.name, b.email, c.name_prodi');
        $this->db->from('student a');
        $this->db->join('user b', 'a.user_id = b.id');
        $this->db->join('prodi c', 'a.prodi_id = c.id_prodi');
        $this->db->join('member_ormawa d', 'a.user_id = d.user_id');
        $this->db->where('d.ormawa_id', 5);
        $query = $this->db->get();
        return $query->result();
    }

    public function showMemberOrmawaByOrmawaNoPeriod($id_member_by_ormawa = null, $id = null)
    {
        $this->db->select('a.*, b.name, b.email, c.name_prodi');
        $this->db->from('student a');
        $this->db->join('user b', 'a.user_id = b.id');
        $this->db->join('prodi c', 'a.prodi_id = c.id_prodi');
        $this->db->join('member_ormawa d', 'a.user_id = d.user_id');
        $this->db->where('d.ormawa_id', $id_member_by_ormawa);
        $this->db->where_not_in('d.period_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function submission_candidate($id_ormawa)
    {
        $this->db->select('*');
        $this->db->from('registration_student_to_ormawa');
        $this->db->join('user', 'registration_student_to_ormawa.user_id = user.id');
        $this->db->join('student', 'user.id = student.user_id');
        $this->db->where('registration_student_to_ormawa.ormawa_id', $id_ormawa);
        $this->db->where('registration_student_to_ormawa.status_registration_student_to_ormawa', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function intoProsesCandidate($value_input)
    {
        $ormawa = $this->db->get_where('ormawa', ['id_ormawa' => $value_input['id_ormawa']])->row_array();
        // var_dump($value_input['member']);
        // die();
        if ($value_input) {

            for ($k=0; $k < count($value_input['member']); $k++) { 
            
                $field = array(
                    'status_registration_student_to_ormawa' => 2,
                    'date_status_registration_student_to_ormawa' => date('Y-m-d')
                );
                $this->db->where('ormawa_id', $value_input['id_ormawa']);
                $this->db->where('user_id',  $value_input['member'][$k]);
                $this->db->update('registration_student_to_ormawa', $field);

                $notif = array(
                    'text_notification' => 'Anda sedang <span class="text-info">diproses</span> oleh staff ' . $ormawa['name_ormawa'] . ', silahkan menghubungi pengurus untuk proses kaderisasi.',
                    'user_id' => $value_input['member'][$k]
                );
                $this->db->insert('notification', $notif);

        
            }

            // foreach ($value_input['member'] as $data) {
               
            // }
            // var_dump($k);
            // die();
        } else {
            return false;
        }
    }

    public function deleteCandidate($value_input)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $ormawa = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
        $dataormawa = $this->db->get_where('ormawa', ['id_ormawa' =>  $ormawa['ormawa_id']])->row_array();

        $id = $this->input->get('id');
        // $this->db->where('user_id', $id);
        // $this->db->where('ormawa_id', $ormawa['ormawa_id']);
        // $this->db->delete('registration_student_to_ormawa');


        // $notif = array(
        //     'text_notification' => 'Pengajuan berkas anda <span class="text-danger">ditolak</span> oleh staff ' . $dataormawa['name_ormawa'] . '. Jika ada yang ingin ditanyakan, silahkan menghubungi pengurus dengan nomor yang tertera di halaman utama ormawa.',
        //     'user_id' => $id
        // );
        // $this->db->insert('notification', $notif);
        // if ($this->db->affected_rows() > 0) {
        //     return true;
        // } else {
        //     return false;
        // }

        if ($value_input) {
            $i = 0;
            $field = array(
                'status_registration_student_to_ormawa' => 3,
                'date_status_registration_student_to_ormawa' => date('Y-m-d')
            );
            $this->db->where('user_id', $id);
            $this->db->where('ormawa_id', $ormawa['ormawa_id']);
            $this->db->update('registration_student_to_ormawa', $field);

            $notif = array(
                'text_notification' => 'Pengajuan berkas anda <span class="text-danger">ditolak</span> oleh staff ' . $dataormawa['name_ormawa'] . '. Jika ada yang ingin ditanyakan, silahkan menghubungi pengurus dengan nomor yang tertera di halaman utama ormawa.',
                'user_id' => $id
            );
            $this->db->insert('notification', $notif);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }

            $i++;
        } else {
            return false;
        }
    }

    public function student_to_member($id_ormawa)
    {
        $this->db->select('*');
        $this->db->from('registration_student_to_ormawa');
        $this->db->join('user', 'registration_student_to_ormawa.user_id = user.id');
        $this->db->join('student', 'user.id = student.user_id');
        $this->db->where('registration_student_to_ormawa.ormawa_id', $id_ormawa);
        $this->db->where('registration_student_to_ormawa.status_registration_student_to_ormawa', 2);
        $query = $this->db->get();
        return $query->result();
    }

    public function intoProsesMember($value_input) //ini
    {
        $ormawa = $this->db->get_where('ormawa', ['id_ormawa' => $value_input['id_ormawa']])->row_array();

        if ($value_input) {

            for ($i=0; $i < count($value_input['member']); $i++) { 
                $field = array(
                    'status_registration_student_to_ormawa' => 2,
                    'date_status_registration_student_to_ormawa' => date('Y-m-d')
                );
                $this->db->where('ormawa_id', $value_input['id_ormawa']);
                $this->db->where('user_id',  $value_input['member'][$i]);
                $this->db->delete('registration_student_to_ormawa', $field);

                $notif = array(
                    'text_notification' => 'Anda telah <span class="text-success">diterima</span> sebagai anggota ' . $ormawa['name_ormawa'] . ', silahkan menghubungi pengurus untuk proses pelantikan.',
                    'user_id' => $value_input['member'][$i]
                );
                $this->db->insert('notification', $notif);

            }

            for ($i=0; $i < count($value_input['member']); $i++) { 
                $field = array(
                    'user_id' => $value_input['member'][$i],
                    'ormawa_id' => $value_input['id_ormawa'],
                    'is_active_member_ormawa' => 1

                );
                $this->db->insert('member_ormawa', $field);
            }
        } else {
            return false;
        }
    }

    public function delete_candidate_to_member($value_input)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $ormawa = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
        $dataormawa = $this->db->get_where('ormawa', ['id_ormawa' =>  $ormawa['ormawa_id']])->row_array();

        $id = $this->input->get('id');
        // $this->db->where('user_id', $id);
        // $this->db->where('ormawa_id', $ormawa['ormawa_id']);
        // $this->db->delete('registration_student_to_ormawa');


        // $notif = array(
        //     'text_notification' => 'Pengajuan berkas anda <span class="text-danger">ditolak</span> oleh staff ' . $dataormawa['name_ormawa'] . '. Jika ada yang ingin ditanyakan, silahkan menghubungi pengurus dengan nomor yang tertera di halaman utama ormawa.',
        //     'user_id' => $id
        // );
        // $this->db->insert('notification', $notif);
        // if ($this->db->affected_rows() > 0) {
        //     return true;
        // } else {
        //     return false;
        // }

        if ($value_input) {
            $i = 0;
            $field = array(
                'status_registration_student_to_ormawa' => 3,
                'date_status_registration_student_to_ormawa' => date('Y-m-d')
            );
            $this->db->where('user_id', $id);
            $this->db->where('ormawa_id', $ormawa['ormawa_id']);
            $this->db->update('registration_student_to_ormawa', $field);

            $notif = array(
                'text_notification' => 'Pengajuan berkas anda <span class="text-danger">ditolak</span> oleh staff ' . $dataormawa['name_ormawa'] . '. Jika ada yang ingin ditanyakan, silahkan menghubungi pengurus dengan nomor yang tertera di halaman utama ormawa.',
                'user_id' => $id
            );
            $this->db->insert('notification', $notif);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }

            $i++;
        } else {
            return false;
        }
    }

    public function showMemberOrmawaByPeriod($id_member_ormawa_period)
    {
        $this->db->select('*');
        $this->db->from('member_ormawa');
        $this->db->join('period', 'member_ormawa.period_id = period.id_period');
        $this->db->where('period.id_period', $id_member_ormawa_period);
        $query = $this->db->get();
        return $query->result();
    }

    public function showOrmawaByStudent($id_ormawa)
    {
        $this->db->select('*');
        $this->db->from('student');
        $this->db->join('member_ormawa', 'student.user_id = member_ormawa.user_id');
        $this->db->join('ormawa', 'member_ormawa.ormawa_id = ormawa.id_ormawa');
        $this->db->where('ormawa.id_ormawa', $id_ormawa);
        $query = $this->db->get();
        return $query->result();
    }

    public function showOrmawaByMember()
    {

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $id_user = $data['user']['id'];

        $this->db->select('*');
        $this->db->from('member_ormawa');
        $this->db->join('ormawa', 'member_ormawa.ormawa_id = ormawa.id_ormawa');
        $this->db->join('period', 'period.id_period = member_ormawa.period_id');
        $this->db->where('member_ormawa.user_id', $id_user);
        $query = $this->db->get();
        return $query->result();
    }
}
