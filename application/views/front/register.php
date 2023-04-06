<style>
h1 {
  text-align: center;
};
</style>
 <main id="main" style="margin-top:200px">
<section class="main-container">
    <div class="container">
      <div class="row mt-10">
        <div class="col-lg-2">
        </div>
        <div class="col-md-8 col-lg-8 col-sm-12">
          <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="account-box">
                <p class="account-box-heading">
                  <span>PENDAFTARAN MITRA</span>
                  <br>
                  <small class="account-box-heading-text" style="font-size:12px">Silahkan Lengkapi Data Lembaga Anda</small>
                  <span class="account-box-heading-line"></span>
                </p>
                <div class="container">
                  <?php include('partials/messages.php'); ?>
                  <?php echo form_open_multipart($action); ?>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for="">Nama Lembaga</label><br><br>
                          <div class="input-group mb-3">
                            <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama'); ?>" placeholder="Nama Lembaga"
                            aria-label="Nama Lembaga" aria-describedby="basic-addon1" required="1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-building"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted">Masukkan Nama Lembaga.</small>
                        </div>
                      </div>
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('email'); ?> Lembaga</label><br><br>
                          <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="<?php echo lang('email'); ?>"
                            aria-label="<?php echo lang('email'); ?>" value="<?php echo set_value('email'); ?>" aria-describedby="basic-addon1" required="1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_email'); ?> Lembaga.</small>
                        </div>
                      </div>
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for="">No. Telepon Lembaga</label><br><br>
                          <div class="input-group mb-3">
                            <input type="text" name="no_telp" class="form-control" <?php echo set_value('no_telp'); ?> placeholder="No. Telepon"
                            aria-label="No. Telepon" aria-describedby="basic-addon1" required="1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted">Masukkan No. Telepon Lembaga.</small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('password'); ?>  <small style="color :red">*</small></label><br><br>
                          <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password'); ?>"
                            aria-label="Email" aria-describedby="basic-ad   don1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_password'); ?></small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('retype_password'); ?>  <small style="color :red">*</small></label><br><br>
                          <div class="input-group mb-3">
                            <input type="password" name="retype_password" class="form-control" placeholder="Password"
                            aria-label="Email" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_password_again'); ?>.</small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <button type="submit" class="btn btn-success">DAFTAR MITRA</button>
                        </div>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    
  </main>
  
  
  <?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>
