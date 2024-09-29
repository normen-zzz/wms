<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('RackItems_model');
	}

	public function index()
	{
		$data = [
			'title' => 'Inventory',
			'subtitle' => 'Data Inventory',
			'subtitle2' => 'Data Inventory',
			'rack_items' =>  $this->RackItems_model->get_all_rack_items()
		];
		$this->load->view('user/inventory/index', $data);
	}

	// Delete a rack item
	public function delete($id)
	{
		$this->RackItems_model->delete_rack_item($id);
		redirect('inventory');
	}
}
