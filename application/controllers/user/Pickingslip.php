<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pickingslip extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		is_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		$this->load->model('Pickingslip_model', 'pickingslip');
	}

	public function index()
	{
		$data = [
			'title' => 'Pickingslip',
			'subtitle' => 'Data Pickingslip',
			'subtitle2' => 'Data Pickingslip',
			'ps' => $this->pickingslip->getDataPickingslip(),
			'picker' => $this->db->query('SELECT id_users,nama FROM users WHERE role_id = 4'),

		];
		$this->load->view('user/pickingslip/index', $data);
	}

	public function detail($uuid)
	{
		$data = [
			'title' => 'Pickingslip',
			'subtitle' => 'Data Pickingslip',
			'subtitle2' => 'Data Pickingslip',
			'detailPs' => $this->pickingslip->getDetailPickingslip($uuid),
			'uuid' => $uuid,
			'status1' =>  $this->pickingslip->getStatusPickingslipByUuid($uuid),
		];
		// var_dump($data['detailPs']);
		$this->load->view('user/pickingslip/detailPickingslip', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Pickingslip',
			'subtitle' => 'Add Pickingslip',
			'subtitle2' => 'Add Pickingslip',
			'customer' => $this->db->get('customer')

		];
		$this->load->view('user/pickingslip/addPickingslip', $data);
	}

	public function pick($uuid)
	{
		$data = [
			'title' => 'Pickingslip',
			'subtitle' => 'pick Pickingslip',
			'subtitle2' => 'pick Pickingslip',
			'uuid' => $uuid
		];

		$picking_slip = $this->pickingslip->get_by_uuid($uuid);

		$items = $this->pickingslip->get_items_by_pickingslip($picking_slip['id_pickingslip']);

		$data['picking_slip'] = $picking_slip;
		$data['items'] = $items;



		$this->load->view('user/pickingslip/pick', $data);
	}

	public function getAvailableRack()
	{
		$id_barang = $this->input->post('id_barang');
		$id_batch = $this->input->post('id_batch');

		$recommendations = $this->Pickingslip_model->getAvailableRack($id_barang, $id_batch);

		echo json_encode($recommendations);
	}

	function pickFromRackProcess($uuid)
	{

		$this->db->trans_start();
		try {
			$data = $this->input->post('data');

			foreach ($data as $row) {
				$id_barang = $row['id_barang'];
				$id_batch = $row['id_batch'];
				$sloc = $row['rack'];
				$qty = $row['qty'];
				$id_datapurchaseorder =  $row['id_datapurchaseorder'];

				$id_rack =  $this->pickingslip->getIdRackFromSloc($sloc);
				$id_pickingslip =  $this->pickingslip->getIdPickingslipFromUuid($uuid);
				$nodoc_pickingslip = $this->pickingslip->getNoDocumentPickingslip($uuid);

				$getLastQtyRackItems = $this->pickingslip->getLastQtyRackItems($id_barang, $id_batch, $id_rack['id_rack']);
				if ($getLastQtyRackItems >= $qty) {
					$dataPickingslip = [
						'id_datapurchaseorder' => $id_datapurchaseorder,
						'id_pickingslip' =>  $id_pickingslip['id_pickingslip'],
						'id_barang' => $id_barang,
						'id_batch' => $id_batch,
						'id_rack' =>  $id_rack['id_rack'],
						'qty' => $qty,
						'pick_at' => date('Y-m-d H:i:s'),
						'pick_by' =>  $this->session->userdata('id_users')
					];
					$insert_datapickingslip = $this->pickingslip->insert_datapickingslip($dataPickingslip);
					$updateDataPurchaseOrder = $this->db->update('datapurchaseorder', ['status' => 1], ['id_datapurchaseorder' => $id_datapurchaseorder]);
					$updateQuantityRackItems = $this->db->update('rack_items', ['quantity' => $getLastQtyRackItems - $qty], ['id_barang' => $id_barang, 'id_batch' => $id_batch, 'id_rack' => $id_rack['id_rack']]);
					if ($insert_datapickingslip && $updateDataPurchaseOrder && $updateQuantityRackItems) {
						$dataLog = [

							'id_barang' => $id_barang,
							'id_batch' => $id_batch,
							'id_rack' =>  $id_rack['id_rack'],
							'condition' => 'out',
							'qty' => $qty,
							'at' => date('Y-m-d H:i:s'),
							'by' =>  $this->session->userdata('id_users'),
							'no_document' => $nodoc_pickingslip,
							'description' => 'Picking Slip'
						];
						$log = $this->db->insert('wms_log', $dataLog);
						if ($log) {
							$response = array('status' => 'success', 'message' => 'Pickingslip has been picked');
						} else {
							throw new Exception('Failed to insert log,All process has been rollback');
						}
					} else {
						throw new Exception('Failed to insert data pickingslip');
					}
				} else {
					throw new Exception('Quantity exceeds the available quantity');
				}
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response = array('status' => 'error', 'message' => $e->getMessage());
		}
		echo json_encode($response);
	}

	public function getQuantityRackItems()
	{
		$id_barang = $this->input->post('id_barang');
		$id_batch = $this->input->post('id_batch');
		$sloc = $this->input->post('rack');
		$id_rack =  $this->pickingslip->getIdRackFromSloc($sloc);
		$getLastQtyRackItems = $this->pickingslip->getLastQtyRackItems($id_barang, $id_batch, $id_rack['id_rack']);
		echo json_encode($getLastQtyRackItems);
	}

	public function finishPickingSlip($uuid)
	{
		$update = $this->db->update('pickingslip', ['status' => 1], ['uuid' => $uuid]);

		if ($update) {
			$this->session->set_flashdata('success', 'Pickingslip has been finished');
		} else {
			$this->session->set_flashdata('error', 'Pickingslip failed to finish');
		}
		redirect('user/Pickingslip');
	}

	// changePicker
	public function changePicker()
	{
		$this->db->trans_start();
		try {
			$id_pickingslip = $this->input->post('id_pickingslip');
			$id_picker = $this->input->post('picker');
			$update = $this->db->update('pickingslip', ['picker' => $id_picker], ['id_pickingslip' => $id_pickingslip]);
			if ($update) {
				$response = array('status' => 'success', 'message' => 'Picker has been changed');
			} else {
				throw new Exception('Failed to change picker');
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}

		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response = array('status' => 'error', 'message' => $e->getMessage());
		}

		echo json_encode($response);
	}
}

/* End of file User.php */
