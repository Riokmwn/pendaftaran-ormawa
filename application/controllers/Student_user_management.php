<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_user_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Student');
        $this->load->model('M_Prodi');
        $this->load->library('Excel');
    }

    // Student User Management
    public function user_student()
    {
        $data['title'] = 'Manajemen akun mahasiswa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['prodi'] = $this->M_Prodi->showAllProdi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/user_student', $data);
        $this->load->view('templates/footer');
    }

    public function addStudentAccount()
    {
        $data['title'] = 'Tambah Akun Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('student_user_management/add_student_account', $data);
        $this->load->view('templates/footer');
    }

    public function uploadStudentAccount()
    {
        $fileName = $_FILES['file']['name'];

        $config['upload_path'] = './assets/excel/student/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
        $config['max_size'] = 10000; // maksimal sizze

        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            echo $this->upload->display_errors();
            exit();
        }

        $inputFileName = './assets/excel/student/' . $this->upload->data("file_name");
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
                "email" => $rowData[0][1],
                "name" => htmlspecialchars($rowData[0][2]),
                "password" => password_hash($rowData[0][0], PASSWORD_DEFAULT),
                "image" => 'default.jpg',
                "role_id" => 4,
                "is_active" => 1,
                "date_created" => time(),

            );
            $data2 = array(
                "user_id" =>  $rowData[0][0],
                "prodi_id" => $rowData[0][3]
            );

            $insert = $this->db->insert("user", $data);
            $insert = $this->db->insert("student", $data2);
        }
        redirect('student_user_management/addStudentAccount');
    }

    public function showAllStudent()
    {
        $result = $this->M_Student->showAllStudent();
        echo json_encode($result);
    }

    public function showAllStudentFilter($id_prodi, $tahun)
    {
        $result = $this->M_Student->showAllStudentFilter($id_prodi, $tahun);
        echo json_encode($result);
    }

    public function editStudent()
    {
        $result = $this->M_Student->editStudent();
        echo json_encode($result);
    }

    public function showStudentByOrmawa()
    {
        $result = $this->M_Student->showStudentByOrmawa();
        echo json_encode($result);
    }

    public function deleteStudent()
    {
        $result = $this->M_Student->deleteStudent();
        echo json_encode($result);
    }
}
