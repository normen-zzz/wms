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
        return $query;
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
}
?>