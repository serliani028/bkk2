<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-award"></i> Data Tahun Angkatan <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fas fa-award"></i> Data Tahun Angkatan </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" style="overflow-x: auto;">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
              
              <b data-toggle="modal" data-target=".tambah_angkatan" data-id_mitra = '<?=$id;?>' class="btn btn-md btn-primary"><i class="fas fa-plus"></i> Tambah Tahun Angkatan</b>
              
            <?php include(VIEW_ROOT.'/admin/partials/messages.php'); ?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="sertifikat" class="table"  >
              <thead>
                <tr class="text-center">
                <td ><b>No.</b></td>
                <td ><b>Tahun Angakatan </b></td>
                <td ><b>Jumlah Siswa X </b></td>
                <td ><b>Jumlah Siswa XI </b></td>
                <td ><b>Jumlah Siswa XII </b></td>
                <!--<td class="text-center"><b>Kelola Tahun Angkatan</b></td>-->
                </tr>
              </thead>
              <tbody>
                <?php 
                if($data){
                $no=1; foreach ($data as $key) {
                ?>
                <tr class="text-center">
                    <td><?=$no++?></td>
                    <td>Tahun Angkatan <?=$key['tahun'];?></td>
                    <td><i class="fas fa-users" style="color:orange;font-size:13px"></i> <?=$key['kelasX'];?> Siswa</td>
                    <td><i class="fas fa-users" style="color:blue;font-size:13px"></i> <?=$key['kelasXI'];?> Siswa</td>
                    <td><i class="fas fa-users" style="color:green;font-size:13px"></i> <?=$key['kelasXII'];?> Siswa</td>
                    <!--<td>-->
                    <!--    <b class="btn btn-xs btn-warning"-->
                    <!--     data-target=".edit_angkatan" -->
                    <!--     data-toggle="modal"-->
                    <!--     data-id_mitra = '<?=$id;?>'-->
                    <!--     data-id = '<?=$key['id_tahun'];?>'-->
                    <!--     data-tahun = '<?=$key['tahun'] ;?>'-->
                    <!--    ><i class="fas fa-pen"></i> Edit Tahun Angkatan</b>-->
                    <!--</td>-->
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

<div class="modal fade edit_angkatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Edit Tahun Angkatan</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($edit_tahun); ?>
        <input type="hidden" name="id" id="id" class="form-control" required>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <label>Pilih Tahun Angkatan</label>
        <select name="tahun_angkatan" class="form-control" id="tahun_angkatan_edit" required>
          <option>Pilih Tahun Angkatan</option>
            <?php foreach($years as $year) : ?>
            <option value="<?php echo $year; ?>">Tahun Angkatan . <?php echo $year; ?></option>
            <?php endforeach; ?>
        </select>
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

<div class="modal fade tambah_angkatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Tambah Tahun Angkatan</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($tambah_tahun); ?>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <label>Pilih Tahun Angakatan</label>
        <select name="tahun_angkatan" class="form-control" required>
          <option>Pilih Tahun Angakatan</option>
            <?php foreach($years as $year) : ?>
            <option value="<?php echo $year; ?>">Tahun Angkatan . <?php echo $year; ?></option>
            <?php endforeach; ?>
        </select>
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
  
   $('.tambah_angkatan').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    modal.find('#id_mitra').attr('value',div.data('id_mitra'));
  });
  
  $('.edit_angkatan').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    
    modal.find('#id').attr('value',div.data('id'));
    modal.find('#id_mitra').attr('value',div.data('id_mitra'));
    modal.find('#tahun_angkatan_edit').val(div.data('tahun')).trigger('change');
  });
  
});

</script>


</body>
</html>
