<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllLog($filters = [])
	{
		$this->db->select('wms_log.id_log,wms_log.at, barang.sku, batch.batchnumber, rack.sloc,batch.expiration_date, wms_log.qty, wms_log.condition,barang.nama_barang, wms_log.no_document,users.nama,wms_log.description');
		$this->db->from('wms_log');
        // join barang 
		$this->db->join('barang', 'barang.id_barang = wms_log.id_barang', 'left');
		// join batch
		$this->db->join('batch', 'batch.id_batch = wms_log.id_batch', 'left');
		// join rack
		$this->db->join('rack', 'rack.id_rack = wms_log.id_rack', 'left');
		// join users 
		$this->db->join('users', 'users.id_users = wms_log.by', 'left');
        
		
		if (!empty($filters['sku'])) {
			$this->db->like('barang.sku', $filters['sku']);
		}

		if (!empty($filters['batchnumber'])) {
			$this->db->like('batch.batchnumber', $filters['batchnumber']);
		}

		if (!empty($filters['sloc'])) {
			$this->db->where('rack.sloc', $filters['sloc']);
		}

		if (!empty($filters['no_document'])) {
			$this->db->where('wms_log.no_document', $filters['no_document']);
		}

		
		// sort by id_log 
		$this->db->order_by('wms_log.id_log', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// getAllLogExport
	public function getAllLogExport()
	{
		$this->db->select('wms_log.condition,wms_log.qty,wms_log.at,wms_log.no_document,wms_log.description,barang.sku,barang.nama_barang,batch.batchnumber,batch.expiration_date,rack.sloc,users.nama');
		$this->db->from('wms_log');
		// join barang 
		$this->db->join('barang', 'barang.id_barang = wms_log.id_barang', 'left');
		// join batch
		$this->db->join('batch', 'batch.id_batch = wms_log.id_batch', 'left');
		// join rack
		$this->db->join('rack', 'rack.id_rack = wms_log.id_rack', 'left');
		// join users 
		$this->db->join('users', 'users.id_users = wms_log.by', 'left');
		// sort by id_log 
		$this->db->order_by('wms_log.id_log', 'desc');
		$query = $this->db->get();
		return $query->result();
	}



}
