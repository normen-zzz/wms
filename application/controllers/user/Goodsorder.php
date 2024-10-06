<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goodsorder extends CI_Controller
{

	public function __construct()
	{
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		parent::__construct();
		is_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Goodsorder_model', 'goodsorder');
	}

	public function index()
	{
		$data = [
			'title' => 'Goodsorder',
			'subtitle' => 'Data Goodsorder',
			'subtitle2' => 'Data Goodsorder',
			'pl' => $this->goodsorder->getDataGoodsorder(),
		];
		$this->load->view('user/goodsorder/index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Goodsorder',
			'subtitle' => 'Add Goodsorder',
			'subtitle2' => 'Add Goodsorder',

		];
		$this->load->view('user/goodsorder/addGoodsorder', $data);
	}

	public function getDataBarangSelect()
	{
		$searchTerm = $this->input->post('searchTerm');

		if (!$searchTerm) {
			echo json_encode(['error' => 'No search term']);
			return;
		}
		$response = $this->goodsorder->selectBarang($searchTerm);

		if (empty($response)) {
			echo json_encode(['error' => 'No data found']);
		} else {
			echo json_encode($response);
		}
	}


	public function insertGoodsorder()
	{
		$no_goodsorder = generate_goodsorder_number();
		$created_by = $this->session->userdata('id_users');
		$barang =  $this->input->post('barang');
		$qty = $this->input->post('qty');
		$batch =  $this->input->post('batch');
		$status = 0;
		$goodsorder = array(
			'uuid' => uniqid(),
			'no_goodsorder' => $no_goodsorder,
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $created_by,
			'status' => $status
		);
		$insert_id = $this->goodsorder->insert_goodsorder($goodsorder);
		if ($insert_id) {
			for ($i = 0; $i < sizeof($barang); $i++) {
				$dataGoodsorder = [
					'id_goodsorder' => $insert_id,
					'id_barang' => $barang[$i],
					'id_batch' => $batch[$i],
					'qty' => $qty[$i],
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('id_users')
				];
				$this->db->insert('datagoodsorder', $dataGoodsorder);
			}
			$response = array('status' => 'success', 'message' => 'Goodsorder inserted successfully.');
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to insert goodsorder.');
		}

		echo json_encode($response);
	}

	public function getBatch()
	{
		$barangId = $this->input->post('barangId');
		$batchOptions = $this->goodsorder->getBatchBarang($barangId);
		$batchOptionsArray = array();
		foreach ($batchOptions->result() as $batch) {
			$batchOptionsArray[] = array('id' => $batch->id_batch, 'name' => $batch->batchnumber);
		}
		echo json_encode(['batch_options' => $batchOptionsArray]);
	}

	public function checkQty()
	{
		$barangId = $this->input->post('barangId');
		$batchId = $this->input->post('batchId');
		$qty = $this->goodsorder->checkQty($barangId,$batchId)->row_array();
		echo json_encode($qty['qty']);
	}
}

/* End of file User.php */
