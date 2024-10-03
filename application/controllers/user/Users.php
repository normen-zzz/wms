<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $data = [
            'title' => 'Users',
            'subtitle' => 'User',
            'subtitle2' => 'Data User',
			'roles' => $this->db->get('roles')->result_array()
        ];
        $this->load->view('user/user/index', $data);
    }

    public function get_all_users() {
        $users = $this->User_model->get_all_users();
        echo json_encode($users);
    }

    public function get_user($id) {
        $user = $this->User_model->get_user($id);
        echo json_encode($user);
    }

	public function create() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
			'required' => 'Username harus diisi.',
			'is_unique' => 'Username sudah digunakan.'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'required', [
			'required' => 'Nama harus diisi.'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
			'required' => 'Password harus diisi.',
			'min_length' => 'Password harus memiliki minimal 6 karakter.'
		]);
		
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]', [
			'required' => 'Konfirmasi password harus diisi.',
			'matches' => 'Konfirmasi password tidak cocok dengan password.'
		]);
		$this->form_validation->set_rules('role_id', 'Role ID', 'required|integer', [
			'required' => 'Role harus diisi.',
			'integer' => 'Role harus berupa angka.'
		]);

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors(); 
			echo json_encode(['success' => false, 'message' => $errors]);
			return;
		}

		$data = [
			'username' => $this->input->post('username'),
			'nama' => $this->input->post('nama'),
			
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			'role_id' => $this->input->post('role_id'),
			'created_at' => date('Y-m-d H:i:s'),
		];

		$this->load->model('User_model');
		$result = $this->User_model->insert_user($data);
		echo json_encode(['success' => $result]);
	}



    public function edit($id) {
		
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'role_id' => $this->input->post('role_id'),
        ];
		if ($this->input->post('password')) {
			$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		}
        $result = $this->User_model->update_user($id, $data);
        echo json_encode(['success' => $result]);
    }

    public function delete($id) {
        $result = $this->User_model->delete_user($id);
        echo json_encode(['success' => $result]);
    }

	// logout 
	public function logout()
	{
		if ($this->session->sess_destroy() == TRUE) {
			$this->session->set_flashdata('message', 'swal("Berhasil!", "Berhasil Logout!", "success");');
		}
		redirect(base_url('auth'));
	}
}
