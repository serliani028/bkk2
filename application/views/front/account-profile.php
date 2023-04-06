  <main id="main" style="margin-top:180px; margin-bottom:50px;">
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
                    <span class="account-box-heading-text">Kelola Profil Anda</span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <div class="container">
                <?php include(VIEW_ROOT.'/front/partials/messages.php'); ?>
                  <form class="form" id="profile_update_form">
                      <input type="hidden" name="candidate_id" value="<?php echo esc_output($candidate['candidate_id']); ?>">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account" >
                            <a href="<?=base_url()?>download_cv/<?=encode($candidate['candidate_id'])?>"><b class="btn btn-success btn-xs">Download CV </b></a>
                         </div>
                      </div>
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account" >
                          <label for="input-file-now-custom-1">Foto Profil Anda<small style="color:red">* Maks 1MB (JPG/PNG)</small></label>
                          <input type="file" id="input-file-now-custom-1" class="dropify"
                          data-default-file="<?php echo candidateThumb($candidate['image']); ?>" name="image" />
                          <small class="form-text text-muted"><?php echo lang('only_jpg_or_png_allowed'); ?></small>
                        </div>
                      </div>
                      
                      <div class="col-md-6 col-lg-6">
                          <div class="form-group form-group-account" >
                         <label for="input-file-now-custom-1">
                          Nomor Induk Siswa <small style="color:red">*</small>
                          </label>
                          <input type="text" class="form-control" placeholder="" name="nis"
                          value="<?php echo esc_output($candidate['nis']); ?>">
                        <small class="form-text text-muted">Masukkan NIS</small>
                        </div>
                        
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('first_name'); ?></label>
                          <input type="text" class="form-control" placeholder="Nama Anda" name="first_name"
                          value="<?php echo esc_output($candidate['first_name']); ?>">
                          <small class="form-text text-muted"><?php echo lang('enter_first_name'); ?></small>
                        </div>
                        
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('gender'); ?></label>
                          <select name="gender" class="form-control">
                            <option value="male" <?php echo esc_output($candidate['gender']) == 'male' ? 'selected' : ''; ?>>
                              <?php echo lang('male'); ?>
                            </option>
                            <option value="female" <?php echo esc_output($candidate['gender']) == 'female' ? 'selected' : ''; ?>>
                              <?php echo lang('female'); ?>
                            </option>
                            <option value="other" <?php echo esc_output($candidate['gender']) == 'other' ? 'selected' : ''; ?>>
                              <?php echo lang('other'); ?>
                            </option>
                          </select>
                          <small class="form-text text-muted"><?php echo lang('select_gender'); ?></small>
                        </div>
                        
                         <div class="form-group form-group-account">
                          <label for="">Provinsi</label>
                          <select name="provinsi" class="form-control prov" required="1" >
                              <option value="">Pilih Provinsi</option>
                            <?php foreach ($provinsi as $baris) { ?>
                              <option value="<?php echo esc_output($baris->id_prov); ?>" ><?php echo esc_output($baris->nama, 'html'); ?></option>
                            <?php } ?>
                          </select>
                          <small class="form-text text-muted">Masukkan Provinsi</small>
                        </div>
                        
                       
                      </div>
                      <div class="col-md-6 col-lg-6">
                      
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('email'); ?></label>
                          <input type="text" class="form-control" placeholder="email" name="email"
                          value="<?php echo esc_output($candidate['email']); ?>">
                          <small class="form-text text-muted"><?php echo lang('enter_email'); ?></small>
                        </div>
                         <div class="form-group form-group-account">
                          <label for=""><?php echo lang('phone'); ?> </label>
                          <input type="text" class="form-control" placeholder="12345 67891011" name="phone1"
                          value="<?php echo esc_output($candidate['phone1']); ?>">
                          <small class="form-text text-muted"><?php echo lang('enter_phone'); ?> </small>
                        </div>
                         <div class="form-group form-group-account">
                          <label for="">Tanggal Lahir</label>
                          <input type="date" class="form-control" placeholder="12345 67891011" name="dob"
                          value="<?php echo esc_output($candidate['dob']); ?>">
                          <small class="form-text text-muted"><?php echo lang('enter_phone'); ?> </small>
                        </div>
                       <div class="form-group form-group-account">
                          <label for=""><?php echo lang('city'); ?></label>
                          <select name="city" class="form-control kab" required="1" >
                            </select>
                          <small class="form-text text-muted"><?php echo lang('enter_city'); ?></small>
                        </div>
                       
                      </div>
                      
                      <div class="col-md-6">
                           <div class="form-group form-group-account">
                          <label for=""><?php echo lang('state'); ?></label>
                          <select name="state" class="form-control kec" required="1">
                          </select>
                          <small class="form-text text-muted"><?php echo lang('enter_state'); ?></small>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                           <div class="form-group form-group-account">
                          <label for=""><?php echo lang('address'); ?> Lengkap</label>
                          <input type="text" class="form-control" placeholder="Jl ...,Kel/Desa, Kec., Kab." name="address"
                          value="<?php echo esc_output($candidate['address']); ?>">
                          <small class="form-text text-muted"><?php echo lang('enter_address'); ?></small>
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                           <div class="form-group form-group-account">
                          <label for="">Biografi Singkat Anda</label>
                          <textarea class="form-control" name="tentang"><?=$candidate['tentang']?></textarea>
                          <small class="form-text text-muted">Biografi Singkat</small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <button type="submit" class="btn btn-success" title="Save" id="profile_update_form_button">
                            <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
                          </button>
                        </div>
                      </div>
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
  
 <script>
var base_url = '<?=base_url()?>';
function get_data_edit_akun(){
  var id = '<?=$candidate['candidate_id']?>';
  $.ajax({
    url : base_url + 'Candidates/get_edit',
    method : "GET",
    data :{id :id},
    async : true,
    dataType : 'json',
    success : function(data){
      $.each(data, function(i, item){
        $('.prov').val(data[i].provinsi).trigger('change');
        $('.kab').val(data[i].kabupaten).trigger('change');
        $('.kec').val(data[i].kecamatan).trigger('change');
      });
    }

  });
}

$(document).ready(function(){
  get_data_edit_akun();
$('.prov').change(function(){
  var id = $(this).val();
    var kab = "<?php echo $candidate['city'];?>";
    $.ajax({
      url : base_url + 'Candidates/get_kab',
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
        $('.kab').empty();

        $.each(data, function(key, value) {
          if(kab==value.id_kab){
            $('.kab').append('<option value="'+ value.id_kab +'" selected>'+ value.nama +'</option>').trigger('change');
          }else{
            $('.kab').append('<option value="'+ value.id_kab +'">'+ value.nama +'</option>');
          }
        });

      }
    });
  return false;
});

$('.kab').change(function(){
  var id = $(this).val();
    var kec = "<?php echo $candidate['state'];?>";
    $.ajax({
      url : base_url + 'Candidates/get_kec',
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
        $('.kec').empty();

        $.each(data, function(key, value) {
          if(kec==value.id_kec){
            $('.kec').append('<option value="'+ value.id_kec +'" selected>'+ value.nama +'</option>').trigger('change');
          }else{
            $('.kec').append('<option value="'+ value.id_kec +'">'+ value.nama +'</option>');
          }
        });

      }
    });
  return false;
});

});
</script>