
<?php if ($candidates) { ?>
<?php foreach ($candidates as $candidate) { ?>
<?php 
$imgs = '';
if($candidate['image'])
{
    $imgs = 'https://smk.cybersjob.com/assets/images/candidates/'.$candidate['image']; 
}
else
{
    $imgs = 'https://smk.cybersjob.com/assets/images/not-found.png';
}
?>
<div class="job-board-candidate-wrap">
  <div class="col-md-4 job-board-candidate-profile">
    <div class="row">
      <div class="col-md-4 job-board-candidate-left">
        <input type="checkbox" class="minimal job-board-candidate-select"
          data-id="<?php echo esc_output($candidate['candidate_id']); ?>"
          data-resume_id="<?php echo esc_output($candidate['resume_id']); ?>">
        <?php if ($candidate['image']) { ?>
        <img src="<?php echo base_url(); ?>assets/images/candidates/<?php echo esc_output($candidate['image']); ?>"
            onerror="this.src='<?php echo base_url(); ?>assets/images/candidates/not-found.png'"
            style="border-radius:50%;width:100px;height:100px;border:1px solid black">
        <?php } else { ?>
        <img src="<?php echo base_url(); ?>assets/images/candidates/not-found.png"
            class="job-board-candidate-avatar"> 
        <?php } ?>
      </div>
      <div class="col-md-7 job-board-candidate-right">
        <h2 class="job-board-candidate-name "
          title="<?php echo esc_output($candidate['first_name'].' '.$candidate['last_name']); ?>">
            <a style="font-size:15px" href="<?=base_url('detail-siswa/'.encode($candidate['candidate_id']))?>" >
          <?php echo trimString($candidate['first_name'].' '.$candidate['last_name'], 13); ?>
          </a>
        </h2>
        <!-- <p class="job-board-candidate-profile-item"><?php echo trimString($candidate['designation'], 30); ?></p> -->
        <p class="job-board-candidate-profile-item"><?php echo lang('applied_on'); ?> : <?php echo dateFormat($candidate['created_at']); ?></p>
        
        <!--<br>-->
        <!--<p class="job-board-candidate-quiz-heading">-->
       - Tes Esai :<?php echo $candidate['interviews_result']; ?>%
    <!--</p>-->
     
    <!--<ul class="job-board-candidate-item-list">-->
         <?php if ($candidate['interviews']) { ?>
        <li style="border:3px solid black">
            Rating Esai : 
            <?php 
             
            if($candidate['interviews_result'] != 0 ){ 
            if($candidate['interviews_result'] <= 35){
                echo '<span class="fas fa-star" style="color:orange"></span> 1';
            }else if($candidate['interviews_result'] > 35 && $candidate['interviews_result'] <= 60){
                echo '<span class="fas fa-star" style="color:orange"></span> 2';
            }else if($candidate['interviews_result'] > 60 && $candidate['interviews_result'] <= 75){
                echo '<span class="fas fa-star" style="color:orange"></span> 3';
            }else if($candidate['interviews_result'] > 75 && $candidate['interviews_result'] <= 85){
                echo '<span class="fas fa-star" style="color:orange"></span> 4';
            }else if($candidate['interviews_result'] > 85 && $candidate['interviews_result'] <= 100){
                echo '<span class="fas fa-star" style="color:orange"></span> 5';
            }
            }else{
                echo '<span class="fas fa-star" style="color:orange"></span> 0';
            }
            ?>
        </li>
        <?php } ?>
      <?php if ($candidate['interviews']) { ?>
      <?php } else { ?>
      <li><?php echo lang('not_assigned'); ?></li>
      <?php } ?>
    <!--</ul>-->
        <?php if ($candidate['status_tes_psi'] > 0) { ?>
        <a href="#" data-job_app_id="<?=$candidate['job_app_id']?>" class="modal_detail_kandidat">
            <b class="btn btn-xs btn-danger">Kelola Psikogram</b>
        </a>
        <a target="_blank" class="btn btn-primary btn-xs" href="<?= "http://psikotest.cybersjob.com/psi/adm/psikogram_bakatminat.php?id=".$candidate['kode_aktivasi']."&login=admincybers" ?>"></span> Get Hasil Tes </a>
       
         <?php } ?>
            <br>
            <br>
    
      </div>
    </div>
  </div>
  
  <div class="col-md-2 job-board-candidate-quiz">
    <p class="job-board-candidate-quiz-heading">
      <i class="fa fa-list"></i> Kompetensi :<?php echo $candidate['quizes_result']; ?>%
    </p>
     
    <ul class="job-board-candidate-item-list">
         <?php if ($candidate['quizes']) { ?>
        <li style="border:3px solid black">
            Rating Tes : 
            <?php 
             
            if($candidate['quizes_result'] != 0 ){ 
            if($candidate['quizes_result'] <= 35){
                echo '<span class="fas fa-star" style="color:orange"></span> 1';
            }else if($candidate['quizes_result'] > 35 && $candidate['quizes_result'] <= 60){
                echo '<span class="fas fa-star" style="color:orange"></span> 2';
            }else if($candidate['quizes_result'] > 60 && $candidate['quizes_result'] <= 75){
                echo '<span class="fas fa-star" style="color:orange"></span> 3';
            }else if($candidate['quizes_result'] > 75 && $candidate['quizes_result'] <= 85){
                echo '<span class="fas fa-star" style="color:orange"></span> 4';
            }else if($candidate['quizes_result'] > 85 && $candidate['quizes_result'] <= 100){
                echo '<span class="fas fa-star" style="color:orange"></span> 5';
            }
            }else{
                echo '<span class="fas fa-star" style="color:orange"></span> 0';
            }
            ?>
        </li>
        <?php } ?>
      <?php if ($candidate['quizes']) { ?>
      <?php foreach ($candidate['quizes'] as $quiz) { ?>
      <li title="<?php echo esc_output($quiz['title']); ?>">
        <i class="far fa-trash-alt text-red delete-candidate-quiz" data-id="<?php echo esc_output($quiz['id']); ?>" title="Delete quiz"></i>
      <?php echo trimString(esc_output($quiz['title'], 'html'), 15); ?>
      <br />
      (<?php echo $quiz['corrects']; ?>/<?php echo $quiz['questions']; ?> -
      <?php echo $quiz['corrects'] != 0 ? round(($quiz['corrects']/$quiz['questions'])*100) : 0; ?>%)
      </li>
      <?php } ?>
     
      <?php } else { ?>
      <li><?php echo lang('not_assigned'); ?></li>
      <?php } ?>
    </ul>
  </div>
  
  <!--<div class="col-md-2 job-board-candidate-quiz">-->
    
  <!--</div>-->
  
  <div class="col-md-2 job-board-candidate-interview">
    <p class="job-board-candidate-interview-heading">
      <i class="fas fa-clipboard-list"></i> Tes Psikologi 
    </p>
    <ul class="job-board-candidate-item-list">
       <li>Kode Aktivasi : </li>
       <?php if($candidate['kode_aktivasi'] != ""){ ?>
       <li><?=$candidate['kode_aktivasi'];?></li>
       <?php }else{ ?>
        <li style="text-align:center">----</li>
       <?php }?>
      <?php 
       
     
                 
      if ($candidate['status_tes_psi'] > 0) { ?>
        <li>Hasil Tes Psikologi </li>
        <li style="border:3px solid black">Rating Tes : <span class="fas fa-star" style="color:orange"></span> <?=$candidate['status_tes'];?> </li>
      
      <?php } else { ?>
      <li>Belum Terdapat Hasil</li>
      <?php } ?>
    </ul>
  </div>
  <div class="col-md-2 job-board-candidate-self">
    <p class="job-board-candidate-self-heading">
      <i class="fas fa-star-half-alt"></i> Rating Kandidat
    </p>
    <ul class="job-board-candidate-item-list">
        <li>Kompetensi : 
            <?php 
             
            if($candidate['quizes_result'] != 0 ){ 
            if($candidate['quizes_result'] <= 35){
                echo '<span class="fas fa-star" style="color:orange"></span> 1';
            }else if($candidate['quizes_result'] > 35 && $candidate['quizes_result'] <= 60){
                echo '<span class="fas fa-star" style="color:orange"></span> 2';
            }else if($candidate['quizes_result'] > 60 && $candidate['quizes_result'] <= 75){
                echo '<span class="fas fa-star" style="color:orange"></span> 3';
            }else if($candidate['quizes_result'] > 75 && $candidate['quizes_result'] <= 85){
                echo '<span class="fas fa-star" style="color:orange"></span> 4';
            }else if($candidate['quizes_result'] > 85 && $candidate['quizes_result'] <= 100){
                echo '<span class="fas fa-star" style="color:orange"></span> 5';
            }
            }else{
                echo '<span class="fas fa-star" style="color:orange"></span> 0';
            }
            ?>
        </li>
        
        <li>Tes Esai : 
            <?php 
             
            if($candidate['interviews_result'] != 0 ){ 
            if($candidate['interviews_result'] <= 35){
                echo '<span class="fas fa-star" style="color:orange"></span> 1';
            }else if($candidate['interviews_result'] > 35 && $candidate['interviews_result'] <= 60){
                echo '<span class="fas fa-star" style="color:orange"></span> 2';
            }else if($candidate['interviews_result'] > 60 && $candidate['interviews_result'] <= 75){
                echo '<span class="fas fa-star" style="color:orange"></span> 3';
            }else if($candidate['interviews_result'] > 75 && $candidate['interviews_result'] <= 85){
                echo '<span class="fas fa-star" style="color:orange"></span> 4';
            }else if($candidate['interviews_result'] > 85 && $candidate['interviews_result'] <= 100){
                echo '<span class="fas fa-star" style="color:orange"></span> 5';
            }
            }else{
                echo '<span class="fas fa-star" style="color:orange"></span> 0';
            }
            ?>
        </li>
        
        <li>Tes Psikologi : <span class="fas fa-star" style="color:orange"></span> <?=$candidate['status_tes'];?></li>
      
        <li style="border:3px solid black">Rata - rata : 
        
        <?php
        $val = 0;
         if ($candidate['quizes']) {
        if($candidate['quizes_result'] != 0 ){ 
            
            if($candidate['quizes_result'] > 0 && $candidate['quizes_result'] <= 35){
                $val = 1;
            }else if($candidate['quizes_result'] > 35 && $candidate['quizes_result'] <= 60){
                $val = 2;
            }else if($candidate['quizes_result'] > 60 && $candidate['quizes_result'] <= 75){
                $val = 3;
            }else if($candidate['quizes_result'] > 75 && $candidate['quizes_result'] <= 85){
                $val = 4;
            }else if($candidate['quizes_result'] > 85 && $candidate['quizes_result'] <= 100){
                $val = 5;
            }
            
            }else{
                $val = 0;
            }
         }else{
             $val = 0;
         }
         
         if ($candidate['interviews']) {
    if($candidate['interviews_result'] != 0 ){ 
    if($candidate['interviews_result'] > 0 && $candidate['interviews_result'] <= 35){
    $vals = 1;
    }else if($candidate['interviews_result'] > 35 && $candidate['interviews_result'] <= 60){
    $vals = 2;
    }else if($candidate['interviews_result'] > 60 && $candidate['interviews_result'] <= 75){
    $vals = 3;
    }else if($candidate['interviews_result'] > 75 && $candidate['interviews_result'] <= 85){
    $vals = 4;
    }else if($candidate['interviews_result'] > 85 && $candidate['interviews_result'] <= 100){
    $vals = 5;
    }
    
    }else{
    $vals = 0;
    }
    }else{
    $vals = 0;
        
    }
            echo '<span class="fas fa-star" style="color:orange"></span>&nbsp;'.round(($val+$vals+$candidate['status_tes'])/2);
          
            ?>
            
        </li>
    </ul>
  </div>
  <div class="col-md-2 job-board-candidate-overall">
    <p class="job-board-candidate-overall-heading"><?php echo lang('overall_result'); ?></p>
    <p class="job-board-candidate-overall-result">
    <strong>
    <?php
    if($candidate['rating'] == 0 ){
    $val = 0;
    if ($candidate['quizes']) {
    if($candidate['quizes_result'] != 0 ){ 
    if($candidate['quizes_result'] > 0 && $candidate['quizes_result'] <= 35){
    $val = 1;
    }else if($candidate['quizes_result'] > 35 && $candidate['quizes_result'] <= 60){
    $val = 2;
    }else if($candidate['quizes_result'] > 60 && $candidate['quizes_result'] <= 75){
    $val = 3;
    }else if($candidate['quizes_result'] > 75 && $candidate['quizes_result'] <= 85){
    $val = 4;
    }else if($candidate['quizes_result'] > 85 && $candidate['quizes_result'] <= 100){
    $val = 5;
    }
    
    }else{
    $val = 0;
    }
    }else{
    $val = 0;
    }
    
    if ($candidate['interviews']) {
    if($candidate['interviews_result'] != 0 ){ 
    if($candidate['interviews_result'] > 0 && $candidate['interviews_result'] <= 35){
    $vals = 1;
    }else if($candidate['interviews_result'] > 35 && $candidate['interviews_result'] <= 60){
    $vals = 2;
    }else if($candidate['interviews_result'] > 60 && $candidate['interviews_result'] <= 75){
    $vals = 3;
    }else if($candidate['interviews_result'] > 75 && $candidate['interviews_result'] <= 85){
    $vals = 4;
    }else if($candidate['interviews_result'] > 85 && $candidate['interviews_result'] <= 100){
    $vals = 5;
    }
    
    }else{
    $vals = 0;
    }
    }else{
    $vals = 0;
        
    }
            
    echo '<span class="fas fa-star" style="color:orange"></span>'.round(($val+$vals+$candidate['status_tes'])/2);
    }else{
    echo '<span class="fas fa-star" style="color:orange"></span>'.$candidate['rating'];   
    }
    ?>
     </strong>
    <!--?php if( $candidate['status'] != 'INTERVIEW TAHAP 2'){?>-->
    <!--  <br /><span class="job-board-candidate-status job-board-candidate-<?php echo $candidate['status']; ?>"><?php echo strtoupper($candidate['status']); ?></span>-->
    <!--  ?php }else{ ?>-->
    <!--  <br /><span class="job-board-candidate-status job-board-candidate-<?php echo 'interviewed'; ?>"><?php echo strtoupper('Diinterview'); ?></span>-->
    <!--  ?php } ?>-->
      <?php if($candidate['rating'] == 0){?>
      <br /><span class="btn btn-danger btn-xs">Belum Diverifikasi</span><br><u><a style="font-size:15px" href="#" class="rating" data-job_idsz="<?=$candidate['job_application_id'];?>">|Verifikasi|</a></u>
      
      <?php }else{ ?>
      <br /><span class="btn btn-info btn-xs">Sudah Diverifikasi</span><br><u>
          <a href="javascript:;" data-rating="<?=$candidate['rating'];?>" data-detail="<?=$candidate['detail'];?>" data-toggle="modal" data-target="#modal_tambah_hasil" style="font-size:15px" href="#" >|Lihat Detail|</a></u>
     
      <?php } ?>
      <br>
      <?php if($candidate['narasi_psiko'] != ''){?>
        <a class="btn btn-xs btn-success"  href="<?=base_url()?>psikogram/<?=encode($candidate['job_application_id'])?>">File Psikogram</a>
      <?php }?>
    </p>
  </div>
</div>
<?php } ?>
<?php } else { ?>
<div class="job-board-candidate-wrap">
  <p class="job-board-candidate-wrap-not"><?php echo lang('no_candidates_found'); ?></p>
</div>
<?php } ?>

