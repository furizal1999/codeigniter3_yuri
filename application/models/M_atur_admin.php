<?php

class M_atur_admin extends CI_Model{
	
	function show_atur_admin(){
		$hasil=$this->db->query("SELECT * FROM tb_admin ORDER BY id_admin");
		return $hasil;
	}

	function show_foto($id_admin){
		$hasil=$this->db->query("SELECT foto FROM tb_admin WHERE id_admin='$id_admin'");
		return $hasil;
	}

	function simpan_atur_admin($username,$password,$nama,$no_hp,$jk,$fotobaru){
		$hasil=$this->db->query("INSERT INTO tb_admin (username,password,nama,no_hp,jk,foto) VALUES ('$username','$password','$nama','$no_hp','$jk','$fotobaru')");
		return $hasil;
	}

	function edit_atur_admin($id_admin,$username,$password,$nama,$no_hp,$jk,$foto){
		$hasil=$this->db->query("UPDATE tb_admin SET username='$username',password='$password', nama='$nama', no_hp='$no_hp', jk='$jk',foto='$foto' WHERE id_admin='$id_admin'");
		return $hasil;
	}

	function edit_atur_admin_nophoto($id_admin,$username,$password,$nama,$no_hp,$jk){
		$hasil=$this->db->query("UPDATE tb_admin SET username='$username',password='$password', nama='$nama', no_hp='$no_hp', jk='$jk' WHERE id_admin='$id_admin'");
		return $hasil;
	}

	function hapus_atur_admin($id_admin){
		$hasil=$this->db->query("DELETE FROM tb_admin WHERE id_admin='$id_admin'");
		return $hasil;
	}

	function ambil_nama_foto($id_admin){
		$hasil=$this->db->query("SELECT foto FROM tb_admin WHERE id_admin='$id_admin'");
		return $hasil;
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
	
}