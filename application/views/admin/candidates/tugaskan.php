<form id="admin_candidate_tugaskan_form">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
            <select class="form-control select2" name="job_id" required="1">
                <option value="">Pilih Penugasan</option>
                <?php foreach ($jobs as $value): ?>
                    <option value="<?=$value->job_id;?>"><?=$value->title;?></option>
                <?php endforeach; ?>
            </select>
        </div>
      </div>
    </div>          
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_candidate_tugaskan_form_button">
      <?php echo lang('send'); ?>
    </button>
  </div>
</form>
