<?php
class Putaway_model extends CI_Model {

    public function insert_putaway($data) {
        return $this->db->insert('putaway', $data);
    }

    public function get_all_putaways() {
        $query = $this->db->get('putaway');
        return $query->result();
    }
}
?>
