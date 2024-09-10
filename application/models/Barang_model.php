<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
	function getDataBarang()
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('is_deleted', 0);
		return $this->db->get();
	}
	
	

}

/* End of file ModelName.php */
