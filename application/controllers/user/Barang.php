<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Barang_model', 'barang');
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Nama Barang tidak boleh kosong.'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Barang',
                'subtitle' => 'Data Barang',
                'subtitle2' => 'Data Barang',
                'barang' => $this->barang->getDataBarang(),
            ];

            $this->load->view('user/barang/index', $data);
        } else {

            $this->load->library('uuid');
            $uuid = $this->uuid->v4(true);
            $sku = $this->input->post('sku');
            $data = [
                'uuid' => $uuid,
                'sku' => $sku,
                'nama_barang' => $this->input->post('name'),
                'uom' => $this->input->post('uom'),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_users')

            ];

            $checkSku = $this->db->query('SELECT sku FROM barang WHERE sku = "' . $sku . '" ');
            if ($checkSku->num_rows() == 0) {
                $this->db->insert('barang', $data);
                $this->session->set_flashdata("message", "Toast.fire({icon: 'success',title: 'Success'})");
            } else {
                $this->session->set_flashdata("message", "Toast.fire({icon: 'failed',title: 'failed,SKU already exists'})");
            }
            redirect(base_url('user/Barang'));
        }
    }

    public function get_barang($id_barang)
    {
        $barang = $this->barang->get_barang_by_id($id_barang);
        echo json_encode($barang);
    }

    public function update_barang()
    {
        $id_barang = $this->input->post('id_barang');
        $data = array(
            // 'sku' => $this->input->post('sku'),
            'nama_barang' => $this->input->post('nama_barang'),
            'uom' => $this->input->post('uom')
        );

        $this->barang->update_barang($id_barang, $data);
        echo json_encode(['success' => true]);
    }

    public function delete_barang($id_barang)
    {
        $this->barang->delete_barang($id_barang);
        echo json_encode(['success' => true]);
    }

	public function activated($id_barang)
    {
        $this->barang->activated_barang($id_barang);
        echo json_encode(['success' => true]);
    }

    public function download_template()
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'SKU');
        $sheet->setCellValue('B1', 'Nama Barang');
        $sheet->setCellValue('C1', 'UOM');
        $writer = new Xlsx($spreadsheet);
        $filename = 'template_barang.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    // input to database from excel file template tanpa save file
    public function import_barang()
    {

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
                $checkSku = $this->db->query('SELECT sku FROM barang WHERE sku = "' . $value[0] . '" ');
                if ($checkSku->num_rows() == 0) {
                    $data[] = [
                        'uuid' => uniqid(),
                        'sku' => $value[0],
                        'nama_barang' => $value[1],
                        'uom' => $value[2],
                        'is_deleted' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id_users')
                    ];
                }
            }
        }
        $insert_data = $this->db->insert_batch('barang', $data);
        if ($insert_data) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => true]);
        }
    }
}

/* End of file User.php */
