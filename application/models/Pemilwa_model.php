<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class berisi fungsi-fungsi yang berhubungan dengan database
*
*/
class Pemilwa_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Function untuk memeriksa suatu akun ada di dalam database atau tidak
	 * Parameter id akun dan nama tabel nya
	 *
	 * @author return boolean
	*/
	public function cek_akun($id, $table)
	{
		$query = $this->db->get_where($table,array('id' => $id));
		if ($query->num_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}

	/**
	 * Function untuk mengambil informasi dari suatu akun
	 * Parameter id akun dan nama tabelnya
	 *
	 * @author return sebaris data array atau FALSE
	*/
	public function get_akun($id, $table)
	{
		$query = $this->db->get_where($table,array('id' => $id));
		if ($query) {
			return $query->row();
		} else {
			FALSE;
		}				
	}

	/**
	 * Function untuk mengambil informasi pada suatu tabel berdasarkan kolom
	 * Parameter kolom yang mau diambil dan nama tabel
	 *
	 * @author return void
	*/
	public function get_field($field, $table)
	{
		$this->db->select($field);
		$query = $this->db->get($table);
		return $query->result();
	}

	/**
	 * Function untuk mengambil seluruh data pada suatu tabel
	 * parameter nama tabel
	 *
	 * @author return objek berisi data
	*/
	public function get_data_all($table)
	{
		$query = $this->db->get($table);
		return $query->result();
	}

	/**
	 * FUnction untuk mengambil seluruh data pada sustu tabel tetapi dibatasi dalam jumlah tertentu
	 * Parameter nama tabel, batasan jumlah, start mulai baris ke berapa
	 *
	 * @author return objek berisi data
	*/
	public function get_data_limit($table, $limit, $offset)
	{
		$query = $this->db->get($table, $limit, $offset);
		return $query->result();
	}

	/**
	 * Function untuk mengambil data berdasarkan suatu kata kunci dalam pencarian
	 * Parameter nama tabel dan kata kunci pencarian
	 *
	 * @author return objek berisi data
	*/
	public function get_data_search($table, $search)
	{
		$query = $this->db->like('id', $search)->or_like('nama', $search)->get($table);
		return $query->result();
	}

	/**
	 * Function untuk mengambil seluruh data pada suatu tabel tetapi dibatasi dalam jumlah tertentu dan diurutkan dengan parameter tertentu
	 * Parameter nama tabel, batasan jumlah, start mulai baris ke berapa, parameter pengurutan
	 *
	 * @author return objek berisi data
	*/
	public function get_data_limit_order($table, $limit, $offset, $order)
	{
		$query = $this->db->order_by($order, 'ASC')->get($table, $limit, $offset);
		return $query->result();
	}	

	/**
	 * Function untuk mengambil seluruh data pada suatu tabel tetapi dibatasi dalam jumlah tertentu dan diurutkan dengan parameter tertentu serta hanya tebatas pada jurusan tertentu
	 * Parameter nama tabel, batasan jumlah, start mulai baris ke berapa, parameter pengurutan, id jurusan
	 *
	 * @author return objek berisi data
	*/
	public function get_data_limit_order_jurusan($table, $limit, $offset, $order, $jurusan)
	{
		$query = $this->db->order_by($order, 'ASC')->like('dapil', $jurusan)->get($table, $limit, $offset);
		return $query->result();
	}

	/**
	 * Function untuk mengambil seluruh data pada suatu tabel tetapi  tebatas pada jurusan tertentu
	 * Parameter nama tabel, id jurusan
	 *
	 * @author return objek berisi data
	*/
	public function get_data_count_jurusan($table, $jurusan)
	{
		$query = $this->db->like('dapil', $jurusan)->get($table);
		return $query->result();
	}

	/**
	 * Function untuk menambahkan data ke suatu tabel
	 * Parameter nama tabel, data
	 *
	 * @author return boolean
	*/
	public function tambah_data($table, $data)
	{
		$query = $this->db->insert($table, $data);
		return $query;
	}

	/**
	 * Function untuk mengubah data pada tabel
	 * Parameter nama tabel, id baris yang akan diubah, data
	 *
	 * @author return boolean
	*/
	public function update_data($table, $id, $data)
	{
		$query = $this->db->update($table, $data, array('id' => $id ));
		return $query;
	}

	/**
	 * Function untuk menghapus data pada tabel
	 * Parameter nama tabel, id baris yang akan dihapus
	 *
	 * @author return boolean
	*/
	public function hapus_data($table, $id)
	{
		$query = $this->db->delete($table, array('id' => $id));
		return $query;
	}

	/**
	 * Function untuk menghapus seluruh isi data pada tabel
	 * Parameter nama tabel
	 *
	 * @author return boolean
	*/
	public function hapus_data_all($table)
	{
		$query = $this->db->truncate($table);
		return $query;
	}

	/**
	 * Function untuk mengunduh data ke suatu tabel ke dalam bentuk file .sql
	 * Parameter nama tabel
	 *
	 * @author return boolean
	*/
	public function backup($table)
	{
		date_default_timezone_set('Asia/Jakarta');
		$time = '-date-'.date('Y-M-j').'-time-'.date('H-i-s');

		$this->load->dbutil();
		$pref = array(
			'tables'	=> array($table),
			'format'	=> 'sql',
			'filename'	=> 'pemilwa-backup-'.$table.$time,
			'newline'	=> "\n"
		);
		$backup = $this->dbutil->backup($pref);
		$this->load->helper('download');
		force_download('sql-backup-'.$table.$time.'.sql', $backup);
	}

	/**
	 * Function untuk mengambil isi pengaturan dari database
	 * Parameter kunci pengaturan
	 *
	 * @author return objek berisi data
	*/
	public function pengaturan($key)
	{
		$query = $this->db->get_where('pengaturan', array('kunci' => $key))->row();
		return $query->isi;
	}

	/**
	 * Function untuk mengubah nilai pengarutan
	 * Parameter  pengaturan dan data baru
	 *
	 * @author return boolean
	*/
	public function edit_pengaturan($key, $data)
	{
		$query = $this->db->update('pengaturan', $data, array('kunci' => $key));
		return $query;
	}
	
	/**
	 * Function untuk menambahkan data suara voting
	 * Parameter jabatan, data suara, waktu pencoblosan
	 *
	 * @author return boolean
	*/
	public function vote($jabatan, $suara, $waktu)
	{
		$query = $this->db->insert('suara', array('jabatan' => $jabatan, 'suara' => $suara, 'waktu' => $waktu));
		return $query;
	}
}

/* End of file akun_model.php */
/* Location: ./application/models/akun_model.php */