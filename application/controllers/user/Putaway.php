<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Putaway extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Putaway_model');
	}

	public function index()
	{
		$data = [
			'title' => 'Putaway',
			'subtitle' => 'Data Putaway',
			'subtitle2' => 'Data Putaway',
			'putaway' => $this->Putaway_model->get_all_putaways()
		];

		$this->load->view('user/putaway/index', $data);
	}

	public function assign($uuid)
	{
		$inbound = $this->db->get_where('inbound', ['uuid' => $uuid])->row();

		$data = [
			'title' => 'Putaway',
			'subtitle' => 'Assign Putaway',
			'subtitle2' => 'Assign Putaway',
			'putaway_users' => $this->Putaway_model->get_all_user_putaways(),
			'get_id_inbound' => $inbound,
		];

		// var_dump($data);exit;

		$this->load->view('user/putaway/assignPutaway', $data);
	}

	public function assign_putaway()
	{

		$no_putaway = generate_putaway_number();

		$data = [
			'id_users' => $this->input->post('assign_user'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_users'),
			'status' => 1,
			'no_putaway' => $no_putaway,
			'uuid' => uniqid()
		];

		$result = $this->Putaway_model->insert_assign_putaway($data);

		if ($result) {
			$this->session->set_flashdata('success', 'Data Putaway has been added');
			redirect('user/putaway');
		} else {
			$this->session->set_flashdata('error', 'Data Putaway failed to add');
			redirect('user/putaway');
		}
	}

	// create putaway
	public function create($uuid)
	{

		// $putaway_details = $this->Putaway_model->get_putaway_details($uuid);
		// $inbound = $this->Putaway_model->get_id_inbound($uuid);
		$data_putaway = $this->Putaway_model->get_putaway_details($uuid);

		$data = [
			'title' => 'Putaway',
			'subtitle' => 'Create Putaway',
			'subtitle2' => 'Create Putaway',
			'data_putaway' => $data_putaway,
			'uuid' => $uuid,
		];

		// var_dump($data);exit;

		$this->load->view('user/putaway/createPutaway', $data);
	}

	public function get_rack_recommendations()
	{
		$quantity = $this->input->post('quantity');
		$recommendations = $this->Putaway_model->get_rack_recommendations($quantity);

		echo json_encode($recommendations);
	}

	public function assign_rack()
	{
		$rack_id = $this->input->post('rack_id');
		$id_barang = $this->input->post('id_barang');
		$quantity = $this->input->post('quantity');
		$batch_id = $this->input->post('batch_id');

		$result = $this->Putaway_model->assign_rack_to_item($rack_id, $id_barang, $quantity, $batch_id);

		if ($result) {
			echo json_encode(['success' => true]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to assign rack']);
		}
	}

	public function create_putaway()
	{
		$putaway_data = $this->input->post('putaway_field');

		// Mulai DB transaction
		$this->db->trans_start();

		foreach ($putaway_data as $item) {
			// Ambil data per item
			$id_barang = $item['id_barang'];
			$batch_id = $item['batch_id'];
			$id_inbound = $item['id_inbound'];
			$rack_ids = $item['id_rack'];
			$quantities = $item['quantity'];
			$id_putaway = $item['id_putaway'];

			foreach ($rack_ids as $index => $rack_id) {
				$quantity = isset($quantities[$index]) ? $quantities[$index] : 0;

				// Validasi quantity
				if ($quantity <= 0) {
					// Batalkan transaksi dan kirimkan respons error
					$this->db->trans_rollback();
					echo json_encode([
						'status' => 'error',
						'message' => "Invalid quantity for id_barang: $id_barang and rack_id: $rack_id"
					]);
					return; // Keluar dari fungsi jika ada kesalahan
				}

				// Insert data ke dalam tabel dataputaway
				$this->db->insert('dataputaway', [
					'id_putaway' => $id_putaway,
					'id_inbound' => $id_inbound,
					'id_rack' => $rack_id,
					'qty_putaway' => $quantity,
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('id_users'),
					'uuid' => uniqid(),
					'id_barang' => $id_barang,
					'batch_id' => $batch_id,
					'status' => 1
				]);

				// Assign rack ke item
				$this->Putaway_model->assign_rack_to_item($rack_id, $id_barang, $quantity, $batch_id);
			}
		}

		// Selesaikan transaksi DB
		$this->db->trans_complete();

		// Cek status transaksi
		if ($this->db->trans_status() === FALSE) {
			// Jika transaksi gagal, kirimkan respons error
			echo json_encode([
				'status' => 'error',
				'message' => 'Error occurred while processing the transaction.'
			]);
		} else {
			// Jika sukses, kirimkan respons sukses
			echo json_encode([
				'status' => 'success',
				'message' => 'Putaway and DataPutaway processed successfully.'
			]);
		}
	}
}
