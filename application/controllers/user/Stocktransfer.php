<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stocktransfer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Stocktransfer_model');
    }

    public function index()
    {

        // show data stock transfer 
        $data = [
            'title' => 'Stock Transfer',
            'subtitle' => 'Data Stock Transfer',
            'subtitle2' => 'Data Stock Transfer',
            'stocktransfer' => $this->Stocktransfer_model->get_all_stocktransfer()
        ];
        $this->load->view('user/stocktransfer/index', $data);
    }

    //detail stock transfer
    public function detail($uuid)
    {
        $stocktransfer = $this->Stocktransfer_model->get_stocktransfer_by_uuid($uuid);
        $stocktransfer_details = $this->Stocktransfer_model->get_stocktransfer_details($stocktransfer->id_stocktransfer);

        $data = [
            'title' => 'Stock Transfer',
            'subtitle' => 'Detail Stock Transfer',
            'subtitle2' => 'Detail Stock Transfer',
            'stocktransfer' => $stocktransfer,
            'stocktransfer_details' => $stocktransfer_details
        ];

        // var_dump($stocktransfer_details->result_array());
        $this->load->view('user/stocktransfer/detail', $data);
    }

    //detail stock transfer
    public function process($uuid)
    {
        $stocktransfer = $this->Stocktransfer_model->get_stocktransfer_by_uuid($uuid);
        $stocktransfer_details = $this->Stocktransfer_model->get_stocktransfer_details($stocktransfer->id_stocktransfer);

        $data = [
            'title' => 'Stock Transfer',
            'subtitle' => 'Process Stock Transfer',
            'subtitle2' => 'Process Stock Transfer',
            'stocktransfer' => $stocktransfer,
            'stocktransfer_details' => $stocktransfer_details
        ];

        // var_dump($stocktransfer_details->result_array());
        $this->load->view('user/stocktransfer/process', $data);
    }

    // view add stock transfer show data from rack_items
    public function add()
    {
        $data = [
            'title' => 'Stock Transfer',
            'subtitle' => 'Add Stock Transfer',
            'subtitle2' => 'Add Stock Transfer',
            // 'rack_items' => $this->Stocktransfer_model->get_all_rack_items()
        ];

        $this->load->view('user/stocktransfer/add', $data);
    }



    public function getDataBarangSelect()
    {
        $searchTerm = $this->input->post('searchTerm');

        if (!$searchTerm) {
            echo json_encode(['error' => 'No search term']);
            return;
        }
        $response = $this->Stocktransfer_model->selectBarang($searchTerm);

        if (empty($response)) {
            echo json_encode(['error' => 'No data found']);
        } else {
            echo json_encode($response);
        }
    }


    public function getBatch()
    {
        $barangId = $this->input->post('barangId');
        $batchOptions = $this->Stocktransfer_model->getBatchBarang($barangId);
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
        $qty = $this->Stocktransfer_model->checkQty($barangId, $batchId, $rack)->row_array();
        echo json_encode($qty['total_quantity']);
    }

    // getRecommendedRack
    public function get_rack_recommendations()
    {
        // from id barang and batch 
        $id_barang = $this->input->post('id_barang');
        $id_batch = $this->input->post('id_batch');
        $rack = $this->Stocktransfer_model->getRecommendedRack($id_barang, $id_batch);
        echo json_encode($rack);
    }

    //    insert stock transfer 
    public function insertStocktransfer()
    {

        $this->db->trans_start();
        try {
            $data = [

                'uuid' => uniqid(),
                'no_stocktransfer' => generate_stocktransfer_number(),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_users')
            ];

            $this->Stocktransfer_model->insert_stocktransfer($data);
            $id_stocktransfer = $this->db->insert_id();

            $id_barang = $this->input->post('barang');
            $id_batch = $this->input->post('batch');
            $from_rack = $this->input->post('from');
            $to_rack = $this->input->post('to');
            $quantity = $this->input->post('qty');



            for ($i = 0; $i < count($id_barang); $i++) {

                $checkSloc = $this->Stocktransfer_model->checkSloc($to_rack[$i]);
                $from = $this->db->query('SELECT id_rack FROM rack WHERE sloc = "' . $from_rack[$i] . '"')->row_array();
                $to = $this->db->query('SELECT id_rack FROM rack WHERE sloc = "' . $to_rack[$i] . '"')->row_array();
                if ($checkSloc->num_rows() == 0) {
                    throw new Exception('Rack ' . $to_rack[$i] . ' tidak ditemukan');
                }
                // add to array 
                $dataStockTransfer = [
                    'id_stocktransfer' => $id_stocktransfer,
                    'id_barang' => $id_barang[$i],
                    'id_batch' => $id_batch[$i],
                    'from_rack' => $from['id_rack'],
                    'to_rack' => $to['id_rack'],
                    'quantity' => $quantity[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_users'),
                    'status' => 0
                ];
                $insertDataStockTransfer = $this->Stocktransfer_model->insert_stocktransfer_data($dataStockTransfer);
                if (!$insertDataStockTransfer) {
                    throw new Exception('Gagal menambahkan stock transfer');
                }
            }
            // insert batch 

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menambahkan stock transfer');
            }
            $response = array('status' => 'success', 'message' => 'Stock transfer berhasil ditambahkan');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $response = array('status' => 'error', 'message' => $e->getMessage());
        }

        echo json_encode($response);
    }

    public function delete($uuid)
    {
        $this->Stocktransfer_model->delete_stocktransfer($uuid);
        $this->session->set_flashdata('success', 'Data stock transfer berhasil dihapus');
        redirect('user/stocktransfer');
    }

    // processStockTransferData
    public function processStockTransferData()
    {
        // db transaction start
        $this->db->trans_start();
        try {
            $id_stocktransferdata = $this->input->post('id_stocktransferdata');
            $dataStockTransfer = [
                'status' => 1
            ];
            $this->Stocktransfer_model->update_stocktransfer_data($id_stocktransferdata, $dataStockTransfer);
            // update rack items 
            $stocktransferData = $this->Stocktransfer_model->get_stocktransfer_data($id_stocktransferdata);
            $no_stocktransfer = $this->db->query('SELECT no_stocktransfer FROM stocktransfer WHERE id_stocktransfer = ' . $stocktransferData->id_stocktransfer)->row_array();
            $rackItemsTo = $this->Stocktransfer_model->get_rack_items($stocktransferData->id_barang, $stocktransferData->id_batch, $stocktransferData->to_rack);
            $rackItemsFrom = $this->Stocktransfer_model->get_rack_items($stocktransferData->id_barang, $stocktransferData->id_batch, $stocktransferData->from_rack);
            if ($rackItemsTo->num_rows() == 0) {
                $dataRackItemsTo = [
                    'id_rack' => $stocktransferData->to_rack,
                    'id_barang' => $stocktransferData->id_barang,
                    'id_batch' => $stocktransferData->id_batch,
                    'quantity' => $stocktransferData->quantity,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_users')
                ];
                $this->Stocktransfer_model->insert_rack_items($dataRackItemsTo);
                $dataWmsLog = [
                    'id_barang' => $stocktransferData->id_barang,
                    'id_batch' => $stocktransferData->id_batch,
                    'id_rack' => $stocktransferData->to_rack,
                    'condition' => 'in',
                    'qty' => $stocktransferData->quantity,
                    'at' => date('Y-m-d H:i:s'),
                    'by' => $this->session->userdata('id_users'),
                    'no_document' => $no_stocktransfer['no_stocktransfer']
                ];
                $this->Stocktransfer_model->insert_wms_log($dataWmsLog);
            } else {
                $rackItem = $rackItemsTo->row();
                $dataRackItemsTo = [
                    'quantity' => $rackItem->quantity + $stocktransferData->quantity
                ];
                $this->Stocktransfer_model->update_rack_items($rackItem->id, $dataRackItemsTo);
                // insert log to wms_log
                $dataWmsLog = [
                    'id_barang' => $stocktransferData->id_barang,
                    'id_batch' => $stocktransferData->id_batch,
                    'id_rack' => $stocktransferData->to_rack,
                    'condition' => 'in',
                    'qty' => $stocktransferData->quantity,
                    'at' => date('Y-m-d H:i:s'),
                    'by' => $this->session->userdata('id_users'),
                    'no_document' => $no_stocktransfer['no_stocktransfer']
                ];
                $this->Stocktransfer_model->insert_wms_log($dataWmsLog);
                
            }
            $dataRackItemsFrom = [
                'quantity' => $rackItemsFrom->row()->quantity - $stocktransferData->quantity
            ];

            $this->Stocktransfer_model->update_rack_items($rackItemsFrom->row()->id, $dataRackItemsFrom);
            $dataWmsLog = [
                'id_barang' => $rackItemsFrom->row()->id_barang,
                'id_batch' => $rackItemsFrom->row()->id_batch,
                'id_rack' => $rackItemsFrom->row()->id_rack,
                'condition' => 'out',
                'qty' => $stocktransferData->quantity,
                'at' => date('Y-m-d H:i:s'),
                'by' => $this->session->userdata('id_users'),
                'no_document' => $no_stocktransfer['no_stocktransfer']
            ];
            $this->Stocktransfer_model->insert_wms_log($dataWmsLog);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menambahkan stock transfer');
            }
            $response = array('status' => 'success', 'message' => 'Stock transfer berhasil diproses');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $response = array('status' => 'error', 'message' => $e->getMessage());
        }
        echo json_encode($response);
    }

    // finishProcessStockTransferData
    public function finishProcessStockTransfer()
    {
        $this->input->post('id_stocktransfer');
        $this->Stocktransfer_model->finishProcessStockTransferData($this->input->post('id_stocktransfer'));
        $response = array('status' => 'success', 'message' => 'Stock transfer berhasil finish');
        echo json_encode($response);
    }
}

