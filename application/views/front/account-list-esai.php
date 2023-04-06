      <!--==========================
    Intro Section
  ============================-->
  <!--<section id="intro" class="clearfix front-intro-section">-->
  <!--  <div class="container">-->
  <!--    <div class="intro-img">-->
  <!--    </div>-->
      <!--<div class="intro-info">-->
      <!--  <h2><span><?php echo lang('account'); ?> > <?php echo lang('job_applications'); ?></span></h2>-->
      <!--</div>-->
  <!--  </div>-->
  <!--</section><!-- #intro -->

  <main id="main" style="margin-top:180px; margin-bottom:50px;">

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
            <?php if ($esai) { ?>
            <?php foreach ($esai as $job) { ?>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="job-listing">
                  <p class="job-listing-heading">
                    <span class="job-listing-heading-text">
                      <?php echo esc_output($job['interview_title'], 'html'); ?>
                    </span>
                    <span class="job-listing-heading-line"></span>
                  </p>
                  
                  <?php include('partials/messages.php'); ?>
                  <p class="job-listing-job-info">
                    <span class="job-listing-job-info-date"><i class="fa fa-clock-o"></i> Ditugaskan : <?php echo timeFormat($job['created_at']); ?></span> 
                  </p>
                  <div class="job-listing-job-description">
                      <br>
                    <?php echo $job['description']; ?>
                  </div>
                 <br>
                    <div class="row job-application-progress">
                        
                         <!--<div class="col-md-12 job-application-progress-step ">-->
                           <?php if ($job['status'] == 0) {?>
                            <a class="btn btn-warning" style="color:white" href="<?php echo base_url(); ?>account/tes-seleksi-esai/<?php echo encode($job['candidate_interview_id']); ?>">Selesaikan Tes Esai</a>
                            <?php }else{ ?>
                            <a class="btn btn-success" href="#">Tes Esai Selesai</a>
                           <?php } ?>
                          <!--<a href="#" class="job-application-progress-dot"></a>-->
                        <!--  <div class="job-application-progress-info text-center"></div>-->
                        <!--</div>-->
                        
                    </div>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php } else { ?>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="job-detail account-no-content-box">
                  Belum Ada Tes Esai   
                  <br>
                  <br>
                </div>
              </div>
            </div>
            <?php } ?>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <?php echo esc_output($pagination, 'raw'); ?>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>
