<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Feedback');
        $this->load->model('M_Work_program');
        $this->load->model('M_Activity');
    }

    public function showFeedbackById($tipe)
    {
        $result = $this->M_Feedback->showFeedbackById($tipe);
        echo json_encode($result);
    }

    public function addFeedback($id = null)
    {
        if ($this->input->post('category_id') == 'P') {
            $this->M_Work_program->tolakWorkProgram($this->input->post('post_id'));
        }
        if ($this->input->post('category_id') == 'L') {
            $this->M_Activity->tolakActivity($this->input->post('post_id'));
        }
        $result = $this->M_Feedback->addFeedback();

        if ($this->input->post('category_id') == 'A') {
            redirect('Article/Article_of_ormawa/' . $id);
        } else if ($this->input->post('category_id') == 'P') {
            redirect('work_program/work_program_by_ormawa/' . $id);
        } else if ($this->input->post('category_id') == 'L') {
            redirect('Activity');
        }
    }
}
