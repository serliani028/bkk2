<ul>
    <li style="background-color:#072C44;">
		<a style="background-color:#072C44">
			<i class="fas fa-list" style="color:white"></i><b style="color:white"> Dashboard Siswa </b>  
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>account" <?php echo acActive($page, 'resumes'); ?>>
			<b>(+)</b> Skill & Pengalaman
		</a>
	</li>

	<li>
		<a href="<?php echo base_url(); ?>account/job-applications" <?php echo acActive($page, 'applications'); ?>>
			<b>(+)</b> Daftar Tes diikuti
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>account/tes-interview-internal" <?php echo acActive($page, 'interview-internal'); ?>>
			<b>(?)</b> <?php echo 'Tes Kompetensi'; ?> <?php if($jumlah_interview_internal > 0 ){?><small style="border-radius:100%;background-color:orange;color:white;padding-left:5px;padding-right:5px"><?=@$jumlah_interview_internal;?></small><?php }?> 
		</a>
	</li>
    	<li>
		<a href="<?php echo base_url(); ?>account/tes-esai" <?php echo acActive($page, 'tes_esai'); ?>>
			<b>(?)</b> <?php echo 'Tes Esai'; ?> 
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>account/quizes" <?php echo acActive($page, 'quizes'); ?>>
			<b>(?)</b> Tes Psikologi <?php if($jumlah_quiz > 0){?> <small style="border-radius:100%;background-color:orange;color:white;padding-left:5px;padding-right:5px;font-size:4">!</small><?php } ?>
		</a>
	</li>
	<li style="background-color:#072C44">
		<a style="background-color:#072C44">
		<i class="fas fa-cog" style="color:white"></i><b style="color:white"> Profil & Setting </b>  
		</a>
	</li>
	
	<li>
		<a href="<?php echo base_url(); ?>account/profile" <?php echo acActive($page, 'profile'); ?>>
			<i class="fa fa-user"></i> <?php echo lang('profile'); ?> </a>
	</li>
    
    <li>
		<a href="<?php echo base_url(); ?>account/hobby" <?php echo acActive($page, 'hobby'); ?>>
			<i class="fa fa-link"></i> Hobi,Medsos & Kegiatan
		</a>
	</li>
	
	<li>
		<a href="<?php echo base_url(); ?>account/password" <?php echo acActive($page, 'password'); ?>>
			<i class="fa fa-key"></i> <?php echo lang('password'); ?>
		</a>
	</li>

	<li>
		<a href="<?php echo base_url(); ?>logout">
			<i class="fas fa-sign-out-alt"></i> <?php echo lang('logout'); ?>
		</a>
	</li>
</ul>
