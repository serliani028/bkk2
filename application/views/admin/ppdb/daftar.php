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
                  <span>PENDAFTARAN SISWA PPDB <?php echo $sekolah[0]['nama']?></span>
                  <br>
                  <small class="account-box-heading-text" style="font-size:12px">Silahkan Lengkapi Data Diri Anda</small>
                  <span class="account-box-heading-line"></span>
                </p>
                <div class="container">
                    <div class="row">
                    <div class="col-md-12">
					<div class="card form">
						<div class="card-body">
							<form action="<?php echo base_url('PPDB_Controller/proses_pendaftaran') ?>" method="POST">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="id_mitra" value="<?php echo $sekolah[0]['id_mitra']?>">
								<div class="form-group">
									<label for="nama">Nama Lengkap</label>
									<input type="text" class="form-control form-input" id="nama" name="nama" placeholder="" required>
								</div>
								<div class="form-group">
									<label for="jk">Jenis Kelamin</label>
									<select class="form-control" id="jk" name="jk">
									<option value="1">Laki - laki</option>
									<option value="2">Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label for="jk">Tanggal Lahir</label>
										<input class="form-control" type="date" name="tanggal_lahir" required>
									</select>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control form-input" id="email" name="email" placeholder="" required>
								</div>
								<div class="form-group">
									<label for="hp">No Handphone (Whatsapp)</label>
									<input type="number" class="form-control form-input" id="hp" name="hp" placeholder="" required>
								</div>
								<div class="form-group">
									<label for="alamat">Alamat Lengkap</label>
									<input type="text" class="form-control form-input" id="alamat" name="alamat" placeholder="" required>
								</div>
								<div class="form-group">
									<label for="jurusan">Pilih Jurusan</label>
									<select class="form-control" id="jurusan" name="jurusan1">
										<?php foreach ($jurusan as $data) { ?>
										    <option value="<?php echo $data['id']?>"><?php echo $data['nama']?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
								    <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                    <div class="form-group form-group-account">
                                      <label for="">Provinsi <small style="color:red">*</small></label>
                                      <div class="input-group mb-3">
                                        <select class="form-control cek" name="provinsi" id="prov_regist" required="1">
                                        <option value="">Pilih Provinsi</option>
                                        <?php foreach ($provinsi as $baris) { ?>
                                        <option value="<?=$baris->id_prov;?>"><?=$baris->nama;?></option>
                                        <?php } ?>
                                        </select>
                                       
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                    <div class="form-group form-group-account">
                                      <label for="">Kabupaten / Kota <small style="color:red">*</small></label>
                                      <div class="input-group mb-3">
                                        <select name="city" class="form-control cek" required="1" id="kab_regist">
                                                <option value="">Pilih Kabupaten/Kota</option>
                                       </select>
                                      
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                    <div class="form-group form-group-account">
                                      <label for="">Kecamatan <small style="color:red">*</small></label>
                                      <div class="input-group mb-3">
                                        <select name="state" class="form-control cek" id="kec_regist" required="1">
                                                    <option value="">Pilih Kecamatan</option>
                                        </select>
                                       
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                </div>
								</div>
								<div class="text-right">
									<button class="btn btn-outline-primary">Daftar</button>
								</div>
							</form>
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
  <script>
$(document).ready(function(){

  $('#prov_regist').change(function(){
    var id=$(this).val();
    var url='https://smk.cybersjob.com/candidates/get_kab'
    $.ajax({
      url : url,
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value='+data[i].id_kab+'>'+data[i].nama+'</option>';
        }
        $('#kab_regist').html(html);

      }
    });
    return false;
  });

});
$(document).ready(function(){

  $('#kab_regist').change(function(){
    var id=$(this).val();
    var url='https://smk.cybersjob.com/candidates/get_kec';
    $.ajax({
      url : url,
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value='+data[i].id_kec+'>'+data[i].nama+'</option>';
        }
        $('#kec_regist').html(html);

      }
    });
    return false;
  });

});
$(document).ready(function(){

  $('#kec_regist').change(function(){
    var id=$(this).val();
    var url='https://smk.cybersjob.com/candidates/get_kel';
    $.ajax({
      url : url,
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value='+data[i].id_kel+'>'+data[i].nama+'</option>';
        }
        $('#kel_regist').html(html);

      }
    });
    return false;
  });

});
  </script>
