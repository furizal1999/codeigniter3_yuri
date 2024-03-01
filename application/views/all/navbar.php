  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('public/beranda') ?>" class="brand-link">
      <img src="<?php echo base_url() ?>templates/img/statis/profil-yuri.jpeg" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span>YURI COMPUTER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <?php if(null !== $this->session->userdata('id')){ ?>
      <!-- Sidebar user panel (optional) -->
      <?php
        if(isset($_SESSION['login']) && strcmp($_SESSION["status"], 'admin')!==0 ){
       ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url() ?>templates/img/siswa/<?php echo $_SESSION['foto']; ?>" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="<?php echo base_url('all/akun_saya') ?>" class="d-block"><?php echo $_SESSION['nama'] ?></a>
        </div>
      </div>
    <?php } else{
        ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url() ?>templates/img/admin/<?php echo $_SESSION['foto']; ?>" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="<?php echo base_url('all/akun_saya') ?>" class="d-block"><?php echo $_SESSION['nama'] ?></a>
        </div>
      </div>
      <?php } ?>
      
    <?php }?>
      
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item active">
            <a href="<?php echo base_url().('public/beranda')?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                  Beranda
              </p>
            </a>
          </li>
        <?php if(isset($_SESSION['login']) && strcmp($_SESSION["status"], 'admin')==0){ ?>
          <li class="nav-item active">
            <a href="<?php echo base_url().('admin/dashboard')?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                  Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="<?php echo base_url().('admin/atur_admin')?>" class="nav-link">
              <i class="nav-icon fa fa-user-cog"></i>
              <p>
                  Atur Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().('admin/bayar')?>" class="nav-link">
              <i class="nav-icon fa fa-money-check-alt"></i>
              <p>
                  Pembayaran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().('admin/instruktur')?>" class="nav-link">
              <i class="nav-icon fas fa-user "></i>
              <p>
                  Instruktur
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().('admin/program')?>" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                  Program Kursus
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-user-graduate text white"></i>
              <p>
                Siswa
                <i class="fas fa-angle-left right"></i>
<!--                 <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url().('admin/siswa')?>" class="nav-link">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>Siswa (Aktif)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().('admin/siswa_nonaktif')?>" class="nav-link">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>Siswa Non-Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().('admin/sertifikat_siswa')?>" class="nav-link">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>Sertifikat Siswa</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-user-graduate text white"></i>
              <p>
                Alumni
                <i class="fas fa-angle-left right"></i>
<!--                 <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url().('admin/alumni')?>" class="nav-link">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>Daftar Alumni</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().('admin/pekerjaan_alumni')?>" class="nav-link">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>Pekerjaan Alumni</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().('admin/pendapat')?>" class="nav-link">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>Testimoni Alumni</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().('admin/galeri')?>" class="nav-link">
              <i class="nav-icon fas fa-images text white"></i>
              <p>
                Galeri
              </p>
            </a>
          </li>
          
        <?php } ?>
        <?php if(isset($_SESSION['login']) && strcmp($_SESSION["status"], 'siswa')==0){ ?>
          <li class="nav-item">
            <a href="<?php echo base_url().('user/halaman_keuangan')?>" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave text white"></i>
              <p>
                Halaman Keuangan
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if(isset($_SESSION['login'])){ ?>
          <li class="nav-item">
            <a href="<?php echo base_url().('all/akun_saya')?>" class="nav-link">
              <i class="nav-icon fas fa-lock text white"></i>
              <p>
                Akun Saya
              </p>
            </a>
          </li>
        <?php } ?>
          <li class="nav-item">
            <?php if(null !== $this->session->userdata('id')){ ?>
              <a class="btn btn-danger text-white nav-link" data-toggle="modal" data-target="#modal_keluar<?php echo $_SESSION['id'];?>">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Keluar
                </p>
              </a>
    <?php }else{ ?>
              <a href="<?php echo base_url().('all/login')?>" class="btn btn-primary text-white nav-link">
                <i class="nav-icon fas fa-sign-in-alt"></i>
                <p>
                  Masuk
                </p>
              </a>
    <?php } ?>
            
          </li>
        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>

  </aside>



  <?php if(isset($_SESSION['login'])){ ?>

    <div class="container">
      <!-- Content Header (Page header) -->
      <!-- <div class="content-header"> -->
          <!-- ============ MODAL Keluar =============== -->
              <div class="modal fade" id="modal_keluar<?php echo $_SESSION['id'];?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Konfirmasi Keluar</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  </div>
                  <form class="form-horizontal" method="post" action="<?php echo base_url().'all/logout'?>">
                      <div class="modal-body">
                          <p>Anda yakin keluar?</b></p>
                      </div>
                      <div class="modal-footer">
                          <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                          <button class="btn btn-danger">Keluar</button>
                      </div>
                  </form>
                  </div>
                  </div>
              </div>
              <!-- end modal -->
  </div>

    <?php } ?>
