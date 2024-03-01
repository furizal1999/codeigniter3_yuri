<?php
class M_sertifikat_siswa extends CI_Model{
	
	function show_sertifikat_siswa(){
		$hasil=$this->db->query("SELECT * FROM tb_siswa ORDER BY id_siswa");
		return $hasil;
	}

	function combobox_id_siswa(){
		$hasil=$this->db->query("SELECT id_siswa, nama_siswa,foto_sertifikat from tb_siswa WHERE foto_sertifikat =''");
		return $hasil;
	}

	function simpan_sertifikat_siswa($id_siswa, $fotobaru){
		$hasil=$this->db->query("UPDATE tb_siswa SET  foto_sertifikat ='$fotobaru' WHERE id_siswa='$id_siswa'");
		return $hasil;
	}

	function edit_sertifikat_siswa($id_siswa,$fotobaru){
		$hasil=$this->db->query("UPDATE tb_siswa SET  foto_sertifikat='$fotobaru' WHERE id_siswa='$id_siswa'");
		return $hasil;
	}

	function hapus_sertifikat_siswa($id_siswa){
		$hasil=$this->db->query("UPDATE tb_siswa SET  foto_sertifikat ='' WHERE id_siswa='$id_siswa'");
		return $hasil;
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
	
}