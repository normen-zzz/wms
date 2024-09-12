<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Picklist_model extends CI_Model
{
	function getDataPicklist()
	{
		$this->db->select('*');
		$this->db->from('picklist');
		$this->db->where('is_deleted', 0);
		return $this->db->get();
	}
	
	

}

/* End of file ModelName.php */
