<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	
	public function get_all_users() {
		$this->db->select('users.*, roles.name as role_name');
		$this->db->from('users');
		$this->db->join('roles', 'users.role_id = roles.id');
        // where 
        $this->db->where('users.role_id !=', 1);
        $this->db->where('users.is_deleted !=', 1);
		return $this->db->get()->result();
    }

    public function get_user($id) {
        return $this->db->get_where('users', ['id_users' => $id,'is_deleted' => 0])->row();
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function update_user($id, $data) {
        $this->db->where('id_users', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        return $this->db->update('users', ['is_deleted' => 1], ['id_users' => $id]);
    }

	public function getDetailUsers($id)
	{
		// get data users by id
		return $this->db->get_where('users', ['id_users' => $id])->row_array();
	}

}

/* End of file ModelName.php */
