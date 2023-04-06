<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Mitra Vokasi SMK/SMA <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Mitra Vokasi SMK/SMA </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" style="overflow-x: auto;">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <?php include(VIEW_ROOT.'/admin/partials/messages.php'); ?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="sertifikat" class="table"  >
              <thead>
                <tr>
                <td ><b>No.</b></td>
                <td ><b>NPSN </b></td>
                <td ><b>Nama Sekolah </b></td>
                <!--<td ><b>Provinsi</b></td>-->
                <td ><b>Kabupaten</b></td>
                <!--<td ><b>Alamat</b></td>-->
                <td class="text-center"><b>MOU</b></td>
                <!--<td ><b>Tgl. Daftar</b></td>-->
                <td class="text-center"><b>Status Akun</b></td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($prakerja as $baris) {
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td><?=$baris->npsn;?></td>
                <td>
                <a href="javascript:;" 
                data-npsn="<?=$baris->npsn;?>" 
                data-nama="<?=$baris->nama;?>" 
                data-no_telp="<?=$baris->no_telp;?>" 
                data-email="<?=$baris->email;?>" 
                data-provinsi="<?=$baris->prov;?>" 
                data-kabupaten="<?=$baris->kab;?>" 
                data-kecamatan="<?=$baris->kec;?>" 
                data-alamat="<?=$baris->alamat;?>"  
                data-created_at="<?=$baris->created_at;?>"  
                data-status_mitra="<?=$baris->status;?>"  
                data-toggle="modal" data-target="#modal_mitra">
                <b><?=$baris->nama;?></b>
                </a>
                <br>
                <?php if($baris->link_siswa == ''){?>
                <b data-id_mitra = '<?=$baris->id_mitra?>' data-link_siswa='<?=implode('_',explode(' ',strtolower($baris->nama)))?>'
                data-toggle="modal" data-target=".edit_link" data-jenis="1"
                class="btn btn-xs btn-info">Buat Link Pendaftaran</b>    
                <?php }else{?>
                <b><?=base_url().'register/'.$baris->link_siswa?></b><br>
                <b data-id_mitra = '<?=$baris->id_mitra?>' data-link_siswa='<?=$baris->link_siswa?>'
                data-toggle="modal" data-target=".edit_link" data-jenis="2"
                class="btn btn-xs btn-warning">Edit Link</b>    
                <?php }?>
                <a 
                href="javascript:;" 
                data-id_mitra="<?=$baris->id_mitra;?>"  
                data-toggle="modal" data-target=".modal_import_mitra"
                ><b class="btn btn-xs btn-primary"> Import Data Siswa</b></a>
                </td>
                <!--<td><?=$baris->prov;?></td>-->
                <td><?=$baris->kab;?></td>
                <!--<td><?=$baris->alamat;?></td>-->
                <td class="text-center">
                    <?php if($baris->status_mitra == 1){?>
                    <i class="fas fa-check"></i> | <b 
                    data-mou="<?=base_url('assets/admin/mou/'.$baris->mou);?>" 
                    data-jenis= '1'; 
                    data-id_mitra= '<?=$baris->id_mitra;?>'; 
                     data-toggle="modal" 
                     data-target=".edit_mou"
                    class="btn btn-primary btn-xs">Lihat MOU</b>
                    <?php }else{?>
                    <i class="fas fa-times">
                    </i> | 
                    <b  
                     data-toggle="modal"
                    data-id_mitra= '<?=$baris->id_mitra;?>';
                    data-jenis= '2';
                     data-target=".edit_mou"
                    class="btn btn-warning btn-xs">Kirim MOU</b>
                    <?php }?>
                </td>
                <!--<td><?=$baris->created_at;?></td>-->
                <td style="text-align:center"> 
                <?php 
                if($baris->status == 1){?>
                <!--<td>-->
                <b class="btn btn-success btn-xs ">Aktif</b>
                <!--</td>    -->
                <!--<td>-->
                <?php echo form_open_multipart($action); ?>
                <input type="hidden" name="id" value="<?=$baris->id_mitra;?>" required="1">
                <input type="hidden" name="status" value="vokasi" required="1">
                <input type="hidden" name="value" value="0" required="1">
                <button class="btn btn-danger btn-xs "><i class="fa fa-power-off"></i></button>
                <?php echo form_close(); ?>
                <!--</td>-->
                <?php
                }else{ ?>
                <!--<td>-->
                <b class="btn btn-danger btn-xs">NonAktif</b>
                 <?php echo form_open_multipart($action); ?>
                <!--</td>    -->
                <!--<td>-->
                <input type="text" hidden="1" name="id" value="<?=$baris->id_mitra;?>" required="1">
                <input type="text" hidden="1" name="status" value="vokasi" required="1">
                <input type="text" hidden="1" name="value" value="1" required="1">
                <button class="btn btn-success btn-xs"><i class="fa fa-power-off"></i></button>
                <?php echo form_close(); ?>
                <!--</td>-->
                <?php }
                ?>
                </td>
                </tr>
                <?php 
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

<div class="modal fade" id="modal_mitra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Detail Informasi Mitra</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_userDetail">
       
       <h3 style="text-align:center"><b id="nama" ></b></h3>
       <p style="text-align:center" >NPSN : <b id="npsn"></b></p>        
       <table class="table">
        <tbody>
            <tr>
                <td>
                    <p>No. Telp Mitra</p> 
                </td>
                <td>
                <p>    : <b id="no_telp"></b></p>
                </td>
            </tr>
            
             <tr>
                <td>
                    <p>Email</p> 
                </td>
                <td>
                   <p>    : <b id="email"></b></p>
                </td>
            </tr>
      
             <tr>
                <td>
                    <p>Provinsi</p> 
                </td>
                <td>
                     <p>    : <b id="provinsi"></b></p>
                </td>
            </tr>
            
             <tr>
                <td>
                    <p>Kabupaten</p> 
                </td>
                <td>
                     <p>    : <b id="kabupaten"></b></p>
                </td>
            </tr>
            
             <tr>
                <td>
                    <p>Kecamatan</p> 
                </td>
                <td>
                     <p>    : <b id="kecamatan"></b></p>
                </td>
            </tr>
            
            <tr>
                <td>
                    <p>Alamat</p> 
                </td>
                <td>
                     <p>    : <b id="alamat"></b></p>
                </td>
            </tr>
            
            <tr>
                <td>
                    <p>Mendaftar pada</p> 
                </td>
                <td>
                     <p>    : <b id="created_at"></b></p>
                </td>
            </tr>
            
            
        </tbody>
       </table>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade edit_mou" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">MOU Mitra SMK</h3>
        
      </div>
      <div class="modal-body" id="bodymodal_edit_mou">
        <?php echo form_open_multipart($action_2); ?>
        <label id="label_mou"></label>  <a href="" target="_blank" id="mou"><b id="text_mou"></b></a>
        <br>
        <small><b style="color:red"> * File Harus Bertipe PDF</b></small>
        <input type="file" name="mou" class="form-control" required>
        <input type="hidden" name="jenis" id="jenisnya" class="form-control" required>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <br>
        <button type="submit" class="btn btn-sm btn-success">SIMPAN</button>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal_import_mitra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Import Data Siswa</h3>
        
      </div>
      <div class="modal-body" id="bodymodal_import_siswa">
        <?php echo form_open_multipart($import); ?>
        <!--<label id="label_mou"></label>  <a href="" target="_blank" id="mou"><b id="text_mou"></b></a>-->
        <!--<br>-->
        <small><b style="color:red"> * File Harus Bertipe CSV</b></small>
        <input type="file" name="file" class="form-control" required>
        <input type="hidden" name="id_mitra" id="id_mitras" class="form-control" required>
        <br>
        <button type="submit" class="btn btn-sm btn-success">SIMPAN</button>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade edit_link" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Kelola Link Pendaftaran Mitra</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($action_3); ?>
        <input type="hidden" name="jenis" id="jenisnya" class="form-control" required>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <label>Link Pendaftaran Mitra</label><br>
        <b><?=base_url().'register/'?></b>
        <input type="text" name="link_siswa" id="link_siswa" required>
        <br>
        <br>
        <button type="submit" class="btn btn-sm btn-success">SIMPAN</button>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>


<!-- <form id="candidates-form" method="POST" action="<?php echo base_url(); ?>admin/candidates/excel" target='_blank'></form> -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
$('#sertifikat').DataTable();
});

