<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

	// count total rack items
	public function count_total_rack_items()
	{
			$this->db->select('COUNT(id) as total_rack_items');
			$this->db->from('rack_items');
			$query = $this->db->get();
			return $query->row()->total_rack_items;
	}

	// users
	public function count_total_users()
	{
			$this->db->select('COUNT(id_users) as total_users');
			$this->db->from('users');
			$query = $this->db->get();
			return $query->row()->total_users;
	}

	public function count_incoming_items_per_month()
	{
			$this->db->select('DATE_FORMAT(created_at, "%Y-%m-01") as month, COUNT(id) as total_incoming_items');
			$this->db->from('rack_items');
			$this->db->group_by('month');
			$this->db->order_by('month', 'DESC'); 
			$query = $this->db->get();

			return $query->result();
	}

	public function count_outgoing_items_per_month()
	{
			$this->db->select('DATE_FORMAT(pick_at, "%Y-%m-01") as month, COUNT(id_datapickingslip) as total_outgoing_items');
			$this->db->from('datapickingslip');
			$this->db->group_by('month');
			$this->db->order_by('month', 'DESC'); 
			$query = $this->db->get();

			return $query->result();
	}



}

/* End of file ModelName.php */
