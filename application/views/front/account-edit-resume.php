  <!--==========================
    Intro Section
  ============================-->
  <style>
    @media screen and (max-width:750px) {
    #tes1{
        display:none;
    }
    
    #tes2{
        display:none;
    }
    
    #tes3{
        display:none;
    }
        
    }
  </style>
 
<section style="margin-top:200px;"></section>
  <main id="main">

    <!--==========================
      Account Area Setion
    ============================-->
    <section id="about">
      <div class="container">

        <div class="row mt-10">
          <div class="col-lg-3">
            <div class="account-area-left">
              <ul>
                <?php include(VIEW_ROOT.'/front/partials/account-sidebar.php'); ?>
              </ul>
            </div>
          </div>
          <div class="col-md-9 col-lg-9 col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <section class="edit-resume-section" id="process-tab">
                  <div class="col-xs-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs resume-process-edit more-icon-resume-edit-process" role="tablist" style="background-color:white;whidth:100%">
                     <li></li>
                     <li></li>
                      <li role="presentation" title="Pengalaman" id="achievement-tab">
                        <a href="#resume-achievement" aria-controls="achievement-history" role="tab" data-toggle="tab">
                          <i class="fas fa-award" aria-hidden="true"></i>
                        </a>
                      </li>
                     <li role="presentation" title="Languages" id="language-tab">
                        <a href="#resume-language" aria-controls="resume-language" role="tab" data-toggle="tab">
                          <i class="fa fa-language" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li></li>
                     <li></li>
                     
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane" id="resume-general">
                        <?php include(VIEW_ROOT.'/front/partials/account-edit-resume-general.php'); ?>
                      </div>
                      
                      <div role="tabpanel" class="tab-pane" id="resume-language">
                        <div class="edit-resume-content">
                          <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <div class="account-box">
                                <p class="account-box-heading">
                                  <span class="account-box-heading-text">Kelola Skill</span>
                                  <span class="account-box-heading-line"></span>
                                </p>
                                <div class="container">
                                  <form class="form" id="resume_edit_languages_form">
                                  <div class="section-container">
                                  <?php foreach ($resume['languages'] as $language) { ?>
                                  <?php include(VIEW_ROOT.'/front/partials/account-edit-resume-languages.php'); ?>
                                  <?php } ?>
                                  <div class="row resume-item-edit-box-section no-language-box">
                                    <div class="col-md-12 col-lg-12">
                                      <p>Tidak Ada Skill.</p>
                                      <p> Tambahkan Skill </p>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                      <div class="form-group form-group-account">
                                        <a class="btn btn-primary add-section" title="Add More"
                                          data-id="<?php echo encode($resume['resume_id']); ?>"
                                          data-type="language">
                                          <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="submit" class="btn btn-success" title="Save"
                                          id="resume_edit_languages_form_button">
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
                      </div>
                      <div role="tabpanel" class="tab-pane active" id="resume-achievement">
                        <div class="edit-resume-content">
                          <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <div class="account-box">
                                <p class="account-box-heading">
                                  <span class="account-box-heading-text">Kelola Pengalaman</span>
                                  <span class="account-box-heading-line"></span>
                                </p>
                                <div class="container">
                                  <form class="form" id="resume_edit_achievements_form">
                                  <div class="section-container">
                                  <?php foreach ($resume['achievements'] as $achievement) { ?>
                                  <?php include(VIEW_ROOT.'/front/partials/account-edit-resume-achievements.php'); ?>
                                  <?php } ?>
                                  <div class="row resume-item-edit-box-section no-achievement-box">
                                    <div class="col-md-12 col-lg-12">
                                      <p><?php echo 'Belum Ada Pengalaman'; ?>.</p>
                                      <p> Tambahkan Pengalaman </p>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                      <div class="form-group form-group-account">
                                        <a class="btn btn-primary add-section" title="Add More"
                                          data-id="<?php echo encode($resume['resume_id']); ?>"
                                          data-type="achievement">
                                          <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="submit" class="btn btn-success" title="Save"
                                          id="resume_edit_achievements_form_button">
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
                      </div>
                      <div role="tabpanel" class="tab-pane" id="resume-references">
                        <div class="edit-resume-content">
                          <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <div class="account-box">
                                <p class="account-box-heading">
                                  <span class="account-box-heading-text"><?php echo lang('references'); ?></span>
                                  <span class="account-box-heading-line"></span>
                                </p>
                                <div class="container">
                                  <form class="form" id="resume_edit_references_form">
                                  <div class="section-container">
                                  <?php foreach ($resume['references'] as $reference) { ?>
                                  <?php include(VIEW_ROOT.'/front/partials/account-edit-resume-references.php'); ?>
                                  <?php } ?>
                                  <div class="row resume-item-edit-box-section no-reference-box">
                                    <div class="col-md-12 col-lg-12">
                                      <p><?php echo lang('there_are_no_references'); ?></p>
                                      <p> Tambahkan Form </p>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                      <div class="form-group form-group-account">
                                        <a class="btn btn-primary add-section" title="Add More"
                                          data-id="<?php echo encode($resume['resume_id']); ?>"
                                          data-type="reference">
                                          <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="submit" class="btn btn-success" title="Save"
                                          id="resume_edit_references_form_button">
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
                      </div>
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>
  
  <div class="modal fade upload_file_pendukung" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><b>File Pendukung</b></h3>
      </div>
      <?php echo form_open_multipart($upload_file); ?>
      <div class="modal-body">
      <input type="hidden" id="id_file" name="id">
      <input type="hidden" id="id_resume" name="id_resume">
      <label style="padding-bottom:5px"><b>Pilih Jenis File Pendukung *</b></label>
      <select required class="form-control" id="type_file" name="type" required>
        <option value="">Pilih Jenis File</option>
        <option value="certificate"><?php echo lang('certificate'); ?></option>
        <option value="portfolio"><?php echo lang('portfolio'); ?></option>
        <option value="publication"><?php echo lang('publication'); ?></option>
        <option value="award"><?php echo lang('award'); ?></option>
        <option value="other"><?php echo lang('other'); ?></option>
      </select>
      <br>
      <br>
      <br>
      <br>
    <label style="padding-bottom:5px;padding-top:15px"><b>| FIle Pendukung | <a href="" id="file_ach" style="display:none">Lihat FIle Pengalaman </a></b></label>
      <input type="file" required name="file" class="form-control">
    </div>
    
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Simpan">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
       <?php echo form_close(); ?>
      
    </div>
  </div>
</div>

  <?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>
