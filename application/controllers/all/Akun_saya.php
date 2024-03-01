<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Akun_saya extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download'));
		$this->load->model('m_akun_saya');
	}
	
	function index(){
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('all/v_akun_saya');
		$this->load->view('all/footer');
	}
		
	function combobox_id_program(){
		redirect('admin/alumni');

	}

	function ganti_sandi(){
		$sandi_lama = $this->input->post('sandi_lama');
		$sandi_baru = $this->input->post('sandi_baru');
		$sandi_baru_konfirmasi = $this->input->post('sandi_baru_konfirmasi');
		$id = $this->session->userdata('id');
		$row = $this->m_akun_saya->ambil($id);
		if(isset($row)){
            $password_encripsi = $row->password;
            if(password_verify($sandi_lama, $password_encripsi)){
            	$sandi_baru_enc = password_hash($sandi_baru, PASSWORD_DEFAULT);
            	if(strcmp($sandi_baru, $sandi_baru_konfirmasi)==0){
            		$this->m_akun_saya->ganti_sandi($id,$sandi_baru_enc);
            		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Password akun anda berhasil diubah..
						</div>');
            		redirect('all/akun_saya');
            		date_default_timezone_set('Asia/Jakarta');
					$this->m_akun_saya->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Ganti sandi akun');
            		redirect('all/akun_saya');
            	}
            	else{
            		$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, Konfirmasi sandi baru tidak sesuai!
						</div>');
            		redirect('all/akun_saya');
            	}
            }
            else{
            	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, Password lama tidak sesuai!
						</div>');
            	redirect('all/akun_saya');
            }
        }
	}
}
