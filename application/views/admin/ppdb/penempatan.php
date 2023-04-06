<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Siswa <b></b></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-users"></i> Data Siswa</li>
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
                  <div class="btn-group">
                    <form method="post" action="<?php echo base_url('PPDB_Controller/proses_penempatan')?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  </div>
                </div>
                <div class="datatable-top-controls datatable-top-controls-dd" >
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> Pilih Jurusan </button>
                    </span>
                    <input type="hidden" id="id_jurusan">
                    <select class="form-control select2" id="id_jurusan" name="id_jurusan">
                        <?php foreach ($jurusan as $data) {?>
                            <option value="<?php echo $data['id']?>"><?php echo $data['nama']?></option>   
                        <?php } ?>
                     </select>
                  </div>
                </div>
                
                <div class="datatable-top-controls datatable-top-controls-dd" >
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> Pilih Kelas </button>
                    </span>
                    <select class="form-control select2" id="id_kelas" name="id_kelas">
                        <?php foreach ($kelas as $data) {?>
                            <option value="<?php echo $data['id']?>"><?php echo $data['nama']?></option>   
                        <?php } ?>
                     </select>
                  </div>
                </div>
                
                <div class="datatable-top-controls datatable-top-controls-dd" >
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> Pilih Angkatan </button>
                    </span>
                    <select class="form-control select2" id="id_kelas" name="id_angkatan">
                        <?php foreach ($angkatan as $data) {?>
                            <option value="<?php echo $data['id']?>"><?php echo $data['tahun_angkatan']?></option>   
                        <?php } ?>
                     </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-blue btn-flat">Submit Penempatan</button>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-striped" id="candidates_datatable">
              <thead>
              <tr class="text-center">
                <th></th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <!--<th>Peminatan</th>-->
                <th>Status</th>
              </tr>
              </thead>
              <tbody>
                  <?php $no = 1; foreach($siswa as $data): ?>
                    <tr>
                        <td><input type="checkbox" name="check_id[]" value="<?php echo $data['id_siswaBaru']?>"></td>
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
                    </tr>
                <?php endforeach; ?>
                </form>                
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
        <h4 class="modal-title" id="myModalLabel2">Resume</h4>
      </div>
      <div class="modal-body">
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->
<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>
<!-- page script -->
<script>
    
    
</script>

</body>
</html>
