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
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_users')
            ];
            $this->db->insert('customer',$data);
            $this->session->set_flashdata("message", "Toast.fire({icon: 'success',title: 'Success'})");
            redirect(base_url('user/Customer'));
        }
    }
}

/* End of file User.php */
