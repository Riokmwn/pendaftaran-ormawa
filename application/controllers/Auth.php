<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('M_Gender');
    $this->load->model('M_Religion');
    $this->load->model('M_Prodi');
    $this->load->model('M_Position_pka');
    $this->load->model('M_Ormawa');
  }


  public function index()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $this->form_validation->set_rules('email', 'Email', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Halaman Login';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/login');
      $this->load->view('templates/auth_footer');
    } else {
      // validasinya success
      $this->_login();
    }
  }


  private function _login()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db->query("SELECT * from user where email = '$email' OR id = '$email'")->row_array();
    // $user = $this->db->get_where('user', ['em3ail' => $email], ['id' => $email])

    // jika usernya ada
    if ($user) {
      // jika usernya aktif
      if ($user['is_active'] == 1) {
        // cek password
        if (password_verify($password, $user['password'])) {
          if ($user['email']) {
            $email = $user['email'];
          } else {
            $email = 'noemail';
          }
          $data = [
            'id' => $user['id'],
            'email' => $email,
            'role_id' => $user['role_id']
          ];
          $this->session->set_userdata($data);
          if ($user['role_id'] == 1) {
            redirect('admin');
          } elseif ($user['role_id'] == 2) {
            redirect('pka');
          } elseif ($user['role_id'] == 3) {
            redirect('ormawa');
          } elseif ($user['role_id'] == 4) {
            redirect('student');
          } elseif ($user['role_id'] == 5) {
            redirect('lecturer');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi email terlebih dahulu!</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div>');
      redirect('auth');
    }
  }


  // registration user
  public function registration()
  {
    $data['dataGender'] = $this->M_Gender->showAllGender();
    $data['dataReligion'] = $this->M_Religion->showAllReligion();
    $data['dataProdi'] = $this->M_Prodi->showAllProdi();

    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
      'is_unique' => 'Email telah terdaftar!'
    ]);
    $this->form_validation->set_rules('nrp', 'NRP', 'required|trim|is_unique[user.id]', [
      'is_unique' => 'NRP telah terdaftar!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password tidak cocok!',
      'min_length' => 'Password terlalu pendek!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    $this->form_validation->set_rules('date_of_birth', 'Date', 'required|trim');
    $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
    $this->form_validation->set_rules('religion', 'Religion', 'required|trim');
    $this->form_validation->set_rules('address', 'Address', 'required|trim');
    $this->form_validation->set_rules('prodi', 'Prodi', 'required|trim');
    $this->form_validation->set_rules('phone_number', 'Phone_number', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Registrasi mahasiswa';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/registration');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->input->post('email', true);
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'email' => htmlspecialchars($email),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 4,
        'is_active' => 1,
        'date_created' => time(),
        'id' => $this->input->post('nrp', true),
        'gender_id' => $this->input->post('gender', true),
        'religion_id' => $this->input->post('religion', true),
        'address' => $this->input->post('address', true),
        'date_of_birth' => $this->input->post('date_of_birth', true),
        'phone_number' => $this->input->post('phone_number', true),

      ];

      // siapkan token
      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];

      $student = [
        'user_id' => $this->input->post('nrp', true),
        'prodi_id' => $this->input->post('prodi', true)
      ];

      $this->db->insert('student', $student);
      $this->db->insert('user', $data);
      $this->db->insert('user_token', $user_token);

      // $this->_sendEmail($token, 'verify');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! akun telah dibuat.</div>');
      redirect('auth');
    }
  }


  // registration pka
  public function registration_pka()
  {
    $data['dataGender'] = $this->M_Gender->showAllGender();
    $data['dataReligion'] = $this->M_Religion->showAllReligion();
    $data['dataPositionPka'] = $this->M_Position_pka->showAllPositionPka();

    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
      'is_unique' => 'Email telah terdaftar!'
    ]);
    $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[user.id]', [
      'is_unique' => 'NRP telah terdaftar!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password tidak cocok!',
      'min_length' => 'Password terlalu pendek!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    $this->form_validation->set_rules('date_of_birth', 'Date', 'required|trim');
    $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
    $this->form_validation->set_rules('religion', 'Religion', 'required|trim');
    $this->form_validation->set_rules('address', 'Address', 'required|trim');
    $this->form_validation->set_rules('position', 'Position', 'required|trim');
    $this->form_validation->set_rules('phone_number', 'Phone_number', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Registrasi PKA';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/registration_pka');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->input->post('email', true);
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'email' => htmlspecialchars($email),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 2,
        'is_active' => 1,
        'date_created' => time(),
        'id' => $this->input->post('nip', true),
        'gender_id' => $this->input->post('gender', true),
        'religion_id' => $this->input->post('religion', true),
        'address' => $this->input->post('address', true),
        'date_of_birth' => $this->input->post('date_of_birth', true),
        'phone_number' => $this->input->post('phone_number', true),

      ];

      // siapkan token
      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];

      $pka = [
        'user_id' => $this->input->post('nip', true),
        'position_id' => $this->input->post('position', true)
      ];

      $this->db->insert('pka', $pka);
      $this->db->insert('user', $data);
      $this->db->insert('user_token', $user_token);

      // $this->_sendEmail($token, 'verify');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! akun telah dibuat.</div>');
      redirect('auth');
    }
  }


  // registration lecturer
  public function registration_lecturer()
  {
    $data['dataGender'] = $this->M_Gender->showAllGender();
    $data['dataReligion'] = $this->M_Religion->showAllReligion();
    $data['ormawa'] = $this->M_Ormawa->showAllOrmawa();

    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
      'is_unique' => 'Email telah terdaftar!'
    ]);
    $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[user.id]', [
      'is_unique' => 'NIP telah terdaftar!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password tidak cocok!',
      'min_length' => 'Password terlalu pendek!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    $this->form_validation->set_rules('date_of_birth', 'Date', 'required|trim');
    $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
    $this->form_validation->set_rules('religion', 'Religion', 'required|trim');
    $this->form_validation->set_rules('address', 'Address', 'required|trim');
    $this->form_validation->set_rules('ormawa', 'Ormawa', 'required|trim');
    $this->form_validation->set_rules('phone_number', 'Phone_number', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Registrasi pembina';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/registration_lecturer');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->input->post('email', true);
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'email' => htmlspecialchars($email),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 5,
        'is_active' => 1,
        'date_created' => time(),
        'id' => $this->input->post('nip', true),
        'gender_id' => $this->input->post('gender', true),
        'religion_id' => $this->input->post('religion', true),
        'address' => $this->input->post('address', true),
        'date_of_birth' => $this->input->post('date_of_birth', true),
        'phone_number' => $this->input->post('phone_number', true),
      ];

      $member_ormawa = [
        'user_id' => htmlspecialchars($this->input->post('nip', true)),
        'ormawa_id' => htmlspecialchars($this->input->post('ormawa', true)),
        'is_active_member_ormawa' => 1,
      ];

      // siapkan token
      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];

      $lecturer = [
        'user_id' => $this->input->post('nip', true),
        'ormawa_id' => $this->input->post('ormawa', true)
      ];

      $this->db->insert('lecturer', $lecturer);
      $this->db->insert('member_ormawa', $member_ormawa);
      $this->db->insert('user', $data);
      $this->db->insert('user_token', $user_token);

      // $this->_sendEmail($token, 'verify');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! akun telah dibuat.</div>');
      redirect('auth');
    }
  }


  // registration ormawa
  public function registration_ormawa()
  {
    $data['dataGender'] = $this->M_Gender->showAllGender();
    $data['dataReligion'] = $this->M_Religion->showAllReligion();
    $data['ormawa'] = $this->M_Ormawa->showAllOrmawa();

    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
      'is_unique' => 'Email telah terdaftar!'
    ]);
    $this->form_validation->set_rules('id', 'Id', 'required|trim|is_unique[user.id]', [
      'is_unique' => 'ID telah terdaftar!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password tidak cocok!',
      'min_length' => 'Password terlalu pendek!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    $this->form_validation->set_rules('date_of_birth', 'Date', 'required|trim');
    $this->form_validation->set_rules('religion', 'Religion', 'required|trim');
    $this->form_validation->set_rules('address', 'Address', 'required|trim');
    $this->form_validation->set_rules('phone_number', 'Phone_number', 'required|trim');
    $this->form_validation->set_rules('ormawa', 'Ormawa', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Registrasi staff ormawa';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/registration_ormawa');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->input->post('email', true);
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'email' => htmlspecialchars($email),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 3,
        'is_active' => 1,
        'date_created' => time(),
        'id' => $this->input->post('id', true),
        'gender_id' => 'O',
        'religion_id' => $this->input->post('religion', true),
        'address' => $this->input->post('address', true),
        'date_of_birth' => $this->input->post('date_of_birth', true),
        'phone_number' => $this->input->post('phone_number', true),

      ];

      $member_ormawa = [
        'user_id' => htmlspecialchars($this->input->post('id', true)),
        'ormawa_id' => htmlspecialchars($this->input->post('ormawa', true)),
        'is_active_member_ormawa' => 1,
      ];

      //tanya dulu bos
      $staff_ormawa = [
        'user_id' => htmlspecialchars($this->input->post('id', true)),
        'ormawa_id' => htmlspecialchars($this->input->post('ormawa', true)),
      ];

      // siapkan token
      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];

      $this->db->insert('user', $data);
      $this->db->insert('member_ormawa', $member_ormawa);
      //tanya dulu bos
      $this->db->insert('staff_ormawa', $staff_ormawa);
      $this->db->insert('user_token', $user_token);

      // $this->_sendEmail($token, 'verify');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! akun telah dibuat.</div>');
      redirect('auth');
    }
  }


  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'lganimation2@gmail.com',
      'smtp_pass' => 'ognfnpuostgbdsjo',
      'smtp_port' => 465,
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $this->email->initialize($config);

    $this->email->from('lganimation2@gmail.com', 'LG Animation');
    $this->email->to($this->input->post('email'));

    if ($type == 'verify') {
      $this->email->subject('Account Verification');
      $this->email->message('Klik tautan untuk verifikasi akun : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
    } else if ($type == 'forgot') {
      $this->email->subject('Reset Password');
      $this->email->message('Klik tautan untuk menghapus password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }


  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($user) {
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if ($user_token) {
        if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
          $this->db->set('is_active', 1);
          $this->db->where('email', $email);
          $this->db->update('user');

          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
          redirect('auth');
        } else {
          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
      redirect('auth');
    }
  }


  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar!</div>');
    redirect('auth');
  }


  public function blocked()
  {
    $this->load->view('auth/blocked');
  }


  public function forgotPassword()
  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Lupa password';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/forgot-password');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->input->post('email');
      $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

      if ($user) {
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created' => time()
        ];

        $this->db->insert('user_token', $user_token);
        $this->_sendEmail($token, 'forgot');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Cek email untuk menghapus password!</div>');
        redirect('auth/forgotpassword');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div>');
        redirect('auth/forgotpassword');
      }
    }
  }


  public function resetPassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($user) {
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if ($user_token) {
        $this->session->set_userdata('reset_email', $email);
        $this->changePassword();
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Hapus password gagal! Token salah.</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Hapus password gagal! Email salah.</div>');
      redirect('auth');
    }
  }


  public function changePassword()
  {
    if (!$this->session->userdata('reset_email')) {
      redirect('auth');
    }

    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Change Password';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/change-password');
      $this->load->view('templates/auth_footer');
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this->session->userdata('reset_email');

      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('user');

      $this->session->unset_userdata('reset_email');

      $this->db->delete('user_token', ['email' => $email]);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password telah diubah! Silahkan masuk.</div>');
      redirect('auth');
    }
  }
}
