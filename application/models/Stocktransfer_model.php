<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocktransfer_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // get_all_stocktransfer without join
    public function get_all_stocktransfer() {
        $this->db->select('*');
        $this->db->from('stocktransfer');
        $query = $this->db->get();
        return $query;
    }
    
    //get Detail stock transfer by uuid from table stockransfer_data join barang,batch,rack,user jangan from stocktransfer by uuid stocktranser
    public function get_stocktransfer_by_uuid($uuid) {
        $this->db->select('stocktransfer.*, users.nama');
        $this->db->from('stocktransfer');
        $this->db->join('users', 'stocktransfer.created_by = users.id_users');
        $this->db->where('stocktransfer.uuid', $uuid);
        $query = $this->db->get();
        return $query->row();
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
					$prefix = 'STF/';
			}

			$this->db->select('no_stocktransfer');
			$this->db->from('stocktransfer');
			$this->db->like('no_stocktransfer', $prefix, 'after');
			$this->db->order_by('id_stocktransfer', 'DESC');
			$this->db->limit(1);
			
			$query = $this->db->get();
			$result = $query->row();

			if ($result) {
					$parts = explode('/', $result->no_stocktransfer);
					$lastCounter = isset($parts[2]) ? (int)$parts[2] : 0;
			} else {
					$lastCounter = 0;
			}

			return $lastCounter;
	}

    // insert_stocktransfer
    public function insert_stocktransfer($data)
    {
        return $this->db->insert('stocktransfer', $data);
    }
    
    // insert_stocktransfer_data
    public function insert_stocktransfer_data($data)
    {
        return $this->db->insert('stocktransfer_data', $data);
    }

    // checkSloc
    public function checkSloc($sloc)
    {
        return $this->db->query('SELECT id_rack FROM rack WHERE sloc = "' . $sloc . '"');
    }

    // get_stocktransfer_details
    public function get_stocktransfer_details($id_stocktransfer)
    {
        $this->db->select('stocktransfer_data.id_stocktransferdata,stocktransfer_data.quantity,barang.sku,stocktransfer_data.status, barang.nama_barang, batch.batchnumber,batch.expiration_date, f.sloc AS from_sloc, t.sloc AS to_sloc');
        $this->db->from('stocktransfer_data');
        $this->db->join('barang', 'stocktransfer_data.id_barang = barang.id_barang');
        $this->db->join('batch', 'stocktransfer_data.id_batch = batch.id_batch');
        $this->db->join('rack f', 'stocktransfer_data.from_rack = f.id_rack');
        $this->db->join('rack t', 'stocktransfer_data.to_rack = t.id_rack');
        $this->db->where('stocktransfer_data.id_stocktransfer', $id_stocktransfer);
        $query = $this->db->get();
        return $query;
    }

    // update_stocktransfer_data
    public function update_stocktransfer_data($id_stocktransferdata, $data)
    {
        $this->db->where('id_stocktransferdata', $id_stocktransferdata);
        return $this->db->update('stocktransfer_data', $data);
    }

    // get_stocktransfer_data
    public function get_stocktransfer_data($id_stocktransferdata)
    {
        $this->db->select('stocktransfer_data.*');
        $this->db->from('stocktransfer_data');
        $this->db->where('stocktransfer_data.id_stocktransferdata', $id_stocktransferdata);
        $query = $this->db->get();
        return $query->row();
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

    // finishProcessStockTransferData
    public function finishProcessStockTransferData($id_stocktransfer)
    {
        $this->db->where('id_stocktransfer', $id_stocktransfer);
        $this->db->update('stocktransfer', ['status' => 1]);
    }
    // insert_wms_log
    public function insert_wms_log($data)
    {
        return $this->db->insert('wms_log', $data);
    }
    
    
    

}
?>