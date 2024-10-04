<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
			// $this->generate_qrcode($data);
		}

		redirect(base_url('assets/uploads/qrcodes/' . $data . '.png'));
	}

	public function get_items_by_sloc()
	{
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
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Check for expected form fields
			if (isset($_POST['field_name'])) {
				// Process the form data
			} else {
				// Handle missing form field
				echo 'Error: Missing form field';
			}
		} else {
			echo 'Invalid request method';
		}
		

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
        $data = [];
        $this->load->library('uuid');
        foreach ($sheetData as $key => $value) {
            if ($key > 0) {
                $checkSloc = $this->db->query('SELECT sloc FROM rack WHERE sloc = "' . $data[0] . '" ');
                if ($checkSloc->num_rows() == 0) {
                    $data[] = [
                        'sloc' => $data[0],
					'zone' => $data[1],
					'rack' => $data[2],
					'row' => $data[3],
					'column_rack' => $data[4],
					'max_qty' => $data[5],
					'uom' => $data[6],
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('id_users'),
                    ];
                }
            }
        }
        $insert_data = $this->db->insert_batch('rack', $data);
        if ($insert_data) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => true]);
        }
    }
	
	
	
	public function download_template()
	{

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'SLOC');
		$sheet->setCellValue('B1', 'Zone');
		$sheet->setCellValue('C1', 'Rack');
		$sheet->setCellValue('D1', 'Row');
		$sheet->setCellValue('E1', 'Column');
		$sheet->setCellValue('F1', 'Max Qty');
		$sheet->setCellValue('G1', 'UOM');
		$writer = new Xlsx($spreadsheet);
		$filename = 'template_rack.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
}

/* End of file User.php */
