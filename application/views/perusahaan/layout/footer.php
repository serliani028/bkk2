  <!-- Top Modal -->
  <div class="modal fade in" id="modal-default" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header resume-modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title resume-modal-title">Refer Job</h4>
      </div>
      <div class="modal-body-container">
      </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
  </div>
  </div>

  <!--==========================
    Footer
  ============================-->
  <?php $footer = footerColumns(); ?>
  <footer id="footer">
    <?php if ($footer['columns']) { ?>
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <?php foreach ($footer['columns'] as $column) { ?>
          <div class="col-md-<?php echo esc_output($footer['column_count']); ?> col-sm-12">
            <?php echo esc_output($column['content'], 'raw'); ?>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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
  </body>
</html>
