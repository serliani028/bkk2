<div class="row">
<div class="col-md-12">
  <div class="box box-solid">
    <!-- /.box-header -->
    <div class="box-body">
      <?php if ($type == 'detailed') { ?>
      <form id="resume-form" method="POST" action="<?php echo base_url(); ?>perusahaan/admin/candidates/resume-download">
        <input type="hidden" name="csrf_token" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <input type="hidden" name="ids" value="<?php echo esc_output($resume_id); ?>">
        <button type="submit" class="btn btn-primary">Download Biodata Kandidat</button>
      </form>
      <br>
      <?php echo esc_output($resume, 'raw'); ?>
      <?php } else { ?>
        <a class="btn btn-warning" target="_blank" 
            href="<?php echo base_url(); ?>assets/images/candidates/<?php echo esc_output($file); ?>" title="<?php echo lang('download'); ?>">
          <i class="fa fa-file"></i> Download Biodata Kandidat
        </a>
        <br />
        Note : This is static / file based resume.
      <?php } ?>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- ./col -->
</div>