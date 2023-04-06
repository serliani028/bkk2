<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Kelas <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Kelas </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">

          <button class="btn btn-primary" data-toggle="modal" href="#modal_userDetail">Tambah Kelas</button>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- <button class="btn btn-primary" data-toggle="modal" href="#modal_userDetail" >Import Data Prakerja</button><br><br> -->
            <table class="table table-bordered table-striped" id="kelas">
              <thead>
                <tr>
                <td ><input type="checkbox"></td>
                <td ><b>Nama Kelas</b></td>
                <td ><b>Dibuat</b></td>
                <td ><b>Dirubah</b></td>
                <td ><b>Status</b></td>
                <td ><b>Aksi</b></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($kelas as $baris) {
                  ?>
                <tr>
                <td># <?=$baris->id;?></td>
                <td><?=$baris->nama_kelas;?></td>
                <td><?=$baris->created_date;?></td>
                <td><?=$baris->update_date;?></td>
                <td><?php
                if ($baris->status == 0) {
                ?>
                <a href="<?=base_url('akftifkan_kelas/'.$baris->id);?>">
                <p class="btn btn-danger" style="padding:3px">Nonaktif</p>
                </a>
                <?php
                }else{?>
                <a href="<?=base_url('nonaktif_kelas/'.$baris->id);?>">
                <p class="btn btn-success" style="padding:3px">Aktif</p>
                </a>
                <?php
                }
                ?>
                </td>
                <td >
                  <a href="javascript:;"
                  data-id="<?=$baris->id;?>"
                  data-kode="<?=$baris->nama_kelas;?>"
                  data-harga="<?=$baris->created_date;?>"
                  data-toggle="modal" data-target="#bayarModal">
                  <p class="btn btn-warning" style="padding:4px"><i class="fa fa-link"></i> Edit</p>
                </a>
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
$('#kelas').DataTable();
});
$(document).ready(function() {
  // Untuk sunting
  $('#bayarModal').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);

    // Isi nilai pada field
    modal.find('#id').attr("value",div.data('id'));
    modal.find('#nama').attr("value",div.data('kode'));
    modal.find('#alamat').attr("value",div.data('harga'));
  });
});
</script>
<!-- page script -->
<!-- <script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script> -->

<div class="modal fade" id="modal_userDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_userDetail">

        <?php echo form_open_multipart($action); ?>
        <div>
        <label for="input-file-now-custom-1">
          Nama Kelas <small style="color:red">* </small>
        </label>
        <input type="text" required="1" name="nama_kelas" class="form-control">
          <small class="form-text text-muted">Nama Kelas</small>
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-success" name="import">Tambah Data</button>
         <?php echo form_close(); ?>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bayarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data Kelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <?php echo form_open_multipart($action_edit); ?>
          <input type="hidden" hidden="1" class="form form-control" name="id" id="id"  required="1">
          <div>
          <label for="input-file-now-custom-1">
            Nama Kelas <small style="color:red">* </small>
          </label>
          <input type="text" class="form form-control" name="nama_kelas" id="nama"  required="1">
          </div>
          <br>
          <div>
          <label for="input-file-now-custom-1">
            Dibuat Pada
          </label>
          <input type="text" class="form form-control"  id="alamat" readonly="1" required="1">
          </div>
          <br>
          </br>
          <button type="submit" class="btn btn-success" name="import">Edit Data</button>
          <?php echo form_close(); ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
        </div>
    </div>
  </div>
</div>
</body>
</html>
