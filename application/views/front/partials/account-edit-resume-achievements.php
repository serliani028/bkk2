<div class="row resume-item-edit-box-section achievement-box">
  <div class="col-md-12 col-lg-12">
    <div class="resume-item-edit-box-section-remove remove-section"
      data-type="achievement"
      data-id="<?php echo $achievement['resume_achievement_id'] ? encode($achievement['resume_achievement_id']) : ''; ?>"
      title="Remove Section">
      <i class="fas fa-trash-alt"></i> Hapus Data
    </div>
    <?php if($achievement['resume_achievement_id']){
    if($achievement['file'] != ''){
        $file = base_url().'assets/pengalaman/'.$achievement['file'];
    }else{
        $file = '';
    }
    ?>
    <div class="resume-item-edit-box-section-remove file_pelengkap"
      data-type="achievement" style="background-color:green"
      data-id="<?php echo $achievement['resume_achievement_id']?>"
      data-id_resume="<?php echo $achievement['resume_id']?>"
      data-type_file="<?php echo $achievement['type']?>"
      data-file="<?=$file?>"
      title="Remove Section">
      <i class="fas fa-plus"></i> File Pelengkap
    </div>
    <?php } ?>
  </div>
  <div class="col-md-6 col-lg-6">
    <div class="form-group form-group-account">
      <label for="">Jenis Pengalaman *</label>
      <input type="hidden" name="resume_id[]"
      value="<?php echo $achievement['resume_id'] ? encode($achievement['resume_id']) : ''; ?>" />
      <input type="hidden" name="resume_achievement_id[]"
      value="<?php echo $achievement['resume_achievement_id'] ? encode($achievement['resume_achievement_id']) : ''; ?>" />
      <select class="form-control" required name="link[]">
          <option value="">Pilih Jenis Pengalaman</option>
          <?php foreach ($pengalaman as $value): ?>
          <option value="<?=$value->id?>" <?=$value->id == $achievement['link'] ? 'selected' : ''; ?> ><?=$value->jenis?></option>
          <?php endforeach; ?>
      </select>
      <small class="form-text text-muted">Masukkan Jenis Pengalaman </small>
    </div>
    <!--<div class="form-group form-group-account">-->
    <!--  <label for=""><?php echo lang('select_type'); ?> File Pendukung *</label>-->
    <!--  <select required class="form-control" name="type[]">-->
    <!--    <option value="certificate" <?php sel('certificate', $achievement['type']); ?>><?php echo lang('certificate'); ?></option>-->
    <!--    <option value="portfolio" <?php sel('portfolio', $achievement['type']); ?>><?php echo lang('portfolio'); ?></option>-->
    <!--    <option value="publication" <?php sel('publication', $achievement['type']); ?>><?php echo lang('publication'); ?></option>-->
    <!--    <option value="award" <?php sel('award', $achievement['type']); ?>><?php echo lang('award'); ?></option>-->
    <!--    <option value="other" <?php sel('other', $achievement['type']); ?>><?php echo lang('other'); ?></option>-->
    <!--  </select>-->
    <!--  <small class="form-text text-muted"><?php echo lang('select_type'); ?> File Pendukung</small>-->
    <!--</div>-->
  </div>
  <div class="col-md-6 col-lg-6">
    <div class="form-group form-group-account">
      <label for="">Pengalaman *</label>
      <input type="text" required class="form-control" placeholder="Ketua Organisasi ..." name="title[]"
        value="<?php echo esc_output($achievement['title']); ?>">
      <small class="form-text text-muted">Masukkan Judul Pengalaman</small>
    </div>
    <!--<div class="form-group form-group-account">-->
    <!--  <label for="">File Pendukung * (PDF,IMAGE, Maks. 1MB)</label>-->
    <!--  <input type="file" class="form-control" required name="file[]">-->
    <!--  <small class="form-text text-muted">Masukkan File Pendukung</small>-->
    <!--</div>-->
  </div>
  <div class="col-md-12 col-lg-12">
    <div class="form-group form-group-account">
      <label for=""><?php echo lang('description'); ?> Singkat *</label>
      <textarea required class="form-control" placeholder="Ex : Saya menjadi Ketua Organisasi mulai dari tahun ..." name="description[]"><?php echo esc_output($achievement['description'], 'textarea'); ?></textarea>
      <small class="form-text text-muted">Masukkan Deskripsi</small>
    </div>
  </div>
</div>