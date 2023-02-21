<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Article extends CI_Model
{
    public function showAllArticle()
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->join('ormawa', 'article.user_id = ormawa.id_ormawa');
        $query = $this->db->get();
        return $query->result();
    }
    public function showAllArticlePublished()
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->join('ormawa', 'article.user_id = ormawa.id_ormawa');
        $this->db->where('status_Article', 2);
        $query = $this->db->get();
        return $query->result();
    }

    public function showArticleById($id_article)
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->join('ormawa', 'article.user_id = ormawa.id_ormawa');
        $this->db->where('id_article', $id_article);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function showArticleByOrmawa($id_article_ormawa)
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->join('ormawa', 'article.user_id = ormawa.id_ormawa');
        $this->db->where('ormawa.id_ormawa', $id_article_ormawa);
        $query = $this->db->get();
        return $query->result();
    }

    public function showArticleByPeriod($id_article_period)
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->join('period', 'article.period_id = period.id_period');
        $this->db->where('period.id_period', $id_article_period);
        $query = $this->db->get();
        return $query->result();
    }

    public function showArticleByPka()
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->join('ormawa', 'article.user_id = ormawa.id_ormawa');
        $this->db->where('article.user_id', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function countArticleById($id)
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('article.user_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function addArticle($image)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        if ($data['user']['role_id'] == 2) {
            $user_id = '1';
            $status = 2;
        } else {
            $data['myOrmawa'] = $this->db->get_where('member_ormawa', ['user_id' => $data['user']['id']])->row_array();
            $user_id = $data['myOrmawa']['ormawa_id'];
            $status = 1;
        }

        $field = array(
            'title_article' => ucfirst($this->input->post('title')),
            'content_article' => $this->input->post('content'),
            'user_id' => $user_id,
            'image_article' => $image,
            'status_article' => $status
        );
        $this->db->insert('article', $field);



        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editArticle()
    {
        $id = $this->input->get('id');
        $this->db->where('id_article', $id);
        $query = $this->db->get('article');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateArticle($image, $content)
    {
        $id = $this->input->post('Id');
        $field = array(
            'title_article' => ucfirst($this->input->post('title')),
            'content_article' => $content,
            'image_article' => $image,
        );
        $this->db->where('id_article', $id);
        $this->db->update('article', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function publishArticle($id_article, $id_ormawa)
    {
        $id = $this->input->post('Id');
        $field = array(
            'status_article' => 2,
        );
        $this->db->where('id_article', $id_article);
        $this->db->update('article', $field);
        if ($this->db->affected_rows() > 0) {
            redirect('Article/Article_of_ormawa/' . $id_ormawa);
        } else {
            return false;
        }
    }

    public function deleteArticle()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo "string";
        $this->db->where('id_article', $id);
        $this->db->delete('article');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
