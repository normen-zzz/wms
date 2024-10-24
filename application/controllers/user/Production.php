<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, etc.
        $this->load->model('Production_model','production');
        $this->load->helper('url');
    }

    public function index() {
        // Load a view for the production index page
       $data = [
            'title' => 'Production',
            'subtitle' => 'Data Production',
            'subtitle2' => 'Data Production',
            'production' => $this->production->getDataProduction(),
        ];
        
       
        $this->load->view('user/production/index', $data);
    }

    public function add() {
        // Load a view for the production add page
        $data = [
            'title' => 'Production',
            'subtitle' => 'Add Production',
            'subtitle2' => 'Data Production',
            'sku_bundling' => $this->production->getSkuBundling(),
        ];
        $this->load->view('user/production/add', $data);
    }

    // get_materials
    public function get_materials() {
        $sku = $this->input->post('sku');
        $data = $this->production->getMaterials($sku)->result();
        echo json_encode($data);
    }

    // getBatchMaterial
    public function getBatchMaterial() {
        $sku = $this->input->post('sku');
        $data = $this->production->getBatchMaterial($sku)->result();
        echo json_encode($data);
    }

}
?>