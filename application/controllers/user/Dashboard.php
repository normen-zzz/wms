<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Dashboard_model', 'dashboard');
	}

	public function index()
	{
			$incoming_items_per_month = $this->dashboard->count_incoming_items_per_month();
			$outgoing_items_per_month = $this->dashboard->count_outgoing_items_per_month();

			$incoming_months = [];
			$incoming_chart_data = [];
			foreach ($incoming_items_per_month as $item) {
					$incoming_months[] = date('M Y', strtotime($item->month)); 
					$incoming_chart_data[] = (int) $item->total_incoming_items;  
			}

			$outgoing_months = [];
			$outgoing_chart_data = [];
			foreach ($outgoing_items_per_month as $item) {
					$outgoing_months[] = date('M Y', strtotime($item->month)); 
					$outgoing_chart_data[] = (int) $item->total_outgoing_items;  
			}

			$data = [
					'title' => 'Dashboard',
					'subtitle' => 'Dashboard',
					'subtitle2' => 'User',
					'total_rack_items' => $this->dashboard->count_total_rack_items(),
					'total_users' => $this->dashboard->count_total_users(),
					'incoming_items_per_month' => $incoming_items_per_month,
					'outgoing_items_per_month' => $outgoing_items_per_month,
					'incoming_chart_data' => json_encode($incoming_chart_data), 
					'incoming_months' => json_encode($incoming_months),  
					'outgoing_chart_data' => json_encode($outgoing_chart_data), 
					'outgoing_months' => json_encode($outgoing_months),  
			];
			
			$this->load->view('user/dashboard/index', $data);
	}




	
}

/* End of file User.php */
