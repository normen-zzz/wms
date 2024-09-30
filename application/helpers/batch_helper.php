<?php

function getBatchById($id) {
    $CI =& get_instance();

    
    $batch = $CI->db->query('SELECT batchnumber FROM batch WHERE id_batch = '.$id.' ')->row_array();

    return $batch['batchnumber'];

    
}

?>