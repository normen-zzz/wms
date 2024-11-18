<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adjuststock_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load database library
       
    }

    // getDataAdjustStock
    public function getDataAdjustStock() {
        $this->db->select('adjuststock.*, users.nama');
        $this->db->from('adjuststock');
        // join users
        $this->db->join('users', 'users.id_users = adjuststock.created_by');
        // sort by id_adjuststock
        $this->db->order_by('adjuststock.id_adjuststock', 'desc');
        $query = $this->db->get();
        return $query->result();
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
        // not in like IBP
        $this->db->where('barang.sku NOT LIKE', 'IBP%');
        $this->db->group_by('barang.id_barang');

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

    public function getBatchBarang($id_barang)
	{
		return $this->db->query('SELECT  b.batchnumber,b.id_batch FROM rack_items AS a INNER JOIN batch AS b ON a.id_batch = b.id_batch WHERE a.id_barang = ' . $id_barang . ' AND a.quantity > 0 GROUP BY b.id_batch');
	}

    public function checkQty($id_barang, $id_batch,$rack)
	{
		return $this->db->query('SELECT SUM(quantity) AS total_quantity FROM rack_items INNER JOIN rack ON rack_items.id_rack = rack.id_rack WHERE id_barang = ' . $id_barang . ' AND id_batch =' . $id_batch . ' AND rack.sloc = "'.$rack.'" ');
	}

    // getRecommendedRack  for jquery ajax
    
    public function getRecommendedRack($id_barang, $id_batch)
    {
        $this->db->select('rack.sloc,rack_items.quantity');
        $this->db->from('rack_items');
        $this->db->join('rack', 'rack_items.id_rack = rack.id_rack');
        $this->db->where('rack_items.id_barang', $id_barang);
        $this->db->where('rack_items.id_batch', $id_batch);
        $this->db->where('rack_items.quantity >', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_last_counter($prefix = null)
	{
			if ($prefix === null) {
					$prefix = 'ADJ/';
			}

			$this->db->select('no_adjuststock');
			$this->db->from('adjuststock');
			$this->db->like('no_adjuststock', $prefix, 'after');
			$this->db->order_by('id_adjuststock', 'DESC');
			$this->db->limit(1);
			
			$query = $this->db->get();
			$result = $query->row();

			if ($result) {
					$parts = explode('/', $result->no_adjuststock);
					$lastCounter = isset($parts[2]) ? (int)$parts[2] : 0;
			} else {
					$lastCounter = 0;
			}

			return $lastCounter;
	}

    

    // checkSloc
    public function checkSloc($sloc)
    {
        return $this->db->query('SELECT id_rack FROM rack WHERE sloc = "' . $sloc . '"');
    }

    

   
    // get_rack_items
    public function get_rack_items($id_barang, $id_batch, $id_rack)
    {
        $this->db->select('rack_items.*');
        $this->db->from('rack_items');
        $this->db->where('rack_items.id_barang', $id_barang);
        $this->db->where('rack_items.id_batch', $id_batch);
        $this->db->where('rack_items.id_rack', $id_rack);
        $query = $this->db->get();
        return $query;
    }

    // insert_rack_items 
    public function insert_rack_items($data)
    {
        return $this->db->insert('rack_items', $data);
    }

    // update_rack_items
    public function update_rack_items($id_rack_items, $data)
    {
        $this->db->where('id', $id_rack_items);
        return $this->db->update('rack_items', $data);
    }

    
    // insert_wms_log
    public function insert_wms_log($data)
    {
        return $this->db->insert('wms_log', $data);
    }

    // insert_adjuststock
    public function insert_adjuststock($data)
    {
        return $this->db->insert('adjuststock', $data);
    }

    // insert_data_adjuststock
    public function insert_data_adjuststock($data)
    {
        // insert batch 
        return $this->db->insert_batch('dataadjuststock', $data);
    }


    // getDetailAdjustStock
    public function getDetailAdjustStock($uuid)
    {
        $this->db->select('adjuststock.*, users.nama, c.nama as approved_by');
        $this->db->from('adjuststock');
        $this->db->where('adjuststock.uuid', $uuid);
        // join users
        $this->db->join('users', 'users.id_users = adjuststock.created_by');
        // join users 
        $this->db->join('users c', 'users.id_users = adjuststock.approved_by', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    // getDetailAdjustStockDetail
    public function getDetailAdjustStockDetail($uuidAdjuststock)
    {
        $adjuststock = $this->db->query('SELECT * FROM adjuststock WHERE uuid = "' . $uuidAdjuststock . '"')->row();
        $this->db->select('dataadjuststock.*, barang.sku, barang.nama_barang, batch.batchnumber, batch.expiration_date, rack.sloc');
        $this->db->from('dataadjuststock');
        $this->db->where('dataadjuststock.id_adjuststock', $adjuststock->id_adjuststock);
        // join barang
        $this->db->join('barang', 'barang.id_barang = dataadjuststock.id_barang');
        // join batch
        $this->db->join('batch', 'batch.id_batch = dataadjuststock.id_batch');
        // join rack
        $this->db->join('rack', 'rack.id_rack = dataadjuststock.id_rack');
        $query = $this->db->get();
        return $query;
    }
    
  

    

    
}
