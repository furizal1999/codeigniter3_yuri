<?php
class M_login extends CI_Model{
	
	function show_akun_saya(){
		$hasil=$this->db->query("SELECT * FROM tb_siswa WHERE alumni ='Ya' ORDER BY id_siswa");
		return $hasil;
	}

	function combobox_id_program(){
		$hasil=$this->db->query("SELECT id_program, nama_program, biaya from tb_program");
		return $hasil;
	}

	function ambil($id){
		$query = $this->db->query("SELECT * from tb_admin where id_admin='$id'");
		return $row = $query->row();
	}

	function ambil_user($id){
		$query = $this->db->query("SELECT * from tb_siswa where id_siswa='$id'");
		return $row = $query->row();
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}

}