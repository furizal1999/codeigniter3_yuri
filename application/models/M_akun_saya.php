<?php
class M_akun_saya extends CI_Model{
	
	function show_akun_saya(){
		$hasil=$this->db->query("SELECT * FROM tb_siswa WHERE alumni ='Ya' ORDER BY id_siswa");
		return $hasil;
	}

	function ambil($id){
		$query = $this->db->query("SELECT * from tb_admin where id_admin='$id'");
		return $row = $query->row();
	}

	function ganti_sandi($id,$sandi_baru){
		return $this->db->query("UPDATE tb_admin SET password='$sandi_baru' where id_admin='$id'");
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}

	
}