<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Production extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Load necessary models, libraries, etc.
		$this->load->model('Production_model', 'production');
		$this->load->helper('url');
	}

	public function index()
	{
		// Load a view for the production index page
		$data = [
			'title' => 'Production',
			'subtitle' => 'Data Production',
			'subtitle2' => 'Data Production',
			'productions' => $this->production->getDataProduction(),
		];


		$this->load->view('user/production/index', $data);
	}

	public function add()
	{
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
	public function get_materials()
	{
		$sku = $this->input->post('sku');
		$data = $this->production->getMaterials($sku)->result();
		echo json_encode($data);
	}

	// getBatchMaterial
	public function getBatchMaterial()
	{
		$sku = $this->input->post('sku');
		$data = $this->production->getBatchMaterial($sku)->result();
		echo json_encode($data);
	}

	public function save_production()
	{
		$sku_bundling = $this->input->post('sku_bundling');
		$batch_bundling = $this->input->post('batch_bundling');
		$quantity_bundling = $this->input->post('quantity_bundling');
		$ed_bundling = $this->input->post('ed_bundling');
		$materials = $this->input->post('materials');

		$this->db->trans_start();

		try {
			$production_data = [
				'no_production' => generate_production_number(),
				'sku_bundling' => $sku_bundling,
				'batch_bundling' => $batch_bundling,
				'ed_bundling' => $ed_bundling,
				'qty_bundling' => $quantity_bundling,
				'created_by' => $this->session->userdata('id_users'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->db->insert('production', $production_data);
			$production_id = $this->db->insert_id();

			foreach ($materials as $material) {
				if (!empty($material['sku_material']) && !empty($material['batches'])) {
					foreach ($material['batches'] as $batch) {
						$material_data = [
							'production_id' => $production_id,
							'sku' => $material['sku_material'],
							'batch_id' => $batch['batch'],
							'quantity' => $batch['qtyBatch']
						];

						$this->db->insert('production_materials', $material_data);
					}
				}
			}

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}

			echo json_encode([
				'status' => 'success',
				'message' => 'Production saved successfully'
			]);
		} catch (Exception $e) {
			$this->db->trans_rollback();
			http_response_code(500);
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to save production: ' . $e->getMessage()
			]);
		}
	}

	public function detail($id)
	{
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

	// assign 
	public function assign($id)
	{
		$production_details = $this->production->get_all_production_detail($id);

		$data = [
			'title' => 'Production',
			'subtitle' => 'Production',
			'subtitle2' => 'Detail Production',
			'production' => $production_details['production'],
			'materials' => $production_details['materials'],
			'pickers' => $this->production->getPickers(),
		];
		$this->load->view('user/production/assign', $data);
	}

	// assignPicker
	public function assignPicker()
	{
		$production_id = $this->input->post('production_id');
		$picker_id = $this->input->post('picker');

		$data = [
			'pick_by' => $picker_id,
			'assign_at' => date('Y-m-d H:i:s'),
			'status' => 1
		];
		$update = $this->db->update('production', $data, ['id_production' => $production_id]);
		if ($update) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Picker assigned successfully'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to assign picker'
			]);
		}
	}

	public function pick($id)
	{
		$data = [
			'title' => 'Picking Production',
			'subtitle' => 'pick Production',
			'subtitle2' => 'pick Production',
			'id' => $id
		];

		$production = $this->production->getProductionById($id);

		$items = $this->production->get_material_by_production_unpick($production['id_production']);

		$data['production'] = $production;
		$data['items'] = $items;



		$this->load->view('user/production/pick', $data);
	}

	public function getAvailableRack()
	{
		$sku = $this->input->post('sku');
		$id_batch = $this->input->post('id_batch');

		$recommendations = $this->production->getAvailableRack($sku, $id_batch);

		echo json_encode($recommendations);
	}

	public function getQuantityRackItems()
	{
		$sku = $this->input->post('sku');
		$id_batch = $this->input->post('id_batch');
		$sloc = $this->input->post('rack');
		$id_rack =  $this->production->getIdRackFromSloc($sloc);
		$getLastQtyRackItems = $this->production->getLastQtyRackItems($sku, $id_batch, $id_rack['id_rack']);
		echo json_encode($getLastQtyRackItems);
	}


	function pickFromRackProcess($id_production)
	{
		$data = $this->input->post('data');


		$dataPickProduction = [];
		foreach ($data as $row) {

			$sku = $row['sku'];
			$id_batch = $row['id_batch'];
			$sloc = $row['rack'];
			$qty = $row['qty'];
			$id_material =  $row['id_material'];
			$id_rack =  $this->production->getIdRackFromSloc($sloc);
			// getIdBarangFromSku
			$id_barang = $this->production->getIdBarangFromSku($sku);
			$dataPickProduction[] = [
				'id_production' => $id_production,
				'id_material' => $id_material,
				'id_barang' => $id_barang,
				'id_batch' => $id_batch,
				'id_rack' =>  $id_rack['id_rack'],
				'qty' => $qty,
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('id_users')
			];
		}

		$id_material1 = $data[0]['id_material'];

		$insert = $this->production->insertPickProduction($dataPickProduction);
		if ($insert) {
			$updateMaterial = $this->db->update('production_materials', ['status' => 1], ['id_material' => $id_material1]);
			if ($updateMaterial) {
				echo json_encode([
					'status' => 'success',
					'message' => 'Picking processed successfully.'
				]);
			} else {
				echo json_encode([
					'status' => 'error',
					'message' => 'Failed to update material status'
				]);
			}
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to process picking'
			]);
		}
	}
	// finishProduction
	public function finishProduction($id_production)
	{
		$update = $this->db->update('production', ['status' => 2], ['id_production' => $id_production]);
		if ($update) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Production finished successfully'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to finish production'
			]);
		}
	}

	// finish
	public function finish($id)
	{
		$production_details = $this->production->get_all_production_detail($id);

		$data = [
			'title' => 'Production',
			'subtitle' => 'Production',
			'subtitle2' => 'Detail Production',
			'production' => $production_details['production'],
			'materials' => $production_details['materials'],
		];

		$this->load->view('user/production/finish', $data);
	}

	// finishAllProduction
	public function finishAllProduction($id_production)
	{
		$this->db->trans_start();
		try {
			// ambil data production berdasarkan id_production
			$production = $this->production->getProductionById($id_production);

			// ambil data material berdasarkan id_production
			$materials = $this->production->get_material_by_production($id_production);

			//perulangan material
			foreach ($materials as $material) {
				// ambil data pick production berdasarkan id_material
				$picks = $this->production->getPicksByMaterial($material['id_material']);
				// perulangan pick production
				foreach ($picks as $pick) {
					// ambil data quantity rack items berdasarkan id_barang,id_batch,id_rack
					$lastQuantityRackItemsMaterial = $this->production->getLastQtyRackItemsMaterial($pick['id_barang'], $pick['id_batch'], $pick['id_rack']);
					$updateQuantityRackItemsMaterial = $this->db->update('rack_items', ['quantity' => $lastQuantityRackItemsMaterial - $pick['qty']], ['id_barang' => $pick['id_barang'], 'id_batch' => $pick['id_batch'], 'id_rack' => $pick['id_rack']]);

					if ($updateQuantityRackItemsMaterial) {
						$updateStatusPickProduction = $this->db->update('pick_production', ['status' => 1], ['id_pick_production' => $pick['id_pick_production']]);
						if ($updateStatusPickProduction) {
							// log wms 
							$dataLog1 = [
								'id_barang' => $pick['id_barang'],
								'id_batch' => $pick['id_batch'],
								'id_rack' => $pick['id_rack'],
								'condition' => 'out',
								'qty' => $pick['qty'],
								'at' => date('Y-m-d H:i:s'),
								'by' => $this->session->userdata('id_users'),
								'no_document' => $production['no_production'],
							];
							$this->db->insert('wms_log', $dataLog1);
						} else {
							throw new Exception('Failed to update pick production status');
						}
					} else {
						throw new Exception('Failed to update rack items1');
					}
				}
				// update status material 
				$updateStatusMaterial = $this->db->update('production_materials', ['status' => 2], ['id_material' => $material['id_material']]);
				if (!$updateStatusMaterial) {
					throw new Exception('Failed to update material status');
				}
			}

			$checkBatch = $this->production->checkBatch($production['batch_bundling']);

			if ($checkBatch->num_rows() > 0) {
				$id_batch = $checkBatch->row_array()['id_batch'];
			} else {
				$dataBatch  = [
					'uuid' => uniqid(),
					'batchnumber' => $production['batch_bundling'],
					'expiration_date' => $production['ed_bundling'],
				];
				$insertBatch = $this->db->insert('batch', $dataBatch);
				if ($insertBatch) {
					$id_batch = $this->db->insert_id();
				} else {
					throw new Exception('Failed to insert batch');
				}
			}


			$id_barang = $this->production->getIdBarangFromSku($production['sku_bundling']);
			$id_rack = $this->production->getIdRackFromSloc($this->input->post('rack'));
			$id_rack = $id_rack['id_rack'];
			// checkonrackitems 
			$checkOnRackItems = $this->production->checkOnRackItems($id_barang, $id_batch, $id_rack);
			if ($checkOnRackItems->num_rows() > 0) {
				// updaterackitems base on id_barang,id_batch,id_rack
				$checkOnRackItems = $checkOnRackItems->row_array();
				$updateRackItemsBundling = $this->db->update('rack_items', ['quantity' => $checkOnRackItems['quantity'] + $production['qty_bundling']], ['id_barang' => $id_barang, 'id_batch' => $id_batch, 'id_rack' => $id_rack]);
				if ($updateRackItemsBundling) {
					// log wms 
					$dataLog = [
						'id_barang' => $id_barang,
						'id_batch' => $id_batch,
						'id_rack' => $id_rack,
						'condition' => 'in',
						'qty' => $production['qty_bundling'],
						'at' => date('Y-m-d H:i:s'),
						'by' => $this->session->userdata('id_users'),
						'no_document' => $production['no_production'],
					];
					$this->db->insert('wms_log', $dataLog);
				} else {
					throw new Exception('Failed to update rack items 2');
				}
			} else {
				$dataRackItems = [
					'id_rack' => $id_rack,
					'id_barang' => $id_barang,
					'id_batch' => $id_batch,
					'quantity' => $production['qty_bundling'],
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('id_users')
				];
				$insertRackItems = $this->db->insert('rack_items', $dataRackItems);
				if ($insertRackItems) {
					// log wms 
					$dataLog = [
						'id_barang' => $id_barang,
						'id_batch' => $id_batch,
						'id_rack' => $id_rack,
						'condition' => 'in',
						'qty' => $production['qty_bundling'],
						'at' => date('Y-m-d H:i:s'),
						'by' => $this->session->userdata('id_users'),
						'no_document' => $production['no_production'],
					];
					$this->db->insert('wms_log', $dataLog);
				} else {
					throw new Exception('Failed to insert rack items');
				}
			}

			$updateStatusProduction = $this->db->update('production', ['status' => 3], ['id_production' => $id_production]);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}
			if ($updateStatusProduction) {
				$response =  json_encode([
					'status' => 'success',
					'message' => 'Production finished'
				]);
			} else {
				throw new Exception('Failed to update production status');
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response = json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
		echo $response;
	}

	// checkRack
	public function checkRack()
	{
		$sloc = $this->input->post('rack');
		$id_rack =  $this->production->getIdRackFromSloc($sloc);
		$rack = $this->db->get_where('rack', ['id_rack' => $id_rack['id_rack']])->row_array();
		if ($rack) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Rack available'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Rack not available'
			]);
		}
	}

	// listMaterial
	public function listBundlingMaterial()
	{


		$data = [
			'title' => 'Production',
			'subtitle' => 'Production Bundling Material',
			'subtitle2' => 'Detail Bundling Material',
			'materialBundling' => $this->production->getBundlingMaterial(),
			'skuBundling' => $this->production->getSkuBundlingNotHaveMaterial(),
		];

		$this->load->view('user/production/list_material', $data);
	}

	// addBundlingMaterial view 
	public function addBundlingMaterial()
	{
		$data = [
			'title' => 'Production',
			'subtitle' => 'Production Bundling Material',
			'subtitle2' => 'Add Bundling Material',
			'skuBundling' => $this->production->getSkuBundlingNotHaveMaterial(),
		];

		$this->load->view('user/production/addBundlingMaterial', $data);
	}


	// getMaterialBundling
	public function getMaterialBundling()
	{
		$skubundling = $this->input->post('sku');
		$data = $this->production->getMaterialBundling($skubundling)->result();
		echo json_encode($data);
	}

	public function getDataBarangSelect()
	{
		$searchTerm = $this->input->post('searchTerm');

		if (!$searchTerm) {
			echo json_encode(['error' => 'No search term']);
			return;
		}
		$response = $this->production->selectBarang($searchTerm);

		if (empty($response)) {
			echo json_encode(['error' => 'No data found']);
		} else {
			echo json_encode($response);
		}
	}

	// getNamaMaterial
	public function getNamaMaterial()
	{
		$sku = $this->input->post('sku');
		$data = $this->production->getNamaMaterial($sku);
		echo json_encode($data);
	}


	// addBundlingMaterialProcess
	public function addBundlingMaterialProcess()
	{
		$this->db->trans_start();
		try {
			$sku_bundling = $this->input->post('sku_bundling');
			$sku_material = $this->input->post('sku_material');
			$quantity = $this->input->post('quantity');

			if (sizeof($sku_material) != 0) {
				for ($i = 0; $i < sizeof($sku_material); $i++) {

					$dataMaterial = [
						'sku_bundling' => $sku_bundling,
						'sku_material' => $sku_material[$i],
						'qty' => $quantity[$i],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('id_users')
					];
					$insert = $this->db->insert('bundling_material', $dataMaterial);
					if (!$insert) {
						throw new Exception('Failed to insert bundling material' . $sku_material[$i]);
					}
				}
				$response = json_encode(array('status' => 'success', 'message' => 'Bundling material inserted successfully'));
			} else {
				throw new Exception('Failed to insert bundling material,tidak ada data masuk' . sizeof($sku_material));
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed');
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response = json_encode(array('status' => 'error', 'message' => $e->getMessage() . 'hehe'));
		}
		echo $response;
	}
}
