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
            'barang' => $this->picklist->getDataPicklist(),
        ];
        $this->load->view('user/picklist/index', $data);
    }
}

/* End of file User.php */
