<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sertifikat_siswa extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download'));
		$this->load->model('m_sertifikat_siswa');
	}
	
	function index(){
		$x['data']=$this->m_sertifikat_siswa->show_sertifikat_siswa();
		$x['combobox']=$this->m_sertifikat_siswa->combobox_id_siswa();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_sertifikat_siswa',$x);
		$this->load->view('all/footer');
	}
		

	function simpan_sertifikat_siswa(){
		$tagihan=0;
		$id_siswa=$this->input->post('id_siswa');

		if($id_siswa==="Data belum dipilih"){
			echo '<script>alert("Pilih ID siswa terlebih dahulu!");</script>';
			die();
		}
		else{
			$foto = $_FILES['gambar']['name'];

			// echo "foto masuk"; die();
			//ekstensi foto yang akan diperbolehkan di program
	    	$extensionList = array("png", "jpg", "jpeg");

		    $pecah = explode(".", $foto);
		    $ekstensi = $pecah[1];

		    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
		    $fotobaru = date('dmYHis').$foto;

		    // Set path folder tempat menyimpan fotonya
		    $path = "templates/img/sertifikat/".$fotobaru;

	    	if (in_array($ekstensi, $extensionList))
		    {
		        // memindahkan file ke temporary
		        $tmp = $_FILES['gambar']['tmp_name'];
		       
		        // Proses upload
		        if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
 
		        	// Proses simpan ke Database
			        $this->m_sertifikat_siswa->simpan_sertifikat_siswa($id_siswa,$fotobaru);
			        date_default_timezone_set('Asia/Jakarta');
					$this->m_sertifikat_siswa->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Tambah sertifikat siswa');
			        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Sertifikat berhasil ditambahkan!
						</div>');
					    redirect('admin/sertifikat_siswa');
		        }else{
			        // Jika gambar gagal diupload, Lakukan :
			        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, Gambar gagal untuk diupload!
						</div>');
			        redirect('admin/sertifikat_siswa');
		      	}
		    }
		    else{
		    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, file yang diupload bukan file image!
						</div>');
		    	redirect('admin/sertifikat_siswa');
		    }
		}
	}

	function edit_sertifikat_siswa(){
		$extensionList = array("png", "jpg", "jpeg");

		$id_siswa=$this->input->post('id_siswa');
		$nama_siswa=$this->input->post('nama_siswa');		
		$fotolama=$this->input->post('fotolama');
		$foto = $_FILES['gambar']['name'];

		$pecah = explode(".", $foto);
	    $ekstensi = $pecah[1];
	    $tmp = $_FILES['gambar']['tmp_name'];

		  // Cek apakah user ingin mengubah fotonya atau tidak
		  if(empty($foto)){ // Jika user tidak memilih file foto pada form
		    echo '<script>alert("Maaf, gambar belum dipilih!");</script>';

		  }else{ // Jika user memilih foto / mengisi input file foto pada form
		    // Lakukan proses update termasuk mengganti foto sebelumnya
		    if (in_array($ekstensi, $extensionList)){
		    
		      // Rename nama fotonya dengan menambahkan tanggal dan jam upload
		      $fotobaru = date('dmYHis').$foto;
		      // Set path folder tempat menyimpan fotonya
		      $path = "templates/img/sertifikat/".$fotobaru;
		      // Proses upload
		      if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		      	
		        // Cek apakah file foto sebelumnya ada di folder images
		        if(is_file("templates/img/sertifikat/".$fotolama)){// Jika foto ada
		        	unlink("templates/img/sertifikat/".$fotolama); // Hapus file foto sebelumnya yang ada di folder
		        } 
		          	
		        // Proses ubah data ke Database
		        $this->m_sertifikat_siswa->edit_sertifikat_siswa($id_siswa,$fotobaru);
		        date_default_timezone_set('Asia/Jakarta');
				$this->m_sertifikat_siswa->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit sertifikat siswa');
		        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  sertifikat berhasil diedit!
					</div>');
				redirect('admin/sertifikat_siswa');

		      }else{
		        // Jika gambar gagal diupload, Lakukan :
		        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, Gambar gagal untuk diupload!
						</div>');
			        redirect('admin/sertifikat_siswa');
		      }
		    }
		    else{
		    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, file yang diupload bukan file image!
						</div>');
			        redirect('admin/sertifikat_siswa');
		    }
		}
	}

	function hapus_sertifikat_siswa(){
		$id_siswa=$this->input->post('id_siswa');
		$fotolama=$this->input->post('fotolama');
		if(is_file("templates/img/sertifikat/".$fotolama)){// Jika foto ada
        	unlink("templates/img/sertifikat/".$fotolama); // Hapus file foto sebelumnya yang ada di folder
        } 
		$this->m_sertifikat_siswa->hapus_sertifikat_siswa($id_siswa);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_sertifikat_siswa->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Hapus sertifikat siswa');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Sertifikat berhasil dihapus!
			</div>');
		redirect('admin/sertifikat_siswa');
	}

	function lakukan_download(){
		$foto=$this->input->post('foto');	
		date_default_timezone_set('Asia/Jakarta');
		$this->m_sertifikat_siswa->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Download sertifikat siswa');
		force_download('templates/img/sertifikat/'.$foto,NULL);
	}
}