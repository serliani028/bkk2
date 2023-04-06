<html>
<head>
 <link href="<?php echo base_url(); ?>assets/front/images/<?php echo setting('site-favicon'); ?>" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  
  <!--baru-->
  <script src="<?php echo base_url(); ?>assets/front-baru/js/4n2NXumNjtg5LPp6VXLlDicTUfA.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front-baru/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front-baru/css/style.css">
  <link href="<?php echo base_url(); ?>assets/front-baru/css/matrialize.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front-baru/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
<style>
p, h2, h3 {padding:0px; margin: 0px;}
</style>
  </head>
<?php if ($resume) { ?>
  <body>
  <table>
    <tr>
      <td width="30%" style="vertical-align:top">   
      <img src="<?php echo candidateThumb2($resume->image); ?>" height="160" width="150" />
        <hr>
         <small>
             <i class="fas fa-email"></i>
          <?php 
            echo $resume->email ? $resume->email : '';
            echo $resume->phone1 ? '<br> '.$resume->phone1 : '';
            echo  $resume->address ? '<br>'.$resume->address : '';
            echo  $resume->dob ? '<br>'.tgl_indo($resume->dob) : '';
           ?>
        </small>
        <hr>
         <small>
          <?php 
            echo $medsos->ig != '' && $medsos->ig != '-' ? '<b>ig : </b>'.$medsos->ig : '';
            echo $medsos->twitter != '' && $medsos->twitter != '-' ? '<br><b>twitter : </b>'.$medsos->twitter : '';
            echo $medsos->linkedln != '' && $medsos->linkedln != '-' ? '<br><b>linkedln : </b>'.$medsos->linkedln : '';
            echo $medsos->yt != '' && $medsos->yt != '-' ? '<br> <b>youtube : </b>'.$medsos->yt : '';
            echo $medsos->fb != '' && $medsos->fb != '-' ? '<br> <b>facebook : </b> '.$medsos->fb : '';
            echo $medsos->tiktok != '' && $medsos->tiktok != '-' ? '<br> <b>tiktok : </b>'.$medsos->tiktok : '';
           ?>
        </small>
      </td>
      <td width="70%" style="padding-left:30px">
      <h2><?php echo esc_output($resume->first_name, 'html'); ?></h2>
          <br>
      <h2>Tentang Saya </h2>
      <ul>
      <li><p><?=$resume->tentang;?></p></li>
      </ul>
      <br>
      <?php if($pengalaman){?>
      <div>
            <h2>Pengalaman</h2>
          <ul>
          <?php foreach ($pengalaman as $value) { ?>
            <li>
            <h3><?=$value->title;?></h3>
            <p><?=$value->description;?></p>
            <br>
            
            </li>
          <?php } ?>
          </ul>
    </div>
          <?php } ?>
       
        <?php if ($skill) { ?>
        <h2>Skill / Kemampuan</h2>
        <div>
          <ul>
          <?php foreach ($skill as $value) { ?>
            <li>
            <h3><?php echo $value->jenis; ?></h3>
            <p><?php echo $value->title; ?></p>
          
            </li>
          <?php } ?>
          </ul>
        </div>
        <?php } ?>
      </td>
    </tr>
    
    <!--<tr style="valign-text:top">-->
    <!--  <td colspan="2">-->
     
    <!--  <br>-->
    <!--  </td>-->
    <!--</tr>-->
   
       
        </table>
</body>
<?php } ?>
<!--<footer>-->
  
<!--</footer>-->
<script data-cfasync="false" src="<?php echo base_url(); ?>assets/front-baru/js/email-decode.min.js"></script><script src="<?php echo base_url(); ?>assets/front-baru/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front-baru/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front-baru/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front-baru/js/jquery-ui.min.js"></script>

<script src="<?php echo base_url(); ?>assets/front-baru/js/custom.js"></script>
<script>
        $(".search-icone").click(function(){
     // $(".menu").animate({height: "100vh"});
});

    </script>
    
      <!-- JavaScript Libraries (For External components/plugins) -->
  <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/dropify.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/bar-rating.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/plugins/iCheck/iCheck.js"></script>

  <!-- JS Language Variables file -->
  <script src="<?php echo base_url(); ?>assets/front/js/lang.js"></script>

  <!-- Files For Functionalities -->
  <script src="<?php echo base_url(); ?>assets/front/js/app.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/main.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/account.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/general.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/dot_menu.js"></script>
  
  
</html>