  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-cube"></i> Link Pendaftaran</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-cube"></i> Link Pendaftaran</li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">

      <!-- Main row Starts-->
      <div class="row">
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-header">
              <!--<h3 class="box-title"><?php echo lang('profile'); ?></h3>-->
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Link Pendaftaran Siswa</label>
                    <input type="text" readonly="1" class="form-control" value="https://smk.cybersjob.com/register/<?php echo $profile->link_siswa; ?>">
                  </div>
                  <p style="color:blue"><b>SIlahkan Copy link berikut untuk Pendaftaran Siswa dan Guru SMK</b></p>
                </div>
                <!--<div class="col-md-12">-->
                <!--  <div class="form-group">-->
                <!--    <label>Link Pendaftaran Guru</label>-->
                <!--    <input type="text" readonly="1" class="form-control" value="https://smk.cybersjob.com/register_guru/<?php echo $profile->link_guru;; ?>">-->
                <!--  </div>-->
                <!--</div>-->
              </div>
            </div>
               
          </div>
        </section>
      </div>
      <!-- Main row Ends-->
    </section>
    <!-- Main content Ends-->

  </div>
  <!-- Content Wrapper Ends -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/user.js"></script>

</body>
</html>
