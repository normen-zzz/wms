<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Picklist_model extends CI_Model
{
	public function getDataPicklist()
	{
		$this->db->select('picklist.*, datapicklist.id_barang, datapicklist.batch, datapicklist.qty, SUM(datapicklist.qty) as total_qty');
		$this->db->from('picklist');
		$this->db->join('datapicklist', 'datapicklist.id_picklist = picklist.id_picklist');
		$this->db->where('picklist.is_deleted', 0);
		$this->db->group_by('picklist.no_picklist');
		return $this->db->get();
	}

	// Fetch users
	function selectBarang($searchTerm = NULL)
	{
		$this->db->select('*');
		$this->db->from('barang');

		if (!empty($searchTerm)) {
			$this->db->where("nama_barang LIKE '%" . $this->db->escape_like_str($searchTerm) . "%' OR sku LIKE '%" . $this->db->escape_like_str($searchTerm) . "%'");
		}

		$this->db->where('is_deleted', 0);
		$this->db->limit(10);

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

	public function insert_picklist($data)
	{
		return $this->db->insert('picklist', $data) ? $this->db->insert_id() : false;
	}

	public function insert_datapicklist($data)
	{
		return $this->db->insert('datapicklist', $data);
	}

	public function get_last_counter($prefix = null)
	{
			if ($prefix === null) {
					$prefix = 'PL/';
			}

			$this->db->select('no_picklist');
			$this->db->from('picklist');
			$this->db->like('no_picklist', $prefix, 'after');
			$this->db->order_by('id_picklist', 'DESC');
			$this->db->where('is_deleted', 0);
			$this->db->limit(1);
			
			$query = $this->db->get();
			$result = $query->row();

			if ($result) {
					$parts = explode('/', $result->no_picklist);
					$lastCounter = isset($parts[2]) ? (int)$parts[2] : 0;
			}else{
				$lastCounter = 0;
			}

			return $lastCounter;
	}

	// delete
	public function delete_picklist($id, $data)
	{
		// var_dump($id);exit;
		$this->db->where('id_picklist', $id);
		return $this->db->update('picklist', $data);
	}

	public function get_picklist_with_details($id)
	{
		$this->db->select('p.id_picklist, p.no_picklist, p.status, d.batch, d.qty');
		$this->db->from('picklist p');
		$this->db->join('datapicklist d', 'p.id_picklist = d.id_picklist');
		$this->db->where('p.id_picklist', $id);

		return $this->db->get()->row_array();
	}

	public function update_picklist($id, $data)
	{
		$this->db->where('id_picklist', $id);
		return $this->db->update('picklist', $data);
	}

	public function update_details($id, $data)
	{
		$this->db->where('id_picklist', $id);
		return $this->db->update('datapicklist', $data);
	}

	// get_picklist_by_id
	public function get_picklist_by_id($id)
	{
		$this->db->select('picklist.*, datapicklist.id_barang, datapicklist.batch, datapicklist.qty, barang.nama_barang, barang.sku, batch.batchnumber');
		$this->db->from('picklist');
		$this->db->join('datapicklist', 'datapicklist.id_picklist = picklist.id_picklist');
		$this->db->join('barang', 'datapicklist.id_barang = barang.id_barang');
		$this->db->join('batch', 'datapicklist.batch = batch.id_batch');
		$this->db->where('picklist.id_picklist', $id);
		$this->db->order_by('picklist.id_picklist', 'DESC');
		
		return $this->db->get()->result_array();
	}

}

/* End of file ModelName.php */
