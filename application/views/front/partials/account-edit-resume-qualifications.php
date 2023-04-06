<div class="row resume-item-edit-box-section qualification-box">
  <div class="col-md-12 col-lg-12">
    <div class="resume-item-edit-box-section-remove remove-section" 
      data-type="qualification"
      data-id="<?php echo $qualification['resume_qualification_id'] ? encode($qualification['resume_qualification_id']) : ''; ?>"
      title="Remove Section">
      <i class="fas fa-trash-alt"></i> <?php echo lang('remove_section'); ?>
    </div>
  </div>
  <div class="col-md-6 col-lg-6">
    <div class="form-group form-group-account">
      <label for="">Gelar Terakhir *</label>
      <input type="hidden" name="resume_id[]" 
      value="<?php echo $qualification['resume_id'] ? encode($qualification['resume_id']) : ''; ?>" />
      <input type="hidden" name="resume_qualification_id[]" 
      value="<?php echo $qualification['resume_qualification_id'] ? encode($qualification['resume_qualification_id']) : ''; ?>" />
      <!--<input type="text" -->
      <!--  value="<?php echo esc_output($qualification['title']); ?>">-->
        <select class="form-control" name="title[]" >
            <option value=""> Pilih Gelar</option>
            <?php
            $data = array("SMA", "D2", "D3", "D4", "S1", "S2", "S3", "Lainnya");
            foreach ($data as $baris) {
            ?>
            <option <?php if ($baris == $qualification['title']) echo 'selected' ; ?>> <?=$baris;?> </option>
            <?php
            }
            ?>
        </select>
      <small class="form-text text-muted"><?php echo lang('enter_degree_title'); ?></small>
    </div>
    <!--<div class="form-group form-group-account">-->
    <!--  <label for=""><?php echo lang('percentage_cgpa_marks'); ?> *</label>-->
    <!--  <input type="text" class="form-control" placeholder="70" name="marks[]" -->
    <!--    value="<?php echo esc_output($qualification['marks']); ?>">-->
    <!--  <small class="form-text text-muted"><?php echo lang('enter_percentage_cgpa_marks'); ?></small>-->
    <!--</div>-->
    <!--<div class="form-group form-group-account">-->
    <!--  <label for=""><?php echo lang('from'); ?> *</label>-->
    <!--  <input type="text" class="form-control datepicker" placeholder="29-12-1985" name="from[]" -->
    <!--    value="<?php echo dateOnly($qualification['from']); ?>">-->
    <!--  <small class="form-text text-muted"><?php echo lang('start_date_of_degree'); ?></small>-->
    <!--</div>-->
  </div>
  <div class="col-md-6 col-lg-6">
    <div class="form-group form-group-account">
      <label for=""><?php echo lang('institutuion'); ?> *</label>
      <input type="text" class="form-control" placeholder="Universitas/Sekolah" name="institution[]" 
        value="<?php echo esc_output($qualification['institution']); ?>">
      <small class="form-text text-muted"><?php echo lang('enter_institutuion'); ?></small>
    </div>
    <!--<div class="form-group form-group-account">-->
    <!--  <label for=""><?php echo lang('out_of'); ?> *</label>-->
    <!--  <input type="text" class="form-control" placeholder="100 or 4.0" name="out_of[]" -->
    <!--    value="<?php echo esc_output($qualification['out_of']); ?>">-->
    <!--  <small class="form-text text-muted"><?php echo lang('total_of_percentage_or_cgpa'); ?>.</small>-->
    <!--</div>-->
    <!--<div class="form-group form-group-account">-->
    <!--  <label for=""><?php echo lang('to'); ?> *</label>-->   
    <!--  <input type="text" class="form-control datepicker" placeholder="29-12-1985" name="to[]" -->
    <!--    value="<?php echo dateOnly($qualification['to']); ?>">-->
    <!--  <small class="form-text text-muted"><?php echo lang('end_date_of_degree'); ?></small>-->
    <!--</div>-->
  </div>
  <div class="col-md-12 col-lg-12">
    <div class="form-group form-group-account">
      <label for="">File Ijazah Terakhir * (.pdf)</label>
      <input type="file" class="form-control" placeholder="File Ijazah (.pdf)" name=marks[]" 
        value="<?php echo esc_output($qualification['marks']); ?>">
      <small class="form-text text-muted">Ijazah (.pdf)</small>
    </div>
    </div>
</div>