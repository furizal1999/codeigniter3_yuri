<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->model('m_login');
  }
  
  function index(){
    date_default_timezone_set('Asia/Jakarta');
    $this->m_login->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Logout dari sistem');

    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();
    
    redirect('all/login');
    exit;
  }
}
