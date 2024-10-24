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
            'productions' => $this->production->getDataProduction(),
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

	public function save_production() {
		$sku_bundling = $this->input->post('sku_bundling');
		$batch_bundling = $this->input->post('batch_bundling');
		$quantity_bundling = $this->input->post('quantity_bundling');
		$ed_bundling = $this->input->post('ed_bundling');
		$materials = $this->input->post('materials'); 

		$production_data = [
			'no_production' => generate_production_number(),
			'sku_bundling' => $sku_bundling,
			'batch_bundling' => $batch_bundling,
			'ed_bundling' => $ed_bundling,
			'created_by' => $this->session->userdata('id_users'),
			'created_at' => date('Y-m-d H:i:s') 
		];


		$this->db->insert('production', $production_data);
		$production_id = $this->db->insert_id(); 

		foreach ($materials as $material) {
			if (!empty($material['sku_material']) && !empty($material['batch']) && !empty($material['qtyBatch'])) {
				$material_data = [
					'production_id' => $production_id, 
					'sku' => $material['sku_material'],
					'batch_id' => $material['batch'],
					'quantity' => $material['qtyBatch']
				];
				$this->db->insert('production_materials', $material_data);
			}
		}

		echo json_encode(['status' => 'success']);
	}

	public function detail($id) {
		$production_details = $this->production->get_all_production_detail($id);

		$data = [
			'title' => 'Production',
			'subtitle' => 'Production',
			'subtitle2' => 'Detail Production',
			'production' => $production_details['production'],
			'materials' => $production_details['materials'],  
		];

		$this->load->view('user/production/detail', $data);
	}


}
?>
