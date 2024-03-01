<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pekerjaan_alumni extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_pekerjaan_alumni');
	}
	
	function index(){
		$x['data']=$this->m_pekerjaan_alumni->show_pekerjaan_alumni();
		$x['combobox']=$this->m_pekerjaan_alumni->combobox_id_siswa();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_pekerjaan_alumni',$x);
		$this->load->view('all/footer');
	}
		

	function simpan_pekerjaan_alumni(){
		// $id_pekerjaan_alumni=$this->input->post('id_pekerjaan_alumni');
		$nama_pekerjaan_alumni=$this->input->post('nama_pekerjaan_alumni');
		$tempat_kerja=$this->input->post('tempat_kerja');
		$tgl_terima=$this->input->post('tgl_terima');
		$alamat_kerja=$this->input->post('alamat_kerja');
		$jabatan=$this->input->post('jabatan');
		$motivasi=$this->input->post('motivasi');
		$id_siswa=$this->input->post('id_siswa');
		$foto = $_FILES['gambar']['name'];

		$extensionList = array("png", "jpg", "jpeg");

	    $pecah = explode(".", $foto);
	    $ekstensi = $pecah[1];

	    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
	    $fotobaru = date('dmYHis').$foto;

	    // Set path folder tempat menyimpan fotonya
	    $path = "templates/img/pekerjaan_alumni/".$fotobaru;

    	if (in_array($ekstensi, $extensionList))
	    {
	        // memindahkan file ke temporary
	        $tmp = $_FILES['gambar']['tmp_name'];
	       
	        // Proses upload
	        if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
	        // Proses simpan ke Database
	        $this->m_pekerjaan_alumni->simpan_pekerjaan_alumni($nama_pekerjaan_alumni,$tempat_kerja,$tgl_terima,$alamat_kerja,$jabatan,$motivasi,$id_siswa,$fotobaru);
	        date_default_timezone_set('Asia/Jakarta');
  			$this->m_pekerjaan_alumni->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Tambah data pekerjaan alumni');
	        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil ditambahkan!
						</div>');
			redirect('admin/pekerjaan_alumni');  
	        }else{
		        // Jika gambar gagal diupload, Lakukan :
		        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, Gambar gagal untuk diupload!
						</div>');
		        redirect('admin/pekerjaan_alumni');
	      	}
	    }
	    else{
	    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, file yang diupload bukan file image!
						</div>');
	    	redirect('admin/pekerjaan_alumni');
	    }
	}

	function edit_pekerjaan_alumni(){
		$id_pekerjaan_alumni=$this->input->post('id_pekerjaan_alumni');
		$nama_pekerjaan_alumni=$this->input->post('nama_pekerjaan_alumni');
		$tempat_kerja=$this->input->post('tempat_kerja');
		$tgl_terima=$this->input->post('tgl_terima');
		$alamat_kerja=$this->input->post('alamat_kerja');
		$jabatan=$this->input->post('jabatan');
		$motivasi=$this->input->post('motivasi');
		$id_siswa=$this->input->post('id_siswa');

		$extensionList = array("png", "jpg", "jpeg");
		$fotolama=$this->input->post('fotolama');
		$foto = $_FILES['gambar']['name'];

		  // Cek apakah user ingin mengubah fotonya atau tidak
		  if(empty($foto)){ // Jika user tidak memilih file foto pada form
		    // Lakukan proses update tanpa mengubah fotonya
		    // Proses ubah data ke Database
		    $this->m_pekerjaan_alumni->edit_pekerjaan_alumni_nophoto($id_pekerjaan_alumni,$nama_pekerjaan_alumni,$tempat_kerja,$tgl_terima,$alamat_kerja,$jabatan,$motivasi,$id_siswa);
		    date_default_timezone_set('Asia/Jakarta');
  			$this->m_pekerjaan_alumni->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data pekerjaan alumni');
		    $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
			redirect('admin/pekerjaan_alumni');

		  }else{ // Jika user memilih foto / mengisi input file foto pada form

		  	$pecah = explode(".", $foto);
		    $ekstensi = $pecah[1];
		    $tmp = $_FILES['gambar']['tmp_name'];
		    // Lakukan proses update termasuk mengganti foto sebelumnya
		    if (in_array($ekstensi, $extensionList)){
		    
		      // Rename nama fotonya dengan menambahkan tanggal dan jam upload
		      $fotobaru = date('dmYHis').$foto;
		      // Set path folder tempat menyimpan fotonya
		      $path = "templates/img/pekerjaan_alumni/".$fotobaru;
		      // Proses upload
		      if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		        // Cek apakah file foto sebelumnya ada di folder images
		        if(is_file("templates/img/pekerjaan_alumni/".$fotolama)){// Jika foto ada
		        	unlink("templates/img/pekerjaan_alumni/".$fotolama); // Hapus file foto sebelumnya yang ada di folder
		        } 
		          	
		        // Proses ubah data ke Database
		        $this->m_pekerjaan_alumni->edit_pekerjaan_alumni($id_pekerjaan_alumni,$nama_pekerjaan_alumni,$tempat_kerja,$tgl_terima,$alamat_kerja,$jabatan,$motivasi,$id_siswa,$fotobaru);
		        date_default_timezone_set('Asia/Jakarta');
  				$this->m_pekerjaan_alumni->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data pekerjaan alumni');
		        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
				redirect('admin/pekerjaan_alumni');

		      }else{
		        // Jika gambar gagal diupload, Lakukan :
		        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, gambar gagal di upload!
						</div>');
	    		redirect('admin/pekerjaan_alumni');
		      }
		    }
		    else{
		    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, file yang diupload bukan file image!
						</div>');
	    		redirect('admin/pekerjaan_alumni');
		    }
		}
	}

	function hapus_pekerjaan_alumni(){
		$id_pekerjaan_alumni=$this->input->post('id_pekerjaan_alumni');
		$fotolama=$this->input->post('fotolama');
		if(is_file("templates/img/pekerjaan_alumni/".$fotolama)){// Jika foto ada
        	unlink("templates/img/pekerjaan_alumni/".$fotolama); // Hapus file foto sebelumnya yang ada di folder
        }
        
		$this->m_pekerjaan_alumni->hapus_pekerjaan_alumni($id_pekerjaan_alumni);
		date_default_timezone_set('Asia/Jakarta');
		$this->m_pekerjaan_alumni->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Hapus data pekerjaan alumni');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil dihapus!
			</div>');
		redirect('admin/pekerjaan_alumni');
	}
}
