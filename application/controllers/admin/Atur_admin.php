<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Atur_admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download'));
		$this->load->model('m_atur_admin');

	}
	
	function index(){
		$x['data']=$this->m_atur_admin->show_atur_admin();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_atur_admin',$x);
		$this->load->view('all/footer');
	}
		

	function simpan_atur_admin(){

		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$password2=$this->input->post('password2');
		if($password==$password2){
			$nama=$this->input->post('nama');
			$no_hp=$this->input->post('no_hp');
			$jk=$this->input->post('jk');
			$password_encripsi = password_hash($password, PASSWORD_DEFAULT);
			//ekstensi foto yang akan diperbolehkan di program
	    	$extensionList = array("png", "jpg", "jpeg");

	    	$foto = $_FILES['gambar']['name'];

		    $pecah = explode(".", $foto);
		    $ekstensi = $pecah[1];

		    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
		    $fotobaru = date('dmYHis').$foto;

		    // Set path folder tempat menyimpan fotonya
		    $path = "templates/img/admin/".$fotobaru;

	    	if (in_array($ekstensi, $extensionList))
		    {
		        // memindahkan file ke temporary
		        $tmp = $_FILES['gambar']['tmp_name'];
		       
		        // Proses upload
		        if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		        // Proses simpan ke Database
			        $this->m_atur_admin->simpan_atur_admin($username,$password_encripsi,$nama,$no_hp,$jk,$fotobaru);   
			        date_default_timezone_set('Asia/Jakarta');
                  	$this->m_atur_admin->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Tambah admin baru');
			        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil ditambahkan!
						</div>');

					redirect('admin/atur_admin');      
		        }else{
			        // Jika gambar gagal diupload, Lakukan :
			        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, Gambar gagal untuk diupload!
						</div>');

					redirect('admin/atur_admin'); 
		      	}
		    }
		    else{
		    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, File yang diupload bukan file image!
						</div>');

					redirect('admin/atur_admin');
				}
		}
		else{
			$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, konfirmasi password tidak sesuai!
						</div>');
			redirect('admin/atur_admin');
		}
	}

	function edit_atur_admin(){
		$extensionList = array("png", "jpg", "jpeg");

		$id_admin=$this->input->post('id_admin');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$nama=$this->input->post('nama');
		$no_hp=$this->input->post('no_hp');
		$jk=$this->input->post('jk');
		$fotolama=$this->input->post('fotolama');
		$foto = $_FILES['gambar']['name'];

		$pecah = explode(".", $foto);
	    $ekstensi = $pecah[1];
	    $tmp = $_FILES['gambar']['tmp_name'];

		  // Cek apakah user ingin mengubah fotonya atau tidak
		  if(empty($foto)){ // Jika user tidak memilih file foto pada form
		    // Lakukan proses update tanpa mengubah fotonya
		    // Proses ubah data ke Database
		    $this->m_atur_admin->edit_atur_admin_nophoto($id_admin,$username,$password,$nama,$no_hp,$jk);
		    date_default_timezone_set('Asia/Jakarta');
          	$this->m_atur_admin->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data admin');
		    $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
		    redirect('admin/atur_admin');

		  }else{ // Jika user memilih foto / mengisi input file foto pada form
		    // Lakukan proses update termasuk mengganti foto sebelumnya
		    if (in_array($ekstensi, $extensionList)){
		    
		      // Rename nama fotonya dengan menambahkan tanggal dan jam upload
		      $fotobaru = date('dmYHis').$foto;
		      // Set path folder tempat menyimpan fotonya
		      $path = "templates/img/admin/".$fotobaru;
		      // Proses upload
		      if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		      	
		        // Cek apakah file foto sebelumnya ada di folder images
		        if(is_file("templates/img/admin/".$fotolama)){// Jika foto ada
		        	unlink("templates/img/admin/".$fotolama); // Hapus file foto sebelumnya yang ada di folder
		        } 
		          	
		        // Proses ubah data ke Database
		        $this->m_atur_admin->edit_atur_admin($id_admin,$username,$password,$nama,$no_hp,$jk,$fotobaru);
		        date_default_timezone_set('Asia/Jakarta');
              	$this->m_atur_admin->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data admin');
		        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
				redirect('admin/atur_admin');

		      }else{
		        // Jika gambar gagal diupload, Lakukan :
		        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, gambar gagal di upload!
						</div>');
				redirect('admin/atur_admin');
		      }
		    }
		    else{
		    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, File yang diupload bukan file image!
						</div>');
				redirect('admin/atur_admin');
		    }
		}


	}


	function hapus_atur_admin(){
		$id_admin=$this->input->post('id_admin');
		$foto=$this->input->post('foto');
		$this->m_atur_admin->hapus_atur_admin($id_admin);
		unlink('templates/img/admin/'.$foto);
		date_default_timezone_set('Asia/Jakarta');
      	$this->m_atur_admin->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Hapus admin');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil dihapus!
						</div>');

		redirect('admin/atur_admin');
	}

	function lakukan_download(){
		$foto=$this->input->post('foto');	
		date_default_timezone_set('Asia/Jakarta');
      	$this->m_atur_admin->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Download foto admin');
		force_download('templates/img/admin/'.$foto,NULL);
	}
}
