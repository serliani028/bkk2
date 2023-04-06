<!-- Content Wrapper. Contains page content -->

<?php include('function_psikotes.php');?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i style="font-size:15px" class="fa fa-book"></i> <small> Kelola Jurusan </small> <?=@$smk;?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Kelola Jurusan </li>
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
                <td ><b>Nama Jurusan </b></td>
                <td ><b>Kode Jurusan </b></td>
                <td ><b>Jumlah Siswa</b></td>
                <td style="text-align:center"><b>Status Jurusan</b></td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($prakerja as $baris) {
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td><b><?=$baris->nama_jurusan;?></b></td>
                <td><?=$baris->kode_jurusan;?></td>
                <td><b style="color:black"><?=$baris->jumlah_siswa;?> Siswa</b></td>
                <td style="text-align:center">
               <?php if($baris->status_jurusan == 1) { ?>
                <button class="btn btn-success btn-sm" > Jurusan Aktif</button>
                <?php }else{?>
                <button class="btn btn-danger btn-sm" > Jurusan NonAktif</button>
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

