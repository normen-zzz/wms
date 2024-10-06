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
}
