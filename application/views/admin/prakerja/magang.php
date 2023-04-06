<!-- Content Wrapper. Contains page content -->

<?php include('function_psikotes.php');?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Peserta Magang <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Peserta Magang </li>
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
                <button class="btn btn-secondary">Kode Aktivasi</button>
                
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


</body>
</html>
