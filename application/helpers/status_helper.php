<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('getStatusBarang')) {
    function getStatusBarang($is_deleted) {
        if ($is_deleted == 1) {
            return 'Deleted';
        } else {
            return 'Active';
        }
    }
}
