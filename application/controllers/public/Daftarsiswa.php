<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarsiswa extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('m_daftarsiswa');

	}

	public function index()
	{
		$x['data_siswa']=$this->m_daftarsiswa->show_siswa();

		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('public/v_daftarsiswa',$x);
		$this->load->view('all/footer');
	}

}
