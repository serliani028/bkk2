  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <?php $l = base_url().'perusahaan/admin/'; ?>

        <li <?php selMenu($menu, 'dashboard'); ?>>
          <a href="<?php echo $l; ?>dashboard"><i class="fas fa-tachometer-alt"></i> <span><?php echo lang('dashboard'); ?></span></a>
        </li>

       
        <li <?php selMenu($menu, 'job_board'); ?>>
          <a href="<?php echo $l; ?>job-board"><i class="fas fa-newspaper"></i> <span><?php echo lang('job_board'); ?></span></a>
        </li>
       
        <li class="header"><?php echo lang('jobs_management'); ?></li>
        <li class="treeview <?php selMenu($menu, array('job', 'jobs', 'companies', 'departments')); ?>">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span><?php echo lang('jobs'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li <?php selMenu($menu, 'job'); ?>>
              <a href="<?php echo $l; ?>jobs/create-or-edit"><i class="fas fa-cube"></i> <?php echo lang('create'); ?></a>
            </li>
          
           
            <li <?php selMenu($menu, 'jobs'); ?>>
              <a href="<?php echo $l; ?>jobs"><i class="fas fa-cube"></i> <?php echo lang('listing'); ?></a>
            </li>
           
           <li <?php selMenu($menu, 'departments'); ?>>
              <a href="<?php echo $l; ?>departments"><i class="fas fa-cube"></i> <?php echo lang('departments'); ?></a>
            </li>
           
            <li <?php selMenu($menu, 'kategori-pekerjaan'); ?>>
              <a href="<?php echo $l; ?>kategori-pekerjaan"><i class="fas fa-cube"></i> Kategori Pekerjaan</a>
            </li>
          </ul>
        </li>
        <li <?php selMenu($menu, 'pendaftar-kandidat'); ?>>
          <a href="<?php echo $l; ?>pendaftar-kandidat"><i class="fa fa-id-card"></i> <span>Kandidat Pelamar</span></a>
        </li>

        
        <li class="header"><?php echo lang('scaling_tools_management'); ?></li>

        <li <?php selMenu($menu, 'interviews'); ?>>
          <a href="<?php echo $l; ?>interview-designer"><i class="fas fa-clipboard-list"></i> <span><?php echo lang('interview_designer'); ?></span>
          </a>
        </li>
      
        <li <?php selMenu($menu, 'traits'); ?>>
          <a href="<?php echo $l; ?>traits"><i class="fas fa-star-half-alt"></i> <span><?php echo lang('traits'); ?></span></a>
        </li>
     
        <li <?php selMenu($menu, 'kelola-link'); ?>>
          <a href="<?php echo $l; ?>kelola-link"><i class="fa fa-camera "></i> <span>Kelola Link Zoom</span></a>
        </li>
        
        <li <?php selMenu($menu, 'kelola-form'); ?>>
          <a href="<?php echo $l; ?>kelola-form"><i class="fa fa-file-text"></i> <span>Kelola Link Google Form</span></a>
        </li>



      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
