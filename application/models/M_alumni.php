<?php
class M_alumni extends CI_Model{
	
	function show_alumni(){
		$hasil=$this->db->query("SELECT * FROM tb_siswa WHERE alumni ='Ya' ORDER BY id_siswa");
		return $hasil;
	}

	function combobox_id_program(){
		$hasil=$this->db->query("SELECT id_program, nama_program, biaya from tb_program");
		return $hasil;
	}

	function edit_alumni($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$sertifikat,$fotobaru){
		$hasil=$this->db->query("UPDATE tb_siswa SET nama_siswa='$nama_siswa',tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', no_hp='$no_hp', alamat='$alamat',sertifikat='$sertifikat', foto='$fotobaru' WHERE id_siswa='$id_siswa'");
		return $hasil;
	}

	function edit_alumni_nophoto($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$sertifikat){
		$hasil=$this->db->query("UPDATE tb_siswa SET nama_siswa='$nama_siswa',tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', no_hp='$no_hp', alamat='$alamat',sertifikat='$sertifikat' WHERE id_siswa='$id_siswa'");
		return $hasil;
	}

	function totaltagihan($id_siswa){
		$this->db->select('SUM(jumlah_bayar) as jumlah');
		$hasil = $this->db->get_where('tb_pembayaran',array('id_siswa'=>$id_siswa))->row()->jumlah;
		return $hasil;
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
	
}