<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function get_all_settings()
    {
        $query = $this->db->get('settings');
        return $query->result();
    }

    public function get_setting($key)
    {
        $this->db->where('key', $key);
        $query = $this->db->get('settings');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return null;
    }

    public function update_setting($key, $value)
    {
        $this->db->where('key', $key);
        $this->db->update('settings', array('value' => $value));
        return $this->db->affected_rows();
    }
}
