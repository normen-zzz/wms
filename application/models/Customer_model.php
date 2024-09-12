<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{
	function getDataCustomer()
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('is_deleted', 0);
		return $this->db->get();
	}
	
	

}

/* End of file ModelName.php */
