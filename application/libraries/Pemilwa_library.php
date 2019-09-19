<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* CLass yang berisi fungsi-fungsi yang sering digunakan dalam sistem ini
*/
class Pemilwa_library
{
	protected $ci;

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('encrypt');
	}

	/**
	 * Function untuk login semua jenis user
	 * Parameter id pengguna, password, nama tabel
	 *
	 * @author return boolean
	*/
	public function login($id, $pass, $table)
	{
		if($this->ci->Pemilwa_model->cek_akun($id,$table)){
			$akun = $this->ci->Pemilwa_model->get_akun($id, $table);
			if (password_verify($pass, $akun->password)) {
				$session = array(
					'id' => $id,
					'logged_in' => TRUE );				
				$this->ci->session->set_userdata( $session );
				return TRUE;
			} else {
				$this->ci->session->set_flashdata('error', 'Password salah');
				return FALSE;
			}			
		} else {
			$this->ci->session->set_flashdata('error', 'Akun tidak ditemukan');
			return FALSE;
		}
	}

	/**
	 * Function untuk logout atau keluar dari akun
	 *
	 * @author return boolean
	*/
	public function logout()
	{
		$this->ci->session->unset_userdata('id');
		$this->ci->session->set_userdata('logged_in', FALSE);
	}

	/**
	 * Function untuk memeriksa apakah sudah ada yg slogin dalam session atau belum
	 *
	 * @author return boolean
	*/
	public function is_loggedin()
	{
		return $this->ci->session->userdata('logged_in');
	}

	/**
	 * Function untuk mengambil role (hak akses) dari suatu user
	 *
	 * @author return string
	*/
	public function role()
	{
		$id = $this->ci->session->userdata('id');
		$role = $this->ci->Pemilwa_model->get_akun($id, 'admin')->role;
		return $role;
	}

	/**
	 * Function untuk mengubah URL agar bisa dibaca browser
	 * Parameter url yang akan diubah, boolean url safe
	 *
	 * @author return string
	*/
	public function encode_url($string, $url_safe=TRUE)
	{
	    $ret = $this->ci->encrypt->encode($string);

	    if ($url_safe){
	        $ret = strtr(
	                $ret,
	                array(
	                    '+' => '.',
	                    '=' => '-',
	                    '/' => '~'
	                )
	            );
	    }
	    return $ret;
	}
	public function decode_url($string)
	{
	    $string = strtr(
	            $string,
	            array(
	                '.' => '+',
	                '-' => '=',
	                '~' => '/'
	            )
	        );
	    return $this->ci->encrypt->decode($string);
	}


	/**
	 * Function untuk membuat kode barcode untuk audit suara
	 * Parameter raw string, panjang yang diinginkan
	 *
	 * @author return string
	*/
	public function encode($input, $neededLength = 0)
    {
    	$alphabet = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $output = '';
        $base = strlen($alphabet);
        if (is_numeric($neededLength)) {
            $neededLength--;
            if ($neededLength > 0) {
                $input += pow($base, $neededLength);
            }
        }
        for ($current = ($input != 0 ? floor(log($input, $base)) : 0); $current >= 0; $current--) {
            $powed = pow($base, $current);
            $floored = floor($input / $powed) % $base;
            $output = $output . substr($alphabet, $floored, 1);
            $input = $input - ($floored * $powed);
        }

        return $output;
    }


	/**
	 * Function untuk mengubah kode barcode menjadi string biasa
	 * Parameter kode barcode, panjangnya
	 *
	 * @author return boolean
	*/
    public function decode($input, $neededLength = 0)
    {
    	$alphabet = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';    	
        $output = 0;
        $base = strlen($alphabet);
        $length = strlen($input) - 1;
        for ($current = $length; $current >= 0; $current--) {
            $powed = pow($base, $length - $current);
            $output = ($output + strpos($alphabet, substr($input, $current, 1)) * $powed);
        }
        if (is_numeric($neededLength)) {
            $neededLength--;
            if ($neededLength > 0) {
                $output -= pow($base, $neededLength);
            }
        }

        return $output;
    }
    
	/**
	 * Function untuk menampilkan halaman
	 * Parameter nama halaman, data yang ingin dikirim, variabel yang ingin dikirim
	 *
	 * @author return void
	*/
    public function display($page, $data, $var = NULL)
    {	
		$dat['_header']  = $this->ci->load->view('template/'.$data['header'], $var, TRUE);
		$dat['_navbar']  = $this->ci->load->view('template/'.$data['navbar'], $var, TRUE);
		$dat['_content'] = $this->ci->load->view( $page, $var, TRUE);		
		$dat['_footer']  = $this->ci->load->view('template/'.$data['footer'], $var, TRUE);
		$dat['data'] = $var;
		$this->ci->load->view('template/master.php', $dat);
	}
}

/* End of file auth.php */
/* Location: ./application/libraries/auth.php */