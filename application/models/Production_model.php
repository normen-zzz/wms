<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Production_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// getDataProduction
	public function getDataProduction()
	{
		$this->db->select('*,production.created_at as dibuat,u.nama as picker');
		$this->db->from('production');
		$this->db->join('users', 'production.created_by = users.id_users');
		// join users for picker 
		$this->db->join('users u', 'production.pick_by = u.id_users', 'left');
		if ($this->session->userdata('role_id') == 4) {
			$this->db->where('production.pick_by', $this->session->userdata('id_users'));
		}
		$this->db->order_by('production.id_production', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
	// getSkuBundling
	public function getSkuBundling()
	{
		$this->db->select('*');
		$this->db->from('barang');
		// jika sku ada mengandung kata IBP 
		$this->db->like('sku', 'IBP');
		$query = $this->db->get();
		return $query;
	}

	// getSkuBundling
	public function getSkuBundlingNotHaveMaterial()
	{
		$this->db->select('*');
		$this->db->from('barang');
		// jika sku ada mengandung kata IBP 
		// join bundling_material by sku 
		$this->db->join('bundling_material', 'barang.sku = bundling_material.sku_bundling', 'left');
		$this->db->where('bundling_material.sku_bundling IS NULL', NULL, FALSE);
		$this->db->like('sku', 'IBP');
		$query = $this->db->get();
		return $query;
	}

	// getMaterials
	public function getMaterials($sku)
	{
		$this->db->select('*,b.nama_barang as nama_material');
		$this->db->from('bundling_material a');
		// join barang with sku 
		$this->db->join('barang b', 'a.sku_material = b.sku');
		$this->db->where('a.sku_bundling', $sku);
		$query = $this->db->get();
		return $query;
	}

	// getBatchMaterial
	public function getBatchMaterial($sku)
	{
		$this->db->select('*');
		$this->db->from('rack_items');
		//    join batch 
		$this->db->join('batch', 'rack_items.id_batch = batch.id_batch');
		// join barang 
		$this->db->join('barang', 'rack_items.id_barang = barang.id_barang');
		$this->db->where('barang.sku', $sku);
		$this->db->where('rack_items.quantity >', 0);
		// group by batch 
		$this->db->group_by('rack_items.id_batch');
		$query = $this->db->get();
		return $query;
	}

	public function get_last_counter($prefix = null)
	{
		if ($prefix === null) {
			$prefix = 'PRD/';
		}

		$this->db->select('no_production');
		$this->db->from('production');
		$this->db->like('no_production', $prefix, 'after');
		$this->db->order_by('id_production', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get();
		$result = $query->row();

		if ($result) {
			$parts = explode('/', $result->no_production);
			$lastCounter = isset($parts[2]) ? (int)$parts[2] : 0;
		} else {
			$lastCounter = 0;
		}
		return $lastCounter;
	}

	public function get_all_production_detail($id)
	{
		$this->db->select('
			p.id_production,
			p.no_production,
			p.sku_bundling,
			p.batch_bundling,
			p.ed_bundling,
			p.created_at,
			p.qty_bundling,
			pm.id_material as material_id,
			pm.sku AS material_sku,
			pm.quantity AS material_quantity,
			pm.batch_id,
			b.batchnumber
		');
		$this->db->from('production p');
		$this->db->join('production_materials pm', 'pm.production_id = p.id_production');
		// join batch 
		$this->db->join('batch b', 'pm.batch_id = b.id_batch');
		$this->db->where('p.id_production', $id);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$production = $query->row();
			$materials = [];
			foreach ($query->result() as $row) {
				$materials[] = [
					'id_material' => $row->material_id,
					'sku_material' => $row->material_sku,
					'quantity' => $row->material_quantity,
					'batch_id' => $row->batch_id,
					'batchnumber' => $row->batchnumber
				];
			}

			return [
				'production' => $production,
				'materials' => $materials
			];
		} else {
			return null;
		}
	}
	// getPickers
	public function getPickers()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('role_id', 4);
		$query = $this->db->get();
		return $query;
	}

	// getProductionById
	public function getProductionById($id)
	{
		$this->db->select('*');
		$this->db->from('production');
		$this->db->where('id_production', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	// get_material_by_production
	public function get_material_by_production_unpick($id)
	{
		$this->db->select('
			pm.id_material,
			pm.sku,
			pm.batch_id,
			pm.quantity,
			b.batchnumber,
			brg.nama_barang,
			brg.id_barang

		');
		$this->db->from('production_materials pm');
		$this->db->join('batch b', 'pm.batch_id = b.id_batch');
		// join barang 
		$this->db->join('barang brg', 'pm.sku = brg.sku');
		$this->db->where('pm.production_id', $id);
		// where status 0 
		$this->db->where('pm.status', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	// get_material_by_production
	public function get_material_by_production($id)
	{
		$this->db->select('
			pm.id_material,
			pm.sku,
			pm.batch_id,
			pm.quantity,
			b.batchnumber,
			brg.nama_barang,
			brg.id_barang

		');
		$this->db->from('production_materials pm');
		$this->db->join('batch b', 'pm.batch_id = b.id_batch');
		// join barang 
		$this->db->join('barang brg', 'pm.sku = brg.sku');
		$this->db->where('pm.production_id', $id);
		// where status 0 
		$this->db->where('pm.status', 1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getAvailableRack($sku, $id_batch)
	{
		$this->db->select('sloc,a.quantity');
		$this->db->from('rack_items a');
		$this->db->join('rack b', 'a.id_rack = b.id_rack', 'left');
		// join barang 
		$this->db->join('barang c', 'a.id_barang = c.id_barang');
		$this->db->where('c.sku', $sku);
		$this->db->where('a.id_batch', $id_batch);
		$this->db->where('a.quantity >', 0);

		$query = $this->db->get();
		return $query->result_array();
	}

	// getIdRackFromSloc
	public function getIdRackFromSloc($sloc)
	{
		$this->db->select('id_rack');
		$this->db->from('rack');
		$this->db->where('sloc', $sloc);
		$query = $this->db->get();
		return $query->row_array();
	}

	// getLastQtyRackItems
	public function getLastQtyRackItems($sku, $id_batch, $id_rack)
	{
		$this->db->select('quantity');
		$this->db->from('rack_items');
		// join barang 
		$this->db->join('barang', 'rack_items.id_barang = barang.id_barang');
		$this->db->where('barang.sku', $sku);
		$this->db->where('id_batch', $id_batch);
		$this->db->where('id_rack', $id_rack);
		$query = $this->db->get()->row_array();
		return $query['quantity'];
	}

	public function getLastQtyRackItemsMaterial($id_barang, $id_batch, $id_rack)
	{
		$this->db->select('quantity');
		$this->db->from('rack_items');
		$this->db->where('id_barang', $id_barang);
		$this->db->where('id_batch', $id_batch);
		$this->db->where('id_rack', $id_rack);
		$query = $this->db->get()->row_array();
		return $query['quantity'];
	}

	// getIdBarangFromSku
	public function getIdBarangFromSku($sku)
	{
		$this->db->select('id_barang');
		$this->db->from('barang');
		$this->db->where('sku', $sku);
		$query = $this->db->get()->row_array();
		return $query['id_barang'];
	}

	// insertPickProduction
	public function insertPickProduction($data)
	{
		// insert batch 
		$this->db->insert_batch('pick_production', $data);
		return $this->db->affected_rows();
	}

	// getPicksByMaterial
	public function getPicksByMaterial($id_material)
	{
		$this->db->select('*');
		$this->db->from('pick_production');
		$this->db->where('id_material', $id_material);
		$this->db->order_by('pick_production.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	// updateRackItems
	public function updateRackItems($id_barang, $id_batch, $id_rack,  $quantity)
	{
		$this->db->set('quantity', 'quantity - ' . $quantity, FALSE);
		$this->db->where('id_rack', $id_rack);
		$this->db->where('id_barang', $id_barang);
		$this->db->where('id_batch', $id_batch);
		$this->db->update('rack_items');
		return $this->db->affected_rows();
	}
	// checkOnRackItems
	public function checkOnRackItems($id_barang, $id_batch, $id_rack)
	{
		$this->db->select('quantity');
		$this->db->from('rack_items');
		$this->db->where('id_barang', $id_barang);
		$this->db->where('id_batch', $id_batch);
		$this->db->where('id_rack', $id_rack);
		$query = $this->db->get();
		return $query;
	}

	// increaseRackItems
	public function increaseRackItems($id_barang, $id_batch, $id_rack, $quantity)
	{
		$this->db->set('quantity', 'quantity + ' . $quantity, FALSE);
		$this->db->where('id_rack', $id_rack);
		$this->db->where('id_barang', $id_barang);
		$this->db->where('id_batch', $id_batch);
		$this->db->update('rack_items');
		return $this->db->affected_rows();
	}

	// getBundlingMaterial
	public function getBundlingMaterial()
	{
		$this->db->select('a.sku_bundling,a.sku_material,b.nama_barang as nama_bundling,a.created_at,a.created_by');
		$this->db->from('bundling_material a');
		// join barang with sku 
		$this->db->join('barang b', 'a.sku_bundling = b.sku');
		// group by sku bundling
		$this->db->group_by('a.sku_bundling');
		// order by 
		$this->db->order_by('a.id_bundlingmaterial', 'DESC');
		$query = $this->db->get();
		return $query;
	}

	// getMaterialBundling
	public function getMaterialBundling($sku)
	{
		$this->db->select('a.sku_bundling,a.sku_material,a.qty,b.nama_barang as nama_material');
		$this->db->from('bundling_material a');
		// join barang with sku 
		$this->db->join('barang b', 'a.sku_material = b.sku');
		$this->db->where('a.sku_bundling', $sku);
		$query = $this->db->get();
		return $query;
	}

	// Fetch users
	function selectBarang($searchTerm = NULL)
	{
		$this->db->select('barang.id_barang,barang.sku,barang.nama_barang');
		$this->db->from('rack_items');
		// join barang 
		$this->db->join('barang', 'rack_items.id_barang = barang.id_barang');
	


		if ($searchTerm != NULL) {
			$this->db->where("barang.nama_barang LIKE '%" . $this->db->escape_like_str($searchTerm) . "%' OR barang.sku LIKE '%" . $this->db->escape_like_str($searchTerm) . "%'");
		}
		$this->db->where('is_deleted', 0);
		// where not like ibp 
		$this->db->not_like('barang.sku', 'IBP', 'after');
		// group by barang.id_barang dan batch.id_batch dan;
		$this->db->group_by(['rack_items.id_barang']);

		$fetched_records = $this->db->get();
		$items = $fetched_records->result_array();

		$data = array();
		foreach ($items as $item) {
			$data[] = array(
				"id" => $item['sku'],
				"text" => $item['sku'] . ' | ' . $item['nama_barang']
			);
		}

		return $data;
	}

	// getNamaMaterial
	public function getNamaMaterial($sku)
	{
		$this->db->select('nama_barang');
		$this->db->from('barang');
		$this->db->where('sku', $sku);
		$query = $this->db->get();
		return $query->row();
	}

	// checkBatch
	public function checkBatch($batch)
	{
		$this->db->select('id_batch');
		$this->db->from('batch');
		$this->db->where('batchnumber', $batch);
		$query = $this->db->get();
		return $query;
	}

	// checkQtyBatch
	public function checkQtyBatch($sku,$batch)
	{
		$this->db->select('SUM(rack_items.quantity),rack_items.quantity,batch.batchnumber,barang.sku');
		$this->db->from('rack_items');
		// join barang 
		$this->db->join('barang', 'rack_items.id_barang = barang.id_barang');
		// join batch 
		$this->db->join('batch', 'rack_items.id_batch = batch.id_batch');
		$this->db->where('barang.sku', $sku);
		$this->db->where('rack_items.id_batch', $batch);
		$query = $this->db->get();
		return $query;
	}
}
