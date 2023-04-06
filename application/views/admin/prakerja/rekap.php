<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> Data Rekap Penerimaan <small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> Data Rekap Penerimaan </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" style="overflow-x: auto;">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">


          </div>
          <!-- /.box-header -->
          <div class="box-body">
             <!--<button class="btn btn-primary" data-toggle="modal" href="#modal_userDetail" >Tandai Sudah Di Screening</button><br><br> -->
            
            <table class="table table-bordered table-striped" id="sertifikat" >
              <thead>
                <tr>
                <td rowspan="2" style="text-align: center;background: #db7287;color:white;vertical-align: middle;"><b>NO . </b></td>
                <td rowspan="2" style="text-align: center;background: #f2b8c4;color:black;vertical-align: middle;"><b>STATUS PENERIMAAN </b></td>
                <td colspan="7" style="text-align:center;background: orange;color:white"><b>SUMBER INFORMASI LOWONGAN KERJA</b></td>
                <td rowspan="2" style="background: #fcd9a4;color:black;text-align:center;vertical-align: middle"><b>TOTAL DATA</b></td>
                </tr>
                <tr>
                <td style="background: #d6249f;color:white;text-align:center"><b>Instagram</b></td>
                <td style="background: blue;color:white;text-align:center"><b>Facebook</b></td>
                <td style="background: yellow;color:black;text-align:center"><b>TikTok</b></td>
                <td style="background: #0077b5;color:white;text-align:center"><b>Linkedln</b></td>
                <td style="background: #00a0dc;color:white;text-align:center"><b>Loker Telegram</b></td>
                <td style="background: green;color:white;text-align:center"><b>Media Lain</b></td>
                <td style="background: grey;color:white;text-align:center"><b>Teman / Orang Lain</b></td>
                </tr>
              </thead>
              <tbody style="text-align:center">
                  <tr>
                      <td>
                          1.
                      </td>
                      <td>
                          CV Diterima HRD
                      </td>
                       <td>
                         <?=$cv_diterima['ig'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['fb'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['tiktok'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['linke'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['tele'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['med'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['teman'];?>
                       </td>
                       <td>
                           <?=$cv_diterima['total'];?>
                       </td>
                  </tr>
                  <tr>
                      <td>
                          2.
                      </td>
                      <td>
                          CV Screening HRD
                      </td>
                      <td>
                         <?=$cv_screening['ig'];?>
                       </td>
                       <td>
                           <?=$cv_screening['fb'];?>
                       </td>
                       <td>
                           <?=$cv_screening['tiktok'];?>
                       </td>
                       <td>
                           <?=$cv_screening['linke'];?>
                       </td>
                       <td>
                           <?=$cv_screening['tele'];?>
                       </td>
                       <td>
                           <?=$cv_screening['med'];?>
                       </td>
                       <td>
                           <?=$cv_screening['teman'];?>
                       </td>
                       <td>
                           <?=$cv_screening['total'];?>
                       </td>
                         </tr> 
                    <tr>
                      <td>
                          3.
                      </td>
                      <td>
                         Kandidat Diinterview
                      </td>
                      <td>
                         <?=$diinterview['ig'];?>
                       </td>
                       <td>
                           <?=$diinterview['fb'];?>
                       </td>
                       <td>
                           <?=$diinterview['tiktok'];?>
                       </td>
                       <td>
                           <?=$diinterview['linke'];?>
                       </td>
                       <td>
                           <?=$diinterview['tele'];?>
                       </td>
                       <td>
                           <?=$diinterview['med'];?>
                       </td>
                       <td>
                           <?=$diinterview['teman'];?>
                       </td>
                       <td>
                           <?=$diinterview['total'];?>
                       </td> 
                       </tr> 
                  <!--  <tr>-->
                  <!--    <td>-->
                  <!--        4.-->
                  <!--    </td>-->
                  <!--    <td>-->
                  <!--        Mengikuti Tes Google Form  -->
                  <!--    </td>-->
                  <!--    <td>-->
                  <!--       <?=$form['ig'];?>-->
                  <!--     </td>-->
                  <!--     <td>-->
                  <!--         <?=$form['fb'];?>-->
                  <!--     </td>-->
                  <!--     <td>-->
                  <!--         <?=$form['tiktok'];?>-->
                  <!--     </td>-->
                  <!--     <td>-->
                  <!--         <?=$form['linke'];?>-->
                  <!--     </td>-->
                  <!--     <td>-->
                  <!--         <?=$form['tele'];?>-->
                  <!--     </td>-->
                  <!--     <td>-->
                  <!--         <?=$form['med'];?>-->
                  <!--     </td>-->
                  <!--     <td>-->
                  <!--         <?=$form['teman'];?>-->
                  <!--     </td>-->
                  <!--     <td>-->
                  <!--         <?=$form['total'];?>-->
                  <!--     </td>-->
                  <!--</tr> -->
                  <tr>
                      <td>
                          4.
                      </td>
                      <td>
                          Kandidat Dipekerjakan 
                      </td>
                      <td>
                         <?=$bekerja['ig'];?>
                       </td>
                       <td>
                           <?=$bekerja['fb'];?>
                       </td>
                       <td>
                           <?=$bekerja['tiktok'];?>
                       </td>
                       <td>
                           <?=$bekerja['linke'];?>
                       </td>
                       <td>
                           <?=$bekerja['tele'];?>
                       </td>
                       <td>
                           <?=$bekerja['med'];?>
                       </td>
                       <td>
                           <?=$bekerja['teman'];?>
                       </td>
                       <td>
                           <?=$bekerja['total'];?>
                       </td>
                  </tr> <tr>
                      <td>
                          5.
                      </td>
                      <td>
                          Kandidat Ditolak 
                      </td>
                      <td>
                         <?=$ditolak['ig'];?>
                       </td>
                       <td>
                           <?=$ditolak['fb'];?>
                       </td>
                       <td>
                           <?=$ditolak['tiktok'];?>
                       </td>
                       <td>
                           <?=$ditolak['linke'];?>
                       </td>
                       <td>
                           <?=$ditolak['tele'];?>
                       </td>
                       <td>
                           <?=$ditolak['med'];?>
                       </td>
                       <td>
                           <?=$ditolak['teman'];?>
                       </td>
                       <td>
                           <?=$ditolak['total'];?>
                       </td>
                  </tr>
              </tbody>
              <tfoot>
                  <tr>
                <td colspan="2" style="background: black;color:white;text-align:center;"><b>TOTAL PRESENTASE</b></td>
                <td style="background: #d6249f;color:white;text-align:center"><b><?=round($ig,1);?> %</b></td>
                <td style="background: blue;color:white;text-align:center"><b><?=round($fb,1);?> %</b></td>
                <td style="background: yellow;color:black;text-align:center"><b><?=round($tiktok,1);?> %</b></td>
                <td style="background: #0077b5;color:white;text-align:center"><b><?=round($linke,1);?> %</b></td>
                <td style="background: #00a0dc;color:white;text-align:center"><b><?=round($tele,1);?> %</b></td>
                <td style="background: green;color:white;text-align:center"><b><?=round($med,1);?> %</b></td>
                <td style="background: grey;color:white;text-align:center"><b><?=round($teman,1);?> %</b></td>
                <td style="background: #fcd9a4;color:black;text-align:center"><b><?=round($total,1);?> %</b></td>
                </tr>
              </tfoot>
            </table>
            
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

<!-- <form id="candidates-form" method="POST" action="<?php echo base_url(); ?>admin/candidates/excel" target='_blank'></form> -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<!-- <script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate.js"></script> -->

</body>
</html>
