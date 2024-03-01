<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cetak_halaman_keuangan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('cetak_pdf');
        $this->load->model('m_cetak_halaman_keuangan');
    }

    function index()
    {
        $tagihan =$this->input->post('tagihan');
        $pdf = new FPDF('P', 'mm','A4');

        $pdf->AddPage();
        
        $pdf->SetFont('Times','B',16);
        $pdf->ln(10);
        $pdf->Cell(0,20,'INFORMASI TAGIHAN SISWA',0,1,'C');
        $pdf->setMargins(30,40,30);
        $pdf->Cell(0,0,'',0,1);
        $pdf->ln(2);

        //Total Tagihan
        $pdf->SetFont('Times','B',14);
        $pdf->Cell(158,6,'TAGIHAN',0,1,'L');
        $pdf->ln(2);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(20,6,'No',1,0,'C');
        $pdf->Cell(103,6,'Uraian',1,0,'C');
        $pdf->Cell(35,6,'Tagihan',1,1,'C');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(20,6,'1',1,0,'C');
        $pdf->Cell(103,6,'Biaya Program Kursus',1,0,'L');
        $pdf->Cell(35,6,'Rp. '.$tagihan,1,1,'C');

        $pdf->SetFont('Times','B',12);
        $pdf->Cell(123,6,'TOTAL',1,0,'C');
        $pdf->Cell(35,6,'Rp. '.$tagihan,1,1,'C');

        $pdf->ln(10);


        //histori pembayaran
        $pdf->SetFont('Times','B',14);
        $pdf->Cell(158,6,'HISTORI PEMBAYARAN',0,1,'L');
        $pdf->ln(2);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(20,6,'No',1,0,'C');
        $pdf->Cell(33,6,'Id Bayar',1,0,'C');
        $pdf->Cell(35,6,'Nama Penyetor',1,0,'C');
        $pdf->Cell(35,6,'Tanggal Setor',1,0,'C');
        $pdf->Cell(35,6,'Jumlah Bayar',1,1,'C');

        $pdf->SetFont('Times','',12);
        $x=$this->m_cetak_halaman_keuangan->show_halaman_keuangan($this->session->userdata('id'));
        $no=1;
        $total=0;
        foreach($x->result_array() as $i):
            $pdf->Cell(20,6,$no++,1,0,'C');
            $pdf->Cell(33,6,$i['id_pembayaran'],1,0,'C');
            $pdf->Cell(35,6,$i['nama_pembayar'],1,0,'C');
            $pdf->Cell(35,6,$i['tgl_pembayaran'],1,0,'C');
            $pdf->Cell(35,6,'Rp. '.$i['jumlah_bayar'],1,1,'C');
            $total = $total+$i['jumlah_bayar'];
        endforeach;

        $pdf->SetFont('Times','B',12);
        $pdf->Cell(123,6,'TOTAL',1,0,'C');
        $pdf->Cell(35,6,'Rp. '.$total,1,1,'C');
        
        $pdf->ln(10);

        //Total Tagihan
        $pdf->SetFont('Times','B',14);
        $pdf->Cell(158,6,'SISA TAGIHAN',0,1,'L');
        $pdf->ln(2);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(20,6,'No',1,0,'C');
        $pdf->Cell(103,6,'Uraian',1,0,'C');
        $pdf->Cell(35,6,'Total',1,1,'C');
        $pdf->SetFont('Times','',12);

        $pdf->Cell(20,6,'1',1,0,'C');
        $pdf->Cell(103,6,'Total Tagihan',1,0,'L');
        $pdf->Cell(35,6,'Rp. '.$tagihan,1,1,'C');

        $pdf->Cell(20,6,'2',1,0,'C');
        $pdf->Cell(103,6,'Total Pembayaran',1,0,'L');
        $pdf->Cell(35,6,'Rp. '.$total,1,1,'C');
        $sisa = $tagihan - $total;
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(123,6,'TOTAL',1,0,'C');
        $pdf->Cell(35,6,'Rp. '.$sisa,1,1,'C');


        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y/m/d');
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

        $pdf->ln(10);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(98,6,'',0,0,'L');
        $pdf->Cell(60,6,'Kota Tengah, '.$tanggal,0,1,'L');
        $pdf->Cell(98,6,'',0,0,'L');
        $pdf->Cell(60,6,'Pimpinan LKP Yuri Computer',0,1,'L');

        if($total>=$tagihan){
            $pdf->SetFont('Times','B',18);
            $pdf->SetTextColor(0,0,255);
            $pdf->ln(10);
            $pdf->Cell(88,6,'',0,0,'L');
            $pdf->Cell(70,6,'LUNAS',0,1,'L');
        } 
        else{
            $pdf->SetFont('Times','B',18);
            $pdf->ln(10);
            $pdf->Cell(88,6,'',0,0,'L');
            $pdf->Cell(70,6,'',0,1,'L');
        }  

        $pdf->ln(10);
        $pdf->SetTextColor(1);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(98,6,'',0,0,'L');
        $pdf->Cell(60,6,'Yurida Wilis, S.Kom',0,1,'C');

        date_default_timezone_set('Asia/Jakarta');
        $this->m_cetak_halaman_keuangan->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Cetak Informasi Keuangan');

        $pdf->Output();
    }
}