<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Packing_model extends CI_Model
{
    function getPacking() {
        
        $this->db->select('a.*,b.no_pickingslip');
        $this->db->from('packing a');
        $this->db->join('pickingslip b', 'a.id_pickingslip =  b.id_pickingslip');
		// order by created_at
		$this->db->order_by('a.created_at', 'DESC');
        return $this->db->get(); 
    }

    function getDetailPacking($uuidPacking) {
        
        $this->db->select('c.sku,c.nama_barang,d.batchnumber,a.qty,a.created_at,e.nama');
        $this->db->from('datapacking a');
        $this->db->join('packing b', 'a.id_packing =  b.id_packing');
        // join barang 
        $this->db->join('barang c', 'a.id_barang =  c.id_barang');
        // join batch 
        $this->db->join('batch d', 'a.id_batch =  d.id_batch');
        // join user 
        $this->db->join('users e', 'a.created_by =  e.id_users');
      
       
        $this->db->where('b.uuid', $uuidPacking);
		// order by created_at
        return $this->db->get(); 
    }

	function dataPickingslipToPacking($id_pickingslip)
	{
		 $this->db->select('a.*,SUM(a.qty) AS total_quantity');
         $this->db->from('datapickingslip a');
         $this->db->where('a.id_pickingslip', $id_pickingslip);
         $this->db->group_by(['a.id_barang','a.id_batch']);
         return $this->db->get();


	}

	public function get_last_counter($prefix = null)
	{
		if ($prefix === null) {
			$prefix = 'PACK/';
		}

		$this->db->select('no_packing');
		$this->db->from('packing');
		$this->db->like('no_packing', $prefix, 'after');
		$this->db->order_by('id_packing', 'DESC');
		$this->db->limit(1);
			
		$query = $this->db->get();
		$result = $query->row();

		if ($result) {
			$parts = explode('/', $result->no_packing);
			$lastCounter = isset($parts[2]) ? (int)$parts[2] : 0;
		} else {
			$lastCounter = 0;
		}

		return $lastCounter;
	}

}

/* End of file ModelName.php */
