<?php
class Putaway_model extends CI_Model
{

	public function insert_putaway($data)
	{
		return $this->db->insert('putaway', $data);
	}

	public function get_all_putaways()
	{
		$this->db->select('putaway.*, users.nama as user_name, inbound.no_inbound');
		$this->db->from('putaway');
		$this->db->join('users', 'putaway.id_users = users.id_users', 'left');
		$this->db->join('inbound', 'putaway.id_inbound = inbound.id_inbound', 'left');
		$this->db->order_by('putaway.created_at', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_putaway_details($uuid)
	{
		$this->db->select('putaway.*, users.nama as user_name, ib.no_inbound, ib.batch_id, ib.good_qty, barang.id_barang, barang.nama_barang, barang.sku');
		$this->db->from('putaway');
		$this->db->join('users', 'putaway.id_users = users.id_users', 'left');

		$this->db->join('inbound ib', 'putaway.id_inbound = ib.id_inbound', 'left');
		$this->db->join('barang', 'ib.id_barang = barang.id_barang', 'left');

		$this->db->order_by('putaway.created_at', 'DESC');

		return $this->db->get()->result_array();
	}

	public function get_rack_recommendations()
	{
		$this->db->select('r.id_rack, r.uuid, r.sloc, r.zone, r.rack, r.row, r.column_rack, r.max_qty, COALESCE(SUM(ri.quantity), 0) AS total_quantity, (r.max_qty - COALESCE(SUM(ri.quantity), 0)) AS available_space');
		$this->db->from('rack r');
		$this->db->join('rack_items ri', 'r.id_rack = ri.id_rack', 'left');
		$this->db->where('r.is_deleted', 0);
		$this->db->group_by('r.id_rack');
		$this->db->having('available_space >', 0);
		$this->db->order_by('available_space', 'DESC');
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}

	public function get_id_inbound($uuid)
	{
		$this->db->select('no_inbound');
		$this->db->from('inbound');
		$this->db->where('uuid', $uuid);
		return $this->db->get()->row();
	}

	public function assign_rack_to_item($rack_id, $id_barang, $quantity, $batch_id)
	{
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

	public function get_all_user_putaways()
	{
		$this->db->select('id_users, nama');
		$this->db->from('users');
		$this->db->where('role_id', 5);
		return $this->db->get()->result_array();
	}

	public function insert_assign_putaway($data)
	{
		return $this->db->insert('putaway', $data);
	}
}
