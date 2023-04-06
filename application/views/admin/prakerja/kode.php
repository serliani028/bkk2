<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Batch Psikotest <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-clipboard"></i> Data Batch Psikotest </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">

          <button class="btn btn-primary" data-toggle="modal" href="#modal_userDetail">Tambah Batch Psikotest</button>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <small><b style="font-size:13px">Silahkan Gunakan Batch Psikotes dalam 1 kali penugasan (Ex : akan ditugaskan ke 6 orang dalam 1 pekerjaan yang sama, maka hanya perlu membuat batch berjumlah 6 kode saja)</b></small>
          <br>
          <small><b style="color:red;font-size:14px">NB : Kode Batch Tidak bisa dipecah dalam 2 atau lebih dari 1 penggunaan !</b></small>
          <br>
          <br>
          
            <!-- <button class="btn btn-primary" data-toggle="modal" href="#modal_userDetail" >Import Data Prakerja</button><br><br> -->
            <table class="table table-bordered table-striped" id="kode">
              <thead>
                <tr>
                <td ><b>No.</b></td>
                <td ><b>Nama Batch</b></td>
                <td ><b>Jumlah</b></td>
                <td ><b>Modul Digunakan</b></td>
                <td ><b>Dibuat</b></td>
                <td ><b>Status Kode</b></td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($kode as $baris) {
                    $status = 'ADMIN';
                    if($baris->id_mitra != null){
                    $status = 'Penugasan Mitra';
                    }
                    
                  ?>
                <tr>
                <td><?=$no++;?></td>
                <td>
                <!--<a href="<?=$baris->link?>" target="_blank">-->
                <?=$baris->nama;?>
                <br>
                <small><b><?=$status;?></b></small>
                <!--</a>-->
                </td>
                <td><?=$baris->jumlah;?> Kode</td>
                <td><?=$baris->modul;?></td>
                <td><?=$baris->dibuat;?></td>
                <td>
                <?php 
                if($baris->status == 0){
                ?>
                <button class="btn btn-danger btn-sm">Belum Digunakan</button>
                <?php
                }else{
                ?>
                <button class="btn btn-success btn-sm">Sudah Digunakan</button>
                <?php
                }
                ?>
                </td>

                <!--<td >-->
                <!--  <a href="javascript:;"-->
                <!--  data-id="<?=$baris->id;?>"-->
                <!--  data-kode="<?=$baris->nama;?>"-->
                <!--  data-harga="<?=$baris->link;?>"-->
                <!--  data-toggle="modal" data-target="#bayarModal">-->
                <!--  <p class="btn btn-warning" style="padding:4px"><i class="fa fa-link"></i> Edit</p>-->
                <!--</a>-->
                <!--<a href="<?=base_url('hapus_link/'.$baris->id);?>">-->
                <!--  <p class="btn btn-danger" style="padding:4px"><i class="fa fa-trash"></i> Hapus</p>-->
                <!--</a>-->
                <!--</td>-->
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
$('#kode').DataTable();
});
</script>
<!--<script>-->
<!--$(document).ready(function() {-->
  // Untuk sunting
<!--  $('#bayarModal').on('show.bs.modal', function (event) {-->
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
<!--    var modal = $(this);-->

    // Isi nilai pada field
<!--    modal.find('#id').attr("value",div.data('id'));-->
<!--    modal.find('#nama').attr("value",div.data('kode'));-->
<!--    modal.find('#alamat').attr("value",div.data('harga'));-->
<!--  });-->
<!--});-->
<!--</script>-->
<!-- page script -->
<!-- <script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script> -->

<div class="modal fade" id="modal_userDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Batch Kode Psikotes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_userDetail">

        <?php echo form_open_multipart($action); ?>
        <div>
        <label for="input-file-now-custom-1">
          Nama Batch <small style="color:red">* </small>
        </label>
        <input type="text" required="1" name="nama" class="form-control">
          <small class="form-text text-muted">Nama Batch</small>
        </div>
        <br>
        <div>
        <label for="input-file-now-custom-1">
          Modul Psikotes<small style="color:red">* </small>
        </label>
        <select class="form-control" name="modul" required="1">
            <option value="">Pilih Modul</option>
            <option value="Modul Tes Bakat Minat">Modul Tes Bakat Minat</option>
            <option value="Modul Tes Guru">Modul Tes Guru</option>
        </select>
         <!--<input type="text" readonly="1" value="Modul Tes Bakat Minat" required="1" name="modul" class="form-control">-->
          <small class="form-text text-muted">Moddul Psikotes</small>
        </div>
         <br>
        <div>
        <label for="input-file-now-custom-1">
          Jumlah Batch<small style="color:red">* </small>
        </label>
        <input type="number" required="1" name="jumlah" class="form-control">
          <small class="form-text text-muted">Jumlah Batch</small>
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

<!--<div class="modal fade" id="bayarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--        <div class="modal-header">-->
<!--          <h5 class="modal-title" id="exampleModalLabel">Edit Link</h5>-->
<!--          <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--            <span aria-hidden="true">&times;</span>-->
<!--          </button>-->
<!--        </div>-->
<!--        <div class="modal-body">-->

<!--          <?php echo form_open_multipart($action_edit); ?>-->
<!--          <input type="hidden" hidden="1" class="form form-control" name="id" id="id"  required="1">-->
<!--          <div>-->
<!--          <label for="input-file-now-custom-1">-->
<!--            Nama  <small style="color:red">* </small>-->
<!--          </label>-->
<!--          <input type="text" class="form form-control" name="nama_link" id="nama"  required="1">-->
<!--          </div>-->
<!--          <br>-->
<!--          <div>-->
<!--          <label for="input-file-now-custom-1">-->
<!--            Link-->
<!--          </label>-->
<!--          <input type="text" class="form form-control"  name="link" id="alamat" required="1">-->
<!--          </div>-->
<!--          <br>-->
<!--          </br>-->
<!--          <button type="submit" class="btn btn-success" name="import">Edit Data</button>-->
<!--          <?php echo form_close(); ?>-->

<!--        </div>-->
<!--        <div class="modal-footer">-->
<!--          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>-->
<!--        </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
</body>
</html>
