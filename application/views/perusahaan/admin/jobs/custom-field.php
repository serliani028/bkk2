<div class="row custom-value-box">
  <div class="col-md-3 col-sm-12">
    <div class="form-group">
      <input type="hidden" name="custom_field_ids[]" value="<?php echo esc_output($field['custom_field_id']); ?>">
      <label>
        <?php echo lang('label'); ?> 
        <i class="fa fa-trash text-red remove-custom-field" title="Remove Custom Field" data-id="<?php echo esc_output($field['custom_field_id']); ?>"></i>
      </label>
      <input type="text" class="form-control" placeholder="Enter Label" name="labels[]" value="<?php echo esc_output($field['label']); ?>" />
    </div>
  </div>
  <div class="col-md-9 col-sm-12">
    <div class="form-group">
      <label><?php echo lang('value'); ?></label>
      <input type="text" class="form-control" placeholder="Enter Value" name="values[]" value="<?php echo esc_output($field['value']); ?>" />
    </div>
  </div>
</div>