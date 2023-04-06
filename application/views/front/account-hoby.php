  <!--==========================
    Intro Section
  ============================-->
  <!--<section id="intro" class="clearfix front-intro-section">-->
  <!--  <div class="container">-->
  <!--    <div class="intro-img">-->
  <!--    </div>-->
      <!--<div class="intro-info">-->
      <!--  <h2><span><?php echo lang('account'); ?> > <?php echo lang('password'); ?></span></h2>-->
      <!--</div>-->
  <!--  </div>-->
  <!--</section><!-- #intro -->

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
                    <span class="account-box-heading-text">Hobi & Medsos</span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <div class="container">
                    <?php include(VIEW_ROOT.'/front/partials/messages.php'); ?>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <label for=""><h4><b>DATA MEDSOS</b></h4></label> &nbsp;
                       <?php echo form_open_multipart($update_medsos);?>
                       <div class="row">
                        <div class="col-md-6">
                        <li>Instagram : </li>
                        <input type="hidden" value="<?=$id;?>"  name="id">
                        <input type="text" value="<?=$ig;?>" class="form-control" name="ig">
                        <br>
                        <li>Facebook : </li>
                        <input type="text" value="<?=$fb;?>" class="form-control" name="fb">
                        <br>
                        <li>Tik-Tok : </li>
                        <input type="text" value="<?=$tiktok;?>" class="form-control" name="tiktok">
                        <br>
                        </div>
                        <div class="col-md-6">
                        <li>Youtube : </li>
                        <input type="text" value="<?=$yt;?>" class="form-control" name="yt">
                        <br>
                        <li>Twitter : </li>
                        <input type="text" value="<?=$twitter;?>" class="form-control" name="twitter">
                        <br>
                        <li>Linkedln : </li>
                        <input type="text" value="<?=$linkedln;?>" class="form-control" name="linkedln">
                        <!--<br>-->
                        <br>
                        </div>
                        <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Simpan Data">
                        </div>
                        </div>
                        <?php echo form_close();?>
                        <hr>
                      </div>
                      
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><h4><b>DATA HOBI</b></h4></label>
                         <a href="javascript:;" 
                            data-id="<?=$id;?>" 
                            data-toggle="modal" data-target=".tambah_hoby" style="font-size:15px" href="#" > 
                          <button class="btn btn-success btn-sm"> + Tambah Hoby </button>
                          </a>
                        </div>
                        <?php 
                        if($hoby){
                            foreach ($hoby as $val){
                            // echo '<br>';
                                ?>
                                
                                <li style="border:1px dashed black;padding:7px">
                                    <?=$val->hoby?>
                                     <a href="<?=base_url('delete_h')?>/<?=encode($val->id);?>">
                                    <i style="color:red"> <span class="fas fa-trash"></span> Hapus Data</i>
                                    </a>
                                </li>
                                
                        <?php    }}else{
                            echo 'Belum Ada Hoby yang dimasukkan .';
                        }
                        ?>
                        <br>
                        <br>
                      </div>
                      
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><h4><b>DATA KEGIATAN</b></h4></label>
                         <a href="javascript:;" 
                            data-id="<?=$id;?>" 
                            data-toggle="modal" data-target=".tambah_kegiatan" style="font-size:15px" href="#" > 
                          <button class="btn btn-success btn-sm"> + Tambah Kegiatan </button>
                          </a>
                        </div>
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr style="background-color:#996f6b;color:white">
                                    <td>Aksi</td>
                                    <td>Kegiatan</td>
                                    <td>Informasi Lain</td>
                                    <!--<td></td>-->
                                </tr>
                            </thead>
                            <tbody>
                                 <?php  
                        if($kegiatan){
                            foreach ($kegiatan as $val){
                            // echo '<br>';
                                ?>
                                <tr>
                                    <td>
                                        <!--<i class="btn btn-warning btn-sm"><span class="fas fa-pen"></span></i>-->
                                         <a href="javascript:;" 
                                        data-hapus="<?=base_url('delete_k/'.encode($val->id));?>" 
                                        data-hapus_simpan="<?=base_url('delete_k_s/'.encode($val->id).'/'.encode('account/hobby'));?>" 
                                        data-toggle="modal" data-target=".hapus_kegiatan" style="font-size:15px" href="#" > 
                            <i class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></i>
                            </a>
                            </td>
                                    <td>
                                        Jenis : <?=$val->jenis == 1 ? 'Magang' : 'Bekerja';?><br>
                                        Tempat : <?=$val->lokasi;?><br>
                                        Posisi : <?=$val->posisi;?>
                                    </td>
                                    <td><?=$val->informasi?></td>
                                </tr>
                                
                        <?php    }}else{
                            echo '<tr><td colspan="3"><b>Belum Ada Kegiatan yang dimasukkan</b></td></tr>';
                        }
                        ?>
                            </tbody>
                        </table>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>
  
   <div class="modal fade tambah_hoby" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><b>Tambah Hoby</b></h3>
      </div>
      <?php echo form_open_multipart($tambah_hoby); ?>
      <div class="modal-body">
      <input type="hidden" id="id" name="id" >
      <label style="padding-bottom:5px"><b>Masukkan Hobi Anda</b></label>
      <input type="text" class="form-control" name="hobby" required>
      </div>
    
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Simpan">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
       <?php echo form_close(); ?>
      
    </div>
  </div>