<div class="modal fade" id="modal_tambah_hasil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Rating Kandidat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodymodal_tambah_hasil">
        <div style="text-align:center">
        <label style="font-size:25px">Rating Terverifikasi : </label>
       <br>
       
        <br>
        <div id="view_rating">
            
        </div>
        
        </div>
        <br>
        <br>
        <label style="font-size:20px">Detail Catatan : </label>
        <p id="detail"></p>
        
        <br>
        <br>
        
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_detail_kandidats" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><b>Detail Nilai Psikogram</b></h3>
       
      </div>
      <div class="modal-body" id="">
        <?php echo form_open_multipart(base_url('admin/kelola_psikogram')); ?>
       <div class="hasil">
           
       </div>
       <input type="submit" class="btn btn-success" value="SIMPAN DATA"> 
      <?php echo form_close(); ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>

var base_url = '<?=base_url()?>';
$(document).ready(function() {
    
  // Untuk sunting
  $('#modal_tambah_hasil').on('show.bs.modal', function (event) {
    var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
    var modal = $(this);

    // Isi nilai pada field
    modal.find('#rating').attr("value",div.data('rating'));
    modal.find('#detail').html(div.data('detail'));
    
    var getDetail = div.data('rating');
    
    if(getDetail === 1){
        loop_ = 1;
    }else if(getDetail === 2){
        loop_ = 2;
    }else if(getDetail === 3){
        loop_ = 3;
    }else if(getDetail === 4){
        loop_ = 4;
    }else if(getDetail === 5){
        loop_ = 5;
    }
    
    var html = '';
    
     for(i=0; i<loop_; i++){
          html += '<span class="fas fa-star" style="color:orange;font-size:25px"></span>';
        }
        $('#view_rating').html(html);
    
  });
});

