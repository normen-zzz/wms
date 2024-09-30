<?php

function getNamaUserById($id_users) {
    $CI =& get_instance();
    $user = $CI->db->query('SELECT nama FROM users WHERE id_users = '.$id_users.' ')->row_array();

    return $user['nama'];
}

?>