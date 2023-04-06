  <!--==========================
    Intro Section
  ============================-->
  <!--<section id="intro" class="clearfix front-intro-section">-->
  <!--  <div class="container">-->
  <!--    <div class="intro-img">-->
  <!--    </div>-->
      <!--<div class="intro-info">-->
      <!--  <h2><span><?php echo lang('account'); ?> > Tes Interview Internal</span></h2>-->
      <!--</div>-->
  <!--  </div>-->
  <!--</section><!-- #intro -->

  <main id="main" style="margin-top:180px; margin-bottom:50px;" >

    <!--==========================
      Account Area Setion
    ============================-->
    <section id="about">
      <div class="container">

        <div class="row mt-10">
          <div class="col-lg-3">
            <div class="account-area-left">
              <ul>
                <?php include(VIEW_ROOT.'/front/partials/account-sidebar.php'); ?>
              </ul>
            </div>
          </div>

          <div class="col-md-9 col-lg-9 col-sm-12">
            <div class="row">
            <?php if ($quizes) { ?>
            
            <div class="col-md-12 col-lg-12 col-sm-12">
              <p style="background-color:#bfc2c7;font-size:15px;padding:15px">
              <b style="color:red">Perhatikan :</b>
              <br>
              1. Ketika memulai Tes harap periksa koneksi Anda , agar Tes berjalan lancar
              <br>
              2. Kerjakan Tes sesuai waktu yang ditentukan
              <br>
              3. Jika Anda mengerjakan Tes menggunakan HP (Tampilan Mobile) <b style="color:red">jangan ubah tampilan menjadi mode desktop !</b> , tetap kerjakan dalam mode Mobile (default mode browser) agar tidak terjadi masalah
              </p>
              </div>
              
            <?php foreach ($quizes as $q) { ?>
            <?php $d = objToArr(json_decode($q['quiz_data'])); ?>
            <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="quiz-item-box">
              
                <p class="quiz-item-box-heading">
                  <?php echo esc_output($d['quiz']['title'], 'html'); ?> 
                </p>
                <p class="quiz-listing-quiz-description">
                  <?php echo esc_output($d['quiz']['description'], 'html'); ?>
                </p>
                <div class="container">
                  <div class="row quiz-listing-items-container">
                    <div class="col-md-6 col-sm-6 quiz-listing-items">
                      <span class="job-detail-items-title">Waktu</span>
                      <span class="job-detail-items-value"><?php echo esc_output($q['allowed_time']); ?> minutes</span>
                    </div>
                    <div class="col-md-6 col-sm-6 job-detail-items">
                      <span class="job-detail-items-title"><?php echo lang('questions'); ?></span>
                      <span class="job-detail-items-value"><?php echo esc_output($q['total_questions']); ?></span>
                    </div>
                 
                     <div class="col-md-12 col-sm-12 ">
                         <br>
                         <?php
                         if($cek_data_verif->account_type == "kampus"){
                         if(!empty($cek_data_verif->ktp) && !empty($cek_data_verif->ijazah)){
                if ($q['status_quiz'] == 1) {?>
                <a class="btn btn-warning" style="color:white" href="<?php echo base_url(); ?>account/tes-interview-internal-pre/<?php echo encode($q['candidate_quiz_id']); ?>">Lanjutkan Pengerjaan</a>
                <?php }else if($q['status_quiz'] == 2){ ?>
               <button class="btn btn-success" >Tes Interview Internal Selesai</button>
                <?php }else if ($q['status_quiz'] == 0){ ?>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>account/tes-interview-internal-pre/<?php echo encode($q['candidate_quiz_id']); ?>"><?php echo lang('attempt'); ?> Pengerjaan</a>
                <?php } }else{ ?>
                  <?php if($cek_data_verif->account_type == "vokasi" || $cek_data_verif->account_type == "kampus" ){?>
                  <p>
                <b style="color:red">Verifikasi Akun (KTP dan Surat Rekomendasi) untuk lanjut ke tahap berikutnya</b>
                </p>
                <?php }else{ ?>
                <p>
                <b style="color:red">Verifikasi Akun (KTP dan Pendidikan Terakhir) untuk lanjut ke tahap berikutnya</b>
                </p>
                <?php } ?>
                
                 <?php if (empty($cek_data_verif->ktp)){?>

                <a href="<?=base_url()?>account/profile"><button class="btn btn-danger">Lengkapi Data Anda</button></a>
                <?php }else if(empty($cek_data_verif->ijazah)){ ?>

                <a href="<?=base_url()?>account/resume/<?=encode($resume_verif);?>"><button class="btn btn-danger">Lengkapi Data Anda.</button></a> 
                <?php } ?>
                <?php } }else{
                
                 if ($q['status_quiz'] == 1) {?>
                <a class="btn btn-warning" style="color:white" href="<?php echo base_url(); ?>account/tes-interview-internal-pre/<?php echo encode($q['candidate_quiz_id']); ?>">Lanjutkan Pengerjaan</a>
                <?php }else if($q['status_quiz'] == 2){ ?>
               <button class="btn btn-success" >Tes Kompetensi Selesai</button>
                <?php }else if ($q['status_quiz'] == 0){ ?>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>account/tes-interview-internal-pre/<?php echo encode($q['candidate_quiz_id']); ?>"><?php echo lang('attempt'); ?> Pengerjaan</a>
                <?php } }?>
                
              </div>
              </div>
              </div>
              </div>
            </div>
            <?php } ?>
            <?php } else { ?>
            <div class="job-detail account-no-content-box">
              Tes Kompetensi Akan DIjadwalkan Oleh Admin . Silahkan menunggu Informasi lebih lanjut.
            </div>
            <?php } ?>
            </div>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <?php echo esc_output($pagination, 'raw'); ?>
              </div>
            </div>            
          </div>

      </div>
    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>