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
