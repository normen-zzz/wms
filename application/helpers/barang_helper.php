<?php


function getStatusBarang($status = NULL)
{
    if ($status == 0) {
        return 'Active';
    } else{
        return 'Deleted';
    }
}

function getSkuBarang($id_barang) {
    $CI =& get_instance();

    $barang = $CI->db->query('SELECT sku FROM barang WHERE id_barang = '.$id_barang.' ')->row_array();
    return $barang['sku'];
}



function getNamaBarang($id_barang) {
    $CI =& get_instance();

    $barang = $CI->db->query('SELECT nama_barang FROM barang WHERE id_barang = '.$id_barang.' ')->row_array();
    return $barang['nama_barang'];
}

function getNumberBatch($id_batch) {
    $CI =& get_instance();

    $batch = $CI->db->query('SELECT batchnumber FROM batch WHERE id_batch = '.$id_batch.' ')->row_array();
    return $batch['batchnumber'];
}

function getEdBatch($id_batch) {
    $CI =& get_instance();

    $batch = $CI->db->query('SELECT expiration_date FROM batch WHERE id_batch = '.$id_batch.' ')->row_array();
    return $batch['expiration_date'];
}
