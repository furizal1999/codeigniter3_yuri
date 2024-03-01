<?php

  if(!isset($_SESSION['login'])){

    redirect('public/beranda');
  }

 ?>
<!DOCTYPE html>
<html>
<head>

    <link href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>" rel="stylesheet">
	<title></title>
</head>
<body>
<div class="content-wrapper">
    <div class="container">
      <br><br>

    <!-- <h1 class="row justify-content-center text-center text-primary my-5">PROFIL SAYA</h1> -->
    <!-- Outer Row -->
    <div class="row justify-content-center">


      <div class="col-lg-10">

        <div class="card o-hidden border-0 shadow-lg my-2">
          <div class="card-body p-0">
            <div class="text-center pt-5">
              <h1 class="h4 text-gray-900 mb-4">PROFIL SAYA</h1>
            </div>
            <hr>
            <!-- Nested Row within Card Body -->
            <div class="row">

              <div class="col-lg-6">
                <div class="pl-5 pt-2">
                  
                  

                  <div class="text-center">
                      
                      <?php
                        if(isset($_SESSION['login']) && strcmp($_SESSION["status"], 'admin')!==0 ){
                        
                            if(!empty($_SESSION['foto'])){ ?>
                                  <a href="<?php echo base_url()?>templates/img/siswa/<?php echo $_SESSION['foto']?>" class="venobox" data-gall="gallery-item">
                                  <img width="90%" class="img-fluid float-right" src="<?php echo base_url()?>templates/img/siswa/<?php echo $_SESSION['foto']?>" alt="" class="img-fluid">
                                </a>
                                
                                <?php }else{
                                  echo "Foto belum tersedia!";
                                } 
                        
                       } else{

                           if(!empty($_SESSION['foto'])){ ?>
                              <a href="<?php echo base_url()?>templates/img/admin/<?php echo $_SESSION['foto']?>" class="venobox" data-gall="gallery-item">
                              <img width="90%" src="<?php echo base_url()?>templates/img/admin/<?php echo $_SESSION['foto']?>" alt="" class="img-fluid">
                              </a>
                              
                              <?php }else{
                                echo "Foto belum tersedia!";
                              }
                        } ?>
                    
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="p-3">                  
                  
                  <div class="">
                    <table  class="">
                      
                      <?php
                        if(isset($_SESSION['login']) && strcmp($_SESSION["status"], 'admin')!==0 ){
                        
                       ?>
                      <tr>
                        <td width="350px">ID Siswa</td>
                        <td width="10px">:</td>
                        <td width="300px"> <?= $_SESSION['id'] ?> </td>
                      </tr>
                      <tr>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <td> <?= $_SESSION['nama'] ?> </td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td> <?= $_SESSION['status'] ?> </td>
                      </tr>
                      <tr>
                        <td>Tempat Tanggal Lahir</td>
                        <td>:</td>
                        <td> <?= $_SESSION['tempat_lahir'].', '.$_SESSION['tgl_lahir'] ?> </td>
                      </tr>
                      <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td> <?= $_SESSION['jk'] ?> </td>
                      </tr>
                      <tr>
                        <td>Nomor HP</td>
                        <td>:</td>
                        <td> <?= $_SESSION['no_hp'] ?> </td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td> <?= $_SESSION['alamat'] ?> </td>
                      </tr>
                      <tr>
                        <td>Tanggal Masuk</td>
                        <td>:</td>
                        <td> <?= $_SESSION['tgl_masuk'] ?> </td>
                      </tr>
                      <tr>
                        <td>ID Program</td>
                        <td>:</td>
                        <td> <?= $_SESSION['id_program'] ?></td>
                      </tr>
                      <tr>
                        <td>Tagihan</td>
                        <td>:</td>
                        <td> <?= $_SESSION['tagihan'] ?></td>
                      </tr>
                      <tr>
                        <td>Sudah Alumni?</td>
                        <td>:</td>
                        <td> <?= $_SESSION['alumni'] ?> </td>
                      </tr>
                      <tr>
                        <td>Tanggal Selesai</td>
                        <td>:</td>
                        <td> <?= $_SESSION['tgl_selesai'] ?> </td>
                      </tr>

                      <tr>
                        <td>Status Sertifikat</td>
                        <td>:</td>
                        <td> <?= $_SESSION['sertifikat'] ?> </td>
                      </tr>
                    <?php } else{
                        ?>

                        <tr>
                        <td width="350px">ID Admin</td>
                        <td width="10px">:</td>
                        <td width="300px"> <?= $_SESSION['id'] ?> </td>
                      </tr>
                      <tr>
                        <td>Nama Admin</td>
                        <td>:</td>
                        <td> <?= $_SESSION['nama'] ?> </td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td> <?= $_SESSION['status'] ?> </td>
                      </tr>
                      <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td> <?= $_SESSION['username'] ?> </td>
                      </tr>
                      <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td> <?= $_SESSION['jk'] ?> </td>
                      </tr>
                      <tr>
                        <td>Nomor HP</td>
                        <td>:</td>
                        <td> <?= $_SESSION['no_hp'] ?> </td>
                      </tr>

                      <?php } ?>
                      
                    </table>
                    
                  </div>
                </div>
              </div>

            </div>
            <div class="pl-5 pb-5 pr-5">
              <?php
                        if(isset($_SESSION['login']) && strcmp($_SESSION["status"], 'admin')==0 ){
                        
                       ?>
                    <br>
                    <hr>
                    <h5>GANTI KATA SANDI</h5>
                    <hr>
                    <?php echo $this->session->flashdata('messege'); ?>
                    
                    <form action="<?php echo base_url('all/akun_saya/ganti_sandi') ?>" method="post">
                      <div class="row">
                        <div class="col-lg-3">
                          <label>Kata Sandi Lama</label>
                          <input type="password" name="sandi_lama" class="form-control" required><br>
                        </div>
                        <div class="col-lg-3">
                          <label>Kata Sandi Baru</label>
                          <input type="password" name="sandi_baru" class="form-control" required><br>
                        </div>
                        <div class="col-lg-4">
                          <label>Konfirmasi Kata Sandi Baru</label>
                          <input type="password" name="sandi_baru_konfirmasi" class="form-control" required>
                        </div>
                        <div class="col-lg-2">
                          <br>
                          <input type="submit" name="ganti_sandi" class="btn btn-success mt-2" value="Ganti Sandi">
                        </div>
                      </div>
                      
                    </form>
                  <?php } ?>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</div>
</body>
</html>




