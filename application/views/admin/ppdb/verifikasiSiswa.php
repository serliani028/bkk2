  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-newspaper"></i>Verifikasi Pembayaran</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-newspaper"></i>Verifikasi Pembayaran</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row job-board-main-container">
        <!-- Left col -->
        <section class="col-lg-12">

          <div class="box box-primary">
            <div class="box-body job-board-box-body">
              <!-- Job Board Inner/Main Container Starts -->
              <div class="container job-board-inner-container">
                <div class="row">
                  <!-- Job Board Right Container Starts -->
                  <div class="col-md-9">
                    <div class="job-board-right-controls">
                      <div class="container job-board-right-controls-inner">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Bukti Pembayaran</h3>                                
                            </div>
                            <div class="col-md-6">
                                <h3 class="pull-right">
                                    <a href="<?php echo base_url('PPDB_Controller/list_pendaftar/-1') ?>" class="btn btn-info btn-sm"><strong>KEMBALI</strong></a>
                                </h3>                                
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="job-board-right" id="candidates_list">
                        <table class="table table-bordered table-striped">
              <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Catatan</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Bukti Pembayaran</th>
                <th scope="col">Verifikasi</th>
                <th scope="col">Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php $i=0;foreach ($pembayaran as $data): $i++;?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $data['tanggal_bayar'] ?></td>
                    <td><?= $data['catatan'] ?></td>
                    <td><?= rupiah($data['jumlah']) ?></td>
                    <td><a target="_blank" href="<?php echo base_url('public/data/ppdb/pembayaran/'.$data['bukti_pembayaran']) ?>">(lihat bukti)</a></td>
                    <?php if ($data['verifikasi'] == 0){ ?>
                    <td>
                        <div class="text-center">
                            <a onclick="show(<?php echo $data['id_ppdb']?>)" class="btn btn-danger btn-xs" style="color:white;">Belum Diverifikasi</a>
                        </div>
                    </td>
                    <?php } else if($data['verifikasi'] == -1) { ?>
                    <td>
                        <div class="text-center">
                            <a onclick="show(<?php echo $data['id_ppdb']?>)" class="btn btn-danger btn-xs" style="color:white;">Ditolak</a>
                        </div>
                    </td>                                                    
                    <?php } else { ?>
                    <td>
                        <div class="text-center">
                            <a href="<?php echo base_url("PPDB_Controller/cancel_pembayaran/".$data['id_ppdb'].'/'.$data['id_siswaBaru']) ?>" onclick="return confirm('Anda yakin mencancel pembayaran?')" class="btn btn-success btn-xs" style="color:white;">Diverifikasi</a>
                        </div>
                    </td>                                                    
                    <?php } ?>
                    <td>
                        <div class="text-center">
                            <a onclick="return confirm('Yakin tolak pembayaran?')" href="<?= base_url('PPDB_Controller/tolak_pembayaran/' . $data['id_ppdb'].'/'.$data['id_siswaBaru']) ?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php $this->load->view('admin/ppdb/modalDetailPembayaran', $data) ?>
                <?php endforeach ?>                                   
            </tbody>
            </table>
                    </div>
                  </div>
                  <!-- Job Board Left Container Starts -->
                  <div class="col-md-3 job-board-left-container">
                    <div class="job-board-left-top" style="min-height:0px">
                            <br>
                      <div class="col-xs-12 col-sm-12 col-md-12 job-board-left-jobs-container">

                      </div>
                    </div>
                    <div class="job-board-left">
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" id="jobs_list">

<!-- QRcode -->
                                        <div class="row">
                                            <div class="col-sm-12">
<!--                                                 <img src="<?= base_url('public/data/qrcode-siswa/' . $siswa['qr_code']) ?>" alt="" style="width: 180px;"> -->
                                            <center><h1><i class="fas fa-user"></i></h1></center>
                                            </div>
                                        </div>
                                            
                                        <!-- NISN -->
                                        <div class="row">
                                            <div class="col-sm-3"><strong class="pull-left">Kode</strong></div>
                                            <div class="col-sm-9"><span class="pull-left"><?php echo $siswa['kode_pendaftaran']; ?></span></div>
                                        </div>
                                        <!-- Nama -->
                                        <div class="row">
                                            <div class="col-sm-3"><strong class="pull-left">Nama</strong></div>
                                            <div class="col-sm-9"><span class="pull-left"><?php echo $siswa['nama']; ?></span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"><strong class="pull-left">Kelamin</strong></div>
                                            <?php if ($siswa['jk'] == 1 ){ ?>
                                                <div class="col-sm-9"><span class="pull-left">Laki - Laki</span></div>                                                
                                            <?php } else { ?>
                                                <div class="col-sm-9"><span class="pull-left">Perempuan</span></div>
                                            <?php } ?>
                                        </div>
                                        <!-- Kelas -->
                                        <div class="row">
                                            <div class="col-sm-3"><strong class="pull-left">Email</strong></div>
                                            <div class="col-sm-9"><span class="pull-left"><?php echo $siswa['email']; ?></span></div>
                                        </div>
                                        <!-- HP -->
                                        <div class="row">
                                            <div class="col-sm-3"><strong class="pull-left">No.telp</strong></div>
                                            <div class="col-sm-9"><span class="pull-left"><?php echo $siswa['no_telp']; ?></span></div>
                                        </div>
                                        <!-- Alamat -->
                                        <div class="row">
                                            <div class="col-sm-3"><strong class="pull-left">Alamat</strong></div>
                                            <div class="col-sm-9"><span class="pull-left"><?php echo $siswa['alamat']; ?></span></div>
                                        </div>
                                        <!-- Tunggakan -->
                                        <div class="row">
                                            <div class="col-sm-3"><strong class="pull-left">Jurusan</strong></div>
                                            <div class="col-sm-9"><span class="pull-left"><?php echo $this->Jurusan_Model->getNamaJurusan($siswa['jurusan1'])?></span></div>
                                        </div>
                                        <!-- Tunggakan -->
                                        <div class="row">
                                            <div class="col-sm-3"><strong class="pull-left">Total Pembayaran</strong></div>
                                            <div class="col-sm-9"><span class="pull-left"><?php echo rupiah($total_pembayaran[0]['total']) ?></span></div>
                                        </div>
                                        <a href="#" class="btn btn-primary btn-block" onclick="showProfile()" style="margin-top: 50px;">Edit Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Right Modal -->
  <div class="modal right fade" id="modal-right" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Right Sidebar</h4>
        </div>
        <div class="modal-body-container">
        </div>
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->
  
<!-- Forms for jobs section / left side -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>
<?php $this->load->view('admin/ppdb/modalEditSiswa') ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/job_board.js"></script>
<script>
        function show(id)
        {
            $('#modal'+id).modal('show');
        }

        function showProfile()
        {
            $('#modalEditSiswa').modal('show');
            document.getElementById('jurusan').value=<?php echo $siswa['jurusan1'] ?>;
        }
    </script>

</body>
</html>