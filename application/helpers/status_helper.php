<?php
defined('BASEPATH') or exit('No direct script access allowed');

// getStratusBarang
if (!function_exists('getStatusBarang')) {
	function getStatusBarang($is_deleted)
	{
		if ($is_deleted == 0) {
			return '<span class="badge bg-success">Active</span>';
		} else if ($is_deleted == 1) {
			return '<span class="badge bg-danger">Inactive</span>';
		}
	}
}

// getStatusRack
if (!function_exists('getStatusRack')) {
	function getStatusRack($is_deleted)
	{
		if ($is_deleted == 0) {
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
		case '6':
			return '<span class="badge bg-danger">Void</span>';
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
			return '<span class="badge bg-primary">Picked</span>';
			break;

		case '2':
			return '<span class="badge bg-success">On Packing</span>';
			break;
			case '6':
				return '<span class="badge bg-danger">Void</span>';
				break;

		default:
			# code...
			break;
	}
}

// getStatusPicklist
if (!function_exists('getStatusPicklist')) {
	function getStatusPicklist($status)
	{
		if ($status == 0) {
			return '<span class="badge bg-warning">Created</span>';
		} else if ($status == 1) {
			return '<span class="badge bg-success">Done</span>';
		} else {
			return '<span class="badge bg-danger">Canceled</span>';
		}
	}
}

// getStatusInbound
if (!function_exists('getStatusInbound')) {
	function getStatusInbound($status)
	{
		if ($status == 0) {
			return '<span class="badge bg-secondary">Created</span>';
		} else if ($status == 1) {
			return '<span class="badge bg-primary">On Putaway</span>';
		} else if ($status == 2) {
			return '<span class="badge bg-success">Done</span>';
		}
	}
}

// getStatusPutaway
if (!function_exists('getStatusPutaway')) {
	function getStatusPutaway($status)
	{
		if ($status == 0) {
			return '<span class="badge bg-warning">Created</span>';
		} else if ($status == 1) {
			return '<span class="badge bg-success">Process</span>';
		} else if ($status == 2) {
			return '<span class="badge bg-danger">Done</span>';
		}
	}

	//statusStocktransfer
	if (!function_exists('getStatusStocktransfer')) {
		function getStatusStocktransfer($status)
		{
			if ($status == 0) {
				return '<span class="badge bg-warning">Created</span>';
			} else if ($status == 1) {
				return '<span class="badge bg-success">Done</span>';
			} else {
				return '<span class="badge bg-danger">Canceled</span>';
			}
		}
	}

	// statusProduction 
	if (!function_exists('getStatusProduction')) {
		function getStatusProduction($status,$pick_by = NULL)
		{
			$CI = &get_instance();
			$user = $CI->db->query("SELECT nama FROM users WHERE id_users = '$pick_by'")->row_array();
			if ($status == 0) {
				return '<span class="badge bg-warning">Created</span>';
			} else if ($status == 1) {
				return '<span class="badge bg-primary">Picker Assigned To ('.$user['nama'].')</span>';
			} elseif ($status == 2) {
				return '<span class="badge bg-primary">Picked By ('.$user['nama'].')</span>';
			} elseif ($status == 3) {
				return '<span class="badge bg-info">Finish</span>';
			} elseif ($status == 4) {
				return '<span class="badge bg-danger">Canceled</span>';
			}
		}
	}

	//statusStocktransfer
	if (!function_exists('getStatusAdjuststock')) {
		function getStatusAdjuststock($status)
		{
			if ($status == 0) {
				return '<span class="badge bg-warning">Created</span>';
			} else if ($status == 1) {
				return '<span class="badge bg-success">Done</span>';
			} else {
				return '<span class="badge bg-danger">Canceled</span>';
			}
		}
	}
}
