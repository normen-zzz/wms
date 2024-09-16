<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_model');
    }

    public function index()
    {
		$data = [
                'title' => 'Setting',
                'subtitle' => 'Setting',
                'subtitle2' => 'Data Setting',
                'settings' => $this->Settings_model->get_all_settings(),
    	];
        $this->load->view('user/settings/index', $data);
    }

    public function update_setting()
    {
        $key = $this->input->post('key');
        $value = $this->input->post('value');

        $result = $this->Settings_model->update_setting($key, $value);

        if($result) {
            echo json_encode(['status' => 'success', 'message' => 'Setting updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update setting']);
        }
    }
}
