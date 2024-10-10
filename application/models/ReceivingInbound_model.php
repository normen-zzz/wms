<?php
class ReceivingInbound_model extends CI_Model
{

	public function insert_inbound($data) {
			$this->db->insert('inbound', $data);
			return $this->db->insert_id(); 
	}

	public function insert_data_inbound($data) {
			return $this->db->insert('data_inbound', $data);
	}

	public function get_inbound_data()
	{
			$this->db->select('inbound.*, picklist.no_picklist, data_inbound.received_qty, data_inbound.good_qty, data_inbound.bad_qty, data_inbound.batch_id');
			$this->db->from('inbound');
			$this->db->join('picklist', 'inbound.id_picklist = picklist.id_picklist', 'left');
			$this->db->join('data_inbound', 'inbound.id_inbound = data_inbound.id_inbound', 'left');
			$this->db->group_by('inbound.no_inbound');
			$this->db->order_by('picklist.created_at', 'DESC');
			
			$query = $this->db->get();
			return $query->result();
	}

	public function get_detils_inbound($uuid)
	{
			$id_picklist = $this->db->query('SELECT id_picklist FROM picklist WHERE uuid = "' . $uuid . '" ')->row_array();
			$this->db->select('sku, nama_barang, a.id_barang, batch, c.expiration_date, a.qty, data_inbound.received_qty, data_inbound.good_qty, data_inbound.bad_qty, data_inbound.batch_id, a.status_row, a.id_datapicklist');
			$this->db->from('datapicklist a');
			$this->db->join('barang b', 'a.id_barang = b.id_barang');
			$this->db->join('data_inbound', 'a.id_barang = data_inbound.id_barang AND a.batch = data_inbound.batch_id', 'left');
			$this->db->join('batch c', 'a.batch = c.id_batch');
			$this->db->where('a.id_picklist', $id_picklist['id_picklist']);
			// $this->db->order_by('a.id_picklist', 'DESC');
			$this->db->order_by('a.id_datapicklist', 'ASC');

			return $this->db->get()->result_array();
	}


	public function get_picklist_byuuid($uuid)
	{
		$this->db->select('picklist.no_picklist, picklist.id_picklist, datapicklist.qty, datapicklist.batch');
		$this->db->from('picklist');
		$this->db->join('datapicklist', 'datapicklist.id_picklist = picklist.id_picklist', 'left');
		$this->db->where('picklist.uuid', $uuid);
		$this->db->order_by('picklist.id_picklist', 'DESC');
		return $this->db->get()->row();
	}

	public function get_batch($id)
	{
		$this->db->select('datapicklist.*, batch.*');
		$this->db->from('datapicklist');
		$this->db->join('batch', 'batch.id_batch = datapicklist.batch', 'left');
		$this->db->where('datapicklist.id_picklist', $id);

		$query = $this->db->get();
		return $query->row();
	}

	// get_picklist
	public function get_picklist($searchTerm = NULL)
	{
		$this->db->select('*');
		$this->db->from('picklist');

		if (!empty($searchTerm)) {
			$this->db->where("no_picklist LIKE '%" . $this->db->escape_like_str($searchTerm) . "%' OR sku LIKE '%" . $this->db->escape_like_str($searchTerm) . "%'");
		}

		$this->db->where('is_deleted', 0);

		$fetched_records = $this->db->get();
		$items = $fetched_records->result_array();

		$data = array();
		foreach ($items as $item) {
			$data[] = array(
				"id" => $item['id_picklist'],
				"text" => $item['no_picklist']
			);
		}

		return $data;
	}

	public function get_last_counter($prefix = null)
	{
			if ($prefix === null) {
					$prefix = 'IB/';
			}

			$this->db->select('no_inbound');
			$this->db->from('inbound');
			$this->db->like('no_inbound', $prefix, 'after');
			$this->db->order_by('id_inbound', 'DESC');
			$this->db->limit(1);
			
			$query = $this->db->get();
			$result = $query->row();

			if ($result) {
					$parts = explode('/', $result->no_inbound);
					$lastCounter = isset($parts[2]) ? (int)$parts[2] : 0;
			} else {
					$lastCounter = 0;
			}

			return $lastCounter;
	}

	public function update_status_picklist($id_picklist, $status)
	{
		$this->db->where('id_picklist', $id_picklist);
		$this->db->update('picklist', ['status' => $status]);
	}

	public function get_inbound_byuuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->get('inbound')->row();
	}


	public function get_detils_inboundpl($uuid)
	{
		$id_picklist = $this->db->query('SELECT id_picklist FROM inbound WHERE uuid = "' . $uuid . '" ')->row_array();

		$this->db->select('p.no_picklist, sku, b.nama_barang, c.batchnumber, c.expiration_date, a.qty, i.good_qty, i.bad_qty, i.no_inbound, i.batch_id, i.received_qty');
		$this->db->from('datapicklist a');
		$this->db->join('picklist p', 'p.id_picklist = a.id_picklist');
		$this->db->join('barang b', 'a.id_barang = b.id_barang');
		$this->db->join('batch c', 'a.batch = c.id_batch');
		$this->db->join('inbound i', 'i.id_picklist = a.id_picklist');
		// join data inbound from
		
		$this->db->where('a.id_picklist', $id_picklist['id_picklist']);
		return $this->db->get()->result_array();
	}

	// getDataInbound
	public function getDataInbound($uuid) {
		//from data_inbound where uuid on join inbound,join barang,batch
		$this->db->select('data_inbound.good_qty,data_inbound.bad_qty,data_inbound.received_qty,inbound.no_inbound, barang.sku, barang.nama_barang, batch.batchnumber,batch.expiration_date');
		$this->db->from('data_inbound');
		$this->db->join('inbound', 'inbound.id_inbound = data_inbound.id_inbound');
		$this->db->join('barang', 'barang.id_barang = data_inbound.id_barang');
		$this->db->join('batch', 'batch.id_batch = data_inbound.batch_id');
		$this->db->where('inbound.uuid', $uuid);
		$query = $this->db->get();
		return $query;
	 }

	public function insert_damage($data)
	{
		return $this->db->insert('damage', $data);
	}

	public function get_inbound_items_by_picklist($id_picklist)
	{
			$this->db->select('*'); 
			$this->db->from('inbound');  
			$this->db->where('id_picklist', $id_picklist);
			$query = $this->db->get();


			return $query->result_array(); 
	}

	public function getInboundByPicklistId($id_picklist) {
    
    $this->db->select('*');
    $this->db->from('inbound');
    $this->db->where('id_picklist', $id_picklist);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->row_array(); 
    }

    return null; 
  }

//   updateStatusInbound 
  public function updateStatusInbound($id_picklist, $status) {
		$this->db->where('id_picklist', $id_picklist);
		$this->db->update('inbound', ['status' => $status]);
  }

	// update_status_row
	public function update_status_row($id_datapicklist, $status_row)
	{
		$this->db->where('id_datapicklist', $id_datapicklist);
		$this->db->update('datapicklist', ['status_row' => $status_row]);
	}
  

  


}
