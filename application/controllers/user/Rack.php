<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rack extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Rack_model', 'rack');
	}

	public function index()
	{
		$this->form_validation->set_rules('sloc', 'Sloc', 'required|trim', [
			'required' => 'sloc Rack tidak boleh kosong.'
		]);
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Rack',
				'subtitle' => 'Data Rack',
				'subtitle2' => 'Data Rack',
				'rack' => $this->rack->getDataRack(),
			];

			$this->load->view('user/rack/index', $data);
		} else {
		}
	}

	public function processAddRack()
	{
		$this->load->library('uuid');
		$uuid = $this->uuid->v4(true);

		$checkSloc = $this->db->query('SELECT sloc FROM rack WHERE sloc = "' . $this->input->post('sloc') . '" ');
		if ($checkSloc->num_rows() == 0) {
			$data = [
				'uuid' => $uuid,
				'sloc' => $this->input->post('sloc'),
				'zone' => $this->input->post('zone'),
				'rack' => $this->input->post('rack'),
				'row' => $this->input->post('row'),
				'column_rack' => $this->input->post('column'),
				'max_qty' => $this->input->post('maxqty'),
				'uom' => $this->input->post('uom'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('id_users'),

			];
			$this->db->insert('rack', $data);

			$response = array('status' => 'success', 'message' => 'Add Rack successfully.');
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to Add Rack (SLOC SAME).');
		}

		echo json_encode($response);
	}

	public function get_rack($id_rack)
	{
		$rack = $this->db->get_where('rack', ['id_rack' => $id_rack])->row_array();
		echo json_encode($rack);
	}

	public function update_rack()
	{
		$data = array(
			'sloc' => $this->input->post('sloc'),
			'zone' => $this->input->post('zone'),
			'rack' => $this->input->post('rack'),
			'row' => $this->input->post('row'),
			'column_rack' => $this->input->post('column'),
			'max_qty' => $this->input->post('maxqty'),
			'uom' => $this->input->post('uom')
		);

		$this->db->where('id_rack', $this->input->post('rack_id'));
		$this->db->update('rack', $data);
		echo json_encode(['status' => 'success']);
	}


	public function delete_rack($id_rack)
	{
		$data = array(
			'is_deleted' => 1,
		);

		$this->db->where('id_rack', $id_rack);
		$this->db->update('rack', $data);
		echo json_encode(['status' => 'success']);
	}

	public function get_grouped_items($sloc)
	{
		$barangGrouped = getGroupedItemsBySloc($sloc);

		foreach ($barangGrouped as $barang) {
			$data = $barang['sku'] . '-' . $barang['batchnumber'];
			$this->generate_qrcode($data);
		}

		redirect(base_url('assets/uploads/qrcodes/' . $data . '.png'));
	}

	public function get_items_by_sloc() {
      $sloc = $this->input->post('sloc');
      $items = $this->rack->getGroupedItemsBySloc($sloc);
      if (!empty($items)) {
          echo json_encode([
              'status' => 'success',
              'items' => $items
          ]);
      } else {
          echo json_encode([
              'status' => 'error',
              'message' => 'Grouped items not found for the given SLOC.'
          ]);
      }
    }

	// input to database from excel file template tanpa save file
	public function import_rack()
	{

		$file = $_FILES['file']['name'];
		$file = explode(".", $file);
		$ext = end($file);
		if ($ext == 'xlsx') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		} else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		}

		$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
		$sheetData = $spreadsheet->getActiveSheet()->toArray();

		$data = [];
		$success = 0;
		$failed = 0;
		$failedData = [];
		foreach ($sheetData as $key => $value) {
			if ($key > 0) {
				$checkSloc = $this->db->query('SELECT sloc FROM rack WHERE sloc = "' . $value[0] . '" ');
				if ($checkSloc->num_rows() == 0) {
					$data = [
						'sloc' => $value[0],
						'zone' => $value[1],
						'rack' => $value[2],
						'row' => $value[3],
						'column_rack' => $value[4],
						'max_qty' => $value[5],
						'uom' => $value[6],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('id_users'),
					];
					$this->db->insert('rack', $data);
					$success++;
				} else {
					$failed++;
					$failedData[] = $value;
				}
			}
		}

		$response = [
			'success' => $success,
			'failed' => $failed,
			'failedData' => $failedData
		];

		echo json_encode($response);
	}
	


}

/* End of file User.php */
