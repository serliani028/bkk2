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
            <?php if ($jobs) { ?>
            <?php foreach ($jobs as $job) { ?>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="job-listing">
                  <p class="job-listing-heading">
                    <span class="job-listing-heading-text">
                      <?php echo esc_output($job['title'], 'html'); ?>
                    </span>
                    <span class="job-listing-heading-line"></span>
                  </p>
                  <p class="job-listing-job-info">
                    <span class="job-listing-job-info-date"><i class="fa fa-clock-o"></i> Diterima : <?php echo timeFormat($job['applied_on']); ?></span>   
                    <?php if ($job['kategori'] != "") {?>
                    <span class="job-listing-job-info-date"><i class="fa fa-circle"></i>
                      Divisi : 
                        <?php echo esc_output($job['kategori'], 'html');?>
                      </span>
                      <?php }?>
                      <!-- <?php if ($job['company'] != "") { ?>-->
                      <!--<span class="job-listing-job-info-item" title="Requires">                        -->
                      <!--<i class="fa fa-building"></i> <b>Perusahaan : <?php echo $job['company']; ?></b>-->
                      <!--</span>-->
                      <!--<?php } ?>-->
                    
                    
                  </p>
                  <div class="job-listing-job-description">
                      <br>
                    <?php echo trimString($job['description'], 280); ?>
                    <!--<a href="<?php echo base_url(); ?>job/<?php echo encode($job['job_id']); ?>"><?php echo lang('read_more'); ?></a>-->
                  </div>
                  <div class="container">
                    <div class="row job-listing-items-container">
                      <?php if ($job['fields']) { ?>
                        <?php foreach ($job['fields'] as $key => $value) { ?>
                          <?php if ($value['label']) { ?>
                          <div class="col-md-4 col-sm-6 job-listing-items">
                            <span class="job-listing-items-title" title="<?php echo esc_output($value['label'], 'html'); ?>">
                              <?php echo trimString(esc_output($value['label'], 'html')); ?>
                            </span>
                            <span class="job-listing-items-value" title="<?php echo esc_output($value['value'], 'html'); ?>">
                              <?php echo trimString(esc_output($value['value'], 'html')); ?>
                            </span>
                          </div>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="container" style="display:none">
                    <div class="row job-application-progress">
                        <?php if ($job['job_status'] != 'rejected'){ ?>
                        <div class="col-xs-3 job-application-progress-step <?php jobStatus($job['job_status'], 1); ?>">
                          <div class="text-center job-application-progress-stepnum"><small><b>Diterima</b></small></div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="job-application-progress-dot"></a>
                        </div>
                        <div class="col-xs-3 job-application-progress-step <?php jobStatus($job['job_status'], 2); ?>">
                          <div class="text-center job-application-progress-stepnum"><small><b>Diproses</b></small></div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="job-application-progress-dot"></a>
                          <div class="job-application-progress-info text-center"></div>
                        </div>
                        <div class="col-xs-3 job-application-progress-step <?php jobStatus($job['job_status'], 3); ?>">
                          <div class="text-center job-application-progress-stepnum"><small><b>Interview</b></small></div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="job-application-progress-dot"></a>
                          <div class="job-application-progress-info text-center"></div>
                        </div>
                        <div class="col-xs-3 job-application-progress-step <?php jobStatus($job['job_status'], 4); ?>">
                          <div class="text-center job-application-progress-stepnum"><small><b>Bekerja</b></small></div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="job-application-progress-dot"></a>
                          <div class="job-application-progress-info text-center"></div>
                        </div>
                         <?php }else{ ?>
                         <div class="col-md-12 job-application-progress-step ">
                          <div class="text-center job-application-progress-stepnum"><?php echo "DITOLAK"; ?></div>
                          
                          <a href="#" class="job-application-progress-dot"></a>
                          <div class="job-application-progress-info text-center"></div>
                        </div>
                       
                         <?php }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php } else { ?>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="job-detail account-no-content-box">
                  Tidak Ada History Tes yang diikuti  
                  <br>
                  <br>
                  <!--<a href="<?=base_url();?>/jobs"><button class="btn btn-primary ">Ikuti Tes Sekarang</button></a>-->
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
