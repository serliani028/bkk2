  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
       
       
<?php $l = base_url().'admin/'; ?>
 <?php 
  $cek = $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row();
  if(!empty($cek)){?>
        <li <?php selMenu($menu, 'dashboard'); ?>>
          <a href="<?php echo $l; ?>dashboard"><i class="fas fa-tachometer-alt"></i> <span><?php echo lang('dashboard'); ?></span></a>
        </li>
  <?php if($cek->status_mitra == 0){?>
             <li class="header"><b class="badge" style="background-color:blue"><i class="fas fa-building"></i>Kelola Data Sekolah</b></li>
            <li >
              <a href="#"><i class="fas fa-award"></i> <span>Kelola Tahun Angkatan</span></a>
            </li>
            <li >
              <a href="#"><i class="fas fa-archive"></i><span> Kelola Jurusan </span></a>
            </li>
            <li >
              <a href="#"><i class="fas fa-bookmark"></i> <span>Kelola Kelas </span></a>
            </li>
            <li >
              <a href="#"><i class="fas fa-link"></i> <span>Link Pendaftaran </span></a>
            </li>
            <li <?php selMenu($menu, 'Siswa'); ?>>
              <a href="#"><i class="fas fa-users"></i><span> Kelola Siswa </span></a>
            </li>
         
          <li class="header"><p class="badge" style="background-color:orange"><i class="fas fa-plus"></i>&nbsp; Kelola Seleksi Siswa</p></li>
            <li >
            <a href="#"><i class="fas fa-plus-circle"></i> <span>Kelola Tes Kompetensi </span></a>
            </li>
            <li >
              <a href="#"><i class="fas fa-plus-circle"></i> <span>Kelola Tes Psikologi</span></a>
            </li>
            <!--<li >-->
            <!--  <a href=""><i class="fas fa-exchange-alt"></i> <span>Kelola Penyaluran Siswa</span></a>-->
            <!--</li>-->
            <!--<li>-->
            <!--  <a href="#"><i class="fas fa-chalkboard-teacher"></i><span> Kelola Pelatihan Siswa</span></a>-->
            <!--</li>-->
            
        <li class="header"><p class="badge" style="background-color:green"><i class="fas fa-cube"></i>&nbsp; Kelola Data Lainnya</p></li>
            <li>
                  <a href="#"><i class="fas fa-cube"></i> <span>Kelola Jenis Pengalaman</span></a>
            </li>
            <li>
              <a href="#"><i class="fas fa-cube"></i> <span>Kelola Jenis SKill</span></a>
            </li>
  <?php }else{?>
  
        
          <li class="header"><p class="badge" style="background-color:blue"><i class="fas fa-graduation-cap"></i>&nbsp; Kelola Data Sekolah</p></li>
            <li <?php selMenu($menu, 'tahunAngkatan'); ?> >
              <a href="<?=base_url()?>sekolah/kelola-tahun-angkatan"><i class="fas fa-award"></i> <span>Kelola Tahun Angkatan</span></a>
            </li>
            <li <?php selMenu($menu, 'Jurusan'); ?>>
              <a href="<?=base_url()?>sekolah/kelola-jurusan"><i class="fas fa-archive"></i><span> Kelola Jurusan </span></a>
            </li>
            <li <?php selMenu($menu, 'Kelas'); ?>>
              <a href="<?=base_url()?>sekolah/kelola-kelas"><i class="fas fa-bookmark"></i> <span>Kelola Kelas </span></a>
            </li>
            <li <?php selMenu($menu, 'LinkPendaftaran'); ?>>
              <a href="<?=base_url()?>sekolah/kelola-link"><i class="fas fa-link"></i> <span>Link Pendaftaran </span></a>
            </li>
            <li <?php selMenu($menu, 'Siswa'); ?>>
              <a href="<?=base_url()?>sekolah/kelola-siswa"><i class="fas fa-users"></i><span> Kelola Siswa Aktif</span></a>
            </li>
            <!--<li <?php selMenu($menu, 'SiswaAlumni'); ?>>-->
            <!--  <a href="<?=base_url()?>sekolah/kelola-siswa-alumni"><i class="fas fa-users"></i><span> Kelola Siswa Alumni</span></a>-->
            <!--</li>-->
            <li <?php selMenu($menu, 'SiswaBKK'); ?>>
              <a href="<?=base_url()?>sekolah/kelola-siswa-bkk"><i class="fas fa-chalkboard-teacher"></i><span> Kelola Data BKK</span></a>
            </li>
          <li class="header"><p class="badge" style="background-color:orange"><i class="fas fa-plus"></i>&nbsp; Kelola Seleksi Siswa</p></li>
            <li <?php selMenu($menu, 'Kompetensi'); ?>>
            <a href="<?=base_url()?>sekolah/kelola-tes-kompetensi"><i class="fas fa-plus-circle"></i> <span>Kelola Tes Kompetensi </span></a>
            </li>
            <li <?php selMenu($menu, 'Psikologi'); ?>>
              <a href="<?=base_url()?>sekolah/kelola-tes-psikologi"><i class="fas fa-plus-circle"></i> <span>Kelola Tes Psikologi</span></a>
            </li>
             <li <?php selMenu($menu, 'kelola-kode'); ?>>
          <a href="<?php echo $l; ?>kelola-kode"><i class="fa fa-clipboard "></i> <span>Kelola Batch Psikotest</span></a>
        </li>
            <!--<li <?php selMenu($menu, 'Akhir'); ?>>-->
            <!--  <a href="<?=base_url()?>sekolah/kelola-penyaluran-siswa"><i class="fas fa-exchange-alt"></i> <span>Kelola Penyaluran Siswa</span></a>-->
            <!--</li>-->
         <li class="header"><p class="badge" style="background-color:green"><i class="fas fa-cube"></i>&nbsp; Kelola Data Lainnya</p></li>
            <!--<li>-->
            <!--      <a href="#"><i class="fas fa-cube"></i> <span>Kelola Pengalaman</span></a>-->
            <!--</li>-->
            <!--<li>-->
            <!--  <a href="#"><i class="fas fa-cube"></i> <span>Kelola SKill</span></a>-->
            <!--</li>-->
            <li class="treeview <?php selMenu($menu, array('question_categories', 'quiz_categories', 'interview_categories')); ?>">
          <!--<a href="#">-->
          <!--  <i class="fa fa-list"></i> <span>PPDB Talenthub</span>-->
          <!--  <span class="pull-right-container">-->
          <!--    <i class="fa fa-angle-left pull-right"></i>-->
          <!--  </span>-->
          <!--</a>-->
          <ul class="treeview-menu">
            <!--<li <?php selMenu($menu, 'question_categories'); ?>>-->
            <!--  <a href="<?php echo base_url('PPDB_Controller/admin_dashboard')?>"><i class="fas fa-cube"></i>Dashboard</a>-->
            <!--</li>-->

            <li <?php selMenu($menu, 'quiz_categories'); ?>>
              <a href="<?php echo base_url('PPDB_Controller/list_pendaftar/-1')?>"><i class="fas fa-cube"></i>Data Siswa PPDB</a>
            </li>
            
            <li <?php selMenu($menu, 'quiz_categories'); ?>>
              <a href="<?php echo base_url('PPDB_Controller/list_butuhVerifikasi')?>"><i class="fas fa-cube"></i>List Butuh Verifikasi</a>
            </li>
            
            <li <?php selMenu($menu, 'quiz_categories'); ?>>
              <a href="<?php echo base_url('PPDB_Controller/list_pendaftar/1')?>"><i class="fas fa-cube"></i>Lunas Pembayaran 1</a>
            </li>
            
            <li <?php selMenu($menu, 'quiz_categories'); ?>>
              <a href="<?php echo base_url('PPDB_Controller/list_pendaftar/2')?>"><i class="fas fa-cube"></i>Lunas Pembayaran 2</a>
            </li>
            
            <li <?php selMenu($menu, 'quiz_categories'); ?>>
              <a href="<?php echo base_url('PPDB_Controller/penempatan')?>"><i class="fas fa-cube"></i>Siswa Perlu Penempatan</a>
            </li>
            
            <li <?php selMenu($menu, 'quiz_categories'); ?>>
              <a href="<?php echo base_url('PPDB_Controller/sudah_penempatan')?>"><i class="fas fa-cube"></i>Siswa Sudah Ditempatkan</a>
            </li>
            
          </ul>
        </li>
 
  <?php }?>
   <li class="treeview <?php selMenu($menu, array('profile', 'password')); ?>">
          <a href="#">
            <i class="fa fa-cogs"></i> <span><?php echo lang('settings'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php selMenu($menu, 'profile'); ?>>
              <a href="<?php echo $l; ?>profile"><i class="fas fa-circle"></i> <?php echo lang('profile'); ?></a>
            </li>
            <li <?php selMenu($menu, 'password'); ?>>
              <a href="<?php echo $l; ?>password"><i class="fas fa-circle"></i> <?php echo lang('password'); ?></a>
            </li>
            
          </ul>
        </li>
  <?php }else{ ?>
            <li <?php selMenu($menu, 'dashboard'); ?>>
          <a href="<?php echo $l; ?>dashboard"><i class="fas fa-tachometer-alt"></i> <span><?php echo lang('dashboard'); ?></span></a>
        </li>

        <?php if (allowedTo('view_job_board')) { ?>
        <li <?php selMenu($menu, 'job_board'); ?>>
          <a href="<?php echo $l; ?>job-board"><i class="fas fa-newspaper"></i> &nbsp;<span>Papan Peserta Magang</span></a>
        </li>
        <?php } ?>
        
        <li <?php selMenu($menu, 'candidate_interviews'); ?>>
        <a href="<?php echo $l; ?>candidate-interviews"><i class="fas fa-gavel"></i> &nbsp;<span> Kelola Hasil Tes Esai</span></a>
      </li>

    

        <?php if (allowedTo(array('view_jobs', 'create_jobs', 'view_companies', 'view_departments'))) { ?>
        <li class="header"><?php echo lang('jobs_management'); ?></li>
        <li class="treeview <?php selMenu($menu, array('job', 'jobs', 'companies', 'kategori-pekerjaan')); ?>">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span>Kelola Magang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if (allowedTo('create_jobs')) { ?>
            <li <?php selMenu($menu, 'job'); ?>>
              <a href="<?php echo $l; ?>jobs/create-or-edit"><i class="fas fa-cube"></i> <?php echo lang('create'); ?> Tes Seleksi </a>
            </li>
            <?php } ?>
            <?php if (allowedTo('view_jobs')) { ?>
            <li <?php selMenu($menu, 'jobs'); ?>>
              <a href="<?php echo $l; ?>jobs"><i class="fas fa-cube"></i> <?php echo lang('listing'); ?> Tes Seleksi</a>
            </li>
            <?php } ?>
            
            <li <?php selMenu($menu, 'companies'); ?>>
              <a href="<?php echo $l; ?>companies"><i class="fas fa-cube"></i> <?php echo lang('companies'); ?></a>
            </li>
            
            <?php if (allowedTo('view_departments')) { ?>
            <!--<li <?php selMenu($menu, 'departments'); ?>>-->
            <!--  <a href="<?php echo $l; ?>departments"><i class="fas fa-cube"></i> <?php echo lang('departments'); ?></a>-->
            <!--</li>-->
            <?php } ?>
            <!--<li <?php selMenu($menu, 'kategori-pekerjaan'); ?>>-->
            <!--  <a href="<?php echo $l; ?>kategori-pekerjaan"><i class="fas fa-cube"></i> Kelola Divisi </a>-->
            <!--</li>-->
          </ul>
        </li>
        <?php } ?>
        
        <?php if (allowedTo('view_candidate_listing')) { ?>
       
        <li <?php selMenu($menu, 'candidates'); ?>>
          <a href="<?php echo $l; ?>candidates"><i class="fa fa-user"></i> <span>Data User </span></a>
        </li>
        <?php } ?>
      
        
        <?php if (allowedTo(array('view_jobs'))) { ?>
           <li <?php selMenu($menu, 'mitra_vokasi'); ?>>
          <a href="<?php echo $l; ?>mitra_vokasi"><i class="fa fa-cube"></i> <span>Data Mitra Vokasi</span></a>
          </li>
        <?php } ?>
         

        <?php if (allowedTo(array('view_quizes', 'view_interviews', 'view_traits'))) { ?>
        <li class="header"><?php echo lang('scaling_tools_management'); ?></li>

        <?php if (allowedTo('view_quizes')) { ?>
        <li <?php selMenu($menu, 'quizes'); ?>>
          <a href="<?php echo $l; ?>quiz-designer"><i class="far fa-list-alt"></i> <span> &nbsp;Kelola Tes Kompetensi</span></a>
        </li>
        <?php } ?>
        
        <?php if (allowedTo('view_interviews')) { ?>
          <li <?php selMenu($menu, 'interviews'); ?>>
            <a href="<?php echo $l; ?>interview-designer"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;<span> Kelola Tes Esai</span>
            </a>
          </li>
        <?php } ?>
         
         <li <?php selMenu($menu, 'kelola-kode'); ?>>
          <a href="<?php echo $l; ?>kelola-kode"><i class="fa fa-clipboard "></i> <span>Kelola Batch Psikotest</span></a>
        </li>

        <?php if (allowedTo(array('view_question_categories', 'view_quiz_categories', 'view_interview_categories'))) { ?>
        <li class="treeview <?php selMenu($menu, array('question_categories', 'quiz_categories', 'interview_categories')); ?>">
          <a href="#">
            <i class="fa fa-list"></i> <span>Kategori Tes Kompetensi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if (allowedTo('view_question_categories')) { ?>
            <li <?php selMenu($menu, 'question_categories'); ?>>
              <a href="<?php echo $l; ?>question-categories"><i class="fas fa-cube"></i> <?php echo lang('question_categories'); ?></a>
            </li>
            <?php } ?>
            
            <?php if (allowedTo('view_quiz_categories')) { ?>
            <li <?php selMenu($menu, 'quiz_categories'); ?>>
              <a href="<?php echo $l; ?>quiz-categories"><i class="fas fa-cube"></i> Kategori Tes Kompetensi</a>
            </li>
            <?php } ?> 

            <?php if (allowedTo('view_interview_categories')) { ?>
            <li <?php selMenu($menu, 'interview_categories'); ?>>
              <a href="<?php echo $l; ?>interview-categories"><i class="fas fa-cube"></i> Kategori Tes Esai</a>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <?php } ?>
            
        <?php if (allowedTo(array('view_team_listing', 'view_candidate_listing'))) { ?>
        <li class="header"><?php echo lang('users_management'); ?></li>
        <?php } ?>
    
        <li <?php selMenu($menu, 'pengalaman'); ?>><a href="<?php echo $l; ?>kelola-pengalaman"><i class="fas fa-cube"></i> <span>Kelola Jenis Pengalaman</span></a></li>
        <li <?php selMenu($menu, 'skill'); ?>><a href="<?php echo $l; ?>kelola-skill"><i class="fas fa-cube"></i> <span>Kelola Jenis SKill</span></a></li>
        
        
        <?php if (allowedTo('view_team_listing')) { ?>
        <li <?php selMenu($menu, 'team'); ?>>
          <a href="<?php echo $l; ?>users"><i class="fa fa-users"></i> <span><?php echo lang('team'); ?></span></a>
        </li>
        <?php } ?>
      
        <?php if (allowedTo(array('view_blog_listing', 'view_blog_categories'))) { ?>
        <!--<li class="treeview <?php selMenu($menu, array('blogs', 'blog_categories')); ?>">-->
        <!--  <a href="#">-->
        <!--    <i class="fas fa-blog"></i> <span><?php echo lang('blogs'); ?></span>-->
        <!--    <span class="pull-right-container">-->
        <!--      <i class="fa fa-angle-left pull-right"></i>-->
        <!--    </span>-->
        <!--  </a>-->
        <!--  <ul class="treeview-menu">-->
            <?php if (allowedTo('view_blog_listing')) { ?>
            <!--<li <?php selMenu($menu, 'blogs'); ?>>-->
            <!--  <a href="<?php echo $l; ?>blogs"><i class="fas fa-cube"></i> <?php echo lang('listing'); ?></a>-->
            <!--</li>-->
            <?php } ?>
            <?php if (allowedTo('view_blog_categories')) { ?>
            <!--<li <?php selMenu($menu, 'blog_categories'); ?>>-->
            <!--  <a href="<?php echo $l; ?>blog-categories"><i class="fas fa-cube"></i> <?php echo lang('categories'); ?></a>-->
            <!--</li>-->
            <?php } ?>
        <!--  </ul>-->
        <!--</li>-->
        <?php } ?>

        <li class="treeview <?php selMenu($menu, array('general_settings', 'api_settings', 'css_settings', 'profile', 'password',
        'footer_sections', 'languages', 'home_page_settings', 'update_application')); ?>">
          <a href="#">
            <i class="fa fa-cogs"></i> <span><?php echo lang('settings'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if (allowedTo('general_settings')) { ?>
            <li <?php selMenu($menu, 'general_settings'); ?>>
              <a href="<?php echo $l; ?>settings/general"><i class="fas fa-cube"></i> <?php echo lang('general_settings'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('home_page_settings')) { ?>
            <li <?php selMenu($menu, 'home_page_settings'); ?>>
              <a href="<?php echo $l; ?>settings/home"><i class="fas fa-cube"></i> <?php echo lang('home_page'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('footer_settings')) { ?>
            <li <?php selMenu($menu, 'footer_sections'); ?>>
              <a href="<?php echo $l; ?>footer-sections"><i class="fas fa-cube"></i> <?php echo lang('footer'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('apis_settings')) { ?>
            <li <?php selMenu($menu, 'api_settings'); ?>>
              <a href="<?php echo $l; ?>settings/apis"><i class="fas fa-cube"></i> <?php echo lang('apis'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('css_settings')) { ?>
            <li <?php selMenu($menu, 'css_settings'); ?>>
              <a href="<?php echo $l; ?>settings/css"><i class="fas fa-cube"></i> <?php echo lang('css'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('languages_settings')) { ?>
            <li <?php selMenu($menu, 'languages'); ?>>
              <a href="<?php echo $l; ?>languages"><i class="fas fa-cube"></i> <?php echo lang('languages'); ?></a>
            </li>
            <?php } ?>
            <li <?php selMenu($menu, 'profile'); ?>>
              <a href="<?php echo $l; ?>profile"><i class="fas fa-cube"></i> <?php echo lang('profile'); ?></a>
            </li>
            <li <?php selMenu($menu, 'password'); ?>>
              <a href="<?php echo $l; ?>password"><i class="fas fa-cube"></i> <?php echo lang('password'); ?></a>
            </li>
            <?php if (allowedTo('update_application')) { ?>
            <li <?php selMenu($menu, 'update_application'); ?>>
              <a href="<?php echo $l; ?>settings/update-app">
                <i class="fas fa-cube"></i> <?php echo lang('update_application'); ?>
              </a>
            </li>
            <?php } ?>
          </ul>
        </li>
 <?php if (allowedTo(array('view_jobs'))) { ?>
        <li>
          <a href="<?php echo base_url(); ?>" target="_blank">
            <i class="fas fa-external-link-alt"></i> <span>Candidate Area</span>
          </a>
        </li>

<?php } ?>
  <?php } ?>
    <!-- /.sidebar -->

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
