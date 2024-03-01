<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pendapat extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_pendapat');
	}
	
	function index(){
		$x['data']=$this->m_pendapat->show_pendapat();
		$x['combobox']=$this->m_pendapat->combobox_id_siswa();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_pendapat', $x);
		$this->load->view('all/footer');
	}
		

	function simpan_pendapat(){
		$id_siswa=$this->input->post('id_siswa');
		$pendapat=$this->input->post('pendapat');
		
		$this->m_pendapat->simpan_pendapat($id_siswa,$pendapat);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_pendapat->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Tambah data testimoni/pendapat');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil ditambahkan!
			</div>');
		redirect('admin/pendapat');
	}

	function edit_pendapat(){
		$id_pendapat=$this->input->post('id_pendapat');
		$id_siswa=$this->input->post('id_siswa');
		$pendapat=$this->input->post('pendapat');

		$this->m_pendapat->edit_pendapat($id_pendapat,$id_siswa,$pendapat);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_pendapat->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data testimoni/pendapat');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil diedit!
			</div>');
		redirect('admin/pendapat');
	}

	function hapus_pendapat(){
		$id_pendapat=$this->input->post('id_pendapat');
		$this->m_pendapat->hapus_pendapat($id_pendapat);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_pendapat->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Hapus data testimoni/pendapat');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil dihapus!
			</div>');
		redirect('admin/pendapat');
	}
}
