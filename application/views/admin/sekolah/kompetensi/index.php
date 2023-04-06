<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-plus"></i> Kelola Hasil Tes Kompetensi <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fas fa-plus"></i> Kelola Hasil Tes </li>
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
                <td ><b>Persentase Kompetensi</b></td>
                <td ><b>Jumlah Siswa </b></td>
                <td class="text-center"><b>Kelola Tes</b></td>
                </tr>
              </thead>
              <tbody>
                <?php 
                if($data){
                $no=1; foreach ($data as $key) { ?>
                <tr class="text-center">
                    <td><?=$no++?></td>
                    <td>Tahun Angkatan <?=$key->tahun;?></td>
                    <td>
                        <?php 
                        if($key->persentase >= 80){?>
                        <b class="badge" style="font-size:13;background-color:green"><?=number_format($key->persentase);?> % </b> | Hasil Tinggi / Kompeten
                        <?php }elseif ($key->persentase <= 80 && $key->persentase >= 50) {?>
                        <b class="badge" style="font-size:13;background-color:orange"><?=number_format($key->persentase);?> %</b> | Hasil Menengah
                        <?php }else{?>
                        <b class="badge" style="font-size:13;background-color:red"><?=number_format($key->persentase);?> %</b> | Hasil Rendah
                        <?php } ?>
                    </td>
                    <td><?=$key->jumlah;?> Siswa</td>
                    <td>
                        <?php if($key->jumlah > 0){?>
                       <a href="<?=base_url()?>sekolah/tes_kompetensi/<?=encode($key->id_tahun);?>"><b class="btn btn-xs btn-primary">
                           <i class="fas fa-sync"></i> Kelola Tes Kompetensi</b>
                       </a>
                       <?php }else {?>
                       <b class="btn btn-xs btn-danger">
                           <i class="fas fa-times"></i> Belum Ada Data
                       </b>
                       <?php }?>
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
