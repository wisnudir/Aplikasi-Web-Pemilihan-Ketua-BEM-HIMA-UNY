<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class yang berhubungan dengan pengelolaan pemilih
 * 
 * 
**/

class Pemilih extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('exel');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		if ($this->pemilwa_library->is_loggedin()) {
			redirect('pemilih/show','refresh');
		} else {
			redirect('admin/login','refresh');
		}
	}

	/**
	* function untuk menampilkan halaman pengelolaan data pemilih
	* parameter: 
	* order = untuk pengurutan data berdasarkan apa
	* jurusan = untuk memfilter data berdasarkan jurusan
	* @return void
	**/
	public function show($order = 'id', $jurusan = 'FAK')
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}	

		//cek sedang search atau tidak
		$search = $this->input->post('key');

		//jika sedang search
		if ((!is_null($this->input->post('key'))) or ($this->input->post('key') != '')) {
			$var['role'] = $this->pemilwa_library->role();

			//atribut form search
			$var['key'] = array(
				'name' 			=> 'key',
				'type'			=> 'text',
				'class'			=> 'form-control',
				 );

			$var['search'] = array(
				'name' 			=> 'search',
				'value'			=> 'Search',
				'class'			=> 'btn btn-default',
				);

			//bikin sinyal sedang search
			$var['search_mode'] = 'On';
			//kata kunci search
			$var['kata_kunci'] = $search;
			//data hasil berdasarkan search
			$var['data_pemilih'] = $this->Pemilwa_model->get_data_search('pemilih', $search);		
			$var['count'] = count($var['data_pemilih']);

			//simpan pesan eror/sukses
			$var['error_validation'] = $this->form_validation->error_string();
			$var['duplikat'] = $this->session->flashdata('duplikat');
			$var['error'] = $this->session->flashdata('error');
			$var['sukses'] = $this->session->flashdata('sukses');

			//load halaman
			$data['header']  = 'header';
			$data['navbar']  = 'navbar';
			$data['footer']  = 'footer';
			$this->pemilwa_library->display('pemilih', $data, $var);

		//jika sedang tidak search
		} else {

		//buat pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url('pemilih/show/'.$order.'/'.$jurusan);
		$config['total_rows'] = count($this->Pemilwa_model->get_data_count_jurusan('pemilih', $jurusan));
		$config['per_page'] = 10;
		$config['attributes'] = array('class' => 'btn btn-default');
		$config['cur_tag_open'] = '<b class="btn btn-info disabled">';
		$config['cur_tag_close'] = '</b>';
		$this->pagination->initialize($config);
		$var['pag_link'] = $this->pagination->create_links();

		//bikin sinyal tidak sedang search
		$var['search_mode'] = null;
		$var['role'] = $this->pemilwa_library->role();

		//atribut form search dan tambah data
			$var['key'] = array(
				'name' 			=> 'key',
				'type'			=> 'text',
				'class'			=> 'form-control',
				 );

			$var['search'] = array(
				'name' 			=> 'search',
				'value'			=> 'Search',
				'class'			=> 'btn btn-default',
				);
			$var['exel'] = array(
				'name' 			=> 'userfile',
				'type'			=> 'file',
				'class'			=> 'form-control',
				 );

			$var['submit'] = array(
				'name' 			=> 'submit',
				'value'			=> 'Upload',
				'class'			=> 'btn btn-default',
				);

			//ambil batasan bayaknya data untuk pagination
			$offset = $this->uri->segment(5);
			if ($this->uri->segment(5) == null) {
				$offset = 0;
			}
			$var['count'] = count($this->Pemilwa_model->get_data_all('pemilih'));

			//ambil data sesuai dengan pagination, order, dan jurusan
			$var['data_pemilih'] = $this->Pemilwa_model->get_data_limit_order_jurusan('pemilih', $config['per_page'], $offset, $order, $jurusan);		

			//simpan pesa error/sukses
			$var['error_validation'] = $this->form_validation->error_string();
			$var['duplikat'] = $this->session->flashdata('duplikat');
			$var['error'] = $this->session->flashdata('error');
			$var['sukses'] = $this->session->flashdata('sukses');

			//load halaman
			$data['header']  = 'header';
			$data['navbar']  = 'navbar';
			$data['footer']  = 'footer';
			$this->pemilwa_library->display('pemilih', $data, $var);
		}
		
	}

	/**
	* function untuk menampilkan hasil search
	* parameter pengurutan berdasarkan apa
	* @return void
	**/

	public function show_search($order = 'id')
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}	

			//ambil kata kunci yag dimasukkan
			$search = $this->input->post('key');
			$var['role'] = $this->pemilwa_library->role();			
			$var['count'] = count($this->Pemilwa_model->get_data_all('pemilih'));

			//ambil data pemilih berdasarkan kata kunci
			$var['data_pemilih'] = $this->Pemilwa_model->get_data_limit_order_search('pemilih', $config['per_page'], $offset, $order, $search);		

			//simpan pesan error/sukses
			$var['error_validation'] = $this->form_validation->error_string();
			$var['duplikat'] = $this->session->flashdata('duplikat');
			$var['error'] = $this->session->flashdata('error');
			$var['sukses'] = $this->session->flashdata('sukses');

			//load halaman
			$data['header']  = 'header';
			$data['navbar']  = 'navbar';
			$data['footer']  = 'footer';
			$this->pemilwa_library->display('pemilih', $data, $var);
	}

	/**
	* function untuk menambah data pemilih
	* 
	* @return void
	**/
	public function tambah_pemilih()
	{
		if (!$this->pemilwa_library->is_loggedin()) {
			redirect('admin','refresh');
		}

		if ($this->pemilwa_library->role() == '1') {
			redirect('vote/blok/warning','refresh');
		}

		//cek nilai tiap field
		$this->form_validation->set_rules('id', 'NIM', 'required|exact_length[11]|is_unique[pemilih.id]');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('dapil[]', 'Dapil', 'required');

		//jika lolos cek field
		if ($this->form_validation->run() == TRUE) {

			//atur nilai dapil
			$dap = null;
			$post_dapil = $this->input->post('dapil');
			foreach ($post_dapil as $d) {
				if ($dap == null) {
					$dap = $d;
				} else {
					$dap = $dap.','.$d;
				}
			}

			//simpan dapil dan data lain
			$isi = array(
				'id' => $this->input->post('id'),
				'nama' => $this->input->post('nama'),
				'dapil' => $dap
				 );
			//jika berhasil menambahkan
			if($this->Pemilwa_model->tambah_data('pemilih', $isi)){
				$this->session->set_flashdata('sukses', 'Akun '.$this->input->post('id').' telah ditambahkan');
				redirect('pemilih/tambah_pemilih','refresh');
			//jika gagal menambahkan
			} else {
				$this->session->set_flashdata('error', 'Akun '.$this->input->post('id').' gagal ditambahkan');
				redirect('pemilih/tambah_pemilih','refresh');
			}
		//jika tidak lolos cek field atau halaman baru saja dibuka
		} else {
			//atribut form tambah data
			$var['id'] = array(
				'name' 			=> 'id',
				'type' 			=> 'text',
				'class'			=> 'form-control',
				'placeholder' 	=> 'NIM',
				 );

			$var['nama'] = array(
				'name' 			=> 'nama',
				'id'			=> 'namaBaru',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Nama',
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
			$this->pemilwa_library->display('tambah-pemilih', $data, $var);
		}
	}
	
	/**
	* function untuk tambah data dengan exel
	* 
	* @return void
	**/
	public function upload_exel_pemiilih()
	{
		//konfigurasi file exel
		$config['upload_path'] = './asset/upload/exel/';
		$config['allowed_types'] = 'xls|xlsx|csv';
	    $config['max_size'] = '50000';
	    $this->load->library('upload', $config);
        $this->upload->initialize($config);
	    // $this->upload->do_upload('exel');	

	    //jika gagal upload file exel
	    if ( ! $this->upload->do_upload('userfile'))
           {
              	$this->session->set_flashdata('error', $this->upload->display_errors());
               	redirect('pemilih/show','refresh');
            }
        //jika berhasil upload exel
        else
            {
            	//ambil nama dan ekstnesi file
				$upload_data = $this->upload->data(); 
			    $file_name = $upload_data['file_name']; 
				$extension = $upload_data['file_ext'];  
				
				//atur mesin pembaca versi exel
				$objReader= PHPExcel_IOFactory::createReader('Excel2007');	  
			    $objReader->setReadDataOnly(true); 	

			    //baca file exel
				$objPHPExcel=$objReader->load('./asset/upload/exel/'.$file_name);		 
			    $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();    	 
			    $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
			         
			    $duplikat = array();
			    $gagal = array();
			    $berhasil = array();

			    	//baca dan masukkan data dari setiap baris
			          for($i=2;$i<=$totalrows;$i++)
			          {
			              $id = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
			              $nama = $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); 
						  $dapil =$objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); 
						  $data_user=array('id'=>$id, 'nama'=>$nama,'dapil'=>$dapil);
						  if ($this->Pemilwa_model->cek_akun($id, 'pemilih')) {
						  	array_push($duplikat, $id);
						  } else {						  
							  if ($this->db->insert('pemilih', $data_user)) {
						  		array_push($berhasil, $id);							  	
							  } else {
						  		array_push($gagal, $id);							  	
							  }
						  }						  
			          }
			    //simpan pesan error/sukses
			    //unlink('././uploads/excel/'.$file_name);		 
				$this->session->set_flashdata('duplikat', $duplikat);
				$this->session->set_flashdata('error', $gagal);
				$this->session->set_flashdata('sukses', $berhasil);
				//$this->session->set_flashdata('sukses', 'Data telah ditambahkan');
				$var['data_pemilih'] = $this->Pemilwa_model->get_data_all('pemilih');		
                redirect('pemilih/show','refresh');
                }
	}

	/**
	* function untuk mengubah data ppemilih
	* parameter id pemilih yang akan diedit
	* @return void
	**/
	public function update_pemilih($ids)
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
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('dapil[]', 'Dapil', 'required');

		//jika lolos cek fiels
		if ($this->form_validation->run() == TRUE) {
			$dap = null;
			$post_dapil = $this->input->post('dapil');
			foreach ($post_dapil as $d) {
				if ($dap == null) {
					$dap = $d;
				} else {
					$dap = $dap.','.$d;
				}
			}

			$isi = array(
				'nama' => $this->input->post('nama'),
				'status' => $this->input->post('status'),
				'dapil' => $dap
				 );

			//jika berhasil edit
			if($this->Pemilwa_model->update_data('pemilih', $id, $isi)){
				$this->session->set_flashdata('sukses', 'Akun telah diedit');
				redirect('pemilih/show','refresh');
			//jika gagal edit
			} else {
				$this->session->set_flashdata('error', 'Akun gagal diedit');
				redirect('pemilih/show','refresh');
			}

		//jika tidak lolos cek field atau halaman bari saja dibuka
		} else {
			//ambil data akun
			$data_akun = $this->Pemilwa_model->get_akun($id, 'pemilih');
			$var['data_akun'] = $data_akun;

			//atribut form edit pemilih
			$query = $this->db->select(array('kode_dapil','dapil'))->distinct()->get('jabatan')->result();
			$dpl  = array(null => '-- Pilih dapil yag sesuai --', );
			foreach ($query as $j) {
				$dpl[$j->kode_dapil] = $j->dapil;
			};

			$var['nama'] = array(
				'name' 			=> 'nama',
				'type'			=> 'text',
				'class'			=> 'form-control',
				'placeholder'	=> 'Nama',
				'value'			=> $data_akun->nama
				 );

			$var['status'] = array(
				'name' 			=> 'status',
				'type'			=> 'text',
				'class'			=> 'form-control hidden',
				'placeholder'	=> 'isi 1 atau 2',
				'value'			=> $data_akun->status
				 );

			$var['dapil'] = array(
				'name' 			=> 'dapil',
				'id'			=> 'dapilOtomatis',
				'type' 			=> 'dropdown',
				'class'			=> 'form-control',
				'options'		=> $dpl,
				'selected'		=> $data_akun->dapil
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
			$this->pemilwa_library->display('update-pemilih', $data, $var);
		}
	}

	/**
	* function untuk memnghapus pemilih
	* parameter id panitia yang kan dihapus
	* @return void
	**/
	public function hapus_pemilih($id)
	{		
		//ambil id
		$m_id = $this->pemilwa_library->decode_url($id);	
		//jika akun sedang digunakan
		if ($m_id == $this->session->userdata('voter_id')) {
			$this->session->set_flashdata('error', 'Akun '.$m_id.' sedang digunakan, tidak dapat dihapus');
			redirect('pemilih/show','refresh');
		} else {
			//jika berhaisl hapus
			if($this->Pemilwa_model->hapus_data('pemilih', $m_id)){
				$this->session->set_flashdata('sukses', 'Akun '.$m_id.' telah dihapus');
				redirect('pemilih/show','refresh');
			//jika gagal hapus
			} else {
				$this->session->set_flashdata('error', 'Akun '.$m_id.' gagal dihapus');
				redirect('pemilih/show','refresh');
			}
		}
	}

	/**
	* function untuk memblokir pemilih
	* parameter id pemilih yang kan diblokir
	* @return void
	**/
	public function blokir_pemilih($id)
	{
		//ambil id
		$m_id = $this->pemilwa_library->decode_url($id);
		//ubah status jadi 3	
		$isi = array('status' => '3');
		//jika berhasil blokir
		if($this->Pemilwa_model->update_data('pemilih', $m_id, $isi)){
			$this->session->set_flashdata('sukses', 'Akun '.$m_id.' telah diblokir');
			redirect('pemilih/show','refresh');
		//jika gagal
		} else {
			$this->session->set_flashdata('error', 'Akun '.$m_id.' gagal diblokir');
			redirect('pemilih/show','refresh');
		}
	}

	/**
	* function untuk unblokir pemilih
	* parameter id panitia yang kan diunblokir
	* @return void
	**/
	public function unblokir_pemilih($id)
	{
		//ambil id
		$m_id = $this->pemilwa_library->decode_url($id);
		//ubah nilai status jadi 0	
		$isi = array('status' => '0');
		//jika berhasil
		if($this->Pemilwa_model->update_data('pemilih', $m_id, $isi)){
			$this->session->set_flashdata('sukses', 'Akun '.$m_id.' telah diaktifkan');
			redirect('pemilih/show','refresh');
		//jika gagal
		} else {
			$this->session->set_flashdata('error', 'Akun '.$m_id.' gagal diaktifkan');
			redirect('pemilih/show','refresh');
		}
	}

}

/* End of file pemilih.php */
/* Location: ./application/controllers/pemilih.php */