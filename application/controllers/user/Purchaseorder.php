<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Purchaseorder extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		is_login();
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Purchaseorder_model', 'purchaseorder');
	}

	public function index()
	{
		$data = [
			'title' => 'Purchaseorder',
			'subtitle' => 'Data Purchaseorder',
			'subtitle2' => 'Data Purchaseorder',
			'po' => $this->purchaseorder->getDataPurchaseorder(),
		];
		$this->load->view('user/purchaseorder/index', $data);
	}

	public function detail($uuidPo)
	{
		$customer = $this->purchaseorder->getCustomerPurchaseorderByUuid($uuidPo);
		$data = [
			'title' => 'Purchaseorder',
			'subtitle' => 'Data Purchaseorder',
			'subtitle2' => 'Data Purchaseorder',
			'detailPo' => $this->purchaseorder->getDetailPurchaseOrderUnpicked($uuidPo),
			'detailPoPicked' => $this->purchaseorder->getDetailPurchaseOrderPicked($uuidPo),
			'uuid' => $uuidPo,
			'customer' => $customer['nama_customer'],
			'userPicker' => $this->purchaseorder->getUserPicker()
		];
		$this->load->view('user/purchaseorder/detailPurchaseorder', $data);
	}

	public function edit($uuidPo)
	{
		$customer = $this->purchaseorder->getCustomerPurchaseorderByUuid($uuidPo);
		$data = [
			'title' => 'Purchaseorder',
			'subtitle' => 'Data Purchaseorder',
			'subtitle2' => 'Data Purchaseorder',
			'detailPo' => $this->purchaseorder->getDetailPurchaseOrder($uuidPo),
			'uuid' => $uuidPo,
			'customer' => $this->db->get('customer'),
			'customerPo' => $customer

		];
		$this->load->view('user/purchaseorder/editPurchaseorder', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Purchaseorder',
			'subtitle' => 'Add Purchaseorder',
			'subtitle2' => 'Add Purchaseorder',
			'customer' => $this->db->get('customer')

		];
		$this->load->view('user/purchaseorder/addPurchaseorder', $data);
	}

	public function getDataBarangSelect()
	{
		$searchTerm = $this->input->post('searchTerm');

		if (!$searchTerm) {
			echo json_encode(['error' => 'No search term']);
			return;
		}
		$response = $this->purchaseorder->selectBarang($searchTerm);

		if (empty($response)) {
			echo json_encode(['error' => 'No data found']);
		} else {
			echo json_encode($response);
		}
	}


	public function insertPurchaseorder()
	{
		$this->db->trans_start();
		try {
			$no_purchaseorder = generate_purchaseorder_number();
			$customer = $this->input->post('customer');
			$created_by = $this->session->userdata('id_users');
			$barang =  $this->input->post('barang');
			$qty = $this->input->post('qty');
			$batch =  $this->input->post('batch');
			$status = 0;
			$purchaseorder = array(
				'uuid' => uniqid(),
				'no_purchaseorder' => $no_purchaseorder,
				'created_at' => date('Y-m-d H:i:s'),
				'customer' => $customer,
				'created_by' => $created_by,
				'status' => $status
			);
			$insert_id = $this->purchaseorder->insert_purchaseorder($purchaseorder);
			if ($insert_id) {
				for ($i = 0; $i < sizeof($barang); $i++) {
					$dataPurchaseorder = [
						'id_purchaseorder' => $insert_id,
						'id_barang' => $barang[$i],
						'id_batch' => $batch[$i],
						'qty' => $qty[$i],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('id_users')
					];
					$insertDataPurchaseorder = $this->db->insert('datapurchaseorder', $dataPurchaseorder);
					if (!$insertDataPurchaseorder) {
						throw new Exception('Failed to insert datapurchaseorder.');
					}
				}
				$response = array('status' => 'success', 'message' => 'Purchaseorder inserted successfully.');
			} else {
				throw new Exception('Failed to insert purchaseorder.');
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}
		} catch (Exception $e) {
			$response = array('status' => 'error', 'message' => $e->getMessage());
		}

		echo json_encode($response);
	}

	public function editPurchaseorder($uuid)
	{
		$customer = $this->input->post('customer');

		$barang =  $this->input->post('barang');
		$qty = $this->input->post('qty');
		$batch =  $this->input->post('batch');

		$id_purchaseorder = getIdPurchaseorderByUuid($uuid);
		$updateCustomer = $this->db->update('purchaseorder', ['customer' => $customer], ['uuid' => $uuid]);

		if ($updateCustomer) {
			if ($barang) {
				for ($i = 0; $i < sizeof($barang); $i++) {
					$dataPurchaseorder = [
						'id_purchaseorder' => $id_purchaseorder,
						'id_barang' => $barang[$i],
						'id_batch' => $batch[$i],
						'qty' => $qty[$i],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('id_users')
					];
					$this->db->insert('datapurchaseorder', $dataPurchaseorder);
				}
				$response = array('status' => 'success', 'message' => 'Purchaseorder Edit successfully.');
			} else {
				$response = array('status' => 'success', 'message' => 'Purchaseorder Edit successfully (CUSTOMER).');
			}
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to Edit purchaseorder.');
		}
		echo json_encode($response);
	}

	public function getBatch()
	{
		$barangId = $this->input->post('barangId');
		$batchOptions = $this->purchaseorder->getBatchBarang($barangId);
		$batchOptionsArray = array();
		foreach ($batchOptions->result() as $batch) {
			$batchOptionsArray[] = array('id' => $batch->id_batch, 'name' => $batch->batchnumber, 'ed' => date('d-m-Y', strtotime($batch->expiration_date)));
		}
		// var_dump($batchOptionsArray);exit;
		echo json_encode(['batch_options' => $batchOptionsArray]);
	}

	public function checkQty()
	{
		$barangId = $this->input->post('barangId');
		$batchId = $this->input->post('batchId');
		$qty = $this->purchaseorder->checkQty($barangId, $batchId)->row_array();
		echo json_encode($qty['total_quantity']);
	}

	public function createPickingSlip($uuidPo)
	{
		$customer = $this->purchaseorder->getCustomerPurchaseorderByUuid($uuidPo);
		$data = [
			'title' => 'Purchaseorder',
			'subtitle' => 'Data Purchaseorder',
			'subtitle2' => 'Data Purchaseorder',
			'detailPo' => $this->purchaseorder->getDetailPurchaseOrder($uuidPo, 0),
			'uuid' => $uuidPo,
			'customer' => $customer['nama_customer'],
			'userPicker' => $this->purchaseorder->getUserPicker()
		];
		$this->load->view('user/purchaseorder/createPickingSlip', $data);
	}

	public function processPickingslip($uuid)
	{

		$no_pickingslip = generate_pickingslip_number();

		$pickingslip = array(
			'uuid' => uniqid(),
			'no_pickingslip' => $no_pickingslip,
			'id_purchaseorder' => getIdPurchaseorderByUuid($uuid),
			'picker' => $this->input->post('assignPicker'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_users'),
			'status' => 0,
			'is_void' => 0,
			'notes' => $this->input->post('notes')
		);

		$insertPickingslip = $this->db->insert('pickingslip', $pickingslip);
		//update purchase order jadi status 1 (picking slip created)
		$updatePurchaseorder = $this->db->update('purchaseorder', ['status' => 1], ['id_purchaseorder' => getIdPurchaseorderByUuid($uuid)]);

		if ($insertPickingslip && $updatePurchaseorder) {
			$response = array('status' => 'success', 'message' => 'Pickinglist process successfully.');
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to process Pickinglist.');
		}

		echo json_encode($response);
	}

	public function deleteDataPurchaseorder()
	{
		$id = $this->input->post('id_datapurchaseorder');
		$delete = $this->db->delete('datapurchaseorder', ['id_datapurchaseorder' => $id]);
		if ($delete) {
			$response = array('status' => 'success', 'message' => 'Delete Data successfully.');
		} else {

			$response = array('status' => 'error', 'message' => 'Failed to Delete Data.');
		}
		echo json_encode($response);
	}

	// editRow
	public function editRow()
	{
		$this->db->trans_start();

		try {
			$id_datapurchaseorder = $this->input->post('id_datapurchaseorder');
			$id_barang = $this->input->post('id_barang');
			$id_batch = $this->input->post('id_batch');
			$qty = $this->input->post('qty');
			$checkRackItems = $this->db->query('SELECT SUM(a.quantity) AS total_quantity,c.sku,b.batchnumber FROM rack_items a JOIN batch b ON a.id_batch = b.id_batch JOIN barang c ON a.id_barang = c.id_barang WHERE a.id_barang = "' . $id_barang . '" AND b.id_batch = "' . $id_batch . '" ')->row_array();
			if ($checkRackItems['total_quantity'] < $qty) {
				throw new Exception('SKU ' . $checkRackItems['sku'] . ' with Batch ' . $checkRackItems['batchnumber'] . ' not enough in rack (Just ' . $checkRackItems['total_quantity'] . ' PCS)');
			} else {
				$update = $this->db->update('datapurchaseorder', ['id_batch' => $id_batch, 'qty' => $qty], ['id_datapurchaseorder' => $id_datapurchaseorder]);
				if ($update) {
					$response = array('status' => 'success', 'message' => 'Edit Data successfully.');
				} else {
					throw new Exception('Failed to Edit Data.');
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

	// templateBulkInput 
	public function templateBulkInput()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'SKU');
		$sheet->setCellValue('B1', 'Batch');
		$sheet->setCellValue('C1', 'Qty');
		$writer = new Xlsx($spreadsheet);
		$filename = 'template_bulk_input_purchaseorder.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	// viewPurchaseorderBulky 
	public function viewPurchaseorderBulky()
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
			$dataPurchaseOrder = [];
			foreach ($sheetData as $key => $value) {
				if ($key > 0) {
					// pastikan tidak ada data yang kosong 
					if (empty($value[0]) || empty($value[1]) || empty($value[2])) {
						throw new Exception('Data cannot be empty');
					} else {
						$checkSku = $this->db->query('SELECT id_barang,sku,nama_barang FROM barang WHERE sku = "' . $value[0] . '" ');
						$checkBatch = $this->db->query('SELECT id_batch,expiration_date FROM batch WHERE batchnumber = "' . str_replace(' ', '', trim($value[1])) . '" ');
						$checkQty = $this->db->query('SELECT SUM(a.quantity) AS total_quantity FROM rack_items a JOIN batch b ON a.id_batch = b.id_batch WHERE a.id_barang = "' . $checkSku->row()->id_barang . '" AND b.batchnumber = "' . str_replace(' ', '', trim($value[1])) . '" ');

						if ($checkSku->num_rows() == 0) {
							throw new Exception('SKU ' . $value[0] . ' not found');
						} else {
							if ($checkBatch->num_rows() == 0) {
								throw new Exception('Batch ' . $value[1] . ' on  SKU ' . $value[0] . ' not found');
							} else {

								if ($checkQty->num_rows() == 0) {
									throw new Exception('SKU ' . $value[0] . ' with Batch ' . $value[1] . ' not found in rack');
								} else {
									if ($checkQty->row()->total_quantity < preg_replace('/[^0-9]/', '', str_replace(' ', '', trim($value[2])))) {
										throw new Exception('SKU ' . $value[0] . ' with Batch ' . $value[1] . ' not enough in rack (Just ' . $checkQty->row()->total_quantity . ' PCS)');
									} else {
										$dataPurchaseOrder[] = [
											'sku' => $value[0],
											'id_barang' => $checkSku->row()->id_barang,
											'nama_barang' => $checkSku->row()->nama_barang,
											'id_batch' => $checkBatch->row()->id_batch,
											'batchnumber' => str_replace(' ', '', trim($value[1])),
											'ed' => $checkBatch->row()->expiration_date,
											'qty' => preg_replace('/[^0-9]/', '', str_replace(' ', '', trim($value[2]))),
										];
									}
								}
							}
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
				'title' => 'Purchaseorder',
				'subtitle' => 'Data Purchaseorder',
				'subtitle2' => 'Data Purchaseorder',
				'po' => $dataPurchaseOrder,
				'customer' => $this->db->get('customer')
			];
			$this->load->view('user/purchaseorder/viewBulky', $data);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $response['message'] . '</div>');
			redirect('user/purchaseorder');
		}
	}


	// addBatchDataPurchaseorder
	public function addBatchDataPurchaseorder()
	{
		$this->db->trans_start();
		try {

			$datapurchaseorder = $this->db->get('datapurchaseorder')->result_array();
			foreach ($datapurchaseorder as $dp) {
				$batch = $this->db->query('SELECT batchnumber FROM batch WHERE id_batch = ' . $dp['id_batch'] . ' ')->row_array();
				$dataBatch = [
					'batch' => $batch['batchnumber']
				];
				$updateData = $this->db->update('datapurchaseorder', $dataBatch, ['id_datapurchaseorder' => $dp['id_datapurchaseorder']]);
				if (!$updateData) {
					throw new Exception('Failed to update batch data purchaseorder.');
				}
			}
			$response = 'success';

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response = $e->getMessage();
		}
		echo $response;
	}
}

/* End of file User.php */
