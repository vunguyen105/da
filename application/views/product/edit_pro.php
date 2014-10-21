


<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/chosen-bootstrap/chosen/chosen.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
	<!-- END PAGE LEVEL STYLES -->


<!-- BEGIN VALIDATION STATES-->
						<div class="portlet box green">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i>Edit Product</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
                                                                <?php if(!empty($pros)) {?>
                                                                <form action="<?php //echo base_url();?>Admin/product/edit" id="form_sample_2" class="form-horizontal" method="post">
									<div class="alert alert-error hide">
										<button class="close" data-dismiss="alert"></button>
										You have some form errors. Please check below.
									</div>
									<div class="alert alert-success hide">
										<button class="close" data-dismiss="alert"></button>
										Your form validation is successful!
									</div>
									<div class="control-group">
										<label class="control-label">Tên sản phẩm<span class="required">*</span></label>
										<div class="controls">
                                                                                    <input type="text" name="name"  value="<?php if(!empty($_POST['name'])) echo $_POST['name']; else echo $pros[0]['pro_name']?>" data-required="1" class="span6 m-wrap"  />
										</div>
									</div>

                                                                        <div class="control-group">
										<label class="control-label">Giá<span class="required">*</span></label>
										<div class="controls">
                                                                                    <input type="text" name="price"  data-required="1" class="span6 m-wrap" value="<?php if(!empty($_POST['price'])) echo $_POST['price']; else echo $pros[0]['price'] ?>"/>
										</div>
									</div>
                                                                        <div class="control-group">
										<label class="control-label">Giảm giá<span class="required"></span></label>
										<div class="controls">
                                                                                    <input type="text" name="discounts"  data-required="1" class="span6 m-wrap" value="<?php if(!empty($_POST['discounts'])) echo $_POST['discounts']; else echo $pros[0]['discounts'];?>"/>
										</div>
									</div>
                                                                        <div class="control-group">
										<label class="control-label">Nhà sản xuất<span class="required"></span></label>
										<div class="controls">
                                                                                    <input type="text" name="hang"  data-required="1" class="span6 m-wrap" value="<?php if(!empty($_POST['hang'])) echo $_POST['hang']; else echo $pros[0]['hang'];?>"/>
										</div>
									</div>


									<div class="control-group">
										<label class="control-label">Bảo hành</label>
										<div class="controls">
											<input name="baohanh" type="text" class="span6 m-wrap" value="<?php if(!empty($_POST['baohanh'])) echo $_POST['baohanh']; else echo $pros[0]['baohanh']?>"/>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label">Category<span class="required">*</span></label>
										<div class="controls">
                                                                                    <select class="span6 m-wrap" name="category_id"><?php echo $cats = getcat_All()?>
												<option value="">Select...</option>
												 <?php if(isset($cats)) foreach ($cats as $cat) {?>
                                                                                                 <option value="<?php echo $cat['id']?>" /><?php echo $cat['cat_name']?>
                                                                                                 <?php }?>
											</select>
										</div>
									</div>



									<div class="control-group">
										<label class="control-label">Hiển thị</label>
										<div class="controls">
											<label class="radio line">
											<input type="radio" name="stt" value="1" />
											Ngoài trang chủ
											</label>
											<label class="radio line">
											<input type="radio" name="stt" value="0" />
											Không ngoài trang chủ
											</label>
											<div id="form_2_membership_error"></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Thông số kỹ thuật</label>
										<div class="controls">
											<textarea class="span12 ckeditor m-wrap" name="technique" rows="6" data-error-container="#editor2_error"></textarea>
											<div id="editor2_error"></div>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label">Mô tả</label>
										<div class="controls">
											<textarea class="span12 ckeditor m-wrap" name="description" rows="6" data-error-container="#editor2_error"></textarea>
											<div id="editor2_error"></div>
										</div>
									</div>
                                                                        <div class="control-group">
										<label class="control-label">Tên ảnh<span class="required"></span></label>
										<div class="controls">
                                                                                    <input type="text" name="title"  data-required="1" class="span6 m-wrap" <?php set_value('title');?>/>
										</div>
									</div>

                                                                        <div class="control-group">
                                                                            <label class="control-label">File</label>
                                                                            <div class="controls">
                                                                                <input class="default" type="file" id="ufile" size="25">
                                                                             <!--   <input type="hidden" name="count" id="count" value="<?php echo $count?>"/> -->
                                                                            </div>
                                                                            <div class="form-actions">
										<button type="submit" id="submit" class="btn green">Upload</button>
                                                                            </div>

                                                                        </div>
							
									<div class="form-actions">
										<button type="submit" class="btn green">Submit</button>
										<button type="button" class="btn">Cancel</button>
									</div>
								</form>
                                                                <?php }?>
								<!-- END FORM-->
							</div>
						</div>
						<!-- END VALIDATION STATES-->


   <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
	<script type="text/javascript" src="assets/plugins/ckeditor/ckeditor.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/form-validation.js"></script>
	<!-- END PAGE LEVEL STYLES -->
	<script>
		jQuery(document).ready(function() {
		   // initiate layout and plugins
		   App.init();
		   FormValidation.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->