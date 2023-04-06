<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-briefcase"></i> <?php echo lang('jobs'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>perusahaan/admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-briefcase"></i> <?php echo lang('jobs'); ?></li>
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
                  <button type="button" class="btn btn-primary btn-blue btn-flat create-or-edit-job_ph">
                    <i class="fa fa-plus"></i> <?php echo lang('add_job'); ?>
                  </button>
                  
                </div>
                
              
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-striped" id="jobs_datatablePH">
              <thead>
              <tr>
                <th>Pekerjaan</th>
                <th><?php echo lang('department'); ?></th>
                <th><?php echo lang('applications'); ?></th>
                <th>Kategori</th>
                <th><?php echo lang('traits'); ?></th>
                <th><?php echo lang('created_on'); ?></th>
                <th><?php echo lang('status'); ?></th>
                <th><?php echo lang('actions'); ?></th>
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
        <h4 class="modal-title" id="myModalLabel2">Departments</h4>
      </div>
      <div class="modal-body">
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- Forms for actions -->
<form id="jobs-form" method="POST" action="<?php echo base_url(); ?>perusahaan/admin/jobs/excel" target='_blank'></form>

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/company.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/department.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/job.js"></script>

</body>
</html>
