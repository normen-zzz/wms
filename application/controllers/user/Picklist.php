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

    public function addPicklist()
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
		// Search term
		$searchTerm = $this->input->post('searchTerm');

		// Get users
		$response = $this->picklist->selectBarang($searchTerm);
		echo json_encode($response);
	}
}

/* End of file User.php */
