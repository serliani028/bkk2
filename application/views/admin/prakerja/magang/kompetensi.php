<!-- Content Wrapper. Contains page content -->

<?php include('function_psikotes.php');?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i style="font-size:15px" class="fa fa-user"></i> <small> Data Tes Kompetensi Siswa </small> <?=@$smk;?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Tes Kompetensi Siswa </li>
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
                <td ><b>Tgl. Melamar</b></td>
                <td ><b>Tes Kompetensi</b></td>
                <td style="text-align:center"><b>Status</b></td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($prakerja as $baris) {
                    $hasil = 0;
                    $hasil = (100/$baris->total_questions)*$baris->correct_answers;
                    $id_kandidat = base64_encode($baris->candidate_id);
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td><?=$baris->first_name." &nbsp;".$baris->last_name;?><br>
                <b style="color:blue">NIS : <?=$baris->nis;?></b>
                </td>
                <td><b style="color:black"><?=$baris->jurusan;?></b></td>
                <td><b style="color:black"><?=$baris->judul_pekerjaan;?></b></td>
                <td><?=$baris->tanggal_lamar;?></td>
                  <td>
                 <?=$baris->quiz_title;?>
                </td>
                <td> 
                <?php if ($baris->status_kuis == 0){?>
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

