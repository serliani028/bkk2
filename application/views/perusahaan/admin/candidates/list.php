<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> <?php echo lang('candidates'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> <?php echo lang('candidates'); ?></li>
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
                      <!--<li><a href="#" class="bulk-action" data-action="download-resume"><?php echo lang('download_resume_pdf'); ?></a></li>-->
                      <li><a href="#" class="bulk-action" data-action="download-excel"><?php echo "Download CSV" ?></a></li>
                      <!--<li><a href="#" class="bulk-action" data-action="email"><?php echo lang('email'); ?></a></li>-->
                      <!--<li><a href="#" class="bulk-action" data-action="activate"><?php echo lang('activate'); ?></a></li>-->
                      <!--<li><a href="#" class="bulk-action" data-action="deactivate"><?php echo lang('deactivate'); ?></a></li>-->
                    </ul>
                  </div>
                </div>
                <div class="datatable-top-controls datatable-top-controls-dd">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> <?php echo lang('filter_by_status'); ?></button>
                    </span>
                    <select class="form-control select2" id="status">
                      <option value=""><?php echo lang('all'); ?></option>
                      <option value="1"><?php echo lang('active'); ?></option>
                      <option value="0"><?php echo lang('inactive'); ?></option>
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
              <!--<div class="col-md-12">-->
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
              <!--  </div>-->

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
                <th><?php echo lang('first_name'); ?></th>
                <th><?php echo lang('last_name'); ?></th>
                <th><?php echo lang('email'); ?></th>
                <th><?php echo lang('job_title'); ?></th>
                <th><?php echo lang('experience_months'); ?></th>
                <th><?php echo lang('account_type'); ?></th>
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
