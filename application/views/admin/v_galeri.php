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
		            	<h1 class="m-0 text-dark">Daftar Foto Galeri</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">Foto Galeri</a></li>
			              	<li class="breadcrumb-item active">Daftar Foto Galeri</li>
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
				<table class="table table-bordered table-striped" id="mydata" cellspacing="0" cellpadding="2" width="100%" style="width: 0px">
					<thead>
						<tr>
							<td align="center"><b>ID FOTO</b></td>
							<td align="center"><b>DOWNLOAD FOTO</b></td>
			                <td align="center"><b>AKSI</b></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data->result_array() as $i):
								$id_foto=$i['id_foto'];
                                $foto=$i['foto'];
                                $ket=$i['ket'];
						?>
						<tr>
							<td><?php echo $id_foto;?></td>
							<td class="text-center">
			                	<?php if(!empty($foto)){ ?>
			                	<form action="<?php echo base_url().'admin/galeri/lakukan_download';?>" method="post">
								<input type="hidden" name="foto" value="<?php echo $foto;?>" />
								<i class="fa fa-download text-primary"></i> <input class="btn btn-primary btn-xs" type="submit" name="kirim_foto" value="DOWNLOAD FOTO" />
								</form>
							<?php }else{
								echo "Belum tersedia!";
							} ?>
			                <td style="width: 220px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_foto;?>"><i class="fa fa-pen"></i> Edit</a>
			                    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $id_foto;?>"><i class="fa fa-trash"></i> Hapus</a>
			                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_detail<?php echo $id_foto;?>"><i class="fa fa-book"></i> Rincian</a>
			                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				
			</div>


			    <!-- ============ MODAL ADD galeri =============== -->
			        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Tambah Foto Galeri</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/galeri/simpan_galeri'?>" enctype="multipart/form-data">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Foto <i class="text-danger">(Ekstensi file : jpg / jpeg / png)</i></label>
			                        <div class="col-xs-8">
			                            <input type="file" name="gambar" class="bg-secondary border-secondary text-white" required>
			                        </div>
			                    </div>
			                   
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Keterangan</label>
			                        <div class="col-xs-8">
			                            <textarea name="ket" class="form-control" placeholder="Keterangan..." required></textarea>
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
			    <!--END MODAL ADD galeri-->

			    <!-- ============ MODAL EDIT galeri =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_foto=$i['id_foto'];
                        $foto=$i['foto'];
                        $ket=$i['ket'];
			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_foto;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit Foto Galeri</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/galeri/edit_galeri'?>" enctype="multipart/form-data">
			                <div class="modal-body">
			                	<div class="form-group">
			                        <label class="control-label col-xs-3" >ID Foto</label>
			                        <div class="col-xs-8">
			                            <input name="id_foto" value="<?php echo $id_foto;?>" class="form-control" type="text" placeholder="Nama foto..." readonly>
			                        </div>
			                    </div>
			                	<div class="form-group">
			                        <label class="control-label col-xs-3" >Foto <i class="text-danger">(Ekstensi file : jpg / jpeg / png)</i></label>
			                        <div class="col-xs-8">
			                        	<input type="hidden" name="fotolama" value="<?php echo $foto;?>">
			                            <input type="file" name="gambar" class="bg-secondary border-secondary text-white">
			                        </div>
			                    </div>
			                    
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Keterangan</label>
			                        <div class="col-xs-8">
			                            <textarea name="ket" class="form-control" placeholder="Keterangan..." required><?php echo $ket;?></textarea>
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
			    <!--END MODAL EDIT galeri-->

			    <?php 
			        foreach($data->result_array() as $i):
			            $id_foto=$i['id_foto'];
                        $foto=$i['foto'];
                        $ket=$i['ket'];
			        ?>
			     <!-- ============ MODAL HAPUS galeri =============== -->
			        <div class="modal fade" id="modal_hapus<?php echo $id_foto;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Hapus Foto Galeri</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/galeri/hapus_galeri'?>">
			                <div class="modal-body">
			                    <p>Anda yakin mau menghapus foto dengan id = <b><?php echo $id_foto.' ('.$ket.')?';?></b></p>
			                </div>
			                <div class="modal-footer">
			                    <input type="hidden" name="id_foto" value="<?php echo $id_foto;?>">
			                    <input type="hidden" name="foto" value="<?php echo $foto;?>">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-danger">Hapus</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>
			    <?php endforeach;?>
			    <!--END MODAL HAPUS galeri-->
			    <!-- ============ MODAL DETAIL SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_foto=$i['id_foto'];
                        $foto=$i['foto'];
                        $ket=$i['ket'];
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_foto;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian Foto Galeri</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <div class="modal-container">
			            	<table class="table">
			            		<tr>
			            			<td colspan="3" class="text-center">
					                	<?php if(!empty($foto)){ ?>
					                		<a href="<?php echo base_url()?>templates/img/galeri/<?php echo $foto?>" class="venobox" data-gall="gallery-item">
						                  <img width="80%" src="<?php echo base_url()?>templates/img/galeri/<?php echo $foto?>" alt="" class="img-fluid">
						                </a>
					                	
										<?php }else{
											echo "Foto belum tersedia!";
										} ?>
					                </td>
			            		</tr>
			            		
			            		<tr>
			            			<td>ID Foto</td>
			            			<td>:</td>
			            			<td><?php echo $id_foto ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Keterangan</td>
			            			<td>:</td>
			            			<td> <?php echo $ket ?> </td>
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