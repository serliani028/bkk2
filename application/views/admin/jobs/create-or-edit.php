
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-briefcase"></i> Kelola Tes Seleksi<small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-briefcase"></i> Lowongan</li>
      <li class="active"><?php echo lang('create'); ?></li>
    </ol>
  </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <?php if (allowedTo('create_jobs') || allowedTo('edit_jobs')) { ?>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('details'); ?> Tes</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="admin_job_create_update_form">
              <div class="box-body">
                <div class="row">
                  
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Judul Tes Seleksi</label>
                      <input type="hidden" name="job_id" value="<?php echo esc_output($job['job_id']); ?>" />
                      <input type="text" class="form-control" placeholder="Enter Title" name="title" required="1"
                      value="<?php echo esc_output($job['title']); ?>">
                    </div>
                  </div>
                  
                   <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                      <label>
                        <?php echo lang('companies'); ?>
                        <button type="button" class="btn btn-xs btn-warning btn-blue create-or-edit-company" data-id=""
                        title="Add New Company" >
                          <i class="fa fa-plus"></i>
                        </button>
                      </label>
                      <select class="form-control select2" id="companies" name="company_id" required="1">
                        <option value=""><?php echo lang('none'); ?></option>
                        <?php 
                        $jons = '';
                        if(!empty($job['kompeni'])){
                        $jons = $job['kompeni'];
                        }else{
                        $jons = $job['company_id'];
                        }
                        foreach ($companies as $key => $value) { ?>
                          <option value="<?php echo esc_output($value['company_id']); ?>" <?php sel($jons, $value['company_id']); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                    <div class="col-md-3 col-sm-12" >
                    <div class="form-group">
                      <label>Pilih Jenis Penugasan Psikotes</label>
                      <select class="form-control select2" name="status_penugasan" required>
                        <option value="0" <?php sel($job['status_penugasan'],0); ?>>Penugasan Manual</option>
                        <option value="1" <?php sel($job['status_penugasan'],1); ?>>Penugasan Otomatis</option>
                    </select>
                    </div>
                  </div>
                  
                  <!--<div class="col-md-6 col-sm-12" >-->
                  <!--  <div class="form-group">-->
                  <!--    <label>Divisi Tes Seleksi</label>-->
                  <!--    <select class="form-control select2" name="id_kategori" required="1" >-->
                  <!--      <option value=""><?php echo lang('none'); ?></option>-->
                  <!--      <?php foreach ($kategori as $key => $value) { ?>-->
                  <!--        <option value="<?php echo esc_output($value['id']); ?>" <?php sel($job['id_kategori'], $value['id']); ?>> Divisi <?php echo esc_output($value['nama_kategori'], 'html'); ?></option>-->
                  <!--      <?php } ?>-->
                  <!--    </select>-->
                  <!--  </div>-->
                  <!--</div>-->
                  
                  
                  <!--<div class="col-md-6 col-sm-12" >-->
                  <!--  <div class="form-group">-->
                  <!--    <label>Lokasi Lowongan (Kota)</label>-->
                  <!--    <select class="form-control select2" name="id_lokasi" required="1">-->
                  <!--      <option value=""><?php echo lang('none'); ?></option>-->
                  <!--      <?php foreach ($lokasi as $key => $value) { ?>-->
                  <!--        <option value="<?php echo esc_output($value['id_kab']); ?>" <?php sel($job['id_lokasi'], $value['id_kab']); ?>><?php echo esc_output($value['nama'], 'html'); ?></option>-->
                  <!--      <?php } ?>-->
                  <!--    </select>-->
                  <!--  </div>-->
                  <!--</div>-->
                  
                  
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo 'Status Tes'; ?></label>
                      <select class="form-control" name="status" required="1">
                        <option value="1" <?php sel(@$job['status_pekerjaan'], 1); ?>> Aktif</option>
                        <option value="0" <?php sel(@$job['status_pekerjaan'], 0); ?>> NonAktif</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Pilih Kategori Kelas</label>
                      <select class="form-control psikotes" name="status_psikotes"  required="1">
                       
                        <option value="" > Pilih Kategori Kelas </option>
                        <option value="1" <?php sel($job['status_psikotes'], 1); ?>> Kelas X</option>
                        <option value="2" <?php sel($job['status_psikotes'], 2); ?>> Kelas XI</option>
                        <option value="3" <?php sel($job['status_psikotes'], 3); ?>> Kelas XII</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12" style="display:none">
                    <div class="form-group">
                      <label><?php echo lang('is_static_allowed'); ?></label>
                      <select class="form-control" name="is_static_allowed" disabled="1">
                        <option value="0" <?php sel($job['is_static_allowed'], 0); ?>><?php echo lang('no'); ?></option>
                        <option value="1" <?php sel($job['is_static_allowed'], 1); ?>><?php echo lang('yes'); ?></option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-sm-12" style="display:none">
                    <div class="form-group">
                      <label>
                        <?php echo lang('departments'); ?>
                        <button type="button" class="btn btn-xs btn-warning btn-blue create-or-edit-department" data-id=""
                        title="Add New Department">
                          <i class="fa fa-plus"></i>
                        </button>
                      </label>
                      <select class="form-control select2" id="departments" name="department_id">
                        <option value=""><?php echo lang('none'); ?></option>
                        <?php foreach ($departments as $key => $value) { ?>
                          <option value="<?php echo esc_output($value['department_id']); ?>" <?php sel($job['department_id'], $value['department_id']); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-sm-12" >
                    <div class="form-group">
                      <label>
                        Level Psikotes
                    </label>
                      <select class="form-control select2"  name="status_minat" required="1"> 
                        <option value=""><?php echo lang('none'); ?></option>
                        <?php foreach ($level as $key => $value) { ?>
                          <option value="<?php echo esc_output($value['id']); ?>" <?php sel($job['status_minat'], $value['id']); ?>><?php echo esc_output($value['level'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-sm-12" >
                    <div class="form-group">
                      <label>
                        Tugaskan Tes Esai
                    </label>
                      <select class="form-control select2"  name="id_tes_esai"> 
                        <option value=""><?php echo lang('none'); ?></option>
                        <?php foreach ($tes_esai as $key => $value) { ?>
                          <option value="<?php echo esc_output($value['interview_id']); ?>" <?php sel($job['id_tes_esai'], $value['interview_id']); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <!--<div class="col-md-6 col-sm-12" id="pekerjaan">-->
                  <!--  <div class="form-group">-->
                  <!--    <label>-->
                  <!--      Posisi Magang-->
                  <!--  </label>-->
                  <!--    <input type="text" class="form-control" name="posisi" placeholder="Enter Title" name="title" value="<?php echo esc_output($job['posisi']); ?>">-->
                  <!--  </div>-->
                  <!--</div>-->
                  
                  <div class="col-md-12">
                    
                    <!--<div class="card">-->
                    <!--     <label >Gambar Banner ( Ukuran LxP Gambar Minimal : 420 X 400 </label>-->
                    <!--    <div class="imgWrap">-->
                    <!--        <img for="inputFile" src="https://png.pngtree.com/png-vector/20190418/ourmid/pngtree-vector-camera-icon-png-image_956080.jpg" id="imgView" -->
                    <!--        width="420px" height="380px" class="custom-file-label" >-->
                    <!--    </div>-->
                    <!--<div class="card-body">-->
                    <!--    <div class="custom-file">-->
                    <!--        <br>-->
                    <!--        <input type="file" id="inputFile" class="form-control custom-file-input" aria-describedby="inputGroupFileAddon01">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--</div>-->
        
                    <div class="form-group">
                        <br>
                      <label><?php echo lang('description'); ?></label>
                      <textarea id="description" name="description" rows="10" cols="80">
                        <?php echo esc_output($job['description'], 'textarea'); ?>
                      </textarea>
                    </div>
                  </div>
                  <!--<div class="col-md-12">-->
                  <!--  <hr />-->
                  <!--  <div class="form-group">-->
                  <!--    <label>-->
                  <!--      <?php echo lang('custom_fields'); ?>-->
                  <!--      <button type="button" class="btn btn-xs btn-warning btn-blue add-custom-field" title="Add Custom Field">-->
                  <!--        <i class="fa fa-plus"></i>-->
                  <!--      </button>-->
                  <!--    </label>-->
                  <!--  </div>-->
                  <!--</div>-->
                  <!--<div class="col-md-12 col-sm-12 custom-fields-container">-->
                  <!--  <?php foreach ($fields as $field) { ?>-->
                  <!--  <?php include(VIEW_ROOT.'/admin/jobs/custom-field.php'); ?>-->
                  <!--  <?php } ?>-->
                  <!--  <div class="row resume-item-edit-box-section no-custom-value-box">-->
                  <!--    <div class="col-md-12 col-lg-12">-->
                  <!--      <p><?php echo lang('no_custom_fields'); ?></p>-->
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--</div>-->
                  <!--<div class="col-sm-12">-->
                  <!--  <hr />-->
                  <!--  <div class="form-group">-->
                  <!--    <label><?php echo lang('traits'); ?></label>-->
                  <!--    <select class="form-control select2" id="traits[]" name="traits[]" multiple="multiple">-->
                  <!--      <?php foreach ($traits as $key => $value) { ?>-->
                  <!--        <?php $jobTraits = $job['traits'] ? explode(',', $job['traits']) : array(); ?>-->
                  <!--        <option value="<?php echo esc_output($value['trait_id']); ?>" <?php sel($value['trait_id'], $jobTraits); ?>><?php echo esc_output($value['title'], 'html'); ?></option>-->
                  <!--      <?php } ?>-->
                  <!--    </select>-->
                  <!--    <br />-->
                  <!--    <br />-->
                  <!--    <b><?php echo lang('notes'); ?></b><br />-->
                  <!--    <ul>-->
                  <!--      <li><?php echo lang('traits_can_not_be_assigned'); ?></li>-->
                  <!--      <li><?php echo lang('traits_can_only_be_answerd'); ?></li>-->
                  <!--    </ul>-->
                  <!--  </div>-->
                  <!--</div>-->
                  <div class="col-sm-12">
                    <hr />
                    <div class="form-group">
                      <label>Tes Internal</label>
                      <select class="form-control select2" id="quizes[]" name="quizes[]" multiple="multiple">
                        <?php foreach ($quizes as $key => $value) { ?>
                          <?php $jobQuizes = $job['quizes'] ? explode(',', $job['quizes']) : array(); ?>
                          <option value="<?php echo esc_output($value['quiz_id']); ?>" <?php sel($value['quiz_id'], $jobQuizes); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                      <br />
                      <br />
                      <b><?php echo lang('notes'); ?></b><br />
                      <ul>
                        <li>Tes Internal dilampirkan ke pekerjaan dalam bentuk 'Salinan' , jadi perubahan dalam Tes asli setelah ditugaskan ke pekerjaan tidak akan tampil .</li>
                        <li>Tes Internal yang ditugaskan dari sini akan tersedia untuk semua kandidat yang melamar pekerjaan.</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-sm-12">
                  <hr />
                      <b><?php echo lang('in_general'); ?></b><br />
                      <ul>
                        <li>Tes Internal hanya bisa ditugaskan 'SEBELUM' penerimaan.</li>
                      </ul>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="admin_job_create_update_form_button">
                  <?php echo lang('save'); ?> Psikotes
                </button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <?php } ?>

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/company.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/department.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/job.js"></script>

<!--<script>-->
<!--    $(document).ready(function(){-->
        
<!--        if($('.psikotes').val() == '2'){-->
<!--        $('#divisi').attr('required', 'required');-->
<!--        $('#jabatan').attr('required', 'required');-->
<!--        $('#pekerjaan').removeAttr('required');-->
        
<!--        $("#divisi").show();-->
<!--        $("#jabatan").show();-->
<!--        $("#pekerjaan").hide();-->
        
<!--        }else if($('.psikotes').val() == '3' || $('.psikotes').val() == '4'){-->
            
<!--        $('#jabatan').attr('required','required');-->
<!--        $('#pekerjaan').attr('required', 'required');-->
<!--        $('#divisi').attr('required', 'required');-->
        
<!--        $('#jabatan').attr('class', 'col-md-4 col-sm-12');-->
<!--        $('#divisi').attr('class', 'col-md-4 col-sm-12');-->
<!--        $('#pekerjaan').attr('class', 'col-md-4 col-sm-12');-->
        
<!--        $("#pekerjaan").show();-->
<!--        $("#divisi").show();-->
<!--        $("#jabatan").show();-->
        
            
<!--        }else if($('.psikotes').val() == '1'){-->
        
<!--        $('#pekerjaan').removeAttr('required');-->
<!--        $('#divisi').removeAttr('required');-->
<!--        $('#jabatan').attr('required','required');-->
<!--        $('#jabatan').attr('class','col-md-12 col-sm-12');-->
        
<!--        $("#pekerjaan").hide();-->
<!--        $("#divisi").hide();-->
<!--        $("#jabatan").show();-->
        
<!--        }else{-->
            
<!--        $('#divisi').removeAttr('required');-->
<!--        $('#jabatan').removeAttr('required');-->
<!--        $('#pekerjaan').removeAttr('required');-->
            
<!--        $("#pekerjaan").hide();-->
<!--        $("#divisi").hide();-->
<!--        $("#jabatan").hide();-->
<!--        }-->
        
<!--    $('.psikotes').change(function () {-->
<!--    var vale = $(this).val();-->
    
<!--    if(vale == '2'){-->
        
<!--        $('#divisi').attr('required', 'required');-->
<!--        $('#jabatan').attr('required', 'required');-->
<!--        $('#jabatan').attr('class', 'col-md-6 col-sm-12');-->
<!--        $('#divisi').attr('class', 'col-md-6 col-sm-12');-->
<!--        $('#pekerjaan').removeAttr('required');-->
        
<!--        $("#divisi").show();-->
<!--        $("#jabatan").show();-->
<!--        $("#pekerjaan").hide();-->
        
<!--    }else if (vale == '3' || vale == '4'){-->
        
<!--        $('#pekerjaan').attr('required', 'required');-->
<!--        $('#divisi').attr('required', 'required');-->
<!--        $('#jabatan').attr('required', 'required');-->
        
<!--        $('#jabatan').attr('class', 'col-md-4 col-sm-12');-->
<!--        $('#divisi').attr('class', 'col-md-4 col-sm-12');-->
<!--        $('#pekerjaan').attr('class', 'col-md-4 col-sm-12');-->
        
        
<!--        $("#pekerjaan").show();-->
<!--        $("#divisi").show();-->
<!--        $("#jabatan").show();-->
        
<!--    }else if (vale == '1'){-->
        
<!--        $('#divisi').removeAttr('required');-->
<!--        $('#pekerjaan').removeAttr('required');-->
        
<!--        $('#jabatan').attr('required','required');-->
<!--        $('#jabatan').attr('class','col-md-12 col-sm-12');-->
            
<!--        $("#pekerjaan").hide();-->
<!--        $("#divisi").hide();-->
<!--        $("#jabatan").show();-->
        
<!--    }else{-->
        
<!--        $('#divisi').removeAttr('required');-->
<!--        $('#pekerjaan').removeAttr('required');-->
<!--        $('#jabatan').removeAttr('required');-->
      
<!--        $("#divisi").hide();-->
<!--        $("#jabatan").hide();-->
<!--        $("#pekerjaan").hide();-->
            
<!--    }-->
        
<!--    });-->
<!--});-->
<!--</script>-->


</body>
</html>
