<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Log extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		$this->load->model('Log_model', 'wms_log');
	}

	public function index()
	{
		$filters = [
			// remove space 

			'sku' => trim($this->input->get('sku')),
			'batchnumber' => trim($this->input->get('batchnumber')),
			'sloc' => trim($this->input->get('sloc')),
			'no_document' => trim($this->input->get('no_document')),
		];

		$data = [
			'title' => 'Log',
			'subtitle' => 'Data Log',
			'subtitle2' => 'Data Log',
			'log' => $this->wms_log->getAllLog($filters)
		];

		$this->load->view('user/log/index', $data);
	}

	// export data to excel 
	public function exportLog()
	{


		$logs = $this->wms_log->getAllLogExport();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'SKU');
		$sheet->setCellValue('C1', 'Nama Barang');
		$sheet->setCellValue('D1', 'Batch Number');
		$sheet->setCellValue('E1', 'Sloc');
		$sheet->setCellValue('F1', 'Expiration Date');
		$sheet->setCellValue('G1', 'Quantity');
		$sheet->setCellValue('H1', 'Condition');
		$sheet->setCellValue('I1', 'At');
		$sheet->setCellValue('J1', 'No Document');
		$sheet->setCellValue('K1', 'By');
		$sheet->setCellValue('L1', 'Description');




		$no = 2;
		foreach ($logs as $log) {
			$sheet->setCellValue('A' . $no, $no - 1);
			$sheet->setCellValue('B' . $no, $log->sku);
			$sheet->setCellValue('C' . $no, $log->nama_barang);
			$sheet->setCellValue('D' . $no, $log->batchnumber);
			$sheet->setCellValue('E' . $no, $log->sloc);
			$sheet->setCellValue('F' . $no, $log->expiration_date);
			$sheet->setCellValue('G' . $no, $log->qty);
			$sheet->setCellValue('H' . $no, $log->condition);
			$sheet->setCellValue('I' . $no, strtotime($log->at));
			$sheet->setCellValue('J' . $no, $log->no_document);
			$sheet->setCellValue('K' . $no, $log->nama);
			$sheet->setCellValue('L' . $no, $log->description);


			$no++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename = 'log-' . date('YmdHis') . '.xlsx';
		// langsung download 


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');


		$writer->save('php://output');
	}
}
