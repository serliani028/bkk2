  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-cube"></i> <?php echo lang('update_home_page_settings'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_home_page_settings'); ?></li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">

      <!-- Main row Starts-->
      <div class="row">

        <section class="col-lg-12">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo lang('home_page_settings'); ?></h3>
            </div>
            <?php if (allowedTo('home_page_settings')) { ?>
            <form id="admin_settings_form">
            <div class="box-body">
              <div class="row">
                <?php foreach ($settings as $s) { ?>
                <?php $col = $s['type'] == 'image' ? '4' : '12'; ?>
                <div class="col-md-<?php echo esc_output($col); ?>">
                  <div class="form-group">
                    <label><?php echo esc_output($s['description'], 'html'); ?></label>
                    <?php if ($s['type'] == 'heading') { ?>
                    <h2><?php echo esc_output($s['key'], 'raw'); ?></h2>
                    <?php } if ($s['type'] == 'text') { ?>
                    <input type="text" class="form-control" name="<?php echo esc_output($s['key']); ?>" 
                          value="<?php echo esc_output($s['value']); ?>">
                    <?php } else if ($s['type'] == 'readonly') { ?>
                    <input type="text" class="form-control" value="<?php echo esc_output($s['value']); ?>" readonly>
                    <?php } else if ($s['type'] == 'textarea') { ?>
                    <textarea id="<?php echo esc_output($s['key']); ?>" name="<?php echo esc_output($s['key']); ?>"><?php echo esc_output($s['value'], 'raw'); ?></textarea>
                    <?php } else if ($s['type'] == 'radio') { ?>
                      <br />
                      <?php $options = json_decode($s['options']); ?>
                      <?php foreach ($options as $o) { ?>
                      <?php $checked = $o == $s['value'] ? 'checked="checked"' : ''; ?>
                      <input type="radio" class="minimal" name="<?php echo esc_output($s['key']); ?>" 
                            value="<?php echo esc_output($o); ?>" <?php echo esc_output($checked); ?>> <?php echo esc_output($o); ?> &nbsp; &nbsp;
                      <?php } ?>
                    <?php } else if ($s['type'] == 'image') { ?>
                      <input type="file" class="form-control dropify" name="<?php echo esc_output($s['key']); ?>" 
                            data-default-file="" />
                    <?php } ?>
                  </div>
                </div>
                <?php } ?>
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="admin_settings_form_button"><?php echo lang('save'); ?></button>
            </div>
            </form>
            <?php } ?>
          </div>
          

        </section>

      </div>
      <!-- Main row Ends-->

    </section>
    <!-- Main content Ends-->

  </div>
  <!-- Content Wrapper Ends -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

</body>
</html>
