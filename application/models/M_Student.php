<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Student extends CI_Model
{
    public function showAllStudent()
    {
        $this->db->select('*');
        $this->db->from('student');
        $this->db->join('user', 'student.user_id = user.id');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        $this->db->where('user.role_id', 4);
        $query = $this->db->get();
        return $query->result();
    }

    public function showAllStudentFilter($id_prodi, $tahun)
    {
        $this->db->select('*');
        $this->db->from('student');
        $this->db->join('user', 'student.user_id = user.id');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        if ($id_prodi != 'all') {
            $this->db->where('prodi.id_prodi', $id_prodi);
        }
        if ($tahun != 'all') {
            $this->db->where('SUBSTRING(user.id, 4, 2)=', $tahun);
        }
        $this->db->where('user.role_id', 4);
        $query = $this->db->get();
        return $query->result();
    }

    public function showStudentById($id_student)
    {
        $this->db->select('*');
        $this->db->from('student');
        $this->db->join('user', 'student.user_id = user.id');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        $this->db->join('religion', 'user.religion_id = religion.id_religion');
        $this->db->where('user_id', $id_student);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function showStudentByOrmawa($id_ormawa)
    {
        $this->db->select('*');
        $this->db->from('student');
        $this->db->join('user', 'student.user_id = user.id');
        $this->db->join('member_ormawa', 'user.id = member_ormawa.user_id');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        $this->db->join('ormawa', 'member_ormawa.ormawa_id = ormawa.id_ormawa');
        $this->db->where('id_ormawa', $id_ormawa);
        $this->db->where('member_ormawa.period_id !=', 0);
        $this->db->where('member_ormawa.is_active_member_ormawa !=', 0);
        $this->db->where('user.role_id !=', 3);
        $query = $this->db->get();
        return $query->result();
    }

    public function showStudentByPeriod($id_period)
    {
        $this->db->select('*');
        $this->db->from('student');
        $this->db->join('user', 'student.user_id = user.id');
        $this->db->join('member_ormawa', 'user.id = member_ormawa.user_id');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        $this->db->join('ormawa', 'member_ormawa.ormawa_id = ormawa.id_ormawa');
        $this->db->join('period', 'period.id_period = member_ormawa.period_id');
        $this->db->where('period.id_period', $id_period);
        // $this->db->where('member_ormawa.is_active_member_ormawa !=', 0);
        $this->db->where('user.role_id !=', 3);
        $query = $this->db->get();
        return $query->result();
    }

    public function showStudentRegistrationMemberOrmawa($id)
    {
        $this->db->from('registration_student_to_ormawa');
        $this->db->join('user', 'registration_student_to_ormawa.user_id = user.id');
        $this->db->where('registration_student_to_ormawa.ormawa_id', $id);
        $this->db->where('registration_student_to_ormawa.status_registration_student_to_ormawa', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function showStudentProsesMemberOrmawa($id)
    {
        $this->db->from('registration_student_to_ormawa');
        $this->db->join('user', 'registration_student_to_ormawa.user_id = user.id');
        $this->db->where('registration_student_to_ormawa.ormawa_id', $id);
        $this->db->where('registration_student_to_ormawa.status_registration_student_to_ormawa', 2);
        $query = $this->db->get();
        return $query->result();
    }

    public function registration_student_to_ormawa($user)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $field = array(
            'user_id' => $data['user']['id'],
            'ormawa_id' => $user,
            'status_registration_student_to_ormawa' => 1,
            'date_status_registration_student_to_ormawa' => date('Y-m-d')
        );

        $this->db->insert('registration_student_to_ormawa', $field);

        $data['ormawa'] = $this->db->get_where('staff_ormawa', ['ormawa_id' => $user])->row_array();

        $notif = array(
            'text_notification' => '' . $data['user']['name'] . ' telah mengajukan diri sebagai calon anggota, silahkan cek menu calon anggota.',
            'user_id' => $data['ormawa']['user_id']
        );
        $this->db->insert('notification', $notif);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function showAllCandidateStatus()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->db->select('*');
        $this->db->from('registration_student_to_ormawa');
        $this->db->join('user', 'registration_student_to_ormawa.user_id = user.id');
        $this->db->join('ormawa', 'registration_student_to_ormawa.ormawa_id = ormawa.id_ormawa');
        $this->db->where('registration_student_to_ormawa.user_id', $data['user']['id']);
        $query = $this->db->get();
        return $query->result();
    }

    public function editStudent()
    {
        $id = $this->input->get('id');
        $this->db->from('student');
        $this->db->join('user', 'student.user_id = user.id');
        $this->db->join('religion', 'user.religion_id = religion.id_religion');
        $this->db->join('gender', 'user.gender_id = gender.id_gender');
        $this->db->join('prodi', 'student.prodi_id = prodi.id_prodi');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function deleteStudent()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->db->where('user_id', $id);
        $this->db->delete('student');
        $this->db->where('user_id', $id);
        $this->db->delete('member_ormawa');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function nonActiveMemberByOrmawa()
    {
        $id = $this->input->get('id');
        $i = 0;
        $field = array(
            'is_active_member_ormawa' => 0
        );
        $this->db->where('user_id', $id);
        $this->db->update('member_ormawa', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
