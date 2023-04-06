<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-cube"></i> <?php echo lang('departments'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>perusahaan/admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-briefcase"></i> <?php echo lang('jobs'); ?></li>
      <li class="active"><i class="fas fa-cube"></i> <?php echo lang('departments'); ?></li>
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
                  <button type="button" class="btn btn-primary btn-blue btn-flat create-or-edit-department_ph">
                    <i class="fa fa-plus"></i> <?php echo lang('add_department'); ?>
                  </button>
                 </div>
               </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          
            <table class="table table-bordered table-striped" id="departments_datatable_ph">
              <thead>
              <tr>
                <!--<th><input type="checkbox" class="minimal all-check"></th>-->
                <!--<th><?php echo lang('image'); ?></th>-->
                <th><?php echo lang('title'); ?> Department</th>
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

<?php include(VIEW_ROOT.'/perusahaan/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/department.js"></script>

</body>
</html>

