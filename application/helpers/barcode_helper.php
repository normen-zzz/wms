<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_barcode')) {
	function generate_barcode($data)
	{
		$barcodeData = '*' . $data . '*';

		$barcodeHtml = '<div class="barcode" style="font-family: \'Libre Barcode 128\'; font-size: 48px; letter-spacing: 5px;">';
		$barcodeHtml .= htmlspecialchars($barcodeData);
		$barcodeHtml .= '</div>';

		return $barcodeHtml;
	}
}

function getGroupedItemsBySloc($sloc)
{
	$CI = &get_instance();

	$CI->db->select('r.sloc,b.nama_barang, b.sku, ba.batchnumber');
	$CI->db->from('rack r');
	$CI->db->join('rack_items ri', 'r.id_rack = ri.id_rack', 'inner');
	$CI->db->join('barang b', 'ri.id_barang = b.id_barang', 'inner');
	$CI->db->join('batch ba', 'ri.id_batch = ba.id_batch', 'inner');
	$CI->db->join('batchitem bi', 'b.id_barang = bi.id_barang', 'inner');
	$CI->db->where('r.sloc', $sloc);
	$CI->db->group_by(['r.sloc', 'b.sku', 'ba.batchnumber']);

	$query = $CI->db->get();

	return $query->result_array();
}
