<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocktransfer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stocktransfer_model');
    }

    public function index() {
        
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
    public function detail($uuid) {
        $stocktransfer = $this->Stocktransfer_model->get_stocktransfer_by_uuid($uuid);
        $stocktransfer_details = $this->Stocktransfer_model->get_stocktransfer_details($uuid);

        $data = [
            'title' => 'Stock Transfer',
            'subtitle' => 'Detail Stock Transfer',
            'subtitle2' => 'Detail Stock Transfer',
            'stocktransfer' => $stocktransfer,
            'stocktransfer_details' => $stocktransfer_details
        ];

        $this->load->view('detail', $data);
    }

    // view add stock transfer show data from rack_items
    public function add() {
        $data = [
            'title' => 'Stock Transfer',
            'subtitle' => 'Add Stock Transfer',
            'subtitle2' => 'Add Stock Transfer',
            // 'rack_items' => $this->Stocktransfer_model->get_all_rack_items()
        ];

        $this->load->view('add', $data);
    }

    public function transfer() {
        $this->form_validation->set_rules('from_rack', 'From Rack', 'required');
        $this->form_validation->set_rules('to_rack', 'To Rack', 'required');
        $this->form_validation->set_rules('item_id', 'Item ID', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('stocktransfer_view');
        } else {
            $from_rack = $this->input->post('from_rack');
            $to_rack = $this->input->post('to_rack');
            $item_id = $this->input->post('item_id');
            $quantity = $this->input->post('quantity');

            if ($this->Stocktransfer_model->transfer_stock($from_rack, $to_rack, $item_id, $quantity)) {
                $this->session->set_flashdata('success', 'Stock transferred successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to transfer stock.');
            }

            redirect('stocktransfer');
        }
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
		$qty = $this->Stocktransfer_model->checkQty($barangId, $batchId,$rack)->row_array();
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

    // check available based on id_barang and id_batch and rack 


}