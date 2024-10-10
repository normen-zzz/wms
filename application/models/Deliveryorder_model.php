<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deliveryorder_model extends CI_Model
{
    function getDeliveryorder()
    {
        $this->db->select('a.*,b.no_packing,c.no_pickingslip');
        $this->db->from('deliveryorder a');
        $this->db->join('packing b', 'a.id_packing =  b.id_packing');
        $this->db->join('pickingslip c', 'b.id_pickingslip =  c.id_pickingslip');
        return $this->db->get();
    }

    function getDetailDeliveryorder($uuidDeliveryorder)
    {
        $this->db->select('a.*,e.nama_customer');
        $this->db->from('deliveryorder a');
        // join packing 
        $this->db->join('packing b', 'a.id_packing =  b.id_packing');
        // join pickingslip 
        $this->db->join('pickingslip c', 'b.id_pickingslip = c.id_pickingslip');
        //join purchaseorder
        $this->db->join('purchaseorder d', 'c.id_purchaseorder = d.id_purchaseorder');
        // join customer 
        $this->db->join('customer e', 'd.customer = e.id_customer');

        //where
        $this->db->where('a.uuid', $uuidDeliveryorder);
        return $this->db->get()->row_array();
    }

    function getNoDoExt($uuidDeliveryorder) {
        $this->db->select('ext_deliveryorder');
        $this->db->from('deliveryorder');
        $this->db->where('uuid', $uuidDeliveryorder);
        $do = $this->db->get()->row_array();
        return $do['ext_deliveryorder'];
    }

    function getItemsDeliveryorder($uuidDeliveryorder)
    {
        $this->db->select('a.*,d.expiration_date,c.sku,c.nama_barang,d.batchnumber,a.qty,a.created_at,a.created_by,f.nama');
        $this->db->from('datapacking a');
        $this->db->join('packing b', 'a.id_packing =  b.id_packing');
        //join barang
        $this->db->join('barang c', 'a.id_barang =  c.id_barang');
        //join batch
        $this->db->join('batch d', 'a.id_batch =  d.id_batch');
        // join deliveryorder  
        $this->db->join('deliveryorder e', 'b.id_packing =  e.id_packing');
        // join user 
        $this->db->join('users f', 'a.created_by =  f.id_users');
        $this->db->where('e.uuid', $uuidDeliveryorder);
        return $this->db->get();
    }
    function getDetailPacking($uuidPacking)
    {

        $this->db->select('c.sku,c.nama_barang,d.batchnumber,a.qty,a.created_at,a.created_by');
        $this->db->from('datapacking a');
        $this->db->join('packing b', 'a.id_packing =  b.id_packing');
        //join barang
        $this->db->join('barang c', 'a.id_barang =  c.id_barang');
        //join batch
        $this->db->join('batch d', 'a.id_batch =  d.id_batch');

        $this->db->where('b.uuid', $uuidPacking);
        return $this->db->get();
    }

    public function getIdPacking($uuid_packing)
    {
        $this->db->select('id_packing');
        $this->db->from('packing');
        $this->db->where('uuid', $uuid_packing);
        $query = $this->db->get();
        $result = $query->row();
        return $result->id_packing;
    }

	public function get_last_counter($prefix = null)
	{
		if ($prefix === null) {
			$prefix = 'DO/';
		}

		$this->db->select('no_deliveryorder');
		$this->db->from('deliveryorder');
		$this->db->like('no_deliveryorder', $prefix, 'after');
		$this->db->order_by('id_deliveryorder', 'DESC');
		$this->db->limit(1);
			
		$query = $this->db->get();
		$result = $query->row();

		if ($result) {
			$parts = explode('/', $result->no_deliveryorder);
			$lastCounter = isset($parts[2]) ? (int)$parts[2] : 0;
		} else {
			$lastCounter = 0;
		}

		return $lastCounter;
	}

    public function insertDeliveryOrder($data)
    {
        $this->db->insert('deliveryorder', $data);
        return $this->db->insert_id();
    }
}

/* End of file ModelName.php */
