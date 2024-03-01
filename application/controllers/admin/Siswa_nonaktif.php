
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class siswa_nonaktif extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download'));
		$this->load->model('m_siswa_nonaktif');
	}
	
	function index(){
		// $this->load->library('pagination');

		// $config['base_url'] = 'http://localhost/yuri/admin/siswa_nonaktif/index';
		// $config['total_rows'] = $this->m_siswa_nonaktif->jumlahdata();
		// $config['per_page'] = 5;
		// $this->pagination->initialize($config);

		// echo $this->pagination->create_links();

		$x['data']=$this->m_siswa_nonaktif->show_siswa_nonaktif();
		$x['combobox']=$this->m_siswa_nonaktif->combobox_id_program();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_siswa_nonaktif',$x);
		$this->load->view('all/footer');
	}

	
		
	function combobox_id_program(){
		redirect('admin/siswa_nonaktif');

	}

	
	function edit_siswa_nonaktif(){
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
		$x=$this->m_siswa_nonaktif->combobox_id_program();

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
		    $this->m_siswa_nonaktif->edit_siswa_nonaktif_nophoto($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$alumni,$tgl_selesai,$sertifikat);
		    date_default_timezone_set('Asia/Jakarta');
			$this->m_siswa_nonaktif->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data siswa');
		    $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
			redirect('admin/siswa_nonaktif');

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
		        $this->m_siswa_nonaktif->edit_siswa_nonaktif($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$alumni,$tgl_selesai,$sertifikat,$fotobaru);
		        date_default_timezone_set('Asia/Jakarta');
				$this->m_siswa_nonaktif->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Edit data siswa');
		        $this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Data berhasil diedit!
						</div>');
				redirect('admin/siswa_nonaktif');

		      }else{
		        // Jika gambar gagal diupload, Lakukan :
		        $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, gambar gagal di upload!
						</div>');
		        redirect('admin/siswa_nonaktif');
		      }
		    }
		    else{
		    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Maaf, file yang diupload bukan file image!
						</div>');
		        redirect('admin/siswa_nonaktif');
		    }
		}
	}

	function hapus_siswa_nonaktif(){
		$id_siswa=$this->input->post('id_siswa');

		$this->m_siswa_nonaktif->hapus_siswa_nonaktif($id_siswa);
		date_default_timezone_set('Asia/Jakarta');
			$this->m_siswa_nonaktif->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Aktifkan data siswa');
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Data berhasil di-aktifkan!
			</div>');
		redirect('admin/siswa_nonaktif');
	}

	function lakukan_download(){

		$foto=$this->input->post('foto');	
		date_default_timezone_set('Asia/Jakarta');
		$this->m_siswa_nonaktif->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Download foto siswa');
		force_download('templates/img/siswa/'.$foto,NULL);
	}
}