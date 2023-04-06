  <!--==========================
    Intro Section
  ============================-->
  <!--<section id="intro" class="clearfix front-intro-section">-->
  <!--  <div class="container">-->
  <!--    <div class="intro-img">-->
  <!--    </div>-->
  <!--    <div class="intro-info">-->
  <!--      <h2><span><?php echo lang('forgot_password'); ?></span></h2>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->
  <!-- #intro -->

  <main id="main" style="margin-top:180px">

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
                    <span class="account-box-heading-text"><?php echo lang('forgot_password'); ?></span>
                    <span class="account-box-heading-line"></span>
                  </p>

                  <div class="container">
                    <form id="forgot_form" action="<?php echo base_url(); ?>post-login" method="POST">
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('email'); ?></label>
                          <div class="input-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Email" 
                            aria-label="Email" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_email_to_receive'); ?></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <button type="submit" class="btn btn-success" id="forgot_form_button" title="Save"><?php echo lang('send'); ?></button>
                        </div>
                      </div>
                    </div>
                    </form>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <a href="<?php echo base_url(); ?>login"><?php echo lang('back_to_login'); ?></a>
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
