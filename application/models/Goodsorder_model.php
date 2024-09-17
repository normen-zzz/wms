<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goodsorder_model extends CI_Model
{
	function getDataGoodsorder()
	{
		$this->db->select('*');
		$this->db->from('goodsorder');
		$this->db->where('is_deleted', 0);
		return $this->db->get();
	}

	// Fetch users
    function selectBarang($searchTerm = NULL)
	{
		$this->db->select('*');
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


	 public function insert_goodsorder($data) {
        return $this->db->insert('goodsorder', $data) ? $this->db->insert_id() : false;
    }

    public function insert_datagoodsorder($data) {
        return $this->db->insert('datagoodsorder', $data);
    }


}

/* End of file ModelName.php */
