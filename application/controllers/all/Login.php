<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->helper(array('url','download'));
    $this->load->model('m_login');
    $this->load->library('session');
  }
  
  function index(){
    $x['data']=$this->m_login->show_akun_saya();
    $x['combobox']=$this->m_login->combobox_id_program();
    $this->load->view('all/header');
    $this->load->view('all/navbar');
    $this->load->view('all/v_login',$x);
    $this->load->view('all/footer');
  }
    

  function user_login(){
    if( null !==$this->input->post('id')){
      $id=$this->input->post('id');
      $password=$this->input->post('password');
      $status = $this->input->post('status');

      if($status=='admin'){

        $row = $this->m_login->ambil($id);

        if(isset($row)){
            $id = $row->id_admin;
            $username = $row->username;
            $password_encripsi = $row->password;
            $nama = $row->nama;
            $no_hp = $row->no_hp;
            $jk = $row->jk;
            $foto = $row->foto;
            if(password_verify($password, $password_encripsi)){
              $_SESSION["login"] = true;
              $_SESSION["status"]= $status;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["password"] = $password;
              $_SESSION["nama"] = $nama;
              $_SESSION["no_hp"] = $no_hp;
              $_SESSION["jk"] = $jk;
              $_SESSION["foto"] = $foto;
              date_default_timezone_set('Asia/Jakarta');
              $this->m_login->input_log($status,$id,$nama,date('Y/m/d'),date("H:i:s"),'Login ke sistem');
              redirect('public/beranda');
              exit;
            }
            else{
              $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Maaf, Password tidak sesuai!
            </div>');
              redirect('all/login');  
            }
            
        }else{
          $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Maaf, id yang anda masukkan salah!
            </div>');
          redirect('all/login');
          
        }
      }
      else{
        $row = $this->m_login->ambil_user($id);

        if(isset($row)){
            $id                = $row->id_siswa;
            $nama              = $row->nama_siswa;
            $tempat_lahir      = $row->tempat_lahir;
            $tgl_lahir         = $row->tgl_lahir;
            $password_db       = substr($tgl_lahir,8).substr($tgl_lahir, 5,2).substr($tgl_lahir, 0,4);
            $jk                = $row->jk;
            $no_hp             = $row->no_hp;
            $alamat            = $row->alamat;
            $tgl_masuk         = $row->tgl_masuk;
            $id_program        = $row->id_program;
            $tagihan           = $row->tagihan;
            $alumni            = $row->alumni;
            $tgl_selesai       = $row->tgl_selesai;
            $sertifikat        = $row->sertifikat;
            $foto              = $row->foto;
            $foto_sertifikat   = $row->foto_sertifikat;
            $status_akun       = $row->status_akun;
            if($status_akun=='aktif'){
              // echo strcmp($password, $password_db);die;
                if(strcmp($password, $password_db)==0){

                  $_SESSION["login"] = true;
                  $_SESSION["status"]= $status;
                  $_SESSION["id"] = $id;
                  $_SESSION["nama"] =$nama;
                  $_SESSION["tempat_lahir"] =$tempat_lahir;
                  $_SESSION["tgl_lahir"] =$tgl_lahir;
                  $_SESSION["password"] =$password_db;
                  $_SESSION["jk"] =$jk;         
                  $_SESSION["no_hp"] =$no_hp;         
                  $_SESSION["alamat"] =$alamat;            
                  $_SESSION["tgl_masuk"] =$tgl_masuk;        
                  $_SESSION["id_program"] =$id_program;        
                  $_SESSION["tagihan"] =$tagihan;          
                  $_SESSION["alumni"] =$alumni;           
                  $_SESSION["tgl_selesai"] =$tgl_selesai;      
                  $_SESSION["sertifikat"] =$sertifikat;       
                  $_SESSION["foto"] =$foto;           
                  $_SESSION["foto_sertifikat"] =$foto_sertifikat;
                  date_default_timezone_set('Asia/Jakarta');
                  $this->m_login->input_log($status,$id,$nama,date('Y/m/d'),date("H:i:s"),'Login ke sistem');
                  redirect('public/beranda');
                  exit;
                }
                else{
                  $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Maaf, password tidak sesuai!
            </div>');
                  redirect('all/login');
                }
            }
            else{
              $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Akun anda talah di non-aktifkan, silahkan hubungi admin!
            </div>');
              redirect('all/login');
            }
            
        }else{
          $this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Maaf, id yang anda masukkan salah!
            </div>');
          redirect('all/login');
         
        }
      }
    }
  }
}
