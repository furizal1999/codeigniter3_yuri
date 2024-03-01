<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Alumni extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download'));
		$this->load->model('m_alumni');
	}
	
	function index(){
		$x['data']=$this->m_alumni->show_alumni();
		$x['combobox']=$this->m_alumni->combobox_id_program();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_alumni',$x);
		$this->load->view('all/footer');
	}
		
	function combobox_id_program(){
		redirect('admin/alumni');

	}

	
	function edit_alumni(){
		$id_siswa=$this->input->post('id_siswa');
		$nama_siswa=$this->input->post('nama_siswa');
		$tempat_lahir=$this->input->post('tempat_lahir');
		$tgl_lahir=$this->input->post('tgl_lahir');
		$no_hp=$this->input->post('no_hp');
		$alamat=$this->input->post('alamat');
		$tgl_masuk=$this->input->post('tgl_masuk');
		$id_program=$this->input->post('id_program');
		$sertifikat=$this->input->post('sertifikat');

		$extensionList = array("png", "jpg", "jpeg");
		$fotolama=$this->input->post('fotolama');
		$foto = $_FILES['gambar']['name'];

		  // Cek apakah user ingin mengubah fotonya atau tidak
		  if(empty($foto)){ // Jika user tidak memilih file foto pada form
		    // Lakukan proses update tanpa mengubah fotonya
		    // Proses ubah data ke Database
		    $this->m_alumni->edit_alumni_nophoto($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$sertifikat);
		    date_default_timezone_set('Asia/Jakarta');
      		$this->m_alumni->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data alumni');
		    $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
			redirect('admin/alumni');

		  }else{ // Jika user memilih foto / mengisi input file foto pada form

		  	$pecah = explode(".", $foto);
		    $ekstensi = $pecah[1];
		    $tmp = $_FILES['gambar']['tmp_name'];
		    // Lakukan proses update termasuk mengganti foto sebelumnya
		    if (in_array($ekstensi, $extensionList)){
		    
		      // Rename nama fotonya dengan menambahkan tanggal dan jam upload
		      $fotobaru = date('dmYHis').$foto;
		      // Set path folder tempat menyimpan fotonya
		      $path = "templates/img/siswa/".$fotobaru;
		      // Proses upload
		      if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		      	
		        // Cek apakah file foto sebelumnya ada di folder images
		        if(is_file("templates/img/siswa/".$fotolama)){// Jika foto ada
		        	unlink("templates/img/siswa/".$fotolama); // Hapus file foto sebelumnya yang ada di folder
		        } 
		          	
		        // Proses ubah data ke Database
		        $this->m_alumni->edit_alumni($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$sertifikat,$fotobaru);
		        date_default_timezone_set('Asia/Jakarta');
      			$this->m_alumni->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data alumni');
		        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
				redirect('admin/alumni');

		      }else{
		        // Jika gambar gagal diupload, Lakukan :
		      	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, gambar gagal di upload!
						</div>');
		      	redirect('admin/alumni');
		      }
		    }
		    else{
		    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, file yang diupload bukan file image
						</div>');
		      	redirect('admin/alumni');
		    }
		}
	}

	function lakukan_download(){
		$foto=$this->input->post('foto');
		date_default_timezone_set('Asia/Jakarta');
  		$this->m_alumni->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Download foto alumni');	
		force_download('templates/img/siswa/'.$foto,NULL);
		
	}

	function lakukan_download_sertifikat(){
		$foto=$this->input->post('foto');	
		date_default_timezone_set('Asia/Jakarta');
		$this->m_alumni->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Download sertifikat alumni');
		force_download('templates/img/sertifikat/'.$foto,NULL);

	}

}
