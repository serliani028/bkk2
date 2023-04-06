<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-exchange-alt"></i> Kelola Penyaluran Siswa <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fas fa-exchange-alt"></i> Kelola Penyaluran </li>
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
                <tr class="text-center">
                <td width="5%"><b>No.</b></td>
                <td ><b>Tahun Angakatan </b></td>
                <td ><b>Penyaluran Magang</b></td>
                <td ><b>Penyaluran Wirausaha</b></td>
                <td class="text-center"><b>Kelola Data Siswa</b></td>
                </tr>
              </thead>
              <tbody>
                <?php 
                if($data){
                $no=1; foreach ($data as $key) { ?>
                <tr class="text-center">
                    <td><?=$no++?></td>
                    <td>Tahun Angkatan <?=$key->tahun;?></td>
                    <td><b class="btn btn-xs btn-danger"><?=$key->jumlah_magang;?> Siswa</b></td>
                    <td><b class="btn btn-xs btn-primary"><?=$key->jumlah_wirausaha;?> Siswa</b></td>
                    <td>
                       <a href="<?=base_url()?>sekolah/kelola-siswa-magang/<?=encode($key->id_tahun);?>"><b class="btn btn-sm btn-danger">
                           <i class="fas fa-sync"></i> Siswa Magang</b>
                       </a>
                       <a href="<?=base_url()?>sekolah/kelola-siswa-wirausaha/<?=encode($key->id_tahun);?>"><b class="btn btn-sm btn-primary">
                           <i class="fas fa-sync"></i> Siswa Wirausaha</b>
                       </a>
                    </td>
                </tr>
                <?php } } ?>
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
