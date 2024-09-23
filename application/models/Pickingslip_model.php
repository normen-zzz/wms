<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pickingslip_model extends CI_Model
{
	function getDataPickingslip()
	{
		$this->db->select('a.*,b.no_purchaseorder,b.customer');
		$this->db->from('pickingslip a');
		$this->db->join('purchaseorder b','a.id_purchaseorder = b.id_purchaseorder');
		$this->db->where('is_void', 0);
		return $this->db->get();
	}

	function getDetailPurchaseOrder($uuidPo) {
		$id_pickingslip = $this->db->query('SELECT id_pickingslip FROM pickingslip WHERE uuid = "'.$uuidPo.'" ')->row_array();
		$this->db->select('sku,nama_barang,batchnumber,expiration_date,a.qty');
		$this->db->from('datapickingslip a');
		$this->db->join('barang b','a.id_barang = b.id_barang');
		$this->db->join('batch c','a.id_batch = c.id_batch');
		$this->db->where('id_pickingslip', $id_pickingslip['id_pickingslip']);
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
		$this->db->select('');
		$this->db->from('barang');
		

		if ($searchTerm != NULL) {
			$this->db->where("nama_barang LIKE '%" . $this->db->escape_like_str($searchTerm) . "%' OR sku LIKE '%" . $this->db->escape_like_str($searchTerm) . "%'");
		}
		$this->db->where('is_deleted',0);

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

	public function get_last_counter_pickingslip()
	{
		$this->db->select_max('id_pickingslip');
		$query = $this->db->get('pickingslip');
		$result = $query->row();
		return $result->id_pickingslip ? (int)$result->id_pickingslip : 0;
	}

	public function get_by_uuid($uuid) {
    $this->db->where('uuid', $uuid);
    $query = $this->db->get('pickingslip');
    return $query->row_array(); 
	}

	public function get_items_by_pickingslip($id_pickingslip) {
			$this->db->select('b.sku, b.nama_barang, c.expiration_date, c.batchnumber, c.id_batch');
			$this->db->from('pickingslip a'); 
			$this->db->join('datapurchaseorder dp', 'a.id_purchaseorder = dp.id_purchaseorder'); 
			$this->db->join('barang b', 'dp.id_barang = b.id_barang'); 
			$this->db->join('batch c', 'dp.id_batch = c.id_batch');
			$this->db->where('a.id_pickingslip', $id_pickingslip); 
			
			$query = $this->db->get(); 
			return $query->result_array(); 
	}
	
	public function getAvailableRacksBySkuAndBatch($sku, $batchnumber) {
			$this->db->select('r.rack, r.sloc, r.zone, r.row, r.column_rack, ri.quantity, b.nama_barang');
			$this->db->from('rack_items ri');
			$this->db->join('rack r', 'ri.id_rack = r.id_rack');
			$this->db->join('barang b', 'ri.id_barang = b.id_barang');
			$this->db->where('b.sku', $sku);
			$this->db->where('ri.id_batch', $batchnumber); 
			$this->db->where('ri.quantity > 0'); 
			$query = $this->db->get();
			return $query->result_array(); 
	}






}

/* End of file ModelName.php */
