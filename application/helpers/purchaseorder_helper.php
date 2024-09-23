<?php

function getNoPoByUuid($uuid) {
    $CI =& get_instance();

    $barang = $CI->db->query('SELECT no_purchaseorder FROM purchaseorder WHERE uuid = "'.$uuid.'" ')->row_array();
    return $barang['no_purchaseorder'];
}

function getIdPurchaseorderByUuid($uuid) {
    $CI =& get_instance();

    $po = $CI->db->query('SELECT id_purchaseorder FROM purchaseorder WHERE uuid = "'.$uuid.'" ')->row_array();
    return $po['id_purchaseorder'];
}

?>