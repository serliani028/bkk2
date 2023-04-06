<?php if ($jobs) { ?>
<?php $count = 1; ?>
<?php foreach ($jobs as $job) { 
if($job['status_psikotes'] == 1){
    $psi = "<i class='fa fa-list'></i> Kelas X";
}else if($job['status_psikotes'] == 2){
    $psi = "<i class='fa fa-list'></i> Kelas XI";
}else if($job['status_psikotes'] == 3){
    $psi = "<i class='fa fa-list'></i> Kelas XII";
}else if($job['status_psikotes'] == 4){
    $psi = "<i class='fa fa-list'></i> ---";
}
?>
  <div class="job-board-job-wrap">
    <h3 class="job-board-job-title job-<?php echo esc_output($job['job_id']); ?> <?php echo esc_output($count) == 1 ? 'first-job' : ''; ?>" 
        title="Click to select" 
        data-id="<?php echo esc_output($job['job_id']); ?>"
        data-title="<?php echo esc_output($job['title']); ?>"
        data-status="<?php echo esc_output($psi); ?>"
        >
      <?php if ($job['hired_count']) { ?>
      <i class="fa fa-check-circle text-green" title="<?php echo esc_output($job['hired_count']).' '.lang('candidate_hired'); ?>"></i> 
      <?php } ?>
      <?php echo trimString($job['title']); ?>
    </h3>
    <span class="job-board-job-item job-board-job-item-general">
      <!--<i class="fa fa-bookmark"></i> <?php echo trimString($job['department']); ?>-->
    </span>
    <span class="job-board-job-item job-board-job-item-general">
      <i class="fa fa-clock-o"></i> <?php echo lang('posted'); ?> : <?php echo dateFormat($job['created_at']); ?>
    </span>
   <span class="job-board-job-item-separator-line" ></span>
   
   
    <p class="btn btn-success btn-sm">
      <i class="fa fa-list"></i>
      <?php if ($job['status_psikotes'] == 1){echo "Kelas X";}else if($job['status_psikotes'] == 2){echo "Kelas XI";}
      else if($job['status_psikotes'] == 3){echo "Kelas XII";}else if($job['status_psikotes'] == 4){echo "---";}
      ?>
    </p>
   
    
  </div>
<?php $count++; ?>
<?php } ?>
<?php } else { ?>
	<p><?php echo lang('no_jobs_found'); ?></p>
<?php } ?>
