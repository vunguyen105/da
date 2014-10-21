<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">

  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width">
  <meta name="author" content="vunguyen105@gamil.com">
  <meta name="author" content="xuanthinh.nham@gmail.com">
  <link rel="shortcut icon" href="favicon.ico">
  <link href="<?php echo base_url();?>Frontend/css/style.css" media="screen" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url();?>Frontend/css/jquery.jqzoom.css" type="text/css">

  <script src="<?php echo base_url();?>Frontend/js/jquery-1.7.2.min.js"></script> 
  <script src="<?php echo base_url();?>Frontend/js/html5.js"></script>
  <script src="<?php echo base_url();?>Frontend/js/main.js"></script>
  <script src="<?php echo base_url();?>Frontend/js/jquery.carouFredSel-6.2.0-packed.js"></script>
  <script src="<?php echo base_url();?>Frontend/js/jquery.touchSwipe.min.js"></script>
  <script src="<?php echo base_url();?>Frontend/js/checkbox.js"></script>
  <script src="<?php echo base_url();?>Frontend/js/radio.js"></script>
  <script src="<?php echo base_url();?>Frontend/js/selectBox.js"></script>
  <script src="<?php echo base_url();?>Frontend/js/jquery.jqzoom-core.js"></script>
  <?php echo $_title; ?>
        <?php echo $_meta; ?>
        <?php echo $_styles; ?>
        <?php echo $_scripts; ?>
        
 
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
</head>
<body>
  <?php echo $header_nav;?>
  <section id="main">
    <div class="container_12">
        <?php  echo $home_page;?>           

      <div class="clear"></div>

    </div><!-- .container_12 -->
  </section><!-- #main -->
  <div class="clear"></div>

  <?php echo $footer;?>

</body>
</html>
