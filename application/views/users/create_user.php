<div class="span12">
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet box green">
        <div class="portlet-title">
            <h4><i class="icon-reorder"></i>Tạo tài khoản mới</h4>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
                <a href="javascript:;" class="reload"></a>
                <a href="javascript:;" class="remove"></a>
            </div>
        </div>
        <div id="content" class="portlet-body form">
            <!-- BEGIN FORM-->
            <h3></h3>
            <div id="xx"class="alert alert-success hide">
                <button class="close" data-dismiss="alert"></button>

            </div>
            <form action="<?php echo base_url() ?>dashboard/create_user" method="post" id="form_create_user" class="form-horizontal">
                <div class="alert alert-error hide">
                    <button class="close" data-dismiss="alert"></button>
                    Dữ liệu bạn điền vào chưa hợp lệ hoặc bị thiếu.
                </div>
                <div class="alert alert-success hide">
                    <button class="close" data-dismiss="alert"></button>
                    Your form validation is successful!
                </div>
                <div class="control-group">
                    <label class="control-label" for="user">Tài khoản<span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="user" data-required="1" class="span6 m-wrap" value="<?php echo set_value('user'); ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="lastname">Tên<span class="required">*</span></label>
                    <div class="controls">
                        <input name="lastname" type="text" class="span6 m-wrap"value="<?php echo set_value('lastname'); ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email<span class="required">*</span></label>
                    <div class="controls">
                        <input name="email" type="text" class="span6 m-wrap"value="<?php echo set_value('email'); ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">Mật khẩu<span class="required">*</span></label>
                    <div class="controls">
                        <input id="password" name="password" type="password" class="span6 m-wrap"value="<?php echo set_value('password'); ?>"/>
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="cpassword">Nhập lại mật khẩu<span class="required">*</span></label>
                    <div class="controls">
                        <input name="cpassword" type="password" class="span6 m-wrap"value="<?php echo set_value('password'); ?>"/>
                    </div>
                </div>  
                <div class="control-group">
                    <label class="control-label">Quyền</label>
                    <div class="controls chzn-controls">
                        <select class="span6 m-wrap" name="role">    
                            <option value="5" />User
                            <option value="1" />Admin
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Education<span class="required">*</span></label>
                    <div class="controls chzn-controls">
                        <select id="form_2_education" class="span6 chosen-with-diselect" name="education" data-placeholder="Choose an Education" tabindex="1">
                            <option value=""></option>
                            <option value="Education 1">Education 1</option>
                            <option value="Education 2">Education 2</option>
                            <option value="Education 3">Education 5</option>
                            <option value="Education 4">Education 4</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button id="btnCreate_user" type="submit" class="btn green">Validate</button>
                    <button type="reset" class="btn">Reset</button>
                </div>
            </form>
            <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
            <!-- END FORM-->
        </div>
    </div>
    <!-- END VALIDATION STATES-->
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
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        //App.setPage("form_validation");
        App.init();
        $('#btnCreate_user').click(function() {
            //alert('x');
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
                invalidHandler: function(event, validator) { //display error alert on form submit   
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },
                highlight: function(element) { // hightlight error inputs
                    $(element)
                            .closest('.help-inline').removeClass('ok'); // display OK icon
                    $(element)
                            .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                },
                unhighlight: function(element) { // revert the change dony by hightlight
                    $(element)
                            .closest('.control-group').removeClass('error'); // set error class to the control group
                },
                success: function(label) {
                    // display success icon for other inputs
                    label
                            .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                            .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                },
                submitHandler: function(form) {
                    error2.hide();
                    $(form).find('.loading').show();
                    $('#loading_image').fadeIn('fast');
                    $.ajax({
                        url: form2.attr('action'),
                        type: 'post',
                        dataType: 'json',
                        data: form2.serialize(),
                    });
                    $('#loading_image').fadeIn(10000);
                    $('#form_create_user').hide();
                    //$('#content').html('hahah');
                    content = '<div class="form-actions"><button id="btnCreate_user_xx" type="submit" class="btn green">Validate</button><button id="bnt_huhuhu" type="reset" class="btn">Reset</button></div>';
                    $('#xx').html('Bạn muốn tạo tài khoản có tên đăng nhập là: ' + $("input[name$='user']").val() + content);
                    $('#xx').show();
                    $('#btnCreate_user_xx').click(function() {
                        //alert('hihihihuhuhu');
                        $('#xx').hide();
                        $('#form_create_user').show();
                        return false;
                    });
                    $('#bnt_huhuhu').click(function() {
                        //alert('hihihihuhuhu');
                        $('#form_create_user').show();
                    });
                    $('#loading_image').fadeOut(1000);
                    //console.log(form.serialize());
                }
            });

            //apply validation on chosen dropdown value change, this only needed for chosen dropdown integration.
            $('.chosen, .chosen-with-diselect', form2).change(function() {
                form2.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        });
    });
</script>     