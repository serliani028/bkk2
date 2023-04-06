  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-newspaper"></i> Papan Tes Seleksi TalentHub</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-newspaper"></i> Papan Tes Seleksi TalentHub</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row job-board-main-container">
        <!-- Left col -->
        <section class="col-lg-12">

          <div class="box box-primary">
            <div class="box-body job-board-box-body">

              <?php if (allowedTo('view_job_board')) { ?>
              <!-- Job Board Inner/Main Container Starts -->
              <div class="container job-board-inner-container">
                <div class="row">

                  <!-- Job Board Left Container Starts -->
                  <div class="col-md-3 job-board-left-container">
                    <div class="job-board-left-top" style="min-height:0px">

                      <!--<div class="col-xs-12 col-sm-12 col-md-12 job-board-left-top-heading">-->
                        <!--<small style="font-size:15px;"><span >Pilih Psikotes untuk melihat penerimaan</span></small>-->
                        <!--<br>-->
                        <!--<div class="job-board-jobs-pagination">-->
                        <!--<div class="btn-group pull-right">-->
                        <!--  <button type="button" class="btn btn-xs btn-primary btn-blue jobs-previos-button"><</button>-->
                        <!--  <button type="button" class="btn btn-xs btn-primary btn-blue disabled" id="jobs_pagination_container">-->
                        <!--    <?php echo esc_output($jobs_pagination, 'html'); ?>-->
                        <!--  </button>-->
                        <!--  <button type="button" class="btn btn-xs btn-primary btn-blue jobs-next-button">></button>-->
                        <!--</div>-->
                        <!--<div class="btn-group pull-right job-board-jobs-perpage-btn">-->
                        <!--  <button type="button" class="btn btn-xs btn-primary btn-blue dropdown-toggle" -->
                        <!--          data-toggle="dropdown" aria-expanded="false">-->
                        <!--    <span class="caret"></span>-->
                        <!--  </button>-->
                        <!--  <ul class="dropdown-menu">-->
                        <!--    <li><a href="#" class="jobs-per-page" data-value="10">10 <?php echo lang('per_page'); ?></a></li>-->
                        <!--    <li><a href="#" class="jobs-per-page" data-value="25">25 <?php echo lang('per_page'); ?></a></li>-->
                        <!--    <li><a href="#" class="jobs-per-page" data-value="50">50 <?php echo lang('per_page'); ?></a></li>-->
                        <!--    <li><a href="#" class="jobs-per-page" data-value="200">200 <?php echo lang('per_page'); ?></a></li>-->
                        <!--  </ul>-->
                        <!--</div>-->
                        <!--</div>-->
                      <!--</div>-->
                            <br>
                      <div class="col-xs-12 col-sm-12 col-md-12 job-board-left-jobs-container">
                        <div class="input-group job-board-job-search">
                          <input type="hidden" id="jobs_page" value="<?php echo esc_output($jobs_page); ?>">
                          <input type="hidden" id="jobs_per_page" value="<?php echo esc_output($jobs_per_page); ?>">
                          <input type="hidden" id="jobs_total_pages" value="<?php echo esc_output($jobs_total_pages); ?>">
                          <input type="text" class="form-control" placeholder="Search Jobs" 
                            id="jobs_search" value="<?php echo esc_output($jobs_search); ?>">
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-blue btn-flat jobs-search-button">
                              <i class="fa fa-search"></i>
                            </button>
                          </span>
                        </div>
                       
                      </div>
                    </div>
                    <div class="job-board-left">
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" id="jobs_list">
                          <?php echo esc_output($jobs, 'raw'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Job Board Left Container Ends -->

                  <!-- Job Board Right Container Starts -->
                  <div class="col-md-9 job-board-right-container">
                    <div class="job-board-right-controls">
                      <div class="container job-board-right-controls-inner">
                        <div class="row">
                          <div class="col-md-6">
                            <h3>
                            <p class="job_title"></p>
                            <!--<span class="small candidates_all"> Peserta</span>-->
                            </h3>
                          </div>
                          <div class="col-md-6">
                            <div class="job-board-candidate-pagination">
                            <div class="btn-group pull-right">
                              <button type="button" class="btn btn-xs btn-primary btn-blue candidates-previos-button" style="padding:5px"><</button>
                              <button type="button" class="btn btn-xs btn-primary btn-blue disabled" 
                                id="candidates_pagination_container" style="padding:5px">
                                1-1 of 1
                              </button>
                              <button type="button" class="btn btn-xs btn-primary btn-blue candidates-next-button" style="padding:5px">></button>
                            </div>
                            <div class="btn-group pull-right job-board-candidate-perpage-btn">
                              <button type="button" class="btn btn-xs btn-primary btn-blue dropdown-toggle" 
                                      data-toggle="dropdown" aria-expanded="false" style="padding:5px">
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" style="padding:20px">
                                <li><a href="#" class="candidates-per-page" data-value="10">10 <?php echo lang('per_page'); ?></a></li>
                                <li><a href="#" class="candidates-per-page" data-value="25">25 <?php echo lang('per_page'); ?></a></li>
                                <li><a href="#" class="candidates-per-page" data-value="50">50 <?php echo lang('per_page'); ?></a></li>
                                <li><a href="#" class="candidates-per-page" data-value="200">200 <?php echo lang('per_page'); ?></a></li>
                              </ul>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">

                            <?php if (allowedTo('actions_job_board')) { ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary btn-blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="#" class="select-all"><?php echo lang('select_all'); ?></a></li>
                                <li><a href="#" class="unselect-all"><?php echo lang('unselect_all'); ?></a></li>
                              </ul>
                            </div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary btn-blue btn-flat">Tugaskan / Tandai </button>
                              <button type="button" class="btn btn-primary btn-blue btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#" class="bulk-action" data-action="assign-quiz">Tugaskan Tes Kompetensi</a></li>
                                <li><a href="#" class="bulk-action" data-action="assign-psikotes">Tugaskan Tes Psikologi</a></li>
                                <li class="divider"></li>
                                
                                 <li><a href="#" class="bulk-action" data-action="interviewed">Tandai Lolos Psikotes</a></li>
                                <li><a href="#" class="bulk-action" data-action="hired"><?php echo lang('mark_hired'); ?></a></li>
                                <li><a href="#" class="bulk-action" data-action="rejected"><?php echo lang('mark_rejected'); ?></a></li>
                                <li class="divider"></li>
                                <!--<li><a href="#" class="bulk-action" data-action="shortlisted"><?php echo lang('mark_shortlisted'); ?></a></li>-->
                               
                                <li><a href="#" class="bulk-action" data-action="assign-interview">Kirim Zoom Interview</a></li>
                                <li class="divider"></li>
                                <!--<li><a href="#" class="bulk-action" data-action="e-overall"><?php echo lang('export_overall_result_excel'); ?></a></li>-->
                                <!--<li><a href="#" class="bulk-action" data-action="e-interview"><?php echo lang('export_interview_result_pdf'); ?></a></li>-->
                                <!--<li><a href="#" class="bulk-action" data-action="e-quiz"><?php echo lang('export_quiz_result_pdf'); ?></a></li>-->
                                <!--<li><a href="#" class="bulk-action" data-action="e-self"><?php echo lang('export_self_assesment_result_pdf'); ?></a></li>-->
                                <!--<li><a href="#" class="bulk-action" data-action="e-resume"><?php echo lang('export_resume_pdf'); ?></a></li>-->
                              </ul>
                            </div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary btn-blue btn-flat"><?php echo lang('sort_by'); ?></button>
                              <button type="button" class="btn btn-primary btn-blue btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <!--<li><a href="#" class="sort" data-action="overall"><?php echo lang('highest_result'); ?></a></li>-->
                                <!--<li><a href="#" class="sort" data-action="interview"><?php echo lang('highest_interview_result'); ?></a></li>-->
                                <li><a href="#" class="sort" data-action="quiz">Hasil Tes Internal Tertinggi</a></li>
                                <li><a href="#" class="sort" data-action="rating">Hasil Tes Psikologi Tertinggi</a></li>
                                <li><a href="#" class="sort" data-action="rating2">Hasil Rating Tertinggi</a></li>
                                <!--<li><a href="#" class="sort" data-action="self"><?php echo lang('highest_self_assesment_result'); ?></a></li>-->
                                <li><a href="#" class="sort" data-action="applied"><?php echo lang('date_applied'); ?></a></li>
                                <!--<li><a href="#" class="sort" data-action="experience"><?php echo lang('most_experienced'); ?></a></li>-->
                              </ul>
                            </div>
                            <?php } ?>
                          </div>
                          <div class="col-md-6">

                            <div class="input-group job-board-candidate-search">
                              <input type="hidden" id="candidates_page" value="<?php echo esc_output($candidates_page); ?>">
                              <input type="hidden" id="candidates_per_page" value="<?php echo esc_output($candidates_per_page); ?>">
                              <input type="hidden" id="candidates_total_pages" value="<?php //echo esc_output($candidates_total_pages); ?>">
                              <input type="hidden" id="candidates_sort" value="<?php echo esc_output($candidates_sort); ?>">
                              <input type="hidden" id="job_id" value="<?php echo esc_output($first_job_id); ?>">
                              <input type="text" class="form-control" placeholder="Search Candidates" id="candidates_search">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-blue btn-flat candidates-search-button">
                                  <i class="fa fa-search"></i>
                                </button>
                              </span>
                            </div>
                            <div class="btn-group btn-sm job-board-candidate-filter" title="More Filters">
                              <button type="button" class="btn btn-primary btn-blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-filter"></i>
                              </button>
                              <ul class="dropdown-menu">
                                <li>
                                  <h4 class="job-board-filters-heading">
                                   Filter Data
                                  </h4>
                                  <form role="form">
                                    <div class="box-body">
                                      <!--<div class="form-group">-->
                                      <!--  <label><?php echo lang('experience_months'); ?></label>-->
                                      <!--  <div class="row">-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_min_experience" placeholder="6" value="<?php echo esc_output($candidates_min_experience); ?>">-->
                                      <!--    </div>-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_max_experience" placeholder="24" value="<?php echo esc_output($candidates_max_experience); ?>">-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</div>-->
                                      <!--<div class="form-group">-->
                                      <!--  <label><?php echo lang('overall_result'); ?> (%)</label>-->
                                      <!--  <div class="row">-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_min_overall" placeholder="50" value="<?php echo esc_output($candidates_min_overall); ?>">-->
                                      <!--    </div>-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_max_overall" placeholder="100" value="<?php echo esc_output($candidates_max_overall); ?>">-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</div>-->
                                      <!--<div class="form-group">-->
                                      <!--  <label><?php echo lang('interview_result'); ?> (%)</label>-->
                                      <!--  <div class="row">-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_min_interview" placeholder="50" value="<?php echo esc_output($candidates_min_interview); ?>">-->
                                      <!--    </div>-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_max_interview" placeholder="100" value="<?php echo esc_output($candidates_max_interview); ?>">-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</div>-->
                                      <!--<div class="form-group">-->
                                      <!--  <label>Tes Interview Internal  (%)</label>-->
                                      <!--  <div class="row">-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_min_quiz" -->
                                      <!--      placeholder="50" value="<?php echo esc_output($candidates_min_quiz); ?>">-->
                                      <!--    </div>-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_max_quiz" -->
                                      <!--      placeholder="100" value="<?php echo esc_output($candidates_max_quiz); ?>">-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</div>-->
                                      <!--<div class="form-group">-->
                                      <!--  <label><?php echo lang('self_assesment'); ?> (%)</label>-->
                                      <!--  <div class="row">-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_min_self" -->
                                      <!--      placeholder="50" value="<?php echo esc_output($candidates_min_self); ?>">-->
                                      <!--    </div>-->
                                      <!--    <div class="col-sm-6">-->
                                      <!--      <input type="number" class="form-control" id="candidates_max_self" -->
                                      <!--      placeholder="100" value="<?php echo esc_output($candidates_max_self); ?>">-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</div>-->
                                      <div class="form-group">
                                        <label><?php echo lang('status'); ?></label>
                                        <div class="row">
                                          <div class="col-sm-12">
                                            <select class="form-control" id="candidates_status">
                                              <option value=""><?php echo lang('all'); ?></option>
                                              <option value="applied">Belum Lolos Psikotes</option>
                                              <!--<option value="shortlisted"></option>-->
                                              <option value="interviewed">Lolos Psikotes</option>
                                              <option value="hired"><?php echo lang('hired'); ?></option>
                                              <option value="rejected"><?php echo lang('rejected'); ?></option>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="box-footer">
                                      <button type="submit" class="btn btn-primary btn-blue btn-xs job-board-candidate-filter-apply-btn"><?php echo lang('apply'); ?>
                                      </button>
                                    </div>
                                  </form>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="job-board-right" id="candidates_list">
                    </div>
                  </div>
                  <!-- Job Board Right Container Ends -->

                </div>
              </div>
              <!-- Job Board Inner/Main Container Ends -->
              <?php } ?>

            </div>
          </div>

        </section>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Right Modal -->
  <div class="modal right fade" id="modal-right" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Right Sidebar</h4>
        </div>
        <div class="modal-body-container">
        </div>
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->
  
<!-- Forms for jobs section / left side -->
<form id="jobs_form"></form>
<form id="candidates_form"></form>
<form id="resumes_form" method="POST" action="<?php echo base_url(); ?>admin/candidates/resume-download" target="_blank"></form>
<form id="overall_form" method="POST" action="<?php echo base_url(); ?>admin/job-board/overall-result" target="_blank"></form>
<form id="pdf_form" method="POST" action="<?php echo base_url(); ?>admin/job-board/pdf-result" target="_blank"></form>

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/job_board.js"></script>

</body>
</html>