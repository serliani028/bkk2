<!-- Content Wrapper. Contains page content -->

<?php include('function_psikotes.php');?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i style="font-size:15px" class="fa fa-user"></i> <small> Data Guru Terdaftar </small> <?=@$smk;?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Guru Terdaftar SMK </li>
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
                <td ><b>Nama / NIP Guru SMK </b></td>
                <td ><b>Jurusan</b></td>
                <td ><b>Tanggal Mendaftar </b></td>
                <td style="text-align:center"><b>Status Akun</b></td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($prakerja as $baris) {
                    $id_kandidat = base64_encode($baris->candidate_id);
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td><?=$baris->first_name." &nbsp;".$baris->last_name;?><br>
                
                <b style="color:blue">NIS : <?=$baris->nis;?></b>
                </td>
                <td><b style="color:black"><?=$baris->jurusan;?></b></td>
               
                <td><?=$baris->tanggal_lamar;?></td>
                <td style="text-align:center">
                
                <?php if($baris->status == 1){ ?>
                <button class="btn btn-success btn-sm">Aktif</button>
                <?php }else{ ?>
                <button class="btn btn-success btn-sm">NonAktif</button>
                <?php } ?>
                
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

