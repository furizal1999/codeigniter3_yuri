<?php
class M_pendapat extends CI_Model{
	
	function show_pendapat(){
		$hasil=$this->db->query("SELECT * FROM tb_pendapat ORDER BY id_pendapat");
		return $hasil;
	}

	function combobox_id_siswa(){
		$hasil=$this->db->query("SELECT id_siswa, nama_siswa from tb_siswa");
		return $hasil;
	}

	function simpan_pendapat($id_siswa,$pendapat){
		$hasil=$this->db->query("INSERT INTO tb_pendapat (id_siswa,pendapat) VALUES ($id_siswa,'$pendapat')");
		return $hasil;
	}

	function edit_pendapat($id_pendapat,$id_siswa,$pendapat){
		$hasil=$this->db->query("UPDATE tb_pendapat SET id_siswa='$id_siswa',pendapat='$pendapat' WHERE id_pendapat='$id_pendapat'");
		return $hasil;
	}

	function hapus_pendapat($id_pendapat){
		$hasil=$this->db->query("DELETE FROM tb_pendapat WHERE id_pendapat='$id_pendapat'");
		return $hasil;
	}
	
	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
}