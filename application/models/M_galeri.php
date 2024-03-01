<?php
class M_galeri extends CI_Model{
	
	function show_galeri(){
		$hasil=$this->db->query("SELECT * FROM tb_galeri ORDER BY id_foto");
		return $hasil;
	}

	
	function simpan_galeri($fotobaru,$ket){
		$hasil=$this->db->query("INSERT INTO tb_galeri (foto,ket) VALUES ('$fotobaru','$ket')");
		return $hasil;
	}

	function edit_galeri($id_foto,$fotobaru,$ket){
		$hasil=$this->db->query("UPDATE tb_galeri SET foto='$fotobaru',ket='$ket' WHERE id_foto='$id_foto'");
		return $hasil;
	}

	function edit_galeri_nophoto($id_foto,$ket){
		$hasil=$this->db->query("UPDATE tb_galeri SET ket='$ket' WHERE id_foto='$id_foto'");
		return $hasil;
	}

	function hapus_galeri($id_foto){
		$hasil=$this->db->query("DELETE FROM tb_galeri WHERE id_foto='$id_foto'");
		return $hasil;
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
	
}