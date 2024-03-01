<?php
class M_bayar extends CI_Model{
	
	function show_bayar(){
		$hasil=$this->db->query("SELECT * FROM tb_pembayaran");
		return $hasil;
	}

	function combobox_id_siswa(){
		$hasil=$this->db->query("SELECT id_siswa, nama_siswa from tb_siswa");
		return $hasil;
	}

	function jumlah_bayar(){
		$hasil=$this->db->query("SELECT count(jumlah_bayar) from tb_pembayaran where id_siswa=''")->num_rows();
		return $hasil;
	}
	
	function simpan_pembayaran($id_siswa,$id_admin,$nama_pembayar,$tgl_pembayaran,$jumlah_bayar){
		$hasil=$this->db->query("INSERT INTO tb_pembayaran (id_siswa,id_admin,nama_pembayar,tgl_pembayaran,jumlah_bayar) VALUES ($id_siswa,$id_admin,'$nama_pembayar','$tgl_pembayaran',$jumlah_bayar)");
		return $hasil;
	}

	function edit_pembayaran($id_pembayaran,$id_siswa,$id_admin,$nama_pembayar,$tgl_pembayaran,$jumlah_bayar){
		$hasil=$this->db->query("UPDATE tb_pembayaran SET id_siswa='$id_siswa', id_admin='$id_admin', nama_pembayar='$nama_pembayar', tgl_pembayaran='$tgl_pembayaran', jumlah_bayar='$jumlah_bayar' WHERE id_pembayaran='$id_pembayaran'");
		return $hasil;
	}

	function hapus_pembayaran($id_pembayaran){
		$hasil=$this->db->query("DELETE FROM tb_pembayaran WHERE id_pembayaran='$id_pembayaran'");
		return $hasil;
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
	
}