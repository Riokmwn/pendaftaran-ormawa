<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Document extends CI_Model
{
    public function showAllDocument()
    {
        $this->db->select('*');
        $query = $this->db->get('document');
        return $query->result();
    }

    public function showDocumentById($id_document)
    {
        $this->db->select('*');
        $this->db->where('id_document', $id_document);
        $query = $this->db->get('document');
        return $query->row_array();
    }

    public function showDocumentByType($id_document_type)
    {
        $this->db->select('*');
        $this->db->from('document');
        $this->db->join('type_ormawa', 'document.type_document_id = type_ormawa.id_type_ormawa');
        $this->db->where('type_ormawa.id_type_ormawa', $id_document_type);
        $query = $this->db->get();
        return $query->result();
    }

    public function showDocumentTypeCV($id_document_ormawa)
    {
        $this->db->select('*');
        $this->db->from('document');
        $this->db->join('user', 'document.user_id = user.id');
        $this->db->join('member_ormawa', 'user.id = member_ormawa.user_id');
        $this->db->join('type_document', 'document.type_document_id = type_document.id_type_document');
        $this->db->where('member_ormawa.ormawa_id', $id_document_ormawa);
        $this->db->where('type_document.id_type_document', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function showDocumentTypeTranscript($id_document_ormawa)
    {
        $this->db->select('*');
        $this->db->from('document');
        $this->db->join('user', 'document.user_id = user.id');
        $this->db->join('member_ormawa', 'user.id = member_ormawa.user_id');
        $this->db->join('type_document', 'document.type_document_id = type_document.id_type_document');
        $this->db->where('member_ormawa.ormawa_id', $id_document_ormawa);
        $this->db->where('type_document.id_type_document', 2);
        $query = $this->db->get();
        return $query->result();
    }

    public function showDocumentTypeCertificate($id_document_ormawa)
    {
        $this->db->select('*');
        $this->db->from('document');
        $this->db->join('user', 'document.user_id = user.id');
        $this->db->join('member_ormawa', 'user.id = member_ormawa.user_id');
        $this->db->join('type_document', 'document.type_document_id = type_document.id_type_document');
        $this->db->where('member_ormawa.ormawa_id', $id_document_ormawa);
        $this->db->where('type_document.id_type_document', 3);
        $query = $this->db->get();
        return $query->result();
    }
    public function showDocumentTypeAdArt($id_document_ormawa)
    {
        $this->db->select('*');
        $this->db->from('document');
        $this->db->join('user', 'document.user_id = user.id');
        $this->db->join('member_ormawa', 'user.id = member_ormawa.user_id');
        $this->db->join('type_document', 'document.type_document_id = type_document.id_type_document');
        $this->db->where('member_ormawa.ormawa_id', $id_document_ormawa);
        $this->db->where('type_document.id_type_document', 4);
        $this->db->order_by('date_document', 'DESC');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function showDocumentByOrmawa($id_document_ormawa)
    {
        $this->db->select('*');
        $this->db->from('document');
        $this->db->join('user', 'document.user_id = user.id');
        $this->db->join('type_document', 'document.type_document_id = type_document.id_type_document');
        $this->db->join('member_ormawa', 'user.id = member_ormawa.user_id');
        $this->db->where('document.user_id', $id_document_ormawa);
        $query = $this->db->get();
        return $query->result();
    }

    public function showDocumentByPeriod($id_document_period)
    {
        $this->db->select('*');
        $this->db->from('document');
        $this->db->join('period', 'document.period_id = period.id_period');
        $this->db->where('period.id_period', $id_document_period);
        $query = $this->db->get();
        return $query->result();
    }

    public function showDocumentByStudent($id_document_student)
    {
        $this->db->select('*');
        $this->db->from('document');
        $this->db->join('student', 'document.user_id = student.user_id');
        $this->db->join('type_document', 'document.type_document_id = type_document.id_type_document');
        $this->db->where('student.user_id', $id_document_student);
        $query = $this->db->get();
        return $query->result();
    }

    public function addDocument($document)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $user_id = $data['user']['id'];

        $field = array(
            'name_document' => $document,
            'type_document_id' => $this->input->post('type_document'),
            'user_id' => $user_id
        );
        $this->db->insert('document', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteDocument()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_document', $id);
        $this->db->delete('document');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
