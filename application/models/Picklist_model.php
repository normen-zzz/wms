<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Picklist_model extends CI_Model
{
	public function getDataPicklist()
	{
			$this->db->select('picklist.*, datapicklist.id_barang, datapicklist.batch, datapicklist.qty');
			$this->db->from('picklist');
			$this->db->join('datapicklist', 'datapicklist.id_picklist = picklist.id_picklist');
			$this->db->where('picklist.is_deleted', 0);
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

	 public function insert_picklist($data) {
        return $this->db->insert('picklist', $data) ? $this->db->insert_id() : false;
    }

    public function insert_datapicklist($data) {
        return $this->db->insert('datapicklist', $data);
    }

		public function get_last_counter() {
        $this->db->select_max('id_picklist');
        $query = $this->db->get('picklist');
        $result = $query->row();
        return $result->id_picklist ? (int)$result->id_picklist : 0;
    }

		// delete
		public function delete_picklist($id, $data){
			// var_dump($id);exit;
			$this->db->where('id_picklist', $id);
			return $this->db->update('picklist', $data);
		}
}

/* End of file ModelName.php */
