<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Halaman_keuangan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download'));
		$this->load->model('m_halaman_keuangan');
	}
	
	function index(){
		$x['data']=$this->m_halaman_keuangan->show_halaman_keuangan($this->session->userdata('id'));
		$x['combobox']=$this->m_halaman_keuangan->combobox_id_program();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('all/v_halaman_keuangan',$x);
		$this->load->view('all/footer');
	}
		
	function combobox_id_program(){
		redirect('admin/siswa');

	}

	function simpan_siswa(){
		$tagihan=0;
		$nama_siswa=$this->input->post('nama_siswa');
		$tempat_lahir=$this->input->post('tempat_lahir');
		$tgl_lahir=$this->input->post('tgl_lahir');
		$no_hp=$this->input->post('no_hp');
		$alamat=$this->input->post('alamat');
		$tgl_masuk=date('Y/m/d');
		$id_program=$this->input->post('id_program');
		$alumni=$this->input->post('alumni');
		$sertifikat=$this->input->post('sertifikat');
		$jk=$this->input->post('jk');
		$x=$this->m_siswa->combobox_id_program();

		if($alumni=='Ya'){
			$tgl_selesai = date('Y/m/d');
		}
		else{
			$tgl_selesai = '0000/00/00';
		}

		$f=0;
		foreach($x->result_array() as $i):
			$id_prog[$f]=$i['id_program'];
			$biaya[$f]=$i['biaya'];
			if($id_program==$id_prog[$f]){
				$tagihan = $biaya[$f];
			}
			$f++;
		endforeach;

		$foto = $_FILES['gambar']['name'];

		if(empty($foto)){ // Jika user tidak memilih file foto pada form
			// echo "foto tidak masuk"; die();
		    // Lakukan proses update tanpa mengubah fotonya
		    // Proses ubah data ke Database
		    $this->m_siswa->simpan_siswa_nophoto($nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$tgl_masuk,$id_program,$tagihan,$alumni,$tgl_selesai,$sertifikat);
			redirect('admin/siswa'); 

		}
		else{

			
			//ekstensi foto yang akan diperbolehkan di program
	    	$extensionList = array("png", "jpg", "jpeg");

		    $pecah = explode(".", $foto);
		    $ekstensi = $pecah[1];

		    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
		    $fotobaru = date('dmYHis').$foto;

		    // Set path folder tempat menyimpan fotonya
		    $path = "templates/img/siswa/".$fotobaru;

	    	if (in_array($ekstensi, $extensionList))
		    {
		        // memindahkan file ke temporary
		        $tmp = $_FILES['gambar']['tmp_name'];
		       
		        // Proses upload
		        if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		        // Proses simpan ke Database
		        $this->m_siswa->simpan_siswa($nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$tgl_masuk,$id_program,$tagihan,$alumni,$tgl_selesai,$sertifikat,$fotobaru);
				redirect('admin/siswa');    
		        }else{
			        // Jika gambar gagal diupload, Lakukan :
			        echo '<script>alert("Maaf, Gambar gagal untuk diupload!");</script>';
		      	}
		    }
		    else echo '<script>alert("File yang diupload bukan file image");</script>';
		}
	}

	function edit_siswa(){
		$extensionList = array("png", "jpg", "jpeg");

		$id_siswa=$this->input->post('id_siswa');
		$nama_siswa=$this->input->post('nama_siswa');
		$tempat_lahir=$this->input->post('tempat_lahir');
		$tgl_lahir=$this->input->post('tgl_lahir');
		$jk=$this->input->post('jk');
		$no_hp=$this->input->post('no_hp');
		$alamat=$this->input->post('alamat');
		$sertifikat=$this->input->post('sertifikat');
		$alumni=$this->input->post('alumni');
		$x=$this->m_siswa->combobox_id_program();

		if($alumni=='Ya'){
			$tgl_selesai = date('Y/m/d');
		}
		else{
			$tgl_selesai = '0000/00/00';
		}
		
		$fotolama=$this->input->post('fotolama');
		$foto = $_FILES['gambar']['name'];

		$pecah = explode(".", $foto);
	    $ekstensi = $pecah[1];
	    $tmp = $_FILES['gambar']['tmp_name'];

		  // Cek apakah user ingin mengubah fotonya atau tidak
		  if(empty($foto)){ // Jika user tidak memilih file foto pada form
		    // Lakukan proses update tanpa mengubah fotonya
		    // Proses ubah data ke Database
		    $this->m_siswa->edit_siswa_nophoto($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$alumni,$tgl_selesai,$sertifikat);
			redirect('admin/siswa');

		  }else{ // Jika user memilih foto / mengisi input file foto pada form
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
		        $this->m_siswa->edit_siswa($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$alumni,$tgl_selesai,$sertifikat,$fotobaru);
				redirect('admin/siswa');

		      }else{
		        // Jika gambar gagal diupload, Lakukan :
		        echo '<script>alert("Maaf, gambar gagal di upload!");</script>';
		      }
		    }
		    else{
		      echo '<script>alert("File yang diupload bukan file image");</script>'   ;
		    }
		}
	}

	function hapus_siswa(){
		$id_siswa=$this->input->post('id_siswa');
		$foto=$this->input->post('foto');
		$foto_sertifikat=$this->input->post('foto_sertifikat');
		$this->m_siswa->hapus_siswa($id_siswa);

		if(is_file("templates/img/siswa/".$foto)){// Jika foto ada
        	unlink("templates/img/siswa/".$foto); // Hapus file foto sebelumnya yang ada di folder
        }
		if(is_file("templates/img/sertifikat/".$foto_sertifikat)){// Jika foto ada
        	unlink("templates/img/sertifikat/".$foto_sertifikat); // Hapus file foto sebelumnya yang ada di folder
        }

		redirect('admin/siswa');
	}

	function lakukan_download(){
		$foto=$this->input->post('foto');	
		force_download('templates/img/siswa/'.$foto,NULL);
	}
}