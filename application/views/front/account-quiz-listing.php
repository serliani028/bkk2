  <?php include('function_psikotes.php');?>
  <!--==========================
    Intro Section
  ============================-->
  <!--<section id="intro" class="clearfix front-intro-section" >-->
  <!--  <div class="container">-->
  <!--    <div class="intro-img">-->
  <!--    </div>-->
      <!--<div class="intro-info">-->
      <!--  <h2><span><?php echo lang('account'); ?> > Tes Psikologi </span></h2> <!--<?php echo lang('quizes'); ?>-->
      <!--</div>-->
  <!--  </div>-->
  <!--</section><!-- #intro -->-->

  <main id="main" style="margin-top:180px; margin-bottom:50px;">

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
           <?php if ($quizes) { 
             if($jumlah_interview_internal > 0){?>
             <div class="col-md-9 col-lg-9 col-sm-12">
                  <div class="row">
                     <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="quiz-item-box">
                   <p class="quiz-item-box-heading">
                  Silahkan Selesaikan Tahap Tes Internal Terlebih dahulu.
                  </p>
               
                   <div class="container">
                    <br>
                  <div class="row quiz-listing-items-container">
                     
                     <div class="col-md-12 col-sm-12 ">
                          <p>
                <b style="color:red">Tes Internal Belum Selesai.</b>
                </p>
                <p><a href="<?=base_url();?>account/tes-interview-internal" style="border:1px solid blue;padding:5px"><u>Selesaikan Tes Internal</u></a></p>
                
                         </div>
                         </div>
                         </div>
              
                </div>
             </div>
             </div>
             </div>
            <?php }else{?>
          <div class="col-md-9 col-lg-9 col-sm-12">
            <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
              <p style="background-color:#bfc2c7;font-size:15px;padding:15px">
              <b style="color:red">Perhatikan :</b>
              <br>
              1. Pastikan Data diri Anda sudah benar , karena akan menjadi biodata Tes Psikologi Anda !
              <br>
              2. Ketika memulai Tes Psikologi harap periksa koneksi Anda , agar Tes Psikologi berjalan lancar
              <br>
              3. Kerjakan Tes Psikologi sesuai waktu yang ditentukan
              <br>
              4. Jika Tes dimulai dan tidak diselesaikan maka secara otomatis peserta dinyatakan tidak lolos Tes Psikologi
              <br>
              5. Jika Tes dimulai dan waktu habis sebelum selesai mengerjakan silahkan hubungi <a href="https://api.whatsapp.com/send?phone=6281928694634" target="_blank"> Admin test.cybersjob.com </a>
              </p>
              </div>
            <?php foreach ($quizes as $q) { ?>
            <!--?php $d = objToArr(json_decode($q['quiz_data'])); ?-->
            <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="quiz-item-box">
                <div class="dotmenu">
                  
                  
                </div>
                <p class="quiz-item-box-heading">
                  <?php echo esc_output($q['deskripsi'], 'html'); ?>
                </p>
                
                <div class="container">
                    <br>
                  <div class="row quiz-listing-items-container">
                     
                     <div class="col-md-12 col-sm-12 ">
                       <?php
                        if(getStatusByKode($q['kode_aktivasi']) == 0 && getProgressByKode($q['kode_aktivasi']) == 0){ ?>
                        <b>Status Tes Psikologi : <br><br><i style="color:white;padding:5px;background-color:orange;border-radius:7px">Belum Dikerjakan</i> </b>
                  <?php }else if(getProgressByKode($q['kode_aktivasi']) == 1){ ?>
                       <b>Status Tes Psikologi : <br><br><i style="color:white;padding:5px;background-color:blue;border-radius:10%">Belum Selesai</i> </b>
                        <!--<button class="btn btn-primary">Status : Belum Selesai</button>-->
                  <?php }else if(getStatusByKode($q['kode_aktivasi']) == 1 && getProgressByKode($q['kode_aktivasi']) == NULL){ ?>
                        <b>Status Tes Psikologi : <br><br><i style="color:white;padding:5px;background-color:green;border-radius:10%">Sudah Selesai</i> </b>
                        <!--<button class="btn btn-success">Status : Sudah Dikerjakan</button><br>-->
                  <?php }else if(getStatusByKode($q['kode_aktivasi']) == 0){?>
                  <b>Status Tes Psikologi : <br><br><i style="color:white;padding:5px;background-color:orange;border-radius:10%">Belum Dikerjakan</i> </b>
                        <!--<button class="btn btn-warning">Status : Belum Dikerjakan</button>-->
                  <?php }
                  ?>
                  
                    </div>
                    
                    <div class="col-md-12 col-sm-12 quiz-listing-items" style="padding:20px">
                      <span class="job-detail-items-title" style="padding:15px"><?php echo 'Kode '; ?></span>
                      <?php
                        if(getStatusByKode($q['kode_aktivasi']) == 0 && getProgressByKode($q['kode_aktivasi']) == 0){ ?>
                       <span class="job-detail-items-value" style="padding:15px;color:orange"><?php echo esc_output($q['kode_aktivasi']); ?></span>
                  <?php }else if(getProgressByKode($q['kode_aktivasi']) == 1){ ?>
                      <span class="job-detail-items-value" style="padding:15px;color:blue"><?php echo esc_output($q['kode_aktivasi']); ?></span>
                  <?php }else if(getStatusByKode($q['kode_aktivasi']) == 1 && getProgressByKode($q['kode_aktivasi']) == NULL){ ?>
                       <span class="job-detail-items-value" style="padding:15px;color:green"><?php echo esc_output($q['kode_aktivasi']); ?></span>
                  <?php }else if(getStatusByKode($q['kode_aktivasi']) == 0){?>
                     <span class="job-detail-items-value" style="padding:15px;color:orange"><?php echo esc_output($q['kode_aktivasi']); ?></span>
                  <?php }
                  ?>
                  </div>
                    
                   
                   <div class="col-md-12 col-sm-12 ">
                        <?php
                        if(getStatusByKode($q['kode_aktivasi']) == 0 && getProgressByKode($q['kode_aktivasi']) == 0){ ?>
                      <a target="_blank" href="<?php echo 'https://psikotest.cybersjob.com/psi/m?kode='.$q['kode_aktivasi'] ?>"> 
                     <button class="btn btn-primary">Kerjakan Sekarang </button>
                     </a>
                  <?php }else if(getProgressByKode($q['kode_aktivasi']) == 1){ ?>
                       <a target="_blank" href="<?php echo 'https://psikotest.cybersjob.com/psi/m?kode='.$q['kode_aktivasi'] ?>"> 
                     <button class="btn btn-primary">Lanjut Kerjakan </button>
                     </a>
                  <?php }else if(getStatusByKode($q['kode_aktivasi']) == 1 && getProgressByKode($q['kode_aktivasi']) == NULL){ ?>
                        <!--<button class="btn btn-success">Sudah Dikerjakan</button><br>-->
                       
                  <?php }else if(getStatusByKode($q['kode_aktivasi']) == 0){?>
                     <a target="_blank" href="<?php echo 'https://psikotest.cybersjob.com/psi/m?kode='.$q['kode_aktivasi'] ?>"> 
                     <button class="btn btn-primary">Kerjakan Sekarang </button>
                     </a>
                  <?php }
                  ?>
                   </div>
                    
                  </div>
                </div>
              </div>
            </div>
            
            <?php } ?>
            
           
            
          <?php } ?>
            <?php }else{ ?>
            
              <div class="col-md-9 col-lg-9 col-sm-9">
          <div class="job-detail account-no-content-box">
              Tes Psikologi Akan DIjadwalkan Oleh Admin . Silahkan menunggu Informasi lebih lanjut.
            </div>
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