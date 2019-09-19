<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel/Classes/PHPExcel.php";
require_once APPPATH."/third_party/PHPExcel/Classes/PHPExcel/IOFactory.php";

class Exel extends PHPExcel
{
	public function __construct()
	{
        parent::__construct();
	}
}

/* End of file exel.php */
/* Location: ./application/libraries/exel.php */