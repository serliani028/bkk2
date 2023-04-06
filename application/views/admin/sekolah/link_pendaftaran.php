<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-link"></i> Kelola Link Pendaftaran <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fas fa-link"></i> Link Pendaftaran </li>
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
              <?php if($link->link_siswa != ''){?>
          <p>Link Pendaftaran :</p> <input class="form-control" type="text" value="<?=base_url().'register/'.$link->link_siswa?>" id="pilih" readonly />
          <br>
          <button type="button" class="btn btn-sm btn-success" onclick="copy_text()">Copy Link</button>
              <?php }else{?>
              <p> <b>Belum Ada Link Pendaftaran Anda</b></p>
              <br>
              <?php }?>
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


<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
$('#sertifikat').DataTable();
});

 function copy_text() {
 $("#pilih").select();
 document.execCommand("copy");
 alert("Link berhasil di Copy");
 }
</script>


</body>
</html>
