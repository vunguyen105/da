<div class="maincontentinner"> 
            <div class="widgetbox box-inverse">
                <?php //if(!empty($info)) {?>
                <h4 class="widgettitle">Setting</h4>
                <div class="widgetcontent wc1">
                    <form id="form1" class="stdform" method="post" action="<?php //echo //base_url()?>Admin/Setting/index" />
                            <div class="par control-group">
                                    <label class="control-label" for="page">Tên trang</label>
                                <div class="controls"><input type="text" name="name" id="name" value="<?php echo $info[0]['title'];?>" class="input-large" /></div>
                            </div>
                    
                            <div class="par control-group">
                                    <label class="control-label" for="about">Giới thiệu</label>
                                    <div class="controls"><textarea cols="80" rows="5" name="about" id="about" value="" class="input-xxlarge" id="location"><?php echo $info[0]['about'];?></textarea></div> 
                            </div>
                             <div class="par control-group">
                                    <label class="control-label" for="page">Số điện thoại</label>
                                <div class="controls"><input type="text" name="phone" id="phone" value="<?php echo $info[0]['phone'];?>" class="input-large" /></div>
                            </div>
                             <div class="par control-group">
                                    <label class="control-label" for="page">email</label>
                                <div class="controls"><input type="text" name="email" id="phone" value="<?php echo $info[0]['email'];?>" class="input-large" /></div>
                            </div>
                            <div class="par control-group">
                                    <label class="control-label" for="page">Địa chỉ</label>
                                    <div class="controls"><textarea cols="80" rows="5" name="address" id="address" value="" class="input-xxlarge" id="location"><?php echo $info[0]['address'];?></textarea></div> 
                            </div>
                             <p class="stdformbutton">
                                 <button name="setting" class="btn btn-primary">Submit Button</button>
                            </p>
                        </p>
                    </form>
                    
                    
                     <?php echo validation_errors('<div class="alert alert-error">','</div>'); ?>
                </div><!--widgetcontent-->
                <?php }?>
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