<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{

		$this->load->model('m_dashboard');
		$x['jumlah_siswa'] 	   = $this->m_dashboard->jumlah_siswa_semua();
		$x['jumlah_aktif']     = $this->m_dashboard->jumlah_siswa_aktif();
		$x['jumlah_nonaktif']  = $this->m_dashboard->jumlah_siswa_nonaktif();
		$x['jumlah_alumni']    = $this->m_dashboard->jumlah_alumni();
		$x['log_aktifitas']    = $this->m_dashboard->log_aktifitas();
		$x['total_pembayaran'] = $this->m_dashboard->total_pembayaran();
		$x['total_tagihan']    = $this->m_dashboard->total_tagihan();
		$x['jumlah_siswa_only']       = $this->m_dashboard->jumlah_siswa_only();
		$this->load->view('all/header');
		$this->load->view('all/navbar');
		$this->load->view('admin/v_dashboard', $x);
		$this->load->view('all/footer');
	}
}
