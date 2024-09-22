<?php
defined('BASEPATH') or exit('No direct script access allowed');

// getStratusBarang

function getNamaCustomer($id_customer)
{
    $CI =& get_instance();
    $customer = $CI->db->query('SELECT nama_customer FROM customer WHERE id_customer  = '.$id_customer.' ')->row_array();

    return $customer['nama_customer'];
}
