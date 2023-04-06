  <!--==========================
    Intro Section
  ============================-->
  <!--<section id="intro" class="clearfix front-intro-section">-->
  <!--  <div class="container">-->
  <!--    <div class="intro-img">-->
  <!--    </div>-->
  <!--    <div class="intro-info">-->
        <!--<h2>-->
        <!--  <span>-->
        <!--    echo lang('account'); ?> > -->
        <!--    echo esc_output($quiz['title'], 'html');  ?> -->
        <!--    echo esc_output(($detail['job_title'] ? ' : '.$detail['job_title'] : ''), 'html'); ?>-->
        <!--  </span>-->
        <!--</h2>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section><!-- #intro -->

  <main id="main" style="margin-top:180px;">

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
                <div class="account-box">
                  <p class="account-box-heading">
                    <!--<span class="account-box-heading-text">-->
                      <?php echo esc_output($quiz['title']);  ?> 
                      <?php echo esc_output(($detail['job_title'] ? ' : '.$detail['job_title'] : ''), 'html'); ?>
                    <!--</span>-->
                    <span class="account-box-heading-line"></span>
                  </p>
                  <p class="quiz-attempt-info">
                  </p >
                  <h6 style="text-align:center"><b>TERIMAKASIH ATAS PARTISIPASI ANDA</b></h6>
                  <p class="quiz-attempt-description" style="text-align:center">
                      <br>
                    <button class="btn btn-success btn-md"><?php echo 'Tes Internal'; ?> Selesai</button> <br />
                    
                      <br>
                    <!--?php echo lang('result'); ?> : <strong><?php echo esc_output($detail['total_questions']) != 0 ? round(($detail['correct_answers']/$detail['total_questions'])*100).'%' : '';  ?></strong><br />-->
                    <!--<a href="<?php echo base_url(); ?>account/quizes"><?php echo 'Lanjut Tahap Berikutnya'; ?> </a>-->
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>
  
  <script>
      window.setTimeout(function(){ window.location = "https://smk.cybersjob.com/account/tes-interview-internal"; },1000);
  </script>