$(document).ready(function() {
  $(".modal_detail_kandidat").on("click", function () {
	const id = $(this).attr("data-job_app_id");
// 	alert(id);
    $.ajax({
      url : base_url + 'admin/detail_psikogram',
      method : "GET",
      data : {id: id},
    //   async : true,
      dataType : 'json',
      success: function(data){
		$("#modal_detail_kandidats").modal("show");
        $('.hasil').empty();
        $.each(data.data_psiko, function(key, value) {
        $('.hasil').append(`<input type="hidden" value="`+value.id+`" name="id[]"><input type="hidden" value="`+value.job_application_id+`" name="job_app_id"><label>`+value.pola+`</label> 
        <br> <b> Nilai : <input name="nilai[]" type="number" value="`+value.nilai+`" ></b>
         | Grey Scale : <b>`+value.grey+`</b><br>
         <hr>`);
        });
         $('.hasil').append(`<br> <label>Rating Psikotes : <b style="color:red">* 1- 5</b></label><br> <input name="rating" class="form-control" type="number" min="1" max="5" r
         equired value="`+data.data_rating['status_tes']+`">`);
         $('.hasil').append(`<br> <label>Deskripsi Hasil : </label><br> <textarea class="form-control" style="height:100px" name="deskripsi">`+data.data_rating['narasi_psiko']+`</textarea> <br>`);
      }
    });
  return false;
	});
});

// });


</script>
