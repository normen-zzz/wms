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
		$putaway_data = json_decode(file_get_contents('php://input'), true);

		if (!empty($putaway_data) && isset($putaway_data['putaway_field'])) {
			foreach ($putaway_data['putaway_field'] as $id_barang => $item_data) {
				if (isset($item_data['id_barang'], $item_data['batch_id'], $item_data['id_inbound'], $item_data['rack_ids'], $item_data['quantities'], $item_data['id_putaway'])) {

					$rack_ids = $item_data['rack_ids'];
					$quantities = $item_data['quantities'];

					if (count($rack_ids) === count($quantities)) {
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

							if ($this->db->insert('dataputaway', $insert_data)) {
								$this->Putaway_model->assign_rack_to_item($get_Rack_id, $item_data['id_barang'], $quantity, $item_data['batch_id']);
							} else {
								echo json_encode([
									'status' => 'error',
									'message' => 'Failed to insert data into dataputaway table.'
								]);
								return;
							}
						}
					} else {
						echo json_encode([
							'status' => 'error',
							'message' => 'Rack IDs and Quantities count do not match for item ' . $id_barang
						]);
						return;
					}
				} else {
					echo json_encode([
						'status' => 'error',
						'message' => 'Invalid data structure for item ' . $id_barang
					]);
					return;
				}
			}

			echo json_encode([
				'status' => 'success',
				'message' => 'Putaway and DataPutaway processed successfully.'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Invalid or empty putaway data received.'
			]);
		}
	}


	public function finish_putaway()
	{
			$this->db->where('status', 1);
			$this->db->update('dataputaway', ['status' => 2]); 

			if ($this->db->affected_rows() > 0) {
					echo json_encode(['status' => 'success', 'message' => 'Putaway completed.']);
			} else {
					echo json_encode(['status' => 'error', 'message' => 'No putaway records found to update.']);
			}
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
