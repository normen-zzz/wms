<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Inventory extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('RackItems_model');
	}

	public function index()
	{
		$filters = [
			'sku' => $this->input->get('sku'),
			'batchnumber' => $this->input->get('batchnumber'),
			'sloc' => $this->input->get('sloc')
		];

		$data = [
			'title' => 'Inventory',
			'subtitle' => 'Data Inventory',
			'subtitle2' => 'Data Inventory',
			'rack_items' => $this->RackItems_model->get_all_rack_items($filters)
		];

		$this->load->view('user/inventory/index', $data);
	}

	// create template using excel
	public function create_template()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'SKU');
		$sheet->setCellValue('B1', 'Nama Barang');
		$sheet->setCellValue('C1', 'Batch Number');
		$sheet->setCellValue('D1', 'expiration_date');
		$sheet->setCellValue('E1', 'SLOC');
		$sheet->setCellValue('F1', 'Quantity');
		$sheet->setCellValue('G1', 'UOM');
		$sheet->setCellValue('H1', 'Created At');
		$sheet->setCellValue('I1', 'Created By');
		$writer = new Xlsx($spreadsheet);
		$filename = 'template_inventory.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	// input to database from template send from jquery ajax
	public function import_template()
	{
		$file = $_FILES['inventoryBulky'];
		$ext = pathinfo($file['tmp_name'], PATHINFO_EXTENSION);
		if ($ext == 'csv') {
			$reader = new Csv();
		} else {
			$reader = new ReaderXlsx();
		}
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($file['tmp_name']);
		$sheetData = $spreadsheet->getActiveSheet()->toArray();
		$data = [];
		
		foreach ($sheetData as $key => $value) {
			if ($key > 0) {
				$id_barang = '';
				$id_batch = '';
				$id_rack = '';
				$barang = $this->db->query('SELECT id_barang FROM barang WHERE sku = "' . $value[0] . '" ');
				$batch = $this->db->query('SELECT id_batch FROM batch WHERE batchnumber = "' . $value[2] . '" ');
				$sloc = $this->db->query('SELECT id_rack FROM rack WHERE sloc = "' . $value[4] . '" ');
				if ($barang->num_rows() > 0) {
					$id_barang = $barang->row()->id_barang;
				} else{
					$this->db->insert('barang', [
						'uuid' => uniqid(),
						'sku' => $value[0],
						'nama_barang' => $value[1],
						'uom' => 'pcs',
						'is_deleted' => 0,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('id_users'),
					]);
					// get id from insert
					$id_barang = $this->db->insert_id();
				}

				if ($batch->num_rows() > 0) {
					$id_batch = $batch->row()->id_batch;
				} else {
					$this->db->insert('batch', [
						'uuid' => uniqid(),
						'batchnumber' => $value[2],
						'expiration_date' => date('Y-m-d',strtotime($value[3])) ,
						'qty' => 0
					]);
					// get id from insert
					$id_batch = $this->db->insert_id();
				}

				if ($sloc->num_rows() > 0) {
					$id_rack = $sloc->row()->id_rack;
				} else {
					$this->db->insert('rack', [
						'uuid' => uniqid(),
						'sloc' => $value[4],
						'zone' => 'A',
						'rack' => 'A',
						'row' => 'A',
						'column_rack' => 'A',
						'max_qty' => 9999999,
						'uom' => 'pcs',
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('id_users'),
						'is_deleted' => 0,
						'status' => 0
					]);
					// get id from insert
					$id_rack = $this->db->insert_id();
				}

				$data[] = [
					'id_barang' => $id_barang,
					'id_batch' => $id_batch,
					'id_rack' => $id_rack,
					'quantity' => $value[5],
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('id_users'),
				];
			}
		}
		$insert_data = $this->db->insert_batch('rack_items', $data);
		if ($insert_data) {
			echo json_encode(['success' => true]);
		} else {
			echo json_encode(['error' => true]);
		}
	}




	public function delete($id)
	{
		$this->RackItems_model->delete_rack_item($id);
		redirect('inventory');
	}
}
