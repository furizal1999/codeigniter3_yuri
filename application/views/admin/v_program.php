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
		            	<h1 class="m-0 text-dark">Daftar program</h1>
		          	</div><!-- /.col -->
			        <div class="col-sm-6">
			            <ol class="breadcrumb float-sm-right">
			              	<li class="breadcrumb-item"><a href="#">program</a></li>
			              	<li class="breadcrumb-item active">Daftar program</li>
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
							<td align="center"><b>ID PROGRAM</b></td>
							<td align="center"><b>NAMA PROGRAM</b></td>
			                <td align="center"><b>BIAYA</b></td>
			                <td align="center"><b>AKSI</b></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data->result_array() as $i):
								$id_program=$i['id_program'];
                                $nama_program=$i['nama_program'];
                                $materi=$i['materi'];
								$tempo=$i['tempo'];
								$biaya=$i['biaya'];
                                $ket=$i['ket'];

						?>
						<tr>
							<td><?php echo $id_program;?></td>
							<td><?php echo $nama_program;?></td>
			                <td><?php echo $biaya;?></td>
			                <td style="width: 220px;" class="text-white">
			                    <a class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modal_edit<?php echo $id_program;?>"><i class="fa fa-pen"></i> Edit</a>
			                    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $id_program;?>"><i class="fa fa-trash"></i> Hapus</a>
			                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_detail<?php echo $id_program;?>"><i class="fa fa-book"></i> Rincian</a>
			                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				
			</div>


			    <!-- ============ MODAL ADD program =============== -->
			        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Tambah program</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/program/simpan_program'?>">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Program</label>
			                        <div class="col-xs-8">
			                            <input name="nama_program" class="form-control" type="text" placeholder="Nama program..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Materi</label>
			                        <div class="col-xs-8">
						        		<input type="checkbox" name="materi[]" value="Microsoft Office Word"> Microsoft Office Word <br>
						        		<input type="checkbox" name="materi[]" value="Microsoft Office Excel"> Microsoft Office Excel <br>
						        		<input type="checkbox" name="materi[]" value="Microsoft Office Powerpoint"> Microsoft Office Powerpoint <br>
						        		<input type="checkbox" name="materi[]" value="Photoshop"> Photoshop <br>
						        		<input type="checkbox" name="materi[]" value="Internet"> Internet <br>
						        		<input type="checkbox" name="materi[]" value="Coreldraw"> Coreldraw <br>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tempo  <b class="text-danger">(Bulan)</b></label>
			                        <div class="col-xs-8">
			                            <input name="tempo" class="form-control" type="number" placeholder="Tempo..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Biaya</i></label>
			                        <div class="col-xs-8">
			                            <input name="biaya" class="form-control" type="number" placeholder="Biaya..." required>
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
			    <!--END MODAL ADD program-->

			    <!-- ============ MODAL EDIT program =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_program=$i['id_program'];
                        $nama_program=$i['nama_program'];
                        // $materi=$i['materi'];
                        $tempo=$i['tempo'];
                        $biaya=$i['biaya'];
                        $ket=$i['ket'];

                        $cekbox =  explode(', ', $i['materi']);
			        ?>
			        <div class="modal fade" id="modal_edit<?php echo $id_program;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Edit program</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/program/edit_program'?>">
			                <div class="modal-body">

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >ID program</label>
			                        <div class="col-xs-8">
			                            <input name="id_program" value="<?php echo $id_program;?>" class="form-control" type="text" placeholder="Id program..." readonly>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Nama Program</label>
			                        <div class="col-xs-8">
			                            <input name="nama_program" value="<?php echo $nama_program;?>"  class="form-control" type="text" placeholder="Id program..." required>
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Materi</label><br>
			                        <div class="col-xs-8">
						        		<input type="checkbox" name="materi[]" value="Microsoft Office Word"<?php in_array('Microsoft Office Word', $cekbox)? print 'checked' : ''; ?>> Microsoft Office Word <br>
						        		<input type="checkbox" name="materi[]" value="Microsoft Office Excel" <?php in_array('Microsoft Office Excel', $cekbox)? print 'checked' : ''; ?>> Microsoft Office Excel <br>
						        		<input type="checkbox" name="materi[]" value="Microsoft Office Powerpoint" <?php in_array('Microsoft Office Powerpoint', $cekbox)? print 'checked' : ''; ?>> Microsoft Office Powerpoint <br>
						        		<input type="checkbox" name="materi[]" value="Photoshop" <?php in_array('Photoshop', $cekbox)? print 'checked' : ''; ?>> Photoshop <br>
						        		<input type="checkbox" name="materi[]" value="Internet" <?php in_array('Internet', $cekbox)? print 'checked' : ''; ?>> Internet <br>
						        		<input type="checkbox" name="materi[]" value="Coreldraw" <?php in_array('Coreldraw', $cekbox)? print 'checked' : ''; ?>> Coreldraw <br>

			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Tempo <b class="text-danger">(Bulan)</b></label>
			                        <div class="col-xs-8">
			                            <input name="tempo" value="<?php echo $tempo;?>" class="form-control" type="number" placeholder="Tempo..." required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-xs-3" >Biaya</i></label>
			                        <div class="col-xs-8">
			                            <input name="biaya" value="<?php echo $biaya;?>" class="form-control" type="number" placeholder="Biaya..." required>
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
			    <!--END MODAL EDIT program-->

			    <?php 
			        foreach($data->result_array() as $i):
			            $id_program=$i['id_program'];
                        $nama_program=$i['nama_program'];
                        $materi=$i['materi'];
                        $tempo=$i['tempo'];
                        $biaya=$i['biaya'];
                        $ket=$i['ket'];
			        ?>
			     <!-- ============ MODAL HAPUS program =============== -->
			        <div class="modal fade" id="modal_hapus<?php echo $id_program;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			            	<h3 class="modal-title" id="myModalLabel">Hapus program</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/program/hapus_program'?>">
			                <div class="modal-body">
			                    <p>Anda yakin mau menghapus <b><?php echo $nama_program;?></b></p>
			                </div>
			                <div class="modal-footer">
			                    <input type="hidden" name="id_program" value="<?php echo $id_program;?>">
			                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			                    <button class="btn btn-danger">Hapus</button>
			                </div>
			            </form>
			            </div>
			            </div>
			        </div>
			    <?php endforeach;?>
			    <!--END MODAL HAPUS program-->
			    <!-- ============ MODAL DETAIL SISWA =============== -->
			    <?php 
			        foreach($data->result_array() as $i):
			            $id_program=$i['id_program'];
                        $nama_program=$i['nama_program'];
                        $materi=$i['materi'];
                        $tempo=$i['tempo'];
                        $biaya=$i['biaya'];
                        $ket=$i['ket'];
			        ?>
			        <div class="modal fade" id="modal_detail<?php echo $id_program;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			            <div class="modal-dialog">
			            <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title" id="myModalLabel">Rincian Program</h3>
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			            </div>
			            <div class="modal-container">
			            	<table class="table">
			            		<tr>
			            			<td>ID Program</td>
			            			<td>:</td>
			            			<td><?php echo $id_program ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Nama Program</td>
			            			<td>:</td>
			            			<td> <?php echo $nama_program ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Materi</td>
			            			<td>:</td>
			            			<td> <?php echo $materi ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Lama Kursus</td>
			            			<td>:</td>
			            			<td> <?php echo $tempo ?> </td>
			            		</tr>
			            		<tr>
			            			<td>Biaya</td>
			            			<td>:</td>
			            			<td> <?php echo $biaya ?> </td>
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