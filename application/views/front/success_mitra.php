  <!--==========================
    Intro Section
  ============================-->
  <!--<section id="intro" class="clearfix front-intro-section">-->
  <!--  <div class="container">-->
  <!--    <div class="intro-img">-->
  <!--    </div>-->
  <!--    <div class="intro-info">-->
  <!--      <h2><span>Penndaftaran Berhasil</span></h2>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->
  <!-- #intro -->

  <main id="main" style="margin-top:200px; margin-bottom:80px;">

    <!--==========================
      Account Area Setion
    ============================-->
    <section class="main-container">
      <div class="container">
        <div class="row mt-10">
          <div class="col-lg-2">
          </div>
          <div class="col-md-8 col-lg-8 col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                  <br>
                  <br>
                  <br>
                  <input type="hidden" id="status_daftar" value="<?=$status_daftar;?>" >
                <div class="account-box">
                  <p class="account-box-heading">
                    <span class="account-box-heading-text">Pendaftaran Berhasil</span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <div class="container" style="text-align:center">

                    <h2 class="btn btn-success" >Selamat Pendaftaran Anda Sebagai Mitra Berhasil !!</h2>
                    <p style="text-align:center"><b>Silahkan tunggu notifikasi selanjutnya dari admin kami</b></p>

                  </div>
                  <div class="container">
                    <div class="row">
                      <!-- <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <a href="<?php echo base_url(); ?>login"><?php echo lang('back_to_login'); ?></a><br />
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>
                <br>
                  <br>
                  <br>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
          </div>
        </div>
      </div>
    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>
  
  <script>
  
   	$(document).ready(function(){
      window.setInterval(function () {
		location.href = "<?php echo base_url();?>";
		}, 3500);  
    }) 
      
  </script>
