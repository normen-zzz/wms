<?php
class ReceivingInbound_model extends CI_Model {

  public function insert_inbound($data) {
			return $this->db->insert('inbound', $data); 
	}


	public function get_inbound_data() {
		$this->db->select('inbound.*, batch.batchnumber, batch.expiration_date, picklist.no_picklist'); 
		$this->db->from('inbound'); 
		$this->db->join('batch', 'inbound.batch_id = batch.id_batch', 'left'); 
		$this->db->join('picklist', 'inbound.id_picklist = picklist.id_picklist', 'left');
		$query = $this->db->get();
		return $query->result(); 
	}

	public function get_detils_inbound($uuid) {
			$id_picklist = $this->db->query('SELECT id_picklist FROM picklist WHERE uuid = "'.$uuid.'" ')->row_array();
			
			$this->db->select('sku, nama_barang, batchnumber, expiration_date, a.qty');
			$this->db->from('datapicklist a');
			$this->db->join('barang b', 'a.id_barang = b.id_barang');
			$this->db->join('batch c', 'a.batch = c.id_batch');
			$this->db->where('id_picklist', $id_picklist['id_picklist']);

			return $this->db->get()->result_array();
	}

	public function get_picklist_byuuid($uuid) {
		$this->db->select('picklist.no_picklist, picklist.id_picklist, datapicklist.qty, datapicklist.batch');
		$this->db->from('picklist');
		$this->db->join('datapicklist', 'datapicklist.id_picklist = picklist.id_picklist', 'left');
		$this->db->where('picklist.uuid', $uuid);
		return $this->db->get()->row();
	}

	public function get_batch($id) {
		$this->db->select('datapicklist.*, batch.*'); 
		$this->db->from('datapicklist');
		$this->db->join('batch', 'batch.id_batch = datapicklist.batch', 'left'); 
		$this->db->where('datapicklist.id_picklist', $id);
		
		$query = $this->db->get();
		return $query->row();
	}

	// get_picklist
	public function get_picklist($searchTerm = NULL)
	{
		$this->db->select('*');
		$this->db->from('picklist');

		if (!empty($searchTerm)) {
			$this->db->where("no_picklist LIKE '%" . $this->db->escape_like_str($searchTerm) . "%' OR sku LIKE '%" . $this->db->escape_like_str($searchTerm) . "%'");
		}

		$this->db->where('is_deleted', 0);

		$fetched_records = $this->db->get();
		$items = $fetched_records->result_array();

		$data = array();
		foreach ($items as $item) {
			$data[] = array(
				"id" => $item['id_picklist'],
				"text" => $item['no_picklist']
			);
		}

		return $data;
	}

	public function get_last_counter()
	{
		$this->db->select_max('id_inbound');
		$query = $this->db->get('inbound');
		$result = $query->row();
		return $result->id_inbound ? (int)$result->id_inbound : 0;
	}

	public function update_status_picklist($id_picklist, $status) {
		$this->db->where('id_picklist', $id_picklist);
		$this->db->update('picklist', ['status' => $status]);
	}

	public function get_inbound_byuuid($uuid) {
    $this->db->where('uuid', $uuid);
    return $this->db->get('inbound')->row();  
	}


	public function get_detils_inboundpl($uuid) {
			$id_picklist = $this->db->query('SELECT id_picklist FROM inbound WHERE uuid = "'.$uuid.'" ')->row_array();
			
			$this->db->select('p.no_picklist, sku, b.nama_barang, c.batchnumber, c.expiration_date, a.qty');
			$this->db->from('datapicklist a');
			$this->db->join('picklist p', 'p.id_picklist = a.id_picklist');
			$this->db->join('barang b', 'a.id_barang = b.id_barang');
			$this->db->join('batch c', 'a.batch = c.id_batch');
			$this->db->where('a.id_picklist', $id_picklist['id_picklist']);
			
			// Return the result as an array
			return $this->db->get()->result_array();
	}

}
?>
