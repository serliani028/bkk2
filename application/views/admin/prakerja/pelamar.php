<!-- Content Wrapper. Contains page content -->

<?php include('function_psikotes.php');?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Pelamar (Verify) <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Pendaftar </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" style="overflow-x: auto;">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">


          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- <button class="btn btn-primary" data-toggle="modal" href="#modal_userDetail" >Import Data Prakerja</button><br><br> -->
            <table class="table table-bordered table-striped" id="sertifikat" >
              <thead>
                <tr>
                <td ><b>No.</b></td>
                <td ><b>Nama </b></td>
                <td ><b>Pekerjaan </b></td>
                <td ><b>Data Pelengkap</b></td>
                <td ><b>Judul Psikotes</b></td>
                <td ><b>Tanggal Apply </b></td>
                <td ><b>Kode Aktivasi</b></td>
                <!--<td style="width:11%"><b>Pembayaran</b></td>-->
                <!--<td style="width:11%"><b>Pembayaran</b></td>-->
                <!--<td ><b>Akumulasi Psikogram & Interview</b></td>-->
                <!--<td ><b>Google Form</b></td>-->
                <!--<td style="width:10%"><b>Bukti </b></td>-->
                <td ><b>Status </b></td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($prakerja as $baris) {
                    $id_kandidat = base64_encode($baris->candidate_id);
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td><?=$baris->first_name." &nbsp;".$baris->last_name;?><br><b style="color:blue"><?=$baris->email;?></b>
                </td>
                 <td>
                Divisi : <?=$baris->divisi;?><br><b style="color:green">Jabatan : <?=$baris->jabatan;?></b>
                </td>
                <td>
                    <?php if($baris->file_cv != ""){?>
                <a class="btn btn-primary btn-xs" target="_blank" href="<?=base_url('view_cv/'.encode($baris->candidate_id));?> " >
                CV
                </a> 
                 <?php }else{ ?>
                <button class="btn btn-warning btn-xs">KTP</button>
                <?php } ?>
                    <?php if($baris->ktp != ""){?>
                 <a class="btn btn-primary btn-xs" target="_blank" href="<?php echo candidateThumb($baris->ktp); ?>" >
                KTP
                </a> 
                 <?php }else{ ?>
                <button class="btn btn-warning btn-xs">KTP</button>
                <?php } ?>
               
                <?php 
                if($baris->ijazah2 != ""){
                  if($baris->ijazah2 == "-"){
                ?>
                <button class="btn btn-danger btn-xs">Tidak Berijazah</button>
                <?php }else{?>
                <a class="btn btn-primary btn-xs" target="_blank" href="<?php echo candidateThumb($baris->ijazah2); ?>" >
                 Ijazah
                </a>
                <?php } }else{ ?>
               <button class="btn btn-warning btn-xs">Ijazah</button>
                <?php } ?>
                <br>
                <br>
                
                <?php 
                if($baris->skck != ""){
                ?>
                <a class="btn btn-primary btn-xs" target="_blank" href="<?php echo candidateThumb($baris->skck); ?>" >
                 SKCK
                </a>
                <?php }else{ ?>
                <button class="btn btn-warning btn-xs">SKCK</button>
                <?php } ?>
                
                <?php 
                if($baris->sk_covid != ""){
                ?>
                <a class="btn btn-primary btn-xs" target="_blank" href="<?php echo candidateThumb($baris->sk_covid); ?>" >
                Suket Pernah Bekerja
                </a>
                <?php }else{ ?>
                <button class="btn btn-warning btn-xs">Suket Pernah Bekerja</button>
                <?php } ?>
                
                 
                </td>
                <td><?=$baris->title;?></td>
                <td><?=$baris->tanggal_lamar;?></td>
                <!--<td>
                <?php 
                if($baris->status_minat == 1){
                ?>
                <p class="btn btn-warning">Manager</p>
                <?php
                }else {
                ?>
                <p class="btn btn-info">Staff</p>
                <?php 
                }
                ?></td>-->
                
                 <td>
                 <?php 
                 $level = $baris->level_pekerjaan;
        if($level == "supervisor"){
        $level = "supervisor";
        }else{
        if($level == "ceo" || $level == "direktur" || $level == "manager" ){
            $level = "manager";
        }else if($level != "ceo" && $level != "direktur" && $level != "manager" && $level != "staffadmin" && $level != "staffmarketing" && $level != "desainvideo" && $level != "analisabisnis" && $level != "itstaff" ){
            $level = "staffadmin";
        }
        }
                
                if($baris->kode_aktivasi == ""){?>
                  <!--   <a href="javascript:;"-->
                  <!--data-kode="<?=$baris->id_lamar;?>"-->
                  <!--data-toggle="modal" data-target="#modal_tambah_kode">-->
                <button class="btn btn-secondary">Kode Aktivasi</button>
                <!--</a>-->
                
                <?php
                     }else{ 
                    if($baris->status_tes == 0){
                        if(getStatusByKode($baris->kode_aktivasi) == 0 && getProgressByKode($baris->kode_aktivasi) == 0){ ?>
                        <button class="btn btn-warning"><?=$baris->kode_aktivasi;?></button>
                  <?php }else if(getProgressByKode($baris->kode_aktivasi) == 1){ ?>
                        <button class="btn btn-primary"><?=$baris->kode_aktivasi;?></button>
                  <?php }else if(getStatusByKode($baris->kode_aktivasi) == 1 && getProgressByKode($baris->kode_aktivasi) == NULL){ ?>
                        <button class="btn btn-success"><?=$baris->kode_aktivasi;?></button><br><br>
                        
                        <a target="_blank"  href="<?= "http://dev.cybersjob.com/psi/adm/psikogram_internal.php?id=".$baris->kode_aktivasi."&jenis=".$level."&login=admincybers" ?>"><span class="fas fa-clock-o"></span> Lihat Hasil Tes</a>
                       
                    <?php }else if(getStatusByKode($baris->kode_aktivasi) == 0){?>
                        <button class="btn btn-warning"><?=$baris->kode_aktivasi;?></button>
                  <?php }?>
                  
                <?php 
                        }else{ ?>
                        <button class="btn btn-success"><?=$baris->kode_aktivasi;?></button><br><br>
                        <a target="_blank" href="<?= "http://dev.cybersjob.com/psi/adm/psikogram_internal.php?id=".$baris->kode_aktivasi."&jenis=".$level."&login=admincybers" ?>"><span class="fas fa-check"></span> Lihat Hasil Tes </a>
                        <?php }
                     }
                 
                     ?>
                </td>
                
               <!-- <td>-->
              <!--?php -->
               <!-- if($baris->status_bayar == 0){?>-->
               <!--<a href="<?=base_url('kirim_invoice/'.$baris->id_lamar);?>">-->
               <!-- <p class="btn btn-info" style="padding:5px">Kirim Invoice </p>-->
               <!-- </a>-->
               <!--?php-->
               <!-- }elseif ($baris->status_bayar == 1){-->
               <!-- echo "<p style='color:red'><b><u>Belum Dibayar</u></b></p>";-->
               <!-- }elseif($baris->status_bayar == 2){?>-->
               <!--  <a href="<?=base_url('verif_bayar/'.$baris->id_lamar);?>">-->
               <!--  <p class="btn btn-success" style="padding:5px">Verifikasi Bayar </p>-->
               <!--  </a>-->
                <!--?php }elseif($baris->status_bayar == 3){-->
               <!-- echo "<p style='color:green'><b><u>Terverifikasi</u></b></p>";-->
               <!-- }else{-->
               <!-- echo "-";-->
               <!-- }-->
               <!-- ?>-->
               <!-- </td>-->
                <!--<td>-->
                <!--?php -->
                <!--if($baris->status_pekerjaan == 'interviewed'){-->
                <!--if($baris->link_form != ""){-->
                <!--?>-->
                
                <!--<p class="btn btn-warning">  <span class="fa fa-check"></span>&nbsp; Link Terkirim</p>-->
                <!--</a>-->
                <!--?php-->
                <!--}else {-->
                <!--?>-->
                <!--<a href="javascript:;"-->
                <!--  data-kode="<?=$baris->id_lamar;?>"-->
                <!--  data-toggle="modal" data-target="#modal_userDetail">-->
                <!--<p class="btn btn-success"> <span class="fa fa-link"></span>&nbsp; Kirim Link</p>-->
                <!--</a>-->
                <!--?php -->
                <!--}-->
                <!--}else{-->
                <!--?>-->
                <!--<p class="btn btn-danger"> <span class="fa fa-close"></span>&nbsp; Belum Tersedia</p>-->
                <!--?php -->
                <!--}-->
                <!--?>-->
                <!--</td>-->
                <!--<td>-->
                
            <!--    <td>-->
            <!--        ?php -->
            <!--         if($baris->kode_aktivasi == ""){ ?>-->
            <!--         ----->
            <!--         ?php }else{ -->
            <!--          if($baris->status_tes == ""){-->
            <!--          ?>-->
                      
            <!--        ?php
            <!--            if(getStatusByKode($baris->kode_aktivasi) == 0 && getProgressByKode($baris->kode_aktivasi) == 0){ ?>-->
            <!--            ----->
            <!--      ?php }else if(getProgressByKode($baris->kode_aktivasi) == 1){ ?>-->
            <!--            ----->
            <!--      ?php }else if(getStatusByKode($baris->kode_aktivasi) == 1 && getProgressByKode($baris->kode_aktivasi) == NULL){ ?>-->
            <!--           <a href="javascript:;"-->
            <!--            data-kode="<?=$baris->id_lamar;?>"-->
            <!--            data-toggle="modal" data-target="#modal_tambah_hasil">-->
            <!--            <button class="btn btn-info">Beri Hasil</button>-->
            <!--    </a>-->
            <!--      ?php }else if(getStatusByKode($baris->kode_aktivasi) == 0){?>-->
            <!--            ----->
            <!--      ?php }?>-->
            
            <!--?php-->
            <!--    }else{-->
            <!--        if($baris->status_tes == "Disarankan"){-->
            <!--    ?>-->
            <!--      <b class="btn btn-success" ><i class="fa fa-check"></i> <?=$baris->status_tes;?></b>-->
            <!--   ?php }else if ($baris->status_tes == "Tidak Disarankan"){?>-->
            <!--      <b class="btn btn-danger" ><i class="fa fa-times"></i> <?=$baris->status_tes;?></b>-->
            <!--  ?php
            <!--    }else if($baris->status_tes == "Dipertimbangkan"){?>-->
            <!--     <button class="btn btn-secondary" ><i class="fa fa-clock-o"></i> <?=$baris->status_tes;?></button>-->
            <!--        ?php -->
            <!--    }-->
            <!--    }-->
            <!--          }-->
            <!--         ?>-->
            <!--    </td>-->
                
                <!--?php -->
                <!--if($baris->file_bukti_bayar != ""){-->
                <!--?>-->
                <!--<a target="_blank" href="http://kandidat.cybers.id/uploads/<?=$baris->file_bukti_bayar;?>" >-->
                <!-- <p class="btn btn-primary" style="padding:5px"><i class="fa fa-file"></i> Bukti Bayar</p>-->
                <!--</a>-->
                <!--?php -->
                <!--}else{-->
                <!--echo "Belum Tersedia";-->
                <!--}-->
                <!--?>-->
                <!--</td>-->
                
                <td>
                    <div style="margin-top:5px">
                  
                <?php
                $satus = $baris->status_pekerjaan;
                if($satus == 'applied' || $satus == 'shortlisted'){?>
                <?php if ($baris->status_kuis == 0){?>
                <button class="btn btn-danger" ><i class="fas fa-window-close"></i> Tes Internal</button>
                <?php }else if($baris->status_kuis == 1) { ?>
                <button class="btn btn-warning" ><i class="fas fa-clock-o"></i> Tes Internal</button>
                <?php }else if($baris->status_kuis == 2){?>
                <button class="btn btn-success" ><i class="fas fa-check"></i> Tes Internal</button>
                <?php }?>
                <?php }else if($satus == 'interviewed'){?>
                <b style="border:1px solid blue;padding:5px;color:blue">Lolos Psikotes</b>
                <!--?php if($baris->status_tes != "" || $baris->status_tes != "Tidak Disarankan"){ ?-->
                <!--<br><br>-->
                <!--<a href="javascript:;"-->
                <!--  data-kode="<?=$baris->id_lamar;?>"-->
                <!--  data-toggle="modal" data-target="#modal_userDetail2">-->
                <!--<button class="btn btn-primary">Tugaskan Interview </button>-->
                <!--</a>-->
                <!--?php }  ?-->
                <?php }else if($satus == 'hired'){?>
                <b style="border:1px solid green;padding:5px;color:green">Dipekerjakan</b><br><br>
                <?php if ($baris->rating == ""){?>
                <b style="text-align:center">Rating : <span class="fas fa-star" style="color:yellow"> </span>0</b>
                <?php }else{?>
                <b style="text-align:center">Rating : <span class="fas fa-star" style="color:yellow"></span> <?=$baris->rating;?></b>
                <?php }?>
                <?php }else if($satus == 'rejected'){?>
                <b style="border:1px solid red;padding:5px;color:red">Ditolak</b>
                <?php }else if($satus == 'INTERVIEW TAHAP 2'){?>
                <b class="btn btn-warning">Diinterview </b>
                <?php }
                ?>
               </div>
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

<!-- <form id="candidates-form" method="POST" action="<?php echo base_url(); ?>admin/candidates/excel" target='_blank'></form> -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>
<script type="text/javascript">
$(document).ready(function() {
$('#sertifikat').DataTable();
});
</script>

<!-- page script -->
<!-- <script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script> -->

<div class="modal fade" id="modal_userDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Link Google Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_userDetail">
        
        <input type="text" id="url" value="<?=base_url('cek_form');?>" hidden="1">
        
        <?php echo form_open_multipart($action); ?>
        <div>
        <input type="text" hidden="1" name="id" id="kode" required="1">
        
        <label for="input-file-now-custom-1">
          Link Google Form <small style="color:red">* </small>
        </label>
        <select id="select_form" required="1" class="form-control">
            <option value="">Pilih Link Google Form</option>
            <?php foreach ($link as $baris) {
            ?>
            <option value="<?=$baris->id;?>"><?=$baris->nama;?></option>
            <?php } ?>    
        </select>
        <br>
        <input type="text" required="1" value="<?=$this->session->userdata('admin')['first_name'];?>" name="admin"  hidden="1">
        <input type="text" required="1" id="nama" name="nama"  hidden="1">
        <input type="text" required="1" id="link" name="link" hidden="1">
        <input type="text" required="1" id="batas" name="batas" hidden="1">
        
          <small class="form-text text-muted">Pilih Link Google Form</small>
        </div>
        <br>
        <div>
        <!--<label for="input-file-now-custom-1">-->
        <!--  Tanggal Kirim<small style="color:red">* </small>-->
        <!--</label>-->
        <input type="text" required="1" value="<?=date('Y-m-d H:i:s')?>" hidden="1" name="tanggal">
          <!--<small class="form-text text-muted">Tanggal Kirim</small>-->
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-success" name="import">Kirim Link </button>
         <?php echo form_close(); ?>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_userDetail2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Link Zoom Interview </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_userDetail2">
        <?php echo form_open_multipart($action2); ?>
        <div>
        <input type="text" hidden="1" name="id" id="kode" required="1">
        
        <label for="input-file-now-custom-1">
          Link Google Form <small style="color:red">* </small>
        </label>
        <select id="select_form" required="1" name="link_interview2" class="form-control">
            <option value="">Pilih Link Zoom</option>
            <?php foreach ($link_zoom as $baris) {
            ?>
            <option value="<?=$baris->link;?>"><?=$baris->nama;?></option>
            <?php } ?>    
        </select>
        <br>
          <small class="form-text text-muted">Pilih Link Zoom</small>
        </div>
        <br>
        <div>
        <label for="input-file-now-custom-1">
          Tanggal Zoom Interview <small style="color:red">* </small>
        </label>
        <input class="form-control" type="text" id="tgl_zoom" required="1" name="tgl_interview2">
          <small class="form-text text-muted">Tanggal Zoom Interview</small>
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-success" name="import">Kirim Link Zoom</button>
         <?php echo form_close(); ?>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_tambah_kode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Kode Aktivasi Tes Psikologi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_tambah_kode">
        <?php echo form_open_multipart($action_kode); ?>
        <div>
        <input type="text" hidden="1" name="candidate_id" id="kode" required="1">
        
        <label for="input-file-now-custom-1">
          Kode Aktivasi <small style="color:red">* </small>
        </label>
       <input class="form-control" type="text" required="1" name="kode_aktivasi">
        <br>
          <small class="form-text text-muted">Masukkan Kode Aktivasi</small>
        </div>
        <br>
         <div>
        
        <label for="input-file-now-custom-1">
          Judul Tes Psikologi <small style="color:red">* </small>
        </label>
       <input class="form-control" type="text" required="1" name="deskripsi">
        <br>
          <small class="form-text text-muted">Masukkan Judul Tes Psikologi</small>
        </div>
        <br>
         <div>
        
        <label for="input-file-now-custom-1">
          Tanggal Tes Psikologi <small style="color:red">* </small>
        </label>
       <input class="form-control" type="text" id="tgl_kode" required="1" name="tgl_kode">
        <br>
          <small class="form-text text-muted">Masukkan Tanggal Tes Psikologi</small>
        </div>
        
        <br>
        <br>
        <button type="submit" class="btn btn-success" name="import">Kirim Kode Aktivasi </button>
         <?php echo form_close(); ?>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_tambah_hasil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Beri Hasil Akumulasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_tambah_hasil">
        <?php echo form_open_multipart($action_hasil); ?>
        <div>
        <input type="text" hidden="1" name="id" id="kode" required="1">
        
        <label for="input-file-now-custom-1">
          Pilih Hasil Akumulasi<small style="color:red">* </small>
        </label>
       <select required="1" name="value" class="form-control">
            <option value="">Pilih Hasil</option>
            <option value="Disarankan">Disarankan</option>
            <option value="Dipertimbangkan">Dipertimbangkan</option>
            <option value="Tidak Disarankan">Tidak Disarankan</option>
        </select>
        <br>
          <small class="form-text text-muted">Pilih Hasil Akumulasi</small>
        </div>
        
        <br>
        <br>
        <button type="submit" class="btn btn-success" name="import">Beri Hasil </button>
         <?php echo form_close(); ?>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bayarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Link</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
        </div>
    </div>
  </div>
</div>

<script>

$(document).ready(function() {
  $('#tgl_zoom').datetimepicker({
  showPeriodLabels: false
  });
  $('#tgl_kode').datepicker({
  showPeriodLabels: false
  });
 });

$(document).ready(function() {
  // Untuk sunting
  $('#modal_userDetail').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);

    // Isi nilai pada field
    modal.find('#kode').attr("value",div.data('kode'));
  });
});

$(document).ready(function() {
  // Untuk sunting
  $('#modal_tambah_kode').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);

    // Isi nilai pada field
    modal.find('#kode').attr("value",div.data('kode'));
  });
});

$(document).ready(function() {
  // Untuk sunting
  $('#modal_tambah_hasil').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);

    // Isi nilai pada field
    modal.find('#kode').attr("value",div.data('kode'));
  });
});

$(document).ready(function() {
  // Untuk sunting
  $('#modal_userDetail2').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);

    // Isi nilai pada field
    modal.find('#kode').attr("value",div.data('kode'));
  });
});

$(document).ready(function() {
  // Untuk sunting
  $('#bayarModal').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);

    // Isi nilai pada field
    modal.find('#admin').attr("value",div.data('admin'));
    modal.find('#link').attr("value",div.data('link'));
    modal.find('#tanggal').attr("value",div.data('tanggal'));
  });
});


    $(document).ready(function(){

  $('#select_form').change(function(){
    var id=$(this).val();
    var url=$('#url').val();
    $.ajax({
      url : url,
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
        // console.log(data)
       
        $('#nama').val(data.nama);
        $('#link').val(data.link);
        $('#batas').val(data.batas);
      }
    });
    return false;
  });

});

</script>

</body>
</html>
