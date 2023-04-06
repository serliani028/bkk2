<style>


h1 {
  text-align: center;
}

/* Hide all steps by default: */
</style>
<main id="main" style="margin-top:200px">

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
              <div class="account-box">
                <p class="account-box-heading">
                  <span><?=$nama_sekolah;?></span>
                  <br>
                  <small class="account-box-heading-text" style="font-size:12px">FORM PENDAFTARAN</small>
                  <span class="account-box-heading-line"></span>
                </p>
                <div class="container">
                  <?php include('partials/messages.php'); ?>
                  <?php echo form_open_multipart($action); ?>
                 
                 <div class="tab">
                    <div class="row">
                      <div class="col-md-6 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for="">NIS (Nomor Induk Siswa) <small style="color:red;font-size:12px">*</small></label>
                          <div class="input-group mb-3">
                            <input id="in_nis" type="text" name="nis" class="form-control cek" placeholder="NIS (Nomor Induk Siswa)"
                            aria-label="NIS" aria-describedby="basic-addon1" required="1">
                            <input type="hidden" name="id_sekolah" value="<?=$id_sekolah;?>" readonly="readonly" />
                            <input type="hidden" name="hal" value="<?=$hal;?>" readonly="readonly" />
                          </div>
                          <small id="" class="form-text text-muted">NIS (Nomor Induk Siswa).</small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account"> 
                          <label for="">Nama <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <input id="in_nama" type="text" name="first_name" class="form-control cek" placeholder="Nama"
                            aria-label="First Name" aria-describedby="basic-addon1" required="1">
                          
                          </div>
                          <small id="" class="form-text text-muted">Nama Siswa.</small>
                        </div>
                      </div>
                      
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Nomor Telepon <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <input id="in_telp" type="text" name="phone1"  class="form-control cek" placeholder="Nomor Telepon"
                            aria-label="Nomor Telepon" aria-describedby="basic-addon1" required="1">
                          
                          </div>
                          <small id="" class="form-text text-muted">Masukkan Nomor Telepon.</small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Email <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <input id="in_email" type="email" name="email" class="form-control cek" placeholder="Email"
                            aria-label="Email" aria-describedby="basic-addon1" required="1">
                           
                          </div>
                          <small id="" class="form-text text-muted">Masukkan Email.</small>
                        </div>
                      </div>
                    <!--</div>-->
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Tahun Angkatan <small style="color:red">*</small></label>
                              <br>
                          <div class="input-group mb-3">
                                <select required="1" name="id_tahun_angkatan" class="form-control select2 cek" >
                                    <option value="">Pilih Tahun Angkatan</option>
                                    <?php foreach($tahun_angkatan as $key){?>
                                    <option value="<?=$key->id;?>">Tahun Angkatan <?=$key->tahun_angkatan;?></option>
                                    <?php } ?>
                                </select>
                          </div>
                          <small id="" class="form-text text-muted">Pilih Status Siswa.</small>
                        </div>
                      </div>
                      
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Jurusan <small style="color:red;font-size:12px">* </small></label>
                              <br>
                          <div class="input-group mb-3">
                                <select name="id_jurusan" id="id_jurusan" class="form-control select2 cek" required="1">
                                    <option value="">Pilih Jurusan</option>
                                    <?php 
                                    foreach ($jurusan as $row){
                                    ?>
                                    <option value="<?=$row->id;?>"><?=$row->nama;?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                          </div>
                          <small id="" class="form-text text-muted">Pilih Jurusan.</small>
                        </div>
                      </div>
                       
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Pilih Kelas <small style="color:red;font-size:12px">* </small></label>
                              <br>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <select required="1" class="form-control" name="kelas_siswa" style="width:100px" id="kelas" >
                                    <option value="">Kelas</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                
                                </select>
                                 <select required="1" name="id_kelas" class="form-control" style="width:210px" id="nama_kelas" >
                                </select>
                                </div>
                         
                          </div>
                          <small id="" class="form-text text-muted">Pilih Kelas Siswa.</small>
                        </div>
                      </div>
                      
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                            <label for="nama">Password <small style="color:red;font-size:12px">*(min 8 Karakter)</small></label>
                            <input id="in_password" type="password" name="password" class="form-control" required="1"  />
                            <small id="" class="form-text text-muted">Password (min 8 Karakter)</small>
						 </div>
                      </div><div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                            <label for="nama">Re-Password </label>
                            <input type="password" name="repassword" class="form-control" required="1" />
                            <input type="hidden" name="account_type" value="vokasi" class="form-control" required="1" />
                            <small id="" class="form-text text-muted">Re-Password</small>
						 </div>
                      </div>
                    
                  </div>
                  </div>
                
                  <div style="overflow:auto;">
                    <div style="float:right;">
                      <button type="submit" class="btn btn-success">Daftar Sekarang</button>
                    </div>
                  </div>
                  <div style="text-align:center;margin-top:10px;margin-bottom:10px">
                 
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

<script>
var base_url = '<?=base_url()?>';
$(document).ready(function(){
    
 $('#id_jurusan').change(function(){
    var id_jurusan = $(this).val();
    var id_sekolah = '<?=$id_sekolah?>';
    var id_kelas = $('#kelas').val();
    $.ajax({
      url : base_url + 'Candidates/get_kelas',
      method : "GET",
      data : {id_jurusan: id_jurusan, id_sekolah : id_sekolah,id_kelas : id_kelas},
      async : true,
      dataType : 'json',
      success: function(data){
        $('#nama_kelas').empty();
        if(data != 200){
        $.each(data, function(key, value) {
            $('#nama_kelas').append('<option value="'+ value.id +'">'+ value.kelas+' '+value.nama +'</option>');
        });
        }else{
            alert('Tidak Ada Data Kelas di Sekolah ini !');
        }
      }
    });
  return false;
});

$('#kelas').change(function(){
  var id_kelas = $(this).val();
  var id_sekolah = '<?=$id_sekolah?>';
  var id_jurusan = $('#id_jurusan').val();
    $.ajax({
      url : base_url + 'Candidates/get_kelas',
      method : "GET",
      data : {id_kelas: id_kelas, id_sekolah : id_sekolah,id_jurusan : id_jurusan},
      async : true,
      dataType : 'json',
      success: function(data){
      $('#nama_kelas').empty();
        if(data != 200){
        $.each(data, function(key, value) {
            $('#nama_kelas').append('<option value="'+ value.id +'">'+ value.kelas+' '+value.nama +'</option>');
        });
        }else{
            alert('Tidak Ada Data Kelas di Sekolah ini !');
        }
      }
    });
  return false;
});

});
</script>
