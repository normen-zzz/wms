<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inbound extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		$this->load->model('ReceivingInbound_model');
		
	}

	public function index()
	{
		$data = [
			'title' => 'Inbound',
			'subtitle' => 'Data Inbound',
			'subtitle2' => 'Data Inbound',
			'inbound_data' => $this->ReceivingInbound_model->get_inbound_data()
		];

		$this->load->view('user/inbound/index', $data);
	}


	public function add()
	{
		$data = [
			'title' => 'Inbound',
			'subtitle' => 'Add Inbound',
			'subtitle2' => 'Add Inbound',
		];
		$this->load->view('user/inbound/add', $data);
	}


	public function create($uuid)
	{

		$detailPl = $this->ReceivingInbound_model->getPicklistDetail($uuid);
		$picklist = $this->ReceivingInbound_model->get_picklist_byuuid($uuid);

		$data = [
			'title' => 'inbound',
			'subtitle' => 'Data inbound',
			'subtitle2' => 'Data inbound',
			'detailPl' => $detailPl,
			'uuid' => $uuid,
			'picklist' => $picklist,
		];
		$this->load->view('user/inbound/createInbound', $data);
	}


	public function process()
	{
		$this->db->trans_start();
		try {
			$id_picklist = $this->input->post('id_picklist');
			$received_qty = $this->input->post('received_qty');
			$status = $this->input->post('status');
			$created_by = $this->session->userdata('id_users');
			$good_qty = $this->input->post('good_qty');
			$bad_qty = $this->input->post('bad_qty');
			$batch_id = $this->input->post('batch_id');
			$no_inbound = generate_inbound_number();
			$id_barang = $this->input->post('id_barang');

			foreach ($good_qty as $index => $good) {
				// Prepare data for the inbound table
				$data_inbound = array(
					'id_picklist' => $id_picklist,
					'no_inbound' => $no_inbound,
					'received_qty' => $received_qty,
					'received_date' => date('Y-m-d'),
					'status' => 'received',
					'good_qty' => $good,
					'bad_qty' => $bad_qty[$index],
					'batch_id' => $batch_id[$index],
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => $created_by,
					'uuid' => uniqid(),
				);
				$insertInbound = $this->ReceivingInbound_model->insert_inbound($data_inbound);
				if ($insertInbound) {
					if ($bad_qty[$index] > 0) {
						$data_damage = array(
							'no_picklist' => $id_picklist,
							'no_inbound' => $no_inbound,
							'id_barang' => $id_barang[$index],
							'id_batch' => $batch_id[$index],
							'qty' => $bad_qty[$index],
							'uuid' => uniqid(),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
						);
						$insertDamageInbound = $this->ReceivingInbound_model->insert_damage($data_damage);
						if ($insertDamageInbound) {
							$id_rack = $this->db->query('SELECT id_rack FROM rack WHERE sloc = "STAGING DAMAGE"')->row_array();
							$checkRackItems = $this->db->query('SELECT * FROM rack_items WHERE id_barang = "' . $id_barang[$index] . '" AND id_batch = "' . $batch_id[$index] . '" AND id_rack = "' . $id_rack['id_rack'] . '"');
							if ($checkRackItems->num_rows() > 0) {
								$checkRackItems = $checkRackItems->row_array();
								$updateRackItemsDamage = $this->db->update('rack_items', ['quantity' => $checkRackItems['quantity'] +  $bad_qty[$index]], ['id' => $checkRackItems['id']]);
								if (!$updateRackItemsDamage) {
									throw new Exception('Failed to insert damage to rack items.');
								}
							} else {
								$dataDamageRackItems = [
									'id_barang' => $id_barang[$index],
									'id_batch' => $batch_id[$index],
									'id_rack' => $id_rack['id_rack'],
									'quantity' => $bad_qty[$index],
									'created_at' => date('Y-m-d H:i:s'),
									'created_by' => $created_by,
								];
								$insertToRackItemsDamage = $this->db->insert('rack_items', $dataDamageRackItems);
								if (!$insertToRackItemsDamage) {
									throw new Exception('Failed to insert damage to rack items.');
								}
							}
						} else {
							throw new Exception('Failed to insert damage.');
						}
					}
				} else {
					throw new Exception('Failed to insert inbound.');
				}
			}

			$updateStatus = $this->ReceivingInbound_model->update_status_picklist($id_picklist, 1);
			if ($updateStatus) {
				$response = array('status' => 'success', 'message' => 'Inbound process successfully.');
			} else {
				throw new Exception('Failed to update the picklist status.');
			}

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response = array('status' => 'error', 'message' => $e->getMessage());
		}

		echo json_encode($response);
	}


	// public function processRow() {
	// 		$id_picklist = $this->input->post('id_picklist');

	// 		$existingInbound = $this->ReceivingInbound_model->getInboundByPicklistId($id_picklist);
	// 		// var_dump($existingInbound);exit;

	// 		$received_qty = $this->input->post('received_qty');
	// 		$good_qty = $this->input->post('good_qty');
	// 		$bad_qty = $this->input->post('bad_qty');
	// 		$batch_id = $this->input->post('batch_id');
	// 		$id_barang = $this->input->post('id_barang');
	// 		$created_by = $this->session->userdata('id_users');

	// 		$no_inbound = $existingInbound ? $existingInbound['no_inbound'] : generate_inbound_number();

	// 		$data_inbound = array(
	// 				'id_picklist' => $id_picklist,
	// 				'no_inbound' => $no_inbound,
	// 				'received_qty' => $received_qty,
	// 				'received_date' => date('Y-m-d'),
	// 				'status' => 'received',
	// 				'good_qty' => $good_qty,
	// 				'bad_qty' => $bad_qty,
	// 				'batch_id' => $batch_id,
	// 				'created_at' => date('Y-m-d H:i:s'),
	// 				'created_by' => $created_by,
	// 				'uuid' => uniqid(),
	// 		);

	// 		$this->ReceivingInbound_model->insert_inbound($data_inbound);

	// 		if ($bad_qty > 0) {
	// 				$data_damage = array(
	// 						'no_picklist' => $id_picklist,
	// 						'no_inbound' => $no_inbound,
	// 						'id_barang' => $id_barang,
	// 						'id_batch' => $batch_id,
	// 						'qty' => $bad_qty,
	// 						'uuid' => uniqid(),
	// 						'created_at' => date('Y-m-d H:i:s'),
	// 						'updated_at' => date('Y-m-d H:i:s'),
	// 				);

	// 				$this->ReceivingInbound_model->insert_damage($data_damage);
	// 		}
	// 		$response = array('status' => 'success', 'message' => 'Inbound processed successfully.');
	// 		echo json_encode($response);
	// }

	public function processRow()
	{
		$this->db->trans_start();

		try {
			$id_picklist = $this->input->post('id_picklist');
			$existingInbound = $this->ReceivingInbound_model->getInboundByPicklistId($id_picklist);

			$received_qty = $this->input->post('received_qty');
			$good_qty = $this->input->post('good_qty');
			$bad_qty = $this->input->post('bad_qty');
			$batch_id = $this->input->post('batch_id');
			$id_barang = $this->input->post('id_barang');
			$created_by = $this->session->userdata('id_users');
			$id_datapicklist = $this->input->post('id_datapicklist');

			if ($existingInbound) {
				$id_inbound = $existingInbound['id_inbound'];
				$no_inbound = $existingInbound['no_inbound'];
			} else {
				$no_inbound = generate_inbound_number();
				$data_inbound = array(
					'id_picklist' => $id_picklist,
					'no_inbound' => $no_inbound,
					'status' => 'received',
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => $created_by,
					'uuid' => uniqid(),
				);
				$id_inbound = $this->ReceivingInbound_model->insert_inbound($data_inbound);
			}

			$data_details = array(
				'id_inbound' => $id_inbound,
				'received_qty' => $received_qty,
				'received_date' => date('Y-m-d'),
				'good_qty' => $good_qty,
				'bad_qty' => $bad_qty,
				'batch_id' => $batch_id,
				'id_barang' => $id_barang,
			);

			// update status_row in datapicklist
			$this->ReceivingInbound_model->update_status_row($id_datapicklist, 1);

			$this->ReceivingInbound_model->insert_data_inbound($data_details);

			if ($bad_qty > 0) {
				$data_damage = array(
					'no_picklist' => $id_picklist,
					'no_inbound' => $no_inbound,
					'id_barang' => $id_barang,
					'id_batch' => $batch_id,
					'qty' => $bad_qty,
					'uuid' => uniqid(),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				);
				$this->ReceivingInbound_model->insert_damage($data_damage);
				$rackDamage = $this->db->query('SELECT id_rack FROM rack WHERE sloc = "STAGING DAMAGE"')->row_array();
				$checkRackItems = $this->db->query('SELECT * FROM rack_items WHERE id_barang = "' . $id_barang . '" AND id_batch = "' . $batch_id . '" AND id_rack = "' . $rackDamage['id_rack'] . '"');
				if ($checkRackItems->num_rows() > 0) {
					$checkRackItems = $checkRackItems->row_array();
					$updateRackItemsDamage = $this->db->update('rack_items', ['quantity' => $checkRackItems['quantity'] +  $bad_qty], ['id' => $checkRackItems['id']]);
					if (!$updateRackItemsDamage) {
						throw new Exception('Failed to insert damage to rack items.');
					}
				} else {
					$dataDamageRackItems = [
						'id_barang' => $id_barang,
						'id_batch' => $batch_id,
						'id_rack' => $rackDamage['id_rack'],
						'quantity' => $bad_qty,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $created_by,
					];
					$insertToRackItemsDamage = $this->db->insert('rack_items', $dataDamageRackItems);
					if ($insertToRackItemsDamage) {
						// log 
						$dataLog = [
							'id_barang' => $id_barang,
							'id_batch' => $batch_id,
							'id_rack' => $rackDamage['id_rack'],
							'condition' => 'in',
							'qty' => $bad_qty,
							'at' => date('Y-m-d H:i:s'),
							'by' => $created_by,
							'no_document' => $no_inbound,
							'description' => 'Barang Damage dari Inbound',
						];
						$insertLog = $this->db->insert('wms_log', $dataLog);
						if (!$insertLog) {
							throw new Exception('Failed to insert log.');
						}
					} else {
						throw new Exception('Failed to insert damage to rack items.');
					}
				}
			}
			$response = array('status' => 'success', 'message' => 'Inbound processed successfully.');

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response = array('status' => 'error', 'message' => 'Error processing inbound: ' . $e->getMessage());
		}

		echo json_encode($response);
	}

	public function finishInbound()
	{
		$id_picklist = $this->input->post('id_picklist');

		$inboundItems = $this->ReceivingInbound_model->get_inbound_items_by_picklist($id_picklist);
		if (empty($inboundItems)) {
			$response = array('status' => 'error', 'message' => 'No inbound items found for this picklist.');
			echo json_encode($response);
			return;
		}

		$update_status = $this->ReceivingInbound_model->update_status_picklist($id_picklist, 1);
		// update status inbound 
		$this->ReceivingInbound_model->updateStatusInbound($id_picklist, 0);
		// $update_status_row = $this->ReceivingInbound_model->update_status_row($id_picklist, 1);

		if ($update_status) {
			$response = array('status' => 'success', 'message' => 'Inbound process has been successfully completed.');
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to update the picklist status.');
		}

		echo json_encode($response);
	}


	public function getDataPicklist()
	{
		if ($this->input->is_ajax_request()) {
			$searchTerm = $this->input->post('searchTerm');
			$data = $this->ReceivingInbound_model->get_picklist($searchTerm);
			echo json_encode($data);
		} else {
			show_error('No direct script access allowed', 403);
		}
	}

	public function getBatchData()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id');
			$data = $this->ReceivingInbound_model->get_batch($id);
			echo json_encode($data);
		} else {
			show_error('No direct script access allowed', 403);
		}
	}

	// detail
	public function detail($uuid)
	{
		$inbound = $this->ReceivingInbound_model->get_inbound_byuuid($uuid);
		$inbound_details = $this->ReceivingInbound_model->getDataInbound($uuid);

		$data = [
			'title' => 'Inbound',
			'subtitle' => 'Detail Inbound',
			'subtitle2' => 'Detail Inbound',
			'inbound' => $inbound,
			'inbound_details' => $inbound_details,
		];

		// Load the view with the data
		$this->load->view('user/inbound/detail', $data);
	}
}
