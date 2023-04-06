  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-cube"></i> <?php echo lang('update_profile'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_profile'); ?></li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">

      <!-- Main row Starts-->
      <div class="row">
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo lang('profile'); ?> Lembaga</h3>
            </div>
            <form id="admin_profile_form">
            <input type="hidden" name="jenis" value="<?php echo $jenis; ?>" >
            <?php 
            if($jenis == 2){?>
  
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama Lembaga</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo esc_output($profile['nama']); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>NPSN</label>
                    <input type="number" class="form-control" name="npsn" value="<?php echo esc_output($profile['npsn']); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo lang('email'); ?></label>
                    <input type="text" class="form-control" name="email" value="<?php echo esc_output($profile['email']); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo lang('phone'); ?></label>
                    <input type="text" class="form-control" name="no_telp" value="<?php echo esc_output($profile['no_telp']); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Provinsi</label>
                    <select name="provinsi" class="form-control prov" required>
                        <option value="">Pilih Provinsi</option>
                        <?php foreach ($prov as $value): ?>
                        <option value="<?=$value->id_prov?>"><?=$value->nama?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Kabupaten</label>
                    <select name="kabupaten" class="form-control kab" required >
                        
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Kecamatan</label>
                     <select name="kecamatan" class="form-control kec" required >
                        
                    </select>
                  </div>
                </div>
                 <div class="col-md-12">
                  <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <input type="text" class="form-control" name="alamat" value="<?php echo esc_output($profile['alamat']); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama Kepala Sekolah</label>
                    <input type="text" class="form-control" name="kepsek" value="<?php echo esc_output($profile['kepsek']); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>NIP Kepala Sekolah</label>
                    <input type="number" class="form-control" name="nip_ks" value="<?php echo esc_output($profile['nip_ks']); ?>">
                  </div>
                </div>
                <!--<br>-->
                <!--</div>-->
                <div class="col-md-6">
                  <div class="form-group">
                    <br>
                    <label><b style="color:red">* </b>FILE MOU MITRA &nbsp;&nbsp;&nbsp;</label>
                    <?php if($profile['mou'] != ''){?>
                    <a target="_blank" href="<?=base_url()?>download_mou/<?=$profile['mou']?>"><button type="button" class="btn btn-sm btn-success">Download File Disini</button></a> 
                    <?php }else{?>
                    <button type="button" class="btn btn-sm btn-warning">Belum Terdapat File MOU</button>
                    <?php }?>
                  </div>
                </div>
                
              </div>
              <!-- /.form group -->
            </div>
            <?php }else{ ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo lang('first_name'); ?></label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo esc_output($profile['first_name']); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo lang('last_name'); ?></label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo esc_output($profile['last_name']); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('username'); ?></label>
                    <input type="text" class="form-control" name="username" value="<?php echo esc_output($profile['username']); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('email'); ?></label>
                    <input type="text" class="form-control" name="email" value="<?php echo esc_output($profile['email']); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('phone'); ?></label>
                    <input type="text" class="form-control" name="phone" value="<?php echo esc_output($profile['phone']); ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('image'); ?></label>
                    <input type="file" class="form-control dropify" name="image" 
                          data-default-file="<?php echo userThumb($profile['image']); ?>" />
                  </div>
                </div>
              </div>
              <!-- /.form group -->
            </div>
            <?php }?>
  
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="admin_profile_form_button"><?php echo lang('save'); ?></button>
            </div>
            </form>
          </div>
        </section>
      </div>
      <!-- Main row Ends-->
    </section>
    <!-- Main content Ends-->

  </div>
  <!-- Content Wrapper Ends -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/user.js"></script>
<script>
var base_url = '<?=base_url()?>';
function get_data_edit_akun(){
  var id = '<?=$profile['id_mitra']?>';
  $.ajax({
    url : base_url + 'admin/Users/get_edit',
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
    var kab = "<?php echo $profile['kabupaten'];?>";
    $.ajax({
      url : base_url + 'admin/Users/get_kab',
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
    var kec = "<?php echo $profile['kecamatan'];?>";
    $.ajax({
      url : base_url + 'admin/Users/get_kec',
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


</body>
</html>
