<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Program extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_program');
	}
	
	function index(){
		$x['data']=$this->m_program->show_program();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_program',$x);
		$this->load->view('all/footer');
	}
		

	function simpan_program(){
		$nama_program=$this->input->post('nama_program');
		$materi = $this->input->post('materi');
		$materi2= implode(", ", $materi);
		$tempo=$this->input->post('tempo');
		$biaya=$this->input->post('biaya');
		$ket=$this->input->post('ket');
		$this->m_program->simpan_program($nama_program,$materi2,$tempo,$biaya,$ket);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_program->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Tambah data program kursus');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil ditambahkan!
			</div>');
		redirect('admin/program');
	}

	function edit_program(){
		$id_program=$this->input->post('id_program');
		$nama_program=$this->input->post('nama_program');
		$materi = $this->input->post('materi');
		$materi2= implode(", ", $materi);
		$tempo=$this->input->post('tempo');
		$biaya=$this->input->post('biaya');
		$ket=$this->input->post('ket');
		$this->m_program->edit_program($id_program,$nama_program,$materi2,$tempo,$biaya,$ket);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_program->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data program kursus');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil diedit!
			</div>');
		redirect('admin/program');
	}

	function hapus_program(){
		$id_program=$this->input->post('id_program');
		$this->m_program->hapus_program($id_program);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_program->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Hapus data program kursus');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil dihapus!
			</div>');
		redirect('admin/program');
	}
}
