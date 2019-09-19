<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class Admin 
 * Untuk mengontrol aktivitas admin/panitia, hanya berisi function yang umum atau general
 * 
 **/
class Admin extends CI_Controller {
	/**
	 * function untuk mendefinisikan variabel atau meload file yang diperlukan
	 * sebagian file telah otomatis terload, cek pada application/config/autoload.php
	 * 
	 * @return void
	 **/
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	/**
	 * function untuk Authentication user
	 *
	 * @return void
	 **/
	public function index()
	{
		//cek user telah login atau belum
		if ($this->pemilwa_library->is_loggedin()) {
			redirect('admin/menu','refresh');
		} else {
			redirect('admin/login','refresh');
		}		
	}

	/**
	 * function untuk login admin/panitia
	 *
	 * @return void
	 **/
	public function login()
	{
		//validasi isi form yang dikirim user
		$this->form_validation->set_rules('id', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[3]');

		//jika lolos validasi
		if ($this->form_validation->run() == TRUE) {
			//login user
			//function login dipanggil dari library akun di application/libraries/akun.php
			if ($this->pemilwa_library->login($this->input->post('id'), $this->input->post('password'), 'admin')) {
				if ($this->session->voter_loggedin == TRUE){
					$this->session->unset_userdata('voter_id');
					$this->session->set_userdata('voter_loggedin', FALSE);					
				}
				redirect('admin/menu','refresh');
			} else {				
				redirect('admin/login','refresh');
			}
		//jika gagal validasi atau pertama kali halaman dimuat	
		} else {
			//set form input id
			$var['id'] = array(
				'name' 			=> 'id',
				'type' 			=> 'text',
				'class'			=> 'form-control hilang',
				'placeholder' 	=> 'Username',
				'autofocus'		=> true,
				'autocomplete'	=> 'on',
				'value' 		=> $this->form_validation->set_value('id'),
				 );

			//set form input password
			$var['password'] = array(
				'name' 			=> 'password',
				'type'			=> 'password',
				'class'			=> 'form-control',
				'placeholder'	=> 'Password',
				 );

			//set form tombol submit
			$var['submit'] = array(
				'name' 			=> 'submit',
				'value'			=> 'Log In',
				'class'			=> 'btn btn-default',
				);

			//set variabel error
			$var['error_validation'] = $this->form_validation->error_string();
			$var['error'] = $this->session->flashdata('error');

			//set header, footer, navbar
			$data['header']  = 'header';
			$data['navbar']  = 'navbar';
			$data['footer']  = 'footer';
			//render halaman
			//function display dipanggil dari library pemilwa_library di application/libraries/pemilwa_library.php
			$this->pemilwa_library->display('login-admin', $data, $var);
		}			
	}

	/**
	 * function untuk logout admin/panitia
	 *
	 * @return void
	**/
	public function logout()
	{
		$this->pemilwa_library->logout();
		redirect('admin','refresh');
	}

	/**
	 * function untuk membuka menu
	 *
	 * @return void
	**/
	public function menu()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}
		
		//ambil data role dan ambil id dari session
		$var['role'] = $this->pemilwa_library->role();
		$var['cek'] = $this->session->userdata('id');

