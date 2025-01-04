<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adjuststock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
                    $dataBarang = $this->db->query('SELECT nama_barang FROM barang WHERE id_barang = ' . $id_barang[$i])->row_array();
                    $dataBatch = $this->db->query('SELECT batchnumber FROM batch WHERE id_batch = ' . $id_batch[$i])->row_array();
                    $dataRack = $this->db->query('SELECT sloc FROM rack WHERE id_rack = ' . $checkSloc)->row_array();

                    $dataAdjuststockWa .= 'Barang : '. $dataBarang['sku'] .' ' . $dataBarang['nama_barang'] . '<br> Batch : ' . $dataBatch['batchnumber'] . '<br> Rack : ' . $dataRack['sloc'] . '<br> Quantity (Before) : ' . $quantityBefore['quantity'] . '<br> Quantity (After) : ' . $quantity[$i] . '<br> Notes : ' . $notes[$i] . ' \r\n\r\n';
                }
                $insertDataAdjuststock = $this->adjuststock->insert_data_adjuststock($batchDataAdjuststock);
                if ($insertDataAdjuststock) {
                    $superadmin = $this->db->query('SELECT no_handphone FROM users WHERE role_id = 1')->result_array();
                    foreach ($superadmin as $admin) {
                        $this->whatsapp->kirim($admin['no_handphone'], 'Adjust Stock baru telah ditambahkan oleh ' . $this->session->userdata('nama') . ' dengan nomor ' . $no_adjuststock . ', Berikut Datanya : <br><br> ' . $dataAdjuststockWa . ' Silahkan cek di warehouse.transtama.com Untuk melakukan Approval');
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
                        } else{
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
}
