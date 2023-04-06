<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fas fa-tachometer-alt"></i> <?php echo lang('dashboard'); ?>
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      
       <table class="table table-bordered table-striped" id="sertifikat" >
              <thead>
                <tr>
                <td rowspan="2" style="text-align: center;background: #db7287;color:white;vertical-align: middle;"><b>NO . </b></td>
                <td rowspan="2" style="text-align: center;background: #f2b8c4;color:black;vertical-align: middle;"><b>STATUS PENERIMAAN </b></td>
                <td colspan="7" style="text-align:center;background: orange;color:white"><b>SUMBER INFORMASI LOWONGAN KERJA</b></td>
                <td rowspan="2" style="background: #fcd9a4;color:black;text-align:center;vertical-align: middle"><b>TOTAL DATA</b></td>
                </tr>
                <tr>
                <td style="background: #d6249f;color:white;text-align:center"><b>Instagram</b></td>
                <td style="background: blue;color:white;text-align:center"><b>Facebook</b></td>
                <td style="background: yellow;color:black;text-align:center"><b>TikTok</b></td>
                <td style="background: #0077b5;color:white;text-align:center"><b>Linkedln</b></td>
                <td style="background: #00a0dc;color:white;text-align:center"><b>Loker Telegram</b></td>
                <td style="background: green;color:white;text-align:center"><b>Media Lain</b></td>
                <td style="background: grey;color:white;text-align:center"><b>Teman / Orang Lain</b></td>
                </tr>
              </thead>
              <tbody style="text-align:center">
                  <tr>
                      <td>
                         <b> 1. </b>
                      </td>
                      <td style="text-align:left">
                         <b>CV DITERIMA HRD</b> 
                      </td>
                       <td>
                         <?=$cv_diterima['ig'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['fb'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['tiktok'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['linke'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['tele'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['med'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['teman'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['total'];?>
                       </td>
                  </tr>
                  <tr>
                      <td>
                         <b> 2.</b>
                      </td>
                      <td style="text-align:left">
                         <b> CV SCREENING HRD</b>
                      </td>
                      <td>
                         <?=$cv_screening['ig'];?>
                       </td>
                       <td>
                           <?=$cv_screening['fb'];?>
                       </td>
                       <td>
                           <?=$cv_screening['tiktok'];?>
                       </td>
                       <td>
                           <?=$cv_screening['linke'];?>
                       </td>
                       <td>
                           <?=$cv_screening['tele'];?>
                       </td>
                       <td>
                           <?=$cv_screening['med'];?>
                       </td>
                       <td>
                           <?=$cv_screening['teman'];?>
                       </td>
                       <td>
                           <?=$cv_screening['total'];?>
                       </td>
                         </tr> 
                    <tr>
                      <td>
                        <b>  3.</b>
                      </td>
                      <td style="text-align:left">
                        <b> KANDIDAT PSIKOTES</b>
                      </td>
                      <td>
                         <?=$diinterview['ig'];?>
                       </td>
                       <td>
                           <?=$diinterview['fb'];?>
                       </td>
                       <td>
                           <?=$diinterview['tiktok'];?>
                       </td>
                       <td>
                           <?=$diinterview['linke'];?>
                       </td>
                       <td>
                           <?=$diinterview['tele'];?>
                       </td>
                       <td>
                           <?=$diinterview['med'];?>
                       </td>
                       <td>
                           <?=$diinterview['teman'];?>
                       </td>
                       <td>
                           <?=$diinterview['total'];?>
                       </td> 
                       </tr> 
                    <tr>
                        <tr>
                      <td>
                        <b>  4.</b>
                      </td>
                      <td style="text-align:left">
                        <b> KANDIDAT LOLOS PSIKOTES</b>
                      </td>
                      <td>
                         <?=$form['ig'];?>
                       </td>
                       <td>
                           <?=$form['fb'];?>
                       </td>
                       <td>
                           <?=$form['tiktok'];?>
                       </td>
                       <td>
                           <?=$form['linke'];?>
                       </td>
                       <td>
                           <?=$form['tele'];?>
                       </td>
                       <td>
                           <?=$form['med'];?>
                       </td>
                       <td>
                           <?=$form['teman'];?>
                       </td>
                       <td>
                           <?=$form['total'];?>
                       </td> 
                       </tr> 
                    <tr>
                      <td>
                        <b>  5. </b>
                      </td>
                      <td style="text-align:left">
                         <b> KANDIDAT INTERVIEW </b>
                      </td>
                      <td>
                         <?=$form['ig'];?>
                       </td>
                       <td>
                           <?=$form['fb'];?>
                       </td>
                       <td>
                           <?=$form['tiktok'];?>
                       </td>
                       <td>
                           <?=$form['linke'];?>
                       </td>
                       <td>
                           <?=$form['tele'];?>
                       </td>
                       <td>
                           <?=$form['med'];?>
                       </td>
                       <td>
                           <?=$form['teman'];?>
                       </td>
                       <td>
                           <?=$form['total'];?>
                       </td>
                  </tr>
                  <tr>
                      <td>
                          <b>6. </b>
                      </td>
                      <td style="text-align:left">
                         <b> KANDIDAT LOLOS INTERVIEW </b>
                      </td>
                      <td>
                         <?=$inter2['ig'];?>
                       </td>
                       <td>
                           <?=$inter2['fb'];?>
                       </td>
                       <td>
                           <?=$inter2['tiktok'];?>
                       </td>
                       <td>
                           <?=$inter2['linke'];?>
                       </td>
                       <td>
                           <?=$inter2['tele'];?>
                       </td>
                       <td>
                           <?=$inter2['med'];?>
                       </td>
                       <td>
                           <?=$inter2['teman'];?>
                       </td>
                       <td>
                           <?=$inter2['total'];?>
                       </td>
                  </tr> 
                  <tr>
                      <td>
                          <b>7.</b>
                      </td>
                      <td style="text-align:left">
                         <b> KANDIDAT INTERVIEW TAHAP 2</b>
                      </td>
                      <td>
                         <?=$inter2['ig'];?>
                       </td>
                       <td>
                           <?=$inter2['fb'];?>
                       </td>
                       <td>
                           <?=$inter2['tiktok'];?>
                       </td>
                       <td>
                           <?=$inter2['linke'];?>
                       </td>
                       <td>
                           <?=$inter2['tele'];?>
                       </td>
                       <td>
                           <?=$inter2['med'];?>
                       </td>
                       <td>
                           <?=$inter2['teman'];?>
                       </td>
                       <td>
                           <?=$inter2['total'];?>
                       </td>
                  </tr> 
                  <tr>
                      <td>
                          <b>8.</b>
                      </td>
                      <td style="text-align:left">
                         <b> KANDIDAT LOLOS INTERVIEW TAHAP 2</b>
                      </td>
                      <td>
                         <?=$bekerja['ig'];?>
                       </td>
                       <td>
                           <?=$bekerja['fb'];?>
                       </td>
                       <td>
                           <?=$bekerja['tiktok'];?>
                       </td>
                       <td>
                           <?=$bekerja['linke'];?>
                       </td>
                       <td>
                           <?=$bekerja['tele'];?>
                       </td>
                       <td>
                           <?=$bekerja['med'];?>
                       </td>
                       <td>
                           <?=$bekerja['teman'];?>
                       </td>
                       <td>
                           <?=$bekerja['total'];?>
                       </td>
                  </tr> 
                  <tr>
                      <td>
                       <b>   9.</b>
                      </td>
                      <td style="text-align:left">
                         <b> KANDIDAT DITOLAK </b>
                      </td>
                      <td>
                         <?=$ditolak['ig'];?>
                       </td>
                       <td>
                           <?=$ditolak['fb'];?>
                       </td>
                       <td>
                           <?=$ditolak['tiktok'];?>
                       </td>
                       <td>
                           <?=$ditolak['linke'];?>
                       </td>
                       <td>
                           <?=$ditolak['tele'];?>
                       </td>
                       <td>
                           <?=$ditolak['med'];?>
                       </td>
                       <td>
                           <?=$ditolak['teman'];?>
                       </td>
                       <td>
                           <?=$ditolak['total'];?>
                       </td>
                  </tr>
                  <tr>
                      <td>
                        <b>  10.</b>
                      </td>
                      <td style="text-align:left">
                          <b>KANDIDAT DIPEKERJAKAN </b>
                      </td>
                      <td>
                         <?=$bekerja['ig'];?>
                       </td>
                       <td>
                           <?=$bekerja['fb'];?>
                       </td>
                       <td>
                           <?=$bekerja['tiktok'];?>
                       </td>
                       <td>
                           <?=$bekerja['linke'];?>
                       </td>
                       <td>
                           <?=$bekerja['tele'];?>
                       </td>
                       <td>
                           <?=$bekerja['med'];?>
                       </td>
                       <td>
                           <?=$bekerja['teman'];?>
                       </td>
                       <td>
                           <?=$bekerja['total'];?>
                       </td>
                  </tr> 
                  
              </tbody>
              <tfoot>
                <tr >
                <td rowspan="2" colspan="2" style="background: black;color:white;text-align:center;padding:20px"><b>TOTAL PRESENTASE</b></td>
                <td rowspan="2" style="background: #d6249f;color:white;text-align:center;padding:20px"><b><?=round($ig,1);?> %</b></td>
                <td rowspan="2" style="background: blue;color:white;text-align:center;padding:20px"><b><?=round($fb,1);?> %</b></td>
                <td rowspan="2" style="background: yellow;color:black;text-align:center;padding:20px"><b><?=round($tiktok,1);?> %</b></td>
                <td rowspan="2" style="background: #0077b5;color:white;text-align:center;padding:20px"><b><?=round($linke,1);?> %</b></td>
                <td rowspan="2" style="background: #00a0dc;color:white;text-align:center;padding:20px"><b><?=round($tele,1);?> %</b></td>
                <td rowspan="2" style="background: green;color:white;text-align:center;padding:20px"><b><?=round($med,1);?> %</b></td>
                <td rowspan="2" style="background: grey;color:white;text-align:center;padding:20px"><b><?=round($teman,1);?> %</b></td>
                <td rowspan="2" style="background: #fcd9a4;color:black;text-align:center;padding:20px"><b><?=round($total,1);?> %</b></td>
                </tr>
              </tfoot>
            </table>
            
 
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      
      <!-- Left col-->
      <section class="col-lg-6">
      
        <!-- DONUT CHART -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('popular_jobs'); ?></h3>
            <div class="box-tools pull-right">
              <input class="minimal popular" type="checkbox" checked="checked" id="applied_check_ph" checked="checked" disabled="1" style=""/> 
              <strong>CV <?php echo lang('applied'); ?></strong>
            </div>
          </div>
          <div class="box-body">
            <div class="chart tab-pane jobs-chart" id="jobs-chart_ph"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

        
      </section>
      <!-- /.Left col -->

      <!-- right col chart-->
      <section class="col-lg-6">

        
       
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('job_statuses'); ?></h3>
            <div class="box-tools pull-right">
              <div class="btn-group pull-right">
                <button type="button" class="btn btn-xs btn-primary btn-blue dashboard-jobs-previos-button"><</button>
                <button type="button" class="btn btn-xs btn-primary btn-blue disabled" id="dashboard_jobs_pagination_container_ph">
                  1 - 10
                </button>
                <button type="button" class="btn btn-xs btn-primary btn-blue dashboard-jobs-next-button">></button>
              </div>
              <input type="hidden" id="dashboard_jobs_page_ph" value="<?php echo esc_output($dashboard_jobs_page); ?>">
              <input type="hidden" id="dashboard_jobs_total_pages_ph" value="<?php echo esc_output($dashboard_jobs_total_pages); ?>">
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th><?php echo lang('job'); ?></th>
                  <th>Department</th>
                  <th><?php echo lang('candidates'); ?></th>
                  <th><?php echo lang('status'); ?></th>
                </tr>
                </thead>
                <tbody id="dashboard_jobs_list_ph">
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
        </div>
      

        

      </section>
      <!-- right col -->
      
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Forms for actions -->
<form id="jobs_data_form_ph"></form>
<form id="jobs_list_form_ph"></form>
<form id="todos_list_form_ph"></form>
<form id="candidates_data_form_ph"></form>

<?php include(VIEW_ROOT.'/perusahaan/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/dashboard.js"></script>

</body>
</html>

