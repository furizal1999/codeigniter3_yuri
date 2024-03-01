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
		            	<h1 class="m-0 text-dark">Daftar Instruktur</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">Instruktur</a></li>
			              	<li class="breadcrumb-item active">Daftar Instruktur</li>
			            </ol>
		           	</div><!-- /.col -->
		           	<div class="container">
						
		           
		        	</div>
	      		</div>
	      		<hr>
	      		<div>
	      			<?php echo $this->session->flashdata('messege'); ?>
	      			<h1 align="right">
					<div class="pull-right text-white"><a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_new"><i class="fa fa-plus"></i> Tambah Data</a></div>		
				</h1>
	      		</div>
	      		<br>
				<table class="table table-bordered table-striped" id="mydata" cellspacing="0" cellpadding="3" width="100%" style="width: 0px">
					<thead>
						<tr>
							<td align="center"><b>ID INSTRUKTUR</b></td>
							<td align="center"><b>NAMA INSTRUKTUR</b></td>
							<td align="center"><b>DOWNLOAD FOTO</b></td>
			                <td align="center"><b>AKSI</b></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data->result_array() as $i):
								$id_instruktur=$i['id_instruktur'];
								$nama_instruktur=$i['nama_instruktur'];
								$tempat_lahir=$i['tempat_lahir'];
								$tgl_lahir=$i['tgl_lahir'];
								$no_hp=$i['no_hp'];
			                    $alamat=$i['alamat'];
			                    $foto=$i['foto'];

						?>
						<tr>
							<td><?php echo $id_instruktur;?></td>
							<td><?php echo $nama_instruktur;?></td>
							<td class="text-center">
			                	<?php if(!empty($foto)){ ?>
			                	<form action="<?php echo base_url().'admin/instruktur/lakukan_download';?>" method="post">
								<input type="hidden" name="foto" value="<?php echo $foto;?>" />
								<i class="fa fa-download text-primary"></i> <input class="btn btn-primary btn-xs" type="submit" name="kirim_foto" value="DOWNLOAD FOTO" />
								</form>
							<?php }else{
								echo "Belum tersedia!";
							} ?>
			                </td>
			                <td style="width: 220px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_instruktur;?>"><i class="fa fa-pen"></i> Edit</a>
			                    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $id_instruktur;?>"><i class="fa fa-trash"></i> Hapus</a>
			                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_detail<?php echo $id_instruktur;?>"><i class="fa fa-book"></i> Rincian</a>
			                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				
			</div>


			    <!-- ============ MODAL ADD INSTRUKTUR =============== -->
			        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Tambah Instruktur</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/instruktur/simpan_instruktur'?>" enctype="multipart/form-data">
			                <div class="modal-body">
                
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Instruktur</label>
			                        <div class="col-xs-8">
			                            <input name="nama_instruktur" class="form-control" type="text" placeholder="Nama instruktur..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tempat Lahir</label>
			                        <div class="col-xs-8">
			                            <input name="tempat_lahir" class="form-control" type="text" placeholder="Tempat lahir..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tanggal Lahir</label>
			                        <div class="col-xs-8">
			                            <input name="tgl_lahir" class="form-control" type="date" required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nomor <i>Handphone</i></label>
			                        <div class="col-xs-8">
			                            <input name="no_hp" class="form-control" type="number" placeholder="Nomor handphone..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Alamat</label>
			                        <div class="col-xs-8">
			                            <textarea name="alamat" class="form-control" placeholder="Alamat..." required></textarea>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Foto <i class="text-danger">(Ekstensi file : jpg / jpeg / png)</i></label>
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
			    <!--END MODAL ADD INSTRUKTUR-->

			    <!-- ============ MODAL EDIT INSTRUKTUR =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_instruktur=$i['id_instruktur'];
			            $nama_instruktur=$i['nama_instruktur'];
			            $tempat_lahir=$i['tempat_lahir'];
			            $tgl_lahir=$i['tgl_lahir'];
			            $no_hp=$i['no_hp'];
			            $alamat=$i['alamat'];
			            $foto=$i['foto'];

			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_instruktur;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit Instruktur</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/instruktur/edit_instruktur'?>" enctype="multipart/form-data">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID Instruktur</label>
			                        <div class="col-xs-8">
			                            <input name="id_instruktur" value="<?php echo $id_instruktur;?>" class="form-control" type="text" placeholder="Id instruktur..." readonly>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Instruktur</label>
			                        <div class="col-xs-8">
			                            <input name="nama_instruktur" value="<?php echo $nama_instruktur;?>" class="form-control" type="text" placeholder="Nama instruktur..." required>
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
			                        <label class="control-label col-xs-3" >Foto <i class="text-danger">(Ekstensi file : jpg / jpeg / png)</i></label>
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
			    <!--END MODAL EDIT INSTRUKTUR-->

			    <?php 
			        foreach($data->result_array() as $i):
			            $id_instruktur=$i['id_instruktur'];
			            $nama_instruktur=$i['nama_instruktur'];
			            $tempat_lahir=$i['tempat_lahir'];
			            $tgl_lahir=$i['tgl_lahir'];
			            $no_hp=$i['no_hp'];
			            $alamat=$i['alamat'];
			            $foto=$i['foto'];
			        ?>
			     <!-- ============ MODAL HAPUS INSTRUKTUR =============== -->
			        <div class="modal fade" id="modal_hapus<?php echo $id_instruktur;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Hapus Instruktur</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/instruktur/hapus_instruktur'?>">
			                <div class="modal-body">
			                    <p>Anda yakin mau menghapus <b><?php echo $nama_instruktur;?></b></p>
			                </div>
			                <div class="modal-footer">
			                    <input type="hidden" name="id_instruktur" value="<?php echo $id_instruktur;?>">
			                    <input type="hidden" name="foto" value="<?php echo $foto;?>">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-danger">Hapus</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>
			    <?php endforeach;?>
			    <!--END MODAL HAPUS INSTRUKTUR-->
			    <!-- ============ MODAL DETAIL SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_instruktur=$i['id_instruktur'];
			            $nama_instruktur=$i['nama_instruktur'];
			            $tempat_lahir=$i['tempat_lahir'];
			            $tgl_lahir=$i['tgl_lahir'];
			            $no_hp=$i['no_hp'];
			            $alamat=$i['alamat'];
			            $foto=$i['foto'];
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_instruktur;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian Instruktur</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <div class="modal-container">
			            	<table class="table">
			            		<tr>
			            			<td colspan="3" class="text-center">
					                	<?php if(!empty($foto)){ ?>
					                		<a href="<?php echo base_url()?>templates/img/instruktur/<?php echo $foto?>" class="venobox" data-gall="gallery-item">
						                  <img width="80%" src="<?php echo base_url()?>templates/img/instruktur/<?php echo $foto?>" alt="" class="img-fluid">
						                </a>
					                	
										<?php }else{
											echo "Foto belum tersedia!";
										} ?>
					                </td>
			            		</tr>
			            		<tr>
			            			<td>ID Instruktur</td>
			            			<td>:</td>
			            			<td><?php echo $id_instruktur ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Nama Instruktur</td>
			            			<td>:</td>
			            			<td> <?php echo $nama_instruktur ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Tempat/Tgl Lahir</td>
			            			<td>:</td>
			            			<td> <?php echo $tempat_lahir.", ".$tgl_lahir ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Nomor <i>Handphone</i></i></td>
			            			<td>:</td>
			            			<td> <?php echo $no_hp ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Alamat</td>
			            			<td>:</td>
			            			<td> <?php echo $alamat ?> </td>
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