<!DOCTYPE html>
<html lang="en">

<head>
  <title><?=$page;?></title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="<?php echo esc_output(setting('site-keywords')); ?>" name="keywords">
  <meta content="<?php echo esc_output(setting('site-description')); ?>" name="description">
  <meta property="route" content="<?php echo base_url(); ?>">
  <meta property="token" content="<?php echo esc_output($this->security->get_csrf_hash()); ?>">

  <!-- Favicon -->
  <link href="<?php echo base_url(); ?>assets/front/images/<?php echo setting('site-favicon'); ?>" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700"
    rel="stylesheet">

  <!--baru-->
  <script src="<?php echo base_url(); ?>assets/front-baru/js/4n2NXumNjtg5LPp6VXLlDicTUfA.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front-baru/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front-baru/css/style.css">
  <link href="<?php echo base_url(); ?>assets/front-baru/css/matrialize.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front-baru/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet"
    type="text/css">
  <!--<link href="<?php echo base_url(); ?>assets/front-baru/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">-->

  <!--CSS Awal-->
  <!-- CSS Libraries (For External components/plugins) -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/font-awesome-all.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/dropify.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/jquery-ui.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/bootstrap-social.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/bar-rating-pill.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/plugins/iCheck/square/blue.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/jssor.slider-28.1.0.min.js" rel="stylesheet">

  <!-- Internal Style files -->
  <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/custom-style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/candidatefinder.css" rel="stylesheet">

  <!-- External Style files -->
  <!-- External Style files -->
  <!-- <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

  
  <style>
    div1 {
      display: none;
    }

    #mybox1 {
      display: none
    }

    .containeryu {
      position: relative;
      text-align: center;
      color: black;
    }

    .centered {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    @media only screen and (max-width: 800px) {
      div1 {
        display: inline;
      }

      div0 {
        display: none;
      }

      #mybox {
        display: none;
      }

      #mybox1 {
        display: inline;
      }

      .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        right: 0;
        background-color: #fff;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
      }

      .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 20px;
        color: #007bff;
        display: block;
        transition: 0.3s;
      }

      .sidenav a:hover {
        color: #17a2b8;
        font-weight: bold;
      }

      .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
      }
    }
  </style>
  <style>
    /*jssor slider loading skin spin css*/
    .jssorl-009-spin img {
      animation-name: jssorl-009-spin;
      animation-duration: 1.6s;
      animation-iteration-count: infinite;
      animation-timing-function: linear;
    }

    @keyframes jssorl-009-spin {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(360deg);
      }
    }

    /*jssor slider bullet skin 057 css*/
    .jssorb057 .i {
      position: absolute;
      cursor: pointer;
    }

    .jssorb057 .i .b {
      fill: none;
      stroke: #fff;
      stroke-width: 2000;
      stroke-miterlimit: 10;
      stroke-opacity: 0.4;
    }

    .jssorb057 .i:hover .b {
      stroke-opacity: .7;
    }

    .jssorb057 .iav .b {
      stroke-opacity: 1;
    }

    .jssorb057 .i.idn {
      opacity: .3;
    }

    /*jssor slider arrow skin 073 css*/
    .jssora073 {
      display: block;
      position: absolute;
      cursor: pointer;
    }

    .jssora073 .a {
      fill: #ddd;
      fill-opacity: .7;
      stroke: #000;
      stroke-width: 160;
      stroke-miterlimit: 10;
      stroke-opacity: .7;
    }

    .jssora073:hover {
      opacity: .8;
    }

    .jssora073.jssora073dn {
      opacity: .4;
    }

    .jssora073.jssora073ds {
      opacity: .3;
      pointer-events: none;
    }
  </style>

</head>

