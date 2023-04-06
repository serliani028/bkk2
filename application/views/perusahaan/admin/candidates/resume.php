<?php if ($resum) { ?>
<table>
  <tr>
    <td>

      <?php if ($resum['image'] != NULL){ ?>
        <img src="<?php echo candidateThumb($resum['image']); ?>" height="80px" width="70px" style="border-radius:100%" />
      <?php }else{ ?>
        <i style="font-size:70px" class="fa fa-user"></i>
      <?php } ?>

    </td>
    <td style="padding-left:20px">
      <h5 class="job-board-resume-section-title">
        <?php echo esc_output($resum['first_name'].' '.$resum['last_name'], 'html'); ?>
      </h5>
      <p>
        <?php if ($resum['file'] != FALSE): ?>
          <a class="btn btn-primary" target="_blank" href="<?php echo base_url('/assets/images/candidates/'.$resum['file_cv']) ;?>"  > Lihat FIle CV </a>
          <?php else: ?>
          <p style="background-color:grey;padding:7px;border-radius:3px;color:white" >File Kosong</p>
        <?php endif; ?>
      </p>
    </td>
  </tr>
</table>
<!-- <h2 class="job-board-resume-section-title">Biodata</h2> -->
<table>
 <tr>
    <td width="30%">
      <p>DOB </p>
      <p>No. Telp </p>
      <p>Whatsapp </p>
      <p>Peminatan </p>
      <p>Refrensi  </p>
      <p>Telegram  </p>
      <p>Media Sosial  </p>
    </td>
    <td width="70%">
      <p>&nbsp;&nbsp; : <b><?php echo esc_output($resum['dob'],'html' ); ?></b></p>
      <p>&nbsp;&nbsp; : <b><?php echo esc_output($resum['phone1'],'html' ); ?></b></p>
      <p>&nbsp;&nbsp; : <b><?php echo esc_output($resum['whatsapp'],'html' ); ?></b></p>
      <p>&nbsp;&nbsp; : <b><?php echo esc_output(@$peminatan,'html' ); ?></b></p>
      <p>&nbsp;&nbsp; : <b><?php echo esc_output($resum['refrensi'],'html' ); ?></b></p>
      <p>&nbsp;&nbsp; : <b><?php echo esc_output($resum['telegram'],'html' ); ?></b></p>
      <p>&nbsp;&nbsp; : <b>(<?php echo esc_output($resum['media_sosial'],'html' ); ?>)</b></p>
    </td>
  </tr>
</table>
<h4><b>Alamat</b></h4>
<p><?php echo esc_output($resum['address'].', Kel. '.$kel.', Kec. '.$kec.', '.$kab.', Provinsi '.$prov , 'html'); ?></p>
<?php if ($resum['bio'] != ""): ?>
<h2  class="job-board-resume-section-title">Biografi Singkat :</h2>
<p><?php echo esc_output($resum['bio'], 'html'); ?></p>
<?php endif; ?>
<!--<h2 class="job-board-resume-section-title"><?php echo lang('objective'); ?></h2>-->
<!--<p><?php echo esc_output($resum['objective'], 'html'); ?></p>-->
<h2 class="job-board-resume-section-title"><?php echo lang('job_experiences'); ?></h2>
<?php if ($resum['experiences']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resum['experiences'] as $experience) { ?>
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
<?php if ($resum['qualifications']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resum['qualifications'] as $qualification) { ?>
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
<?php if ($resum['languages']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resum['languages'] as $language) { ?>
    <li>
    <p class="job-board-resume-job-title"><?php echo esc_output($language['title'], 'html'); ?> (<?php echo esc_output($language['proficiency'], 'html'); ?>)</p>
    </li>
  <?php } ?>
  </ol>
</div>
<?php } else { ?>
  <p><?php echo lang('there_are_no_languages'); ?></p>
<?php } ?>

<!-- <h2 class="job-board-resume-section-title"><?php echo lang('achievements'); ?></h2>
<?php if ($resum['achievements']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resum['achievements'] as $achievement) { ?>
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
<?php if ($resum['references']) { ?>
<div class="circles-content-element circles-list">
  <ol>
  <?php foreach ($resum['references'] as $reference) { ?>
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
</div> -->
<?php } else { ?>
  <p><?php echo lang('there_are_no_references'); ?></p>
<?php } ?>

<?php } else { ?>
  <p>No Resume Found</p>
<?php } ?>
