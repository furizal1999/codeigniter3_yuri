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
<body class="text-xs">
<div class="content-wrapper">
    <div class="container">
    	<!-- Content Header (Page header) -->
	    <div class="content-header">
	      	<div class="container-fluid">
		        <div class="row mb-2">
		          	<div class="col-sm-6">
		            	<h1 class="m-0 text-dark">Daftar Siswa Non-aktif</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">Siswa Non-aktif</a></li>
			              	<li class="breadcrumb-item active">Daftar Siswa Non-aktif</li>
			            </ol>
		           	</div><!-- /.col -->
		           	<div class="container">
						
		           
		        	</div>
	      		</div>
	      		<hr>
	      		<?php echo $this->session->flashdata('messege'); ?>
	      		</div>
	      		<br>
				<table class="table table-bordered table-striped" id="mydata" cellspacing="0" cellpadding="3" width="100%" style="width: 0px">
					<thead>
						<tr>
							<td align="center"><b>ID SISWA</b></td>
							<td align="center"><b>NAMA SISWA</b></td>
			                <td align="center"><b>ID PROGRAM</b></td>
			                <td align="center"><b>DOWNLOAD FOTO</b></td>
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
			                    $status_akun=$i['status_akun'];
						?>
						<tr>
							<td><?php echo $id_siswa;?></td>
							<td><?php echo $nama_siswa;?></td>
			                <td><?php echo $id_program;?></td>
			                <td class="text-center">
			                	<?php if(!empty($foto)){ ?>
			                	<form action="<?php echo base_url().'admin/siswa_nonaktif/lakukan_download';?>" method="post">
								<input type="hidden" name="foto" value="<?php echo $foto;?>" />
								<i class="fa fa-download text-primary"></i> <input class="btn btn-primary btn-xs" type="submit" name="kirim_foto" value="DOWNLOAD FOTO" />
								</form>
							<?php }else{
								echo "Belum tersedia!";
							} ?>
			                </td>
			                
			                <td style="width: 240px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_siswa;?>"><i class="fa fa-pen"></i> Edit</a>
			                   	<a class="btn btn-xs btn-success text-white" data-toggle="modal" data-target="#modal_hapus<?php echo $id_siswa;?>"></i> Aktifkan Akun</a>
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
	                    $status_akun=$i['status_akun'];
			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit Siswa</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/siswa_nonaktif/edit_siswa_nonaktif'?>" enctype="multipart/form-data">
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
			                        <label class="control-label col-xs-3" >Jenis Kelamin</label>
			                        <div class="col-xs-8">
			                            <input type="radio" name="jk" value="Laki-laki" <?php if($jk=="Laki-laki"){echo "checked";} ?>> Laki-laki <br>
										<input type="radio" name="jk" value="Perempuan" <?php if($jk=="Perempuan"){echo "checked";} ?>> Perempuan
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
			                        <label class="control-label col-xs-3" >Sudah Alumni?</label>
			                        <select name="alumni" class="form-control">
										<option value="Data belum dipilih" <?php if($alumni=='Data belum dipilih'){echo 'selected';} ?> >--Pilih--</option>
										<option  value="Ya" 
											<?php if($alumni=='Ya'){echo 'selected';} ?> >
											Ya
										</option>
										<option  value="Tidak" 
											<?php if($alumni=='Tidak'){echo 'selected';} ?> >
											Tidak
										</option>
									</select>
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
	                    $status_akun=$i['status_akun'];
			        ?>
			     <!-- ============ MODAL HAPUS SISWA =============== -->
			        <div class="modal fade" id="modal_hapus<?php echo $id_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Aktifkan Siswa</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/siswa_nonaktif/hapus_siswa_nonaktif'?>">
			                <div class="modal-body">
			                    <p>Aktifkan akun <b><?php echo $nama_siswa;?></b></p>
			                </div>
			                <div class="modal-footer">
			                    <input type="hidden" name="id_siswa" value="<?php echo $id_siswa;?>">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-success">Aktifkan sekarang</button>
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
	                    $status_akun=$i['status_akun'];
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian Siswa</h3>
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
			            			<td><?php echo 'Rp. '.$tagihan ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Jumlah sudah dibayar</td>
			            			<td>:</td>
			            			<td>
			            				<?php $sudah_dibayar= $this->m_siswa_nonaktif->totaltagihan($id_siswa);
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
			            			<td>Status Akun</td>
			            			<td>:</td>
			            			<td>
			            				<?php if($status_akun=='aktif'){ ?> 
			            					<i class="text-primary">Aktif</i>
			            				<?php }else{ ?>
			            					<i class="text-danger"><b>Non Aktif</b></i>
			            				<?php } ?>

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