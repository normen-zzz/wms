<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
		
		$data = [
			'title' => 'Dashboard',
			'subtitle' => 'Dashboard',
			'subtitle2' => 'User',
			
		];
		$this->load->view('user/dashboard/index', $data);
	}

	
}

/* End of file User.php */
