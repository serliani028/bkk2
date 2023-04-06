<!-- Content Wrapper. Contains page content -->

<?php include('function_psikotes.php');?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i style="font-size:20px" class="fa fa-user"></i> Data Psikotes Siswa </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Psikotes Siswa </li>
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
                <td ><b>Nama Siswa </b></td>
                <td ><b>Jurusan</b></td>
                <td ><b>Pilihan Magang</b></td>
                <!--<td ><b>Tgl. Melamar</b></td>-->
                <!--<td ><b>Kode Aktivasi</b></td>-->
                <td style="text-align:center" ><b>Status Psikotes</b></td>
                <td><b>Status Tes Kompetensi</b></td>
                <!--<td><b>Status Magang</b></td>-->
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($prakerja as $baris) {
                     $hasil = $baris->quizes_result;
                    $id_kandidat = base64_encode($baris->candidate_id);
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td><?=$baris->first_name." &nbsp;".$baris->last_name;?><br>
                <b style="color:blue">NIS : <?=$baris->nis;?></b>
                </td>
                <td><b style="color:black"><?=$baris->jurusan;?></b></td>
                <td><b style="color:black"><?=$baris->lamaran;?></b></td>
                <td style="text-align:center">
                  <?php 
                if($baris->kode_aktivasi == ""){?>
                <button class="btn btn-secondary">Belum Ditugaskan </button>
                <?php
                     }else{ 
                    if($baris->status_tes == 0){
                        if(getStatusByKode($baris->kode_aktivasi) == 0 && getProgressByKode($baris->kode_aktivasi) == 0){ ?>
                        <button class="btn btn-warning">Belum Dikerjakan</button>
                  <?php }else if(getProgressByKode($baris->kode_aktivasi) == 1){ ?>
                        <button class="btn btn-primary">Belum Selesai</button>
                  <?php }else if(getStatusByKode($baris->kode_aktivasi) == 1 && getProgressByKode($baris->kode_aktivasi) == NULL){ ?>
                        <button class="btn btn-success">Sudah Selesai</button><br><br>
                         <?php
                         $cek = $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row();
                         if(empty($cek)){?>
                        <a target="_blank"  href="<?= "http://psikotest.cybersjob.com/psi/adm/psikogram_magang.php?id=".$baris->kode_aktivasi."&jenis=".$level."&login=admincybers" ?>"><span class="fas fa-clock-o"></span> Lihat Hasil Tes</a>
                       <?php } ?>
                    <?php }else if(getStatusByKode($baris->kode_aktivasi) == 0){?>
                        <button class="btn btn-warning">Belum Dikerjakan</button>
                  <?php }?>
                  
                <?php 
                        }else{ ?>
                        <button class="btn btn-success">Hasil Psikotes : <span class="fa fa-star" style="color:orange"></span><?=$baris->status_tes;?></button><br><br>
                         <?php
                         $cek = $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row();
                         if(empty($cek)){?>
                        <a target="_blank" href="<?= "http://psikotest.cybersjob.com/psi/adm/psikogram_magang.php?id=".$baris->kode_aktivasi."&jenis=".$level."&login=admincybers" ?>"><span class="fas fa-check"></span> Lihat Hasil Tes </a>
                         <?php } ?><?php }
                     }
                 
                     ?>
                </td>
                
                 <td> 
                <?php 
                if ($baris->status_kuis == 0){?>
                <button class="btn btn-danger" ><i class="fas fa-window-close"></i> Belum Dikerjakan</button>
                <?php }else if($baris->status_kuis == 1) { ?>
                <button class="btn btn-warning" ><i class="fas fa-clock-o"></i> Belum Selesai</button>
                <?php }else if($baris->status_kuis == 2){?>
                <button class="btn btn-success" ><i class="fas fa-check"></i> Nilai Total : <?=ceil($hasil);?></button>
                <?php }?>
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

