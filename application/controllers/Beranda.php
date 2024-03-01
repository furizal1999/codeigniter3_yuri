<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_beranda');
		$this->load->library('form_validation');

	}

	public function index()
	{
		$x['data_instruktur']=$this->m_beranda->show_instruktur();
		$x['data_program']=$this->m_beranda->show_program();
		$x['data_pekerjaan_alumni']=$this->m_beranda->show_pekerjaan_alumni();
		$x['data_siswa']=$this->m_beranda->show_siswa();
		$x['data_alumni_sertifikat']=$this->m_beranda->show_alumni_sertifikat();
		$x['data_galeri']=$this->m_beranda->show_galeri();
		$x['combobox_id_program']=$this->m_beranda->combobox_id_program();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_beranda',$x);
		$this->load->view('all/footer');
	}

	function simpan_daftar(){
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required');
		$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('no_hp','Nomor Handphone','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('id_program','ID Program','required');

		if($this->form_validation->run() != FALSE){
			echo "Form validation oke";
		}else{
			$this->load->view('v_beranda');
		}


		$nama=$this->input->post('nama');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tgl_lahir=$this->input->post('tgl_lahir');
		$no_hp=$this->input->post('no_hp');
		$alamat=$this->input->post('alamat');
		$id_program=$this->input->post('id_program');
		$input = $this->m_beranda->simpan_daftar($nama,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$id_program);
		if($this->db->affected_rows($input) > 0){
			$data['msg'] = '<span class="alert alert-success">input data berhasil</span>';
			$this->session->set_flashdata($data);
		}
		echo $this->session->flashdata('msg');
		redirect('auto');
	}

	public function login()
	{
		$this->load->view('public/login');
	}
}
