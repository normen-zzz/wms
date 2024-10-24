<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // getDataProduction
	public function getDataProduction() {
		$this->db->select('*');
		$this->db->from('production');
		$this->db->join('users', 'production.created_by = users.id_users');
		$this->db->order_by('production.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
    // getSkuBundling
    public function getSkuBundling() {
        $this->db->select('*');
        $this->db->from('barang');
        // jika sku ada mengandung kata IBP 
        $this->db->like('sku', 'IBP');
        $query = $this->db->get();
        return $query;
    }

    // getMaterials
    public function getMaterials($sku) {
        $this->db->select('*,b.nama_barang as nama_material');
        $this->db->from('bundling_material a');
        // join barang with sku 
        $this->db->join('barang b', 'a.sku_material = b.sku');
        $this->db->where('a.sku_bundling', $sku);
        $query = $this->db->get();
        return $query;
    }

    // getBatchMaterial
    public function getBatchMaterial($sku) {
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
		}else{
			$lastCounter = 0;
    	}
		return $lastCounter;
	}

	public function get_all_production_detail($id) {
		$this->db->select('
			p.id_production,
			p.no_production,
			p.sku_bundling,
			p.batch_bundling,
			p.ed_bundling,
			p.created_at,
			pm.sku AS material_sku,
			pm.quantity AS material_quantity,
			pm.batch_id
		');
		$this->db->from('production p');
		$this->db->join('production_materials pm', 'pm.production_id = p.id_production');
		$this->db->where('p.id_production', $id); 

		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$production = $query->row(); 
			$materials = [];
			foreach ($query->result() as $row) {
				$materials[] = [
					'sku_material' => $row->material_sku,
					'quantity' => $row->material_quantity,
					'batch_id' => $row->batch_id
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

}

?>
