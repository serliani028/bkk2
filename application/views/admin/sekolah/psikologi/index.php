<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-plus"></i> Kelola Hasil Tes Psikologi <small></small></h1>
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
                <td ><b>Rata - Rata Rating </b></td>
                <td ><b>Jumlah Siswa </b></td>
                <td class="text-center"><b>Kelola Siswa</b></td>
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
                        Skala Rating  1 - 5 : <br>
                        <b>Nilai : <?=(float)$key->persentase?></b>
                        <br>
                        <?php 
                        if(floatval($key->persentase) > floatval(4.5) ){
                        for($a=0;$a<5;$a++){
                        ?>
                        <span class="fas fa-star" style="color:orange">
                        <?php } }elseif (floatval($key->persentase) > floatval(3.5) && floatval($key->persentase) <= floatval(4.5) ) {
                        for($a=0;$a<4;$a++){
                        ?>
                        <span class="fas fa-star" style="color:orange">
                        <?php } }elseif(floatval($key->persentase) > floatval(2.5) && floatval($key->persentase) <= floatval(3.5) ){
                        for($a=0;$a<3;$a++){
                        ?>
                        <span class="fas fa-star" style="color:orange">
                        <?php } }elseif(floatval($key->persentase) > floatval(1.5) && floatval($key->persentase) <= floatval(2.5) ){
                        for($a=0;$a<2;$a++){?>
                        <span class="fas fa-star" style="color:orange">
                        <?php } }elseif(floatval($key->persentase) > floatval(0.5) && floatval($key->persentase) <= floatval(1.5) ){?>
                        <span class="fas fa-star" style="color:orange">
                        <?php }else{ ?>
                        <span class="fas fa-star" style="color:grey">
                        <span class="fas fa-star" style="color:grey">
                        <span class="fas fa-star" style="color:grey">
                        <span class="fas fa-star" style="color:grey">
                        <span class="fas fa-star" style="color:grey">
                        <?php }?>
                    </td>
                    <td><?=$key->jumlah;?> Siswa</td>
                    <td>
                       <a href="<?=base_url()?>sekolah/tes_psikologi/<?=encode($key->id_tahun);?>"><b class="btn btn-xs btn-primary">
                           <i class="fas fa-sync"></i> Kelola Data Siswa</b>
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
