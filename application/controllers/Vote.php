<?php
//load library untuk printer thermal
require_once(APPPATH.'vendor/mike42/escpos-php/autoload.php'); 
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller {

	/**
	* class yang berhubungan dengan proses pmungutan suara
	* 
	**/

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	/**
	* function untuk membuka halaman awal
	* parameter skip untuk skip proteksi
	* @return void
	**/
	public function index($skip = null)
	{	
		//jika tidak skip
		if (is_null($skip)) {	
			//ambil data tanggal yang diijinka untuk dibuka
			$range = date_range($this->Pemilwa_model->pengaturan('tanggal_mulai'), $this->Pemilwa_model->pengaturan('tanggal_akhir'));
			//ambil tanggal dan jam sekarang
			$tgl_sekarang = date('Y-m-j');
			$jam_sekarang = date('H:i');
			
			//jika dibuka diluar tanggal yang ditentukan
			if (!(($tgl_sekarang >= $this->Pemilwa_model->pengaturan('tanggal_mulai')) AND ($tgl_sekarang >= $this->Pemilwa_model->pengaturan('tanggal_akhir')))) {
			//if (!in_array($tgl_sekarang, $range)) {
				redirect('vote/blok/warning-vote','refresh');
			} else {
				//jika dibuka diluar jam yang ditentukan
				if (!(($jam_sekarang >= $this->Pemilwa_model->pengaturan('jam_buka')) AND ($jam_sekarang <= $this->Pemilwa_model->pengaturan('jam_tutup')))) {
				redirect('vote/blok/warning-vote','refresh');				
				}
			}
		}

		//jika yang buka halaman belum login
		if ($this->session->voter_id == null) {			
			redirect('vote/login','refresh');
		//jika sudah login
		} else {
			redirect('vote/voting','refresh');
		}
	}

	/**
	* function untuk membuka hasil penghitungan suara
	* parameter skip untuk skip proteksi
	* @return void
	**/
	public function suara($skip = null)
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		//jika tidak skip
		if (is_null($skip)) {
			//cek apakah halaman dibuka pada tanggal yang ditentukan atau tidak
			$tgl_sekarang = date('Y-m-j');			
			if ($this->Pemilwa_model->pengaturan('tanggal_hitung') !== $tgl_sekarang) {
				redirect('vote/blok/warning-hitung','refresh');
			}
		}

		//ambil data yang diperlukan
		$var['telah_memilih'] = $this->db->get_where('pemilih', array('status' => '2'))->num_rows();
		$var['total'] = $this->db->select('id')->get('pemilih')->num_rows();
		$var['jabatan'] = $this->Pemilwa_model->get_data_all('jabatan');

		//load halaman
		$data['header']  = 'header';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer';
		$this->pemilwa_library->display('suara', $data, $var);
	}

	/**
	* function untuk login pemilih
	* 
	* @return void
	**/
	public function login()
	{	
		//cek field nim
		$this->form_validation->set_rules('nim', 'NIM', 'required|exact_length[11]');
		//jika lolos cek field
		if ($this->form_validation->run() == TRUE) {
			//ambil data pemilih
			$voter_data = $this->Pemilwa_model->get_akun($this->input->post('nim'), 'pemilih');
			//jika nim tidak ditemukan
			if ($voter_data == FALSE) {
				$this->session->set_flashdata('error', 'NIM tidak terdaftar.');
				redirect('vote/login','refresh');
			}

			//cek status pemilih
			$status = $voter_data->status;
			switch ($status) {
				//belum verifikasi
				case '0':
					//jika pengaturan verifikasi diaktifkan
					if ($this->Pemilwa_model->pengaturan('verifikasi_voter')) {						
						$this->session->set_flashdata('error', 'NIM belum diverifikasi panitia, silakan ke meja verifikasi terlebih dahulu.');
						redirect('vote/login','refresh');
					//jika pengaturan verifikasi dinonaktifkan
					} else {
						//langsung login
						if ($this->session->logged_in == TRUE){
						$this->pemilwa_library->logout();
							
						$session = array(
							'voter_id' => $voter_data->id,
							'voter_loggedin' => TRUE );				
						$this->session->set_userdata( $session );

						redirect('vote/voting','refresh');
						} else {
							$session = array(
							'voter_id' => $voter_data->id,
							'voter_loggedin' => TRUE );				
						$this->session->set_userdata( $session );

						redirect('vote/voting','refresh');
						}
					}
					break;

				//jika sudah terverifikasi
				case '1':	
					//langsung login
					if ($this->session->logged_in == TRUE){
						$this->pemilwa_library->logout();
						
					$session = array(
						'voter_id' => $voter_data->id,
						'voter_loggedin' => TRUE );				
					$this->session->set_userdata( $session );

					redirect('vote/voting','refresh');
					} else {
						$session = array(
						'voter_id' => $voter_data->id,
						'voter_loggedin' => TRUE );				
					$this->session->set_userdata( $session );

					redirect('vote/voting','refresh');
					}								
					break;
				//jika sudah pernah memeilih
				case '2':
					$this->session->set_flashdata('error', 'NIM telah memberikan hak suara.');
					redirect('vote/login','refresh');
					break;
				//jika diblokir
				case '3':
					$this->session->set_flashdata('error', 'NIM diblokir.');
					redirect('vote/login','refresh');
					break;				
				default:
					$this->session->set_flashdata('error', 'NIM tidak terdaftar di daftar pemilih tetap.');
					redirect('vote/login','refresh');
					break;
			}
			if ($status == '1') {
				redirect('vote/voting','refresh');
			} else {							
				redirect('vote/login','refresh');
			}
		//jika gak lolos cek field atau halaman baru pertama dibuka
		} else {
			//atribut field login
			$var['nim'] = array(
				'name' 			=> 'nim',
				'type' 			=> 'text',
				'class'			=> 'ui-hidden-accessible',
				'placeholder' 	=> 'Nomor Induk Mahasiswa',
				'id'			=> 'formNim',
				'autofocus'		=> true,
				'autocomplete'	=> 'on',
				'value' 		=> $this->form_validation->set_value('id'),
				 );

			$var['submit'] = array(
				'name' 			=> 'submit',
				'value'			=> 'Masuk',
				'id'			=> 'tblNim',
				'class'			=> 'ui-hidden-accessible',
				);

		//simpan pesan error
		$var['error_validation'] = $this->form_validation->error_string();
		$var['error'] = $this->session->flashdata('error');

		//load halaman
		$data['header']  = 'header-scanner';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer-main';
		$this->pemilwa_library->display('login-vote', $data, $var);
		}
	}

	/**
	* function untuk logout setelah voting
	* 
	* @return void
	**/
	public function logout()
	{
		$this->session->unset_userdata('voter_id');
		$this->session->set_userdata('voter_loggedin', FALSE);
		redirect('vote','refresh');
	}

	/**
	* function untuk membuka halaman voting
	* 
	* @return void
	**/
	public function voting()
	{
		if ($this->session->voter_id == null) {			
			redirect('vote/login','refresh');
		}

		if ($this->session->logged_in == TRUE){
			$this->pemilwa_library->logout();
		}

		//load halaman
		$data['header']  = 'header-voting';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer-voting';
		$this->pemilwa_library->display('vote', $data);
	}

	/**
	* function untuk menyimpan suara
	* 
	* @return void
	**/
	public function simpan_suara()
	{
		if ($this->session->voter_id == null) {			
			redirect('vote/login','refresh');
		}

		//cek status pemilih
		$pemilih = $this->db->get_where('pemilih', array('id' => $this->session->voter_id))->row();
		if ($pemilih->status == '2') {			
			$this->logout();
			redirect('vote/login','refresh');
		}

		//ambil dapil dipemilih
		$voter = $this->session->userdata('voter_id');
		$dapil_pemilih = $this->db->select('dapil')->get_where('pemilih', array('id' => $voter))->row();
		$dap = explode(',', $dapil_pemilih->dapil);

		//mengambil kode jabatan yg dipilih voter
		$jabatan = array();
		foreach ($dap as $d) {
			$jb = $this->db->select('id')->get_where('jabatan', array('kode_dapil' => $d))->row();
			array_push($jabatan, $jb->id);
		}

		//dat data srat suara
		$var['jabatan'] = $jabatan;
		$var['suara'] = array();
		$var['suara_plain'] = array();
		$indikator = array();
		foreach ($jabatan as $j) {
			array_push($var['suara_plain'], $this->input->post($j));
			//enkripsi suara
			$suara = $this->encrypt->encode($this->input->post($j));
			date_default_timezone_set('Asia/Jakarta');
			$waktu = date('Y-m-d H:i:s');
			//ubah ststus pemilih jadi "sudah pernah memilih"
			if ($this->Pemilwa_model->vote($j, $suara, $waktu)) {
				$this->Pemilwa_model->update_data('pemilih', $voter, array('status' => '2'));
				array_push($indikator, 'y');
				array_push($var['suara'], $suara);
			} else {				
				array_push($indikator, 'n');
			}			
		}

		$var['no_urut'] = array();
		foreach ($var['suara_plain'] as $s) {
			if ($s == 'none') {
				array_push($var['no_urut'], 'kosong');			
			} else {
				$query_nourut = $this->db->get_where('kandidat', array('id' => $s))->row();
				array_push($var['no_urut'], $query_nourut->no_urut);
			}						
		}

		if (in_array('n', $indikator)) {
			$this->session->set_flashdata('error', 'Suara anda gagal ditambahkan, silakan coba kembali.');
			redirect('vote','refresh');
		} else {
			$this->session->set_flashdata('sukses', 'Terimaksih telah berpartisipasi dalam Pemilwa tahun ini.');
			$var['barcode'] = array();
			foreach ($var['suara'] as $vs) {					
				$query_id = $this->db->get_where('suara',array('suara' => $vs ))->row();
				array_push($var['barcode'], $this->pemilwa_library->encode($query_id->id, 6));
			}

			foreach ($var['barcode'] as $bc) {
				$this->set_barcode($bc);
			}

			//simpan pesan error/sukses
			$var['error'] = $this->session->flashdata('error');
			$var['sukses'] = $this->session->flashdata('sukses');

			//load halaman
			$data['header']  = 'header';
			$data['navbar']  = 'navbar';
			$data['footer']  = 'footer-voting';
			$this->pemilwa_library->display('selesai-vote', $data, $var);
		}
	}

	/**
	* function untuk membuat barcode
	* parameter code yang akan dibuat barcode
	* @return string nama file barcode
	**/
    protected function set_barcode($code)
	{
		//load librari untuk membuat barcode
	   $this->load->library('zend');
	   $this->zend->load('Zend/Barcode');
	   //atur tipe barcode
	   $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
	   //simpan data dimana
	   $store_image = imagepng($file,"asset/img/barcode/{$code}.png");
	   return $code.'.png';
	}

	/**
	* function untuk menampilkan halaman akhir voting
	* 
	* @return void
	**/
	public function selesai()
	{
		//jika fitur print surat suara diaktifkan
		if ($this->Pemilwa_model->pengaturan('print_suara')) {
			//konfigurasi printer
			$connector = new WindowsPrintConnector("POS104Printer");
		    $printer = new Printer($connector);
		    $printer -> initialize();

		    //ambil nilai jabatan
		    $jb = array();
		    foreach ($this->input->post('jabatan[]') as $j) {
		    	array_push($jb,$j);
		    }
		    //ambil no urut
		    $nu = array();
		    foreach ($this->input->post('no_urut[]') as $n) {
		    	array_push($nu,$n);
		    }
			date_default_timezone_set('Asia/Jakarta');
		    $date = date('D j M Y H:i:s');

		    //isi kalimat yang akan dicetak
		    $printer -> feed();
		    $printer -> setJustification(Printer::JUSTIFY_CENTER);
		    $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		    $printer -> text("PEMILWA ONLINE\n");
		    $printer -> selectPrintMode();
		    $printer -> text("Fakultas Matematika\ndan Ilmu Pengetahuan Alam\n");
		    $printer -> text("UNY\n");
		    $i = 0;
		    foreach ($this->input->post('barcode[]') as $bc) {
		    	$printer -> feed();
		    	$printer -> text($jb[$i].$nu[$i]."\n");
		    	$bc = EscposImage::load('./asset/img/barcode/'.$bc.'.png');
		    	$printer -> bitImage($bc, 3);
		    	$printer -> feed();
		    	$i++;
		    }
		    $printer -> feed();
	    	$printer -> text($date . "\n");
		    $printer -> feed();
	    	$printer -> text("Terimakasih telah memberikan hak suara Anda.\n");
	    	$printer -> text("KPU FMIPA UNY 2018");
		    $printer -> feed(4);
		    $printer -> cut();
		    $printer -> pulse();
		    $printer -> close();

		    $this->logout();
		    redirect('vote','refresh');
		} else {
			$this->logout();
		    redirect('vote','refresh');
		}
	}

	/**
	* function untuk proteksi halaman
	* parameter page proteksi
	* @return void
	**/
	public function blok($page)
	{
		$data['header']  = 'header';
		$data['navbar']  = 'navbar';
		if ($page == 'warning-vote') {
			$data['footer']  = 'footer-main';
		} else {
			$data['footer']  = 'footer';
		}
		$this->pemilwa_library->display($page, $data);
	}

	/**
	* function untuk mencetak hasil penghitungan suara
	* 
	* @return void
	**/
	public function cetak_hasil()
	{
		//ambil data yang akan dicetak
		$var['telah_memilih'] = $this->db->get_where('pemilih', array('status' => '2'))->num_rows();
		$var['total'] = $this->db->select('id')->get('pemilih')->num_rows();
		$var['jabatan'] = $this->Pemilwa_model->get_data_all('jabatan');
		
		//load halaman
		$data['header']  = 'header-print';
		$data['navbar']  = 'navbar-print';
		$data['footer']  = 'footer-print';		
		$this->pemilwa_library->display('cetak-hasil', $data, $var);
	}
}

/* End of file Vote.php */
/* Location: ./application/controllers/Vote.php */
