<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;

class Adjuststock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        // Load necessary models, libraries, etc.
        $this->load->model('Adjuststock_model', 'adjuststock');
        $this->load->model('Whatsapp_model', 'whatsapp');
    }

    public function index()
    {
        // Load the view and pass the data
        $data = [
            'title' => 'Adjuststock',
            'subtitle' => 'Data Adjuststock',
            'subtitle2' => 'Data Adjuststock',
            'adjuststock' => $this->adjuststock->getDataAdjustStock(),
        ];
        $this->load->view('user/adjuststock/index', $data);
    }

    // viw for add adjuststock
    public function add()
    {
        // Load the view
        $data = [
            'title' => 'Adjuststock',
            'subtitle' => 'Add Adjuststock',
            'subtitle2' => 'Add Adjuststock',
        ];
        $this->load->view('user/adjuststock/add', $data);
    }

    public function getDataBarangSelect()
    {
        $searchTerm = $this->input->post('searchTerm');

        if (!$searchTerm) {
            echo json_encode(['error' => 'No search term']);
            return;
        }
        $response = $this->adjuststock->selectBarang($searchTerm);

        if (empty($response)) {
            echo json_encode(['error' => 'No data found']);
        } else {
            echo json_encode($response);
        }
    }


    public function getBatch()
    {
        $barangId = $this->input->post('barangId');
        $batchOptions = $this->adjuststock->getBatchBarang($barangId);
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
        $rack = $this->input->post('rack');
        $qty = $this->adjuststock->checkQty($barangId, $batchId, $rack)->row_array();
        echo json_encode($qty['total_quantity']);
    }

    // getRecommendedRack
    public function get_rack_recommendations()
    {
        // from id barang and batch 
        $id_barang = $this->input->post('id_barang');
        $id_batch = $this->input->post('id_batch');
        $rack = $this->adjuststock->getRecommendedRack($id_barang, $id_batch);
        echo json_encode($rack);
    }

    // insertAdjuststock
    public function insertAdjuststock()
    {
        $this->db->trans_start();
        try {
            $no_adjuststock = generate_adjuststock_number();
            $stockOpname = [

                'uuid' => uniqid(),
                'no_adjuststock' => $no_adjuststock,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_users'),
            ];


            $insertAdjustStock = $this->adjuststock->insert_adjuststock($stockOpname);
            if ($insertAdjustStock) {
                $id_adjuststock = $this->db->insert_id();
                $id_barang = $this->input->post('barang');
                $id_batch = $this->input->post('batch');
                $rack = $this->input->post('sloc');
                $quantity = $this->input->post('qty');
                $notes = $this->input->post('notes');
                $batchDataAdjuststock = [];
                $dataAdjuststockWa = '';
                for ($i = 0; $i < count($id_barang); $i++) {

                    $checkSloc = $this->adjuststock->checkSloc($rack[$i]);

                    if ($checkSloc->num_rows() == 0) {
                        throw new Exception('Rack ' . $rack[$i] . ' tidak ditemukan');
                    } else {
                        $checkSloc = $checkSloc->row_array();
                        $checkSloc = $checkSloc['id_rack'];
                    }
                    // add to array 
                    $quantityBefore = $this->db->query('SELECT quantity FROM rack_items WHERE id_barang = ' . $id_barang[$i] . ' AND id_batch = ' . $id_batch[$i] . ' AND id_rack = ' . $checkSloc)->row_array();
                    $dataAdjuststock = [
                        'id_adjuststock' => $id_adjuststock,
                        'id_barang' => $id_barang[$i],
                        'id_batch' => $id_batch[$i],
                        'id_rack' => $checkSloc,
                        'quantity_from' => $quantityBefore['quantity'],
                        'quantity_to' => $quantity[$i],
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id_users'),
                        'status' => 0,
                        'notes' => $notes[$i],
                    ];
                    $batchDataAdjuststock[] = $dataAdjuststock;
                }
                $insertDataAdjuststock = $this->adjuststock->insert_data_adjuststock($batchDataAdjuststock);
                if ($insertDataAdjuststock) {
                    $superadmin = $this->db->query('SELECT no_handphone FROM users WHERE role_id = 1')->result_array();
                    foreach ($superadmin as $admin) {
                        $this->whatsapp->kirim($admin['no_handphone'], 'Adjust Stock baru telah ditambahkan oleh ' . $this->session->userdata('nama') . ' dengan nomor ' . $no_adjuststock . ' Silahkan cek di warehouse.transtama.com Untuk melakukan Approval');
                        // $wa = $this->whatsapp->kirim($admin['no_handphone'], "Silahkan cek di warehouse.transtama.com");


                    }
                } else {
                    throw new Exception('Gagal menambahkan adjust stock  1');
                }
            } else {
                throw new Exception('Gagal menambahkan Adjust stock 2');
            }
            $response = array('status' => 'success', 'message' => 'Adjust Stock berhasil ditambahkan');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menambahkan adjust Stock');
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $response = array('status' => 'error', 'message' => $e->getMessage());
        }

        echo json_encode($response);
    }

    // detail 
    public function detail($uuid)
    {
        $data = [
            'title' => 'Adjuststock',
            'subtitle' => 'Detail Adjuststock',
            'subtitle2' => 'Detail Adjuststock',
            'adjuststock' => $this->adjuststock->getDetailAdjustStock($uuid),
            'adjuststockDetail' => $this->adjuststock->getDetailAdjustStockDetail($uuid),
        ];
        $this->load->view('user/adjuststock/detail', $data);
    }

    // process 
    public function process($uuid)
    {
        $data = [
            'title' => 'Adjuststock',
            'subtitle' => 'Process Adjuststock',
            'subtitle2' => 'Process Adjuststock',
            'adjuststock' => $this->adjuststock->getDetailAdjustStock($uuid),
            'adjuststockDetail' => $this->adjuststock->getDetailAdjustStockDetail($uuid),
        ];
        $this->load->view('user/adjuststock/process', $data);
    }

    // processAdjuststock
    public function processAdjuststock()
    {
        $this->db->trans_start();
        try {

            $id_adjuststock = $this->input->post('id_adjuststock');
            $notes_approved = $this->input->post('notes_approved');
            $id_dataadjuststock = $this->input->post('id_dataadjuststock');
            $adjustStock = $this->db->query('SELECT * FROM adjuststock WHERE id_adjuststock = ' . $id_adjuststock)->row_array();
            $requester = $this->db->query('SELECT * FROM users WHERE id_users = ' . $adjustStock['created_by'])->row_array();

            //    for id_dataadjuststock 
            for ($i = 0; $i < count($id_dataadjuststock); $i++) {
                $dataAdjuststock = $this->db->query('SELECT * FROM dataadjuststock WHERE id_dataadjuststock = ' . $id_dataadjuststock[$i])->row_array();
                $rackItems = $this->db->query('SELECT * FROM rack_items WHERE id_barang = ' . $dataAdjuststock['id_barang'] . ' AND id_batch = ' . $dataAdjuststock['id_batch'] . ' AND id_rack = ' . $dataAdjuststock['id_rack'])->row_array();
                $updateRackItems = $this->db->update('rack_items', ['quantity' => $dataAdjuststock['quantity_to']], ['id_barang' => $dataAdjuststock['id_barang'], 'id_batch' => $dataAdjuststock['id_batch'], 'id_rack' => $dataAdjuststock['id_rack']]);
                if ($updateRackItems) {
                    $updateDataAdjuststock = $this->db->update('dataadjuststock', ['status' => 1, 'approved_by' => $this->session->userdata('id_users')], ['id_dataadjuststock' => $id_dataadjuststock[$i]]);
                    if ($updateDataAdjuststock) {
                        if ($rackItems['quantity'] > $dataAdjuststock['quantity_to']) {
                            $datalog = [
                                'id_barang' => $dataAdjuststock['id_barang'],
                                'id_batch' => $dataAdjuststock['id_batch'],
                                'id_rack' => $dataAdjuststock['id_rack'],
                                'condition' => 'out',
                                'qty' => $rackItems['quantity'] - $dataAdjuststock['quantity_to'],
                                'at' => date('Y-m-d H:i:s'),
                                'by' => $dataAdjuststock['created_by'],
                                'no_document' => $adjustStock['no_adjuststock'],
                                'description' => 'Adjust Stock Approved By ' . $this->session->userdata('nama')
                            ];
                        } else {
                            $datalog = [
                                'id_barang' => $dataAdjuststock['id_barang'],
                                'id_batch' => $dataAdjuststock['id_batch'],
                                'id_rack' => $dataAdjuststock['id_rack'],
                                'condition' => 'in',
                                'qty' => $dataAdjuststock['quantity_to'] - $rackItems['quantity'],
                                'at' => date('Y-m-d H:i:s'),
                                'by' => $dataAdjuststock['created_by'],
                                'no_document' => $adjustStock['no_adjuststock'],
                                'description' => 'Adjust Stock Approved By ' . $this->session->userdata('nama')
                            ];
                        }

                        $insertLog = $this->db->insert('wms_log', $datalog);
                        if (!$insertLog) {
                            throw new Exception('Gagal menambahkan log');
                        }
                    } else {
                        throw new Exception('Gagal mengupdate data adjust stock');
                    }
                } else {
                    throw new Exception('Gagal mengupdate rack items');
                }
            }
            $updateAdjuststock = $this->db->update('adjuststock', ['status' => 1, 'approved_by' => $this->session->userdata('id_users'), 'notes_approved' => $notes_approved], ['id_adjuststock' => $id_adjuststock]);
            if ($updateAdjuststock) {
                $checkLastAdjuststock = $this->db->query('SELECT * FROM dataadjuststock WHERE id_adjuststock = ' . $id_adjuststock . ' AND status = 0 ')->result_array();
                if (count($checkLastAdjuststock) != 0) {
                    foreach ($checkLastAdjuststock as $checkLastAdjuststock1) {
                        $updateDataAdjuststock = $this->db->update('dataadjuststock', ['status' => 2, 'approved_by' => $this->session->userdata('id_users')], ['id_dataadjuststock' => $checkLastAdjuststock1['id_dataadjuststock']]);
                        if (!$updateDataAdjuststock) {
                            throw new Exception('Gagal mengupdate data adjust stock');
                        }
                    }
                }
                $sendWaToRequester = $this->whatsapp->kirim($requester['no_handphone'], 'Adjust Stock dengan nomor ' . $adjustStock['no_adjuststock'] . ' telah di approve oleh ' . $this->session->userdata('nama') . ' \r\n\r\n Silahkan cek di warehouse.transtama.com');
                if ($sendWaToRequester) {
                    $response = json_encode(['status' => 'success', 'message' => 'Adjust Stock berhasil di approve']);
                } else {
                    throw new Exception('Gagal mengirimkan pesan ke whatsapp requester');
                }
            } else {
                throw new Exception('Gagal mengupdate adjust stock');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menambahkan adjust Stock');
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $response = json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
        echo $response;
    }

    // generate excel template adjust stock  sku,batch and sloc 
    public function templateAdjustStock()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'SKU');
        $sheet->setCellValue('B1', 'Nama Barang');
        $sheet->setCellValue('C1', 'Batch');
        $sheet->setCellValue('D1', 'Sloc');
        // qty 
        $sheet->setCellValue('E1', 'Quantity');
        // notes 
        $sheet->setCellValue('F1', 'Notes');
        $writer = new Xlsx($spreadsheet);
        $filename = 'Adjuststock_Template_' . date('YmdHis') . '.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    // import adjust stock
    public function importAdjustStock()
    {
        try {
            $file = $_FILES['fileAdjustStock']['tmp_name'];
            $reader = new ReaderXlsx();
            $spreadsheet = $reader->load($file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $data = [];
            for ($i = 1; $i < count($sheetData); $i++) {
                $baris = $i + 1;
                $barang = $this->db->query('SELECT * FROM barang WHERE sku = "' . $sheetData[$i][0] . '"')->row_array();
                $batch = $this->db->query('SELECT * FROM batch WHERE batchnumber = "' . $sheetData[$i][2] . '"');
                $rack = $this->db->query('SELECT * FROM rack WHERE sloc = "' . $sheetData[$i][3] . '"')->row_array();
                $quantity = 0;
                // jika quantity tidak kosong
                if ($sheetData[$i][4] != '') {
                    $quantity = $sheetData[$i][4];
                } else {
                    $quantity = 0;
                }

                if ($barang && $batch && $rack) {
                    $sizeBatch = $batch->num_rows();
                    $countBatch = 0;
                    $id_batch = '';
                    $quantityRack = 0;
                    foreach ($batch->result_array() as $batch1) {

                        $rackItems = $this->db->query('SELECT * FROM rack_items WHERE id_barang = ' . $barang['id_barang'] . ' AND id_batch = ' . $batch1['id_batch'] . ' AND id_rack = ' . $rack['id_rack'])->row_array();
                        if ($rackItems) {
                            $id_batch = $batch1['id_batch'];
                            $quantityRack = $rackItems['quantity'];
                            break;
                        }
                        $countBatch++;
                    }
                    if ($id_batch != '') {

                        $data[] = [
                            'sku' => $sheetData[$i][0],
                            'batch' => $sheetData[$i][2],
                            'sloc' => $sheetData[$i][3],
                            'nama_barang' => $sheetData[$i][1],
                            'id_barang' => $barang['id_barang'],
                            'id_batch' => $id_batch,
                            'id_rack' => $rack['id_rack'],
                            'quantity_rack' => $quantityRack,
                            'quantity' => $quantity,
                            'notes' => $sheetData[$i][5],
                        ];
                    } else {

                        $newBatch = $batch->row_array();
                        
                        // insert to rackitems 
                        $dataRackItems = [
                            'id_barang' => $barang['id_barang'],
                            'id_batch' => $newBatch['id_batch'],
                            'id_rack' => $rack['id_rack'],
                            'quantity' => 0,
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => $this->session->userdata('id_users'),
                        ];
                        $insertRackItems = $this->db->insert('rack_items', $dataRackItems);
                        if ($insertRackItems) {
                            // log 
                            $datalog = [
                                'id_barang' => $barang['id_barang'],
                                'id_batch' => $newBatch['id_batch'],
                                'id_rack' => $rack['id_rack'],
                                'condition' => 'in',
                                'qty' => 0,
                                'at' => date('Y-m-d H:i:s'),
                                'by' => $this->session->userdata('id_users'),
                                'no_document' => 'Adjust Stock',
                                'description' => 'Add 0 stock on rack items by ADMIN WMS (ADMINISTRATOR)'
                            ];
                            $insertLog = $this->db->insert('wms_log', $datalog);
                            if ($insertLog) {
                                $data[] = [
                                    'sku' => $sheetData[$i][0],
                                    'batch' => $sheetData[$i][2],
                                    'sloc' => $sheetData[$i][3],
                                    'nama_barang' => $sheetData[$i][1],
                                    'id_barang' => $barang['id_barang'],
                                    'id_batch' => $newBatch['id_batch'],
                                    'id_rack' => $rack['id_rack'],
                                    'quantity_rack' => $quantityRack,
                                    'quantity' => $quantity,
                                    'notes' => $sheetData[$i][5],
                                ];
                            } else {
                                throw new Exception('Gagal menambahkan log');
                            }
                        } else {
                            throw new Exception('Gagal menambahkan rack items');
                        }
                    }
                } else {
                    throw new Exception('2. Data sku ' . $sheetData[$i][0] . 'Batch ' . $sheetData[$i][2] . ' Sloc ' . $sheetData[$i][3] . 'tidak ditemukan (ada di baris ke ' . $baris . ')');
                }
            }
            //  // create excel for data not in rack items
            //  $spreadsheet = new Spreadsheet();
            //  $sheet = $spreadsheet->getActiveSheet();
            //  $sheet->setCellValue('A1', 'SKU');
            //  $sheet->setCellValue('B1', 'Batch');
            //  $sheet->setCellValue('C1', 'Sloc');
            //  $sheet->setCellValue('D1', 'Nama Barang');
            //  $sheet->setCellValue('E1', 'Quantity');
            //  $sheet->setCellValue('F1', 'Notes');
            //  $row = 2;
            //  foreach ($dataNotInRackItems as $dataNotInRackItems1) {
            //      $sheet->setCellValue('A' . $row, $dataNotInRackItems1['sku']);
            //      $sheet->setCellValue('B' . $row, $dataNotInRackItems1['batch']);
            //      $sheet->setCellValue('C' . $row, $dataNotInRackItems1['sloc']);
            //      $sheet->setCellValue('D' . $row, $dataNotInRackItems1['nama_barang']);
            //      $sheet->setCellValue('E' . $row, $dataNotInRackItems1['quantity']);
            //      $sheet->setCellValue('F' . $row, $dataNotInRackItems1['notes']);
            //      $row++;
            //  }
            //  $writer = new Xlsx($spreadsheet);
            //  $filename = 'Adjuststock_Not_In_Rack_Items_' . date('YmdHis') . '.xlsx';
            //  header('Content-Type: application/vnd.ms-excel');
            //  header('Content-Disposition: attachment;filename="' . $filename . '"');
            //  header('Cache-Control: max-age=0');
            //  $writer->save('php://output');
            $this->load->view('user/adjuststock/import', ['data' => $data, 'title' => 'Adjuststock Bulky', 'subtitle' => 'Data Adjuststock Bulky', 'subtitle2' => 'Adjuststock bulky',]);
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('user/adjuststock/');
        }
    }
}
