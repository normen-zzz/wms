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
            'subtitle2' => 'Data User'
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
		
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
			'required' => 'Email harus diisi.',
			'valid_email' => 'Alamat email tidak valid.',
			'is_unique' => 'Email sudah digunakan.'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'required', [
			'required' => 'Nama harus diisi.'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
			'required' => 'Password harus diisi.',
			'min_length' => 'Password harus memiliki minimal 6 karakter.'
		]);
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
			'required' => 'Jenis kelamin harus diisi.'
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
			$errors = validation_errors(); // Get validation errors
			echo json_encode(['success' => false, 'message' => $errors]);
			return;
		}

		$data = [
			'email' => $this->input->post('email'),
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			'role_id' => $this->input->post('role_id'),
			'tanggal_masuk' => date('Y-m-d H:i:s'),
		];

		$this->load->model('User_model');
		$result = $this->User_model->insert_user($data);
		echo json_encode(['success' => $result]);
	}



    public function edit($id) {
        $data = [
            'nama' => $this->input->post('nama'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'email' => $this->input->post('email'),
            'role_id' => $this->input->post('role_id'),
        ];
        $result = $this->User_model->update_user($id, $data);
        echo json_encode(['success' => $result]);
    }

    public function delete($id) {
        $result = $this->User_model->delete_user($id);
        echo json_encode(['success' => $result]);
    }
}
