<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production_model extends CI_Model {
	public function get_all_production() {
		$this->db->select('production.*, 
						production_materials.sku, 
						production_materials.quantity, 
						production_materials.uom, 
						production_materials.batch_id,
						barang.sku as sku,
						batch.batchnumber as batch_id'); 

		$this->db->from('production');
		$this->db->join('production_materials', 'production.id_production = production_materials.production_id', 'left');
		$this->db->join('barang', 'barang.id_barang = production_materials.sku', 'left');
		$this->db->join('batch', 'production_materials.batch_id = batch.id_batch', 'left');
		
		$this->db->group_by('production.id_production');
		$this->db->order_by('production.created_at', 'DESC');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_production_detail($id) {
		$this->db->select('production.*, 
						barang.sku as sku, 
						barang.nama_barang AS nama_barang, 
						production_materials.batch_id, 
						batch.batchnumber, 
						production.no_production,
						production_materials.quantity AS qty');
		$this->db->from('production');
		$this->db->join('production_materials', 'production.id_production = production_materials.production_id', 'left');
		$this->db->join('barang', 'barang.id_barang = production_materials.sku', 'left');
		$this->db->join('batch', 'production_materials.batch_id = batch.id_batch', 'left');
		$this->db->where('production.id_production', $id); 
		$query = $this->db->get();
		return $query->result_array();
	}

	
	public function get_all_barang() {
        $this->db->select('id_barang, sku, nama_barang, uom');
        $this->db->where('is_deleted', 0); 
        $query = $this->db->get('barang');
        return $query->result_array();
  	}

	public function get_all_bundling_skus() {
		$this->db->select('id_barang, sku, nama_barang, uom');
		$this->db->where('is_deleted', 0);
		$this->db->like('sku', 'IBP', 'after'); 
		$query = $this->db->get('barang');
		return $query->result_array();
	}

	public function get_batches_by_sku($sku) {
        $this->db->select('b.id_batch, b.batchnumber, ri.quantity, b.expiration_date'); 
        $this->db->from('batch b');
        $this->db->join('rack_items ri', 'b.id_batch = ri.id_batch');
        $this->db->join('barang br', 'ri.id_barang = br.id_barang');
        $this->db->where('br.id_barang', $sku); 
        // $this->db->where('b.qty >', 0); 

        $query = $this->db->get();
		return $query->result_array();
    }


    public function deduct_stock_from_batch($batch_id, $quantity) {
        $this->db->select('qty');
        $this->db->from('batch');
        $this->db->where('id_batch', $batch_id);
        $batch = $this->db->get()->row();

        if ($batch && $batch->qty >= $quantity) {
            $new_qty = $batch->qty - $quantity;

            $this->db->where('id_batch', $batch_id);
            $this->db->update('batch', ['qty' => $new_qty]);

            return true;
        } else {
            return false; 
        }
    }
	
	public function insert_production($data) {
		$this->db->trans_begin();
		
		try {
			$production_data = array(
				'created_at' => date('Y-m-d H:i:s'),
				'no_production' => generate_production_number(),
			);
			
			$this->db->insert('production', $production_data);
			$production_id = $this->db->insert_id();

			if (!empty($data['materials'])) {
				$materials_data = array();
				
				foreach ($data['materials'] as $material) {
					$this->db->where('id_batch', $material['batch_id']);
					$this->db->where('id_barang', $material['sku']);
					$rack_item = $this->db->get('rack_items')->row();

					if (!$rack_item || $rack_item->quantity < $material['quantity']) {
						$this->db->select('sku');
						$this->db->from('barang');
						$this->db->where('id_barang', $material['sku']);
						$barang = $this->db->get()->row();
						$sku = $barang ? $barang->sku : '';

						throw new Exception('Insufficient quantity for SKU: ' . $sku);
					}

					$materials_data[] = array(
						'production_id' => $production_id,
						'sku' => $material['sku'],
						'quantity' => $material['quantity'],
						'uom' => $material['uom'],
						'batch_id' => $material['batch_id'],
					);

					$new_qty = $rack_item->quantity - $material['quantity'];
					$this->db->where('id_batch', $material['batch_id']);
					$this->db->where('id_barang', $material['sku']);
					$this->db->update('rack_items', array('quantity' => $new_qty));
				}
				
				if (!empty($materials_data)) {
					$this->db->insert_batch('production_materials', $materials_data);
				}
			}
			
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Error in transaction');
			}
			
			$this->db->trans_commit();
			return array('success' => true, 'message' => 'Production bundling saved successfully');
			
		} catch (Exception $e) {
			$this->db->trans_rollback();
			return array('success' => false, 'message' => 'Error: ' . $e->getMessage());
		}
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

}
?>
