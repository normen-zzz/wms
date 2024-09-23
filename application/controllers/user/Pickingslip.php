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

	public function detail($uuid) {
    $data = [
        'title' => 'Pickingslip',
        'subtitle' => 'Detail Pickingslip',
        'subtitle2' => 'Detail Pickingslip',
    ];

    $picking_slip = $this->pickingslip->get_by_uuid($uuid);
    
    $items = $this->pickingslip->get_items_by_pickingslip($picking_slip['id_pickingslip']);
    
    $rack_info = [];
    
    foreach ($items as $item) {
        $sku = $item['sku'];
        $batch = $item['id_batch']; 
        $available_racks = $this->pickingslip->getAvailableRacksBySkuAndBatch($sku, $batch);

        $rack_info[$sku] = $available_racks; 
    }

    $data['picking_slip'] = $picking_slip;
    $data['items'] = $items;
    $data['rack_info'] = $rack_info;

    $this->load->view('user/pickingslip/detail', $data);
	}



	
}

/* End of file User.php */
