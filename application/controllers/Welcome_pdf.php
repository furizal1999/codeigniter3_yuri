<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_pdf extends CI_Controller
{

    /**
     * Example: DOMPDF
     *
     * Documentation:
     * http://code.google.com/p/dompdf/wiki/Usage
     *
     */
    public function index()
    {
        $this->load->model('m_halaman_keuangan');
        $x['data']=$this->m_halaman_keuangan->show_halaman_keuangan($this->session->userdata('id'));
        // load view yang akan digenerate atau diconvert
        // contoh kita akan membuat pdf dari halaman welcome codeigniter
        $this->load->view('all/v_halaman_keuangan.php',$x);
        // dapatkan output html

        $html = $this->output->get_output();

        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("welcome.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");

    }
}

/* End of file welcome_pdf.php */
/* Location: ./application/controllers/welcome_pdf.php */