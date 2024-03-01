<?php

  if((isset($_SESSION['login']) && strcmp($_SESSION["status"], 'admin')!==0 )||(!isset($_SESSION['login']))){

    redirect('public/beranda');
  }

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h5><?php echo $jumlah_siswa; ?></h5>

                <p>Total Semua Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a class="small-box-footer">---</i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5><?php echo $jumlah_aktif; ?></h5>

                <p>Akun Aktif</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url('admin/siswa') ?>" class="small-box-footer">Informasi lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h5><?php echo $jumlah_nonaktif; ?></h5>

                <p>Akun Non-Aktif</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url('admin/siswa_nonaktif') ?>" class="small-box-footer">Informasi lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h5><?php echo $jumlah_alumni; ?></h5>

                <p>Jumlah Alumni</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo base_url('admin/alumni') ?>" class="small-box-footer">Informasi lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->


        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h5>Rp. <?php echo $total_tagihan; ?></h5>

                <p>Total Tagihan Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a class="small-box-footer">---</i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>Rp. <?php echo $total_pembayaran; ?></h5>

                <p>Total Pembayaran Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url('admin/bayar') ?>" class="small-box-footer">Informasi lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h5>Rp. <?php echo ($total_tagihan-$total_pembayaran); ?></h5>

                <p>Sisa Tagihan Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a class="small-box-footer">---</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h5><?php echo $jumlah_siswa_only; ?></h5>

                <p>Jumlah Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a class="small-box-footer">---</a>
            </div>
          </div>
          <!-- ./col -->
        </div>



        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header bg-info">
                <h3 class="card-title">Log Aktifitas</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="direct-chat-messages">
                  <table class="table text-center">
                    <tr class="bg-secondary">
                      <th>----</th>
                      <th>STATUS USER</th>
                      <th>ID USER</th>
                      <th>NAMA USER</th>
                      <th>WAKTU LOG</th>
                      <th>AKSI</th>
                    </tr>
                    <?php $no=1;
                      foreach($log_aktifitas->result_array() as $i):
                        $id_log=$i['id_log'];
                        $status=$i['status'];
                        $id=$i['id'];
                        $nama=$i['nama'];
                        $tanggal=$i['tanggal'];
                        $waktu=$i['waktu'];
                        $aksi=$i['aksi'];      
                    ?>
                    <tr>
                      <th><?php echo $no++; ?></th>
                      <th><?php echo $status; ?></th>
                      <th><?php echo $id; ?></th>
                      <th><?php echo $nama; ?></th>
                      <th><?php echo $tanggal.' '.$waktu; ?></th>
                      <th><?php echo $aksi; ?></th>
                    </tr>
                  <?php endforeach; ?>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-info">
                <?php echo 'Log Aktifitas' ?>
              </div>
              <!-- /.card-footer-->
            </div>
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</body>
</html>
