<?php
class M_cetak_kwitansi extends CI_Model{

	function nama_admin($id){
		$query = $this->db->query("SELECT * from tb_admin where id_admin='$id'");
		return $row = $query->row();
	}

	function nama_siswa($id){
		$query = $this->db->query("SELECT * from tb_siswa where id_siswa='$id'");
		return $row = $query->row();
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}

}