
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-briefcase"></i> <?php echo lang('jobs'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>perusahaan/admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-briefcase"></i> <?php echo lang('job'); ?></li>
      <li class="active"><?php echo lang('create'); ?></li>
    </ol>
  </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('details'); ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="admin_job_create_update_form_ph">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label><?php echo lang('title'); ?> Pekerjaan</label>
                      <input type="hidden" name="job_id" value="<?php echo esc_output($job['job_id']); ?>" />
                      <input type="text" class="form-control" placeholder="Enter Title" name="title"
                      value="<?php echo esc_output($job['title']); ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label><?php echo lang('status'); ?></label>
                      <select class="form-control" name="status">
                        <option value="1" <?php sel($job['status'], 1); ?>><?php echo lang('active'); ?></option>
                        <option value="0" <?php sel($job['status'], 0); ?>><?php echo lang('inactive'); ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12" style="display:none">
                    <div class="form-group">
                      <label><?php echo lang('is_static_allowed'); ?></label>
                      <select class="form-control" name="is_static_allowed" disabled="1">
                        <option value="0" <?php sel($job['is_static_allowed'], 0); ?>><?php echo lang('no'); ?></option>
                        <option value="1" <?php sel($job['is_static_allowed'], 1); ?>><?php echo lang('yes'); ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label>Kategori Pekerjaan</label>
                      <select class="form-control" name="id_kategori" required="1">
                        <option value=""><?php echo lang('none'); ?></option>
                        <?php foreach ($kategori as $key => $value) { ?>
                          <option value="<?php echo esc_output($value['id']); ?>" <?php sel($job['id_kategori'], $value['id']); ?>><?php echo esc_output($value['nama_kategori'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label>
                        <?php echo lang('companies'); ?>
                      </label>
                      <input type="text" class="form-control" placeholder="Enter Title" id="companies" name="company_id"
                      value="<?php echo $this->session->userdata('company')['company_id']; ?>" style="display:none">
                      
                      <input type="text" class="form-control" value="<?php echo $this->session->userdata('company')['title']; ?>" readonly="1">
                    
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12" >
                    <div class="form-group">
                      <label>
                        <?php echo lang('departments'); ?>
                        
                      </label>
                      <select class="form-control select2" id="departments_ph" name="department_id">
                        <option value=""><?php echo lang('none'); ?></option>
                        <?php foreach ($departments as $key => $value) { ?>
                          <option value="<?php echo esc_output($value['department_id']); ?>" <?php sel($job['department_id'], $value['department_id']); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label>
                        Level Jabatan
                    </label>
                      <select class="form-control select2"  name="status_minat">
                        <option value=""><?php echo lang('none'); ?></option>
                        <?php foreach ($level as $key => $value) { ?>
                          <option value="<?php echo esc_output($value['id']); ?>" <?php sel($job['status_minat'], $value['id']); ?>><?php echo esc_output($value['level'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    
               
                    <div class="form-group">
                        <br>
                      <label><?php echo lang('description'); ?></label>
                      <textarea id="description" name="description" rows="10" cols="80">
                        <?php echo esc_output($job['description'], 'textarea'); ?>
                      </textarea>
                    </div>
                  </div>
                  <div class="col-md-12" style="display:none">
                    <hr />
                    <div class="form-group">
                      <label>
                        <?php echo lang('custom_fields'); ?>
                        <button type="button" class="btn btn-xs btn-warning btn-blue add-custom-field" title="Add Custom Field">
                          <i class="fa fa-plus"></i>
                        </button>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 custom-fields-container" style="display:none">
                    <?php foreach ($fields as $field) { ?>
                    <?php include(VIEW_ROOT.'/admin/jobs/custom-field.php'); ?>
                    <?php } ?>
                    <div class="row resume-item-edit-box-section no-custom-value-box">
                      <div class="col-md-12 col-lg-12">
                        <p><?php echo lang('no_custom_fields'); ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <hr />
                    <div class="form-group">
                      <label><?php echo lang('traits'); ?></label>
                      <select class="form-control select2" id="traits[]" name="traits[]" multiple="multiple">
                        <?php foreach ($traits as $key => $value) { ?>
                          <?php $jobTraits = $job['traits'] ? explode(',', $job['traits']) : array(); ?>
                          <option value="<?php echo esc_output($value['trait_id']); ?>" <?php sel($value['trait_id'], $jobTraits); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                      <br />
                      <br />
                      <b><?php echo lang('notes'); ?></b><br />
                      <ul>
                        <li><?php echo lang('traits_can_not_be_assigned'); ?></li>
                        <li><?php echo lang('traits_can_only_be_answerd'); ?></li>
                        
                         <!--<li><?php echo lang('traits_can_be_assigned'); ?> CV Pelamar</li>-->
                        <li><?php echo lang('traits_can_be_assigned_only_after'); ?> CV Pelamar</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-sm-12" style="display:none"> 
                    <hr />
                    <div class="form-group">
                      <label><?php echo lang('quizes'); ?></label>
                      <select class="form-control select2" id="quizes[]" name="quizes[]" multiple="multiple">
                        <?php foreach ($quizes as $key => $value) { ?>
                          <?php $jobQuizes = $job['quizes'] ? explode(',', $job['quizes']) : array(); ?>
                          <option value="<?php echo esc_output($value['quiz_id']); ?>" <?php sel($value['quiz_id'], $jobQuizes); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                      <br />
                      <br />
                      <b><?php echo lang('notes'); ?></b><br />
                      <ul>
                        <li><?php echo lang('quizes_can_be_assigned'); ?></li>
                        <li><?php echo lang('quizes_are_attached_to'); ?></li>
                        <li><?php echo lang('quizes_assigned_from_here'); ?></li>
                        <li><?php echo lang('additional_quizes_can_be'); ?></li>
                      </ul>
                    </div>
                  </div>
                 
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="admin_job_create_update_form_button_ph">
                  <?php echo lang('save'); ?>
                </button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include(VIEW_ROOT.'/perusahaan/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/company.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/department.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/job.js"></script>


</body>
</html>
