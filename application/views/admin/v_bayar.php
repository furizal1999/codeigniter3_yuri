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
		            	<h1 class="m-0 text-dark">Daftar Pembayaran</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">Pembayaran</a></li>
			              	<li class="breadcrumb-item active">Daftar Pembayaran</li>
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
							
							<td align="center"><b>ID PEMBAYARAN</b></td>
							<td align="center"><b>ID SISWA</b></td>
							<td align="center"><b>JUMLAH BAYAR</b></td>
							<td align="center"><b>PRINT</b></td>
			                <td align="center"><b>AKSI</b></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data->result_array() as $i):
								$id_pembayaran=$i['id_pembayaran'];
                                $id_siswa=$i['id_siswa'];
                                $id_admin=$i['id_admin'];
                                $nama_pembayar=$i['nama_pembayar'];
								$tgl_pembayaran=$i['tgl_pembayaran'];
								$jumlah_bayar=$i['jumlah_bayar'];
						?>
						<tr>
							<td><?php echo $id_pembayaran;?></td>
							<td><?php echo $id_siswa;?></td>
							<td><?php echo $jumlah_bayar;?></td>
							<td width="120px" align="center">
								<form class="text-xs" method="post" action="<?php echo base_url('admin/cetak_kwitansi') ?>" target='_BLANK'>
			                    	<input type="hidden" name="id_pembayaran" value="<?php echo $id_pembayaran ?>">
			                    	<input type="hidden" name="id_siswa" value="<?php echo $id_siswa ?>">
			                    	<input type="hidden" name="id_admin" value="<?php echo $id_admin ?>">
			                    	<input type="hidden" name="nama_pembayar" value="<?php echo $nama_pembayar ?>">
			                    	<input type="hidden" name="tgl_pembayaran" value="<?php echo $tgl_pembayaran ?>">
			                    	<input type="hidden" name="jumlah_bayar" value="<?php echo $jumlah_bayar ?>">
			                    	<button type="submit" name="print" class="btn btn-warning btn-xs text-xs text-white ">
			                    		<i class="fa fa-print"></i> Print Kwitansi
			                    	</button>
			                    	
			                    </form>
							</td>
			                <td style="width: 220px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_pembayaran;?>"><i class="fa fa-pen"></i> Edit</a>
			                    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $id_pembayaran;?>"><i class="fa fa-trash"></i> Hapus</a>
			                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_detail<?php echo $id_pembayaran;?>"><i class="fa fa-book"></i> Rincian</a>

			                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>


			     <!-- ============ MODAL ADD pembayaran =============== -->
			        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Tambah Pembayaran</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/bayar/simpan_pembayaran'?>">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID Siswa</label>
			                        <select name="id_siswa" class="form-control">
										<option value="Data belum dipilih">--Pilih--</option>
										<?php
											foreach($combobox->result_array() as $i):
												$id_sis=$i['id_siswa'];
										?>
										<option  value="<?php echo $id_sis ?>">
											<?php echo $id_sis?>
										</option>
										<?php endforeach;?>
									</select>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Pembayar</label>
			                        <div class="col-xs-8">
			                            <input name="nama_pembayar" class="form-control" type="text" placeholder="Nama pembayar..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Jumlah Bayar</label>
			                        <div class="col-xs-8">
			                            <input name="jumlah_bayar" class="form-control" type="number" placeholder="Jumlah bayar..." required>
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
			    <!--END MODAL ADD pembayaran-->

			    <!-- ============ MODAL EDIT pembayaran =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_pembayaran=$i['id_pembayaran'];
                        $id_siswa=$i['id_siswa'];
                        $id_admin=$i['id_admin'];
                        $nama_pembayar=$i['nama_pembayar'];
						$tgl_pembayaran=$i['tgl_pembayaran'];
						$jumlah_bayar=$i['jumlah_bayar'];
			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_pembayaran;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit Pembayaran</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/bayar/edit_pembayaran'?>">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID pembayaran</label>
			                        <div class="col-xs-8">
			                            <input name="id_pembayaran" value="<?php echo $id_pembayaran;?>" class="form-control" type="text" placeholder="Id pembayaran..." readonly>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID Siswa</label>
			                        <select name="id_siswa" class="form-control">
										<option value="Data belum dipilih" <?php if($id_siswa=='Data belum dipilih'){echo 'selected';} ?> >--Pilih--</option>
										<?php
											foreach($combobox->result_array() as $i):
												$id_sis=$i['id_siswa'];
										?>
										<option  value="<?php echo $id_sis ?>" 
											<?php if($id_siswa==$id_sis){echo 'selected';} ?> >
											<?php echo $id_sis?>
												
										</option>
										<?php endforeach;?>
									</select>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Pembayar</label>
			                        <div class="col-xs-8">
			                            <input name="nama_pembayar" value="<?php echo $nama_pembayar;?>" class="form-control" type="text" placeholder="Nama pembayar..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Jumlah Bayar</label>
			                        <div class="col-xs-8">
			                            <input name="jumlah_bayar" value="<?php echo $jumlah_bayar;?>" class="form-control" type="number" placeholder="Jumlah bayar..." required>
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
			    <!--END MODAL EDIT pembayaran-->

			    <?php 
			        foreach($data->result_array() as $i):
			            $id_pembayaran=$i['id_pembayaran'];
                        $id_siswa=$i['id_siswa'];
                        $id_admin=$i['id_admin'];
                        $nama_pembayar=$i['nama_pembayar'];
						$tgl_pembayaran=$i['tgl_pembayaran'];
						$jumlah_bayar=$i['jumlah_bayar'];
			        ?>
			     <!-- ============ MODAL HAPUS pembayaran =============== -->
			        <div class="modal fade" id="modal_hapus<?php echo $id_pembayaran;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Hapus pembayaran</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/bayar/hapus_pembayaran'?>">
			                <div class="modal-body">
			                    <p>Anda yakin mau menghapus ID pembayaran (<b><?php echo $id_pembayaran;?></b>)</p>
			                </div>
			                <div class="modal-footer">
			                    <input type="hidden" name="id_pembayaran" value="<?php echo $id_pembayaran;?>">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-danger">Hapus</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>
			    <?php endforeach;?>
			    <!--END MODAL HAPUS pembayaran-->

			    <!-- ============ MODAL DETAIL SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_pembayaran=$i['id_pembayaran'];
                        $id_siswa=$i['id_siswa'];
                        $id_admin=$i['id_admin'];
                        $nama_pembayar=$i['nama_pembayar'];
						$tgl_pembayaran=$i['tgl_pembayaran'];
						$jumlah_bayar=$i['jumlah_bayar'];
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_pembayaran;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian Pembayaran</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <div class="modal-container">
			            	<table class="table">
			            		<tr>
			            			<td>ID Pembayaran</td>
			            			<td>:</td>
			            			<td> <?php echo $id_pembayaran ?> </td>
			            		</tr>
			            		<tr>
			            			<td>ID Siswa</td>
			            			<td>:</td>
			            			<td> <?php echo $id_siswa ?> </td>
			            		</tr>
			            		<tr>
			            			<td>ID Admin</td>
			            			<td>:</td>
			            			<td> <?php echo $id_admin ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Nama Pembayar</td>
			            			<td>:</td>
			            			<td> <?php echo $nama_pembayar ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Tanggal Pembayaran</td>
			            			<td>:</td>
			            			<td> <?php echo $tgl_pembayaran ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Jumlah Bayar</td>
			            			<td>:</td>
			            			<td> <?php echo $jumlah_bayar ?> </td>
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