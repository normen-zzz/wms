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

	public function pick($uuid) {
    $data = [
        'title' => 'Pickingslip',
        'subtitle' => 'pick Pickingslip',
        'subtitle2' => 'pick Pickingslip',
    ];

    $picking_slip = $this->pickingslip->get_by_uuid($uuid);
    
    $items = $this->pickingslip->get_items_by_pickingslip($picking_slip['id_pickingslip']);

    $data['picking_slip'] = $picking_slip;
    $data['items'] = $items;
   


    $this->load->view('user/pickingslip/pick', $data);
	}

	public function getAvailableRack()
	{
		$id_barang = $this->input->post('id_barang');
		$id_batch = $this->input->post('id_batch');
		
		$recommendations = $this->Pickingslip_model->getAvailableRack($id_barang,$id_batch);

		echo json_encode($recommendations);
	}

}

/* End of file User.php */
