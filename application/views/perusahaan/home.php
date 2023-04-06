  <!--==========================
    Intro Section
  ============================-->
  <section class="clearfix">
    <div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active" style="background-color:black"></li>
      <!-- <li data-target="#carouselExampleCaptions" data-slide-to="1"></li> -->
      <li data-target="#carouselExampleCaptions" data-slide-to="1"  style="background-color:black"></li>
    </ol>
    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src="https://i.pinimg.com/originals/83/e0/62/83e062e9d6ae05ad4efe1105f82dc255.png" height="500px" class="d-block w-100" alt="gambar">
        <div class="carousel-caption d-none d-md-block">
        <p><b>CYBERS JOB.</b></p>
        </div>
      </div>
      <div class="carousel-item ">
        <img src="https://www.jobcloud.ch/wp-content/uploads/2020/04/14_Bnefits_Collaboration-2.svg" height="500px" class="d-block w-100" alt="gambar">
        <div class="carousel-caption d-none d-md-block">
        
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color:black;padding:15px"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"  style="background-color:black;padding:15px"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
  </section><!-- #intro -->


  <main id="main">

    <?php if (setting('before-how')) { ?>
    <section id="home-custom-content">
      <div class="container">
        <div class="row row-eq-height justify-content-center">
          <div class="col-lg-12 mb-4">
            <?php echo setting('before-how'); ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
        <br>
        
         <section id="pendaftaran">
      <div class="container">
        <header class="section-header">
            <br>
            <br>
          <h3><b>Pendaftaran Perusahaan</b></h3>
          <p><b>Ayo Kembangkan Perusahaan Anda Bersama Cybers Job</b></p>
        </header>
        <div class="row row-eq-height justify-content-center">
            <div class="col-lg-6 col-sm-12 mb-4" style="display:inline block">
               <div style="text-align:center">
               <img src="<?=base_url('assets/images/candidates/company2.jpg');?>" width="400px" height="300px" style="padding:20px">
               </div>
           <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
          <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
          <p><b>CYBERS JOB</b></p>
          </div>
          <div class="col-lg-6 col-sm-12 mb-4">
                
               <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="account-box">
                  <p class="account-box-heading">
                  </p>
                  <?php echo form_open_multipart($action); ?>
                  <div class="container">
                    <?php include('messages.php'); ?>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for="">Nama Perusahaan</label>
                          <div class="input-group mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Nama Perusahaan"
                            aria-label="Nama Perusahaan" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-building"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted">Masukkan Nama Perusahaan.</small>
                        </div>
                      </div>
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('email'); ?></label>
                          <div class="input-group mb-3">
                            <input type="text" name="email_ph" class="form-control" placeholder="<?php echo lang('email'); ?>"
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
                          <label for="">No. Telepon</label>
                          <div class="input-group mb-3">
                            <input type="text" name="no_telp_ph" class="form-control" placeholder="No. Telepon"
                            aria-label="No. Telepon" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted">Masukkan No. Telepon.</small>
                        </div>
                      </div>
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('password'); ?></label>
                          <div class="input-group mb-3">
                            <input type="password" name="password_ph" class="form-control" placeholder="<?php echo lang('password'); ?>"
                            aria-label="Password" aria-describedby="basic-addon1">
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
                          <button type="submit" class="btn btn-success">DAFTAR SEKARANG</button>
                        </div>
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
    </section>
    
    <br>
    <br>
        <section id="how-it-works" style="margin-top:0px;padding-top:10px">
      <div class="container">
        <header class="section-header" >
          <h3 style="text-align:left"><b>Pengelolaan Perusahaan</b></h3>
          <h6 style="text-align:left"><b>Berikut Adalah Cara Pengelolaan Perusahaan di Cybers Job </b></h6>
        </header>
        <div class="row row-eq-height ">
          <!-- <div class="row"> -->
            
            <div class="col-md-6 col-lg-6 sol-sm-12" style="display:inline-block">
                <br>
            <div style="text-align:center">
              <img src="<?=base_url('assets/images/candidates/regist_perush.PNG');?>" height="350px" width="350px" >
             <br>
             </div>
            </div>
            
            <div class="col-md-6 col-lg-6 sol-sm-12">
             <br>
             <h4><b> 1. Daftarkan Perusahaan Anda</b></h4>
              <p> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
          <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
          
            </div>
            
            <div class="col-md-12 col-lg-12 sol-sm-12">
                <br>
            </div>
            
            <div class="col-md-6 col-lg-6 sol-sm-12">
             <br>
             <h4><b> 2. Lengkapi Data Perusahaan Anda</b></h4>
              <p> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
          <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
            </div>
            <div class="col-md-6 col-lg-6 sol-sm-12" style="display:inline-block">
                <br>
            <div style="text-align:center">
              <img src="<?=base_url('assets/images/candidates/validasi.png');?>" height="250px" width="450px" >
             <br>
             </div>
            </div>
            
             <div class="col-md-12 col-lg-12 sol-sm-12">
                <br>
            </div>
            
            <div class="col-md-6 col-lg-6 sol-sm-12" style="display:inline-block">
            <div style="text-align:center">
              <img src="<?=base_url('assets/images/candidates/hired.jpg');?>" height="350px" width="350px" >
             <br>
             </div>
            </div>
            
            <div class="col-md-6 col-lg-6 sol-sm-12">
             <br>
             <h4><b> 3. Iklankan Perusahaan Anda</b></h4>
              <p> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
          <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
          
            </div>
             
        </div>
      </div>
    </section>

   
  </main>

  <?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>
