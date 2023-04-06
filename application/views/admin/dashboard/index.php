<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <b><?php echo lang('dashboard'); ?> - <?=$this->session->userdata('admin')['first_name'].' '.$this->session->userdata('admin')['last_name']?>
     </b>
     <hr style="border:1px solid grey">
    </h1>
    <ol class="breadcrumb">
 </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <?php
        $cek = $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row();
        if(empty($cek)){?>
            <?php }else{ 
            if($cek->status_mitra == 0){?>
            <div class="text-center"> 
            <h3>SELAMAT DATANG </h3>
            <h2><b><?=$this->session->userdata('admin')['first_name'].' '.$this->session->userdata('admin')['last_name']?></b></h2>
            <h3>SILAHKAN LENGKAPI DATA ANDA DAN MULAI AKTIFKAN MENU - MENU YANG TERSEDIA. </h3>
            <br>
            <a href="<?=base_url()?>admin/profile"><h4><b><u>Lengkapi Sekarang</u></b></h4></a>
            <br>
            <h5>  <img src="<?php echo base_url(); ?>assets/admin/img/TALENTHUB_BG.png" alt="" class="img-fluid" ><b></b></h5>
            </div>
              <?php }else{?>
           <div class="row">
               
     <div class="col-md-3 col-sm-12">
       <div class="small-box bg-yellow">
         <div class="inner">
           <h4><b><h3><?=$siswa_daftar?></h3></b>Siswa</h4>
           <p style="font-size:20px"><b>Total Siswa Terdaftar</b></p>
         </div>
         <div class="icon">
           <i class="fa fa-users"></i>
         </div>
         <a class="small-box-footer">
          -- Total Seluruh Siswa Terdaftar --
         </a>
       </div>
     </div>

     <div class="col-md-3 col-sm-12">
         
       <div class="small-box bg-aqua">
         <div class="inner">
           <h4><b><h3><?=$siswa_aktif?></h3></b> Siswa</h4>
           <p style="font-size:20px"><b>Total Siswa Aktif</b></p>
         </div>
         <div class="icon">
           <i class="fa fa-users"></i>
         </div>
         <!--<br>-->
         <a href="<?=base_url()?>sekolah/kelola-siswa" class="small-box-footer">
           <?php echo lang('more_info'); ?> <i class="fa fa-arrow-circle-right"></i>
         </a>
         </div>
     </div>

     <div class="col-md-3 col-sm-12">
       <div class="small-box bg-maroon">
         <div class="inner">
           <h4><b><h3><?=$jurusan?></h3></b>Jurusan</h4>
           <p style="font-size:20px"><b>Total Jurusan</b></p>
         </div>
         <div class="icon">
           <i class="fas fa-archive"></i>
         </div>
         <a href="<?=base_url()?>sekolah/kelola-jurusan" class="small-box-footer">
           <?php echo lang('more_info'); ?> <i class="fa fa-arrow-circle-right"></i>
         </a>
       </div>
     </div>

     <div class="col-md-3 col-sm-12">
       <div class="small-box bg-green">
         <div class="inner">
           <h4><b><h3><?=$kelas?></h3></b>Kelas</h4>
           <p style="font-size:20px"><b>Total Kelas</b></p>
         </div>
         <div class="icon">
           <i class="fa fa-bookmark"></i>
         </div>
         <a href="<?=base_url()?>sekolah/kelola-kelas" class="small-box-footer">
           <?php echo lang('more_info'); ?> <i class="fa fa-arrow-circle-right"></i>
         </a>
       </div>
     </div>
      <div class="col-md-6 col-sm-12">
          <h4><i class="fas fa-bar-chart" style="font-size:18px"></i><b> HISTOGRAM PERSENTASE HASIL TES KOMPETENSI SISWA</b></h4>
          <hr>
          <canvas id="garph_kompetensi"></canvas>
     </div>
     <div class="col-md-6 col-sm-12">
          <h4><i class="fas fa-line-chart" style="font-size:18px"></i><b> GRAFIK RATA - RATA RATING TES PSIKOLOGI SISWA</b></h4>
          <hr>
          <canvas id="garph_psikologi"></canvas>
     </div>
          
            <?php } } ?>
            
    <?php if (allowedTo('view_dashboard_stats')) { ?>
   
    <?php } ?>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      
      <!-- Left col-->
      <section class="col-lg-6">
        <?php if (allowedTo('view_job_chart')) { ?>
        <!-- DONUT CHART -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Peserta Tes Seleksi</h3>
            <div class="box-tools pull-right">
              <input class="minimal popular" type="checkbox" checked="checked" id="applied_check" checked="checked" /> 
              <strong>Mengikuti</strong>
            </div>
          </div>
          <div class="box-body">
            <div class="chart tab-pane jobs-chart" id="jobs-chart"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php } ?>

        
      </section>
      <!-- /.Left col -->

      <!-- right col chart-->
      <section class="col-lg-6">

        
        <?php if (allowedTo('view_jobs_status')) { ?>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tes Seleksi</h3>
            <div class="box-tools pull-right">
              <div class="btn-group pull-right">
                <button type="button" class="btn btn-xs btn-primary btn-blue dashboard-jobs-previos-button"><</button>
                <button type="button" class="btn btn-xs btn-primary btn-blue disabled" id="dashboard_jobs_pagination_container">
                  1 - 10
                </button>
                <button type="button" class="btn btn-xs btn-primary btn-blue dashboard-jobs-next-button">></button>
              </div>
              <input type="hidden" id="dashboard_jobs_page" value="<?php echo esc_output($dashboard_jobs_page); ?>">
              <input type="hidden" id="dashboard_jobs_total_pages" value="<?php echo esc_output($dashboard_jobs_total_pages); ?>">
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>Tes Seleksi</th>
                  <th>Jenis Tes</th>
                  <th>Peserta</th>
                </tr>
                </thead>
                <tbody id="dashboard_jobs_list">
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
        </div>
        <?php } ?>

        

      </section>
      <!-- right col -->
      
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Forms for actions -->
<form id="jobs_data_form"></form>
<form id="jobs_list_form"></form>
<form id="todos_list_form"></form>
<form id="candidates_data_form"></form>

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/dashboard.js"></script>
<script>
$(document).ready(function() {
 var ctx = document.getElementById('garph_kompetensi').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [ <?php foreach($tahun_angkatan as $val){ echo '"'.$val.'",'; } ?> ],
            datasets: [{
              label: 'Persentase Hasil Tes Kompetensi',
              backgroundColor: '#ADD8E6',
              borderColor: '#93C3D2',
              data: [ <?php foreach($garph_kompetensi as $val){ echo $val.','; } ?> ]
            }]
          },
          options: {
            responsive: true,
            legend: {
              display: false
            },
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                }
              }]
            }
          }
        });
        
        var ctxz = document.getElementById('garph_psikologi').getContext('2d');
        var chart = new Chart(ctxz, {
          type: 'line',
          data: {
            labels: [ '',<?php foreach($tahun_angkatan as $val){ echo '"'.$val.'",'; } ?> ],
            datasets: [{
              label: 'Rating Tes Psikologi',
            //   backgroundColor: '#fc1703',
              borderColor: '#fc1703',
              data: [ 0,<?php foreach($garph_psikologi as $val){ echo $val.','; } ?> ]
            }]
          },
          options: {
            responsive: true,
            legend: {
              display: false
            },
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                }
              }]
            }
          }
        });
        
        });
</script>
</body>
</html>

