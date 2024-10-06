<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RackItems_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_rack_items($filters = [])
	{
		$this->db->select('rack_items.*, rack.sloc, barang.nama_barang, batch.batchnumber, barang.sku, SUM(rack_items.quantity) AS total_quantity,batch.expiration_date');
		$this->db->from('rack_items');
		$this->db->join('rack', 'rack_items.id_rack = rack.id_rack', 'left');
		$this->db->join('barang', 'rack_items.id_barang = barang.id_barang', 'left');
		$this->db->join('batch', 'rack_items.id_batch = batch.id_batch', 'left');
		if (!empty($filters['sku'])) {
			$this->db->like('barang.sku', $filters['sku']);
		}

		if (!empty($filters['batchnumber'])) {
			$this->db->like('batch.batchnumber', $filters['batchnumber']);
		}

		if (!empty($filters['sloc'])) {
			$this->db->like('rack.sloc', $filters['sloc']);
		}
		// where is_deleted = 0
		$this->db->where('rack.is_deleted', 0);
		$this->db->group_by(array('id_barang', 'id_batch', 'id_rack'));

		$query = $this->db->get();
		return $query->result();
	}


	public function delete_rack_item($id)
	{
		return $this->db->delete('rack_items', array('id' => $id));
	}

	public function get_rack_item($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('rack_items');
		return $query->row();
	}
}
