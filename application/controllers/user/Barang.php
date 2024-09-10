<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Barang_model', 'barang');
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Nama Barang tidak boleh kosong.'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Barang',
                'subtitle' => 'Data Barang',
                'subtitle2' => 'Data Barang',
                'barang' => $this->barang->getDataBarang(),
            ];

            $this->load->view('user/barang/index', $data);
        } else {

            $this->load->library('uuid');
            $uuid = $this->uuid->v4(true);
           
            $data = [
                'uuid' => $uuid,
                'nama_barang' => $this->input->post('name'),
                'uom' => $this->input->post('uom'),

            ];
            $this->db->insert('barang',$data);
            $this->session->set_flashdata("message", "Toast.fire({icon: 'success',title: 'Success'})");
            redirect(base_url('user/Barang'));
        }
    }
}

/* End of file User.php */
