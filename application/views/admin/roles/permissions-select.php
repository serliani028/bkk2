<select id='optgroup' multiple='multiple'>
  <?php foreach ($permissions as $key => $values) { ?>
    <optgroup label='<?php echo esc_output($key); ?>'>
      <?php foreach ($values as $k => $v) { ?>
        <option value='<?php echo esc_output($v['id']); ?>' <?php echo esc_output($v['selected']) == 1 ? 'selected="selected"' : ''; ?>>
          <?php echo esc_output($v['title'], 'html'); ?>
        </option>
      <?php } ?>
    </optgroup>
  <?php } ?>
</select>
  