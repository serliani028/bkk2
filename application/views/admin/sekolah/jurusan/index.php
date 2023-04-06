<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-archive"></i> Data Jurusan <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fas fa-archive"></i> Data Jurusan </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" style="overflow-x: auto;">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
              
              <b data-toggle="modal" data-target=".tambah_jurusan" data-id_mitra = '<?=$id;?>' class="btn btn-md btn-primary"><i class="fas fa-plus"></i> Tambah Jurusan</b>
              
            <?php include(VIEW_ROOT.'/admin/partials/messages.php'); ?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="sertifikat" class="table"  >
              <thead>
                <tr class="text-center">
                <td ><b>No.</b></td>
                <td ><b>Jenis Jurusan </b></td>
                <td ><b>Jumlah Siswa X </b></td>
                <td ><b>Jumlah Siswa XI </b></td>
                <td ><b>Jumlah Siswa XII </b></td>
                <td class="text-center"><b>Kelola Jurusan</b></td>
                </tr>
              </thead>
              <tbody>
                <?php 
                if($data){
                $no=1; foreach ($data as $key) { ?>
                <tr class="text-center">
                    <td><?=$no++?></td>
                    <td>#<?=$key['id_jurusan'];?> - <b>Jurusan <?=$key['jurusan'];?></b></td>
                    <td><?=$key['kelasX'];?> Siswa</td>
                    <td><?=$key['kelasXI'];?> Siswa</td>
                    <td><?=$key['kelasXII'];?> Siswa</td>
                    <td>
                        <b class="btn btn-xs btn-warning"
                         data-target=".edit_jurusan" 
                         data-toggle="modal"
                         data-id_mitra = '<?=$id;?>'
                         data-jurusan = '<?=$key['jurusan'];?>'
                         data-id = '<?=$key['id_jurusan'];?>'
                        ><i class="fas fa-pen"></i> Edit Jurusan</b>
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

<div class="modal fade edit_jurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Edit Jurusan</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($edit_jurusan); ?>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <input type="hidden" name="id" id="id" class="form-control" required>
        <label>Masukkan Nama Jurusan</label>
        <br>
        <small style="color:red"><b>* Nama Jurusan Tidak Boleh Sama dengan Nama Jurusan yang sudah ada</b></small>
        <input type="text" name="jurusan" id="jurusan" class="form-control" required>
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

<div class="modal fade tambah_jurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Tambah Jurusan</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($tambah_jurusan); ?>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <label>Masukkan Nama Jurusan</label>
        <br>
        <small style="color:red"><b>* Masukkan Nama Jurusan Tanpa Ada "Jurusan" (ex : "Teknik Jaringan")</b></small>
        <input type="text" name="jurusan" placeholder="Masukkan Nama Jurusan" class="form-control" required>
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
  
   $('.tambah_jurusan').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    modal.find('#id_mitra').attr('value',div.data('id_mitra'));
  });
  
  $('.edit_jurusan').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    
    modal.find('#id_mitra').attr('value',div.data('id_mitra'));
    modal.find('#id').attr('value',div.data('id'));
    modal.find('#jurusan').attr('value',div.data('jurusan'));
  });
  
});

</script>


</body>
</html>
