<!-- js placed at the end of the document so the pages load faster -->
<script src="01-TEMPLATE/FLAT-ADMIN/js/jquery.js"></script>
<script src="01-TEMPLATE/FLAT-ADMIN/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="01-TEMPLATE/FLAT-ADMIN/js/jquery.scrollTo.min.js"></script>
<script src="01-TEMPLATE/FLAT-ADMIN/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="01-TEMPLATE/FLAT-ADMIN/js/respond.min.js" ></script>

<!--this page plugins-->

  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/fuelux/js/spinner.min.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/ckeditor/ckeditor.js"></script>
  <script src="01-TEMPLATE/FLAT-ADMIN/js/form-validation-script.js"></script>
  
  
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
  <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    
<!--right slidebar-->
<script src="01-TEMPLATE/FLAT-ADMIN/js/slidebars.min.js"></script>

<!--Form Validation-->
<script src="01-TEMPLATE/FLAT-ADMIN/js/bootstrap-validator.min.js" type="text/javascript"></script>

<!--Form Wizard-->
<script src="01-TEMPLATE/FLAT-ADMIN/js/jquery.steps.min.js" type="text/javascript"></script>
<script src="01-TEMPLATE/FLAT-ADMIN/js/jquery.validate.min.js" type="text/javascript"></script>

<!--common script for all pages-->
<script src="01-TEMPLATE/FLAT-ADMIN/js/common-scripts.js"></script>

<!--script for this page-->
<script src="01-TEMPLATE/FLAT-ADMIN/js/advanced-form-components.js"></script>
<script src="01-TEMPLATE/FLAT-ADMIN/js/jquery.stepy.js"></script>

	  
  <script>

      //step wizard

      $(function() {
          $('#default').stepy({
              backLabel: 'Précédent',
              block: true,
              nextLabel: 'Suivant',
              titleClick: true,
              titleTarget: '.stepy-tab',
			  validate:       true
          });
      });
	  
	        $(function() {
          $('#default2').stepy({
              backLabel: 'Précédent',
              block: true,
              nextLabel: 'Suivant',
              titleClick: true,
              titleTarget: '.stepy-tab',
			  validate:       true
          });
      });
	  
	  CKEDITOR.replace( 'editor2', {
    toolbarGroups: [
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
 		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
 		{ items: [ 'Link', 'Unlink' ] },
		{ name: 'insert' },
		{ name: 'tools'}
	]
});

	  CKEDITOR.replace( 'editor3', {
    toolbarGroups: [
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
 		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
 		{ items: [ 'Link', 'Unlink' ] },
		{ name: 'insert' },
		{ name: 'tools'}
	]
});

  </script>