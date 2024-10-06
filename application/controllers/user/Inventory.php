<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{

	public function __construct()
	{
		
		
		parent::__construct();
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		$this->load->model('RackItems_model');
	}

	public function index()
	{
		$filters = [
			'sku' => $this->input->get('sku'),
			'batchnumber' => $this->input->get('batchnumber'),
			'sloc' => $this->input->get('sloc')
		];

		$data = [
			'title' => 'Inventory',
			'subtitle' => 'Data Inventory',
			'subtitle2' => 'Data Inventory',
			'rack_items' => $this->RackItems_model->get_all_rack_items($filters)
		];

		$this->load->view('user/inventory/index', $data);
	}


	public function delete($id)
	{
		$this->RackItems_model->delete_rack_item($id);
		redirect('inventory');
	}
}
