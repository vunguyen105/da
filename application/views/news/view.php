<script src="<?php echo base_url(); ?>assets/dialog/run_prettify.js"></script>
<link href="<?php echo base_url(); ?>assets/dialog/bootstrap-dialog.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/dialog/bootstrap-dialog.js"></script>
<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
            <div class="portlet-title">
                <div class="caption"><i class="icon-globe"></i>Managed Table</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="btn-group">
                        <button id="create_user" class="btn green">
                            Add New User<i class="icon-plus"></i>
                        </button>
                    </div>
                    <div class="btn-group pull-right">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#">Print</a></li>
                            <li><a href="#">Save as PDF</a></li>
                            <li><a href="#">Export to Excel</a></li>
                        </ul>
                    </div>
                </div>
                <?php if (!empty($news)) { ?>
                <div id="content">
                    <table class="table table-striped table-bordered table-hover" id="table_user">
                        <thead>
                            <tr>
                                <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                <th>Tên tin tức</th>
                                <th class="hidden-480">Loại tin tức</th>
                                <th class="hidden-480">Mô tả</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                $pages;
                                $i = 1;
                                foreach ($news as $key => $value):
                                    ?>
                            <tr class="odd gradeX">
                                <td style="width:8px;"><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td style="width:8px;"><?php echo $value["name"]; ?></td>
                                <td class="hidden-480" value="<?php echo $value['page_id']?>"><?php echo $pages[$value['page_id']]["name"]; ?></td>
                                <td class="center hidden-480"><?php echo $value["description"]; ?></td>
                                <td data-id="<?php echo $value['id']?>">
                                    <span class="icon-edit"></span>
                                </td>
                                <td data-id="<?php echo $value['id']?>">
                                    <span class="icon-trash"></span>
                                </td>
                            </tr>
                                <?php endforeach; ?>
                    </table>
                    <div class="row-fluid">
                        <div class="" id="ajax_paging">
                            <span style="float: right;" class="dataTables_info" id="sample_1_info">Có tất cả <?php echo $count; ?> dòng dữ liệu</span>
                                <?php echo $pagination; ?>
                        </div>

                    </div>
                </div>
                    <?php } ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<script>

    jQuery(document).ready(function() {  
        applyPagination();
        function applyPagination() {
            $("#ajax_paging a").click(function() {
                if ($(this).attr('doclick') == '0') {
                    //alert('Đang ở trang đó mà');
                    return false;
                    jQuery.alerts.dialogClass = 'alert-success';
                    jAlert('Đang ở trang đó mà !', 'Thông Báo', function() {
                        jQuery.alerts.dialogClass = null;
                    });
                } else {
                    var url = $(this).attr("href");
                    $.ajax({
                        type: "POST",
                        data: {
                            ajax: 1
                        }, //
                        url: url,
                        beforeSend: function() {
                            //$("#content").html("");
                            //  $('#loading_image').fadeIn('slow');
                            $('#global_ajax_processing').fadeIn('slow');
                        },
                        success: function(msg) {
                            //$('#loading_image').fadeOut('slow');
                            // $('#global_ajax_processing').fadeOut('slow');
                            $("#content").html(msg);
                            //$("#content").remove();
                            applyPagination();
                        }
                    });
                }
                return false;
            });
        }
    });
    jQuery(document).on('click', '.icon-edit', function() { //alert('xxxxxxxx');
        var id = $(this).parent().attr('data-id');
        var that = $(this).parent().parent();
        var username = $(this).parents().prev().prev().prev().prev().text();
        var email = $(this).parents().prev().prev().prev().text();
        var text = '<form action="<?php echo base_url() ?>dashboard/user_edit" method="post" id="form_user_edit" class="">';
        text += '<div class="controls">'
        text += '<label class="control-label">Tài khoản</label>';
        text += '<input type="text" name="username" value="'+username+'" class="m-wrap large" placeholder="Tài khoản">'
        text += '<label class="control-label">Mật khẩu</label>';
        text += '<input type="password" name="password" class="m-wrap large" placeholder="Mật khẩu">'
        text += '<label class="control-label">Họ</label>';
        text += '<input type="text" name="firstname" class="m-wrap large" placeholder="Họ">'
        text += '<label class="control-label">Tên</label>';
        text += '<input type="text" name="lastname" class="m-wrap large" placeholder="Tên">'
        text += '<label class="control-label">Email</label>';
        text += '<input type="text" name="email" value="'+email+'" class="m-wrap large" placeholder="email">'
        text += '<label class="control-label">Địa chỉ</label>';
        text += '<input type="text" name="address" class="m-wrap large" placeholder="Địa chỉ">'
        text += '<input type="hidden" name="id" value="'+id+'">'
        text += '</div>'
        text += '</form>'
        BootstrapDialog.show({
            title: 'Tạo tài khoản mới',
            message: $(text),
            buttons: [{
                    label: 'Edit',
                    cssClass: 'btn green',
                    hotkey: 13, // Enter.
                    action: function() {
                        var form2 = $('form#form_user_edit');
                        $.ajax({
                            type: "POST",
                            data: form2.serialize(),
                            url: form2.attr('action'),
                            dataType: 'json',
                            beforeSend: function() {
                            },
                            success: function(data) { 
                                if (data != false)
                                {
                                    that.children('td:first').next().html(data.username);
                                    that.children('td:first').next().next().html(data.email);
                                    that.children('td:first').next().next().next().next().html(data.lastname);
                                    alert('bạn đã update tài khoản thành công');
                                    BootstrapDialog.closeAll();

                                }
                                else {
                                    alert('bạn đã update tài khoản ko thành công');
                                }
                            },
                        });
                    }
                }]
        });
    });

    jQuery(document).on('click', '#create_user', function() { 
        var text = '<form action="<?php echo base_url() ?>dashboard/create_user" method="post" id="form_create_user" class="">';
        var that = $(this).parent().parent();
        text += '<div class="controls">'
        text += '<label class="control-label">Tài khoản</label>';
        text += '<input type="text" name="username" class="m-wrap large" placeholder="Tài khoản">'
        text += '<label class="control-label">Mật khẩu</label>';
        text += '<input type="password" name="password" class="m-wrap large" placeholder="Mật khẩu">'
        text += '<label class="control-label">Họ</label>';
        text += '<input type="text" name="firstname" class="m-wrap large" placeholder="Họ">'
        text += '<label class="control-label">Tên</label>';
        text += '<input type="text" name="lastname" class="m-wrap large" placeholder="Tên">'
        text += '<label class="control-label">Email</label>';
        text += '<input type="text" name="email" class="m-wrap large" placeholder="email">'
        text += '<label class="control-label">Địa chỉ</label>';
        text += '<input type="text" name="address" class="m-wrap large" placeholder="Địa chỉ">'
        text += '</div>'
        text += '</form>'
        BootstrapDialog.show({
            title: 'Tạo tài khoản mới',
            message: $(text),
            buttons: [{
                    label: 'Create',
                    cssClass: 'btn green',
                    hotkey: 13, // Enter.
                    action: function() {
                        //                        var user = $('input#user.m-wrap ').val();
                        //                        var lastname = $('input#lastname.m-wrap ').val();
                        //                        var firstname = $('input#user.m-wrap ').val();
                        //                        var name = $('input#user.m-wrap ').val();
                        //                        alert(name);
                        var form2 = $('form#form_create_user');
                        $.ajax({
                            type: "POST",
                            data: form2.serialize(),
                            url: form2.attr('action'),
                            dataType: 'json',
                            beforeSend: function() {
                            },
                            success: function(data) { 
                                if (data.stt == true)
                                {

                                    BootstrapDialog.closeAll();
                                    alert('bạn đã tạo tài khoản thành công');
                                }
                                else {
                                    alert('bạn đã tạo tài khoản ko thành công');
                                }
                            },
                        });
                    }
                }]
        });
    });
    jQuery(document).on('click', 'table#table_user span.icon-trash', function() {
        var id = $(this).parent().attr('data-id');
        var that = $(this).parent().parent();
        var page = $('div.pagination li.active').children('a').text();
        BootstrapDialog.confirm('Thông báo', '', function(result) {
            if (result) {
                $.ajax({
                    type: "POST",
                    data: {
                        id: id,
                        page: page
                    },
                    url: 'news_del',
                    beforeSend: function() {
                    },
                    success: function(data) {
                        alert('bạn xóa thành công');
                        $("#content").html(data);
                    }
                });
            } else {

            }
        });
    });

</script>



