<div class="edit-resume-content">
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
      <div class="account-box">
        <p class="account-box-heading">
          <span class="account-box-heading-text">Data Kelengkapan Pelamar</span>
          <span class="account-box-heading-line"></span>
        </p>
        <div class="container">
          <form class="form" id="resume_edit_general_form">
          <div class="row resume-item-edit-box-section">
              <div class="col-md-12 col-lg-12">
                <!--<div class="form-group form-group-account">-->
                <!--  <label for="">Nama File CV</label>-->
                  <!--<?php echo lang('title'); ?>-->
                  <input type="hidden" name="id" value="<?php echo encode($resume['resume_id']); ?>" />
                <!--  <input type="text" class="form-control" placeholder="Cth : Ryanto_cv"-->
                <!--  name="title" value="<?php echo esc_output($resume['title']); ?> ">-->
                <!--  <small class="form-text text-muted">Masukkan Nama File CV Anda</small>-->
                  <!--<?php echo lang('enter_title'); ?>-->
                  <!--ini untuk label general--> 
                <!--</div>-->
                <!--<div class="form-group form-group-account">-->
                <!--  <label for=""><?php echo lang('designation'); ?></label>-->
                <!--  <input type="text" class="form-control" placeholder="Cth : Sekretaris dll"-->
                <!--  name="designation" value="<?php echo esc_output($resume['designation']); ?> ">-->
                  <!--komen value designation-->
                <!--  <small class="form-text text-muted"><?php echo lang('enter_designation'); ?></small>-->
                <!--</div>-->
                <!--<div class="form-group form-group-account">-->
                <!--  <label for=""><?php echo lang('objective'); ?></label>-->
                <!--  <textarea class="form-control" placeholder="Cth : karena saya merasa bisa memberi efort lebih dsb"-->
                <!--  name="objective" ><?php echo esc_output($resume['objective']); ?> </textarea>-->
                  <!--komen value objektif-->
                <!--  <small class="form-text text-muted"><?php echo lang('enter_objective'); ?>.</small>-->
                <!--</div>-->
                <div class="form-group form-group-account"  <?php if (empty($resume['file']) || $resume['file'] == "kosong" ) { ?>  style="background-color:#db9197;padding:5px" <?php } ?>>
                  <label for="input-file-now-custom-1">
                   File Curriculum Vitae (CV)
                    <?php if ($resume['file'] && $resume['file'] != "kosong") { ?>
                    <a target="_blank" href="<?php echo candidateThumb($resume['file']); ?>" title="Download">
                      Lihat CV
                    </a>
                    <?php }else{ ?>
                     <b style="color:red">* Belum diisi</b>
                    <?php } ?>
                  </label>
                  <input type="file" id="input-file-now-custom-1" class="dropify" <?php if (empty($resume['file']) || $resume['file'] == "kosong" ) { ?>  required="1" <?php } ?>
                  data-default-file="<?php echo candidateThumb($resume['file']); ?>" name="file" />
                  <small class="form-text text-muted"><?php echo lang('only_doc_docx_pdf_allowed'); ?></small>
                </div> 
                
                
                 <?php  if($this->session->userdata('candidate')['account_type'] == "umum" || $this->session->userdata('candidate')['account_type'] == "site" ){ ?>
                 <div class="form-group form-group-account" <?php if (empty($resume['skck'])) { ?>  style="background-color:#a1aff7;padding:5px" <?php } ?>>
                  <label for="input-file-now-custom-1">
                   SKCK (Surat Keterangan Catatan Kepolisian)
                    <?php if ($resume['skck']) { ?>
                    <a target="_blank" href="<?php echo candidateThumb($resume['skck']); ?>" title="Download">
                      Lihat File
                    </a>
                   <?php }else{ ?>
                    <b style="color:red">* Belum diisi</b>
                    <?php } ?>
                    
                  </label>
                  <input type="file"  class="dropify"
                  data-default-file="<?php echo candidateThumb($resume['skck']); ?>" name="skck" />
                  <small class="form-text text-muted"><?php echo lang('only_doc_docx_pdf_allowed'); ?></small>
                </div> 
                
                <div class="form-group form-group-account" <?php if (empty($resume['skck'])) { ?>  style="background-color:#a1aff7;padding:5px" <?php } ?>>
                  <label for="input-file-now-custom-1">
                   Surat Keterangan Pernah Bekerja (Pekerjaan Terakhir)
                    <?php if ($resume['sk_covid']) { ?>
                    <a target="_blank" href="<?php echo candidateThumb($resume['sk_covid']); ?>" title="Download">
                      Lihat File
                    </a>
                    <?php }else{ ?>
                    <b style="color:blue">* Optional (Diisi jika pernah bekerja sebelumnya)</b>
                    <?php } ?>
                  </label>
                  <input type="file" id="input-file-now-custom-1" class="dropify"
                  data-default-file="<?php echo candidateThumb($resume['sk_covid']); ?>" name="sk_covid" />
                  <small class="form-text text-muted"><?php echo lang('only_doc_docx_pdf_allowed'); ?></small>
                </div> 
                
                <div class="form-group form-group-account" style="display:none">
                  <label for=""><?php echo lang('status'); ?></label>
                  <select class="form-control" name="status" disabled >
                    <option value="1" <?php sel($resume['status'], '1'); ?>><?php echo lang('active'); ?></option>
                   <!-- <option value="0" <?php sel($resume['status'], '0'); ?>><?php echo lang('inactive'); ?></option> -->
                  </select>
                  <small class="form-text text-muted"><?php echo lang('select_status'); ?></small>
                </div>
                
               <?php } ?>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group form-group-account">
                <button type="submit" class="btn btn-success" title="Save" id="resume_edit_general_form_button">
                  <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
                </button>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
