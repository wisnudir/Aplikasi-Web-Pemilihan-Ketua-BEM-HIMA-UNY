<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class yang berhubungan dengan pengelolaan data panitia
 *
 * 
**/

class Panitia extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		if ($this->pemilwa_library->is_loggedin()) {
			redirect('panitia/panitia','refresh');
		} else {
			redirect('admin/login','refresh');
		}
	}

	/**
	* function untuk memuka halaman pengelolaanpanitia
	*
	* @return void
	**/
	public function panitia()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		//ambil data pabitia dan role
		$var['roles'] = $this->pemilwa_library->role();	
		$var['data_panitia'] = $this->Pemilwa_model->get_data_all('admin');		

		//simpan pesan error/sukses
		$var['error'] = $this->session->flashdata('error');
		$var['sukses'] = $this->session->flashdata('sukses');

		//load halaman
		$data['header']  = 'header';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer';
		$this->pemilwa_library->display('panitia', $data, $var);
	}

	/**
	* function untuk menambah data panitia
	*
	* @return void
	**/
	public function tambah_panitia()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		if ($this->pemilwa_library->role() !== '0') {
			redirect('vote/blok/warning','refresh');
		}
		
		//cek nilai setiap field
		$this->form_validation->set_rules('id', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('role', 'role', 'required');

		//jika lolos cek field
		if ($this->form_validation->run() == TRUE) {
			$isi = array(
				'id' => $this->input->post('id'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama'),
				'role' => $this->input->post('role'),
				 );
			//jika berhasil tambah data
			if($this->Pemilwa_model->tambah_data('admin', $isi)){
				$this->session->set_flashdata('sukses', 'Akun baru telah ditambahkan');
				redirect('panitia/tambah_panitia','refresh');
			//jika gagal tambah data
			} else {
				$this->session->set_flashdata('error', 'Akun baru gagal ditambahkan');
				redirect('panitia/tambah_panitia','refresh');
			}
		//jika tidak lolos cek field atau halaman baru saja dibuka
		} else {
			//atribut form tambah data
			$var['id'] = array(
				'name' 			=> 'id',
				'type' 			=> 'text',
				'class'			=> 'form-control',
				'placeholder' 	=> 'Username',
				 );

			$var['password'] = array(
				'name' 			=> 'password',
				'type'			=> 'password',
				'class'			=> 'form-control',
				'placeholder'	=> 'Password',
				 );


			$var['nama'] = array(
				'name' 			=> 'nama',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Nama',
				 );

			$roles = array(
				null => '-- Pilih salah satu --',
				'0' => 'Admin', 
				'1' => 'Ketua KPU', 
				'2' => 'Tim Verifikasi' 
			);

			$var['role'] = array(
				'name' 			=> 'role',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'options'		=> $roles,
				 );

			$var['submit'] = array(
				'name' 			=> 'submit',
				'value'			=> 'Tambah',
				'class'			=> 'btn btn-default',
				);

			//simpan pesan eror/sukses
			$var['error_validation'] = $this->form_validation->error_string();
			$var['error'] = $this->session->flashdata('error');
			$var['sukses'] = $this->session->flashdata('sukses');

			//load halaman
			$data['header']  = 'header';
			$data['navbar']  = 'navbar';
			$data['footer']  = 'footer';
			$this->pemilwa_library->display('tambah-panitia', $data, $var);
		}			
	}

	/**
	* function untuk mengubah data panitia
	* parameter: id pabitia yang ingin diubah
	* @return void
	**/
	public function update_panitia($ids)
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		if ($this->pemilwa_library->role() !== '0') {
			redirect('vote/blok/warning','refresh');
		}
		
		//ambil id
		$var['ids'] = $ids;
		$id = $this->pemilwa_library->decode_url($ids);

		//cek nilai setiap field
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('role', 'role', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');

		//jika lolos cek field
		if ($this->form_validation->run() == TRUE) {
			$isi = array(
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama'),
				'role' => $this->input->post('role'),
				'status' => $this->input->post('status')
				 );
			//jika berhasil ubah data
			if($this->Pemilwa_model->update_data('admin', $id, $isi)){
				$this->session->set_flashdata('sukses', 'Akun telah diedit');
				redirect('panitia/panitia','refresh');
			//jika gagal ubah data
			} else {
				$this->session->set_flashdata('error', 'Akun gagal diedit');
				redirect('panitia/panitia','refresh');
			}
		//jika tidak lolos cek field atau halaman babru saja dibuka
		} else {

			//ambil data panitita sesuai id
			$data_akun = $this->Pemilwa_model->get_akun($id, 'admin');
			$var['id'] = $id;

			//atribut untuk form edit data
			$var['password'] = array(
				'name' 			=> 'password',
				'type'			=> 'password',
				'class'			=> 'form-control',
				'placeholder'	=> 'Password',
				 );

			$var['nama'] = array(
				'name' 			=> 'nama',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Nama',
				'value'			=> $data_akun->nama
				 );

			$roles = array('0' => 'Admin', '1' => 'Ketua KPU', '2' => 'Tim Verifikasi' );
			$var['role'] = array(
				'name' 			=> 'role',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'selected'		=> $data_akun->role,
				'options'		=> $roles,
				 );

			$status = array('0' => 'Tidak Aktif', '1' => 'Aktif' );
			$var['status'] = array(
				'name' 			=> 'status',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'selected'		=> $data_akun->status,
				'options'		=> $status,
				 );

			$var['submit'] = array(
				'name' 			=> 'submit',
				'value'			=> 'Simpan',
				'class'			=> 'btn btn-default',
				);

			//simpan pesan error/sukses
			$var['error_validation'] = $this->form_validation->error_string();
			$var['error'] = $this->session->flashdata('error');
			$var['sukses'] = $this->session->flashdata('sukses');

			//load halaman
			$data['header']  = 'header';
			$data['navbar']  = 'navbar';
			$data['footer']  = 'footer';
			$this->pemilwa_library->display('update-panitia', $data, $var);
		}
	}

	/**
	* function untuk menghapus data panitia
	* parameter id yang kan dihapus
	* @return void
	**/
	public function hapus_panitia($id)
	{
		//ambil id
		$m_id = $this->pemilwa_library->decode_url($id);	

		//jika akun sedang digunakan maka gagal
		if ($m_id == $this->session->userdata('id')) {
			$this->session->set_flashdata('error', 'Akun '.$m_id.' sedang digunakan, tidak dapat dihapus');
			redirect('panitia/panitia','refresh');
		//jika akun tidak sedang digunakan
		} else {
			//jika berhasil hapus
			if($this->Pemilwa_model->hapus_data('admin', $m_id)){
				$this->session->set_flashdata('sukses', 'Akun '.$m_id.' telah dihapus');
				redirect('panitia/panitia','refresh');
			//jika gagal hapus
			} else {
				$this->session->set_flashdata('error', 'Akun '.$m_id.' gagal dihapus');
				redirect('panitia/panitia','refresh');
			}
		}
	}

	/**
	* function untuk memblokir panitia
	* parameter id panitia yang kan diblokir
	* @return void
	**/
	public function blokir_panitia($id)
	{
		//ambil id
		$m_id = $this->pemilwa_library->decode_url($id);	
		//jika akun sedang dipakai maka tidak bisa diblokir		
		if ($m_id == $this->session->userdata('id')) {
			$this->session->set_flashdata('error', 'Akun '.$m_id.' sedang digunakan, tidak dapat dinonaktifkan');
			redirect('panitia/panitia','refresh');
		}
		//ubah status panitia jadi 0
		$isi = array('status' => 0);
		//jika berhasil blokir
		if($this->Pemilwa_model->update_data('admin', $m_id, $isi)){
			$this->session->set_flashdata('sukses', 'Akun '.$m_id.' telah dinonaktifkan');
			redirect('panitia/panitia','refresh');
		//jika gagal blokir
		} else {
			$this->session->set_flashdata('error', 'Akun '.$m_id.' gagal dinonaktifkan');
			redirect('panitia/panitia','refresh');
		}
	}

	/**
	* function untuk un-blokir panitia
	* parameter id panitia yang akan digunakan
	* @return void
	**/
	public function unblokir_panitia($id)
	{
		//ambil id
		$m_id = $this->pemilwa_library->decode_url($id);
		//ubah status jadi 1	
		$isi = array('status' => 1);
		//jika berhasil
		if($this->Pemilwa_model->update_data('admin', $m_id, $isi)){
			$this->session->set_flashdata('sukses', 'Akun '.$m_id.' telah diaktifkan');
			redirect('panitia/panitia','refresh');
		//jika gagal
		} else {
			$this->session->set_flashdata('error', 'Akun '.$m_id.' gagal diaktifkan');
			redirect('panitia/panitia','refresh');
		}
	}
}

/* End of file panitia.php */
/* Location: ./application/controllers/panitia.php */