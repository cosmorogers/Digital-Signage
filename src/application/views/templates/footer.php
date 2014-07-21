         </div><!--/span-->
      </div><!--/row-->
      <footer>
       
      </footer>

    </div><!--/.fluid-container-->
</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('assets/js/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui-1.10.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-modal.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-dropdown.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-scrollspy.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-tab.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-tooltip.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-popover.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-button.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-collapse.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-carousel.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-typeahead.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-multiselect.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/menu.js'); ?>"></script>
    
    <?php 
    if (isset($js)) :
		foreach ($js as $script) : 	?>
    <script src="<?php echo base_url('assets/js/' . $script); ?>"></script>
    <?php 
    	endforeach;
    endif;
    ?>

  </body>
</html>
