<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Picklist extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Picklist_model', 'picklist');
    }

    public function index()
    {
        $data = [
            'title' => 'Picklist',
            'subtitle' => 'Data Picklist',
            'subtitle2' => 'Data Picklist',
            'pl' => $this->picklist->getDataPicklist(),
        ];
        $this->load->view('user/picklist/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Picklist',
            'subtitle' => 'Add Picklist',
            'subtitle2' => 'Add Picklist',
            
        ];
        $this->load->view('user/picklist/addPicklist', $data);
    }

    public function getDataBarangSelect()
	{
		$searchTerm = $this->input->post('searchTerm');
		
		if (!$searchTerm) {
			echo json_encode(['error' => 'No search term']);
			return;
		}
		$response = $this->picklist->selectBarang($searchTerm);

		if (empty($response)) {
			echo json_encode(['error' => 'No data found']);
		} else {
			echo json_encode($response);
		}
	}


	public function insertPicklist() {
    $no_picklist = $this->input->post('no_picklist');
		$created_by = $this->session->userdata('id_users');
		$status = 0; 

		$picklist_data = array(
			'no_picklist' => $no_picklist,
			'uuid' => uniqid(), 
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $created_by,
			'status' => $status
		);

		$insert_id = $this->picklist->insert_picklist($picklist_data);

		if ($insert_id) {
			$items = $this->input->post('items'); 

			// if $items adalah array dan tidak kosong
			if (is_array($items) && !empty($items)) {
				foreach ($items as $item) {
					$datapicklist_data = array(
						'id_picklist' => $insert_id,
						'id_barang' => $item['id_barang'],
						'batch' => $item['batch'],
						'qty' => $item['qty'],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $created_by
					);

					$this->picklist->insert_datapicklist($datapicklist_data);
				}       
				$response = array('status' => 'success', 'message' => 'Picklist inserted successfully.');
			} else {
				$response = array('status' => 'error', 'message' => 'No items to process.');
			}
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to insert picklist.');
		}

		echo json_encode($response);
	}



}

/* End of file User.php */
