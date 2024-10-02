<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('add_to_log')) {
    function add_to_log($id_barang, $id_batch, $id_rack, $condition, $no_document) {
        $CI =& get_instance();
        $CI->load->database();
        $log_data = array(
            'id_barang' => $id_barang,
            'id_batch' => $id_batch,
            'id_rack' => $id_rack,
            'condition' => $condition,
            'at' => date('Y-m-d H:i:s'),
            'by' => $CI->session->userdata('id_users'), 
            'no_document' => $no_document
        );

        $CI->db->insert('wms_log', $log_data);
    }
}
