<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function generate_picklist_number($prefix = 'PL') {
    $CI =& get_instance();
    $CI->load->model('Picklist_model');

    $date = date('ymd');

    $last_counter = $CI->Picklist_model->get_last_counter();
    $new_counter = $last_counter + 1;

    $formatted_counter = str_pad($new_counter, 1, '0', STR_PAD_LEFT);


    $picklist_number = "{$prefix}/{$date}/{$formatted_counter}";

    return $picklist_number;
}

function generate_goodsorder_number($prefix = 'GO') {
    $CI =& get_instance();
    $CI->load->model('Goodsorder_model');

    $date = date('ymd');

    $last_counter = $CI->Goodsorder_model->get_last_counter();
    $new_counter = $last_counter + 1;

    $formatted_counter = str_pad($new_counter, 1, '0', STR_PAD_LEFT);


    $picklist_number = "{$prefix}/{$date}/{$formatted_counter}";

    return $picklist_number;
}

function generate_purchaseorder_number($prefix = 'PO') {
    $CI =& get_instance();
    $CI->load->model('Purchaseorder_model');

    $date = date('ymd');

    $last_counter = $CI->Purchaseorder_model->get_last_counter();
    $new_counter = $last_counter + 1;

    $formatted_counter = str_pad($new_counter, 1, '0', STR_PAD_LEFT);


    $purchaseorder_number = "{$prefix}/{$date}/{$formatted_counter}";

    return $purchaseorder_number;
}
function generate_pickingslip_number($prefix = 'PS') {
    $CI =& get_instance();
    $CI->load->model('Purchaseorder_model');

    $date = date('ymd');

    $last_counter = $CI->Purchaseorder_model->get_last_counter_pickingslip();
    $new_counter = $last_counter + 1;

    $formatted_counter = str_pad($new_counter, 1, '0', STR_PAD_LEFT);


    $pickinglist_number = "{$prefix}/{$date}/{$formatted_counter}";

    return $pickinglist_number;
}

function generate_inbound_number($prefix = 'IB') {
    $CI =& get_instance();
    $CI->load->model('ReceivingInbound_model');

    $date = date('ymd');

    $last_counter = $CI->ReceivingInbound_model->get_last_counter();
    $new_counter = $last_counter + 1;

    $formatted_counter = str_pad($new_counter, 1, '0', STR_PAD_LEFT);


    $inbound_number = "{$prefix}/{$date}/{$formatted_counter}";

    return $inbound_number;
}
