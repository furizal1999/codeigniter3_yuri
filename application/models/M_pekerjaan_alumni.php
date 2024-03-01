<?php
class M_pekerjaan_alumni extends CI_Model{
	
	function show_pekerjaan_alumni(){
		$hasil=$this->db->query("SELECT * FROM tb_pekerjaan_alumni ORDER BY id_pekerjaan_alumni");
		return $hasil;
	}

	function combobox_id_siswa(){
		$hasil=$this->db->query("SELECT id_siswa, nama_siswa from tb_siswa WHERE alumni ='Ya'");
		return $hasil;
	}

	function simpan_pekerjaan_alumni($nama_pekerjaan_alumni,$tempat_kerja,$tgl_terima,$alamat_kerja,$jabatan,$motivasi,$id_siswa,$foto){
		$hasil=$this->db->query("INSERT INTO tb_pekerjaan_alumni (nama_pekerjaan_alumni,tempat_kerja,tgl_terima,alamat_kerja,jabatan,motivasi,id_siswa,foto) VALUES ('$nama_pekerjaan_alumni','$tempat_kerja','$tgl_terima','$alamat_kerja','$jabatan','$motivasi',$id_siswa,'$foto')");
		return $hasil;
	}

	function edit_pekerjaan_alumni_nophoto($id_pekerjaan_alumni,$nama_pekerjaan_alumni,$tempat_kerja,$tgl_terima,$alamat_kerja,$jabatan,$motivasi,$id_siswa){
		$hasil=$this->db->query("UPDATE tb_pekerjaan_alumni SET nama_pekerjaan_alumni='$nama_pekerjaan_alumni',tempat_kerja='$tempat_kerja', tgl_terima='$tgl_terima', alamat_kerja='$alamat_kerja', jabatan='$jabatan', motivasi='$motivasi',id_siswa='$id_siswa' WHERE id_pekerjaan_alumni='$id_pekerjaan_alumni'");
		return $hasil;
	}

	function edit_pekerjaan_alumni($id_pekerjaan_alumni,$nama_pekerjaan_alumni,$tempat_kerja,$tgl_terima,$alamat_kerja,$jabatan,$motivasi,$id_siswa,$foto){
		$hasil=$this->db->query("UPDATE tb_pekerjaan_alumni SET nama_pekerjaan_alumni='$nama_pekerjaan_alumni',tempat_kerja='$tempat_kerja', tgl_terima='$tgl_terima', alamat_kerja='$alamat_kerja', jabatan='$jabatan', motivasi='$motivasi',id_siswa='$id_siswa', foto='$foto' WHERE id_pekerjaan_alumni='$id_pekerjaan_alumni'");
		return $hasil;
	}

	function hapus_pekerjaan_alumni($id_pekerjaan_alumni){
		$hasil=$this->db->query("DELETE FROM tb_pekerjaan_alumni WHERE id_pekerjaan_alumni='$id_pekerjaan_alumni'");
		return $hasil;
	}

	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
	
}