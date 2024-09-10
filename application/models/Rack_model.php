<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rack_model extends CI_Model
{
	function getDataRack()
	{
		$this->db->select('*');
		$this->db->from('rack');
		$this->db->where('is_deleted', 0);
		return $this->db->get();
	}
	
	

}

/* End of file ModelName.php */
