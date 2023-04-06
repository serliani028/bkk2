<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-cube"></i> Kelola Data Pengalaman <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fas fa-cube"></i> Data Pengalaman </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" style="overflow-x: auto;">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
              
              <b data-toggle="modal" data-target=".tambah_pengalaman" class="btn btn-md btn-primary"><i class="fas fa-plus"></i> Tambah Pengalaman</b>
              
            <?php include(VIEW_ROOT.'/admin/partials/messages.php'); ?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="sertifikat" class="table"  >
              <thead>
                <tr class="text-center">
                <td ><b>No.</b></td>
                <td ><b>Jenis Pengalaman </b></td>
                <td ><b>Status Pengalaman </b></td>
                </tr>
              </thead>
              <tbody>
                <?php 
                if($data){
                $no=1; foreach ($data as $key) { ?>
                <tr class="text-center">
                    <td><?=$no++?></td>
                    <td>
                        Pengalaman <?=$key->jenis;?>
                        <?php if($key->id != 1){?>
                        <br>
                        <b class="btn btn-xs btn-warning"
                         data-target=".edit_pengalaman" 
                         data-toggle="modal"
                         data-id = '<?=$key->id;?>'
                         data-jenis = '<?=$key->jenis;?>'
                        ><i class="fas fa-pen"></i> Edit Pengalaman</b>
                        <?php }?>
                    </td>
                    <td>
                        <?php if($key->id != 1){?>
                       <?php if($key->status == 1){?>
                       <a href="<?=base_url()?>status_pengalaman/<?=encode($key->id);?>/0"><b class="badge" style="background-color:green">Status Aktif</b></a>
                       <?php }else{?>
                       <a href="<?=base_url()?>status_pengalaman/<?=encode($key->id);?>/1"><b class="badge" style="background-color:red">Status NonAktif</b></a>
                      <?php } }else{?>
                        <b class="badge" style="background-color:grey">Jenis Default</b>
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

<div class="modal fade edit_pengalaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Edit Pengalaman</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($edit_pengalaman); ?>
        <input type="hidden" name="id" id="id" class="form-control" required>
        <label>Masukkan Jenis Pengalaman</label>
        <input type="text" name="jenis" id="jenis" class="form-control" required>
        <br>
        <button type="submit" class="btn btn-sm btn-success">SIMPAN</button>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade tambah_pengalaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Tambah Jenis Pengalaman</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($tambah_pengalaman); ?>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <label>Masukkan Jenis Pengalaman</label>
        <input type="text" name="jenis" class="form-control" required>
        <br>
        <button type="submit" class="btn btn-sm btn-success">SIMPAN</button>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- <form id="candidates-form" method="POST" action="<?php echo base_url(); ?>admin/candidates/excel" target='_blank'></form> -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
$('#sertifikat').DataTable();
});

$(document).ready(function() {
  
   $('.tambah_pengalaman').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
  });
  
  $('.edit_pengalaman').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    
    modal.find('#id').attr('value',div.data('id'));
    modal.find('#jenis').attr('value',div.data('jenis'));
  });
  
});

</script>


</body>
</html>
