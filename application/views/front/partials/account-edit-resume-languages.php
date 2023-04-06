<div class="row resume-item-edit-box-section language-box">
    <div class="col-md-12 col-lg-12">
      <div class="resume-item-edit-box-section-remove remove-section" 
        data-type="language"
        data-id="<?php echo $language['resume_language_id'] ? encode($language['resume_language_id']) : ''; ?>"
        title="Remove Section">
        <i class="fas fa-trash-alt"></i> Hapus SKill
      </div>
    </div>
    <div class="col-md-12 col-lg-12">
      <div class="form-group form-group-account">
        <label for="">Pilih Jenis Skill yang dimiliki</label>
        <select required class="form-control" name="proficiency[]">
          <option value="">Pilih Jenis Skill</option>
          <?php foreach ($skill as $value): ?>
          <option value="<?=$value->id?>" <?=$value->id == $language['proficiency'] ? 'selected' : ''; ?> ><?=$value->jenis?></option>
          <?php endforeach; ?>
        </select>
        <small class="form-text text-muted">Pilih Jenis Skill yang dimiliki</small>
      </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="form-group form-group-account">
        <label for="">Jelaskan Secara Singkat Skill yang dimiliki *</label>
        <input type="hidden" name="resume_id[]" 
        value="<?php echo $language['resume_id'] ? encode($language['resume_id']) : ''; ?>" />
        <input type="hidden" name="resume_language_id[]" 
        value="<?php echo $language['resume_language_id'] ? encode($language['resume_language_id']) : ''; ?>" />
        <textarea required class="form-control" placeholder="Mahir design grafiis ...." name="title[]"><?php echo esc_output($language['title']); ?></textarea>        
        <small class="form-text text-muted"><?php echo lang('select_language'); ?></small>
        </div>
    </div>
</div>
