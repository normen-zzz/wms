<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pickingslip_model extends CI_Model
{
	function getDataPickingslip()
	{
			$this->db->select('a.*, b.no_purchaseorder, b.customer');
			$this->db->from('pickingslip a');
			$this->db->join('purchaseorder b', 'a.id_purchaseorder = b.id_purchaseorder', 'right');
			$this->db->where('a.is_void', 0);
			$this->db->order_by('a.created_at', 'DESC');
			return $this->db->get();
	}

	

	function getCustomerPickingslipByUuid($uuid)  {
		
		$this->db->select('nama_customer');
		$this->db->from('pickingslip a');
		$this->db->join('customer b','a.customer = b.id_customer');
		$this->db->where('a.uuid', $uuid);
		$this->db->where('a.is_deleted', 0);
		return $this->db->get()->row_array();
	}

	

	// Fetch users
   function selectBarang($searchTerm = NULL)
	{
		$this->db->select('*');
		$this->db->from('barang');

		if (!empty($searchTerm)) {
			$this->db->where("nama_barang LIKE '%" . $this->db->escape_like_str($searchTerm) . "%' OR sku LIKE '%" . $this->db->escape_like_str($searchTerm) . "%'");
		}

		$this->db->where('is_deleted', 0);
		$this->db->limit(10);

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


	 public function insert_pickingslip($data) {
        return $this->db->insert('pickingslip', $data) ? $this->db->insert_id() : false;
    }

    public function insert_datapickingslip($data) {
        return $this->db->insert('datapickingslip', $data);
    }

	public function getBatchBarang($id_barang) {
		return $this->db->query('SELECT  b.batchnumber,b.id_batch FROM batchitem AS a INNER JOIN batch AS b ON a.id_batch = b.id_batch WHERE a.id_barang = '.$id_barang.' AND a.qty > 0 ');
	}

	public function checkQty($id_barang,$id_batch) {
		return $this->db->query('SELECT qty FROM batchitem WHERE id_barang = '.$id_barang.' AND id_batch = '.$id_batch.' ');
	}

	public function get_last_counter()
	{
		$this->db->select_max('id_pickingslip');
		$query = $this->db->get('pickingslip');
		$result = $query->row();
		return $result->id_pickingslip ? (int)$result->id_pickingslip : 0;
	}
	

	public function getUserPicker() {
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
		$this->db->order_by('id_pickingslip', 'DESC');
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


	public function get_by_uuid($uuid) {
    $this->db->where('uuid', $uuid);
    $query = $this->db->get('pickingslip');
    return $query->row_array(); 
	}

	public function get_items_by_pickingslip($id_pickingslip) {
			$this->db->select('dp.id_datapurchaseorder,b.sku, b.nama_barang, c.expiration_date, c.batchnumber, c.id_batch,b.id_barang,dp.qty');
			$this->db->from('pickingslip a'); 
			$this->db->join('datapurchaseorder dp', 'a.id_purchaseorder = dp.id_purchaseorder'); 
			$this->db->join('barang b', 'dp.id_barang = b.id_barang'); 
			$this->db->join('batch c', 'dp.id_batch = c.id_batch');
			$this->db->where('a.id_pickingslip', $id_pickingslip);
			$this->db->where('dp.status', 0); 


			
			$query = $this->db->get(); 
			return $query->result_array(); 
	}
	
	public function getAvailableRack($id_barang, $id_batch) {
			$this->db->select('sloc,a.quantity');
			$this->db->from('rack_items a'); 
			$this->db->join('rack b', 'a.id_rack = b.id_rack','left');
			$this->db->where('a.id_barang', $id_barang);
			$this->db->where('a.id_batch', $id_batch);
			$this->db->where('a.quantity >', 0);
			
			$query = $this->db->get();
			return $query->result_array(); 
	}
	

	public function getIdRackFromSloc($sloc) {
		$this->db->select('id_rack');
		$this->db->from('rack');
		$this->db->where('sloc', $sloc);
		$query = $this->db->get();
		return $query->row_array();
		
	}

	public function getIdPickingslipFromUuid($uuid) {
		$this->db->select('id_pickingslip');
		$this->db->from('pickingslip');
		$this->db->where('uuid', $uuid);
		$query = $this->db->get();
		return $query->row_array();
		
	}

	public function getLastQtyRackItems($id_barang,$id_batch,$id_rack) {
		$this->db->select('quantity');
		$this->db->from('rack_items');
		$this->db->where('id_barang', $id_barang);
		$this->db->where('id_batch', $id_batch);
		$this->db->where('id_rack', $id_rack);
		$query = $this->db->get()->row_array();
		return $query['quantity'];
	}

	function getDetailPickingslip($uuid) {
		
		$id_pickingslip = $this->db->query('SELECT id_pickingslip FROM pickingslip WHERE uuid = "'.$uuid.'" ')->row_array();
		$id = $id_pickingslip['id_pickingslip'];
		$this->db->select('b.sku,b.nama_barang,c.batchnumber,d.sloc,a.qty,a.pick_at,e.nama');
		$this->db->from('datapickingslip a');
		$this->db->join('barang b','a.id_barang = b.id_barang',);
		$this->db->join('batch c','a.id_batch = c.id_batch');
		$this->db->join('rack d','a.id_rack = d.id_rack');
		$this->db->join('users e','a.pick_by = e.id_users');
		$this->db->where('a.id_pickingslip', $id);
		return $this->db->get();
	}

	public function getStatusPickingslipByUuid($uuid) {
		 $this->db->select('status');
		 $this->db->from('pickingslip');
		 $this->db->where('uuid', $uuid);
		 $query = $this->db->get()->row_array();
		 return $query['status'];
	}

	// getNoDocumentPickingslip
	public function getNoDocumentPickingslip($uuid) {
		$this->db->select('no_pickingslip');
		$this->db->from('pickingslip');
		$this->db->where('uuid', $uuid);
		$query = $this->db->get()->row_array();
		return $query['no_pickingslip'];
	}

	






}

/* End of file ModelName.php */
