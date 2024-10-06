<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pickingslip extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Pickingslip_model', 'pickingslip');
	}

	public function index()
	{
		$data = [
			'title' => 'Pickingslip',
			'subtitle' => 'Data Pickingslip',
			'subtitle2' => 'Data Pickingslip',
			'ps' => $this->pickingslip->getDataPickingslip(),
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
			$this->pickingslip->insert_datapickingslip($dataPickingslip);
			$this->db->update('datapurchaseorder', ['status' => 1], ['id_datapurchaseorder' => $id_datapurchaseorder]);
			$this->db->update('rack_items', ['quantity' => $getLastQtyRackItems - $qty], ['id_barang' => $id_barang, 'id_batch' => $id_batch, 'id_rack' => $id_rack['id_rack']]);
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
			$this->db->insert('wms_log', $dataLog);
		}

		echo json_encode([
			'status' => 'success',
			'message' => 'Picking processed successfully.'
		]);
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
}

/* End of file User.php */
