<!-- Content Wrapper. Contains page content -->

<?php include('function_psikotes.php');?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Peserta Vokasi SMK/SMA <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Peserta Vokasi SMK/SMA </li>
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
                <tr >
                <td ><b>No.</b></td>
                <td ><b>Nama Sekolah </b></td>
                <td style="text-align:center"><b>Siswa Terdaftar </b></td>
                <td style="text-align:center"><b>Ikuti Psikotes </b></td>
                <td style="text-align:center"><b>Ikuti Tes Kompetensi </b></td>
                <td style="text-align:center"><b>Total Siswa Lolos </b></td>
                </tr>
              </thead>
              <tbody>
                  <?php $no=1; foreach ($prakerja as $baris) { ?>
                  <tr>
                      <td><b><?=$no++;?></b></td>
                      <td><b><?=$baris->nama;?></b></td>
                      <td style="text-align:center"><?=$baris->daftar;?> Siswa  
                      <?php if($baris->daftar != 0){?> | <a href="<?=base_url('')?>admin/pendaftar-user/<?=encode($baris->id_mitra);?>" target="_blank">Detail Siswa</a> <?php } ?> 
                      </td>
                      <td style="text-align:center"><?=$baris->tes;?> Siswa 
                        <?php if($baris->tes != 0){?> | <a href="<?=base_url('')?>admin/pendaftar-psikotes/<?=encode($baris->id_mitra);?>" target="_blank">Detail Siswa</a> <?php } ?>
                      </td>
                      <td style="text-align:center"><?=$baris->kompetensi;?> Siswa 
                    <?php if($baris->kompetensi != 0){?> | <a href="<?=base_url('')?>admin/pendaftar-kompetensi/<?=encode($baris->id_mitra);?>" target="_blank">Detail Siswa</a> <?php } ?>
                      </td>
                      <td style="text-align:center"><?=$baris->lolos;?> Siswa 
                    <?php if($baris->lolos != 0){?> | <a href="<?=base_url('')?>admin/pendaftar-lolos/<?=encode($baris->id_mitra);?>" target="_blank">Detail Siswa</a> <?php } ?>
                      </td>
                  </tr>
                  <?php } ?>
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

