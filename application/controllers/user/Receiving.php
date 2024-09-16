<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receiving extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DataReceivingInbound_model');
    }

	public function index() {
		$data = array(
			'title' => 'Receiving Inbound',
			'subtitle' => 'Add Receiving Inbound',
			'subtitle2' => 'Data Receiving Inbound'
		);
	

		$this->load->view('user/receiving/index', $data);
	}



    public function add_receiving() {
        if ($this->input->is_ajax_request()) {
            $data = array(
                'id_inbound' => $this->input->post('id_inbound'),
                'id_barang' => $this->input->post('id_barang'),
                'batch' => $this->input->post('batch'),
                'qty_received' => $this->input->post('qty_received'),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->input->post('created_by')
            );

            if ($this->DataReceivingInbound_model->insert_data($data)) {
                echo json_encode(['status' => 'success', 'message' => 'Receiving data added successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add receiving data']);
            }
        } else {
            show_error('No direct script access allowed', 403);
        }
    }

    public function view_receiving($id_inbound) {
        if ($this->input->is_ajax_request()) {
            $data = $this->DataReceivingInbound_model->get_data_by_inbound($id_inbound);
            echo json_encode($data);
        } else {
            show_error('No direct script access allowed', 403);
        }
    }
}
