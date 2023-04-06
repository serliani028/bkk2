<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Kelola Data Siswa BKK <b><?=strtoupper($sekolah->nama);?></b></h1>
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
                <!--<div class="datatable-top-controls datatable-top-controls-filter">-->
                <!--  <div class="btn-group">-->
                <!--    <button type="button" class="btn btn-primary btn-blue btn-flat"><?php echo lang('actions'); ?></button>-->
                <!--    <button type="button" class="btn btn-primary btn-blue btn-flat dropdown-toggle"-->
                <!--      data-toggle="dropdown" aria-expanded="false">-->
                <!--      <span class="caret"></span>-->
                <!--      <span class="sr-only">Toggle Dropdown</span>-->
                <!--    </button>-->
                <!--    <ul class="dropdown-menu" role="menu">-->
                <!--      <li><a href="#" class="bulk-action-siswa-bkk" data-action="activate"><?php echo lang('activate'); ?></a></li>-->
                <!--      <li><a href="#" class="bulk-action-siswa-bkk" data-action="deactivate"><?php echo lang('deactivate'); ?></a></li>-->
                <!--    </ul>-->
                <!--  </div>-->
                <!--</div>-->
                <!--<div class="datatable-top-controls datatable-top-controls-dd" >-->
                <!--  <div class="input-group">-->
                <!--    <span class="input-group-btn">-->
                <!--      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> Filter Kelas Siswa </button>-->
                <!--    </span>-->
                    <input type="hidden" id="id_sekolah_bkk" value="<?=$sekolah->id_mitra?>" >
                    
                <!--  </div>-->
                <!--</div>-->
                 <div class="datatable-top-controls datatable-top-controls-dd" >
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> FIlter Tahun Ajaran </button>
                    </span>
                    <!--<input type="hidden" id="tahun_angkatan" value="<?=$tahun->id?>" >-->
                    <select class="form-control select2" id="tahun_siswa_bkk">
                        <option value="">Semua Siswa </option>
                        <?php foreach ($tahun as $key => $value): ?>
                            <!-- html... -->
                        <option value="<?=$value->id?>">Tahun <?=$value->tahun_angkatan;?> </option>
                            
                        <?php endforeach; ?>
                        <!--<option value="1">Siswa Magang </option>-->
                        <!--<option value="2">Siswa Bekerja</option>-->
                     </select>
                  </div>
                </div>
                
                <!-- <div class="datatable-top-controls datatable-top-controls-dd" >-->
                <!--  <div class="input-group">-->
                <!--    <span class="input-group-btn">-->
                <!--      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> FIlter Kelas Siswa </button>-->
                <!--    </span>-->
                    <!--<input type="hidden" id="tahun_angkatan" value="<?=$tahun->id?>" >-->
                <!--    <select class="form-control select2" id="kelas_siswa_bkk">-->
                <!--        <option value="">Semua Siswa </option>-->
                <!--        <option value="">Kelas X </option>-->
                <!--        <option value="">Kelas X </option>-->
                <!--        <option value="">Kelas X </option>-->
                        <!--<option value="1">Siswa Magang </option>-->
                        <!--<option value="2">Siswa Bekerja</option>-->
                <!--     </select>-->
                <!--  </div>-->
                <!--</div>-->
                
                <div class="datatable-top-controls datatable-top-controls-dd" >
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> FIlter Jurusan Siswa </button>
                    </span>
                    <!--<input type="hidden" id="tahun_angkatan" value="<?=$tahun->id?>" >-->
                    <select class="form-control select2" id="jurusan_siswa_bkk">
                        <option value="">Semua Jurusan</option>
                    <?php foreach ($jurusan as $key): ?>
                        <option value="<?=$key->id?>">Jurusan <?=$key->nama?></option>
                    <?php endforeach; ?>?>
                     </select>
                  </div>
                </div>
                
               
                
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-striped" id="candidates_datatable_siswa_bkk">
              <thead>
              <tr class="text-center">
                <!--<th style="width:5%;"><input type="checkbox" class="minimal all-check"></th>-->
                <th style="width:15%;">Foto Siswa</th>
                <th style="width:20%;">Nama Siswa</th>
                <th style="width:10%;">Kelas Siswa</th>
                <th style="width:10%;">Jurusan Siswa</th>
                <th style="width:15%;">Tahun Angkatan</th>
                <!--<th>Status SIswa</th>-->
              </tr>
              </thead>
              <tbody>
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
<script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script>

</body>
</html>
