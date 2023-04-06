  <!--==========================
    Intro Section
  ============================-->
  <!--<section id="intro" class="clearfix front-intro-section">-->
  <!--  <div class="container">-->
  <!--    <div class="intro-img">-->
  <!--    </div>-->
  <!--    <div class="intro-info">-->
  <!--      <h2><span><?php echo lang('account_activation'); ?></span></h2>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->
  <!-- #intro -->

  <main id="main" style="margin-top:180px; margin-bottom:80px;" >

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
                    <span class="account-box-heading-text"><?php echo lang('account'); ?></span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <?php echo esc_output($content, 'raw'); ?>
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