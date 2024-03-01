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

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
	
}