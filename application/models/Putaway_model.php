<?php
class Putaway_model extends CI_Model {

    public function insert_putaway($data) {
        return $this->db->insert('putaway', $data);
    }

    public function get_all_putaways() {
        $query = $this->db->get('putaway');
        return $query->result();
    }

	public function get_putaway_details($uuid) {
		$this->db->select('inbound.*, barang.*, batch.*, rack.sloc, rack.zone, rack.rack, rack.row, rack.column_rack, rack_items.quantity as rack_quantity');
		$this->db->from('inbound');
		$this->db->join('picklist', 'inbound.id_picklist = picklist.id_picklist');
		$this->db->join('datapicklist', 'picklist.id_picklist = datapicklist.id_picklist');
		$this->db->join('barang', 'datapicklist.id_barang = barang.id_barang');
		$this->db->join('batch', 'inbound.batch_id = batch.id_batch');
		$this->db->join('rack_items', 'barang.id_barang = rack_items.id_barang AND batch.id_batch = rack_items.id_batch', 'left');
		$this->db->join('rack', 'rack_items.id_rack = rack.id_rack', 'left');
		$this->db->where('inbound.uuid', $uuid);
		
		return $this->db->get()->result_array();
	}

	public function get_rack_recommendations($quantity) {
		$this->db->select('rack.*, COALESCE(SUM(rack_items.quantity), 0) as used_capacity');
		$this->db->from('rack');
		$this->db->join('rack_items', 'rack.id_rack = rack_items.id_rack', 'left');
		$this->db->where('rack.is_deleted', 0);
		$this->db->where('rack.status', 1);
		$this->db->group_by('rack.id_rack');
		$this->db->having("(rack.max_qty - COALESCE(SUM(rack_items.quantity), 0)) >=", (int)$quantity);
	
		$this->db->order_by('(rack.max_qty - COALESCE(SUM(rack_items.quantity), 0))', 'ASC', FALSE);
		
		$this->db->limit(5);
		
		return $this->db->get()->result_array();
	}

	public function get_id_inbound($uuid) {
		$this->db->select('no_inbound');
		$this->db->from('inbound');
		$this->db->where('uuid', $uuid);
		return $this->db->get()->row();
	}

	public function assign_rack_to_item($rack_id, $id_barang, $quantity, $batch_id) {
		$existing = $this->db->get_where('rack_items', [
				'id_barang' => $id_barang,
				'id_batch' => $batch_id,
				'id_rack' => $rack_id
		])->row();

		if ($existing) {
			$this->db->where([
				'id_barang' => $id_barang,
				'id_batch' => $batch_id,
				'id_rack' => $rack_id
			]);
			$this->db->set('quantity', 'quantity + ' . $quantity, FALSE);
			return $this->db->update('rack_items');
		} else {
			$data = [
				'id_barang' => $id_barang,
				'id_batch' => $batch_id,
				'id_rack' => $rack_id,
				'quantity' => $quantity,
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('user_id')
			];
			return $this->db->insert('rack_items', $data);
		}
	}

	
	public function get_last_counter()
	{
		$this->db->select_max('id_putaway');
		$query = $this->db->get('putaway');
		$result = $query->row();
		return $result->id_putaway ? (int)$result->id_putaway : 0;
	}
}
?>
