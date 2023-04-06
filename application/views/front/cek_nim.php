  <!--==========================
    Intro Section
  ============================-->
   
  <!-- #intro -->

  <main id="main" style="margin-top:180px; margin-bottom:50px;">

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
                    <span class="account-box-heading-text">CEK NIM SISWA</span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <?php echo form_open_multipart($action); ?>
                  <div class="container">
                    <?php include('partials/messages.php'); ?>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for="">Masukkan File CSV</label>
                          <div class="input-group mb-3">
                            <input type="file" name="file" class="form-control" required="1" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted">Masukkan File CSV</small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <button type="submit" class="btn btn-success">CEK NIM</button>
                        </div>
                      </div>
                    </div>
                  </div>
                    <?php echo form_close(); ?>
                
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
