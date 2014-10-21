
<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/bootstrap-fileupload.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/bootstrap-timepicker.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-ui-1.9.2.min.js"></script>
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
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/forms.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>


            <div class="maincontentinner">     
                <div class="widgetbox">

                <?php if(isset($data['partner']) && $data['partner'] == false) 
                {
                    echo "<h4 class='widgettitle'>Partnet không tồn tại !</h4>";
                }?>
                
                    <?php if(!empty($data) && $data['partner'] != FALSE) {?>
                    <?php (isset($data['partner']) && $data['partner'] != false) ? $uri = $data['partner'][0]['PARTNERID'] : $uri =""; ?>
               <h4 class="widgettitle">Sửa đối tác</h4>
                <div class="widgetcontent wc1">
                    <?php echo validation_errors('<div class="alert alert-error">','</div>'); ?>
                        <form id="form1" class="stdform" method="post" action="<?php echo site_url()."dashboard/edit_partner/".$uri?>"/>
                            <div class="par control-group">
                              <div class="alert alert-info">
                              Sửa đối tác <?php echo $data['partner'][0]['PARTNERID'];?>
                              </div>   
                            <div class="par control-group">
                                    <label class="control-label" for="partnername">Tên đối tác</label>
                                    <div class="controls"><input type="text" name="partnername" id="partnername"  value="<?php if(isset($_POST['partnername'])) echo $_POST['partnername']; else echo $data['partner'][0]['PARTNERNAME']?>" class="input-xlarge required" /></div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label" for="timemax">Thời hạn đảo</label>
                                <div class="controls"><input type="text" name="timemax" id="timemax" value="<?php if(isset($_POST['timemax'])) echo $_POST['timemax']; else echo $data['partner'][0]['NUMDAYFORREVERT']?>" class="input-xlarge required" /></div>
                            </div>  
                            <span>
                            <label>Trang thái</label>
                                <span class="field"><select name="statut" id="selection" class="uniformselect"> 
                                  <option value="A" />Kích hoạt
                                  <option value="B" />Khóa
                                </select>
                            </span>
                            <span class="formwrapper">
                            	<input type="checkbox" name="key" /> Sinh lại Key<br />
                            </span>
                            <span class="formwrapper">
                            	<input type="checkbox" name="code" /> Sinh lại Code<br />
                            </span>
                            
                            <p class="stdformbutton">
                                    <button id='code' class="btn btn-primary">Submit Button</button>
                                    <button type="reset" class="btn">Reset Button</button>
                            </p>
                    </form>
                    <?php }?>
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
  