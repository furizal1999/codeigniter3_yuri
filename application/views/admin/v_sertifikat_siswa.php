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
		            	<h1 class="m-0 text-dark">Daftar Sertifikat Siswa</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">Sertifikat Siswa</a></li>
			              	<li class="breadcrumb-item active">Daftar Sertifikat Siswa</li>
			            </ol>
		           	</div><!-- /.col -->
		           	<div class="container">
						
		           
		        	</div>
	      		</div>
	      		<hr>
	      		<div>
	      			<?php echo $this->session->flashdata('messege'); ?>
	      			<h1 align="right">
					<div class="pull-right text-white"><a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_new"><i class="fa fa-plus"></i> Upload Sertifikat</a></div>		
				</h1>
	      		</div>
	      		<br>
				<table class="table table-bordered table-striped" id="mydata" cellspacing="0" cellpadding="3" width="100%" style="width: 0px">
					<thead>
						<tr>
							<td align="center"><b>ID SISWA</b></td>
							<td align="center"><b>NAMA SISWA</b></td>
			                <td align="center"><b>DOWNLOAD SERTIFIKAT</b></td>
			                <td align="center"><b>AKSI</b></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data->result_array() as $i):
								$id_siswa=$i['id_siswa'];
								$nama_siswa=$i['nama_siswa'];
								$foto=$i['foto_sertifikat'];
						?>
						<tr>
							<td><?php echo $id_siswa;?></td>
							<td><?php echo $nama_siswa;?></td>
			                <td class="text-center">
			                	<?php if(!empty($foto)){ ?>
			                	<form action="<?php echo base_url().'admin/sertifikat_siswa/lakukan_download';?>" method="post">
								<input type="hidden" name="foto" value="<?php echo $foto;?>" />
								<i class="fa fa-download text-primary"></i> <input class="btn btn-primary btn-xs" type="submit" name="kirim_foto" value="DOWNLOAD" />
								</form>
							<?php }else{
								echo "Belum tersedia!";
							} ?>
			                </td>
			                <td style="width: 220px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_siswa;?>"><i class="fa fa-pen"></i> Edit</a>
			                    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $id_siswa;?>"><i class="fa fa-trash"></i> Hapus</a>
			                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_detail<?php echo $id_siswa;?>"><i class="fa fa-book"></i> Rincian</a>

			                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				
			</div>

			    <!-- ============ MODAL ADD SERTIFIKAT =============== -->
			        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Upload Sertifikat</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/sertifikat_siswa/simpan_sertifikat_siswa'?>" enctype="multipart/form-data">
			                <div class="modal-body">
			                    
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID dan Nama Siswa</label>
			                        <select name="id_siswa" class="form-control">
										<option value="Data belum dipilih">--Pilih--</option>
										<?php
											foreach($combobox->result_array() as $i):
												$id_sis=$i['id_siswa'];
												$nama=$i['nama_siswa'];
												$foto_sertifikat = $i['foto_sertifikat'];
										?>
										<option value="<?php echo $id_sis ?>" required><?php echo $id_sis.". ".$nama?></option>

										<?php  endforeach;?>
									</select>

			                    </div>
			                    
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Upload Sertifikat  <i class="text-danger">(Ekstensi file : jpg / jpeg / png)</i></label>
			                        <div class="col-xs-8">
			                            <input type="file" name="gambar" class="bg-secondary border-secondary text-white" required>
			                        </div>
			                    </div>

			                </div>

			                <div class="modal-footer">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-info">Simpan</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>
			    <!--END MODAL ADD SISWA-->

			    <!-- ============ MODAL EDIT SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_siswa=$i['id_siswa'];
						$nama_siswa=$i['nama_siswa'];
						$tempat_lahir=$i['tempat_lahir'];
						$tgl_lahir=$i['tgl_lahir'];
						$jk=$i['jk'];
						$no_hp=$i['no_hp'];
	                    $alamat=$i['alamat'];
	                    $tgl_masuk=$i['tgl_masuk'];
	                    $id_program=$i['id_program'];
	                    $tagihan=$i['tagihan'];
	                    $alumni=$i['alumni']; 
	                    $sertifikat=$i['sertifikat'];
	                    $tgl_selesai=$i['tgl_selesai'];
	                    $foto=$i['foto'];
	                    $foto_sertifikat=$i['foto_sertifikat'];
			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit Siswa</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/sertifikat_siswa/edit_sertifikat_siswa'?>" enctype="multipart/form-data">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID Siswa</label>
			                        <div class="col-xs-8">
			                            <input name="id_siswa" value="<?php echo $id_siswa;?>" class="form-control" type="text" placeholder="Id siswa..." readonly>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Siswa</label>
			                        <div class="col-xs-8">
			                            <input name="nama_siswa" value="<?php echo $nama_siswa;?>" class="form-control" type="text" placeholder="Id siswa..." readonly>
			                        </div>
			                    </div>
			                    			                    
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Pilih File Sertifikat <i class="text-danger">(Ekstensi file : jpg / jpeg / png)</i></label>
			                        <div class="col-xs-8">
			                        	<input type="hidden" name="fotolama" value="<?php echo $foto_sertifikat;?>">
			                            <input type="file" name="gambar" class="bg-secondary border-secondary text-white" required>
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

			    <?php 
			        foreach($data->result_array() as $i):
			            $id_siswa=$i['id_siswa'];
						$nama_siswa=$i['nama_siswa'];
						$tempat_lahir=$i['tempat_lahir'];
						$tgl_lahir=$i['tgl_lahir'];
						$jk=$i['jk'];
						$no_hp=$i['no_hp'];
	                    $alamat=$i['alamat'];
	                    $tgl_masuk=$i['tgl_masuk'];
	                    $id_program=$i['id_program'];
	                    $tagihan=$i['tagihan'];
	                    $alumni=$i['alumni']; 
	                    $sertifikat=$i['sertifikat'];
	                    $tgl_selesai=$i['tgl_selesai'];
	                    $foto=$i['foto'];
	                    $foto_sertifikat=$i['foto_sertifikat'];
			        ?>
			     <!-- ============ MODAL HAPUS SISWA =============== -->
			        <div class="modal fade" id="modal_hapus<?php echo $id_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Hapus Siswa</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/sertifikat_siswa/hapus_sertifikat_siswa'?>">
			                <div class="modal-body">
			                    <p>Anda yakin mau menghapus arsip SERTIFIKAT <b><?php echo $nama_siswa;?></b></p>
			                </div>
			                <div class="modal-footer">
			                    <input type="hidden" name="id_siswa" value="<?php echo $id_siswa;?>">
			                    <input type="hidden" name="fotolama" value="<?php echo $foto_sertifikat;?>">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-danger">Hapus</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>
			    <?php endforeach;?>
			    <!--END MODAL HAPUS SISWA-->

			    <!-- ============ MODAL DETAIL SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_siswa=$i['id_siswa'];
						$nama_siswa=$i['nama_siswa'];
						$tempat_lahir=$i['tempat_lahir'];
						$tgl_lahir=$i['tgl_lahir'];
						$jk=$i['jk'];
						$no_hp=$i['no_hp'];
	                    $alamat=$i['alamat'];
	                    $tgl_masuk=$i['tgl_masuk'];
	                    $id_program=$i['id_program'];
	                    $tagihan=$i['tagihan'];
	                    $alumni=$i['alumni'];
	                    $sertifikat=$i['sertifikat'];
	                    $tgl_selesai=$i['tgl_selesai'];
	                    $foto=$i['foto'];
	                    $foto_sertifikat=$i['foto_sertifikat'];
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian</h3>
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
			            			<td>Jenis Kelamin</td>
			            			<td>:</td>
			            			<td> <?php echo $jk ?> </td>
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
			            			<td>Sudah Alumni?</td>
			            			<td>:</td>
			            			<td> <?php echo $alumni ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Tanggal Selesai</td>
			            			<td>:</td>
			            			<td> <?php echo $tgl_selesai ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Status Sertifikat</td>
			            			<td>:</td>
			            			<td> <?php echo $sertifikat ?> </td>
			            		</tr>
			            		<tr>
			            			<td colspan="3" align="center">
			            				
			            			</td>
			            		</tr>
			            		<tr>
			            			<td colspan="3" class="text-center">
					                	<?php if(!empty($foto_sertifikat)){ ?>
					                		<a href="<?php echo base_url()?>templates/img/sertifikat/<?php echo $foto_sertifikat?>" class="venobox" data-gall="gallery-item">
						                  		<img width="80%" src="<?php echo base_url()?>templates/img/sertifikat/<?php echo $foto_sertifikat?>" alt="" class="img-fluid">
						                	</a>
					                	
										<?php }else{
											echo "Foto sertifikat belum tersedia!";
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