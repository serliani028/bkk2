<?php if ($jobs) { ?>
<?php foreach ($jobs as $job) { 
if($job['status_psikotes'] == 1){
    $psi = " Kelas X";
}else if($job['status_psikotes'] == 2){
    $psi = " Kelas XI";
}else if($job['status_psikotes'] == 3){
    $psi = " Kelas XII";
}else if($job['status_psikotes'] == 4){
    $psi = " ---";
}?>
<tr class="text-center">
  <td>
    <a href="<?php echo base_url(); ?>admin/jobs/create-or-edit/<?php echo esc_output($job['job_id']); ?>">
      <?php echo esc_output($job['title'], 'html'); ?>
    </a>
    <a href="<?php echo base_url(); ?>admin/job-board/<?php echo esc_output($job['job_id']); ?>" target="_blank">
      <i class="fas fa-external-link-alt"></i>
    </a>
  </td>
   <td><?php echo esc_output($psi, 'html'); ?> </td>
  <td><?php echo esc_output($job['total_count'], 'html'); ?></td>
  
 

</tr>
<?php } ?>
<?php } ?>