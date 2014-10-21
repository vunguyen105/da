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
                <h4 class="widgettitle">Thêm đối tác mới</h4>
                <div class="widgetcontent wc1">
                    <form id="form1" class="stdform" method="post" action="<?php echo base_url()?>dashboard/create_partner" />
                            <div class="par control-group">
                                    <label class="control-label" for="Idpartner">Mã đối tác</label>
                                    <div class="controls"><input type="text" maxlength="8" minlength="8" name="Idpartner" id="Idpartner"  value="<?php if(isset($_POST['Idpartner'])) echo $_POST['Idpartner'];?>" class="input-xlarge required" /></div>
                            </div>
                            <div class="par control-group">
                                    <label class="control-label" for="partnername">Tên đối tác</label>
                                    <div class="controls"><input type="text" name="partnername" id="partnername"  value="<?php if(isset($_POST['partnername'])) echo $_POST['partnername'];?>" class="input-xlarge" /></div>
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label" for="timemax">Thời hạn đảo</label>
                                <div class="controls"><input type="text" name="timemax" id="timemax" value="<?php if(isset($_POST['timemax'])) echo $_POST['timemax'];?>" class="input-xlarge number required" /></div>
                            </div>       
                            <div class="par control-group">
                                <label>Dạng mã hóa mật khẩu</label>
                                <span class="field"><select name="mk" id="selection2" class="uniformselect">
                                    <option value="S" />sha1
                                    <option value="M" />md5
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