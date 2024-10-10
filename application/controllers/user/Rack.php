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
		$file = $_FILES['rackBulky'];
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
		$this->load->library('uuid');
		foreach ($sheetData as $key => $value) {
			if ($key > 0) {
				$checkSloc = $this->db->query('SELECT sloc FROM rack WHERE sloc = "' . $value[0] . '" ');
				if ($checkSloc->num_rows() == 0) {
					$data[] = [
						'uuid' => uniqid(),
						'sloc' => $value[0],
						'zone' => $value[1],
						'rack' => $value[2],
						'row' => $value[3],
						'column_rack' => $value[4],
						'max_qty' => $value[5],
						'uom' => $value[6],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('id_users'),
						'is_deleted' =>  0,
						'status' => 0

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

	// activate_rack
	public function activate_rack($id_rack)
	{
		$id_rack = $this->input->post('id');

		if ($id_rack) {
			$data = array(
				'is_deleted' => 0,
			);

			$this->db->where('id_rack', $id_rack);
			$this->db->update('rack', $data);

			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Rack ID not provided.']);
		}
	}

	// deactivate_rack
	public function deactivate_rack()
	{
		$id_rack = $this->input->post('id');

		if ($id_rack) {
			$data = array(
				'is_deleted' => 1,
			);

			$this->db->where('id_rack', $id_rack);
			$this->db->update('rack', $data);

			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Rack ID not provided.']);
		}
	}

	// print sloc rack dengan mpdf bentuk
	public function print_slocrack($id_rack)
	{
		$rack = $this->db->get_where('rack', ['id_rack' => $id_rack])->row_array();
		$data = [
			'title' => 'Print Rack',
			'subtitle' => 'Print Rack',
			'rack' => $rack,
		];
		$this->load->view('user/rack/print_rack', $data, true);

		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

		$html = '
    <br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
    <div style="text-align:center">
        <h1>SLOC: ' . $rack['sloc'] . '</h1>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $rack['sloc'] . '" alt="">
        <h3>Zone: ' . $rack['zone'] . ', Rack: ' . $rack['rack'] . ', Row: ' . $rack['row'] . ', Column: ' . $rack['column_rack'] . '</h3>
    </div>
';

		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	  public function print_sloc($sloc) {

        $data['items'] = $this->rack->getGroupedItemsBySloc($sloc);
        $data['sloc'] = $sloc;

        // Load view dengan data
        $this->load->view('user/rack/print_sloc', $data);
    }
	// print_items_qr berisi sloc dan barcode, bawahnya isinya list nama barang dari rack_items berbentuk png
	public function print_items_qr($sloc)
	{
		$barangGrouped = getGroupedItemsBySloc($sloc);
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [94.6, 98]]);
		// margin 0 
		$mpdf->SetMargins(0, 0, 0, 0);


		
	
		$html = '
		
		<div>
	<div style="text-align:center">
		<h4>SLOC: ' . $sloc . '</h4>
		<img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=' . $sloc . '" alt="">
	</div>
	<br>
	<table border="1" style="width:100%">
		<tr>
			<th style="font-size: 10px;">SKU</th>
			<th style="font-size: 10px;">Description</th>
			<th style="font-size: 10px;">LOT</th>
			
		</tr>
	';
		foreach ($barangGrouped as $barang) {
			$html .= '
		<tr>
			<td style="font-size: 8px;">' . $barang['sku'] . '</td>
			<td style="font-size: 8px;">' . $barang['nama_barang'] . '</td>
			<td style="font-size: 8px;">' . $barang['batchnumber'] . '</td>
			
		</tr>
		
		';
		}
		$html .= '</table>
		</div>';

		$mpdf->WriteHTML($html);
		// set name pdf with sloc on download
		$mpdf->Output($sloc . '.pdf', 'D');
		// $mpdf->Output();
		
		// convert to jpg
		// convert pdf to jpg
		
	}
}

/* End of file User.php */