</div>

<div class="modal fade hapus_kegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><b>Hapus Kegiatan</b></h3>
      </div>
      <div class="modal-body" style="text-align:center">
      <a id="hapus"><b class="btn btn-danger">Hapus Data</b></a>
      <a id="hapus_simpan"><b class="btn btn-warning">Hapus & Simpan Data</b></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
      
    </div>
  </div>
</div>

 <div class="modal fade tambah_kegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><b>Tambah Kegiatan</b></h3>
      </div>
      <?php echo form_open_multipart($tambah_kegiatan); ?>
      <div class="modal-body">
      <input type="hidden" id="id" name="id" >
      <div style="padding-bottom:20px">
      <label style="padding-bottom:5px"><b>Pilih Jenis Kegiatan  <small style="color">*</small></b></label>
      <select name="jenis" class="form-control" required>
          <option value="">Pilih Jenis</option>
          <option value="1">Magang</option>
          <option value="2">Bekerja</option>
      </select>
      </div>
      <br>
      <br>
      
      <div style="padding-bottom:20px">
      <label style="padding-bottom:5px"><b>Masukkan Tempat / Perusahaan  <small style="color">*</small></b></label>
      <input type="text" name="lokasi" required class="form-control">
      </div>
      <br>
      <br>
      
      <div style="padding-bottom:20px">
      <label style="padding-bottom:5px"><b>Masukkan Posisi Anda <small style="color">*</small></b></label>
      <input type="text" name="posisi" required class="form-control">
      </div>
      <br>
      <br>
      
      <div style="padding-bottom:20px">
      <label style="padding-bottom:5px"><b>Masukkan Informasi Lain</b></label>
      <textarea name="informasi" class="form-control" placeholder="Gaji , Website, Lokasi Perusahaan , dll"></textarea>
      </div>
      
      </div>
    
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Simpan">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
       <?php echo form_close(); ?>
      
    </div>
  </div>
</div>

<?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>
  
 <script>
$(document).ready(function() {
  $('.tambah_hoby').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);
    modal.find('#id').attr('value',div.data('id'));
  });
  $('.tambah_kegiatan').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);
    modal.find('#id').attr('value',div.data('id'));
  });
   $('.hapus_kegiatan').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);
    modal.find('#hapus').attr('href',div.data('hapus'));
    modal.find('#hapus_simpan').attr('href',div.data('hapus_simpan'));
  });
});    
</script>
