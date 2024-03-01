<?php
class M_cetak_halaman_keuangan extends CI_Model{

	function show_halaman_keuangan($id_siswa){
		$hasil=$this->db->query("SELECT * FROM tb_pembayaran WHERE id_siswa='$id_siswa'");
		return $hasil;
	}
	
	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}


	function data(){
        return $this->db->get('barang')->result();
    }

}