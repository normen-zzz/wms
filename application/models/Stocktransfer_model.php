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
        $this->db->select('stocktransfer_data.*, barang.nama_barang, batch.batch, rack.nama_rak, user.nama');
        $this->db->from('stocktransfer_data');
        $this->db->join('barang', 'stocktransfer_data.id_barang = barang.id_barang');
        $this->db->join('batch', 'stocktransfer_data.id_batch = batch.id_batch');
        $this->db->join('rack', 'stocktransfer_data.id_rack = rack.id_rack');
        $this->db->join('user', 'stocktransfer_data.id_user = user.id_user');
        $this->db->join('stocktransfer', 'stocktransfer_data.id_stocktransfer = stocktransfer_data.id_stocktransfer');
        $this->db->where('stocktransfer.uuid', $uuid);
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
		return $this->db->query('SELECT  b.batchnumber,b.id_batch FROM rack_items AS a INNER JOIN batch AS b ON a.id_batch = b.id_batch WHERE a.id_barang = ' . $id_barang . ' AND a.quantity > 0 ');
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

    

    
    
    

}
?>