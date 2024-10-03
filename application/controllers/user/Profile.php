<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('User_model', 'user');
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama tidak boleh kosong.'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'User Profile',
                'subtitle' => 'Profile',
                'subtitle2' => 'Data User',
                'users' => $this->user->getDetailUsers($this->session->userdata('id_users')),
            ];

            $this->load->view('user/profile/index', $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
            ];
            // jika ada password 
            $password = $this->input->post('password');
            if ($password) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
           
            $this->user->update_user($this->session->userdata('id_users'), $data);
            $this->session->set_flashdata("message", "Toast.fire({icon: 'success',title: 'Success'})");
            redirect(base_url('user/profile'));
        }
    }
}

/* End of file User.php */
