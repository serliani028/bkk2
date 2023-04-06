<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Lulus Sertifikasi<small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Lulus Sertifikasi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">


          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <button class="btn btn-primary" data-toggle="modal" href="#modal_userDetail" >Import Data Sertifikasi</button><br><br>
            <table class="table table-bordered table-striped" id="prakerja">
              <thead>
                <tr>
                  <td style="width:5%;text-align:center"><b>#</b></td>
                  <td style="width:10%"><b>ID Sertifikasi</b></td>
                  <td style="width:10%"><b>Nama</b></td>
                  <td style="width:10%"><b>Email</b></td>
                  <td style="width:10%"><b>No. Telp</b></td>
                  <td style="width:20%"><b>Alamat</b></td>
                  <td style="width:5%"><b>Status</b></td>
                  <td style="width:15%"><b>Aksi</b></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($prakerja as $baris) {
                  ?>
                  <tr>
                    <td># <?=$baris->id;?></td>
                    <td><?=$baris->prakerja_id;?></td>
                    <td><?=$baris->nama;?></td>
                    <td><?=$baris->email;?></td>
                    <td><?=$baris->no_telp;?></td>
                    <td><?=$baris->alamat;?></td>
                    <td>
                      <?php if ($baris->status == 1) {
                        ?>
                        <a href="<?=base_url('nonaktif_prakerja/'.$baris->id);?>">
                          <p class="btn btn-success" style="padding:5px">Aktif </p>
                        </a>
                        <?php
                      }else{
                        ?>
                        <a href="<?=base_url('akftifkan_prakerja/'.$baris->id);?>">
                          <p class="btn btn-danger" style="padding:5px">NonAktif </p>
                        </a>
                        <?php
                      }
                      ?>
                    </td>
                    <td >
                      <a href="<?=base_url('hapus_prakerja/'.$baris->id);?>">
                        <p class="btn btn-danger" style="padding:5px"><i class="fa fa-trash"></i> Hapus</p>
                      </a>
                      <a href="javascript:;"
                      data-id="<?=$baris->id;?>"
                      data-kode="<?=$baris->prakerja_id;?>"
                      data-nama="<?=$baris->nama;?>"
                      data-email="<?=$baris->email;?>"
                      data-no_telp="<?=$baris->no_telp;?>"
                      data-alamat="<?=$baris->alamat;?>"
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
  $('#prakerja').DataTable();
});

$(document).ready(function() {
  // Untuk sunting
  $('#bayarModal').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);

    // Isi nilai pada field
    modal.find('#id').attr("value",div.data('id'));
    modal.find('#kode').attr("value",div.data('kode'));
    modal.find('#nama').attr("value",div.data('nama'));
    modal.find('#email').attr("value",div.data('email'));
    modal.find('#no_telp').attr("value",div.data('no_telp'));
    modal.find('#alamat').attr("value",div.data('alamat'));
  });
});
</script>

<div class="modal fade" id="modal_userDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data Prakerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_userDetail">

        <?php echo form_open_multipart($action); ?>
        <input type="file" name="prakerja" accept="text/csv" class="form-control">
        <small>Contoh Template File CSV :
          <a target="_blank" href="<?php echo base_url('/upload/template_csv/template_prakerja_csv.csv');?>"  >
            Template.csv</a>
          </small>
          <br>
          <br>
          <button type="submit" name="import">Import Data</button>
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
          <h3 class="modal-title" id="exampleModalLabel">Edit Data Kandidat</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart($action_edit); ?>
          <input type="hidden" hidden="1" class="form form-control" name="id" id="id"  required="1">
          <div>
            <label for="input-file-now-custom-1">
              ID Sertifikasi <small style="color:red">* </small>
            </label>
            <input type="text" class="form form-control" name="prakerja_id" id="kode"  required="1">
          </div>
          <br>
          <div>
            <label for="input-file-now-custom-1">
              Nama Kandidat
            </label>
            <input type="text" class="form form-control"  name="nama" id="nama" required="1">
          </div>
          <br>
          <div>
            <label for="input-file-now-custom-1">
              Email Kandidat
            </label>
            <input type="email" class="form form-control" name="email" id="email" required="1">
          </div>
          <br>
          <div>
            <label for="input-file-now-custom-1">
              No. Telp Kandidat
            </label>
            <input type="number" maxlength="13" class="form form-control" name="no_telp" id="no_telp" required="1">
          </div>
          <br>
          <div>
            <label for="input-file-now-custom-1">
              Alamat Kandidat
            </label>
            <input type="text" class="form form-control" name="alamat" id="alamat" required="1">
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
<!-- page script -->
<!-- <script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script> -->

</body>
</html>
