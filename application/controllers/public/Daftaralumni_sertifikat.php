<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftaralumni_sertifikat extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_beranda');
		$this->load->library('form_validation');

	}

	public function index()
	{
		$x['data_alumni_sertifikat']=$this->m_beranda->show_alumni_sertifikat();

		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('public/v_daftaralumni_sertifikat',$x);
		$this->load->view('all/footer');
	}

	
}
