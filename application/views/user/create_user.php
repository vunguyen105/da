
<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/bootstrap-fileupload.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/bootstrap-timepicker.min.css" type="text/css" />

<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-migrate-1.1.1.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>public_html/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.autogrow-textarea.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/charCount.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/ui.spinner.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/forms.js"></script>





 <div class="maincontentinner">     
            <div class="widgetbox">
                <h4 class="widgettitle">Thêm tài khoản mới</h4>
                <div class="widgetcontent wc1">
                    <form id="form1" class="stdform" method="post" action="<?php echo base_url()?>dashboard/create_user" />
                            <div class="par control-group">
                                    <label class="control-label" for="user">Tài khoản</label>
                                    <div class="controls"><input type="text" name="user" id="user"  value="<?php if(isset($_POST['user'])) echo $_POST['user'];?>" class="input-xlarge" /></div>
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label" for="lastname">Tên</label>
                                <div class="controls"><input type="text" name="lastname" id="lastname" value="<?php echo set_value('lastname'); ?>" class="input-xlarge" /></div>
                            </div>
                            
                            <div class="par control-group">
                                    <label class="control-label" for="email">Email</label>
                                <div class="controls"><input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="input-xlarge" /></div>
                            </div>
                            
                             <div class="par control-group">
                                    <label class="control-label" for="email">Mật khẩu</label>
                                <div class="controls"><input type="password" name="password" id="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>" class="input-xlarge" /></div>
                            </div>
                            
                             <div class="par control-group">
                                    <label class="control-label" for="email">Nhập lại mật khẩu</label>
                                <div class="controls"><input type="password" name="cpassword" id="cpassword"  class="input-xlarge" /></div>
                            </div>
                            
                            <div class="par control-group">
                                <label>Quyền</label>
                                <span class="field"><select name="role" id="selection2" class="uniformselect">
                                    <option value="5" />User
                                    <option value="1" />Admin
                                    <option value="2" />Supper Mod
                                    <option value="3" />Mod
                                    <option value="4" />Chicken
                                </select></span>
                            </div>
                                                    
                            <p class="stdformbutton">
                                    <button class="btn btn-primary">Submit Button</button>
                                    <button type="reset" class="btn">Reset Button</button>
                            </p>
                    </form>
                    <?php echo validation_errors('<div class="alert alert-error">','</div>'); ?>
                </div><!--widgetcontent-->
            </div><!--widget-->
            
            
                        
            <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2013. Shamcey Admin Template. All Rights Reserved.</span>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="http://themepixels.com/">ThemePixels</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
