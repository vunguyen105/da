<link rel="stylesheet" href="<?php echo base_url(); ?>backend/assets/data-tables/DT_bootstrap.css" />
<div class="row-fluid">
                                        <div class="span12">            				
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box light-grey">
							<div class="portlet-title">
								<h4><i class="icon-globe"></i>Managed Table</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="clearfix">
									<div class="btn-group">
										<button id="sample_editable_1_new" class="btn green">
										Add New <i class="icon-plus"></i>
										</button>
									</div>
									<div class="btn-group pull-right">
										<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
										</button>
										<ul class="dropdown-menu">
											<li><a href="#">Print</a></li>
											<li><a href="#">Save as PDF</a></li>
											<li><a href="#">Export to Excel</a></li>
										</ul>
									</div>
								</div>
								<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
											<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
											<th>Username</th>
											<th class="hidden-480">Email</th>
											<th class="hidden-480">Points</th>
											<th class="hidden-480">Joined</th>
											<th ></th>
										</tr>
									</thead>
									<tbody>
                                                                                <?php //echo "<pre>";var_dump($users);
                                                                                if(!empty($users)) foreach ($users as $user){    // var_dump($user);die;?>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1" /></td>
											<td><?php echo $user->user;?></td>
											<td><?php echo $user->id_pro;?></td>
											<td><?php echo $user->id_bid;?></td>
											<td><?php echo $user->count;?></td>
											<td ><span class="label label-success">Approved</span></td>
										</tr>
                                                                         <?php }?>        
									</tbody>
								</table>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>

        
   <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
   <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/bootstrap-daterangepicker/daterangepicker.js"></script> 
   <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
   <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/jquery-validation/dist/jquery.validate.min.js"></script>
   
   <script type="text/javascript" src="a<?php echo base_url(); ?>backend/ssets/jquery-validation/dist/additional-methods.min.js"></script>
   
        
        
	<!-- ie8 fixes -->
	<!--[if lt IE 9]>
	<script src="assets/js/excanvas.js"></script>
	<script src="assets/js/respond.js"></script>
	<![endif]-->
	<script src="<?php echo base_url(); ?>backend/assets/js/app.js"></script>		
        <script>
           jQuery(document).ready(function() {   
              // initiate layout and plugins
              //App.setPage("form_validation");
              App.init();
              $('#btnCreate_user').click(function(){
                 var form2 = $('#form_create_user');
        var error2 = $('.alert-error', form2);
        var success2 = $('.alert-success', form2);

        form2.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            onkeyup: false,
            rules: {
                user: {
                    minlength: 2,
                    required: true
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                cpassword: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }                 
            },

            invalidHandler: function (event, validator) { //display error alert on form submit   
                success2.hide();
                error2.show();
                App.scrollTo(error2, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.help-inline').removeClass('ok'); // display OK icon
                $(element)
                    .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change dony by hightlight
                $(element)
                    .closest('.control-group').removeClass('error'); // set error class to the control group
            },

            success: function (label) {
                 // display success icon for other inputs
                    label
                        .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
            },

            submitHandler: function (form) {
                error2.hide();
                    //$(form).find('.loading').show();
                   // $('#loading_image').fadeIn('fast');
                    $.ajax({
                        url: form2.attr('action'),
                        type: 'post',
                        dataType: 'json',
                        data: form2.serialize(),
                    
                    });
                    $('#loading_image').fadeIn(1000);
                    $('#form_create_user').hide();
                    //$('#content').html('hahah');
                    content = '<div class="form-actions"><button id="btnCreate_user_xx" type="submit" class="btn green">Validate</button><button id="bnt_huhuhu" type="reset" class="btn">Reset</button></div>';
                    $('#xx').html('Bạn muốn tạo tài khoản có tên đăng nhập là: '+$("input[name$='user']").val()+ content);
                    $('#xx').show();
                    $('#btnCreate_user_xx').click(function(){
                        //alert('hihihihuhuhu');
                        $('#xx').hide();
                        $('#form_create_user').show();
                        return false;
                    });
                    $('#bnt_huhuhu').click(function(){
                        //alert('hihihihuhuhu');
                        $('#form_create_user').show();
                    });
                    $('#loading_image').fadeOut(1000);                    
                    //console.log(form.serialize());
            }
        });

        //apply validation on chosen dropdown value change, this only needed for chosen dropdown integration.
        $('.chosen, .chosen-with-diselect', form2).change(function () {
            form2.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });
              });
           });
        </script>     