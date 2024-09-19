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
