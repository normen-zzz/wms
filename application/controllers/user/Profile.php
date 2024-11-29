<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
       
        parent::__construct();
        is_login();
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('User_model', 'user');
        $this->load->model('Admin_model', 'admin');
        // wa 
        $this->load->model('Whatsapp_model', 'wa');
    }

    public function index()
    {


        $data = [
            'title' => 'User Profile',
            'subtitle' => 'Profile',
            'subtitle2' => 'Data User',
            'users' => $this->user->getDetailUsers($this->session->userdata('id_users')),
        ];

        $this->load->view('user/profile/index', $data);
    }


    // editProfile 
    public function editProfile()
    {

        $this->db->trans_start();
        try {
            $id = $this->session->userdata('id_users');

            $data = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
            ];
            // jika ada password 
            $password = $this->input->post('password');
            if ($password) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $no_handphone = $this->input->post('no_handphone');
            if ($no_handphone) {
                // cek jika awalannya 62 langsung input, jika awalannya 0 maka angka 0 diawal  diubah jadi 62
                if (substr($no_handphone, 0, 1) == '0') {
                    $no_handphone = '62' . substr($no_handphone, 1);
                }
                $data['no_handphone'] = $no_handphone;
            }

            // photo
            $uniq = uniqid();
            // upload photo name foto
            $upload_image = $_FILES['foto']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './images/users/';
                // set filename 
                $config['file_name'] = $uniq;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $old_image = $this->session->userdata('foto');
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'images/users/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    // get extension photo 
                    $ext = explode(".", $new_image);
                    $data['foto'] = $uniq . '.' . $ext[1];
                } else {
                    throw new Exception($this->upload->display_errors());
                }
            }


            $update = $this->user->update_user($id, $data);


            if ($update) {
                // set new userdata 
                $this->session->set_userdata('nama', $data['nama']);
                $this->session->set_userdata('username', $data['username']);
                if ($no_handphone) {
                    $this->session->set_userdata('no_handphone', $data['no_handphone']);
                }

                if ($upload_image) {
                    $this->session->set_userdata('foto', $data['foto']);
                }

                $message = 'Data Profile Berhasil Diubah di wms.transtama.com, Berikut Datanya : <br>';
                $message .= 'Nama : ' . htmlspecialchars($data['nama']) . ' <br>';
                $message .= 'Username : ' . htmlspecialchars($data['username']) . ' <br>';
                $message .= 'No Handphone : ' . $no_handphone . '<br> ';

                $sendWa = $this->wa->kirim($no_handphone, $message);
                if ($sendWa) {
                    $response  = json_encode(['status' => 'success', 'message' => 'Data Berhasil Diubah']);
                } else{
                    throw new Exception('Data Gagal Diubah,Wa tidak terkirim');
                }
                
            } else {
                throw new Exception('Data Gagal Diubah');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $response = json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
        echo $response;
    }
}

/* End of file User.php */
