<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bayar extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_bayar');
		$this->load->library('pdf');
	}
	
	function index(){
		$x['data']=$this->m_bayar->show_bayar();
		$x['combobox']=$this->m_bayar->combobox_id_siswa();
		$x['jumlah_bayar']=$this->m_bayar->jumlah_bayar();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_bayar',$x);
		$this->load->view('all/footer');
	}
		

	function simpan_pembayaran(){

		$id_siswa = $this->input->post('id_siswa');
		$id_admin= $_SESSION['id'];
		$nama_pembayar=$this->input->post('nama_pembayar');
		$tgl_pembayaran=date('Y/m/d');
		$jumlah_bayar=$this->input->post('jumlah_bayar');
		$this->m_bayar->simpan_pembayaran($id_siswa,$id_admin,$nama_pembayar,$tgl_pembayaran,$jumlah_bayar);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_bayar->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Tambah data pembayaran');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil ditambahkan!
			</div>');
		redirect('admin/bayar');
	}

	function edit_pembayaran(){
		$id_pembayaran = $this->input->post('id_pembayaran');
		$id_siswa = $this->input->post('id_siswa');
		$id_admin=1;
		$nama_pembayar=$this->input->post('nama_pembayar');
		$tgl_pembayaran=date('Y/m/d');
		$jumlah_bayar=$this->input->post('jumlah_bayar');
		$this->m_bayar->edit_pembayaran($id_pembayaran,$id_siswa,$id_admin,$nama_pembayar,$tgl_pembayaran,$jumlah_bayar);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_bayar->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data pembayaran');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil diedit!
			</div>');
		redirect('admin/bayar');
	}

	function hapus_pembayaran(){
		$id_pembayaran=$this->input->post('id_pembayaran');
		$this->m_bayar->hapus_pembayaran($id_pembayaran);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_bayar->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Hapus data pembayaran');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil dihapus!
			</div>');
		redirect('admin/bayar');
	}

	function cetak_kwitansi(){
		echo $x['id_pembayaran']  = $this->input->post('id_pembayaran');
		echo $x['nama_pembayar']  = $this->input->post('nama_pembayar');
		echo $x['tgl_pembayaran'] = $this->input->post('tgl_pembayaran');
		echo $x['jumlah_bayar ']  = $this->input->post('jumlah_bayar');
		$this->load->view('admin/cetak-oo', $x);
	}
}
