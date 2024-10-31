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
		$this->load->model('Log_model','wms_log');
	}

	public function index()
	{
		$filters = [
			'sku' => $this->input->get('sku'),
			'batchnumber' => $this->input->get('batchnumber'),
			'sloc' => $this->input->get('sloc')
		];

		$data = [
			'title' => 'Log',
			'subtitle' => 'Data Log',
			'subtitle2' => 'Data Log',
			'log' => $this->wms_log->getAllLog($filters)
		];

		$this->load->view('user/log/index', $data);
	}

	

	




	
}
