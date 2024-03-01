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
		            	<h1 class="m-0 text-dark">Daftar Testimoni Alumni</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">Testimoni Alumni</a></li>
			              	<li class="breadcrumb-item active">Daftar Testimoni Alumni</li>
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
							<td align="center"><b>ID TESTIMONI</b></td>
							<td align="center"><b>ID SISWA</b></td>
							<td align="center"><b>TESTIMONI</b></td>
			                <td align="center"><b>AKSI</b></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data->result_array() as $i):
								$id_pendapat=$i['id_pendapat'];
								$id_siswa=$i['id_siswa'];
								$pendapat=$i['pendapat'];

						?>
						<tr>
							<td><?php echo $id_pendapat;?></td>
							<td><?php echo $id_siswa;?></td>
							<td><?php echo $pendapat;?></td>
			                <td style="width: 220px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_pendapat;?>"><i class="fa fa-pen"></i> Edit</a>
			                    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $id_pendapat;?>"><i class="fa fa-trash"></i> Hapus</a>
			                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_detail<?php echo $id_pendapat;?>"><i class="fa fa-book"></i> Rincian</a>
			                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				
			</div>


			    <!-- ============ MODAL ADD pendapat =============== -->
			        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Tambah Testimoni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pendapat/simpan_pendapat'?>">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID Siswa</label>
			                        <select name="id_siswa" class="form-control">
										<option value="Data belum dipilih">--Pilih--</option>
										<?php
											foreach($combobox->result_array() as $i):
												$id_alum=$i['id_siswa'];
										?>
										<option  value="<?php echo $id_alum ?>">
											<?php echo $id_alum?>
										</option>
										<?php endforeach;?>
									</select>
			                    </div>

			                    
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Testimoni</label>
			                        <div class="col-xs-8">
			                            <textarea name="pendapat" class="form-control" placeholder="Testimoni..." required></textarea>
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
			    <!--END MODAL ADD pendapat-->

			    <!-- ============ MODAL EDIT pendapat =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_pendapat=$i['id_pendapat'];
						$id_siswa=$i['id_siswa'];
						$pendapat=$i['pendapat'];

			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_pendapat;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit Testimoni Alumni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pendapat/edit_pendapat'?>">
			                <div class="modal-body">

			                	<div class="form-group">
			                        <label class="control-label col-xs-3" >ID Testimoni</label>
			                        <div class="col-xs-8">
			                            <input name="id_pendapat" value="<?php echo $id_pendapat;?>" class="form-control" type="text" placeholder="Id testimoni..." readonly>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID Alumni</label>
			                        <select name="id_siswa" class="form-control">
										<option value="Data belum dipilih" <?php if($id_siswa=='Data belum dipilih'){echo 'selected';} ?> >--Pilih--</option>
										<?php
											foreach($combobox->result_array() as $i):
												$id_alum=$i['id_siswa'];
										?>
										<option  value="<?php echo $id_alum ?>" 
											<?php if($id_siswa==$id_alum){echo 'selected';} ?> >
											<?php echo $id_alum?>
												
										</option>
										<?php endforeach;?>
									</select>
			                    </div>

			                    
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Alamat</label>
			                        <div class="col-xs-8">
			                            <textarea name="pendapat" class="form-control" placeholder="Testimoni..." required><?php echo $pendapat ?></textarea>
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
			    <!--END MODAL EDIT pendapat-->

			    <?php 
			        foreach($data->result_array() as $i):
			            $id_pendapat=$i['id_pendapat'];
						$id_siswa=$i['id_siswa'];
						$pendapat=$i['pendapat'];
			        ?>
			     <!-- ============ MODAL HAPUS pendapat =============== -->
			        <div class="modal fade" id="modal_hapus<?php echo $id_pendapat;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Hapus Testimoni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pendapat/hapus_pendapat'?>">
			                <div class="modal-body">
			                    <p>Anda yakin mau menghapus Testimoni dari Siswa ID = <b><?php echo $id_siswa;?></b></p>
			                </div>
			                <div class="modal-footer">
			                    <input type="hidden" name="id_pendapat" value="<?php echo $id_pendapat;?>">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-danger">Hapus</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>
			    <?php endforeach;?>
			    <!--END MODAL HAPUS pendapat-->
			    <!-- ============ MODAL DETAIL SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_pendapat=$i['id_pendapat'];
						$id_siswa=$i['id_siswa'];
						$pendapat=$i['pendapat'];
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_pendapat;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian Testimoni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <div class="modal-container">
			            	<table class="table">
			            		<tr>
			            			<td>ID Testimoni</td>
			            			<td>:</td>
			            			<td><?php echo $id_pendapat ?> </td>
			            		</tr>
			            		<tr>
			            			<td>ID Siswa</td>
			            			<td>:</td>
			            			<td> <?php echo $id_siswa ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Testimoni</td>
			            			<td>:</td>
			            			<td> <?php echo $pendapat ?> </td>
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