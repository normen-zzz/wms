<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Putaway extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Putaway_model');
    }

    public function create_putaway() {
        if ($this->input->is_ajax_request()) {
            $data = array(
                'id_inbound' => $this->input->post('id_inbound'),
                'id_barang' => $this->input->post('id_barang'),
                'qty_putaway' => $this->input->post('qty_putaway'),
                'location' => $this->input->post('location'),
                'putaway_date' => date('Y-m-d H:i:s'),
                'created_by' => $this->input->post('created_by')
            );

            if ($this->Putaway_model->insert_putaway($data)) {
                echo json_encode(['status' => 'success', 'message' => 'Putaway created successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create putaway']);
            }
        } else {
            show_error('No direct script access allowed', 403);
        }
    }

    public function view() {
        if ($this->input->is_ajax_request()) {
            $data = $this->Putaway_model->get_all_putaways();
            echo json_encode($data);
        } else {
            show_error('No direct script access allowed', 403);
        }
    }
}
