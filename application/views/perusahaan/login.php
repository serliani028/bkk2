  <!--==========================
    Intro Section
  ============================-->
  <!-- <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2><span><?php echo lang('login_to_account'); ?></span></h2>
      </div>
    </div>
  </section> -->
  <!-- #intro -->

  <main id="main" style="margin-top:120px">

    <!--==========================
      Account Area Setion
    ============================-->
    <section class="main-container">
      <div class="container">
        <div class="row mt-10">
          <div class="col-lg-3">
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="account-box">
                  <p class="account-box-heading">
                    <span class="account-box-heading-text"><?php echo lang('login'); ?> Mitra Kampus</span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <?php echo form_open_multipart($action); ?>
                  <div class="container">
                    <?php include('messages.php'); ?>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('email'); ?></label>
                          <div class="input-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="<?php echo lang('email'); ?>"
                            aria-label="<?php echo lang('email'); ?>" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_email'); ?>.</small>
                        </div>
                      </div>
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('password'); ?></label>
                          <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password'); ?>"
                            aria-label="Email" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_password'); ?>.</small>
                        </div>
                      </div>
                    
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <button type="submit" class="btn btn-success"><?php echo lang('login'); ?></button>
                        </div>
                      </div>
                    </div>
                  </div>
                    <?php echo form_close(); ?>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <?php if (setting('enable-forgot-password') == 'yes') { ?>
                          <a href="<?php echo base_url(); ?>forgot-password"><?php echo lang('forgot_password'); ?> </a><br />
                          <?php } ?>
                         
                        </div>
                      </div>
                    </div>
                  </div>
                
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
          </div>
        </div>
      </div>
    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>
