<!DOCTYPE html>
<html>
<head>

    <link href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>" rel="stylesheet">
	<title></title>
</head>
<body>
<div class="content-wrapper">
    <div class="container">
    	<!-- Content Header (Page header) -->
	    <div class="content-header">
	      	<div class="container-fluid">
		        <div class="row mb-2">
		          	<div class="col-sm-6">
		            	<h1 class="m-0 text-dark">Beranda</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item text-primary"><a href="<?php base_url('admin/beranda') ?> ">Yuri Computer</a></li>
			              	<li class="breadcrumb-item active">Beranda</li>
			              	<hr>
			            </ol>
		           	</div><!-- /.col -->
		           	<div class="container">
						
					    

					  <main id="main" class="text-muted">
					  	<hr>

					    <!-- ======= Menu Section ======= -->
					    <section id="menu" class="menu">
					      <div class="container">

					        <div class="section-title">
					          <h2>Daftar Siswa Yuri Computer</h2>
					        </div>

					        <div class="row">
					          <table class="table">
					            <tr>
					              <th>ID Siswa</th>
					              <th>Nama Siswa</th>
					              <th>Tempat Tanggal Lahir</th>
					              <th>Alamat</th>
					            </tr>
					            <?php 
					              $no=1;
					              foreach($data_siswa->result_array() as $i):
					                $id_siswa=$i['id_siswa'];
					                $nama_siswa=$i['nama_siswa'];
					                $tempat_lahir=$i['tempat_lahir'];
					                $tgl_lahir=$i['tgl_lahir'];
					                $no_hp=$i['no_hp'];
					                $alamat=$i['alamat'];
					                $tgl_masuk=$i['tgl_masuk'];
					                $id_program=$i['id_program'];
					                $tagihan=$i['tagihan'];
					                $alumni=$i['alumni']; 
					          ?>
					            <tr>
					              <td><?php echo $id_siswa; ?></td>
					              <td><?php echo $nama_siswa; ?></td>
					              <td><?php echo $tempat_lahir.', '.$tgl_lahir; ?></td>
					              <td><?php echo $alamat; ?></td>
					            </tr>
					          <?php endforeach; ?>
					          </table>
					         

					        </div>
					    </section><!-- End Menu Section -->



						  </main><!-- End #main -->


		        	</div>
	      		</div>
			</div>
		</div>
    </div>
</div>
</body>
</html>