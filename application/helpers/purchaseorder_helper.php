<?php

function getNoPoByUuid($uuid) {
    $CI =& get_instance();

    $barang = $CI->db->query('SELECT no_purchaseorder FROM purchaseorder WHERE uuid = "'.$uuid.'" ')->row_array();
    return $barang['no_purchaseorder'];
}

?>