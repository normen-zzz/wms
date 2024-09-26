<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Putaway extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Putaway_model');
    }

	public function index(){
		$data = [
			'title' => 'Puataway',
			'subtitle' => 'Detail Puataway',
			'subtitle2' => 'Detail Puataway',
			'putaway' => $this->Putaway_model->get_all_putaways()
    	];

		$this->load->view('user/putaway/index', $data);
	}

	// create putaway
	public function create($uuid)
	{

		$putaway_details = $this->Putaway_model->get_putaway_details($uuid);
		$inbound = $this->Putaway_model->get_id_inbound($uuid);

		$data = [
			'title' => 'Inbound',
			'subtitle' => 'Data inbound',
			'subtitle2' => 'Data inbound',
			'putaway_details' => $putaway_details,
			'uuid' => $uuid,
			'get_id_inbound' => $inbound,
		];

		// var_dump($data);exit;

		$this->load->view('user/putaway/createPutaway', $data);
	}

	public function get_rack_recommendations() {
		$id_barang = $this->input->post('id_barang');
		$quantity = $this->input->post('quantity');
		
		$recommendations = $this->Putaway_model->get_rack_recommendations($id_barang, $quantity);
		// var_dump($recommendations);exit;
		
		echo json_encode($recommendations);
	}	

	public function assign_rack() {
		$rack_id = $this->input->post('rack_id');
		$id_barang = $this->input->post('id_barang');
		$quantity = $this->input->post('quantity');
		$batch_id = $this->input->post('batch_id');

		$result = $this->Putaway_model->assign_rack_to_item($rack_id, $id_barang, $quantity, $batch_id);

		if ($result) {
			echo json_encode(['success' => true]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to assign rack']);
		}
	}

	public function create_putaway() {
		$putaway_data = $this->input->post('putaway_field');

		$this->db->trans_begin(); 
		foreach ($putaway_data as $item) {
			$rack_id = $item['id_rack'];
			$quantity = $item['quantity'];
			$id_barang = $item['id_barang'];
			$batch_id = $item['batch_id'];
			
			$this->db->insert('putaway', [
				'id_putaway' => generate_putaway_number(),
				'id_inbound' => $item['id_inbound'],
				'id_rack' => $rack_id,
				'qty_putaway' => $quantity,
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('id_users'),
				'uuid' => $this->input->post('uuid'),
				'id_barang' => $id_barang,
				'batch_id' => $batch_id,
				'status' => 1,
				'uuid' => uniqid()
			]);
		}

		$this->Putaway_model->assign_rack_to_item($rack_id, $id_barang, $quantity, $batch_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(['status' => 'error', 'message' => 'Transaction failed']);
		} else {
			$this->db->trans_commit();
			echo json_encode(['status' => 'success', 'message' => 'Putaway and DataPutaway processed successfully']);
		}
	}



}
