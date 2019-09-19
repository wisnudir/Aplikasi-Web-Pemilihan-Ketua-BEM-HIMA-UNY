<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class yang berhubungan dengan pengelolaan data kandidat
*
**/

class Kandidat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		if ($this->pemilwa_library->is_loggedin()) {
			redirect('kandidat/kandidat','refresh');
		} else {
			redirect('admin/login','refresh');
		}
	}

	/**
	* function untuk memuka halaman kandidat
	*
	* @return void
	**/
	public function kandidat()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}
			
		//ambil data role dari panitia
		$var['role'] = $this->pemilwa_library->role();
		//ambil data kandidat
		$var['data_kandidat'] = $this->Pemilwa_model->get_data_all('kandidat');	

		//simpan pesan error/sukses
		$var['error'] = $this->session->flashdata('error');
		$var['sukses'] = $this->session->flashdata('sukses');

		//load halaman
		$data['header']  = 'header';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer';
		$this->pemilwa_library->display('kandidat', $data, $var);
	}

	/**
	* function untuk menambah kandidat
	*
	* @return void
	**/
	public function tambah_kandidat()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		if ($this->pemilwa_library->role() == '1') {
			redirect('vote/blok/warning','refresh');
		}

		//cek setiap field
		$this->form_validation->set_rules('jabatan', 'jabatan', 'required');
		$this->form_validation->set_rules('no_urut', 'no_urut', 'required');
		$this->form_validation->set_rules('nama1', 'nama1', 'required');

		//jika lolos cek field
		if ($this->form_validation->run() == TRUE) {

			//konfigurasi untuk foto kandidat
			$config['upload_path'] = './asset/upload/img/';
			$config['allowed_types'] = 'png|jpg|jpeg|svg';
		    $config['max_size'] = '5000';
            $config['max_width'] = 300;
            $config['max_height'] = 300;
            $config['min_width'] = 300;
            $config['min_height'] = 300;
            $config['max_filename'] = 100;
		    $this->load->library('upload', $config);
	        $this->upload->initialize($config);
		    // $this->upload->do_upload('exel');

		    //jika upload foto gagal	
		    if ( ! $this->upload->do_upload('userfile')){
	              	$this->session->set_flashdata('error', $this->upload->display_errors());

	              	//cek ada nama pasangan atau tidak
	               	if ($this->input->post('nama2') == '') {
						$nama_2 = null;
					} else {
						$nama_2 = $this->input->post('nama2');
					}

					//foto kembali ke default.png
					$isi = array(
						'nama' => $this->input->post('nama1'),
						'nama2' => $nama_2,
						'jabatan' => $this->input->post('jabatan'),
						'no_urut' => $this->input->post('no_urut'),
						'pict' => 'default.png'
						 );

					//simpan data
	               	if($this->Pemilwa_model->tambah_data('kandidat', $isi)){
						$this->session->set_flashdata('sukses', 'Akun '.$this->input->post('id').' telah ditambahkan tetapi foto gagal ditambahkan');
						redirect('kandidat/tambah_kandidat','refresh');
					//gagal simpan data
					} else {
						$this->session->set_flashdata('error', 'Akun '.$this->input->post('id').' gagal ditambahkan');
						redirect('kandidat/tambah_kandidat','refresh');
					}

				//else untuk upload foto berhasil
	            } else {
	            	//ambil nama file
	            	$upload_data = $this->upload->data(); 
				    $file_name = $upload_data['file_name']; 

				    //cek ada pasangan atau tidak
	            	if ($this->input->post('nama2') == '') {
						$nama_2 = null;
					} else {
						$nama_2 = $this->input->post('nama2');
					}

					//simpan nama file dan data lain
					$isi = array(
						'nama' => $this->input->post('nama1'),
						'nama2' => $nama_2,
						'jabatan' => $this->input->post('jabatan'),
						'no_urut' => $this->input->post('no_urut'),
						'pict' => $file_name
						 );

					//jika berhasil simpan
	               	if($this->Pemilwa_model->tambah_data('kandidat', $isi)){
						$this->session->set_flashdata('sukses', 'Akun '.$this->input->post('id').' telah ditambahkan');
						redirect('kandidat/tambah_kandidat','refresh');
					//jika gagal simpan
					} else {
						$this->session->set_flashdata('error', 'Akun '.$this->input->post('id').' gagal ditambahkan');
						redirect('kandidat/tambah_kandidat','refresh');
					}
	            }

	    //else tidak lolos cek field atau halaman baru dibuka
		} else {
			//ambil data jabatan
			$data_jabatan = $this->Pemilwa_model->get_data_all('jabatan');

			//atribut form jabatan
			$jbtn  = array(null => '-- Pilih salah satu jabatan --', );
			foreach ($data_jabatan as $j) {
				$jbtn[$j->id] = '<b>'.$j->jabatan.'</b> dapil <b>'.$j->dapil.'</b>';
			};

			$var['jabatan'] = array(
				'name' 			=> 'jabatan',
				'type' 			=> 'dropdown',
				'class'			=> 'form-control',
				'options'		=> $jbtn
				 );
			
			$var['no_urut'] = array(
				'name' 			=> 'no_urut',
				'type' 			=> 'text',
				'class'			=> 'form-control',
				'placeholder' 	=> 'Nomor Urut',
				 );

			$var['nama1'] = array(
				'name' 			=> 'nama1',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Nama',
				 );

			$var['nama2'] = array(
				'name' 			=> 'nama2',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Nama Pasangan (jika ada)',
				'default'		=>  null
				 );

			$var['foto'] = array(
				'name' 			=> 'userfile',
				'type'			=> 'file',
				'class'			=> 'form-control',
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
			$this->pemilwa_library->display('tambah-kandidat', $data, $var);
		}			
	}

	/**
	* function untuk mengupload foto
	* parameter: id kandidat yang ingin diupload fotonya
	* @return void
	**/
	public function upload_foto($id)
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		//ambil id
		$var['ids'] = $id;
		$ids = $this->pemilwa_library->decode_url($id);

		//konfigurasi upload foto
		$config['upload_path'] = './asset/upload/img/';
		$config['allowed_types'] = 'png|jpg|jpeg|svg';
		$config['max_size'] = '5000';
        $config['max_width'] = 300;
        $config['max_height'] = 300;
        $config['min_width'] = 300;
        $config['min_height'] = 300;
        $config['max_filename'] = 100;
		$this->load->library('upload', $config);
	    $this->upload->initialize($config);

	    	//jika upload gagal
		    if (!$this->upload->do_upload('userfile')){
	              	$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('kandidat/update_foto/'.$id,'refresh');	

				//jika upload berhasil	
	            } else {
	            	$upload_data = $this->upload->data(); 
				    $file_name = $upload_data['file_name']; 

					$isi = array(
						'pict' => $file_name
						 );
					//jika tersimpan di database
	               	if($this->Pemilwa_model->update_data('kandidat', $ids, $isi)){
						$this->session->set_flashdata('sukses', 'Foto berhasil diubah');
						redirect('kandidat/update_kandidat/'.$id,'refresh');
					//jika gagal tersimpan di database
					} else {
						$this->session->set_flashdata('error', 'Foto gagal diubah');
						redirect('kandidat/update_foto/'.$id,'refresh');
					}
	            }
	}

	/**
	* function untuk memuka halaman update foto
	*
	* @return void
	**/
	public function update_foto($id)
	{	
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		//ambil id
		$var['ids'] = $id;
		$ids = $this->pemilwa_library->decode_url($id);
		$data_akun = $this->Pemilwa_model->get_akun($ids, 'kandidat');


		//cek foto kosong apa tidak
		if (empty($_FILES['userfile']['name'])){		
		    $this->form_validation->set_rules('userfile', 'Document', 'required');
		} 		

		//atribut field edit foto
		$var['foto'] = array(
			'name' 			=> 'userfile',
			'type'			=> 'file',
			'class'			=> 'form-control',
			 );

		$var['submit'] = array(
			'name' 			=> 'submit',
			'value'			=> 'Tambah',
			'class'			=> 'btn btn-default',
			);
		
		//ambil data kandidat
		$var['data_kandidat'] = $data_akun;

		//simpan pesan error/sukses
		$var['error_validation'] = $this->form_validation->error_string();
		$var['error'] = $this->session->flashdata('error');
		$var['sukses'] = $this->session->flashdata('sukses');

		//load halaman
		$data['header']  = 'header';
		$data['navbar']  = 'navbar';
		$data['footer']  = 'footer';
		$this->pemilwa_library->display('update-foto', $data, $var);
	}

	/**
	* function untuk mengubah data kandidat
	* parameter: id kandidat yang akan diubah
	* @return void
	**/
	public function update_kandidat($ids)
	{	
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		if ($this->pemilwa_library->role() == '1') {
			redirect('vote/blok/warning','refresh');
		}
		//ambil id
		$var['ids'] = $ids;
		$id = $this->pemilwa_library->decode_url($ids);

		//cek nilai tiap field
		$this->form_validation->set_rules('jabatan', 'jabatan', 'required');
		$this->form_validation->set_rules('no_urut', 'no_urut', 'required');
		$this->form_validation->set_rules('nama1', 'nama1', 'required');

		//jika lolos cek field
		if ($this->form_validation->run() == TRUE) {
			
			//cek apakah ada pasangan
			if ($this->input->post('nama2') == '') {
				$nama_2 = null;
			} else {
				$nama_2 = $this->input->post('nama2');
			}

			$isi = array(
				'nama' => $this->input->post('nama1'),
				'nama2' => $nama_2,
				'jabatan' => $this->input->post('jabatan'),
				'no_urut' => $this->input->post('no_urut')
				 );
			//jika berhasil update data
			if($this->Pemilwa_model->update_data('kandidat', $id, $isi)){
				$this->session->set_flashdata('sukses', 'Akun telah diedit');
				redirect('kandidat/kandidat','refresh');
			//jika gagal update data
			} else {
				$this->session->set_flashdata('error', 'Akun gagal diedit');
				redirect('kandidat/update_kandidat','refresh');
			}

		//jika tidak lolos cek field atau halaman baru dibuka
		} else {	
			//ambil data kandidat dan jabatan		
			$data_akun = $this->Pemilwa_model->get_akun($id, 'kandidat');
			$data_jabatan = $this->Pemilwa_model->get_data_all('jabatan');

			//atribut form update jabatan
			$jbtn  = array(null => '-- Pilih salah satu jabatan --', );
			foreach ($data_jabatan as $j) {
				$jbtn[$j->id] = '<b>'.$j->jabatan.'</b> dapil <b>'.$j->dapil.'</b>';
			};

			$var['jabatan'] = array(
				'name' 			=> 'jabatan',
				'type' 			=> 'dropdown',
				'class'			=> 'form-control',
				'options'		=> $jbtn,
				'selected'		=> $data_akun->jabatan
				 );

			$var['no_urut'] = array(
				'name' 			=> 'no_urut',
				'type' 			=> 'text',
				'class'			=> 'form-control',
				'placeholder' 	=> 'Nomor Urut',
				'value'			=> $data_akun->no_urut
				 );
			$var['nama1'] = array(
				'name' 			=> 'nama1',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Nama',
				'value'			=> $data_akun->nama
				 );

			$var['nama2'] = array(
				'name' 			=> 'nama2',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Nama Pasangan (jika ada)',
				'value'			=> $data_akun->nama2,
				'default'		=> null
				 );

			$var['submit'] = array(
				'name' 			=> 'submit',
				'value'			=> 'Simpan',
				'class'			=> 'btn btn-default',
				);
			
			//ambil data jabatan
			$var['data_kandidat'] = $data_akun;

			//simpan pesan error/sukses
			$var['error_validation'] = $this->form_validation->error_string();
			$var['error'] = $this->session->flashdata('error');
			$var['sukses'] = $this->session->flashdata('sukses');

			//load halaman
			$data['header']  = 'header';
			$data['navbar']  = 'navbar';
			$data['footer']  = 'footer';
			$this->pemilwa_library->display('update-kandidat', $data, $var);
		}
	}

	/**
	* function untuk menghapus data kandidat
	* parameter: id kandidat yang aka dihapus
	* @return void
	**/
	public function hapus_kandidat($id)
	{		
		//ambil id
		$m_id = $this->pemilwa_library->decode_url($id);	
		$data_akun = $this->Pemilwa_model->get_akun($m_id, 'kandidat');
		
		if ($m_id == $this->session->userdata('id')) {
			$this->session->set_flashdata('error', 'Akun '.$data_akun->nama.' sedang digunakan, tidak dapat dihapus');
			redirect('kandidat/kandidat','refresh');
		} else {

			if($this->Pemilwa_model->hapus_data('kandidat', $m_id)){
				$this->session->set_flashdata('sukses', 'Akun '.$data_akun->nama.' telah dihapus');
				redirect('kandidat/kandidat','refresh');
			} else {
				$this->session->set_flashdata('error', 'Akun '.$data_akun->nama.' gagal dihapus');
				redirect('kandidat/kandidat','refresh');
			}
		}
	}

}

/* End of file kandidat.php */
/* Location: ./application/controllers/kandidat.php */