<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Mitra Kampus Merdeka <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Mitra Kampus Merdeka </li>
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
                <td ><b>Nama Kampus </b></td>
                <td ><b>No.Telepon</b></td>
                <td ><b>Email</b></td>
                <td ><b>Alamat</b></td>
                <td ><b>Tanggal Daftar </b></td>
                <td ><b>Status </b></td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($prakerja as $baris) {
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td><?=$baris->nama;?></td>
                <td><?=$baris->no_telp;?></td>
                <td><?=$baris->email;?></td>
                <td><?=$baris->alamat;?></td>
                <td><?=$baris->created_at;?></td>
                <td>
                 <?php 
                if($baris->status == 1){?>
                <?php echo form_open_multipart($action); ?>
                <input type="text" hidden="1" name="id" value="<?=$baris->id_mitra;?>" required="1">
                <input type="text" hidden="1" name="status" value="kampus" required="1">
                <input type="text" hidden="1" name="value" value="0" required="1">
                <button type="submit" class="btn btn-success btn-sm">Aktif</button>
                <?php echo form_close(); ?>
                <?php
                }else{ ?>
                 <?php echo form_open_multipart($action); ?>
                <input type="text" hidden="1" name="id" value="<?=$baris->id_mitra;?>" required="1">
                <input type="text" hidden="1" name="status" value="kampus" required="1">
                <input type="text" hidden="1" name="value" value="1" required="1">
                <button type="submit" class="btn btn-danger btn-sm">NonAktif</button>
                <?php echo form_close(); ?>
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

<!-- <form id="candidates-form" method="POST" action="<?php echo base_url(); ?>admin/candidates/excel" target='_blank'></form> -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>
<script type="text/javascript">
$(document).ready(function() {
$('#sertifikat').DataTable();
});
</script>


</body>
</html>
