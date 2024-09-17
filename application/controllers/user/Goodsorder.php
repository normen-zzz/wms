<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goodsorder extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Goodsorder_model', 'goodsorder');
    }

    public function index()
    {
        $data = [
            'title' => 'Goodsorder',
            'subtitle' => 'Data Goodsorder',
            'subtitle2' => 'Data Goodsorder',
            'pl' => $this->goodsorder->getDataGoodsorder(),
        ];
        $this->load->view('user/goodsorder/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Goodsorder',
            'subtitle' => 'Add Goodsorder',
            'subtitle2' => 'Add Goodsorder',
            
        ];
        $this->load->view('user/goodsorder/addGoodsorder', $data);
    }

    public function getDataBarangSelect()
	{
		$searchTerm = $this->input->post('searchTerm');
		
		if (!$searchTerm) {
			echo json_encode(['error' => 'No search term']);
			return;
		}
		$response = $this->goodsorder->selectBarang($searchTerm);

		if (empty($response)) {
			echo json_encode(['error' => 'No data found']);
		} else {
			echo json_encode($response);
		}
	}


	public function insertGoodsorder() {
    $no_goodsorder = $this->input->post('no_goodsorder');
		$created_by = $this->session->userdata('id_users');
		$status = 0; 

		$goodsorder_data = array(
			'no_goodsorder' => $no_goodsorder,
			'uuid' => uniqid(), 
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $created_by,
			'status' => $status
		);

		$insert_id = $this->goodsorder->insert_goodsorder($goodsorder_data);

		if ($insert_id) {
			$items = $this->input->post('items'); 

			// if $items adalah array dan tidak kosong
			if (is_array($items) && !empty($items)) {
				foreach ($items as $item) {
					$datagoodsorder_data = array(
						'id_goodsorder' => $insert_id,
						'id_barang' => $item['id_barang'],
						'batch' => $item['batch'],
						'qty' => $item['qty'],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $created_by
					);

					$this->goodsorder->insert_datagoodsorder($datagoodsorder_data);
				}       
				$response = array('status' => 'success', 'message' => 'Goodsorder inserted successfully.');
			} else {
				$response = array('status' => 'error', 'message' => 'No items to process.');
			}
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to insert goodsorder.');
		}

		echo json_encode($response);
	}



}

/* End of file User.php */
