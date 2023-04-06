<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-users"></i>List Pendaftar PPDB<small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-users"></i>List Pendaftar PPDB</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-md-12">
                <div class="datatable-top-controls datatable-top-controls-filter">
                  <button type="button" class="btn btn-primary btn-blue btn-flat create-or-edit-user">
                    <i class="fa fa-plus"><a target="__blank" href="<?php echo base_url('PPDB_Controller/daftar')?>" style="color:white;">Tambah Siswa PPDB</a></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-striped">
              <thead>
              <tr>
                <th><input type="checkbox" class="minimal all-check"></th>
                <th>id</th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <!--<th>Peminatan</th>-->
                <th>Status</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($siswa as $data): ?>
                    <tr>
                        <td><?= $data['id_siswaBaru']; ?></td>
                        <td><?= $data['kode_pendaftaran']; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['no_telp']; ?></td>
                        <?php if($data['jk'] == 1){ ?>
                        	<td>Laki - Laki</td>
                        <?php } else { ?>
                        	<td>Perempuan</td>
                        <?php } ?>
                        <td><?= date('d/m/y', strtotime($data['tgl_lahir'])); ?></td>
                  <!--      <td><?php if ($data['jurusan1'] == 1) { ?>-->
		                <!--    Management pemasaran-->
		                <!--<?php } else if($data['jurusan1'] == 2){ ?>-->
		                <!--    Administrasi perkantoran-->
		                <!--<?php } else if($data['jurusan1'] == 3){ ?>-->
		                <!--    Akutansi-->
		                <!--<?php } else {?>-->
		                <!--    Teknik komputer jaringan-->
		                <!--<?php } ?>-->
		                <!--</td>-->
                        <td>
							<?php if($data['status'] == 0){ ?>
								<div class="text-center"><span class="badge badge-danger"><strong>Pelunasan Angsuran 1</strong></span></div>
							<?php }else if($data['status'] == 1){ ?>
								<div class="text-center"><span class="badge badge-info"><strong>Pelunasan Angsuran 2</strong></span></div>
							<?php }else if($data['status'] == 2){ ?>
								<div class="text-center"><span class="badge badge-success"><strong>Pembayaran Lunas</strong></span></div>
							<?php } ?>
						</td>
						<td>
							
<a href="<?php echo base_url('PPDB_Controller/verifikasi/'.$data['id_siswaBaru']) ?>" class="text-center"><span class="badge badge-success"><strong>verifikasi</strong></span></a>
						
						</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Right Modal -->
<div class="modal right fade modal-right" id="modal-right" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Roles</h4>
      </div>
      <div class="modal-body">
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/role.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/user.js"></script>

</body>
</html>

