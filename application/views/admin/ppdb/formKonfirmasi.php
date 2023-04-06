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
                  <span>FORM KONFIRMASI PEMBAYARAN</span>
                  <br>
                  <small class="account-box-heading-text" style="font-size:12px">Silahkan Lengkapi Formulir</small>
                  <span class="account-box-heading-line"></span>
                </p>
                <div class="container">
                    <div class="row">
                    <div class="col-md-12">
					<div class="card form">
						<div class="card-body">
							<?php //if(empty($id)) : ?>
			<div class="row cari-siswa">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <form action="" method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <h4>
                            <?php if ($valid == -1) { ?>
                                <p style="color:red;">(Kode Pendaftaran Salah)</p>
                            <?php } ?>
                        </h4>
                            <input class="form-control" type="text" placeholder="Masukan ID Registrasi" name="id" required>
                            <!-- <input type="text" placeholder="Masukan Nama Lengkap"> -->
                            <button class="btn btn-primary w-100">Cari</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php if (!empty($id) && $valid == 1) : ?>

            <div class="row mt-5 info-siswa">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-title">
                            <center><h4>Info Siswa</h4></center>
                        </div>
                        <form action="<?php echo base_url('PPDB_Controller/proses_uploadbuktipembayaran') ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">	
                            <input type="hidden" name="id_siswaBaru" value="<?php echo $siswa[0]['id_siswaBaru'] ?>">
                            <div class="form-group">
                                <label>ID Registrasi :</label>
                                <input type="text" class="form-control" readonly placeholder="Nama" value="<?php echo $siswa[0]['kode_pendaftaran'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap :</label>
                                <input type="text" class="form-control" value="<?php echo $siswa[0]['nama'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email :</label>
                                <input type="text" class="form-control" value="<?php echo $siswa[0]['email'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>No Hp (Whatsapp) :</label>
                                <input type="text" class="form-control" value="<?php echo $siswa[0]['no_telp'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Alamat :</label>
                                <textarea type="text" class="form-control" readonly><?php echo $siswa[0]['alamat'] ?></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label>Upload Bukti Pembayaran (file Gambar .jpg .png)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_bukti" required>
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Catatan :</label>
                                <textarea type="text" class="form-control" name="catatan" required></textarea>
                            </div>
                            <button class="btn btn-primary w-100" type="submit">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        
        <?php endif; ?>
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
