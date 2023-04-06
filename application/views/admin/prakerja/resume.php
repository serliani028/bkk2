<?php if ($resume) { ?>
<table>
  <tr>
    <td>
      <img src="<?php echo candidateThumb($resume['image']); ?>" height="70" />
    </td>
    <td>
      <h2 class="job-board-resume-section-title">
        <?php echo esc_output($resume['first_name'].' '.$resume['last_name'], 'html'); ?>
      </h2>
      <p>
        <?php if ($resume['file'] != FALSE): ?>
          <a class="btn btn-primary" target="_blank" href="<?php echo base_url('/assets/images/candidates/'.$resume['file']) ;?>"  > Dowmload FIle Candidates</a>
          <?php else: ?>
          <p style="background-color:grey;padding:7px;border-radius:3px;color:white" >File Candidates is Not Available</p>
        <?php endif; ?>
      </p>
    </td>
  </tr>
</table>
<h2 class="job-board-resume-section-title"><?php echo lang('objective'); ?></h2>
<p><?php echo esc_output($resume['objective'], 'html'); ?></p>
<h2 class="job-board-resume-section-title"><?php echo lang('job_experiences'); ?></h2>
<?php if ($resume['experiences']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resume['experiences'] as $experience) { ?>
    <li>
    <p class="job-board-resume-job-title"><?php echo esc_output($experience['title'], 'html'); ?> - <?php echo esc_output($experience['company'], 'html'); ?></p>
    <p class="job-board-resume-job-duration">
      (<?php echo timeFormat($experience['from']); ?> - <?php echo timeFormat($experience['to']); ?>)
    </p>
    <p class="job-board-resume-job-description"><?php echo esc_output($experience['description'], 'html'); ?></p>
    </li>
  <?php } ?>
  </ol>
</div>
<?php } else { ?>
  <p><?php echo lang('there_are_no_experiences'); ?></p>
<?php } ?>

<h2 class="job-board-resume-section-title"><?php echo lang('qualifications'); ?></h2>
<?php if ($resume['qualifications']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resume['qualifications'] as $qualification) { ?>
    <li>
    <p class="job-board-resume-job-title"><?php echo esc_output($qualification['title'], 'html'); ?> - <?php echo esc_output($qualification['institution'], 'html'); ?></p>
    <p class="job-board-resume-job-duration">
      (<?php echo timeFormat(esc_output($qualification['from'], 'html')); ?> - <?php echo timeFormat(esc_output($qualification['to'], 'html')); ?>)
    </p>
    <p class="job-board-resume-job-description">
      <?php echo esc_output($qualification['marks'], 'html'); ?> Out of <?php echo esc_output($qualification['out_of'], 'html'); ?>
    </p>
    </li>
  <?php } ?>
  </ol>
</div>
<?php } else { ?>
  <p><?php echo lang('there_are_no_qualifications'); ?></p>
<?php } ?>

<h2 class="job-board-resume-section-title"><?php echo lang('languages'); ?></h2>
<?php if ($resume['languages']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resume['languages'] as $language) { ?>
    <li>
    <p class="job-board-resume-job-title"><?php echo esc_output($language['title'], 'html'); ?> (<?php echo esc_output($language['proficiency'], 'html'); ?>)</p>
    </li>
  <?php } ?>
  </ol>
</div>
<?php } else { ?>
  <p><?php echo lang('there_are_no_languages'); ?></p>
<?php } ?>

<h2 class="job-board-resume-section-title"><?php echo lang('achievements'); ?></h2>
<?php if ($resume['achievements']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resume['achievements'] as $achievement) { ?>
    <li>
    <p class="job-board-resume-job-title"><?php echo esc_output($achievement['title'], 'html'); ?> (<?php echo esc_output($achievement['type'], 'html'); ?>)</p>
    <?php if ($achievement['date']) { ?>
    <p class="job-board-resume-job-duration">
      (<?php echo esc_output($achievement['date'], 'html'); ?>)
    </p>
    <?php } ?>
    <?php if ($achievement['link']) { ?>
    <p class="job-board-resume-job-duration">
      (<?php echo esc_output($achievement['link'], 'html'); ?>)
    </p>
    <?php } ?>
    <p class="job-board-resume-job-description">
      <?php echo esc_output($achievement['description'], 'html'); ?>
    </p>
    </li>
  <?php } ?>
  </ol>
</div>
<?php } else { ?>
  <p><?php echo lang('there_are_no_achievements'); ?></p>
<?php } ?>

<h2 class="job-board-resume-section-title"><?php echo lang('references'); ?></h2>
<?php if ($resume['references']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resume['references'] as $reference) { ?>
    <li>
    <p class="job-board-resume-job-title"><?php echo esc_output($reference['title'], 'html'); ?> (<?php echo esc_output($reference['relation'], 'html'); ?>)</p>
    <?php if ($reference['company']) { ?>
    <p class="job-board-resume-job-duration">
      (<?php echo esc_output($reference['company'], 'html'); ?>)
    </p>
    <?php } ?>
    <?php if ($reference['phone']) { ?>
    <p class="job-board-resume-job-duration">
      (<?php echo esc_output($reference['phone'], 'html'); ?>)
    </p>
    <?php } ?>
    <p class="job-board-resume-job-duration">
      (<?php echo esc_output($reference['email'], 'html'); ?>)
    </p>
    </li>
  <?php } ?>
  </ol>
</div>
<?php } else { ?>
  <p><?php echo lang('there_are_no_references'); ?></p>
<?php } ?>

<?php } else { ?>
  <p>No Resume Found</p>
<?php } ?>
