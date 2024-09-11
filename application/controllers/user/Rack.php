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

            $this->load->library('uuid');
            $uuid = $this->uuid->v4(true);
           
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
            $this->db->insert('rack',$data);
            $this->session->set_flashdata("message", "Toast.fire({icon: 'success',title: 'Success'})");
            redirect(base_url('user/Rack'));
        }
    }
}

/* End of file User.php */
