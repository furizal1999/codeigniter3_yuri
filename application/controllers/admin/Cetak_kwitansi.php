<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cetak_kwitansi extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('cetak_pdf');
        // $this->load->library('fungsi');
        // $this->load->library('kwtconfig');
        $this->load->model('m_cetak_kwitansi');
        // session_start();
    }

    
    function index()
    {
        // echo ucwords(terbilang(1250000))." Rupiah";
        $pt='YURI COMPUTER';
        $jl='Jl. Sawah no. 5 RT.2 RW. 9 Gelugur, ROHUL-RIAU';
        $tel='+628 2381131074';
        $id_pembayaran =$this->input->post('id_pembayaran') ;
        $cash= $this->input->post('jumlah_bayar') ;
        $pembayar= $this->input->post('nama_pembayar') ;
        $id_admin=$this->input->post('id_admin') ;
        $row = $this->m_cetak_kwitansi->nama_admin($id_admin);


        if(isset($row)){
            // $id = $row->id_admin;
            // $username = $row->username;
            // $password_encripsi = $row->password;
            $nama_admin = $row->nama;
            // $no_hp = $row->no_hp;
            // $jk = $row->jk;
            // $foto = $row->foto;
        }else{
            $nama_admin = $_SESSION['nama'];
        }
        $id_siswa=$this->input->post('id_siswa') ;
        $row_siswa = $this->m_cetak_kwitansi->nama_siswa($id_siswa);
        if(isset($row_siswa)){
            // $id = $row->id_admin;
            // $username = $row->username;
            // $password_encripsi = $row->password;
            $nama_siswa = $row_siswa->nama_siswa;
            // $no_hp = $row->no_hp;
            // $jk = $row->jk;
            // $foto = $row->foto;
        }
        $tanggal=$this->input->post('tgl_pembayaran') ;
        date_default_timezone_set('Asia/Jakarta');
        // $tanggal = date('d/m/Y');
        // echo substr($tanggal, 5,2); die();
        if(substr($tanggal, 3,2)=='01'){
            $tanggal = substr($tanggal, 8).' Januari '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='02'){
            $tanggal = substr($tanggal, 8).' Februari '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='03'){
            $tanggal = substr($tanggal, 8).' Maret '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='04'){
            $tanggal = substr($tanggal, 8).' April '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='05'){
            $tanggal = substr($tanggal, 8).' Mei '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='06'){
            $tanggal = substr($tanggal, 8).' Juni '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='07'){
            $tanggal = substr($tanggal, 8).' Juli '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='08'){
            $tanggal = substr($tanggal, 8).' Agustus '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='09'){
            $tanggal = substr($tanggal, 8).' September '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='10'){
            $tanggal = substr($tanggal, 8).' Oktober '.substr($tanggal,0,4);
        }
        else if(substr($tanggal, 3,2)=='11'){
            $tanggal = substr($tanggal, 8).' November '.substr($tanggal,0,4);
        }
        else{
            $tanggal = substr($tanggal, 8).' Desember '.substr($tanggal,0,4);
        }

        $payment='Tagihan Pembayaran Kursus Yuri Komputer ';
        $notevalid='validasi pembayaran dianggap sah bila disertai tanda tangan dan stempel';
        $pdf = new FPDF('L', 'mm','A5');

        $pdf->setMargins(5,5,5);
        $pdf->AddPage();
        $pdf->SetLineWidth(0.6);


        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,7,$pt,0,1,'L');
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(0,7,$jl,0,1,'L');
        $pdf->Cell(120,7,$tel,0,0,'L');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(28,7,'No. ID Pembayaran : '.$id_pembayaran,0,0,'L');
        $pdf->SetFont('Courier','',12);
        $pdf->Cell(0,7,'',0,1,'L');
        $pdf->SetFillColor(95, 95, 95);
        $pdf->Rect(5, 28, 198, 3, 'FD');

        $pdf->Ln(10);
        $pdf->Cell(20);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(40,8,'Terima Dari  : ',0,0,'R');
        $pdf->SetFont('Courier','',14);
        $pdf->Cell(16,8,$pembayar,0,1,'L');
        $pdf->SetFont('Arial','B',14);

        $pdf->Cell(20);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(40,8,'ID / Nama Siswa  : ',0,0,'R');
        $pdf->SetFont('Courier','',14);
        $pdf->Cell(16,8,$id_siswa.' / '.$nama_siswa,0,1,'L');
        $pdf->SetFont('Arial','B',14);

        $pdf->Cell(20);
        $pdf->Cell(40,8,'Uang Sejumlah  : ',0,0,'R');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Courier','B',16);
        $pdf->MultiCell(120,8,'Rp. '.$cash,0,'L');
        $pdf->SetFont('Arial','B',14);
        $pdf->SetY(-90);
        $pdf->Cell(20);
        $pdf->Cell(40,12,'Untuk Pembayaran  : ',0,0,'R');
        $pdf->SetFont('Courier','',12);
        $pdf->MultiCell(120,12,$payment,0,'L');
        $pdf->SetY(-65);
        $pdf->SetFont('Courier','B','16');
        $pdf->Cell(60,12,'Rp. '.$cash,1,0,'C');




        $pdf->SetY(-60);
        $pdf->SetFont('Courier','',12);
        $pdf->Cell(110);
        $pdf->Cell(0,10,'Kota Tengah, '.$tanggal,0,1,'C');

        $pdf->Ln(3);
        $pdf->Cell(110);
        $pdf->SetFont('Courier','B',12);
        $pdf->Cell(0,25,$nama_admin,0,1,'C');
        // $pdf->Ln(1);
        $pdf->Cell(75);
        $pdf->SetFont('Arial','I',10);
        $pdf->Cell(0,1,$notevalid,0,0,'L');
        // $pdf->SetAuthor('http://www.ayayank.com',true);
        date_default_timezone_set('Asia/Jakarta');
        $this->m_cetak_kwitansi->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Cetak kwitansi');
        $pdf->Output();
        
    }
}