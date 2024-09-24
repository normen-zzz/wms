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
        'inbound_data' => $this->ReceivingInbound_model->get_inbound_data()
    ];

			$this->load->view('user/inbound/index', $data);
	}


	public function add() {
		$data = [
						'title' => 'Inbound',
						'subtitle' => 'Add Inbound',
						'subtitle2' => 'Add Inbound',
				];
				$this->load->view('user/inbound/add', $data);
	}


  public function create($uuid)
	{

		$detailPl = $this->ReceivingInbound_model->get_detils_inbound($uuid);
		$picklist = $this->ReceivingInbound_model->get_picklist_byuuid($uuid);

		$data = [
			'title' => 'inbound',
			'subtitle' => 'Data inbound',
			'subtitle2' => 'Data inbound',
			'detailPl' => $detailPl,
			'uuid' => $uuid,
			'picklist' => $picklist,
		];
		$this->load->view('user/inbound/createInbound', $data);
	}


	public function process() {
			$id_picklist = $this->input->post('id_picklist');
			$received_qty = $this->input->post('received_qty');
			$status = $this->input->post('status');
			$created_by = $this->session->userdata('id_users');
			$good_qty = $this->input->post('good_qty'); 
			$bad_qty = $this->input->post('bad_qty'); 
			$batch_id = $this->input->post('batch_id'); 
			$no_inbound = generate_inbound_number();

			foreach ($good_qty as $index => $good) {
					$data_inbound = array(
							'id_picklist' => $id_picklist,
							'no_inbound' => $no_inbound,
							'received_qty' => $received_qty,
							'received_date' => date('Y-m-d'),
							'status' => 'received',
							'good_qty' => $good, 
							'bad_qty' => $bad_qty[$index], 
							'batch_id' => $batch_id[$index], 
							'created_at' => date('Y-m-d H:i:s'),
							'created_by' => $created_by,
							'uuid' => uniqid(),
					);

					$this->ReceivingInbound_model->insert_inbound($data_inbound);
			}

			$this->ReceivingInbound_model->update_status_picklist($id_picklist, 1);

			$response = array('status' => 'success', 'message' => 'Inbound process successfully.');
			echo json_encode($response);
	}



	public function getDataPicklist() {
				if ($this->input->is_ajax_request()) {
						$searchTerm = $this->input->post('searchTerm');
						$data = $this->ReceivingInbound_model->get_picklist($searchTerm);
						echo json_encode($data);
				} else {
						show_error('No direct script access allowed', 403);
				}
	}

	public function getBatchData() {
				if ($this->input->is_ajax_request()) {
						$id = $this->input->post('id');
						$data = $this->ReceivingInbound_model->get_batch($id);
						echo json_encode($data);
				} else {
						show_error('No direct script access allowed', 403);
				}
	}

	// detail
	public function detail($uuid) {
    $inbound = $this->ReceivingInbound_model->get_inbound_byuuid($uuid);
		$inbound_details = $this->ReceivingInbound_model->get_detils_inboundpl($uuid);

    $data = [
        'title' => 'Inbound',
        'subtitle' => 'Detail Inbound',
        'subtitle2' => 'Detail Inbound',
        'inbound' => $inbound,
				'inbound_details' => $inbound_details,
    ];

    // Load the view with the data
    $this->load->view('user/inbound/detail', $data);
	}

}
