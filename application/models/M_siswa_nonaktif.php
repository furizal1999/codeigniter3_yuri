<?php
class M_siswa_nonaktif extends CI_Model{

	function show_siswa_nonaktif(){
		$hasil=$this->db->query("SELECT * FROM tb_siswa where status_akun !='aktif' ");
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

	function edit_siswa_nonaktif($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$alumni,$tgl_selesai,$sertifikat, $fotobaru){
		$hasil=$this->db->query("UPDATE tb_siswa SET nama_siswa='$nama_siswa',tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', jk='$jk', no_hp='$no_hp', alamat='$alamat',alumni='$alumni',tgl_selesai='$tgl_selesai',sertifikat='$sertifikat', foto='$fotobaru' WHERE id_siswa='$id_siswa'");
		return $hasil;
	}

	function edit_siswa_nonaktif_nophoto($id_siswa,$nama_siswa,$tempat_lahir,$tgl_lahir,$jk,$no_hp,$alamat,$alumni,$tgl_selesai,$sertifikat){
		$hasil=$this->db->query("UPDATE tb_siswa SET nama_siswa='$nama_siswa',tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir',jk='$jk', no_hp='$no_hp', alamat='$alamat',alumni='$alumni',tgl_selesai='$tgl_selesai',sertifikat='$sertifikat' WHERE id_siswa='$id_siswa'");
		return $hasil;
	}


	function hapus_siswa_nonaktif($id_siswa){
		$hasil=$this->db->query("UPDATE tb_siswa SET status_akun='aktif' WHERE id_siswa='$id_siswa'");
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