		//load halaman
		$data['header']  = 'header';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer';
		$this->pemilwa_library->display('menu-admin', $data, $var);
	}

	/**
	 * function untuk membuka menu verifikasi
	 *
	 * @return void
	**/
	public function verifikasi()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		//cek field nim
		$this->form_validation->set_rules('nim', 'nim', 'required|exact_length[11]');

		//jika lolos cek field
		if ($this->form_validation->run() == TRUE) {		
			//ambil nilai nim dari field
			$id = $this->input->post('nim');

			//jika nim tidak ada di dalam database
			if ($this->Pemilwa_model->get_akun($id, 'pemilih') == FALSE) {
				$this->session->set_flashdata('error', 'NIM '.$id.' tidak terdaftar.');
				redirect('admin/verifikasi','refresh');
			}

			//jika status nim sesuai yaitu 0
			if($this->Pemilwa_model->get_akun($id, 'pemilih')->status == 0 ){
				$isi = array('status' => '1');
				//ubah status jadi 1
				$this->Pemilwa_model->update_data('pemilih', $id , $isi);
				$this->session->set_flashdata('sukses', 'NIM terdaftar dan telah diaktifkan.');
				redirect('admin/verifikasi','refresh');
			//jika status nim tak sesuai
			} else {
				$status = $this->Pemilwa_model->get_akun($id, 'pemilih')->status;
				switch ($status) {
					case '1':
						$this->session->set_flashdata('error', 'NIM terdaftar tetapi telah teraktifasi sebelumnya.');
						redirect('admin/verifikasi','refresh');
						break;					
					case '2':
						$this->session->set_flashdata('error', 'NIM terdaftar tetapi telah memberikan hak suara.');
						redirect('admin/verifikasi','refresh');
						break;
					case '3':
						$this->session->set_flashdata('error', 'NIM terdaftar tetapi diblokir.');
						redirect('admin/verifikasi','refresh');
						break;
					default:
						$this->session->set_flashdata('error', 'NIM tidak terdaftar.');
						redirect('admin/verifikasi','refresh');
						break;
				}
			}
		//jika gak lolos cek field/untuk halaman awal dibuka
		} else {
			//attribut untuk form verifikasi
			$var['nim'] = array(
				'name' 			=> 'nim',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Nomor Induk Mahasiswa',
				'id'			=> 'nimToVerif',
				'autofocus'		=> 'true'
				 );

			$var['submit'] = array(
				'name' 			=> 'submit',
				'value'			=> 'Verifikasi',
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
		$this->pemilwa_library->display('verifikasi', $data, $var);
		}
	}

	/**
	 * function untuk membuka halaman audit
	 *
	 * @return void
	**/
	public function audit()
	{		
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		//cek field kode audit
		$this->form_validation->set_rules('kode', 'kode', 'required');

		$var['data'] = null;
		//jika lolos cek field
		if ($this->form_validation->run() == TRUE) {
			//decode kode audit menjadi angka biasa
			$id = $this->pemilwa_library->decode($this->input->post('kode'), 6);
			
			//jika kode tidak ada di database
			if ($this->db->get_where('suara', array('id' => $id))->row() == null) {
				$this->session->set_flashdata('error', 'Data tidak ditemukan, kode tidak valid.');
				redirect('admin/audit','refresh');

			//jika kode ada di dalam database
			} else {
				//ambil datanya
				$query_data = $this->db->get_where('suara', array('id' => $id))->row();
				$kode_encode = $this->input->post('kode');
				$this->session->set_flashdata('sukses', 'Data ditemukan.');
				$this->session->set_flashdata('data', $query_data);
				$this->session->set_flashdata('kode_encode', $kode_encode);
				redirect('admin/audit','refresh');
			}
		//jika tidak lolos cek field atau halaman awal audit dibuka
		} else {			
			$this->session->set_flashdata('gagal', 'Data tidak ditemukan, kode tidak valid.');

			//atribut form audit
			$var['kode'] = array(
				'name' 			=> 'kode',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Kode Barcode',
				'id'			=> 'kode',
				'autofocus'		=> 'true'
				 );

			$var['submit'] = array(
				'name' 			=> 'submit',
				'value'			=> 'Cek',
				'class'			=> 'btn btn-default',
				);

		//simpan pesan error/sukses
		$var['error_validation'] = $this->form_validation->error_string();
		$var['error'] = $this->session->flashdata('error');
		$var['sukses'] = $this->session->flashdata('sukses');
		$var['data'] = $this->session->flashdata('data');
		$var['kode_encode'] = $this->session->flashdata('kode_encode');

		//tampilkan halaman
		$data['header']  = 'header';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer';
		$this->pemilwa_library->display('audit', $data, $var);
		}
	}

	/**
	 * function untuk membuka menu pengaturan
	 *
	 * @return void
	**/
	public function pengaturan()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		if ($this->pemilwa_library->role() == '2') {
			redirect('vote/blok/warning','refresh');
		}

		//ambil data pengaturan dari database
		$var['batasan_waktu_vote'] = $this->Pemilwa_model->pengaturan('batasan_waktu_vote');
		$var['print_suara'] = $this->Pemilwa_model->pengaturan('print_suara');
		$var['verifikasi_voter'] = $this->Pemilwa_model->pengaturan('verifikasi_voter');
		$var['tanggal_mulai'] = $this->Pemilwa_model->pengaturan('tanggal_mulai');
		$var['tanggal_akhir'] = $this->Pemilwa_model->pengaturan('tanggal_akhir');
		$var['tanggal_hitung'] = $this->Pemilwa_model->pengaturan('tanggal_hitung');
		$var['jam_buka'] = $this->Pemilwa_model->pengaturan('jam_buka');
		$var['jam_tutup'] = $this->Pemilwa_model->pengaturan('jam_tutup');

		//simpan pesan error/sukses
		$var['error_validation'] = $this->form_validation->error_string();
		$var['error'] = $this->session->flashdata('error');
		$var['sukses'] = $this->session->flashdata('sukses');

		//load halaman
		$data['header']  = 'header';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer';
		$this->pemilwa_library->display('pengaturan', $data, $var);
	}

	/**
	 * function khusus untuk pengaturan yang berjenis toggle (ya/tidak)
	 * parameter: kunci pengaturan dan nilainya
	 *
	 * @return void
	**/
	function toggle($key, $value)
	{
		//jika pengubahan sukses
		if ($this->Pemilwa_model->edit_pengaturan($key, array('isi' => $value))) {
			$this->session->set_flashdata('sukses', $key.' telah diubah.');
		}
		redirect('admin/pengaturan','refresh');
	}

	/**
	 * function untuk tombol reset data di menu pengaturan
	 * parameter: tabel yang ingin direset
	 *
	 * @return void
	**/
	function reset($table)
	{
		//jika reset sukses
		if ($this->Pemilwa_model->hapus_data_all($table)) {
			$this->session->set_flashdata('sukses', 'Data '.$table.' telah terhapus semua.');
		}
		redirect('admin/pengaturan','refresh');
	}

	/**
	 * function untuk tombol backup data di menu pengaturan
	 * parameter: tabel yang ingin dibackup
	 *
	 * @return void
	**/
	function backup($table)
	{
		//jika backup sukses
		if ($this->Pemilwa_model->backup($table)) {
			$this->session->set_flashdata('sukses', 'Data '.$table.' telah di backup.<br>'.$this->Pemilwa_model->backup($table));
		}
		redirect('admin/pengaturan','refresh');
	}

	/**
	 * function untuk pengaturan waktu di menu pengaturan
	 *
	 * @return void
	**/
	public function pengaturan_waktu()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		if ($this->pemilwa_library->role() == '2') {
			redirect('vote/blok/warning','refresh');
		}

		//cek isi setiap field
		$this->form_validation->set_message('tgl_voting', 'Tanggal voting ditutup harus lebih besar dari tanggal voting dibuka.');
		$this->form_validation->set_message('tgl_hitung', 'Tanggal penghitungan harus lebih besar dari tanggal voting ditutup.');
		$this->form_validation->set_message('jam_voting', 'Jam voting ditutup harus lebih besar dari jam voting dibuka.');

		$this->form_validation->set_rules('tm', 'tanggal buka voting', 'required');

		//cek tanngal tutup voting harus lebih besar dari tanggal buka
		$this->form_validation->set_rules('ta', 'tanggal tutup voting', 
			array('required', 
				array('tgl_voting',
					function()
					{
						if ($this->input->post('ta') <= $this->input->post('tm')){
							return FALSE;
						}
						else {
							return TRUE;
						}
					}
				)
			)
		);

		//cek tanggal penghitungan, harus lebih besar dari tanggal tutup voting
		$this->form_validation->set_rules('th', 'tanggal penghitungan',
			array('required', 
				array('tgl_hitung',
					function()
					{
						if ($this->input->post('th') <= $this->input->post('ta')){
							return FALSE;
						}
						else {
							return TRUE;
						}
					}
				)
			)
		);
		$this->form_validation->set_rules('jb', 'jam buka', 'required');

		//cek jam tutup harus lebih besar dari jam buka
		$this->form_validation->set_rules('jt', 'jam tutup',
			array('required', 
				array('jam_voting',
					function()
					{
						if ($this->input->post('jt') <= $this->input->post('jb')){
							return FALSE;
						}
						else {
							return TRUE;
						}
					}
				)
			)
		);

		//jika semua cek diatas lolos
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'tanggal_mulai' => $this->input->post('tm'),
				'tanggal_akhir' => $this->input->post('ta'),
				'tanggal_hitung' => $this->input->post('th'),
				'jam_buka' => $this->input->post('jb'),
				'jam_tutup' => $this->input->post('jt'),
			);

			//simpan setiap nilai
			foreach ($data as $key => $isi) {
				if ($this->Pemilwa_model->edit_pengaturan($key, array('isi' => $isi)) ){
					$this->session->set_flashdata('sukses', 'Pengeturan waktu berhasil diedit');
				} else {
					$this->session->set_flashdata('gagal', $key.' gagal diedit');					
				}
			}
			redirect('admin/pengaturan','refresh');

		//jika cek field tadi gagal, atau halaman pertama dibuka
		} else {
			//ambil nilai lamayg tersimpan di database
			$var['tm_now'] = $this->Pemilwa_model->pengaturan('tanggal_mulai');
			$var['ta_now'] = $this->Pemilwa_model->pengaturan('tanggal_akhir');
			$var['th_now'] = $this->Pemilwa_model->pengaturan('tanggal_hitung');
			$var['jb_now'] = $this->Pemilwa_model->pengaturan('jam_buka');
			$var['jt_now'] = $this->Pemilwa_model->pengaturan('jam_tutup');

			//atribut form edit pengaturan waktu
			$var['tanggal_mulai'] = array(
					'name' 			=> 'tm',
					'type'			=> 'date',
					'class'			=> 'form-control',
					//'value'			=> $tanggal_mulai
					'value'			=> set_value('tm')
					 );
			$var['tanggal_akhir'] = array(
					'name' 			=> 'ta',
					'type'			=> 'date',
					'class'			=> 'form-control',
					//'value'			=> $tanggal_akhir
					'value'			=> set_value('ta')
					 );
			$var['tanggal_hitung'] = array(
					'name' 			=> 'th',
					'type'			=> 'date',
					'class'			=> 'form-control',
					//'value'			=> $tanggal_hitung
					'value'			=> set_value('th')
					 );
			$var['jam_buka'] = array(
					'name' 			=> 'jb',
					'type'			=> 'time',
					'class'			=> 'form-control',
					//'value'			=> $jam_buka
					'value'			=> set_value('jb')
					 );
			$var['jam_tutup'] = array(
					'name' 			=> 'jt',
					'type'			=> 'time',
					'class'			=> 'form-control',
					//'value'			=> $jam_tutup
					'value'			=> set_value('jt')
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
			$this->pemilwa_library->display('pengaturan-waktu', $data, $var);
		}
	}

	/**
	 * function untuk membuka halaman panduan
	 * parameter: halaman yang ingin dibuka
	 *
	 * @return void
	**/
	public function panduan($page = null)
	{
		$data['header']  = 'header';
		$data['navbar']  = 'navbar-panduan';
		$data['footer']  = 'footer';

		if ($page) {
			$this->pemilwa_library->display('panduan/'.$page, $data);
		} else {
			$this->pemilwa_library->display('panduan/voting', $data);
		}
	}	

	/**
	 * function untuk membuka halaman statistik
	 *
	 * @return void
	 **/
	public function statistik($page = null)
	{	
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		//buat jaga jaga untuk ekspansi halaman statistik di masa depan
		if ($page == null) {
			$page = 'statistik-partisipasi';
		}

		//ambil total data yang telah memilih dan seluruhnya
		if ($page == 'statistik-partisipasi') {
			$var['telah_memilih'] = $this->db->get_where('pemilih', array('status' => '2'))->num_rows();
			$var['total'] = $this->db->select('id')->get('pemilih')->num_rows();
		}

		//ambil data-data dari database
		$var['jabatan'] = $this->Pemilwa_model->get_data_all('jabatan');
		$var['pemilih'] = $this->Pemilwa_model->get_data_all('pemilih');
		$var['kandidat'] = $this->Pemilwa_model->get_data_all('kandidat');
		$var['suara'] = $this->Pemilwa_model->get_data_all('suara');

		//ambil data nama nama jurusan
		$jurusan = array();
		foreach ($var['jabatan'] as $jab) {
			if ($jab->kode_jabatan == 'HIM') {
			array_push($jurusan, $jab->kode_dapil);
			}
		};

		//ambil data orang yang telah memilih dari tiap jurusan
		foreach ($jurusan as $jur) {
			$var{$jur} = 0;
			$var{'total'.$jur} = 0;
			$query = 'SELECT status FROM pemilih WHERE dapil LIKE \'%'.$jur.'%\'';
			if ($this->db->query($query)) {				
				$status_pemilih = $this->db->query($query)->result();
				foreach ($status_pemilih as $sp) {
					$var{'total'.$jur}++;
					if ($sp->status == '2') {
						$var{$jur}++;
					}
				}
			}
		}

		//load halaman
		$data['header']  = 'header';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer-statistik';
		$this->pemilwa_library->display($page, $data, $var);
	}

	/**
	* function untuk mencetak halaman statistik
	*
	* @return void 
	**/
	public function cetak_statistik()
	{
		$var['telah_memilih'] = $this->db->get_where('pemilih', array('status' => '2'))->num_rows();
		$var['total'] = $this->db->select('id')->get('pemilih')->num_rows();
		
		$var['jabatan'] = $this->Pemilwa_model->get_data_all('jabatan');
		$var['pemilih'] = $this->Pemilwa_model->get_data_all('pemilih');
		$var['kandidat'] = $this->Pemilwa_model->get_data_all('kandidat');
		$var['suara'] = $this->Pemilwa_model->get_data_all('suara');

		$jurusan = array();
		foreach ($var['jabatan'] as $jab) {
			if ($jab->kode_jabatan == 'HIM') {
			array_push($jurusan, $jab->kode_dapil);
			}
		};

		foreach ($jurusan as $jur) {
			$var{$jur} = 0;
			$var{'total'.$jur} = 0;
			$query = 'SELECT status FROM pemilih WHERE dapil LIKE \'%'.$jur.'%\'';
			if ($this->db->query($query)) {				
				$status_pemilih = $this->db->query($query)->result();
				foreach ($status_pemilih as $sp) {
					$var{'total'.$jur}++;
					if ($sp->status == '2') {
						$var{$jur}++;
					}
				}
			}
		}
		$data['header']  = 'header-print';
		$data['navbar']  = 'navbar-print';
		$data['footer']  = 'footer-print';
		$this->pemilwa_library->display('cetak-statistik', $data, $var);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */