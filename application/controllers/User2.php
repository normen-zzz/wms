<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('User_model', 'user');
		$this->load->model('Admin_model', 'admin');
	}

	public function index()
	{
		
		$data = [
			'title' => 'Dashboard',
			'subtitle' => 'Dashboard',
			'subtitle2' => 'User',
			
		];
		$this->load->view('user/dashboard/index', $data);
	}

	public function proses_absen()
	{
		$id = $this->session->userdata('nip');
		$nama = $this->session->userdata('nama');
		$p = $this->input->post();
		$tgl = date('Y-m-d');
		$tahun 			= date('Y');
		$bulan 			= date('m');
		$hari 			= date('d');
		$absen			= $this->user->absendaily($this->session->userdata('nip'), $tgl);
		if ($absen->num_rows() == 0 && date('G:i:s') >= '08:00:00' && date('G:i:s') <= '09:00:00') { //Jika Tepat Waktu
			$data = [
				'nip'	=> $id,
				'nama' => $nama,
				'waktu' => $tgl,
				'keterangan' => $p['ket'],
				'jam_masuk' => date('G:i:s'),
				'keterangan_kerja' => $p['keterangan_kerja'],
				'maps_absen' => $p['location_maps']
			];
			$this->db->insert('absen', $data);
			$this->session->set_flashdata('message', 'swal("Berhasil!", "Melakukan absen masuk", "success");');
			redirect('user');
		}
		// elseif ($absen->num_rows() == 0 && date('G:i:s') < '06:00:00') {

		// 	$this->session->set_flashdata('message', 'swal("Gagal!", "Belum Waktu Masuk", "warning");');
		// 	redirect($_SERVER['HTTP_REFERER']);

		// }
		elseif ($absen->num_rows() == 0 && date('G:i:s') >= '09:00:00') { //Jika Terlambat

			$data = [
				'nip'	=> $id,
				'nama' => $nama,
				'waktu' => $tgl,
				'keterangan' => $p['ket'],
				'jam_masuk' => date('G:i:s'),
				'keterangan_kerja' => 'Terlambat',
				'maps_absen' => $p['location_maps']
			];
			$this->db->insert('absen', $data);

			$this->session->set_flashdata('message', 'swal("Berhasil!", "Anda Terlambat", "warning");');
			redirect($_SERVER['HTTP_REFERER']);
		} elseif ($absen->num_rows() == 1 && date('G:i:s') >= '16:00:00') { //Absen Pulang
			$data = [
				'nip'	=> $id,
				'keterangan' => $p['ket'],
				'jam_pulang' => date('G:i:s'),
				'deskripsi' => $p['deskripsi'],
			];

			$this->db->where('nip', $id);
			$this->db->where('waktu', $tgl);
			$this->db->update('absen', $data); // hrse ambil id_absen

			$this->session->set_flashdata('message', 'swal("Berhasil!", "Melakukan absen pulang", "success");');
			redirect('user');
		} elseif ($absen->num_rows() == 1 && date('G:i:s') <= '16:00:00') { //Jika Belum Waktu Pulang
			$this->session->set_flashdata('message', 'swal("GAGAL!", "Belum Bisa Absen Pulang", "warning");');
			redirect($_SERVER['HTTP_REFERER']);
			return false;
		}
		// else{
		// 	$this->session->set_flashdata('message', 'swal("GAGAL!", "Belum Bisa Absen Masuk, Silahkan Absen Jam 8", "warning");');
		// 	redirect($_SERVER['HTTP_REFERER']);
		//           return false;
		// }
	}

	public function profile()
	{
		$id =  $this->input->post('nip');

		$this->form_validation->set_rules('nama', 'Nama Karyawan', 'required|trim', [
			'required' => 'Nama Karyawan tidak boleh kosong.'
		]);
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'User Profile',
				'page' => 'user/user/profile',
				'subtitle' => 'Dashboard',
				'subtitle2' => 'User',
				'users' => $this->admin->listing(),
			];

			$this->load->view('templates/app', $data);
		} else {
			$data = [
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'password' => hashEncrypt($this->input->post('password')),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			];

			$oldPhoto = $this->input->post('ganti_gambar');
			$path = './images/users/';
			$config['upload_path'] 		= './images/users/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['overwrite']  		= true;

			$this->load->library('upload', $config);
			// Jika foto diubah
			if ($_FILES['photo']['name']) {
				if ($this->upload->do_upload('photo')) {

					@unlink($path . $oldPhoto);
					if (!$this->upload->do_upload('photo')) {
						$this->session->set_flashdata('message', 'swal("Ops!", "Photo gagal diupload", "error");');
						redirect(base_url('user/profile'));
					} else {
						$newPhoto = $this->upload->data();
						$data['photo'] = $newPhoto['file_name'];
					}
				}
			}
			$this->admin->editKaryawan($id, $data);
			$this->session->set_flashdata('message', 'swal("Berhasil!", "Data User Berhasil Diedit!", "success");');

			redirect(base_url('user/profile'));
		}
	}
}

/* End of file User.php */
