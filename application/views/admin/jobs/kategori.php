<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Kategori Divisi <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Kategori Divisi </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">

          <button class="btn btn-primary" data-toggle="modal" href="#modal_userDetail">Tambah  Divisi</button>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- <button class="btn btn-primary" data-toggle="modal" href="#modal_userDetail" >Import Data Prakerja</button><br><br> -->
            <table class="table table-bordered table-striped" id="kelas">
              <thead>
                <tr>
                <td ><b>No</b></td>
                <!--<td ><b>Kategori</b></td>-->
                <td ><b>Nama Divisi</b></td>
                <td ><b>Dibuat</b></td>
                <td ><b>Dirubah</b></td>
                <td ><b>Status</b></td>
                <td ><b>Aksi</b></td>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($kategori as $baris) {
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td><?php if($baris->nama_kategori != "Semua Divisi"){?>Divisi <?=$baris->nama_kategori;?> <?php }else{?> <b style="background-color:green;border:1px solid green;padding:3px;border-radius:2px 2px 2px 2px;color:white"> <?php echo $baris->nama_kategori; ?> </b> <?php } ?></td>
                <td><?=$baris->created_date;?></td>
                <td><?=$baris->update_date;?></td>
                <td>
                  <?php if ($baris->status == 1) {
                  ?>
                  <a href="<?=base_url('nonaktif_kategori/'.$baris->id);?>">
                  <p class="btn btn-success" style="padding:5px">Aktif </p>
                  </a>
                  <?php
                  }else{
                  ?>
                  <a href="<?=base_url('akftifkan_kategori/'.$baris->id);?>">
                  <p class="btn btn-danger" style="padding:5px">NonAktif </p>
                  </a>
                  <?php
                  }
                  ?>
                </td>

                <td >
                  <a href="javascript:;"
                  data-id="<?=$baris->id;?>"
                  data-kode="<?=$baris->nama_kategori;?>"
                  data-alamat="<?=$baris->status;?>"
                  data-toggle="modal" data-target="#bayarModal">
                  <p class="btn btn-warning" style="padding:4px"><i class="fa fa-link"></i> Edit</p>
                </a>
                <a href="<?=base_url('hapus_kategori/'.$baris->id);?>">
                  <p class="btn btn-danger" style="padding:5px"><i class="fa fa-trash"></i> Hapus</p>
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
    modal.find('#alamat').attr("value",div.data('alamat'));
  });
});
</script>
<!-- page script -->
<!-- <script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script> -->

<div class="modal fade" id="modal_userDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_userDetail">

        <?php echo form_open_multipart($action); ?>
        <div>
        <label for="input-file-now-custom-1">
          Nama Divisi <small style="color:red">* </small>
        </label>
        <input type="text" required="1" name="nama_kategori" class="form-control">
          <small class="form-text text-muted">Nama Divisi</small>
        </div>
        <br>
        <div>
        <label for="input-file-now-custom-1">
        Status<small style="color:red">* </small>
        </label>
        <select required="1" name="status" class="form-control">
          <option value="">Pilih Status</option>
          <option value="1">Aktif</option>
          <option value="2">NonAktif</option>
        </select>
          <small class="form-text text-muted">Status</small>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <?php echo form_open_multipart($action_edit); ?>
          <input type="hidden" hidden="1" class="form form-control" name="id" id="id"  required="1">
          <input type="hidden" hidden="1" class="form form-control" name="status" id="alamat"  required="1">
          <div>
          <label for="input-file-now-custom-1">
            Nama Divisi  <small style="color:red">* </small>
          </label>
          <input type="text" class="form form-control" name="nama_kategori" id="nama"  required="1">
          <small class="form-text text-muted">Nama Divisi</small>
          </div>
          <br>
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
