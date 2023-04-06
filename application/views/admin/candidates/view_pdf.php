<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-graduation-cap"></i> View PDF<small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-graduation-cap"></i> View PDF</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-md-12">
                <div class="datatable-top-controls datatable-top-controls-filter">
                  <div class="btn-group">
                    
                  </div>
                </div>
                
               
              </div>
            </div>
           

          </div>
          <!-- /.box-header -->
          <div class="box-body">
           <?php 
if (!empty($pdf)){
?>
<input type="text" value="<?=$id;?>" id="id" hidden="1">
<input type="text" value="<?=encode($id);?>" id="id_link" hidden="1">
<input type="text" value="<?=$link;?>" id="link" hidden="1">
    <div class="col-md-12">
        <div class="panel panel-primary">
                <div class="panel-body" style="margin:20px">
                    <br>
                    <?php 
                    if($status != 'applied'){
                    ?>
                    <button style="margin-left:100px" class="btn btn-success"><span><input type="checkbox" checked="1" disabled="1"></span> CV Telah Discreening</button>
                    <?php }else{ ?>
                    <button style="margin-left:100px" id="status_aktif" class="btn btn-primary">Tandai Sudah Screening</button>
                    <?php } ?>
                    <br>
                    <br>
                    <div style="text-align:center">
                        <embed style="display:inline-block" src="https://test.cybersjob.com/assets/images/candidates/<?=$pdf;?>" type="application/pdf" width="80%" height="900px"/>
                    </div>
                </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="col-md-12">
        <div class="panel panel-primary">
                <div class="panel-body" style="text-align:center;margin:20px">
                    <br>
                    <b class="btn btn-danger">Opps File Tidak Ditemukan !!</b>
                    <br>
                    <br>
                    <br>
                    <div >
                        <img style="display:inline-block" src="https://4.bp.blogspot.com/-uZCEUiu3PxE/WWCoSWUe9hI/AAAAAAAADBo/cRVGbfdfKUkR7PmpuONaykscNvnWORoUQCLcBGAs/s640/webdesign-404.gif"  width="600px" height="500px"/>
                    </div>
                </div>
        </div>
    </div>
    <?php } ?>
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
<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>
<!-- page script -->
 <script>
   $(document).ready(function(){
    $('#status_aktif').click(function(){
    var id=$('#id').val();
    var id_link=$('#id_link').val();
    var url=$('#link').val();
    $.ajax({
      url : url,
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
       window.location.reload(); 
       
       }
    });
    return false;
     });
    });
  </script>

</body>
</html>
