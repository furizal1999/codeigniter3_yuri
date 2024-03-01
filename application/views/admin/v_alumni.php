<?php

	if((isset($_SESSION['login']) && strcmp($_SESSION["status"], 'admin')!==0 )||(!isset($_SESSION['login']))){

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
    	<!-- Content Header (Page header) -->
	    <div class="content-header">
	      	<div class="container-fluid">
		        <div class="row mb-2">
		          	<div class="col-sm-6">
		            	<h1 class="m-0 text-dark">Daftar Alumni</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">Alumni</a></li>
			              	<li class="breadcrumb-item active">Daftar Alumni</li>
			            </ol>
		           	</div><!-- /.col -->
		           	<div class="container">
						
		           
		        	</div>
	      		</div>
	      		<hr>

	      		<br>
	      		<?php echo $this->session->flashdata('messege'); ?>
				<table class="table table-bordered table-striped" id="mydata"  cellspacing="0" cellpadding="0" width="100%" style="width: 0px">
					<thead>
						<tr>
							<td align="center"><b>ID</b></td>
							<td align="center"><b>NAMA ALUMNI</b></td>
			                <td align="center"><b>SISA TAGIHAN</b></td>
			                <td align="center" width="200px"><b>FOTO SISWA</b></td>
			                <td align="center" width="200px"><b>SERTIFIKAT</b></td>
			                <td align="center"><b>AKSI</b></td>
						</tr>
					</thead>
					<tbody>

						<?php 

							foreach($data->result_array() as $i):
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
			                    $tgl_selesai=$i['tgl_selesai'];
			                    $foto=$i['foto'];
			                    $foto_sertifikat=$i['foto_sertifikat'];

			                    $sudah_dibayar= $this->m_alumni->totaltagihan($id_siswa);
						?>
						<tr>
							<td><?php echo $id_siswa;?></td>
							<td><?php echo $nama_siswa;?></td>
			                <td>Rp. <?php echo ($tagihan-$sudah_dibayar);?></td>
			                <td class="text-center">
			                	<?php if(!empty($foto)){ ?>
			                	<form action="<?php echo base_url().'admin/alumni/lakukan_download';?>" method="post">
								<input type="hidden" name="foto" value="<?php echo $foto;?>" />
								<i class="fa fa-download text-primary"></i> <input class="btn btn-primary btn-xs" type="submit" name="kirim_foto" value="Download" />
								</form>
								<?php }else{
									echo "Foto alumni belum tersedia!";
								} ?>
							</td>
							<td class="text-center">
								<?php if(!empty($foto_sertifikat)){ ?>
			                	<form action="<?php echo base_url().'admin/alumni/lakukan_download_sertifikat';?>" method="post">
								<input type="hidden" name="foto" value="<?php echo $foto_sertifikat;?>" />
								<i class="fa fa-download text-primary"></i> <input class="btn btn-primary btn-xs" type="submit" name="kirim_foto" value="Download" />
								</form>
								<?php }else{
									echo "Sertifikat belum tersedia!";
								} ?>
			                </td>
			            		              
			                <td style="width: 140px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_siswa;?>"><i class="fa fa-pen"></i> Edit</a>
			                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_detail<?php echo $id_siswa;?>"><i class="fa fa-book"></i> Rincian</a>
			                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				
			</div>



			    <!-- ============ MODAL EDIT SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
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
	                    $sertifikat=$i['sertifikat'];
	                    $tgl_selesai=$i['tgl_selesai'];
	                    $foto=$i['foto'];
			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit Alumni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/alumni/edit_alumni'?>" enctype="multipart/form-data">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID Siswa/Alumni</label>
			                        <div class="col-xs-8">
			                            <input name="id_siswa" value="<?php echo $id_siswa;?>" class="form-control" type="text" placeholder="Id siswa..." readonly>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Alumni</label>
			                        <div class="col-xs-8">
			                            <input name="nama_siswa" value="<?php echo $nama_siswa;?>" class="form-control" type="text" placeholder="Nama siswa..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tempat Lahir</label>
			                        <div class="col-xs-8">
			                            <input name="tempat_lahir" value="<?php echo $tempat_lahir;?>" class="form-control" type="text" placeholder="Tempat lahir..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tanggal Lahir</label>
			                        <div class="col-xs-8">
			                            <input name="tgl_lahir" value="<?php echo $tgl_lahir;?>" class="form-control" type="date" required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nomor <i>Handphone</i></label>
			                        <div class="col-xs-8">
			                            <input name="no_hp" value="<?php echo $no_hp;?>" class="form-control" type="number" placeholder="Nomor handphone..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Alamat</label>
			                        <div class="col-xs-8">
			                            <textarea name="alamat" class="form-control" placeholder="Alamat..." required><?php echo $alamat;?></textarea>
			                        </div>
			                    </div>
			                    			                    
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Status Sertifikat</label>
			                        <select name="sertifikat" class="form-control">
										<option value="Data belum dipilih" <?php if($sertifikat=='Data belum dipilih'){echo 'selected';} ?> >--Pilih--</option>
										<option  value="Belum selesai" 
											<?php if($sertifikat=='Belum selesai'){echo 'selected';} ?> >
											Belum selesai
										</option>
										<option  value="Belum diambil" 
											<?php if($sertifikat=='Belum diambil'){echo 'selected';} ?> >
											Belum diambil
										</option>
										<option  value="Sudah diambil" 
											<?php if($sertifikat=='Sudah diambil'){echo 'selected';} ?> >
											Sudah diambil
										</option>
									</select>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Foto Siswa <i class="text-danger">(Ekstensi file : jpg / jpeg / png)</i></label>
			                        <div class="col-xs-8">
			                        	<input type="hidden" name="fotolama" value="<?php echo $foto;?>">
			                            <input type="file" name="gambar" class="bg-secondary border-secondary text-white">
			                        </div>
			                    </div>

			                </div>

			                <div class="modal-footer">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-info">Update</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>

			    <?php endforeach;?>
			    <!--END MODAL EDIT SISWA-->

			    <!-- ============ MODAL DETAIL SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
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
	                    $tgl_selesai=$i['tgl_selesai'];
	                    $sertifikat=$i['sertifikat'];
	                    $foto=$i['foto'];
	                    $foto_sertifikat=$i['foto_sertifikat'];
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian Alumni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <div class="modal-container">
			            	<table class="table">
			            		<tr>
			            			<td colspan="3" class="text-center">
					                	<?php if(!empty($foto)){ ?>
					                	<a href="<?php echo base_url()?>templates/img/siswa/<?php echo $foto?>" class="venobox" data-gall="gallery-item">
						                  <img width="80%" src="<?php echo base_url()?>templates/img/siswa/<?php echo $foto?>" alt="" class="img-fluid">
						                </a>
					                	
										<?php }else{
											echo "Foto belum tersedia!";
										} ?>
					                </td>
			            		</tr>
			            		
			            		<tr>
			            			<td>ID Siswa</td>
			            			<td>:</td>
			            			<td> <?php echo $id_siswa ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Nama Siswa</td>
			            			<td>:</td>
			            			<td> <?php echo $nama_siswa ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Tempat Tanggal Lahir</td>
			            			<td>:</td>
			            			<td> <?php echo $tempat_lahir.', '.$tgl_lahir ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Nomor HP</td>
			            			<td>:</td>
			            			<td> <?php echo $no_hp ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Alamat</td>
			            			<td>:</td>
			            			<td> <?php echo $alamat ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Tanggal Masuk</td>
			            			<td>:</td>
			            			<td> <?php echo $tgl_masuk ?> </td>
			            		</tr>
			            		<tr>
			            			<td>ID Program</td>
			            			<td>:</td>
			            			<td><?php echo $id_program ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Tagihan</td>
			            			<td>:</td>
			            			<td>Rp. <?php echo $tagihan ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Jumlah sudah dibayar</td>
			            			<td>:</td>
			            			<td>
			            				<?php $sudah_dibayar= $this->m_alumni->totaltagihan($id_siswa);
			            					if($sudah_dibayar==0){
			            						echo 'Rp. 0';
			            					}else{
			            						echo 'Rp. '.$sudah_dibayar;
			            					}
			            			 	?> </td>
			            		</tr>
			            		<tr>
			            			<td>Sisa Tagihan</td>
			            			<td>:</td>
			            			<td> 
			            				<?php
			            					if(($tagihan-$sudah_dibayar)==0){
			            				?>
			            				<i class="text-success">Lunas</i>
			            				<?php
			            					}
			            					else{
			            						echo 'Rp. '.($tagihan-$sudah_dibayar);
			            					}
			            			 	?> 
			            			</td>
			            		</tr>
			            		<tr>
			            			<td>Tanggal Selesai</td>
			            			<td>:</td>
			            			<td><?php echo $tgl_selesai ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Sertifikat</td>
			            			<td>:</td>
			            			<td> <?php echo $sertifikat ?> </td>
			            		</tr>

			            		<tr>
			            			<td colspan="3" class="text-center">
					                	<?php if(!empty($foto_sertifikat)){ ?>
					                	<h3>SERTIFIKAT</h3>
			            				<a href="<?php echo base_url()?>templates/img/sertifikat/<?php echo $foto_sertifikat?>" class="venobox" data-gall="gallery-item">
						                  <img width="80%" src="<?php echo base_url()?>templates/img/sertifikat/<?php echo $foto_sertifikat?>" alt="" class="img-fluid">
						                </a>
					                	
										<?php }else{
											echo "Sertifikat belum tersedia!";
										} ?>
					                </td>
			            		</tr>
			            		
			            		
			            	</table>
			            </div>
			            <div class="modal-footer">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                </div>
			            </div>
			            </div>
			        </div>

			    <?php endforeach;?>
			    <!--END MODAL DETAIL SISWA-->
	    	</div>
		</div>
    </div>
</div>
</body>
</html>