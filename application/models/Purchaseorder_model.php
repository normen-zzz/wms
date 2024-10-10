<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchaseorder_model extends CI_Model
{
	function getDataPurchaseorder()
	{
		$this->db->select('*');
		$this->db->from('purchaseorder');
		$this->db->where('is_deleted', 0);
		return $this->db->get();
	}

	function getPurchaseorderByUUid($uuid)
	{
		$this->db->select('*');
		$this->db->from('purchaseorder');

		$this->db->where('uuid', $uuid);
		return $this->db->get();
	}

	function getDetailPurchaseOrder($uuidPo)
	{
		$id_purchaseorder = $this->db->query('SELECT id_purchaseorder FROM purchaseorder WHERE uuid = "' . $uuidPo . '" ')->row_array();
		$this->db->select('sku,nama_barang,batchnumber,expiration_date,a.qty,a.id_datapurchaseorder');
		$this->db->from('datapurchaseorder a');
		$this->db->join('barang b', 'a.id_barang = b.id_barang');
		$this->db->join('batch c', 'a.id_batch = c.id_batch');
		$this->db->where('id_purchaseorder', $id_purchaseorder['id_purchaseorder']);
		return $this->db->get();
	}

	function getCustomerPurchaseorderByUuid($uuid)
	{

		$this->db->select('nama_customer,id_customer');
		$this->db->from('purchaseorder a');
		$this->db->join('customer b', 'a.customer = b.id_customer');
		$this->db->where('a.uuid', $uuid);
		$this->db->where('a.is_deleted', 0);
		return $this->db->get()->row_array();
	}

	// Fetch users
	function selectBarang($searchTerm = NULL)
	{
		$this->db->select('barang.id_barang,barang.sku,barang.nama_barang');
		$this->db->from('rack_items');
		// join barang 
		$this->db->join('barang', 'rack_items.id_barang = barang.id_barang');
	


		if ($searchTerm != NULL) {
			$this->db->where("barang.nama_barang LIKE '%" . $this->db->escape_like_str($searchTerm) . "%' OR barang.sku LIKE '%" . $this->db->escape_like_str($searchTerm) . "%'");
		}
		$this->db->where('is_deleted', 0);
		// group by barang.id_barang dan batch.id_batch dan;
		$this->db->group_by(['rack_items.id_barang']);

		$fetched_records = $this->db->get();
		$items = $fetched_records->result_array();

		$data = array();
		foreach ($items as $item) {
			$data[] = array(
				"id" => $item['id_barang'],
				"text" => $item['sku'] . ' | ' . $item['nama_barang']
			);
		}

		return $data;
	}


	public function insert_purchaseorder($data)
	{
		return $this->db->insert('purchaseorder', $data) ? $this->db->insert_id() : false;
	}

	public function insert_datapurchaseorder($data)
	{
		return $this->db->insert('datapurchaseorder', $data);
	}

	public function getBatchBarang($id_barang)
	{
		return $this->db->query('SELECT  b.batchnumber,b.id_batch FROM rack_items AS a INNER JOIN batch AS b ON a.id_batch = b.id_batch WHERE a.id_barang = ' . $id_barang . ' AND a.quantity > 0 GROUP BY b.id_batch');
	}

	public function checkQty($id_barang, $id_batch)
	{
		return $this->db->query('SELECT SUM(quantity) AS total_quantity FROM rack_items WHERE id_barang = ' . $id_barang . ' AND id_batch =' . $id_batch . '  GROUP BY id_barang, id_batch;');
	}

	public function get_last_counter($prefix = null)
	{
		if ($prefix === null) {
			$prefix = 'PO/';
		}

		$this->db->select('no_purchaseorder');
		$this->db->from('purchaseorder');
		$this->db->like('no_purchaseorder', $prefix, 'after');
		$this->db->order_by('id_purchaseorder', 'DESC');
		$this->db->limit(1);
			
		$query = $this->db->get();
		$result = $query->row();

		if ($result) {
			$parts = explode('/', $result->no_purchaseorder);
			$lastCounter = isset($parts[2]) ? (int)$parts[2] : 0;
		} else {
			$lastCounter = 0;
		}

		return $lastCounter;
	}

	public function getUserPicker()
	{
		$this->db->select('id_users,nama');
		$this->db->from('users');
		$this->db->where('role_id', 4);
		return $this->db->get();
	}

	public function get_last_counter_pickingslip($prefix = null)
	{
		if ($prefix === null) {
			$prefix = 'PS/';
		}

		$this->db->select('no_pickingslip');
		$this->db->from('pickingslip');
		$this->db->like('no_pickingslip', $prefix, 'after');
		$this->db->order_by('no_pickingslip', 'DESC');
		$this->db->limit(1);
			
		$query = $this->db->get();
		$result = $query->row();

		if ($result) {
			$parts = explode('/', $result->no_pickingslip);
			$lastCounter = isset($parts[2]) ? (int)$parts[2] : 0;
		} else {
			$lastCounter = 0;
		}

		return $lastCounter;
	}
}

/* End of file ModelName.php */
