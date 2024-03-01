<?php
class M_halaman_keuangan extends CI_Model{
	
	function show_halaman_keuangan($id_siswa){
		$hasil=$this->db->query("SELECT * FROM tb_pembayaran WHERE id_siswa='$id_siswa'");
		return $hasil;
	}

	function show_siswa_pagination($batas, $mulai){
		$hasil=$this->db->get('tb_siswa',$batas,$mulai);
		return $hasil;
	}

	function jumlahdata(){
		$hasil=$this->db->get('tb_siswa')->num_rows();
		return $hasil;
	}

	function combobox_id_program(){
		$hasil=$this->db->query("SELECT id_program, nama_program, biaya from tb_program");
		return $hasil;
	}

	function simpan_siswa($nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$tgl_masuk,$id_program,$tagihan,$alumni,$tgl_selesai,$sertifikat, $fotobaru){
		$hasil=$this->db->query("INSERT INTO tb_siswa (nama_siswa,tempat_lahir,tgl_lahir,jk,no_hp,alamat,tgl_masuk,id_program,tagihan,alumni,tgl_selesai,sertifikat, foto) VALUES ('$nama_siswa','$tempat_lahir','$tgl_lahir','$jk','$no_hp','$alamat','$tgl_masuk',$id_program,$tagihan,'$alumni','$tgl_selesai','$sertifikat','$fotobaru')");
		return $hasil;
	}

	function simpan_siswa_nophoto($nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$tgl_masuk,$id_program,$tagihan,$alumni,$tgl_selesai,$sertifikat){
		$hasil=$this->db->query("INSERT INTO tb_siswa (nama_siswa,tempat_lahir,tgl_lahir,jk,no_hp,alamat,tgl_masuk,id_program,tagihan,alumni,tgl_selesai,sertifikat) VALUES ('$nama_siswa','$tempat_lahir','$tgl_lahir','$jk','$no_hp','$alamat','$tgl_masuk',$id_program,$tagihan,'$alumni','$tgl_selesai','$sertifikat')");
		return $hasil;
	}

	function edit_siswa($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$alumni,$tgl_selesai,$sertifikat, $fotobaru){
		$hasil=$this->db->query("UPDATE tb_siswa SET nama_siswa='$nama_siswa',tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', jk='$jk', no_hp='$no_hp', alamat='$alamat',alumni='$alumni',tgl_selesai='$tgl_selesai',sertifikat='$sertifikat', foto='$fotobaru' WHERE id_siswa='$id_siswa'");
		return $hasil;
	}

	function edit_siswa_nophoto($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$alumni,$tgl_selesai,$sertifikat){
		$hasil=$this->db->query("UPDATE tb_siswa SET nama_siswa='$nama_siswa',tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir',jk='$jk', no_hp='$no_hp', alamat='$alamat',alumni='$alumni',tgl_selesai='$tgl_selesai',sertifikat='$sertifikat' WHERE id_siswa='$id_siswa'");
		return $hasil;
	}

	function hapus_siswa($id_siswa){
		$hasil=$this->db->query("DELETE FROM tb_siswa WHERE id_siswa='$id_siswa'");
		return $hasil;
	}
	
	function input_log($status,$id,$nama,$tanggal,$waktu,$aksi){
		$hasil=$this->db->query("INSERT INTO tb_log VALUES ('','$status',$id,'$nama','$tanggal','$waktu','$aksi')");
		return $hasil;
	}
}