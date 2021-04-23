<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taste extends CI_Controller {
	public function index()
	{
		$this->load->library('arabictools');
		echo $this->arabictools->arabicDate('hj Y-m-d', time());
	}
}
?>