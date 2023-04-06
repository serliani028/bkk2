<form id="form_rating" >
<input type="text" name="id" id="jobs_id_rt" hidden="1" required="1">
<div style="text-align:center">
<h2><b>Beri Rating Kandidat</b></h2>
<div class="wrapperz" style="-moz-transform: rotate(180deg);
    -webkit-transform: rotate(180deg);">
  <input type="radio" class="inputz val_rat" value="5" id="r5" name="rg1">
  <label class="labelz" for="r5">&#10038;</label>
  <input type="radio" class="inputz val_rat" value="4" id="r4" name="rg1">
  <label class="labelz" for="r4">&#10038;</label>
  <input type="radio" class="inputz val_rat" value="3" id="r3" name="rg1">
  <label class="labelz" for="r3">&#10038;</label>
  <input type="radio" class="inputz val_rat" value="2" id="r2" name="rg1">
  <label class="labelz"for="r2">&#10038;</label>
  <input type="radio" class="inputz val_rat" value="1" id="r1" name="rg1">
  <label class="labelz" for="r1">&#10038;</label>
</div>
</div>
<br>
<div style="margin:20px 20px 20px 20px">
<label style="text-align:left">Detail Catatan : </label>
<textarea class="form-control" style="height:100px" name=detail></textarea>
<br>
<br>
<button type="submit" class="btn btn-success " id="rating_button" >Simpan Rating</button>
<br>
<br>
</div>
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
  </div>