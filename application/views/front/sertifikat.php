<!--==========================
  Intro Section
============================-->
<section id="intro" class="clearfix front-intro-section">
  <div class="container">
    <div class="intro-img">
    </div>
    <div class="intro-info">
      <?php if (setting('enable-multiple-resume') == 'yes') { ?>
      <h2><span><?php echo lang('account'); ?> > <?php echo lang('resumes'); ?> > <?php echo esc_output($resume['title']); ?></span></h2>
      <?php } else { ?>
      <h2><span><?php echo lang('account'); ?> > <?php echo substr(lang('resumes'), 0,-1); ?></span></h2>
      <?php } ?>
    </div>
  </div>
</section><!-- #intro -->

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

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="resume-general">
                      <div class="edit-resume-content">
                        <div class="row">
                          <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="account-box" style="padding:10px">
                              <p class="account-box-heading">
                                <span class="account-box-heading-text">Portofolio <small style="color:red"> </small></span>
                                <span class="account-box-heading-line"></span>
                              </p>
                              <div class="container">
                                <?php if ($jobs) { ?>
                                <?php foreach ($jobs as $baris) {?>
                                  <div class="form-group form-group-account">
                                    <i class="fa fa-file-pdf"></i> <?php echo $baris->nama_kandidat."-".$baris->judul_sertifikat.".pdf";?>
                                    <small class="form-text text-muted">
                                      <a target="_blank" href="<?=base_url('/upload/sertifikat/'.$baris->file);?>" style="color:blue"><b>Download</b></a> |
                                      <a href="<?=base_url('hapus-sertifikat/'.$baris->id_sertifikat);?>" style="color:red"><b>Hapus</b></a></small>
                                  </div>
                                <?php
                              }?>
                              <br>
                              <button class="btn btn-success" id="btn-tambah"><i class="fa fa-plus"></i> Tambah </button>
                              <button class="btn btn-danger" id="btn-batal1"><i class="fa fa-window-close"></i> Batal </button>
                              <br>
                              <form class="form" action="<?=base_url('create-sertifikat')?>" method="post" enctype="multipart/form-data" id="form_2">
                              <div class="row resume-item-edit-box-section">
                                  <div class="col-md-12 col-lg-12">
                                    <div class="form-group form-group-account">
                                      <input type="hidden" name="id" value="<?php echo $this->session->userdata('candidate')['candidate_id']; ?>" />
                                      <input type="hidden" name="name" value="<?php echo $this->session->userdata('candidate')['first_name']; ?>" />
                                    </div>
                                    <div class="form-group form-group-account">
                                      <label for="input-file-now-custom-1">
                                        Judul Sertifikat
                                      </label>
                                      <input type="text" required="1" name="judul" class="form-control">
                                      <small class="form-text text-muted">Judul Sertifikat</small>
                                    </div>
                                    <div class="form-group form-group-account">
                                        <label for="input-file-now-custom-1">
                                          Bidang Keahlian <small style="color:red">  </small>
                                        </label>
                                        <!-- <input type="text" required="1" name"judul" class="form-control"> -->
                                        <select name="nama_kelas" class="form-control" required="1">
                                          <option value="">
                                            Pilih Bidang
                                          </option>
                                          <?php
                                          foreach ($kelas as $baris) {
                                          ?>
                                          <option value="<?=$baris->id;?>">
                                            <?=$baris->nama_kelas;?>
                                          </option>
                                          <?php
                                          }
                                          ?>
                                        </select>
                                        <small class="form-text text-muted">Asal kelas</small>
                                      </div>
                                    <div class="form-group form-group-account">
                                      <label for="input-file-now-custom-1">
                                        <?php echo lang('file'); ?>
                                      </label>
                                      <input type="file" required="1" id="input-file-now-custom-1" class="dropify"
                                      data-default-file="" name="file" />
                                      <small class="form-text text-muted"><?php echo lang('only_doc_docx_pdf_allowed'); ?></small>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12 col-lg-12">
                                  <div class="form-group form-group-account">
                                    <button type="submit" class="btn btn-success" title="Save" id="button_sertifkat_2">
                                      <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
                                    </button>
                                  </div>
                                </div>
                              </div>
                              </form>
                            <?php }else{?>
                                <form class="form" id="sertifikat">
                                <div class="row resume-item-edit-box-section">
                                    <div class="col-md-12 col-lg-12">
                                      <div class="form-group form-group-account">
                                        <input type="hidden" name="id" value="<?php echo $this->session->userdata('candidate')['candidate_id']; ?>" />
                                        <input type="hidden" name="name" value="<?php echo $this->session->userdata('candidate')['first_name']; ?>" />
                                      </div>
                                      <div class="form-group form-group-account">
                                        <label for="input-file-now-custom-1">
                                          Judul Sertifikat <small style="color:red">* </small>
                                        </label>
                                        <input type="text" required="1" name="judul" class="form-control">
                                        <small class="form-text text-muted">Judul Sertifikat</small>
                                      </div>
                                      <div class="form-group form-group-account">
                                        <label for="input-file-now-custom-1">
                                          Bidang Keahlian <small style="color:red">  </small>
                                        </label>
                                        <!-- <input type="text" required="1" name"judul" class="form-control"> -->
                                        <select name="nama_kelas" class="form-control" required="1">
                                          <option value="">
                                            Pilih Bidang
                                          </option>
                                          <?php
                                          foreach ($kelas as $baris) {
                                          ?>
                                          <option value="<?=$baris->id;?>">
                                            <?=$baris->nama_kelas;?>
                                          </option>
                                          <?php
                                          }
                                          ?>
                                        </select>
                                        <small class="form-text text-muted">Asal kelas</small>
                                      </div>
                                      <div class="form-group form-group-account">
                                        <label for="input-file-now-custom-1">
                                          <?php echo lang('file'); ?><small style="color:red"> *</small>
                                        </label>
                                        <input type="file" required="1" id="input-file-now-custom-1" class="dropify"
                                        data-default-file="" name="file" />
                                        <small class="form-text text-muted"><?php echo lang('only_doc_docx_pdf_allowed'); ?></small>
                                      </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 col-lg-12">
                                    <div class="form-group form-group-account">
                                      <button type="submit" class="btn btn-success" title="Save" id="button_sertifikat">
                                        <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
                                      </button>
                                    </div>
                                  </div>
                                </div>
                                </form>
                                <?php
                                }
                                ?>
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

<?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>

<script>

$(document).ready(function(){
$("#form_2").css("display", "none");
$("#btn-batal1").css("display", "none");
$("#btn-tambah").click(function(){
  $("#btn-tambah").css("display", "none");
  $("#btn-batal1").css("display", "block");
  $("#form_2").css("display", "block");
});

$("#btn-batal1").click(function(){
  $("#btn-tambah").css("display", "block");
  $("#form_2").css("display", "none");
  $("#btn-batal1").css("display", "none");
});

});

</script>
