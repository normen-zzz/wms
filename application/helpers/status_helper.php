<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// getStratusBarang
if (!function_exists('getStatusBarang')) {
    function getStatusBarang($is_deleted) {
        if ($is_deleted == 0) {
            return '<span class="badge bg-success">Active</span>';
        } else {
            return '<span class="badge bg-danger">Inactive</span>';
        }
    }
}

// getStatusRack
if (!function_exists('getStatusRack')) {
	function getStatusRack($status) {
		if ($status == 0) {
			return '<span class="badge bg-success">Active</span>';
		} else {
			return '<span class="badge bg-danger">Inactive</span>';
		}
	}
}
