<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lecturer_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Lecturer');
    }

    // Pka User Management
    public function user_lecturer()
    {
        $data['title'] = 'Manajemen akun pembina';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/user_lecturer', $data);
        $this->load->view('templates/footer');
    }

    public function addLecturerAccount()
    {
        $data['title'] = 'Tambah Akun Pembina';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('lecturer_management/add_lecturer_account', $data);
        $this->load->view('templates/footer');
    }

    public function uploadLecturerAccount()
    {
        $fileName = $_FILES['file']['name'];

        $config['upload_path'] = './assets/excel/lecturer/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
        $config['max_size'] = 10000; // maksimal sizze

        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            echo $this->upload->display_errors();
            exit();
        }

        $inputFileName = './assets/excel/lecturer/' . $this->upload->data("file_name");
        // echo '<pre>';
        // var_dump($inputFileName);
        // echo '<pre>';
        // die();
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
            $rowData = $sheet->rangeToArray(
                'A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE
            );

            // Sesuaikan key array dengan nama kolom di database    
            $data = array(
                "id" => $rowData[0][0],
                "name" => htmlspecialchars($rowData[0][1]),
                "password" => password_hash($rowData[0][2], PASSWORD_DEFAULT),
                "image" => 'default.jpg',
                "role_id" => 5,
                "is_active" => 1,
                "date_created" => time(),
            );

            $data2 = array(
                "user_id" => $data["id"],
                "ormawa_id" => $rowData[0][3]
            );

            $data2 = array(
                "user_id" => $data["id"],
                "ormawa_id" => $data2["ormawa_id"]
            );
            // echo '<pre>';
            // var_dump($data);
            // echo '<pre>';
            // die();

            $insert = $this->db->insert("user", $data);
            $insert = $this->db->insert("lecturer", $data2);
            $insert = $this->db->insert("member_ormawa", $data2);
        }
        redirect('lecturer_management/addLecturerAccount');
    }

    public function showAllLecturer()
    {
        $result = $this->M_Lecturer->showAllLecturer();
        echo json_encode($result);
    }

    public function showLecturerByOrmawa($id_lecturer_ormawa)
    {
        $result = $this->M_Lecturer->showLecturerByOrmawa($id_lecturer_ormawa);
        echo json_encode($result);
    }

    public function editLecturer()
    {
        $result = $this->M_Lecturer->editLecturer();
        echo json_encode($result);
    }

    public function deleteLecturer()
    {
        $result = $this->M_Lecturer->deleteLecturer();
        echo json_encode($result);
    }
}
