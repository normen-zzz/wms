<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pickingslip extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Pickingslip_model', 'pickingslip');
	}

	public function index()
	{
		$data = [
			'title' => 'Pickingslip',
			'subtitle' => 'Data Pickingslip',
			'subtitle2' => 'Data Pickingslip',
			'ps' => $this->pickingslip->getDataPickingslip(),
		];
		$this->load->view('user/pickingslip/index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Pickingslip',
			'subtitle' => 'Add Pickingslip',
			'subtitle2' => 'Add Pickingslip',
			'customer' => $this->db->get('customer')

		];
		$this->load->view('user/pickingslip/addPickingslip', $data);
	}

	
}

/* End of file User.php */
