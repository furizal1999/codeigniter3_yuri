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
		            	<h1 class="m-0 text-dark">Daftar Pekerjaan Alumni</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">Pekerjaan Alumni</a></li>
			              	<li class="breadcrumb-item active">Daftar Pekerjaan Alumni</li>
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
							<td align="center"><b>ID PEKERJAAN</b></td>
							<td align="center"><b>NAMA PEKERJAAN</b></td>
			                <td align="center"><b>ID ALUMNI</b></td>
			                <td align="center"><b>AKSI</b></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data->result_array() as $i):
								$id_pekerjaan_alumni=$i['id_pekerjaan_alumni'];
								$nama_pekerjaan_alumni=$i['nama_pekerjaan_alumni'];
								$tempat_kerja=$i['tempat_kerja'];
								$tgl_terima=$i['tgl_terima'];
								$alamat_kerja=$i['alamat_kerja'];
								$jabatan=$i['jabatan'];
			                    $motivasi=$i['motivasi'];
			                    $id_siswa=$i['id_siswa'];
			                    $foto=$i['foto'];

						?>
						<tr>
							<td><?php echo $id_pekerjaan_alumni;?></td>
							<td><?php echo $nama_pekerjaan_alumni;?></td>
			                <td><?php echo $id_siswa;?></td>
			                <td style="width: 220px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_pekerjaan_alumni;?>"><i class="fa fa-pen"></i> Edit</a>
			                    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $id_pekerjaan_alumni;?>"><i class="fa fa-trash"></i> Hapus</a>
			                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_detail<?php echo $id_pekerjaan_alumni;?>"><i class="fa fa-book"></i> Rincian</a>
			                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				
			</div>


			    <!-- ============ MODAL ADD pekerjaan_alumni =============== -->
			        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Tambah Pekerjaan Alumni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pekerjaan_alumni/simpan_pekerjaan_alumni'?>" enctype="multipart/form-data">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Pekerjaan</label>
			                        <div class="col-xs-8">
			                            <input name="nama_pekerjaan_alumni" class="form-control" type="text" placeholder="Nama pekerjaan..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tempat Kerja</label>
			                        <div class="col-xs-8">
			                            <input name="tempat_kerja" class="form-control" type="text" placeholder="Tempat kerja..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tanggal Terima Kerja</label>
			                        <div class="col-xs-8">
			                            <input name="tgl_terima" class="form-control" type="date" required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Alamat Kerja</label>
			                        <div class="col-xs-8">
			                            <textarea name="alamat_kerja" class="form-control" placeholder="Alamat kerja..." required></textarea>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Jabatan</label>
			                        <div class="col-xs-8">
			                            <input name="jabatan" class="form-control" type="text" placeholder="jabatan..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Motivasi</label>
			                        <div class="col-xs-8">
			                            <textarea name="motivasi" class="form-control" placeholder="Motivasi..." required></textarea>
			                        </div>
			                    </div>
			                    
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID Alumni</label>
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
			                        <label class="control-label col-xs-3" >Foto Pekerjaan <i class="text-danger">(Ekstensi file : jpg / jpeg / png)</i></label>
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
			    <!--END MODAL ADD pekerjaan_alumni-->

			    <!-- ============ MODAL EDIT pekerjaan_alumni =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_pekerjaan_alumni=$i['id_pekerjaan_alumni'];
						$nama_pekerjaan_alumni=$i['nama_pekerjaan_alumni'];
						$tempat_kerja=$i['tempat_kerja'];
						$tgl_terima=$i['tgl_terima'];
						$alamat_kerja=$i['alamat_kerja'];
						$jabatan=$i['jabatan'];
	                    $motivasi=$i['motivasi'];
	                    $id_siswa=$i['id_siswa'];
	                    $foto=$i['foto'];
			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_pekerjaan_alumni;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit pekerjaan_alumni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pekerjaan_alumni/edit_pekerjaan_alumni'?>" enctype="multipart/form-data">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID pekerjaan_alumni</label>
			                        <div class="col-xs-8">
			                            <input name="id_pekerjaan_alumni" value="<?php echo $id_pekerjaan_alumni;?>" class="form-control" type="text" placeholder="Id pekerjaan_alumni..." readonly>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Pekerjaan</label>
			                        <div class="col-xs-8">
			                            <input name="nama_pekerjaan_alumni" value="<?php echo $nama_pekerjaan_alumni;?>"class="form-control" type="text" placeholder="Nama pekerjaan..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tempat Kerja</label>
			                        <div class="col-xs-8">
			                            <input name="tempat_kerja" value="<?php echo $tempat_kerja;?>" class="form-control" type="text" placeholder="Tempat kerja..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tanggal Terima Kerja</label>
			                        <div class="col-xs-8">
			                            <input name="tgl_terima" value="<?php echo $tgl_terima;?>" class="form-control" type="date" required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Alamat Kerja</label>
			                        <div class="col-xs-8">
			                            <textarea name="alamat_kerja" class="form-control" placeholder="Alamat kerja..." required><?php echo $alamat_kerja;?></textarea>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Jabatan</label>
			                        <div class="col-xs-8">
			                            <input name="jabatan" value="<?php echo $jabatan;?>" class="form-control" type="text" placeholder="jabatan..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Motivasi</label>
			                        <div class="col-xs-8">
			                            <textarea name="motivasi" class="form-control" placeholder="Motivasi..." required><?php echo $motivasi;?></textarea>
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
			                        <label class="control-label col-xs-3" >Foto Pekerjaan <i class="text-danger">(Ekstensi file : jpg / jpeg / png)</i></label>
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
			    <!--END MODAL EDIT pekerjaan_alumni-->

			    <?php 
			        foreach($data->result_array() as $i):
			            $id_pekerjaan_alumni=$i['id_pekerjaan_alumni'];
						$nama_pekerjaan_alumni=$i['nama_pekerjaan_alumni'];
						$tempat_kerja=$i['tempat_kerja'];
						$tgl_terima=$i['tgl_terima'];
						$alamat_kerja=$i['alamat_kerja'];
						$jabatan=$i['jabatan'];
	                    $motivasi=$i['motivasi'];
	                    $id_siswa=$i['id_siswa'];
	                    $foto=$i['foto'];
			        ?>
			     <!-- ============ MODAL HAPUS pekerjaan_alumni =============== -->
			        <div class="modal fade" id="modal_hapus<?php echo $id_pekerjaan_alumni;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Hapus pekerjaan_alumni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pekerjaan_alumni/hapus_pekerjaan_alumni'?>">
			                <div class="modal-body">
			                    <p>Anda yakin mau menghapus <b><?php echo $nama_pekerjaan_alumni;?></b></p>
			                </div>
			                <div class="modal-footer">
			                    <input type="hidden" name="id_pekerjaan_alumni" value="<?php echo $id_pekerjaan_alumni;?>">
			                    <input type="hidden" name="fotolama" value="<?php echo $foto;?>">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-danger">Hapus</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>
			    <?php endforeach;?>
			    <!--END MODAL HAPUS pekerjaan_alumni-->

			    <!-- ============ MODAL DETAIL SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_pekerjaan_alumni=$i['id_pekerjaan_alumni'];
						$nama_pekerjaan_alumni=$i['nama_pekerjaan_alumni'];
						$tempat_kerja=$i['tempat_kerja'];
						$tgl_terima=$i['tgl_terima'];
						$alamat_kerja=$i['alamat_kerja'];
						$jabatan=$i['jabatan'];
	                    $motivasi=$i['motivasi'];
	                    $id_siswa=$i['id_siswa'];
	                    $foto=$i['foto'];
	                    $nama_siswa ='';
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_pekerjaan_alumni;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian Pekerjaan Alumni</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <div class="modal-container">
			            	<table class="table">
			            		<tr>
			            			<td colspan="3" class="text-center">
					                	<?php if(!empty($foto)){ ?>
					                		<a href="<?php echo base_url()?>templates/img/pekerjaan_alumni/<?php echo $foto?>" class="venobox" data-gall="gallery-item">
							                  <img width="80%" src="<?php echo base_url()?>templates/img/pekerjaan_alumni/<?php echo $foto?>" alt="" class="img-fluid">
							                </a>
					                	
										<?php }else{
											echo "Foto belum tersedia!";
										} ?>
					                </td>
			            		</tr>
			 			            		
			            		<tr>
			            			<td>Id Pekerjaan Alumni</td>
			            			<td>:</td>
			            			<td> <?php echo $id_pekerjaan_alumni ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Nama Pekerjaan Alumni</td>
			            			<td>:</td>
			            			<td> <?php echo $nama_pekerjaan_alumni ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Tempat Kerja</td>
			            			<td>:</td>
			            			<td> <?php echo $tempat_kerja ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Tanggal Terima Kerja</td>
			            			<td>:</td>
			            			<td> <?php echo $tgl_terima ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Alamat Kerja</td>
			            			<td>:</td>
			            			<td> <?php echo $alamat_kerja ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Jabatan</td>
			            			<td>:</td>
			            			<td> <?php echo $jabatan ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Motivasi</td>
			            			<td>:</td>
			            			<td> <?php echo $motivasi ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Id Siswa</td>
			            			<td>:</td>
			            			<td><?php echo $id_siswa ?> </td>
			            		</tr>

			            		<?php 

			            		// $f=0;
								foreach($combobox->result_array() as $i):
									$id_alum=$i['id_siswa'];
									$nama_alum=$i['nama_siswa'];

									if($id_siswa==$id_alum){
										$nama_siswa = $nama_alum;
									}
								endforeach;
								?>

								<tr>
			            			<td>Nama Alumni</td>
			            			<td>:</td>
			            			<td><?php echo $nama_siswa ?> </td>
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