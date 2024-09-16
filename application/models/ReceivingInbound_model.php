<?php
class ReceivingInbound_model extends CI_Model {

    public function insert_inbound($data) {
        return $this->db->insert('receiving_inbound', $data);
    }

    public function get_all_inbounds() {
        $query = $this->db->get('receiving_inbound');
        return $query->result();
    }
}
?>
