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
			$this->db->select('putaway.*, users.nama as user_name, di.no_inbound, ib.batch_id, ib.good_qty, barang.id_barang, barang.nama_barang, barang.sku, b.batchnumber, dataputaway.status_row');
			$this->db->from('putaway');
			$this->db->join('users', 'putaway.id_users = users.id_users', 'left');
			$this->db->join('data_inbound ib', 'putaway.id_inbound = ib.id_inbound', 'left');
			$this->db->join('inbound di', 'di.id_inbound = putaway.id_inbound', 'left');
			$this->db->join('barang', 'ib.id_barang = barang.id_barang', 'left');
			$this->db->join('batch b', 'ib.batch_id = b.id_batch', 'left');
			$this->db->join('dataputaway', 'putaway.id_putaway = dataputaway.id_putaway', 'left');
			$this->db->where('ib.status_putaway', 0);
			$this->db->where('putaway.uuid', $uuid);
			// where data inbound status putaway 
			
			$this->db->order_by('putaway.created_at', 'DESC');

			$result = $this->db->get()->result_array();

			// echo $this->db->last_query();

			foreach ($result as &$item) {
					$item['existing_racks'] = $this->get_existing_racks($item['id_barang'], $item['batch_id']);
			}

			return $result;
	}
		
	public function get_rack_recommendations()
	{
			$this->db->select('r.id_rack, r.uuid, r.sloc, r.zone, r.rack, r.row, r.column_rack, r.max_qty, COALESCE(SUM(ri.quantity), 0) AS total_quantity, (r.max_qty - COALESCE(SUM(ri.quantity), 0)) AS available_space');
			$this->db->from('rack r');
			$this->db->join('rack_items ri', 'r.id_rack = ri.id_rack', 'left');
			$this->db->where('r.is_deleted', 0);
			$this->db->group_by('r.id_rack');
			$this->db->having('total_quantity', 0);
			$this->db->order_by('available_space', 'DESC');
			$this->db->limit(5);
			
			return $this->db->get()->result_array();
	}


	// public function get_rack_recommendations()
	// {
	// 	$this->db->select('r.id_rack, r.uuid, r.sloc, r.zone, r.rack, r.row, r.column_rack, r.max_qty, COALESCE(SUM(ri.quantity), 0) AS total_quantity, (r.max_qty - COALESCE(SUM(ri.quantity), 0)) AS available_space');
	// 	$this->db->from('rack r');
	// 	$this->db->join('rack_items ri', 'r.id_rack = ri.id_rack', 'left');
	// 	$this->db->where('r.is_deleted', 0);
	// 	$this->db->group_by('r.id_rack');
	// 	$this->db->having('available_space >', 0);
	// 	$this->db->order_by('available_space', 'DESC');
	// 	$this->db->limit(5);
		
	// 	return $this->db->get()->result_array();
	// }

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
				'created_by' => $this->session->userdata('id_users')
			];
			return $this->db->insert('rack_items', $data);
		}
	}

	public function get_existing_racks($id_barang, $batch_id)
	{
		$this->db->select('r.sloc, ri.quantity as rack_quantity, r.id_rack as rack_id');
		$this->db->from('rack_items ri');
		$this->db->join('rack r', 'r.id_rack = ri.id_rack');
		$this->db->where('ri.id_barang', $id_barang);
		$this->db->where('ri.id_batch', $batch_id);
		$this->db->where('ri.quantity >', 0);
		$this->db->group_by('ri.id_rack');

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
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
		$this->db->where('role_id', 4);
		return $this->db->get()->result_array();
	}

	public function insert_assign_putaway($data)
	{
		return $this->db->insert('putaway', $data);
	}

	// get details
	public function get_details_putaway($uuid)
	{
		$this->db->select('dataputaway.*,  users.nama as user_name, putaway.no_putaway, di.no_inbound, ib.batch_id, ib.good_qty, barang.id_barang, barang.nama_barang, barang.sku, batch.batchnumber');
		$this->db->from('dataputaway');
		$this->db->join('putaway', 'dataputaway.id_putaway = putaway.id_putaway', 'left');
		$this->db->join('users', 'putaway.id_users = users.id_users', 'left');
		$this->db->join('data_inbound ib', 'putaway.id_inbound = ib.id_inbound', 'left');
		$this->db->join('inbound di', 'di.id_inbound = putaway.id_inbound', 'left');
		$this->db->join('barang', 'ib.id_barang = barang.id_barang', 'left');
		$this->db->join('batch', 'ib.batch_id = batch.id_batch', 'left');
		$this->db->where('putaway.uuid', $uuid);
		// $this->db->where('dataputaway.status !=', 2);
		$this->db->order_by('dataputaway.created_at', 'DESC');

		$result = $this->db->get()->result_array();

		foreach ($result as &$item) {
			$item['existing_racks'] = $this->get_existing_racks($item['id_barang'], $item['batch_id']);
		}

		return !empty($result) ? $result : [];
	}
	public function getDataInbound($uuid) {
		//from data_inbound where uuid on join inbound,join barang,batch
		$this->db->select('data_inbound.good_qty,data_inbound.bad_qty,data_inbound.received_qty,inbound.no_inbound, barang.sku, barang.nama_barang, batch.batchnumber,batch.expiration_date');
		$this->db->from('data_inbound');
		$this->db->join('inbound', 'inbound.id_inbound = data_inbound.id_inbound');
		$this->db->join('barang', 'barang.id_barang = data_inbound.id_barang');
		$this->db->join('batch', 'batch.id_batch = data_inbound.batch_id');
		$this->db->where('inbound.uuid', $uuid);
		$query = $this->db->get();
		return $query;
	 }

	public function get_inbound_items_by_putaway($id_putaway)
	{
			$this->db->select('*'); 
			$this->db->from('putaway');  
			$this->db->where('id_putaway', $id_putaway);
			$query = $this->db->get();


			return $query->result_array(); 
	}

	public function update_status_putaway($id_putaway, $status)
	{
		$this->db->where('id_putaway', $id_putaway);
		$this->db->update('putaway', ['status' => $status]);
	}
	// updateStatusInbound 
	public function updateStatusInbound($id_inbound, $status) {
		$this->db->where('id_inbound', $id_inbound);
		$this->db->update('inbound', ['status' => $status]);
	}
}
