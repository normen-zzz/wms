<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	
	public function get_all_users() {
		$this->db->select('users.*, roles.name as role_name');
		$this->db->from('users');
		$this->db->join('roles', 'users.role_id = roles.id');
		return $this->db->get()->result();
    }

    public function get_user($id) {
        return $this->db->get_where('users', ['id_users' => $id])->row();
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function update_user($id, $data) {
        $this->db->where('id_users', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        return $this->db->delete('users', ['id_users' => $id]);
    }

	public function getDetailUsers($id)
	{
		// get data users by id
		return $this->db->get_where('users', ['id_users' => $id])->row_array();
	}

}

/* End of file ModelName.php */
