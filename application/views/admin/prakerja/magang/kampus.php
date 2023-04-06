<!-- Content Wrapper. Contains page content -->

<?php include('function_psikotes.php');?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Peserta Kampus Merdeka <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Peserta Kampus Merdeka </li>
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
                <!--<td ><b>Pekerjaan </b></td>-->
                <td ><b>Kampus & Jurusan</b></td>
                <td ><b>Data Pelengkap</b></td>
                <td ><b>Judul Psikotes</b></td>
                <td ><b>Tanggal Apply </b></td>
                <td ><b>Kode Psikotes</b></td>
                <td ><b>Tes Kompetensi & Internal </b></td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($prakerja as $baris) {
              
                    switch ($baris->jurusan) 
            { 
                case 'si': 
                    $baris->jurusan = "Informatika";
                    break; 
                case 'ekbis': 
                    $baris->jurusan = "Ekonomi Bisnis";
                    break; 
                case 'mipa': 
                    $baris->jurusan = "MIPA";
                    break; 
                case 'teknik': 
                    $baris->jurusan = "Teknik";
                    break; 
                case 'dokter': 
                    $baris->jurusan = "Kedokteran / Kesehatan (perawat,bidan , dll)";
                    break; 
                case 'sastra': 
                    $baris->jurusan = "Sastra";
                    break; 
                case 'tani': 
                    $baris->jurusan = "Pertanian";
                    break;
                case 'pendik': 
                    $baris->jurusan = "Pendidikan";
                    break;
                case 'ilsos': 
                    $baris->jurusan = "Ilmu Sosial";
                    break;
                case 'hukum': 
                    $baris->jurusan = "Hukum";
                    break;
                case 'psiko': 
                    $baris->jurusan = "Psikologi";
                    break;
                case 'sosbud': 
                    $baris->jurusan = "Seni dan Budaya";
                    break;
                default: 
                    $baris->jurusan = $baris->jurusan;
                    break; 
            } 
                    $id_kandidat = base64_encode($baris->candidate_id);
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td><?=$baris->first_name." &nbsp;".$baris->last_name;?><br><b style="color:blue"><?=$baris->email;?></b>
                </td>
                <td><?=$baris->nama_kampus;?><br><b style="color:black"><?=$baris->jurusan;?></b>
                </td>
                <!-- <td>-->
                <!--Divisi : <?=$baris->divisi;?><br><b style="color:green">Jabatan : <?=$baris->jabatan;?></b>-->
                <!--</td>-->
                <td>
                    <?php if($baris->file_cv != ""){?>
                <a target="_blank" href="<?=base_url('view_cv/'.encode($baris->candidate_id));?> " >
                File CV
                </a> 
                 <?php }else{ ?>
                File CV
                <?php } ?>
                |
                    <?php if($baris->ktp != ""){?>
                 <a target="_blank" href="<?php echo candidateThumb($baris->ktp); ?>" >
                File KTP
                </a> 
                 <?php }else{ ?>
                File KTP
                <?php } ?>
               |
                <?php 
                if($baris->ijazah2 != ""){
                  if($baris->ijazah2 == "-"){
                ?>
                ---
                <?php }else{?>
                <a target="_blank" href="<?php echo candidateThumb($baris->ijazah2); ?>" >
                 Surat Rekom
                </a>
                <?php } }else{ ?>
               Surat Rekom
                <?php } ?>
                <br>
                <br>
                
            
                 
                </td>
                <td><?=$baris->title;?></td>
                <td><?=$baris->tanggal_lamar;?></td>
               
                
                 <td>
                 <?php 
                 $level = $baris->level_pekerjaan;
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
                         <?php
                         $cek = $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row();
                         if(empty($cek)){?>
                        <a target="_blank"  href="<?= "http://dev.cybersjob.com/psi/adm/psikogram_magang.php?id=".$baris->kode_aktivasi."&jenis=".$level."&login=admincybers" ?>"><span class="fas fa-clock-o"></span> Lihat Hasil Tes</a>
                       <?php } ?>
                    <?php }else if(getStatusByKode($baris->kode_aktivasi) == 0){?>
                        <button class="btn btn-warning"><?=$baris->kode_aktivasi;?></button>
                  <?php }?>
                  
                <?php 
                        }else{ ?>
                        <button class="btn btn-success">Hasil Psikotes : <span class="fa fa-star" style="color:orange"></span><?=$baris->status_tes;?></button><br><br>
                         <?php
                         $cek = $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row();
                         if(empty($cek)){?>
                        <a target="_blank" href="<?= "http://dev.cybersjob.com/psi/adm/psikogram_magang.php?id=".$baris->kode_aktivasi."&jenis=".$level."&login=admincybers" ?>"><span class="fas fa-check"></span> Lihat Hasil Tes </a>
                         <?php } ?>
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
                <button class="btn btn-success" ><i class="fas fa-check"></i> Nilai Total : <?=$baris->quizes_result;?></button>
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
