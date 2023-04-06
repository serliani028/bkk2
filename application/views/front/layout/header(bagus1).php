<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo esc_output($page); ?></title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="<?php echo esc_output(setting('site-keywords')); ?>" name="keywords">
  <meta content="<?php echo esc_output(setting('site-description')); ?>" name="description">
  <meta property="route" content="<?php echo base_url(); ?>">
  <meta property="token" content="<?php echo esc_output($this->security->get_csrf_hash()); ?>">

  <!-- Favicon -->
  <link href="<?php echo base_url(); ?>assets/front/images/<?php echo setting('site-favicon'); ?>" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- CSS Libraries (For External components/plugins) -->
  <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/font-awesome-all.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/dropify.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/jquery-ui.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/bootstrap-social.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/bar-rating-pill.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/plugins/iCheck/square/blue.css" rel="stylesheet">

  <!-- Internal Style files -->
  <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/custom-style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/candidatefinder.css" rel="stylesheet">
</head>
<style>
   @media only screen and (max-width: 700px) {
  #imagesvokasi {
    width:330px;
  }
  
  #imgc1 {
    height:300px;
  }
  
  #imgc2 {
    height:300px;
  }
}
</style>

<body>

  <!--==========================
  Header
  ============================-->
  <header id="header" >
    <div class="container">
      <div class="logo float-left">
        <a href="<?php echo base_url(); ?>" class="scrollto">
          <img src="<?php echo base_url(); ?>assets/front/images/<?php echo setting('site-logo'); ?>" alt="" width="120px" class="img-fluid">
        </a>
      </div>
      <nav class="main-nav float-right">
        <ul>
          <li>
            &nbsp;
            <?php if (candidateSession()) { ?>
              <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>account"
                title="<?php echo esc_output($this->session->userdata('candidate')['first_name']); ?>">
                PROFIL
              </a>
            <?php } else { ?>
              <a class="btn btn-primary" style="padding:5px;margin:0px" href="#psikotes">Psikotes Online</a>
              <a style="padding:0px;margin:0px" href="<?php echo base_url(); ?>account">| Masuk</a>
              
            <?php } ?>
          </li>
        </ul>
      </nav><!-- .main-nav -->
    </div>
  </header><!-- #header -->
