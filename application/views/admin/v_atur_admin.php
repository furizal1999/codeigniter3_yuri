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
		            	<h1 class="m-0 text-dark">Daftar Admin</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">Atur Admin</a></li>
			              	<li class="breadcrumb-item active">Daftar Admin</li>
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
							<td align="center"><b>ID ADMIN</b></td>
							<td align="center"><b>USERNAME</b></td>
							<td align="center"><b>NAMA ADMIN</b></td>
							<td align="center"><b>DOWNLOAD FOTO</b></td>
			                <td align="center"><b>AKSI</b></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data->result_array() as $i):
								$id_admin=$i['id_admin'];
								$username=$i['username'];
								$password=$i['password'];
								$nama=$i['nama'];
								$no_hp=$i['no_hp'];
			                    $jk=$i['jk'];
			                    $foto=$i['foto'];
						?>
						<tr>
							<td><?php echo $id_admin;?></td>
							<td><?php echo $username ?></td>
			                <td><?php echo $nama;?></td>
			                <td class="text-center">
			                	<?php if(!empty($foto)){ ?>
			                	<form action="<?php echo base_url().'admin/atur_admin/lakukan_download';?>" method="post">
								<input type="hidden" name="foto" value="<?php echo $foto;?>" />
								<i class="fa fa-download text-primary"></i> <input class="btn btn-primary btn-xs" type="submit" name="kirim_foto" value="DOWNLOAD FOTO" />
								</form>
							<?php }else{
								echo "Belum tersedia!";
							} ?>
			                </td>
			                <td style="width: 220px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_admin;?>"><i class="fa fa-pen"></i> Edit</a>
			                    <?php if($_SESSION['id']!==$id_admin){ ?>
			                    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $id_admin;?>"><i class="fa fa-trash"></i> Hapus</a>
			                <?php } ?>
			                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_detail<?php echo $id_admin;?>"><i class="fa fa-book"></i> Rincian</a>
			                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>


			    <!-- ============ MODAL ADD atur_admin =============== -->
			        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Tambah Admin Baru</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/atur_admin/simpan_atur_admin'?>" enctype="multipart/form-data">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Username</label>
			                        <div class="col-xs-8">
			                            <input name="username" class="form-control" type="text" placeholder="Username..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Password</label>
			                        <div class="col-xs-8">
			                            <input name="password" class="form-control" type="password" placeholder="Password..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Konfirmasi Password</label>
			                        <div class="col-xs-8">
			                            <input name="password2" class="form-control" type="password" placeholder="Password..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama</label>
			                        <div class="col-xs-8">
			                            <input name="nama" class="form-control" type="text" placeholder="Nama..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nomor <i>Handphone</i></label>
			                        <div class="col-xs-8">
			                            <input name="no_hp" class="form-control" type="number" placeholder="No handphone..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Jenis Kelamin</label>
			                        <div class="col-xs-8">
			                            <select name="jk" class="form-control">
											<option value="Data belum dipilih">--Pilih--</option>
											<option value="Laki-laki">Laki-laki</option>
											<option value="Perempuan">Perempuan</option>
										</select>
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
			    <!--END MODAL ADD atur_admin-->

			    <!-- ============ MODAL EDIT atur_admin =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_admin=$i['id_admin'];
						$username=$i['username'];
						$password=$i['password'];
						$nama=$i['nama'];
						$no_hp=$i['no_hp'];
	                    $jk=$i['jk'];
	                    $foto=$i['foto'];
			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_admin;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit atur_admin</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/atur_admin/edit_atur_admin'?>" enctype="multipart/form-data">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID Admin</label>
			                        <div class="col-xs-8">
			                            <input name="id_admin" value="<?php echo $id_admin;?>" class="form-control" type="text" placeholder="Id atur_admin..." readonly>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Username</label>
			                        <div class="col-xs-8">
			                            <input name="username" value="<?php echo $username;?>" class="form-control" type="text" placeholder="Username..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama</label>
			                        <div class="col-xs-8">
			                            <input name="nama" value="<?php echo $nama;?>" class="form-control" type="text" placeholder="Nama..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nomor <i>Handphone</i></label>
			                        <div class="col-xs-8">
			                            <input name="no_hp" value="<?php echo $no_hp;?>" class="form-control" type="number" placeholder="No handphone..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Jenis Kelamin</label>
			                        <div class="col-xs-8">
			                            <select name="jk" class="form-control" >
											<option value="Data belum dipilih">--Pilih--</option>
											<option value="Laki-laki" <?php if($jk=='Laki-laki'){echo 'selected';} ?> >Laki-laki</option>
											<option value="Perempuan" <?php if($jk=='Perempuan'){echo 'selected';} ?> >Perempuan</option>
										</select>
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
			    <!--END MODAL EDIT atur_admin-->

			    <?php 
			        foreach($data->result_array() as $i):
			            $id_admin=$i['id_admin'];
						$username=$i['username'];
						$password=$i['password'];
						$nama=$i['nama'];
						$no_hp=$i['no_hp'];
	                    $jk=$i['jk'];
	                    $foto=$i['foto'];
			        ?>
			     <!-- ============ MODAL HAPUS atur_admin =============== -->
			        <div class="modal fade" id="modal_hapus<?php echo $id_admin;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Hapus atur_admin</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/atur_admin/hapus_atur_admin'?>">
			                <div class="modal-body">
			                    <p>Anda yakin mau menghapus <b><?php echo $nama;?></b></p>
			                </div>
			                <div class="modal-footer">
			                    <input type="hidden" name="id_admin" value="<?php echo $id_admin;?>">
			                    <input type="hidden" name="foto" value="<?php echo $foto;?>">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-danger">Hapus</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>
			    <?php endforeach;?>
			    <!--END MODAL HAPUS atur_admin-->

			    <!-- ============ MODAL DETAIL SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_admin=$i['id_admin'];
						$username=$i['username'];
						$password=$i['password'];
						$nama=$i['nama'];
						$no_hp=$i['no_hp'];
	                    $jk=$i['jk'];
	                    $foto=$i['foto'];
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_admin;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian Admin</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <div class="modal-container">
			            	<table class="table">
			            		<tr>
			            			<td colspan="3" class="text-center">
					                	<?php if(!empty($foto)){ ?>
					                		<a href="<?php echo base_url()?>templates/img/admin/<?php echo $foto?>" class="venobox" data-gall="gallery-item">
						                  <img width="80%" src="<?php echo base_url()?>templates/img/admin/<?php echo $foto?>" alt="" class="img-fluid">
						                </a>
					                	
										<?php }else{
											echo "Foto belum tersedia!";
										} ?>
					                </td>
			            		</tr>
			       
			            		<tr>
			            			<td>ID Admin</td>
			            			<td>:</td>
			            			<td><?php echo $id_admin ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Username</td>
			            			<td>:</td>
			            			<td> <?php echo $username ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Nama Lengkap</i></td>
			            			<td>:</td>
			            			<td> <?php echo $nama ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Nomor <i>Handphone</i></td>
			            			<td>:</td>
			            			<td> <?php echo $no_hp ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Jenis Kelamin</td>
			            			<td>:</td>
			            			<td> <?php echo $jk ?> </td>
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