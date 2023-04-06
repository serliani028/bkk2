<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Peserta (Unverif)<small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Peserta (Unverif)</li>
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
                    <button type="button" class="btn btn-primary btn-blue btn-flat">Beri <?php echo lang('actions'); ?> Kandidat</button>
                    <button type="button" class="btn btn-primary btn-blue btn-flat dropdown-toggle"
                      data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#" class="bulk-action_unverif" data-action="deactivate"><?php echo lang('deactivate'); ?></a></li>
                    </ul>
                  </div>
                </div>
               
                
              </div>
            </div>
            <div class="row">
             
            </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?php if (allowedTo('view_candidate_listing')) { ?>
            <table class="table table-bordered table-striped" id="candidates_datatable_unverif">
              <thead>
              <tr>
                <th><input type="checkbox" class="minimal all-check_unverif"></th>
                <th>Nama Kandidat</th>
                <th><?php echo lang('email'); ?></th>
                <th><?php echo lang('created_on'); ?></th>
                <th>Data Verifikasi</th>
                <th>Tipe Akun</th>
                <th>Status</th>
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
</div>



<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script>


</body>
</html>
