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
			$response = $this->picklist->selectBarang($searchTerm); 

			echo json_encode($response);
	}


	public function insertPicklist() {
    $no_picklist = generate_picklist_number();
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
        $barang_ids = $this->input->post('barang');
        $qtys = $this->input->post('qty');
        $batches = $this->input->post('batch');
        $expired_dates = $this->input->post('ed');

        if (is_array($barang_ids) && !empty($barang_ids)) {
            foreach ($barang_ids as $key => $barang_id) {
                $datapicklist_data = array(
                    'id_picklist' => $insert_id,
                    'id_barang' => $barang_id,
                    'batch' => $batches[$key],
                    'qty' => $qtys[$key],
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


	// delete
	public function delete() {
		$id_picklist = $this->input->post('id_picklist');
		$deleted_by = $this->session->userdata('id_users');

		$data = array(
			'is_deleted' => 1,
			'deleted_at' => date('Y-m-d H:i:s'),
			'deleted_by' => $deleted_by
		);

		// var_dump($id_picklist);exit;

		$this->picklist->delete_picklist($id_picklist, $data);
		$response = array('status' => 'success', 'message' => 'Picklist deleted successfully.');
		echo json_encode($response);
	}


}

/* End of file User.php */
