<?php
class M_dashboard extends CI_Model{
	
	// function show_akun_saya(){
	// 	$hasil=$this->db->query("SELECT * FROM tb_siswa WHERE alumni ='Ya' ORDER BY id_siswa");
	// 	return $hasil;
	// }

	function jumlah_siswa_semua(){
		return $this->db->get('tb_siswa')->num_rows();
	}

	function jumlah_siswa_only(){
		$hasil = $this->db->get_where('tb_siswa',array('alumni'=>'Tidak'))->num_rows();
		return $hasil;
	}

	function jumlah_siswa_aktif(){
		// $this->db->select('COUNT(jumlah_bayar) as jumlah');
		$hasil = $this->db->get_where('tb_siswa',array('status_akun'=>'aktif'))->num_rows();
		return $hasil;
	}
	function jumlah_siswa_nonaktif(){
		// $this->db->select('COUNT(jumlah_bayar) as jumlah');
		$hasil = $this->db->get_where('tb_siswa',array('status_akun'=>'non_aktif'))->num_rows();
		return $hasil;
	}

	function jumlah_alumni(){
		// $this->db->select('COUNT(jumlah_bayar) as jumlah');
		$hasil = $this->db->get_where('tb_siswa',array('alumni'=>'Ya'))->num_rows();
		return $hasil;
	}

	function total_pembayaran(){
		$this->db->select('SUM(jumlah_bayar) as jumlah');
		$hasil = $this->db->get('tb_pembayaran')->row()->jumlah;
		return $hasil;
	}

	function total_tagihan(){
		$this->db->select('SUM(tagihan) as jumlah');
		$hasil = $this->db->get('tb_siswa')->row()->jumlah;
		return $hasil;
	}

	function log_aktifitas(){
		return $this->db->query("SELECT * FROM tb_log ORDER BY id_log DESC");
	}
	
}