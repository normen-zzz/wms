<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Picklist extends CI_Controller
{

	public function __construct()
	{
		
		parent::__construct();
		is_login();
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		date_default_timezone_set('Asia/Jakarta');
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
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
						// $checkBatchItem = $this->db->query('SELECT id_batchitem, batch.id_batch, batchitem.qty, batch.expiration_date 
						// 																								FROM batchitem 
						// 																								INNER JOIN batch ON batchitem.id_batch = batch.id_batch 
						// 																								WHERE batch.batchnumber = "' . $batches[$key] . '" 
						// 																								AND batchitem.id_barang = "' . $barang_id . '"');

						$checkBatchItem  = $this->db->query('SELECT a.id_barang,a.id_batch,a.qty,c.batchnumber,c.expiration_date FROM rack_items a
																								INNER JOIN batch c ON a.id_batch = c.id_batch
																								WHERE a.id_barang = "' . $barang_id . '" AND c.batchnumber = "' . trim($batches[$key])  . '"');

						if ($checkBatchItem->num_rows() > 0) {
							$existingBatch = $checkBatchItem->row_array();
							$id_batch = $existingBatch['id_batch'];
							$current_qty = $existingBatch['qty'];
							$existing_expiration_date = $existingBatch['expiration_date'];

							if (date('Y-m-d', strtotime($expired_dates[$key])) !== date('Y-m-d', strtotime($existing_expiration_date))) {
								$this->db->insert('batch', [
									'uuid' => uniqid(),
									'batchnumber' => $batches[$key],
									'expiration_date' => date('Y-m-d H:i:s', strtotime($expired_dates[$key]))
								]);
								$id_batch = $this->db->insert_id();
								$dataBatchItem = [
									'id_barang' => $barang_id,
									'id_batch' => $id_batch,
									'qty' => $qtys[$key]
								];
								$this->db->insert('batchitem', $dataBatchItem);
							} else {
								$new_qty = $current_qty + $qtys[$key];
								$this->db->update('batchitem', ['qty' => $new_qty], ['id_batchitem' => $existingBatch['id_batchitem']]);
							}
						} else {
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
						}

						$datapicklist_data = array(
							'id_picklist' => $insert_id,
							'id_barang' => $barang_id,
							'batch' => $id_batch,
							'qty' => $qtys[$key],
							'created_at' => date('Y-m-d H:i:s'),
							'created_by' => $created_by,
							'expiration_date' => date('Y-m-d', strtotime($expired_dates[$key]))
						);

						$this->picklist->insert_datapicklist($datapicklist_data);
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

	// insertPicklist2 
	public function insertPicklist2()
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

			$insertPicklist = $this->picklist->insert_picklist($picklist_data);
			if ($insertPicklist) {
				$id_barang = $this->input->post('barang');
				$batch = $this->input->post('batch');
				$qty = $this->input->post('qty');
				$ed = $this->input->post('ed');


				$dataPicklist = [];
				if ($id_barang == null) {
					throw new Exception('Data cannot be empty');
				} else {
					for ($i = 0; $i < sizeof($id_barang); $i++) {

						// check last batch
						// $checkBatch = $this->db->query('SELECT id_batch FROM batch WHERE batchnumber = "' . trim($batch[$i])  . '"');
						$checkBatch = $this->db->query('SELECT b.sku,a.id_batch,c.batchnumber,c.expiration_date,a.id_rack FROM rack_items a JOIN barang b ON a.id_barang = b.id_barang JOIN batch c ON a.id_batch = c.id_batch WHERE c.batchnumber = "' . $batch[$i] . '" AND c.expiration_date = "' . date('Y-m-d', strtotime($ed[$i])) . '" ');
						if ($checkBatch->num_rows() != 0) {
							$checkBatch = $checkBatch->row_array();
							$id_batch_temporary = $checkBatch['id_batch'];


							if ($id_batch_temporary == null) {
								$this->db->insert('batch', [
									'uuid' => uniqid(),
									'batchnumber' => $batch[$i],
									'expiration_date' => date('Y-m-d', strtotime($ed[$i]))
								]);
								$id_batch = $this->db->insert_id();
							} else {
								$id_batch = $id_batch_temporary;
							}
						} else {
							$this->db->insert('batch', [
								'uuid' => uniqid(),
								'batchnumber' => $batch[$i],
								'expiration_date' => date('Y-m-d', strtotime($ed[$i]))
							]);
							$id_batch = $this->db->insert_id();
						}

						$dataPicklist[] = [
							'id_picklist' => $insertPicklist,
							'id_barang' => $id_barang[$i],
							'batch' => $id_batch,
							'qty' => $qty[$i],
							'created_at' => date('Y-m-d H:i:s'),
							'created_by' => $created_by,
							'expiration_date' => date('Y-m-d', strtotime($ed[$i]))
						];
					}
					$insertDataPicklist = $this->db->insert_batch('datapicklist', $dataPicklist);
					if ($insertDataPicklist) {
						$response = array('status' => 'success', 'message' => 'Picklist inserted successfully.');
					} else {
						throw new Exception('Failed to insert datapicklist.');
					}
				}
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

	// templateImport 
	public function templateImport()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'SKU');
		$sheet->setCellValue('B1', 'BATCH');
		$sheet->setCellValue('C1', 'QTY');
		$sheet->setCellValue('D1', 'ED (01/01/2027)');
		$writer = new Xlsx($spreadsheet);
		$filename = 'template_picklist.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	// dataPicklistImport 
	public function dataPicklistImport()
	{
		$this->db->trans_start();
		try {
			$file = $_FILES['file']['name'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			if ($ext == 'csv') {
				$reader = new Csv();
			} else {
				$reader = new ReaderXlsx();
			}
			$reader->setReadDataOnly(true);
			$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();

			$this->load->library('uuid');
			$dataPicklist = [];
			foreach ($sheetData as $key => $value) {
				if ($key > 0) {
					// pastikan tidak ada data yang kosong 
					if (empty($value[0]) || empty($value[1]) || empty($value[2]) || empty($value[3])) {
						throw new Exception('Data cannot be empty');
					} else {
						$checkSku = $this->db->query('SELECT id_barang,sku,nama_barang FROM barang WHERE sku = "' . $value[0] . '" ');
						if ($checkSku->num_rows() == 0) {
							throw new Exception('SKU ' . $value[0] . ' not found');
						} else {
							$timestamp = ($value[3] - 25569) * 86400;
							$ed = date('Y-m-d', $timestamp);

							$dataPicklist[] = [
								'sku' => $value[0],
								'id_barang' => $checkSku->row()->id_barang,
								'nama_barang' => $checkSku->row()->nama_barang,
								'batch' => str_replace(' ', '', trim($value[1])),
								'qty' => preg_replace('/[^0-9]/', '', str_replace(' ', '', trim($value[2]))),
								'ed' => $ed
							];
						}
						$response = array('status' => 'success', 'message' => 'Data imported successfully.');
					}
				}
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response = array('status' => 'error', 'message' => $e->getMessage());
		}
		if ($response['status'] == 'success') {
			$data = [
				'title' => 'Picklist',
				'subtitle' => 'Add Picklist',
				'subtitle2' => 'Add Picklist',
				'dataPicklist' => $dataPicklist

			];
			$this->load->view('user/picklist/addPicklistImport', $data);
		} else {
			$this->session->set_flashdata('error', $response['message']);
			redirect('user/picklist');
		}
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
