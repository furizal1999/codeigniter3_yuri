<?php
class M_program extends CI_Model{
	
	function show_program(){
		$hasil=$this->db->query("SELECT * FROM tb_program");
		return $hasil;
	}

	function simpan_program($nama_program,$materi2,$tempo,$biaya,$ket){
		$hasil=$this->db->query("INSERT INTO tb_program (nama_program,materi,tempo,biaya,ket) VALUES ('$nama_program','$materi2','$tempo',$biaya,'$ket')");
		return $hasil;
	}

	function edit_program($id_program,$nama_program,$materi2,$tempo,$biaya,$ket){
		$hasil=$this->db->query("UPDATE tb_program SET nama_program='$nama_program', materi='$materi2', tempo='$tempo', biaya='$biaya', ket='$ket' WHERE id_program='$id_program'");
		return $hasil;
	}

	function hapus_program($id_program){
		$hasil=$this->db->query("DELETE FROM tb_program WHERE id_program='$id_program'");
		return $hasil;
	}
	
	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
}