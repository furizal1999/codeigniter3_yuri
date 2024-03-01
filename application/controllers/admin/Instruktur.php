<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Instruktur extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download'));
		$this->load->model('m_instruktur');
	}
	
	function index(){
		$x['data']=$this->m_instruktur->show_instruktur();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_instruktur2',$x);
		$this->load->view('all/footer');
	}
		

	function simpan_instruktur(){
		$id_instruktur=$this->input->post('id_instruktur');
		$nama_instruktur=$this->input->post('nama_instruktur');
		$tempat_lahir=$this->input->post('tempat_lahir');
		$tgl_lahir=$this->input->post('tgl_lahir');
		$no_hp=$this->input->post('no_hp');
		$alamat=$this->input->post('alamat');
		
		//ekstensi foto yang akan diperbolehkan di program
    	$extensionList = array("png", "jpg", "jpeg");

    	$foto = $_FILES['gambar']['name']; //menampung nama file

	    $pecah = explode(".", $foto);
	    $ekstensi = $pecah[1];

	    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
	    $fotobaru = date('dmYHis').$foto;

	    // Set path folder tempat menyimpan fotonya
	    $path = "templates/img/instruktur/".$fotobaru;

    	if (in_array($ekstensi, $extensionList))
	    {
	        // memindahkan file ke temporary
	        $tmp = $_FILES['gambar']['tmp_name'];
	       
	        // Proses upload
	        if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
	        // Proses simpan ke Database
	        $this->m_instruktur->simpan_instruktur($id_instruktur,$nama_instruktur,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$fotobaru);
	        date_default_timezone_set('Asia/Jakarta');
  			$this->m_instruktur->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Tambah data instruktur');
	        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  Data berhasil ditambahkan!
				</div>');
			redirect('admin/instruktur');      
	        }else{
		        // Jika gambar gagal diupload, Lakukan :
		        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, Gambar gagal untuk diupload!
						</div>');
		        redirect('admin/instruktur');
	      	}
	    }else{
	    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  Maaf, file yang diupload bukan file image!
					</div>');
	        redirect('admin/instruktur');
	    }
	}

	function edit_instruktur(){
		$extensionList = array("png", "jpg", "jpeg");

		$id_instruktur=$this->input->post('id_instruktur');
		$nama_instruktur=$this->input->post('nama_instruktur');
		$tempat_lahir=$this->input->post('tempat_lahir');
		$tgl_lahir=$this->input->post('tgl_lahir');
		$no_hp=$this->input->post('no_hp');
		$alamat=$this->input->post('alamat');
		$foto=$this->input->post('foto');

		$fotolama=$this->input->post('fotolama');
		$foto = $_FILES['gambar']['name'];

		$pecah = explode(".", $foto);
	    $ekstensi = $pecah[1];
	    $tmp = $_FILES['gambar']['tmp_name'];

		  // Cek apakah user ingin mengubah fotonya atau tidak
		if(empty($foto)){ // Jika user tidak memilih file foto pada form
		    // Lakukan proses update tanpa mengubah fotonya
		    // Proses ubah data ke Database
		    $this->m_instruktur->edit_instruktur_nophoto($id_instruktur,$nama_instruktur,$tempat_lahir,$tgl_lahir,$no_hp,$alamat);
		    date_default_timezone_set('Asia/Jakarta');
  			$this->m_instruktur->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data instruktur');
	    	$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  Data berhasil diedit!
					</div>');
			redirect('admin/instruktur');

		}else{ // Jika user memilih foto / mengisi input file foto pada form
		    // Lakukan proses update termasuk mengganti foto sebelumnya
		    if (in_array($ekstensi, $extensionList)){
		    
		      // Rename nama fotonya dengan menambahkan tanggal dan jam upload
		      $fotobaru = date('dmYHis').$foto;
		      // Set path folder tempat menyimpan fotonya
		      $path = "templates/img/instruktur/".$fotobaru;
		      // Proses upload
		      if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		        // Cek apakah file foto sebelumnya ada di folder images
		        if(is_file("templates/img/instruktur/".$fotolama)){// Jika foto ada
		        	unlink("templates/img/instruktur/".$fotolama); // Hapus file foto sebelumnya yang ada di folder
		        } 
		          	
		        // Proses ubah data ke Database
		        $this->m_instruktur->edit_instruktur($id_instruktur,$nama_instruktur,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$fotobaru);
		        date_default_timezone_set('Asia/Jakarta');
  				$this->m_instruktur->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data instruktur');
		        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
				redirect('admin/instruktur');

		      }else{
		        // Jika gambar gagal diupload, Lakukan :
		        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, Gambar gagal untuk diupload!
						</div>');
		        redirect('admin/instruktur');
		      }
		    }
		    else{
		    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, file yang diupload bukan file image!
						</div>');
		        redirect('admin/instruktur');
		    }
		}
	}

	function hapus_instruktur(){
		$id_instruktur=$this->input->post('id_instruktur');
		$foto=$this->input->post('foto');
		$this->m_instruktur->hapus_instruktur($id_instruktur);
		unlink('templates/img/instruktur/'.$foto);
		date_default_timezone_set('Asia/Jakarta');
  			$this->m_instruktur->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Hapus data instruktur');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil dihapus!
						</div>');
		redirect('admin/instruktur');
	}

	function lakukan_download(){
		$foto=$this->input->post('foto');
		date_default_timezone_set('Asia/Jakarta');
  			$this->m_instruktur->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Download foto instruktur');	
		force_download('templates/img/instruktur/'.$foto,NULL);
	}
}
