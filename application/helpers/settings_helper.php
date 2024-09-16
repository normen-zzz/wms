<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        $CI =& get_instance();
        $CI->load->model('Settings_model'); 

        $setting = $CI->Settings_model->get_setting($key);

        if ($setting) {
            return $setting->value;
        } else {
            return null; 
        }
    }
}
