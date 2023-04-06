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
<main id="main" style="margin-top:180px; margin-buttom:80px;" >

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
          <div class="col-md-12 col-lg-9 col-sm-12">
          <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="account-box">
                <p class="account-box-heading">
                  <span class="account-box-heading-text">Tes Esai : <?=$tes_esai?></span>
                  <span class="account-box-heading-line"></span>
                </p>
                <div class="container">
                  <?php include('partials/messages.php'); ?>
                  <?php echo form_open_multipart($action); ?>
                   <input type="hidden" name="candidate_interview_id" value="<?php echo $candidate_interview_id; ?>" />
               <div class="tab">
                    <div class="row">
                      <div class="col-12">
                        <?php $no = 1; foreach ($esai as $key): ?>
                        
                        <div class="form-group form-group-account">
                          <label for=""><?=$no++.'.&nbsp;'.$key['title']?> <small style="color:red">*</small></label>
                          <div class="input-group mb-3">
                          <input type="text" name="comments[]" class="form-control" placeholder="Silahkan isi jawaban Anda" aria-label="First Name" aria-describedby="basic-addon1" required="1">
                          </div>
                        </div>
                        
                        <?php endforeach; ?>
                      </div>
                      </div>
                      </div>
                      
                     
                  <div style="overflow:auto;">
                    <div style="float:right;">
                      <!--<button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Kembali</button>-->
                      <!--<button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Lanjut</button>-->
                      <input type="submit" class="btn btn-success" id="submit" value="Simpan & Selesai" >
                      <br>
                      <br>
                    </div>
                  </div>
                  <!-- Circles which indicates the steps of the form: -->
                  
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

