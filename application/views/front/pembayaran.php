  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <!--<div class="intro-info">-->
      <!--  <h2><span><?php echo lang('account'); ?> > Profil User</span></h2>-->
      <!--</div>-->
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
                <div class="account-box">
                  <p class="account-box-heading">
                    <span class="account-box-heading-text">Pembayaran Psikotes</span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <div class="container">
                  <form class="form" id="profile_update_form">
                      <input type="hidden" name="candidate_id" value="<?php echo esc_output($candidate['candidate_id']); ?>">
                    <div class="row">
                    <div class="col-md-12 col-lg-12">
                    
                    <table class="table">
                    <thead style="background-color:orange;color:white">
                    <tr >
                    <th colspan="2" >Tagihan Pembayaran Psikotes Online</th>
                    </tr>
                    </thead>            
                    <tbody>
                     <tr><td>Nama Peserta</td><td> : <b><?=$candidate['first_name']." ".$candidate['last_name']?></b></td></tr>
                     <tr><td>No. Telepon</td><td> : <b><?=$candidate['phone1']?></b></td></tr>
                     <tr><td>Email</td><td> : <b><?=$candidate['email']?></b></td></tr>
                     <tr><td>Harga Psikotes</td><td> : <b style="text-decoration: line-through;" >Rp 100.000,00 </b>&nbsp;&nbsp;<b class="btn btn-primary btn-sm">Gratis !!</b></td></tr>
                     <tr><td>Status Pembayaran</td><td> : <b class="btn btn-success btn-sm">Terbayar</b></td></tr>
                     <!--<tr><td colspan="2"><hr></td></tr>-->
                     <tr><td colspan="2"><b style="color:red">Nb : Kode Pembayaran akan dikirim ke Email Anda</b></td></tr>
                    </tbody>
                    </table>
                      </div>
                      
                      
                    </div>
                    <div class="row">
                      <!--<div class="col-md-12 col-lg-12">-->
                      <!--  <div class="form-group form-group-account">-->
                      <!--    <button type="submit" class="btn btn-success" title="Save" id="profile_update_form_button">-->
                      <!--      <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>-->
                      <!--    </button>-->
                      <!--  </div>-->
                      <!--</div>-->
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>