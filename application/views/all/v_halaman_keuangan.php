<?php

	if((isset($_SESSION['login']) && strcmp($_SESSION["status"], 'siswa')!==0 )||(!isset($_SESSION['login']))){

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
        <?php $tagihan = $this->session->userdata('tagihan'); ?>
                  <form class="" method="post" action="<?php echo base_url('user/cetak_halaman_keuangan') ?>" target='_BLANK'>
                            <input type="hidden" name="tagihan" value="<?php echo $tagihan; ?>">
                            <button type="submit" name="print" class="btn btn-info  text-white ">
                              <i class="fa fa-print"></i> Print Informasi Keuangan
                            </button>
                            
                          </form>
        <div class="card o-hidden border-0 shadow-lg my-2">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h2 text-gray-900 mb-4">Halaman Keuangan</h1>
                  </div>
                  <h4>TOTAL TAGIHAN</h4>
                  
                  <table class="table">
                  	<tr>
                  		<td width="200px">TOTAL</td>
                  		<th><?php echo 'Rp. '.$tagihan ?></th>
                  	</tr>
                  </table>
                  <hr>
                  <br>
                  <hr>
                  <h4>HISTORI PEMBAYARAN</h4>
                  <table class="table">
                  	<tr class="text-center">
                  		<th width="50px">No</th>
                  		<th width="100px">ID Bayar</th>
                  		<th width="200px">Nama Penyetor</th>
                  		<th width="200px">Tanggal Bayar</th>
                  		<th width="200px">Jumlah Bayar</th>
                  	</tr>
                  	<?php 
							$no=1;
							$total=0;
							foreach($data->result_array() as $i):
								$id_pembayaran=$i['id_pembayaran'];
								$id_siswa=$i['id_siswa'];
								$id_admin=$i['id_admin'];
								$nama_pembayar=$i['nama_pembayar'];
								$tgl_pembayaran=$i['tgl_pembayaran'];
								$jumlah_bayar=$i['jumlah_bayar'];
								$total = $total+$jumlah_bayar
							
								
						?>
					<tr>
						<td><?php echo $no++ ?></td>
                  		<td><?php echo $id_pembayaran ?></td>
                  		<td><?php echo $nama_pembayar ?></td>
                  		<td><?php echo $tgl_pembayaran ?></td>
                  		<td><?php echo 'Rp. '.$jumlah_bayar ?></td>

                  	</tr>
                  <?php endforeach; ?>
                  <tr>
                  	<td colspan="4">TOTAL</td>
                  	<td><b>Rp. <?php echo $total ?></b></td>
                  </tr>
                  	
                  </table>
                  <hr>
                  <br>
                  <hr>
                  <h4>SISA TAGIHAN</h4>
                  <table class="table">
                  	
                  	<tr>
                  		<td width="200px">TOTAL SISA</td>
                  		<th><?php echo 'Rp. '.($tagihan-$total) ?></th>
                  	</tr>
                  </table>
                  <hr>

                  
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