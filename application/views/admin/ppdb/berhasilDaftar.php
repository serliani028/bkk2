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
                  <span>PENDAFTARAN SISWA PPDB</span>
                  <br>
                  <small class="account-box-heading-text" style="font-size:12px">Silahkan Lengkapi Data Diri Anda</small>
                  <span class="account-box-heading-line"></span>
                </p>
                <div class="container">
                    <div class="row">
                    <div class="col-md-12">
					<div class="card form">
						<div class="card-body">
							<div class="container text-center">
                                <img src="<?= base_url('public/data/PPDB/mail_success.png') ?>" alt="">
                                <h2><b>Sukses!</b></h2>
                                <h4>Pendaftaran Berhasil Dilakukan</h4>
                                <div class="btn-primary" style="color: white;margin-top: 50px;margin-bottom: 50px;">
                                	<h4>Nama : <?php echo $nama ?></h4>
                                	<h4>Kode Pendaftaran : <?php echo $kode_pendaftaran ?></h4>
                                </div>
                               	<!--<h4><a class="btn-danger" target="__blank" href="<?php echo base_url('PPDB_Controller/download_buktipendaftaran/'.$kode_pendaftaran) ?>">Download Bukti Pendaftaran</a></h4>-->
                                <h4>Harap di simpan kode pendaftaran berikut untuk melakukan tahap registrasi selanjutnya, Silahkan Periksa Email Untuk Informasi lebih lanjut</h4>
                            </div>
						</div>
					</div>
				</div>
                    </div>
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
