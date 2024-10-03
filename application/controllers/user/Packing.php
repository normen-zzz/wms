<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Packing extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Packing_model', 'packing');
	}

	public function index()
	{
		$data = [
			'title' => 'Packing',
			'subtitle' => 'Data Packing',
			'subtitle2' => 'Data Packing',
			'packing' => $this->packing->getPacking(),
		];
		$this->load->view('user/packing/index', $data);
	}

	public function detail($uuidPacking)
	{
		$data = [
			'title' => 'Packing',
			'subtitle' => 'Data Packing',
			'subtitle2' => 'Data Packing',
			'detailPacking' => $this->packing->getDetailPacking($uuidPacking),
			'uuid' => $uuidPacking,
			
		];
		// var_dump($data['detailPs']);
		$this->load->view('user/packing/detailPacking', $data);
	}

    public function processPickingslipToPacking($uuid) {
        $pickingslip = $this->db->get_where('pickingslip',['uuid' => $uuid])->row_array();
        $packing = [
			'uuid' => uniqid(),
            'no_packing' => generate_packing_number(),
            'id_pickingslip' => $pickingslip['id_pickingslip'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' =>  $this->session->userdata('id_users'),
			'status' => 0
        ];
        $this->db->insert('packing',$packing);
        $id_packing =  $this->db->insert_id();

        $dataPickingslipToPacking = $this->packing->dataPickingslipToPacking($pickingslip['id_pickingslip'])->result_array();
        foreach ($dataPickingslipToPacking as $data) {
            $dataPacking = [
                'id_packing' =>  $id_packing,
                'id_barang' => $data['id_barang'],
                'id_batch' =>  $data['id_batch'],
                'qty' =>  $data['total_quantity'],
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' =>  $this->session->userdata('id_users'),
            ];
            $this->db->insert('datapacking',$dataPacking);
        }
        //update status pickingslip
        $this->db->update('pickingslip',['status' => 2],['id_pickingslip' => $pickingslip['id_pickingslip']]);
        $this->session->set_flashdata('message','Data Pickingslip telah diproses ke packing');
        redirect('user/Packing');

       

        


        
    }

}

/* End of file User.php */
