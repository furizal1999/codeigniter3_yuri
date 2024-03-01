<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="<?php echo base_url('templates/img/icon/icon.jpeg') ?>">
  <title>Yuri Computer</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>templates/plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>templates/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>templates/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>templates/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>templates/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>templates/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>templates/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>templates/plugins/summernote/summernote-bs4.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'?>">

  <!-- <link href="<?php echo base_url() ?>templates/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="<?php echo base_url() ?>templates/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>templates/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>templates/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>templates/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>templates/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Template Main CSS File -->
  <link href="<?php echo base_url() ?>templates/assets/css/style.css" rel="stylesheet">
</head>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('public/beranda') ?>" class="nav-link">Beranda</a>
      </li>
      <?php if(isset($_SESSION['login']) && $_SESSION['status']=='admin'){ ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('admin/dashboard') ?>" class="nav-link">Dashboard</a>
      </li>
    <?php } ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#contact" class="nav-link">Contact</a>
      </li>
      <?php 
        $hari = date('l');
        if($hari=="Sunday"){
          $hari = "Minggu";
        }
        elseif($hari=="Monday"){
          $hari = "Senin";
        }
        elseif($hari=="Tuesday"){
          $hari = "Selasa";
        }
        elseif($hari=="Wednesday"){
          $hari = "Rabu";
        }
        elseif($hari=="Thursday"){
          $hari = "Kamis";
        }
        elseif($hari=="Friday"){
          $hari = "Jum'at";
        }
        else{
          $hari = "Sabtu";
        }
      ?>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link text-info"><?php echo $hari.", ". date('d-m-Y'); ?></a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link text-info">+62 823 8113 1074</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if(null !== $this->session->userdata('id')){ ?>
      <li class="nav-item">
          <a class="btn btn-danger text-white nav-link" data-toggle="modal" data-target="#modal_keluar<?php echo $_SESSION['id'];?>">
            <p class="nav-icon fas fa-sign-out-alt">
              Keluar
            </p>
          </a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
          <a href="<?php echo base_url().('all/login')?>" class="btn btn-primary text-white nav-link">
            <p class="nav-icon fas fa-sign-in-alt">
              Masuk
            </p>
          </a>
      </li>
    <?php } ?>
    </ul>
  </nav>


 