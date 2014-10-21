<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="<?php echo base_url(); ?>backend/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>backend/assets/css/metro.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>backend/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>backend/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>backend/assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>backend/assets/css/style_responsive.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>backend/assets/css/style_default.css" rel="stylesheet" id="style_color" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/assets/chosen-bootstrap/chosen/chosen.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/assets/uniform/css/uniform.default.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/gritter/css/jquery.gritter.css" />
        
        <style>
            #header { position: relative;}
            #global_ajax_processing {
                background-color: #178601;
                color: #FFFFFF;
                height: 25px;
                padding-left: 20px;
                padding-top: 5px;
                position: fixed;
                right: 0;
                width: 213px;
                display: none;
                font-weight: bold;
                z-index: 99999;
                font-family: Tahoma, Arial, Helvetica, sans-serif;
            }
        </style>
        
        <link href="<?php echo base_url(); ?>backend/assets/css/jquery.alerts.css" rel="stylesheet" />
	<link rel="shortcut icon" href="favicon.ico" />
        
        	<!-- Load javascripts at bottom, this will reduce page load time -->
	<script src="<?php echo base_url(); ?>backend/assets/js/jquery-1.8.3.min.js"></script>		
        <script src="http://malsup.github.com/jquery.form.js"></script> 
	<script src="<?php echo base_url(); ?>backend/assets/breakpoints/breakpoints.js"></script>			
	<script src="<?php echo base_url(); ?>backend/assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>	
	<script src="<?php echo base_url(); ?>backend/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>backend/assets/js/jquery.blockui.js"></script>
	<script src="<?php echo base_url(); ?>backend/assets/js/jquery.cookie.js"></script>
<!--	<script src="<?php //echo base_url(); ?>backend/assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>	-->
	<script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ajaxSend(function(event, xhr, options) {
		$('#global_ajax_processing').fadeIn(500);
	}).ajaxComplete(function(event, xhr, options) {
		$('#global_ajax_processing').fadeOut(500);
	});
        
        </script>
        
        <?php echo $_title; ?>
        <?php echo $_meta; ?>
        <?php echo $_styles; ?>
        <?php echo $_scripts; ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
        <div id="global_ajax_processing" style="none block;">Chờ tý. Đang xử lý ... </div>
        <div id="loading_image" style="width: 100%; height: 2000px; position: absolute; top: 0px; left: 0px; display: none; background: rgba(0,0,0,0.3); z-index: 9999;">
            <div style="position: relative; width: 100%; height: 100%;">
                <img src="<?php echo base_url(); ?>images/loading_images.gif" style="position: fixed; top: 45%; left: 45%" />
            </div> 
        </div>
	<!-- BEGIN HEADER -->
	<?php echo $header; ?>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->	
	<div class="page-container row-fluid">
                <?php echo $siderbar;?>
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
							<?php echo $desption;?> <small><?php echo $title; ?></small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="#">Extra</a>
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Blank Page</a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<?php  echo $content?>
			</div>
			<!-- END PAGE CONTAINER-->	
		</div>
		<!-- END PAGE -->	 	
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<?php echo $footer;?>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS -->

        
<!--	<script src="<?php //echo base_url(); ?>backend/assets/js/app.js"></script>		
        <script>
           jQuery(document).ready(function() {   
              // initiate layout and plugins
              //App.setPage("form_validation");
              //App.init();
           });
        </script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/js/jquery.alerts.js"></script>
        <link href="<?php echo base_url(); ?>backend/assets/css/jquery.alerts.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/js/elements.js"></script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
