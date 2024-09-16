<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbound extends CI_Controller {

   	public function __construct() {
        parent::__construct();
        $this->load->model('ReceivingInbound_model');
    }

	public function index() {
		$data = [
            'title' => 'Inbound',
            'subtitle' => 'Data Inbound',
            'subtitle2' => 'Data Inbound',
        ];
        $this->load->view('user/inbound/view', $data);
    }

    public function create_inbound() {
        if ($this->input->is_ajax_request()) {
            $data = array(
                'uuid' => uniqid(),
                'no_inbound' => $this->input->post('no_inbound'),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->input->post('created_by'),
                'status' => 0 // 0 = created
            );

            if ($this->ReceivingInbound_model->insert_inbound($data)) {
                echo json_encode(['status' => 'success', 'message' => 'Inbound created successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create inbound']);
            }
        } else {
            show_error('No direct script access allowed', 403);
        }
    }

    public function view() {
        if ($this->input->is_ajax_request()) {
            $data = $this->ReceivingInbound_model->get_all_inbounds();
            echo json_encode($data);
        } else {
            show_error('No direct script access allowed', 403);
        }
    }
}
