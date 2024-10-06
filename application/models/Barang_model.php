<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
	function getDataBarang()
	{
		$this->db->select('*');
		$this->db->from('barang');
		return $this->db->get();
	}
	
	public function get_barang_by_id($id_barang) {
    return $this->db->get_where('barang', array('id_barang' => $id_barang))->row_array();
	}

	public function update_barang($id_barang, $data) {
			$this->db->where('id_barang', $id_barang);
			return $this->db->update('barang', $data);
	}

	public function delete_barang($id_barang) {
    $this->db->where('id_barang', $id_barang);
    return $this->db->update('barang', ['is_deleted' => 1]);
	}

	
	public function activated_barang($id_barang) {
    $this->db->where('id_barang', $id_barang);
    return $this->db->update('barang', ['is_deleted' => 0]);
	}
	
}

/* End of file ModelName.php */
