<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Putaway extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Putaway_model');
	}

	public function index()
	{
		$data = [
			'title' => 'Putaway',
			'subtitle' => 'Data Putaway',
			'subtitle2' => 'Data Putaway',
			'putaway' => $this->Putaway_model->get_all_putaways()
		];

		$this->load->view('user/putaway/index', $data);
	}

	public function assign($uuid)
	{
		$inbound = $this->db->get_where('inbound', ['uuid' => $uuid])->row();
		$inbound_details = $this->Putaway_model->getDataInbound($uuid);

		$data = [
			'title' => 'Putaway',
			'subtitle' => 'Assign Putaway',
			'subtitle2' => 'Assign Putaway',
			'putaway_users' => $this->Putaway_model->get_all_user_putaways(),
			'get_id_inbound' => $inbound,
			'inbound_details' => $inbound_details
		];

		// var_dump($data);exit;

		$this->load->view('user/putaway/assignPutaway', $data);
	}

	public function assign_putaway()
	{

		$no_putaway = generate_putaway_number();

		$data = [
			'id_users' => $this->input->post('assign_user'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_users'),
			'status' => 1,
			'no_putaway' => $no_putaway,
			'id_inbound' => $this->input->post('id_inbound'),
			'uuid' => uniqid()
		];

		// var_dump($data);exit;s

		$result = $this->Putaway_model->insert_assign_putaway($data);

		if ($result) {
			// update status inbound to 1 
			$this->Putaway_model->updateStatusInbound($this->input->post('id_inbound'), 1);
			$this->session->set_flashdata('success', 'Data Putaway has been added');
			redirect('user/putaway');
		} else {
			$this->session->set_flashdata('error', 'Data Putaway failed to add');
			redirect('user/putaway');
		}
	}

	// create putaway
	public function create($uuid)
	{

		// $putaway_details = $this->Putaway_model->get_putaway_details($uuid);
		// $inbound = $this->Putaway_model->get_id_inbound($uuid);
		$data_putaway = $this->Putaway_model->get_putaway_details($uuid);
		// var_dump($data_putaway);exit;

		$data = [
			'title' => 'Putaway',
			'subtitle' => 'Create Putaway',
			'subtitle2' => 'Create Putaway',
			'data_putaway' => $data_putaway,
			'uuid' => $uuid,
		];


		$this->load->view('user/putaway/createPutaway', $data);
	}

	public function get_rack_recommendations()
	{
		$quantity = $this->input->post('quantity');
		$recommendations = $this->Putaway_model->get_rack_recommendations($quantity);

		echo json_encode($recommendations);
	}

	public function assign_rack()
	{
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

	public function create_putaway()
	{
			$this->db->trans_start();

			try {
					$putaway_data = json_decode(file_get_contents('php://input'), true);

					if (empty($putaway_data) || !isset($putaway_data['putaway_field'])) {
							throw new Exception('Invalid or empty putaway data received.');
					}

					foreach ($putaway_data['putaway_field'] as $id_barang => $item_data) {
							if (!isset($item_data['id_barang'], $item_data['batch_id'], $item_data['id_inbound'], $item_data['rack_ids'], $item_data['quantities'], $item_data['id_putaway'])) {
									throw new Exception('Invalid data structure for item ' . $id_barang);
							}

							$rack_ids = $item_data['rack_ids'];
							$quantities = $item_data['quantities'];

							if (count($rack_ids) !== count($quantities)) {
									throw new Exception('Rack IDs and Quantities count do not match for item ' . $id_barang);
							}

							foreach ($rack_ids as $index => $rack_id) {
									$quantity = isset($quantities[$index]) ? $quantities[$index] : 0;
									$get_Rack_id = $this->db->get_where('rack', ['sloc' => $rack_id])->row()->id_rack;

									$insert_data = [
											'id_putaway' => $item_data['id_putaway'],
											'id_inbound' => $item_data['id_inbound'],
											'id_rack' => $get_Rack_id,
											'qty_putaway' => $quantity,
											'created_at' => date('Y-m-d H:i:s'),
											'created_by' => $this->session->userdata('id_users'),
											'uuid' => uniqid(),
											'id_barang' => $item_data['id_barang'],
											'batch_id' => $item_data['batch_id'],
											'status' => 1,
											'status_row' => 1
									];

									// Update status putaway per row
									$this->db->where('id_data_inbound', $item_data['id_data_inbound']);
									$this->db->update('data_inbound', ['status_putaway' => 1]);

									if (!$this->db->insert('dataputaway', $insert_data)) {
											throw new Exception('Failed to insert data into dataputaway table.');
									}

									$this->Putaway_model->assign_rack_to_item($get_Rack_id, $item_data['id_barang'], $quantity, $item_data['batch_id']);
									
									$getNoPutaway = $this->db->query('SELECT no_putaway FROM putaway WHERE id_putaway = ' . $item_data['id_putaway'])->row()->no_putaway;    
									
									// Log
									$log_data = [
											'id_barang' => $item_data['id_barang'],
											'id_batch' => $item_data['batch_id'],
											'id_rack' => $get_Rack_id,
											'condition' => 'in',
											'qty' => $quantity,
											'at' => date('Y-m-d H:i:s'),
											'by' => $this->session->userdata('id_users'),
											'no_document' => $getNoPutaway,
									];
									$this->db->insert('wms_log', $log_data);
							}
					}

					$this->db->trans_complete();

					if ($this->db->trans_status() === FALSE) {
							throw new Exception('Transaction failed');
					}

					$response = [
							'status' => 'success',
							'message' => 'Putaway and DataPutaway processed successfully.'
					];
			} catch (Exception $e) {
					$this->db->trans_rollback();
					$response = [
							'status' => 'error',
							'message' => $e->getMessage()
					];
			}

			echo json_encode($response);
	}

	public function finishPutaway()
	{
			$id_putaway = $this->input->post('id_putaway');

			$inboundItems = $this->Putaway_model->get_inbound_items_by_putaway($id_putaway);
			if (empty($inboundItems)) {
					$response = array('status' => 'error', 'message' => 'No inbound items found for this picklist.');
					echo json_encode($response);
					return;
			}

			$update_status = $this->Putaway_model->update_status_putaway($id_putaway, 2);  
			// $update_status_row = $this->ReceivingInbound_model->update_status_row($id_putaway, 1);
			
			if ($update_status) {
					$response = array('status' => 'success', 'message' => 'Putaway process has been successfully completed.');
			} else {
					$response = array('status' => 'error', 'message' => 'Failed to update the picklist status.');
			}

			echo json_encode($response);
	}

	public function detail($uuid)
	{
		$putaway_details = $this->Putaway_model->get_details_putaway($uuid);


		$data = [
			'title' => 'Putaway',
			'subtitle' => 'Detail Putaway',
			'subtitle2' => 'Detail Putaway',
			'putaway_details' => $putaway_details,
		];
		
		// var_dump($data);exit;
		// Load the view with the data
		$this->load->view('user/putaway/detailPutaway', $data);
	}

	public function update_status()
	{
		$id = $this->input->post('id_dataputaway');

		if ($id) {
			$this->db->where('id_dataputaway', $id);
			$this->db->update('dataputaway', ['status' => 2]);
			echo json_encode([
				'status' => 'success',
				'message' => 'Status updated successfully.'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'No ID provided.'
			]);
		}
	}
}
