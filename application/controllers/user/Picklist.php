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
    $no_picklist = generate_picklist_number();
		$created_by = $this->session->userdata('id_users');
		$qty = $this->input->post('qty');
		$status = 0; 

		$picklist_data = array(
			'no_picklist' => $no_picklist,
			'uuid' => uniqid(), 
			'qty' => $qty,
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $created_by,
			'status' => $status
		);

		$insert_id = $this->picklist->insert_picklist($picklist_data);

		if ($insert_id) {
			$response = array('status' => 'success', 'message' => 'Picklist inserted successfully.');
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to insert picklist.');
		}

		echo json_encode($response);
	}



}

/* End of file User.php */
