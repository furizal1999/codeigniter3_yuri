<?php

  if(isset($_SESSION['login'])){

    redirect('public/beranda');
  }

 ?>



<!DOCTYPE html>
<html>
<head>

    
  <title></title>
</head>
<body>
<div class="content-wrapper">
    <div class="container">
<br>
    <h2 class="row justify-content-center text-center text-secondary my-5"><b>SELAMAT DATANG DI YURI COMPUTER</b></h2>
    <!-- Outer Row -->
    <div class="row justify-content-center">


      <div class="col-lg-5">

        <div class="card o-hidden border-0 shadow-lg my-2">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">MASUK</h1>
                  </div>
                  <?php echo $this->session->flashdata('messege'); ?>
                  <form class="user" method="post" action="<?php echo base_url('all/login/user_login') ?>">
                    <div class="form-group">
                      <input type="text" name="id" class="form-control form-control-user" id="exampleInputEmail"  placeholder="Masukkan nomor id..." required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukkan kata sandi..." required>
                    </div>

                    <div class="form-group">
                      <label>Login sebagai :</label> <br>
                      <input type="radio" name="status" value="admin" required> Admin || 
                      <input type="radio" name="status" value="siswa" required> Siswa
                    </div>

                    <button type="submit" name="masuk" value="masuk" class="btn btn-primary btn-user btn-block" >
                      Masuk
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <!-- <a class="small" href="forgot-password.html">Lupa kata sandi?</a> -->
                    <br>
                    <a class="small text-danger" href="<?php echo base_url('public/beranda') ?>">Batal login</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</div>
</body>
</html>