<body>

  <!--==========================
  Header
  ============================-->
  <!--<header id="header" >-->
  <!--  <div class="container">-->
  <!--    <div class="logo float-left">-->
  <!--      <a href="?php echo base_url(); ?>" class="scrollto">-->
  <!--        <img src="?php echo base_url(); ?>assets/front/images/<?php echo setting('site-logo'); ?>" alt="" class="img-fluid">-->
  <!--      </a>-->
  <!--    </div>-->
  <!--    <nav class="main-nav float-right">-->
  <!--      <ul>-->
  <!--        <li>-->
  <!--          &nbsp;-->
  <!--          ?php if (candidateSession()) { ?>-->
  <!--            <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>account"-->
  <!--              title="?php echo esc_output($this->session->userdata('candidate')['first_name']); ?>">-->
  <!--              PROFIL-->
  <!--            </a>-->
  <!--          ?php } else { ?>-->
  <!--          <div0>-->
  <!--             <a class="btn btn-primary" style="padding:5px;margin:0px" href="#psikotes">Psikotes Online</a>-->
  <!--            <a style="padding:0px;margin:0px" href="?php echo base_url(); ?>account">| Masuk</a>-->

  <!--          </div0>-->

  <!--          <div1>-->
  <!--              <div2 id="mySidenav" class="sidenav">-->
  <!--                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>-->
  <!--                  <hr>-->
  <!--                  <a class="btn btn-primary" style=" color:white; padding:5px;margin:0px" href="#psikotes">Psikotes Online</a>-->
  <!--            <a style="padding:0px;margin:0px" href="?php echo base_url(); ?>account">| Masuk</a>-->
  <!--                  <hr>-->
  <!--              </div2>-->
  <!--              <span class="btn btn-primary btn-sm" style="font-size:30px;cursor:pointer" onclick="openNav()">&nbsp;&#9776;&nbsp;</span>-->
  <!--          </div1>-->

  <!--          ?php } ?>-->
  <!--        </li>-->
  <!--      </ul>-->
  <!--    </nav><!-- .main-nav -->-->
  <!--  </div>-->
  <!--</header><!-- #header -->-->


  <!--baru-->
  <header class="header">
    
    <div class="top_bar background-color-orange" style="background-color:#D83030;">
      <div class="top_bar_container">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                <ul class="top_bar_contact_list">
                  <li>
                    <i class="fa fa-phone coll" aria-hidden="true"></i>
                    <div class="contact-no"> +62877-5812-3440 </div>
                  </li>
                  <li>
                    <i class="fa fa-envelope coll" aria-hidden="true"></i>
                    <div class="email"><a> support@cybersjob.com</a></div>
                  </li>
                </ul>
                <div class=" ml-auto ">
                  <!--<div class="search_button search"><i class="large material-icons search-icone">search</i></div>-->
                  <!--<div class="hamburger menu_mm  search_button transparent search display"><i class="large material-icons font-color-white  search-icone  menu_mm "></i></div>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    

    <div class="header_container background-color-orange-light" style="background-color:#082c44; ">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="header_content d-flex flex-row align-items-center justify-content-start">
              <div class="logo_container">
                <a href="<?php echo base_url(); ?>">
                  <img src="<?php echo base_url(); ?>assets/front/images/<?php echo setting('site-logo'); ?>"
                    class="logo-text" alt="" height="40px;">
                </a>
              </div>
              <nav class="main_nav_contaner ml-auto">
                <ul class="main_nav">
                  <?php if (candidateSession()) { ?>
                  <li style="text-align:left"><a href="<?php echo base_url(); ?>">Home</a></li>
                  <?php }else{ ?>
                  <li style="text-align:left"><a href="<?php echo base_url(); ?>">Home</a></li>
                  <!--<li style="text-align:left"><a href="https://talenthub.cybers.id">Portal TalentHub</a></li>-->
                  <li style="text-align:left"><a
                      href="<?php echo base_url(); ?>register/<?=encode('mitra');?>">Pendaftaran Mitra </a></li>
                  <li style="text-align:left"><a href="#tutorial">Cara Daftar</a></li>
                  <li style="text-align:left"><a href="<?php echo base_url('');?>vokasi">Magang Vokasi</a></li>
                  <?php }?>
                  

                  <!--<li class="dropdown ">-->
                  <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#">Job-->
                  <!--<span class="caret"></span></a>-->
                  <!--<ul class="dropdown-menu">-->
                  <!--<li><a href="job_category.html">Job List</a></li>-->
                  <!--<li><a href="job_detail.html">Job Detail</a></li>-->
                  <!--</ul>-->
                  <!--</li>-->
                  <div class=" Post-Jobs">
                    <?php if (candidateSession()) { ?>
                    <a class="" href="<?php echo base_url(); ?>account/profile"
                      title="<?php echo esc_output($this->session->userdata('candidate')['first_name']); ?>">
                      PROFIL
                    </a>
                    <?php } else { ?>
                    <a class="" href="<?php echo base_url(); ?>account">Masuk</a>
                    <?php } ?>
                  </div>

                </ul>



                <div class="hamburger menu_mm menu-vertical">
                  <i class="large material-icons font-color-white menu_mm menu-vertical">menu</i>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
      <div class="menu_close_container">
        <div class="menu_close">
          <div></div>
          <div></div>
        </div>
      </div>
      <!--<div class="search">-->
      <!--<form action="#" class="header_search_form menu_mm">-->
      <!--<input type="search" class="search_input menu_mm" placeholder="Search" required="required">-->
      <!--<button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">-->
      <!--<i class="fa fa-search menu_mm" aria-hidden="true"></i>-->
      <!--</button>-->
      <!--</form>-->
      <!--</div>-->
      <nav class="menu_nav">
        <ul class="menu_mm">
          <!--<li class="dropdown menu_mm">-->
          <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#">Home-->
          <!--<span class="caret"></span></a>-->
          <!--<ul class="dropdown-menu">-->
          <!--<li><a href="index.html">Home 1</a></li>-->
          <!--<li><a href="index2.html">Home 2</a></li>-->
          <!--</ul>-->
          <!--</li>-->

          <!--<li class="dropdown menu_mm">-->
          <!--<a class="dropdown-toggle menu_mm" data-toggle="dropdown" href="#">Job-->
          <!--<span class="caret"></span></a>-->
          <!--<ul class="dropdown-menu menu_mm">-->
          <!--<li class="menu_mm"><a href="job_category.html">Job List</a></li>-->
          <!--<li class="menu_mm"><a href="job_detail.html">Job Detail</a></li>-->
          <!--</ul>-->
          <!--</li>-->
          <?php if (candidateSession()) { ?>
          <li style="text-align:left"><a href="<?php echo base_url(); ?>">Home</a></li>
          <?php }else{ ?>
          <li style="text-align:left"><a href="<?php echo base_url(); ?>">Home</a></li>
          <!--<li style="text-align:left"><a href="https://talenthub.cybers.id">Portal TalentHub</a></li>-->
          <li style="text-align:left"><a href="<?php echo base_url(); ?>register/<?=encode('mitra');?>">Pendaftaran
              Mitra </a></li>
          <li style="text-align:left"><a href="#tutorial">Cara Daftar</a></li>
          <li style="text-align:left"><a href="<?php echo base_url('');?>vokasi">Magang Vokasi</a></li>
          <?php }?>
          <li style="text-align:left">
            <?php if (candidateSession()) { ?>
            <a class="" href="<?php echo base_url(); ?>account/profile"
              title="<?php echo esc_output($this->session->userdata('candidate')['first_name']); ?>">
              Profile
            </a>
            <?php } else { ?>
            <a class="" href="<?php echo base_url(); ?>account">Masuk</a>
            <?php } ?>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>
  <script src="<?php echo base_url(); ?>assets/front/js/jssor.slider-28.1.0.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    window.jssor_1_slider_init = function () {

      var jssor_1_options = {
        $AutoPlay: 1,
        $AutoPlaySteps: 5,
        $SlideDuration: 160,
        $SlideWidth: 200,
        $SlideSpacing: 3,
        $ArrowNavigatorOptions: {
          $Class: $JssorArrowNavigator$,
          $Steps: 5
        },
        $BulletNavigatorOptions: {
          $Class: $JssorBulletNavigator$,
          $SpacingX: 16,
          $SpacingY: 16
        }
      };

      var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

      /*#region responsive code begin*/

      var MAX_WIDTH = 980;

      function ScaleSlider() {
        var containerElement = jssor_1_slider.$Elmt.parentNode;
        var containerWidth = containerElement.clientWidth;

        if (containerWidth) {

          var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

          jssor_1_slider.$ScaleWidth(expectedWidth);
        } else {
          window.setTimeout(ScaleSlider, 30);
        }
      }

      ScaleSlider();

      $Jssor$.$AddEvent(window, "load", ScaleSlider);
      $Jssor$.$AddEvent(window, "resize", ScaleSlider);
      $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
      /*#endregion responsive code end*/
    };
  </script>