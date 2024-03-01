<?php
class M_instruktur extends CI_Model{
	
	function show_instruktur(){
		$hasil=$this->db->query("SELECT * FROM tb_instruktur");
		return $hasil;
	}

	function simpan_instruktur($id_instruktur,$nama_instruktur,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$foto){
		$hasil=$this->db->query("INSERT INTO tb_instruktur VALUES ('$id_instruktur','$nama_instruktur','$tempat_lahir','$tgl_lahir','$no_hp','$alamat','$foto')");
		return $hasil;
	}

	function edit_instruktur($id_instruktur,$nama_instruktur,$tempat_lahir,$tgl_lahir,$no_hp,$alamat,$foto){
		$hasil=$this->db->query("UPDATE tb_instruktur SET nama_instruktur='$nama_instruktur', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', no_hp='$no_hp', alamat='$alamat', foto='$foto' WHERE id_instruktur='$id_instruktur'");
		return $hasil;
	}
	function edit_instruktur_nophoto($id_instruktur,$nama_instruktur,$tempat_lahir,$tgl_lahir,$no_hp,$alamat){
		$hasil=$this->db->query("UPDATE tb_instruktur SET nama_instruktur='$nama_instruktur',tempat_lahir='$tempat_lahir',tgl_lahir='$tgl_lahir', no_hp='$no_hp', alamat='$alamat' WHERE id_instruktur='$id_instruktur'");
		return $hasil;
	}

	function hapus_instruktur($id_instruktur){
		$hasil=$this->db->query("DELETE FROM tb_instruktur WHERE id_instruktur='$id_instruktur'");
		return $hasil;
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
	
}