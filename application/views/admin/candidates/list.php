<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data User</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data User</li>
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
                    <button type="button" class="btn btn-primary btn-blue btn-flat"><?php echo lang('actions'); ?></button>
                    <button type="button" class="btn btn-primary btn-blue btn-flat dropdown-toggle"
                      data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#" class="bulk-action" data-action="activate"><?php echo lang('activate'); ?></a></li>
                      <li><a href="#" class="bulk-action" data-action="deactivate"><?php echo lang('deactivate'); ?></a></li>
                      <li><a href="#" class="bulk-action" data-action="tugaskan">Tugaskan Kandidat Psikotes</a></li>
                      <li><a href="#" class="bulk-action" data-action="download-excel">Ekspor Data Kandidat</a></li>
                    </ul>
                  </div>
                </div>
                <div class="datatable-top-controls datatable-top-controls-dd" >
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> Filter Status User </button>
                    </span>
                    <select class="form-control select2" id="status">
                    <option value="">Semua</option>   
                    <option value="1">Aktif</option>   
                    <option value="0">NonAktif</option>    
                    <option value="2">Siswa BKK</option>    
                     </select>
                  </div>
                </div>
                <div class="datatable-top-controls datatable-top-controls-dd" >
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> Filter Data User </button>
                    </span>
                    <select class="form-control select2" id="f_data_siswa">
                    <!--<option value="">Semua</option>   -->
                    <option value="1">Rating Tertinggi</option>   
                    <option value="2">Kompetensi Tertinggi</option>    
                    <option value="3">Psikotes Tertinggi</option>    
                     </select>
                  </div>
                </div>
                
                <div class="datatable-top-controls datatable-top-controls-dd" >
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> Filter Sekolah Mitra </button>
                    </span>
                    <select class="form-control select2 jenis_mitra" >
                    <option value="">Semua</option>   
                    <?php foreach ($sekolah as $value){ ?>
                    <option value="<?=$value->id_mitra;?>"><?=$value->nama;?></option>   
                    <?php } ?>
                     </select>
                  </div>
                </div>
                
                <div class="datatable-top-controls datatable-top-controls-dd">
                  <!--<div class="input-group">-->
                  <!--  <span class="input-group-btn">-->
                  <!--    <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> <?php echo lang('filter_by_account_type'); ?></button>-->
                  <!--  </span>-->
                  <!--  <select class="form-control select2" id="account_type">-->
                  <!--    <option value=""><?php echo lang('all'); ?></option>-->
                  <!--    <option value="site"><?php echo lang('site'); ?></option>-->
                  <!--    <option value="google"><?php echo lang('google'); ?></option>-->
                  <!--    <option value="linkedin"><?php echo lang('linkedin'); ?></option>-->
                  <!--  </select>-->
                  <!--</div>-->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                  <!--<b id="kategori" style="color:white;background-color:#75a0eb;padding:6px;font-size:15px"> </b>-->
                  <!--<b style="color:white;background-color:#75a0eb;padding:6px;font-size:15px">Data Semua User Terdaftar</b>-->
              <!--  <div class="datatable-top-controls datatable-top-controls-dd-2">-->
              <!--    <div class="input-group">-->
              <!--      <span class="input-group-btn">-->
              <!--        <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i>-->
              <!--          <?php echo lang('job_title'); ?></button>-->
              <!--      </span>-->
              <!--      <input type="text" class="form-control" id="job_title">-->
              <!--    </div>-->
              <!--  </div>-->
              <!--  <div class="datatable-top-controls datatable-top-controls-dd-2">-->
              <!--    <div class="input-group">-->
              <!--      <span class="input-group-btn">-->
              <!--        <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i>-->
              <!--          <?php echo lang('experience'); ?></button>-->
              <!--      </span>-->
              <!--      <input type="number" class="form-control" id="experience">-->
              <!--    </div>-->
                </div>

              <!--</div>-->
            </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?php if (allowedTo('view_candidate_listing')) { ?>
            <table class="table table-bordered table-striped" id="candidates_datatable">
              <thead>
              <tr>
                <th><input type="checkbox" class="minimal all-check"></th>
                <th><?php echo lang('image'); ?></th>
                <th><?php echo 'Nama User'; ?></th>
                <th><?php echo lang('email'); ?></th>
                <th>Sekolah / Jurusan / Kelas</th>
                <th><?php echo lang('created_on'); ?></th>
                <th><?php echo lang('status'); ?></th>
                <th><?php echo lang('actions'); ?></th>
              </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <?php } ?>
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

<!-- Forms for actions -->
<form id="resume-form" method="POST" action="<?php echo base_url(); ?>admin/candidates/resume-download" target='_blank'></form>
<form id="candidates-form" method="POST" action="<?php echo base_url(); ?>admin/candidates/excel" target='_blank'></form>

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script>

</body>
</html>
