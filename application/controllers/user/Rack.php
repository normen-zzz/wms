<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rack extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Rack_model', 'rack');
    }

    public function index()
    {
        $this->form_validation->set_rules('sloc', 'Sloc', 'required|trim', [
            'required' => 'sloc Rack tidak boleh kosong.'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Rack',
                'subtitle' => 'Data Rack',
                'subtitle2' => 'Data Rack',
                'rack' => $this->rack->getDataRack(),
            ];

            $this->load->view('user/rack/index', $data);
        } else {
        }
    }

    public function processAddRack()
    {
        $this->load->library('uuid');
        $uuid = $this->uuid->v4(true);

        $checkSloc = $this->db->query('SELECT sloc FROM rack WHERE sloc = "' . $this->input->post('sloc') . '" ');
        if ($checkSloc->num_rows() == 0) {
            $data = [
                'uuid' => $uuid,
                'sloc' => $this->input->post('sloc'),
                'zone' => $this->input->post('zone'),
                'rack' => $this->input->post('rack'),
                'row' => $this->input->post('row'),
                'column_rack' => $this->input->post('column'),
                'max_qty' => $this->input->post('maxqty'),
                'uom' => $this->input->post('uom'),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_users'),

            ];
            $this->db->insert('rack', $data);

            $response = array('status' => 'success', 'message' => 'Add Rack successfully.');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to Add Rack (SLOC SAME).');
        }

        echo json_encode($response);
    }

    public function get_rack($id_rack)
    {
        $rack = $this->db->get_where('rack', ['id_rack' => $id_rack])->row_array();
        echo json_encode($rack);
    }

    public function update_rack()
    {
        $data = array(
            'sloc' => $this->input->post('sloc'),
            'zone' => $this->input->post('zone'),
            'rack' => $this->input->post('rack'),
            'row' => $this->input->post('row'),
            'column_rack' => $this->input->post('column'),
            'max_qty' => $this->input->post('maxqty'),
            'uom' => $this->input->post('uom')
        );

        $this->db->where('id_rack', $this->input->post('rack_id'));
        $this->db->update('rack', $data);
        echo json_encode(['status' => 'success']);
    }


    public function delete_rack($id_rack)
    {
        $data = array(
            'is_deleted' => 1,
        );

        $this->db->where('id_rack', $id_rack);
        $this->db->update('rack', $data);
        echo json_encode(['status' => 'success']);
    }
}

/* End of file User.php */
