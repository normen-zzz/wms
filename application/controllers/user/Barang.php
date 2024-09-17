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
            $sku = $this->input->post('sku');
            $data = [
                'uuid' => $uuid,
                'sku' => $sku,
                'nama_barang' => $this->input->post('name'),
                'uom' => $this->input->post('uom'),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_users')

            ];

            $checkSku = $this->db->query('SELECT sku FROM barang WHERE sku = "' . $sku . '" ');
            if ($checkSku->num_rows() == 0) {
                $this->db->insert('barang', $data);
                $this->session->set_flashdata("message", "Toast.fire({icon: 'success',title: 'Success'})");
            } else {
                $this->session->set_flashdata("message", "Toast.fire({icon: 'failed',title: 'failed,SKU already exists'})");
            }
            redirect(base_url('user/Barang'));
        }
    }

	public function get_barang($id_barang) {
		$barang = $this->barang->get_barang_by_id($id_barang);
		echo json_encode($barang);
	}

	public function update_barang() {
		$id_barang = $this->input->post('id_barang');
		$data = array(
			'sku' => $this->input->post('sku'),
			'nama_barang' => $this->input->post('nama_barang'),
			'uom' => $this->input->post('uom')
		);
		
		var_dump($data); exit;

		$this->barang->update_barang($id_barang, $data);
		echo json_encode(['success' => true]);
	}

	public function delete_barang($id_barang) {
		$this->barang->delete_barang($id_barang);
		echo json_encode(['success' => true]);
	}



}

/* End of file User.php */
