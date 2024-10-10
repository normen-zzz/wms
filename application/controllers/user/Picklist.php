<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Picklist extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Picklist_model', 'picklist');
	}

	public function index()
	{
		$data = [
			'title' => 'Picklist',
			'subtitle' => 'Data Picklist',
			'subtitle2' => 'Data Picklist',
			'pl' => $this->picklist->getDataPicklist(),
		];
		$this->load->view('user/picklist/index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Picklist',
			'subtitle' => 'Add Picklist',
			'subtitle2' => 'Add Picklist',

		];
		$this->load->view('user/picklist/addPicklist', $data);
	}

	public function getDataBarangSelect()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->picklist->selectBarang($searchTerm);

		echo json_encode($response);
	}


	public function insertPicklist()
	{
			$this->db->trans_start();

			try {
					$no_picklist = generate_picklist_number();
					$created_by = $this->session->userdata('id_users');
					$status = 0;

					$picklist_data = array(
							'no_picklist' => $no_picklist,
							'uuid' => uniqid(),
							'created_at' => date('Y-m-d H:i:s'),
							'created_by' => $created_by,
							'status' => $status
					);

					$insert_id = $this->picklist->insert_picklist($picklist_data);

					if ($insert_id) {
							$barang_ids = $this->input->post('barang');
							$qtys = $this->input->post('qty');
							$batches = $this->input->post('batch');
							$expired_dates = $this->input->post('ed');

							if (is_array($barang_ids) && !empty($barang_ids)) {
									foreach ($barang_ids as $key => $barang_id) {
											$checkBatchItem = $this->db->query('SELECT id_batchitem, batch.id_batch, batchitem.qty 
																													FROM batchitem 
																													INNER JOIN batch ON batchitem.id_batch = batch.id_batch 
																													WHERE batch.batchnumber = "' . $batches[$key] . '" 
																													AND batchitem.id_barang = ' . $barang_id);

																													
																													if ($checkBatchItem->num_rows() == 0) {
													$checkBatch = $this->db->query('SELECT id_batch FROM batch WHERE batchnumber = "' . $batches[$key] . '"');
													if ($checkBatch->num_rows() == 0) {

															$this->db->insert('batch', [
																	'uuid' => uniqid(),
																	'batchnumber' => $batches[$key],
																	'expiration_date' => date('Y-m-d H:i:s', strtotime($expired_dates[$key]))
															]);
															$id_batch =  $this->db->insert_id();
													} else {
															$id_batch = $checkBatch->row()->id_batch;
													}

													$dataBatchItem = [
															'id_barang' => $barang_id,
															'id_batch' => $id_batch,
															'qty' => $qtys[$key]
													];
													$this->db->insert('batchitem', $dataBatchItem);
											} else {
													$checkBatchItem = $checkBatchItem->row_array();
													$id_batch = $checkBatchItem['id_batch'];
													$current_qty = $checkBatchItem['qty'];

													$new_qty = $current_qty + $qtys[$key];
													$this->db->update('batchitem', ['qty' => $new_qty], ['id_batchitem' => $checkBatchItem['id_batchitem']]);
											}

											$datapicklist_data = array(
												'id_picklist' => $insert_id,
												'id_barang' => $barang_id,
												'batch' => $id_batch,
												'qty' => $qtys[$key],
												'created_at' => date('Y-m-d H:i:s'),
												'created_by' => $created_by,
												'expiration_date' =>  date('Y-m-d', strtotime($expired_dates[$key]))
											);
											
											$this->picklist->insert_datapicklist($datapicklist_data);
											// debug transaction
											// var_dump($datapicklist_data);exit;
									}

									$this->db->trans_complete();

									if ($this->db->trans_status() === FALSE) {
											throw new Exception('Transaction failed');
									}

									$response = array('status' => 'success', 'message' => 'Picklist inserted successfully.');
							} else {
									throw new Exception('No items to process.');
							}
					} else {
							throw new Exception('Failed to insert picklist.');
					}
			} catch (Exception $e) {
					$this->db->trans_rollback();
					$response = array('status' => 'error', 'message' => $e->getMessage());
			}

			echo json_encode($response);
	}


	// delete
	public function delete()
	{
		$id_picklist = $this->input->post('id_picklist');
		$deleted_by = $this->session->userdata('id_users');

		$data = array(
			'is_deleted' => 1,
			'deleted_at' => date('Y-m-d H:i:s'),
			'deleted_by' => $deleted_by
		);

		// var_dump($id_picklist);exit;

		$this->picklist->delete_picklist($id_picklist, $data);
		$response = array('status' => 'success', 'message' => 'Picklist deleted successfully.');
		echo json_encode($response);
	}

	// edit

	public function get_picklist_details()
	{
		$id_picklist = $this->input->get('id_picklist');
		$picklist = $this->picklist->get_picklist_with_details($id_picklist);

		echo json_encode($picklist);
	}


	public function update()
	{
		$id_picklist = $this->input->post('id_picklist');
		$updated_by = $this->session->userdata('id_users');

		$data_picklist = array(
			'no_picklist' => $this->input->post('no_picklist'),
			'updated_at' => date('Y-m-d H:i:s'),
			'status' => $this->input->post('status'),
			'updated_by' => $updated_by
		);

		$data_details = array(
			'qty' => $this->input->post('qty'),
			'batch' => $this->input->post('batch'),
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $updated_by
		);

		$this->picklist->update_picklist($id_picklist, $data_picklist);
		$this->picklist->update_details($id_picklist, $data_details);

		$response = array('status' => 'success', 'message' => 'Picklist updated successfully.');
		echo json_encode($response);
	}

	public function saveManualBatch()
	{
		$barangId = $this->input->post('barangId');
		$manualBatch = $this->input->post('manualBatch');
		$expirationDate = $this->input->post('expirationDate');
		$qty = $this->input->post('qty');

		$dateParts = explode('-', $expirationDate);
		if (count($dateParts) == 3) {
			$expirationDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
		}

		if (!empty($barangId) && !empty($manualBatch) && !empty($expirationDate) && !empty($qty)) {
			$batchData = [
				'batchnumber' => $manualBatch,
				'expiration_date' => $expirationDate,
				'qty' => (int)$qty,
				'uuid' => uniqid(),
			];

			if ($this->db->insert('batch', $batchData)) {
				$batchId = $this->db->insert_id();

				$batchItemData = [
					'id_batch' => $batchId,
					'id_barang' => (int)$barangId,
					'qty' => (int)$qty,
				];

				if ($this->db->insert('batchitem', $batchItemData)) {
					echo json_encode(['status' => 'success']);
				} else {
					echo json_encode(['status' => 'error', 'message' => 'Failed to insert into batchitem: ' . $this->db->last_query()]);
				}
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Database error on batch insert: ' . $this->db->last_query()]);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
		}
	}

	// detail
	public function detail($id_picklist)
	{
		$data = [
			'title' => 'Picklist',
			'subtitle' => 'Detail Picklist',
			'subtitle2' => 'Detail Picklist',
			'pl' => $this->picklist->get_picklist_by_id($id_picklist),
		];
		$this->load->view('user/picklist/detailPicklist', $data);
	}
}

/* End of file User.php */
