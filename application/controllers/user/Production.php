<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Production_model');
		$this->load->helper('url');
	}

	public function index() {
		$data = [
			'title' => 'Production',
			'subtitle' => 'Production',
			'subtitle2' => 'Data Production',
			'productions' => $this->Production_model->get_all_production(),
		];
		$this->load->view('user/production/index', $data);
	}

	// add
	public function add() {
		$data = [
			'title' => 'Production',
			'subtitle' => 'Production',
			'subtitle2' => 'Add Production',
		];
		$this->load->view('user/production/add', $data);
	}

	// detail
	public function detail($id) {
		$data = [
			'title' => 'Production',
			'subtitle' => 'Production',
			'subtitle2' => 'Detail Production',
			'pl' => $this->Production_model->get_all_production_detail($id), // Fetching the detail based on ID
		];
		$this->load->view('user/production/detail', $data);
	}


	public function get_all_barang() {
		$data = $this->Production_model->get_all_barang();
		echo json_encode($data);
	}

	public function get_all_bundling_skus() {
		$data = $this->Production_model->get_all_bundling_skus();
		echo json_encode($data);
	}
	
	public function get_batches() {
        if ($this->input->method() === 'post') {
            $sku = $this->input->post('sku'); 
            $batches = $this->Production_model->get_batches_by_sku($sku);
			// var_dump($sku);
            echo json_encode($batches);
        } else {
            show_error('No direct access allowed', 403);
        }
  }

	public function submit_bundling() {
    if (!$this->input->is_ajax_request()) {
        exit('No direct script access allowed');
    }

    $skus = $this->input->post('sku');
    $quantities = $this->input->post('quantity');
    $uoms = $this->input->post('uom');
    $batches = $this->input->post('batch');

    $materials = array();
    for ($i = 0; $i < count($skus); $i++) {
        if (!empty($skus[$i]) && !empty($batches[$i])) {
            $qty = floatval($quantities[$i]);
            if ($qty <= 0) {
                echo json_encode(array('success' => false, 'message' => 'Invalid quantity for row ' . ($i + 1)));
                return;
            }

            $materials[] = array(
                'sku' => $skus[$i],
                'quantity' => $qty,
                'uom' => $uoms[$i],
                'batch_id' => $batches[$i]
            );
        }
    }

    if (empty($materials)) {
        echo json_encode(array('success' => false, 'message' => 'No valid materials provided'));
        return;
    }

    $data = array(
        'description' => $this->input->post('description'),
        'materials' => $materials
    );

    $result = $this->Production_model->insert_production($data);
    
    echo json_encode($result);
}

}
?>
