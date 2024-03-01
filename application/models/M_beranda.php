<?php
class M_beranda extends CI_Model{

	function combobox_id_program(){
		$hasil=$this->db->query("SELECT id_program, nama_program, biaya from tb_program");
		return $hasil;
	}
	
	function show_instruktur(){
		$hasil=$this->db->query("SELECT * FROM tb_instruktur");
		return $hasil;
	}
	function show_program(){
		$hasil=$this->db->query("SELECT * FROM tb_program");
		return $hasil;
	}

	function show_pekerjaan_alumni(){
		$hasil=$this->db->query("SELECT * FROM tb_pekerjaan_alumni");
		return $hasil;
	}

	function show_siswa(){
		$hasil=$this->db->query("SELECT * FROM tb_siswa WHERE alumni ='Tidak'");
		return $hasil;
	}

	function show_alumni_sertifikat(){
		$hasil=$this->db->query("SELECT * FROM tb_siswa WHERE sertifikat='Belum diambil' AND alumni ='Ya'");
		return $hasil;
	}

	function show_alumni(){
		$hasil=$this->db->query("SELECT * FROM tb_siswa WHERE alumni ='Ya'");
		return $hasil;
	}

	function show_galeri(){
		$hasil=$this->db->query("SELECT * FROM tb_galeri");
		return $hasil;
	}

	function simpan_daftar($nama,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$id_program){
		$hasil=$this->db->query("INSERT INTO tb_daftar (nama_siswa,tempat_lahir,tgl_lahir,no_hp,alamat,id_program) VALUES ('$nama','$tempat_lahir','$tgl_lahir','$no_hp','$alamat',$id_program)");
		return $hasil;
	}
	
}