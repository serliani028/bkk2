<style>


h1 {
  text-align: center;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}
select.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* button {
background-color: #4CAF50;
color: #ffffff;
border: none;
padding: 10px 20px;
font-size: 17px;
font-family: Raleway;
cursor: pointer;
} */

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<main id="main" style="margin-top:200px; margin-bottom:50px;">

  <!--==========================
  Account Area Setion
  ============================-->
 

<section class="main-container">
    <div class="container">
      <div class="row mt-10">
        <div class="col-lg-2">
        </div>
        <div class="col-md-8 col-lg-8 col-sm-12">
          <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="account-box">
                <p class="account-box-heading">
                  <span class="account-box-heading-text">PENDAFTARAN MITRA TALENTHUB</span>
                  <span class="account-box-heading-line"></span>
                </p>
                <div class="container">
                  <?php include('partials/messages.php'); ?>
                  <?php echo form_open_multipart($action); ?>
                 
                 <div class="tab">
                    <div class="row">
                      
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Nama Sekolah/Kampus <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <input type="text" name="nama" class="form-control cek" placeholder="Nama Depan"
                            aria-label="First Name" aria-describedby="basic-addon1" required="1">
                            
                          </div>
                          <small id="" class="form-text text-muted">Nama Sekolah/Kampus.</small>
                        </div>
                      </div>
                      
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Nomor Telepon <small style="color:red">* </small></label>
                          <div class="input-group mb-3">
                            <input type="text" name="no_telp"  class="form-control cek" placeholder="Nomor Telepon"
                            aria-label="Nomor Telepon" aria-describedby="basic-addon1" required="1">
                          
                          </div>
                          <small id="" class="form-text text-muted">Masukkan Nomor Telepon.</small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Email <small style="color:red">*</small></label>
                          <div class="input-group mb-3"> 
                            <input type="email" name="email" class="form-control cek" placeholder="Email"
                            aria-label="Email" aria-describedby="basic-addon1" required="1">
                           
                          </div>
                          <small id="" class="form-text text-muted">Masukkan Email.</small>
                        </div>
                      </div>
                       <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">NPSN / Kode PTS/PTN <small style="color:red">*</small></label>
                          <div class="input-group mb-3"> 
                            <input type="text" name="npsn" class="form-control cek" placeholder="NPSN / Kode PTS/PTN"
                            aria-label="Email" aria-describedby="basic-addon1" required="1">
                           
                          </div>
                          <small id="" class="form-text text-muted">Masukkan NPSN / Kode PTS/PTN.</small>
                        </div>
                      </div>
                       <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Status Sekolah/Kampus <small style="color:red">*</small></label>
                          <div class="input-group mb-3"> 
                            <select name="status_sekolah" class="form-control cek"  required="1">
                                    <option value="">Pilih Status Sekolah/Kampus</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Negri">Negri</option>
                            </select>
                          </div>
                          <small id="" class="form-text text-muted">Masukkan Status Sekolah/Kampus.</small>
                        </div>
                      </div>
                      
                       <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Mendaftar Sebagai Mitra <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <select name="status_mitra" class="form-control cek"  required="1">
                                    <option value="">Pilih Status Mitra</option>
                                    <option value="vokasi">Vokasi SMA/SMK</option>
                                    <option value="kampus">Kampus Merdeka</option>
                            </select>
                           
                         
                           
                           </div>
                          <small id="" class="form-text text-muted">Pilih Status Mitra.</small>
                        </div>
                      </div>
                     
                    </div>
                    
                  </div>
                  <div class="tab">
                    <div class="row">
                    
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Provinsi <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <select class="form-control cek" name="provinsi" id="prov_regist" required="1">
                            <option value="">Pilih Provinsi</option>
                            <?php foreach ($provinsi as $baris) { ?>
                            <option value="<?=$baris->id_prov;?>"><?=$baris->nama;?></option>
                            <?php } ?>
                            </select>
                           
                          </div>
                          <small id="" class="form-text text-muted">Pilih Provinsi</small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Kabupaten / Kota <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <select name="city" class="form-control cek" required="1" id="kab_regist">
                                    <option value="">Pilih Kabupaten/Kota</option>
                           </select>
                          
                          </div>
                          <small id="" class="form-text text-muted">Pilih Kabupaten / Kota</small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Kecamatan <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <select name="state" class="form-control cek" id="kec_regist" required="1">
                                        <option value="">Pilih Kecamatan</option>
                            </select>
                           
                          </div>
                          <small id="" class="form-text text-muted">Pilih Kecamatan</small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for="">Kelurahan <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <select name="kelurahan" class="form-control cek" id="kel_regist" required="1"  >
                                        <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                           
                          </div>
                          <small id="" class="form-text text-muted">Pilih Kelurahan</small>
                        </div>
                      </div>
                       <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for="">Alamat Lengkap <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                            <input type="text" name="address" class="form-control cek" placeholder="Alamat Lengkap"
                            aria-label="Alamat Lengkap" aria-describedby="basic-addon1" required="1">
                           
                          </div>
                          <small id="" class="form-text text-muted">Masukkan Alamat Lengkap.</small>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  
                  <div class="tab">
                    <div class="row">
                     
                       <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                            <label for="nama">Password <small style="color:red">*(min 8 Karakter)</small></label>
                            <input type="password" name="password" class="form-control" required="1"  />
                            <small id="" class="form-text text-muted">Password (min 8 Karakter)</small>
						 </div>
                      </div><div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                            <label for="nama">Re-Password </label>
                            <input type="password" name="repassword" class="form-control" required="1" />
                            <small id="" class="form-text text-muted">Re-Password</small>
						 </div>
                    
                    </div>
                  </div>
                  </div>
                
                
                  <div style="overflow:auto;">
                    <div style="float:right;">
                      <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Kembali</button>
                      <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Lanjut</button>
                      <input type="submit" class="btn btn-success" id="submit" value="Selesai" style="display:none">
                    </div>
                  </div>
                  <!-- Circles which indicates the steps of the form: -->
                  <div style="text-align:center;margin-top:10px;margin-bottom:10px">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <!--<span class="step"></span>-->
                  </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0 ) {
    document.getElementById("nextBtn").style.display = 'inline';
    document.getElementById("submit").style.display = 'none';
    document.getElementById("prevBtn").style.display = "none";
    } else if (n > 0) {
    document.getElementById("nextBtn").style.display = 'inline';
    document.getElementById("submit").style.display = 'none';
    document.getElementById("prevBtn").style.display = "inline";
    }else{
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").style.display = 'none';
    document.getElementById("submit").style.display = 'inline';
  } else {
    document.getElementById("nextBtn").innerHTML = "Lanjut";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByClassName("cek");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
<?php include(VIEW_ROOT.'/front/layout/footer.php'); ?>
<script>
$(document).ready(function(){

  $('#prov_regist').change(function(){
    var id=$(this).val();
    var url='https://magang.cybersjob.com/candidates/cek_kab'
    $.ajax({
      url : url,
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value='+data[i].id_kab+'>'+data[i].nama+'</option>';
        }
        $('#kab_regist').html(html);

      }
    });
    return false;
  });

});
$(document).ready(function(){

  $('#kab_regist').change(function(){
    var id=$(this).val();
    var url='https://magang.cybersjob.com/candidates/cek_kec';
    $.ajax({
      url : url,
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value='+data[i].id_kec+'>'+data[i].nama+'</option>';
        }
        $('#kec_regist').html(html);

      }
    });
    return false;
  });

});
$(document).ready(function(){

  $('#kec_regist').change(function(){
    var id=$(this).val();
    var url='https://magang.cybersjob.com/candidates/cek_kel';
    $.ajax({
      url : url,
      method : "GET",
      data : {id: id},
      async : true,
      dataType : 'json',
      success: function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value='+data[i].id_kel+'>'+data[i].nama+'</option>';
        }
        $('#kel_regist').html(html);

      }
    });
    return false;
  });

});


</script>