$(document).ready(function() {
  $('#modal_mitra').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);

    modal.find('#npsn').html(div.data('npsn'));
    modal.find('#nama').html(div.data('nama'));
    modal.find('#no_telp').html(div.data('no_telp'));
    modal.find('#email').html(div.data('email'));
    modal.find('#status_sekolah').html(div.data('status_sekolah'));
    modal.find('#provinsi').html(div.data('provinsi'));
    modal.find('#kabupaten').html(div.data('kabupaten'));
    modal.find('#kecamatan').html(div.data('kecamatan'));
    modal.find('#alamat').html(div.data('alamat'));
    modal.find('#created_at').html(div.data('created_at'));
   
  });
  
   $('.edit_mou').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    modal.find('#id_mitra').attr('value',div.data('id_mitra'));
    modal.find('#jenisnya').attr('value',div.data('jenis'));
    
    if(div.data('jenis') == '1'){
    modal.find('#mou').attr('href',div.data('mou'));
    modal.find('#text_mou').html('Lihat Data MOU Mitra Sebelumnya');
    modal.find('#label_mou').html('Ubah Data MOU <b style="color:red">(* Jka Ada Perubahan)</b> | ');   
    }else{
    modal.find('#mou').removeAttr('href');
    modal.find('#text_mou').html('');
    modal.find('#label_mou').html('Tambah Data MOU');    
    }
    
  });
  
  
  $('.edit_link').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    modal.find('#id_mitra').attr('value',div.data('id_mitra'));
    modal.find('#jenisnya').attr('value',div.data('jenis'));
    modal.find('#link_siswa').attr('value',div.data('link_siswa'));  
    
  });
  
  $('.modal_import_mitra').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    modal.find('#id_mitras').attr('value',div.data('id_mitra'));
  });
  
});

</script>


</body>
</html>
