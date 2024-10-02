<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Customer_model', 'customer');
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Nama tidak boleh kosong.'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Customer',
                'subtitle' => 'Data Customer',
                'subtitle2' => 'Data Customer',
                'customer' => $this->customer->getDataCustomer(),
            ];

            $this->load->view('user/customer/index', $data);
        } else {

            $this->load->library('uuid');
            $uuid = $this->uuid->v4(true);
           
            $data = [
                'uuid' => $uuid,
                'nama_customer' => $this->input->post('name'),
                'alamat' =>  $this->input->post('alamat'),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_users')
            ];
            $this->db->insert('customer',$data);
            $this->session->set_flashdata("message", "Toast.fire({icon: 'success',title: 'Success'})");
            redirect(base_url('user/Customer'));
        }
    }

	public function get_customer() {
		$id_customer = $this->input->post('id_customer');
		
		$this->db->where('id_customer', $id_customer);
		$query = $this->db->get('customer');
		$customer = $query->row_array();

		echo json_encode($customer);
	}

	public function update_customer() {
		$id_customer = $this->input->post('id_customer');
		$data = [
			'nama_customer' => $this->input->post('nama_customer'),
		];

		$this->db->where('id_customer', $id_customer);
		$this->db->update('customer', $data);

		echo json_encode(['status' => 'success']);
	}


	public function delete_customer() {
		$id_customer = $this->input->post('id_customer');
		
		$this->db->where('id_customer', $id_customer);
		$this->db->update('customer', ['is_deleted' => 1]);

		echo json_encode(['status' => 'success']);
	}

}

/* End of file User.php */
