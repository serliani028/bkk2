          <div class="job-listing-left">
            <div class="input-group job-listing-job-search">
              <input type="text" class="form-control job-search-value" placeholder="Cari Posisi Magang"
              value="<?php echo esc_output($search); ?>">
              <span class="input-group-btn">
                <button type="button" class="btn btn-primary btn-blue btn-flat job-search-button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
            <!-- <p class="job-listing-heading">-->
            <!--  <span class="job-listing-heading-text"><i class="fa fa-filter"></i> Lokasi Lowongan</span>-->
            <!--  <span class="job-listing-heading-line"></span>-->
            <!--</p>-->
            <!--<ul class="job-listing-filters-list">-->
            <!--     <li>-->
            <!--    <select class="form-control department-check">-->
            <!--        <option value="" > Pilih Lokasi </option>-->
            <!--  <?php foreach ($departments as $key => $value) { ?>-->
            <!--      <option value="<?php echo encode($value['id_kab']); ?>" > <?php echo trimString($value['nama']); ?></option>-->
            <!--  <?php } ?>-->
            <!--  </select>-->
            <!--  </li>-->
            <!--  <?php if(!empty($posisi)){ ?>-->
            <!--  <li>-->
            <!--      <p>&nbsp;<b>Lokasi DIpilih : <?=$posisi;?></b></p>-->
                 
            <!--  </li>-->
            <!--  <?php } ?>-->
            <!--</ul>-->
            <hr />
            <?php if ($companies) { ?>
            <p class="job-listing-heading">
              <span class="job-listing-heading-text"><i class="fa fa-filter"></i> Kategori Lowongan Magang </span>
              <span class="job-listing-heading-line"></span>
            </p>
            <ul class="job-listing-filters-list" >
              <?php foreach ($companies as $key => $value) { ?>
              <li ><input type="checkbox" class="company-check" <?php echo jobsCheckboxSel($companiesSel, encode($value['id'])); ?> value="<?php echo encode($value['id']); ?>" /> <?php echo trimString($value['nama_kategori']); ?></li>
              <?php } ?>
            </ul>
            <?php } ?>
            <hr />
           
          </div>
