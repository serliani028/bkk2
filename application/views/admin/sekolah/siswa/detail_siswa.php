<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-user"></i> Detail Data Siswa <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fas fa-user"></i> Detail Data Siswa </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" style="overflow-x: auto;">
      <div class="col-xs-12">
        <div class="box" style="margin-top:80px;border-top:0px !important">
          <div class="box-header">
            <?php include(VIEW_ROOT.'/admin/partials/messages.php'); ?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div style="text-align:center;margin-top:-100px">
                   <?php $image = '';  $user->image != null ? $image = 'https://smk.cybersjob.com//assets/images/candidates/'.$user->image : $image =  'https://smk.cybersjob.com//assets/images/not-found.png'; ?>
                               <img src="<?=$image;?>" width="170px" height="170px" style="border-radius: 50%;border:2px solid black;padding:3px">
              </div>
            <div class="row">
                <div class="col-md-6">
                    <h4><b>BIODATA SISWA</b></h4>
                      <i style="border-top:2px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>    
                        <table style="width:100%">
                        <tr>
                            <td><b>NAMA </b></td>
                            <td> &nbsp;</td>
                            <td> : <?=$user->first_name?></td>
                        </tr>
                        <tr>
                            <td><b>L / P </b></td>
                            <td> &nbsp;</td>
                            <td> : <?=$user->gender == 'male' ? '<b>L</b>' : '<b>P</b>'; ?></td>
                        </tr>
                        <tr>
                            <td><b>NIS </b></td>
                            <td> &nbsp;</td>
                            <td> : <?=$user->nis?></td>
                        </tr>
                        <tr>
                            <td><b>KELAS </b></td>
                            <td> &nbsp;</td>
                            <!--<td> : <?php if(empty($kelas)){ echo '<b>Lulus / Alumni</b>'; }else{ $user->kelas_siswa .''. $kelas->nama; } ?> </td>-->
                            <td> : <?php if(empty($kelas)){ echo '<b>Lulus / Alumni</b>'; }else{ echo $user->kelas_siswa .''. $kelas->nama; } ?> </td>
                        </tr>
                        <tr>
                            <td><b>JURUSAN </b></td>
                            <td> &nbsp;</td>
                            <td> : <?=$jurusan->nama?></td>
                        </tr>
                        <tr>
                            <td><b>EMAIL </b></td>
                            <td> &nbsp;</td>
                            <td> : <?=$user->email?></td>
                        </tr>
                         <tr>
                             <td><b>NO.TLP </b></td>
                            <td> &nbsp;</td>
                            <td> : <?=$user->phone1?></td>
                        </tr>
                        <tr>
                            <td><b>ALAMAT SISWA</b></td>
                            <td> &nbsp;</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <?=$user->address?> , Provinsi <?=$prov != '' ? $prov->nama : '-' ?>, Kabupaten <?=$kab != '' ? $kab->nama : '-';?>, Kecamatan <?=$kec != '' ? $kec->nama : '-';?></td>
                        </tr>
                    </table>
            </div>
            <div class="col-md-6">
                <h4><b>MEDIA SOSIAL</b></h4>
                <i style="border-top:2px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>    
                <table style="width:100%">
                    <tr>
                        <td></i>Instagram </td>
                        <td> &nbsp;</td>
                        <td> : </td>
                        <td> &nbsp;</td>
                        <td> <?=$medsos['ig']?></td>
                    </tr>
                    <tr>
                        <td>YouTube </td>
                        <td> &nbsp;</td>
                        <td> : </td>
                        <td> &nbsp;</td>
                        <td> <?=$medsos['yt']?> </td>
                    </tr>
                    <tr>
                        <td>Facebook </td>
                        <td> &nbsp;</td>
                        <td> : </td>
                        <td> &nbsp;</td>
                        <td> <?=$medsos['fb']?> </td>
                    </tr>
                    <tr>
                        <td>Twitter </td>
                        <td> &nbsp;</td>
                        <td> : </td>
                        <td> &nbsp;</td>
                        <td>  <?=$medsos['twitter'] ?></td>
                    </tr>
                    <tr>
                        <td>Linkedln </td>
                        <td> &nbsp;</td>
                        <td> : </td>
                        <td> &nbsp;</td>
                        <td>  <?=$medsos['linkedln']?></td>
                    </tr>
                    <tr>
                        <td>Tik-Tok </td>
                        <td> &nbsp;</td>
                        <td> : </td>
                        <td> &nbsp;</td>
                        <td>  <?=$medsos['tiktok']?></td>
                    </tr>
                    
                </table>
            </div>
            <div class="col-md-12">
                <br>
                <h4><b>DATA TES DIIKUTI</b></h4>
                <table width="100%" class="table table-bordered table-stripped">
                    <thead>
                        <tr style="background-color:#a86863;color:white">
                            <td>No.</td>
                            <td>Judul Tes</td>
                            <td>Nilai Tes Psikologi, Kompetensi, & Esai</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($tes as $value): ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$value->judul;?></td>
                        <td>
                             Tes Psikologi : <i class="fas fa-star" style="color:orange"></i> <?=$value->status_tes;?> <br>
                             Tes Kompetensi : <?=$value->quizes_result;?><br>
                             Tes Esai : <?=$value->interviews_result;?><br>
                        </td>
                    </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <br>
                <h4><b>DATA PENGALAMAN SISWA</b></h4>
                <table width="100%" class="table table-bordered table-stripped">
                    <thead>
                        <tr style="background-color:#a86863;color:white">
                            <td>No.</td>
                            <td>Pengalaman</td>
                            <td>Deskripsi</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $No = 1; foreach ($pengalaman as $key => $value): ?>
                        <!-- html... -->
                    <tr>
                        <td><?=$No++?></td>
                        <td><?=$value->title;?></td>
                        <td><?=$value->description;?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <br>
                <h4><b>DATA SKILL SISWA</b></h4>
                <table width="100%" class="table table-bordered table-stripped">
                    <thead>
                        <tr style="background-color:#a86863;color:white">
                            <td>No.</td>
                            <td>Jenis Skill</td>
                            <td>Deskripsi Skill</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                   <?php $No = 1; foreach ($skill as $key => $value): ?>
                        <!-- html... -->
                    <tr>
                        <td><?=$No++?></td>
                        <td><?=$value->jenis;?></td>
                        <td><?=$value->title;?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <br>
                <h4><b>DATA KEGIATAN SISWA</b></h4>
                <table width="100%" class="table table-bordered table-stripped">
                        <thead>
                        <tr style="background-color:#a86863;color:white">
                            <td>No.</td>
                            <td>Jenis Kegiatan</td>
                            <td>Perusahaan / Lokasi Kegiatan</td>
                            <td>Posisi</td>
                            <td>Informasi Lain</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($kegiatan as $key => $value): ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$value->jenis == 1 ? '<b class="btn btn-success btn-xs">Magang</b>' : '<b class="btn btn-success btn-xs">Bekerja</b>'; ?>
                        <a href="javascript:;" class="btn btn-xs btn-danger"
                        data-hapus_simpan="<?=base_url('delete_k_s/'.encode($value->id).'/'.encode('detail-siswa/'.encode($user->candidate_id)));?>" 
                        data-toggle="modal" data-target=".hapus_kegiatan" style="font-size:15px" href="#" >
                        <i class="fas fa-file-export"></i></a>
                        </td>
                        <td><?=$value->lokasi?></td>
                        <td><?=$value->posisi?></td>
                        <td><?=$value->informasi?></td>
                    </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
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
</div>

<div class="modal fade hapus_kegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><b>Arsipkan Kegiatan</b></h3>
      </div>
      <div class="modal-body" style="text-align:center">
      <p>Data kegiatan yang sudah selesai akan diarsipkan ke data Pengalaman Anda, serta akan dihapus secara permanen dari data kegiatan. <b>Yakin ingin mengarsipkan data ?</b></p>
      <a id="hapus_simpan"><b class="btn btn-primary">Arsipkan Kegiatan</b></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
      
    </div>
  </div>
</div>

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
$('#sertifikat').DataTable();
});

$(document).ready(function() {
   $('.hapus_kegiatan').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);
    modal.find('#hapus').attr('href',div.data('hapus'));
    modal.find('#hapus_simpan').attr('href',div.data('hapus_simpan'));
  });
});

</script>


</body>
</html>
