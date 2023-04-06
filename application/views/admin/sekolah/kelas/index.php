<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-bookmark"></i> Data Kelas <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><?php echo lang('home'); ?></a></li>
      <li class="active"> <i class="fas fa-bookmark"></i> Data Kelas </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" style="overflow-x: auto;">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
              
              <b data-toggle="modal" data-target=".tambah_kelas" data-id_mitra = '<?=$id;?>' class="btn btn-md btn-primary"><i class="fas fa-plus"></i> Tambah Kelas</b>
              <b data-toggle="modal" data-target=".kelola_kelas" data-id_mitra = '<?=$id;?>' class="btn btn-md btn-warning"><i class="fas fa-exchange-alt"></i> Kelola Kelas </b>
              
            <?php include(VIEW_ROOT.'/admin/partials/messages.php'); ?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="sertifikat" class="table"  >
              <thead>
                <tr class="text-center">
                <td ><b>No.</b></td>
                <td ><b>Kelas </b></td>
                <td ><b>Jenis Jurusan </b></td>
                <td ><b>Nama Kelas </b></td>
                <td ><b>Jumlah Siswa  </b></td>
                <td class="text-center"><b>Kelola Kelas</b></td>
                </tr>
              </thead>
              <tbody>
                <?php 
                if($data){
                $no=1; foreach ($data as $key) { ?>
                <tr class="text-center">
                    <td><?=$no++?></td>
                    <td>#<?=$key->id_kelas?>  - <b>Kelas <?=$key->kelas;?> </b></td>
                    <td>Jurusan <?=$key->jurusan;?></td>
                    <td><?=$key->nama_kelas;?></td>
                    <td><?=$key->jumlah;?> Siswa</td>
                    <td>
                        <b class="btn btn-xs btn-warning"
                         data-target=".edit_kelas" 
                         data-toggle="modal"
                         data-id_mitra = '<?=$id;?>'
                         data-id_jurusan = '<?=$key->id_jurusan;?>'
                         data-kelas = '<?=$key->kelas;?>'
                         data-nama_kelas = '<?=$key->nama_kelas;?>'
                         data-id = '<?=$key->id_kelas;?>'
                        ><i class="fas fa-pen"></i> Edit Kelas</b>
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

<div class="modal fade edit_kelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Edit Kelas</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($edit_kelas); ?>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <input type="hidden" name="id" id="id" class="form-control" required>
        <label>Pilih Kelas</label>
         <select name="kelas" id="kelas_edit" class="form-control" required>
          <option>Pilih Kelas</option>
          <option value="X">Kelas X</option>
          <option value="XI">Kelas XI</option>
          <option value="XII">Kelas XII</option>
         </select>
        <br>
        <label>Pilih Jurusan </label>
         <select name="id_jurusan" id="jurusan_edit" class="form-control" required>
          <option>Pilih Jurusan</option>
            <?php foreach($jurusan as $key) : ?>
            <option value="<?php echo $key->id; ?>">Jurusan . <?php echo $key->nama; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>Masukkan Nama Kelas</label>
        <br>
        <small style="color:red"><b>* Masukkan Nama Jurusan Tanpa Ada "Kelas" (ex : "TKJ 1")</b></small>
        <input type="text" name="nama_kelas" id="nama_kelas" placeholder="Masukkan Nama Kelas" class="form-control" required>
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

<div class="modal fade tambah_kelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Tambah kelas</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($tambah_kelas); ?>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <label>Pilih Kelas</label>
         <select name="kelas" class="form-control" required>
          <option>Pilih Kelas</option>
          <option value="X">Kelas X</option>
          <option value="XI">Kelas XI</option>
          <option value="XII">Kelas XII</option>
         </select>
        <br>
        <label>Pilih Jurusan </label>
         <select name="id_jurusan" class="form-control" required>
          <option>Pilih Jurusan</option>
            <?php foreach($jurusan as $key) : ?>
            <option value="<?php echo $key->id; ?>">Jurusan . <?php echo $key->nama; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>Masukkan Nama Kelas</label>
        <br>
        <small style="color:red"><b>* Masukkan Nama Jurusan Tanpa Ada "Kelas" (ex : "TKJ 1")</b></small>
        <input type="text" name="nama_kelas" placeholder="Masukkan Nama Kelas" class="form-control" required>
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

<div class="modal fade kelola_kelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Kelola kelas</h3>
        
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart($kelola_kelas); ?>
        <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" required>
        <p><b style="color:red">* Harap perhatikan Jenis Kelola dan Status Kelola yang dipilih !</b></p>
        <label>Pilih Status Kelola</label>
         <select name="status" class="form-control status_kelola" required>
          <option value="">Pilih Status Kelola</option>
          <option value="1">Naikkan Kelas X - Kelas XI</option>
          <option value="2">Naikkan Kelas XI - Kelas XII</option>
          <option value="3">Luluskan Kelas XII</option>
         </select>
        <br>
        <label>Pilih Jenis Kelola</label><br>
        <input type="checkbox" class="jenis_kelola" value="1" checked> <b>Semua Siswa</b> |
        <input type="checkbox" class="jenis_kelola" value="2" > <b>Kecuali Siswa</b> 
        <!--<input type="checkbox" class="jenis_kelola" value="3"> <b>Hanya Siswa</b> -->
        <br>
        <br>
        <div class="siswa" style="display:none">
        <label>Pilih Siswa <b style="color:red">(* Masukkan NIS)</b> </label><br>
        <select class="form-control select2 input_siswa" name="siswa[]" multiple="multiple">
        </select>
        </div>
        <br>
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

<script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script>

<script type="text/javascript">
$(document).ready(function() {
$('#sertifikat').DataTable();
});

$(document).ready(function() {
    var base_url = '<?=base_url()?>';
    
    $('input[type="checkbox"]').on('change', function() {
    $(this).siblings('input[type="checkbox"]').prop('checked', false);
    var value = $(this).val();
    // alert(value);
    if(value == 1){
        $('.siswa').css('display','none');
        $('.input_siswa').removeAttr('required');
    }else{
        $('.siswa').css('display','block');
        $('.input_siswa').attr('required','required');
        // $('.siswa').attr('required','required');    
    }
    });
    
    $('.status_kelola').on('change', function() {
    var id = $(this).val();
    $.ajax({
      url : base_url + 'sekolah/get_kelas',
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
         $('.input_siswa').empty();
        $.each(data, function(key, value) {
           $('.input_siswa').append('<option value="'+ value.candidate_id +'">'+ value.first_name +'-'+ value.nis +'</option>');
        });
      }
    });
      return false;
    });
  
   $('.tambah_kelas').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    modal.find('#id_mitra').attr('value',div.data('id_mitra'));
   });
  
  $('.kelola_kelas').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    modal.find('#id_mitra').attr('value',div.data('id_mitra'));
  });
  
  $('.edit_kelas').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget);
    var modal = $(this);
    
    modal.find('#id_mitra').attr('value',div.data('id_mitra'));
    modal.find('#id').attr('value',div.data('id'));
    modal.find('#kelas_edit').val(div.data('kelas')).trigger('change');
    modal.find('#jurusan_edit').val(div.data('id_jurusan')).trigger('change');
    modal.find('#nama_kelas').attr('value',div.data('nama_kelas'));
  });
  
});

</script>


</body>
</html>
