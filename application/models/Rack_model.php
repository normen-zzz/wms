<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rack_model extends CI_Model
{
	function getDataRack()
	{
		$this->db->select('*');
		$this->db->from('rack');
		// $this->db->where('is_deleted', 0);
		return $this->db->get();
	}
	
	public function getGroupedItemsBySloc($sloc) {
      $this->db->select('r.sloc, b.sku, ba.batchnumber, SUM(bi.qty) as total_quantity');
      $this->db->from('rack r');
      $this->db->join('rack_items ri', 'r.id_rack = ri.id_rack', 'inner');
      $this->db->join('barang b', 'ri.id_barang = b.id_barang', 'inner');
      $this->db->join('batch ba', 'ri.id_batch = ba.id_batch', 'inner');
      $this->db->join('batchitem bi', 'b.id_barang = bi.id_barang', 'inner');
      $this->db->where('r.sloc', $sloc);
      $this->db->group_by(['r.sloc', 'b.sku', 'ba.batchnumber']);

      $query = $this->db->get();

      return $query->result_array();
  }
}

/* End of file ModelName.php */
