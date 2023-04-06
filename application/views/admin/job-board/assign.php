<form id="admin_job_board_assign_form">
  <input type="hidden" name="candidates" id="candidates" />
  <input type="hidden" name="type" value="<?php echo esc_output($type); ?>" />
  <input type="hidden" name="job_id" value="<?php echo esc_output($job_id); ?>" />
  <div class="modal-body">
    <div class="row">
      <?php if ($type == 'quiz') { ?>
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('quizes'); ?></label>
          <select class="form-control select2" name="quiz_id">
            <?php if ($quizes) { ?>
            <?php foreach ($quizes as $quiz) { ?>
            <option value="<?php echo esc_output($quiz['quiz_id']); ?>"><?php echo esc_output($quiz['title'], 'html'); ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      
      <?php } else if ($type == 'psikotes') { ?>
      
      <div class="col-md-12">
        <div class="form-group">
          <label>Batch Psikotest</label>
          <select class="form-control select2" name="id_psikotes">
            <?php if ($batch) { ?>
            <?php foreach ($batch as $val) { ?>
            <option value="<?php echo esc_output($val['id']); ?>"><?php echo esc_output($val['nama'], 'html'); ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
     
      <?php } else { ?>
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('team_member'); ?></label>
          <select class="form-control select2" name="user_id">
            <?php if ($users) { ?>
            <?php foreach ($users as $user) { ?>
            <option value="<?php echo esc_output($user['user_id']); ?>"><?php echo esc_output($user['first_name'].' '.$user['last_name'], 'html'); ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
     
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('date_time'); ?></label>
          <input type="text" class="form-control datetimepicker" name="interview_time" />
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('description'); ?></label>
          <select name="description" class="form-control">
            <option value="">Pilih Link Zoom</option>
            <?php
            foreach ($link as $baris) {
            ?>
              <option value="<?=$baris->link;?>"> <?=$baris->nama;?> </option>
            <?php
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-md-12" style="display:none">
        <div class="form-group">
          <input type="checkbox" class="minimal" name="notify_candidate" />
          <label><?php echo lang('send_email_candidate'); ?></label>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_job_board_assign_form_button"><?php echo lang('save'); ?></button>
  </div>
</form>
