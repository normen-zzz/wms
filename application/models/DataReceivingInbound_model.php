<?php
class DataReceivingInbound_model extends CI_Model {

    public function insert_data($data) {
        return $this->db->insert('datareceiving_inbound', $data);
    }

    public function get_data_by_inbound($id_inbound) {
        $this->db->where('id_inbound', $id_inbound);
        $query = $this->db->get('datareceiving_inbound');
        return $query->result();
    }
}
?>
