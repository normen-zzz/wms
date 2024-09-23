<?php
defined('BASEPATH') or exit('No direct script access allowed');

// getStratusBarang
if (!function_exists('getStatusBarang')) {
    function getStatusBarang($is_deleted)
    {
        if ($is_deleted == 0) {
            return '<span class="badge bg-success">Active</span>';
        } else {
            return '<span class="badge bg-danger">Inactive</span>';
        }
    }
}

// getStatusRack
if (!function_exists('getStatusRack')) {
    function getStatusRack($status)
    {
        if ($status == 0) {
            return '<span class="badge bg-success">Active</span>';
        } else {
            return '<span class="badge bg-danger">Inactive</span>';
        }
    }
}

function getStatusPurchaseorder($status)
{
    switch ($status) {
        case '0':
            return '<span class="badge bg-secondary">Created</span>';
            break;

        case '1':
            return '<span class="badge bg-primary">Picking Slip Created</span>';
            break;

        default:
            # code...
            break;
    }
}

function getStatusPickingslip($status)
{
    switch ($status) {
        case '0':
            return '<span class="badge bg-secondary">Created</span>';
            break;

        case '1':
            return '<span class="badge bg-primary">Processed</span>';
            break;

        default:
            # code...
            break;
    }
}

// getStatusPicklist
if (!function_exists('getStatusPicklist')) {
	function getStatusPicklist($status) {
		if ($status == 0) {
			return '<span class="badge bg-warning">Created</span>';
		} else if ($status == 1) {
			return '<span class="badge bg-success">Done</span>';
		} else {
			return '<span class="badge bg-danger">Canceled</span>';
		}
	}
}
