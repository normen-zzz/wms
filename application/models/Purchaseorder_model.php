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

	function getDetailPurchaseOrder($uuidPo) {
		$id_purchaseorder = $this->db->query('SELECT id_purchaseorder WHERE uuid = '.$uuidPo.' ')->row_array();
		$this->db->select('*');
		$this->db->from('datapurchaseorder');
		$this->db->where('id_purchaseorder', $id_purchaseorder['id_purchaseorder']);
		return $this->db->get();
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


	 public function insert_purchaseorder($data) {
        return $this->db->insert('purchaseorder', $data) ? $this->db->insert_id() : false;
    }

    public function insert_datapurchaseorder($data) {
        return $this->db->insert('datapurchaseorder', $data);
    }

	public function getBatchBarang($id_barang) {
		return $this->db->query('SELECT  b.batchnumber,b.id_batch FROM batchitem AS a INNER JOIN batch AS b ON a.id_batch = b.id_batch WHERE a.id_barang = '.$id_barang.' AND a.qty > 0 ');
	}

	public function checkQty($id_barang,$id_batch) {
		return $this->db->query('SELECT qty FROM batchitem WHERE id_barang = '.$id_barang.' AND id_batch = '.$id_batch.' ');
	}

	public function get_last_counter()
	{
		$this->db->select_max('id_purchaseorder');
		$query = $this->db->get('purchaseorder');
		$result = $query->row();
		return $result->id_purchaseorder ? (int)$result->id_purchaseorder : 0;
	}



}

/* End of file ModelName.php */
