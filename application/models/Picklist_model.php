<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Picklist_model extends CI_Model
{
	function getDataPicklist()
	{
		$this->db->select('*');
		$this->db->from('picklist');
		$this->db->where('is_deleted', 0);
		return $this->db->get();
	}

	// Fetch users
    function selectBarang($searchTerm=NULL){

        if ($searchTerm != NULL) {
            // Fetch users
        $this->db->select('*');
        $this->db->where("nama_barang like '%".$searchTerm."%' OR sku like  '%".$searchTerm."%' ");
        $fetched_records = $this->db->get('barang');
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach($users as $user){
            $data[] = array("id"=>$user['id_barang'], "text"=>$user['sku'].' | '.$user['nama_barang']);
        }
        return $data;
        } else{
            return NULL;
        }
    	
    }
	
	

}

/* End of file ModelName.php */
