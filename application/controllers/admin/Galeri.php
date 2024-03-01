<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Galeri extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download'));
		$this->load->model('m_galeri');
	}
	
	function index(){
		$x['data']=$this->m_galeri->show_galeri();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_galeri',$x);
		$this->load->view('all/footer');
	}

	function simpan_galeri(){
		$ket=$this->input->post('ket');

		//ekstensi foto yang akan diperbolehkan di program
    	$extensionList = array("png", "jpg", "jpeg");

    	$foto = $_FILES['gambar']['name'];

	    $pecah = explode(".", $foto);
	    $ekstensi = $pecah[1];

	    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
	    $fotobaru = date('dmYHis').$foto;

	    // Set path folder tempat menyimpan fotonya
	    $path = "templates/img/galeri/".$fotobaru;

    	if (in_array($ekstensi, $extensionList))
	    {
	        // memindahkan file ke temporary
	        $tmp = $_FILES['gambar']['tmp_name'];
	       
	        // Proses upload
	        if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		        // Proses simpan ke Database
		        $this->m_galeri->simpan_galeri($fotobaru,$ket);
		        date_default_timezone_set('Asia/Jakarta');
          		$this->m_galeri->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Menambahkan foto galeri');
		        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil ditambahkan!
						</div>');

				redirect('admin/galeri');      
	        }else{
		        // Jika gambar gagal diupload, Lakukan :
		        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, Gambar gagal untuk diupload!
						</div>');
	    		redirect('admin/galeri');
	      	}
	    }
	    $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, file yang diupload bukan file image!
						</div>');
	    redirect('admin/galeri');
	}

	function edit_galeri(){
		$id_foto=$this->input->post('id_foto');
		$ket=$this->input->post('ket');
		$fotolama=$this->input->post('fotolama');
		$foto = $_FILES['gambar']['name'];

		$extensionList = array("png", "jpg", "jpeg");
		$pecah = explode(".", $foto);
	    $ekstensi = $pecah[1];
	    $tmp = $_FILES['gambar']['tmp_name'];

		  // Cek apakah user ingin mengubah fotonya atau tidak
		  if(empty($foto)){ // Jika user tidak memilih file foto pada form
		    // Lakukan proses update tanpa mengubah fotonya
		    // Proses ubah data ke Database
		    $this->m_galeri->edit_galeri_nophoto($id_foto,$ket);
		    date_default_timezone_set('Asia/Jakarta');
          		$this->m_galeri->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit foto galeri');
		    $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
			redirect('admin/galeri');

		  }else{ // Jika user memilih foto / mengisi input file foto pada form
		    // Lakukan proses update termasuk mengganti foto sebelumnya
		    if (in_array($ekstensi, $extensionList)){
		    
		      // Rename nama fotonya dengan menambahkan tanggal dan jam upload
		      $fotobaru = date('dmYHis').$foto;
		      // Set path folder tempat menyimpan fotonya
		      $path = "templates/img/galeri/".$fotobaru;
		      // Proses upload
		      if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		      	
		        // Cek apakah file foto sebelumnya ada di folder images
		        if(is_file("templates/img/galeri/".$fotolama)){// Jika foto ada
		        	unlink("templates/img/galeri/".$fotolama); // Hapus file foto sebelumnya yang ada di folder
		        } 
		          	
		        // Proses ubah data ke Database
		        $this->m_galeri->edit_galeri($id_foto,$fotobaru,$ket);
		        date_default_timezone_set('Asia/Jakarta');
          		$this->m_galeri->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit foto galeri');
		        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
				redirect('admin/galeri');

		      }else{
		        // Jika gambar gagal diupload, Lakukan :
		        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, gambar gagal di upload!
						</div>');
	    		redirect('admin/galeri');
		      }
		    }
		    else{
		    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, file yang diupload bukan file image!
						</div>');
	    		redirect('admin/galeri');
		    }
		}
	}

	function hapus_galeri(){
		$id_foto=$this->input->post('id_foto');
		$foto=$this->input->post('foto');
		$this->m_galeri->hapus_galeri($id_foto);
		unlink('templates/img/galeri/'.$foto);
		date_default_timezone_set('Asia/Jakarta');
  		$this->m_galeri->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Hapus foto galeri');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil dihapus!
						</div>');
		redirect('admin/galeri');
	}

	function lakukan_download(){
		$foto=$this->input->post('foto');
		date_default_timezone_set('Asia/Jakarta');
  		$this->m_galeri->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Download foto galeri');	
		force_download('templates/img/galeri/'.$foto,NULL);
	}
}
