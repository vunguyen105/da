<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title>Metronic Admin Dashboard Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="<?php echo base_url(); ?>backend/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>backend/assets/css/metro.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>backend/assets/css/style.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>backend/assets/css/style_responsive.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>backend/assets/css/style_default.css" rel="stylesheet" id="style_color" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/assets/uniform/css/uniform.default.css" />
  <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
  <!-- BEGIN LOGO -->
  <div class="logo">
  </div>
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="form-vertical login-form" action="" method="post">
      <h3 class="form-title">Login to your account</h3>
      <?php if($this->session->flashdata('message') != FALSE){?>
      <div class="alert alert-error">
        <button class="close" data-dismiss="alert"></button>
        <span><?php echo $this->session->flashdata('message');?></span>
      </div>
      <?php }?>
      <?php echo validation_errors('<div class="alert alert-error">
        <button class="close" data-dismiss="alert"></button><span>','</span></div>'); ?>
      <div class="control-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Tài Khoản" name="username"/>
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-lock"></i>
            <input class="m-wrap placeholder-no-fix" type="password" placeholder="Mật khẩu" name="password"/>
          </div>
        </div>
      </div>
      <div class="form-actions">
        <label class="checkbox">
        <input type="checkbox" name="remember" value="1"/> Nhớ tài khoản và mật khẩu
        </label>
        <button type="submit" class="btn green pull-right">
        Login <i class="m-icon-swapright m-icon-white"></i>
        </button>            
      </div>
    </form>
    <!-- END REGISTRATION FORM -->
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div class="copyright">
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS -->
  <script src="<?php echo base_url(); ?>backend/assets/js/jquery-1.8.3.min.js"></script>
  <script src="<?php echo base_url(); ?>backend/assets/bootstrap/js/bootstrap.min.js"></script>  
  <script src="<?php echo base_url(); ?>backend/assets/uniform/jquery.uniform.min.js"></script> 
  <script src="<?php echo base_url(); ?>backend/assets/js/jquery.blockui.js"></script>
  <script type="<?php echo base_url(); ?>backend/text/javascript" src="assets/jquery-validation/dist/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>backend/assets/js/app.js"></script>
  <script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>