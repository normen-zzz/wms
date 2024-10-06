<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchaseorder extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
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
			'detailPo' => $this->purchaseorder->getDetailPurchaseOrder($uuidPo),
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
				$this->db->insert('datapurchaseorder', $dataPurchaseorder);
			}
			$response = array('status' => 'success', 'message' => 'Purchaseorder inserted successfully.');
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to insert purchaseorder.');
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
			$batchOptionsArray[] = array('id' => $batch->id_batch, 'name' => $batch->batchnumber);
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
			'detailPo' => $this->purchaseorder->getDetailPurchaseOrder($uuidPo),
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
			'is_void' => 0
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
}

/* End of file User.php */
