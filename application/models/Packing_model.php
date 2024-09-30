<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Packing_model extends CI_Model
{
    function getPacking() {
        
        $this->db->select('a.*,b.no_pickingslip');
        $this->db->from('packing a');
        $this->db->join('pickingslip b', 'a.id_pickingslip =  b.id_pickingslip');
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

    public function get_last_counter()
	{
		$this->db->select_max('id_packing');
		$query = $this->db->get('packing');
		$result = $query->row();
		return $result->id_putaway ? (int)$result->id_putaway : 0;
	}

}

/* End of file ModelName.php */
