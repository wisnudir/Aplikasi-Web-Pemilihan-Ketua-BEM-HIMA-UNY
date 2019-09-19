<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
/**
* Class yang berhubungan dengan pengelolaan jabatan
*
**/

class Jabatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		if ($this->pemilwa_library->is_loggedin()) {
			redirect('jabatan/jabatan','refresh');
		} else {
			redirect('admin/login','refresh');
		}
	}

	/**
	* function untuk memuka halaman jabatan
	*
	* @return void
	**/
	public function jabatan()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		if ($this->pemilwa_library->role() == '1') {
			redirect('vote/blok/warning','refresh');
		}

		//cek setiap field
		$this->form_validation->set_rules('kode_jabatan', 'Kode Jabatan', 'required|exact_length[3]');
		$this->form_validation->set_rules('kode_dapil', 'Kode Jabatan', 'required|exact_length[3]');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('dapil', 'Dapil', 'required');

		//jika lolos cek
		if ($this->form_validation->run() == TRUE) {
			$isi = array(
				'kode_jabatan' => $this->input->post('kode_jabatan'),
				'kode_dapil' => $this->input->post('kode_dapil'),
				'jabatan' => $this->input->post('jabatan'),
				'dapil' => $this->input->post('dapil'),
				'id' => $this->input->post('kode_jabatan').$this->input->post('kode_dapil')
				 );

			//jika berhasil simpan data
			if($this->Pemilwa_model->tambah_data('jabatan', $isi)){
				$this->session->set_flashdata('sukses', 'Jabatan baru telah ditambahkan.');
				redirect('jabatan/jabatan','refresh');
			//jika gagal simpan data
			} else {
				$this->session->set_flashdata('error', 'Jabatan baru gagal ditambahkan.');
				redirect('jabatan/jabatan','refresh');
			}
		//jika tidak lolos cek field atau halaman baru dibuka
		} else {
			//ambil data jabatan
			$var['data_jabatan'] = $this->Pemilwa_model->get_data_all('jabatan');

			//atribut untuk form tambah jabatan
			$var['kode_jabatan'] = array(
				'name' 			=> 'kode_jabatan',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> '3 huruf kode jabatan',
				 );

			$var['jabatan'] = array(
				'name' 			=> 'jabatan',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Jabatan',
				 );

			$var['kode_dapil'] = array(
				'name' 			=> 'kode_dapil',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> '3 huruf kode dapil',
				 );

			$var['dapil'] = array(
				'name' 			=> 'dapil',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Daerah Pemilihan',
				 );

			$var['submit'] = array(
				'name' 			=> 'submit',
				'value'			=> 'Tambah',
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
		$this->pemilwa_library->display('jabatan', $data, $var);
		}
	}

	/**
	* function untuk edit data jabatan
	*
	* @return void
	**/
	public function update_jabatan($id)
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		if ($this->pemilwa_library->role() == '1') {
			redirect('vote/blok/warning','refresh');
		}

		//ambil id jabatan yang diedit dati url
		$var['id'] = $id;
		$ids = $this->pemilwa_library->decode_url($id);

		//cek setiap field
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('dapil', 'Dapil', 'required');

		//jika lolos cek field
		if ($this->form_validation->run() == TRUE) {
			$isi = array(
				'jabatan' => $this->input->post('jabatan'),
				'dapil' => $this->input->post('dapil'),
				 );
			//jika berhasil diedit
			if($this->Pemilwa_model->update_data('jabatan', $ids, $isi)){
				$this->session->set_flashdata('sukses', 'Jabatan dengan kode '.$ids.' telah diedit');
				redirect('jabatan/jabatan','refresh');
			//jika gagal diedit
			} else {
				$this->session->set_flashdata('error', 'Jabatan dengan kode '.$ids.' gagal diedit');
				redirect('jabatan/jabatan','refresh');
			}
		//jika tidak lolos cek field atau halaman baru saja dibuka
		} else {
			//ambil data jabatan
			$var['data_jabatan'] = $this->Pemilwa_model->get_akun($ids, 'jabatan');

			//atribut untuk form edit
			$var['jabatan'] = array(
				'name' 			=> 'jabatan',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Jabatan',
				'value'			=> $var['data_jabatan']->jabatan
				 );

			$var['dapil'] = array(
				'name' 			=> 'dapil',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Daerah Pemilihan',
				'value'			=> $var['data_jabatan']->dapil
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
		$this->pemilwa_library->display('update_jabatan', $data, $var);
		}
	}

	/**
	* function untuk menghapus halaman
	*
	* @return void
	**/
	public function hapus_jabatan($id)
	{
		//ambil id data yang mau dihapus dari urk
		$m_id = $this->pemilwa_library->decode_url($id);

		//jika berhasil dihapus
		if($this->Pemilwa_model->hapus_data('jabatan', $m_id)){
			$this->session->set_flashdata('sukses', 'Jabatan dengan kode '.$m_id.' telah dihapus');
			redirect('jabatan/jabatan','refresh');
		//jika gagal dihapus
		} else {
			$this->session->set_flashdata('error', 'Jabatan dengan kode  '.$m_id.' gagal dihapus');
			redirect('jabatan/jabatan','refresh');
		}
	}
}

/* End of file jabatan.php */
/* Location: ./application/controllers/jabatan.php */