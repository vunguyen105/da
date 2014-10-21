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
                <?php if (!empty($bill)) { ?>
                <div id="content">
                    <table class="table table-striped table-bordered table-hover" id="table_user">
                        <thead>
                            <tr>
                                <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                <th></th>
                                <th>Khách hàng</th>
                                <th>Địa chỉ</th>
                                <th class="hidden-480">Thời gian đặt hàng</th>
                                <th class="hidden-480">Trạng thái</th>
                                <th class="hidden-480">Tổng</th>
                                <th>Thanh toán</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                $i = 1;
                                foreach ($bill as $key => $value):
                                    ?>
                            <tr class="odd gradeX">
                                <td style="width:8px;"><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td><i class="icon-plus"></i></td>
                                <td style="width:8px;"><?php echo $value["user"]; ?></td>
                                <td style="width:8px;"><?php echo $value["address"]; ?></td>
                                <td class="center hidden-480"><?php echo $value["create_on"]; ?></td>
                                <td class="center hidden-480" value="<?php echo $value["status"]; ?>"><?php $value["status"] = 1?"Thanh toán": "Chờ thanh toán"; ?></td>
                                <td class="center hidden-480"><?php echo $total; ?></td>
                                <td data-id="<?php echo $value['proid']?>">
                                    <?php if($value['status']==0) {?>
                                    <i class="halflings-icon share"></i>
                                    <?php }?>
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
        var url = '<?php echo base_url()?>';
        //alert(url);
        location.href = url+'dashboard/product_edit/'+id;
//        var that = $(this).parent().parent();
//        var username = $(this).parents().prev().prev().prev().prev().text();
//        var email = $(this).parents().prev().prev().prev().text();
        //var text = '<form action="<?php //echo base_url() ?>dashboard/product_edit" method="post" id="form_user_edit" class="">';
//        text += '<div class="controls">'
//        text += '<label class="control-label">Tài khoản</label>';
//        text += '<input type="text" name="username" value="'+username+'" class="m-wrap large" placeholder="Tài khoản">'
//        text += '<label class="control-label">Mật khẩu</label>';
//        text += '<input type="password" name="password" class="m-wrap large" placeholder="Mật khẩu">'
//        text += '<label class="control-label">Họ</label>';
//        text += '<input type="text" name="firstname" class="m-wrap large" placeholder="Họ">'
//        text += '<label class="control-label">Tên</label>';
//        text += '<input type="text" name="lastname" class="m-wrap large" placeholder="Tên">'
//        text += '<label class="control-label">Email</label>';
//        text += '<input type="text" name="email" value="'+email+'" class="m-wrap large" placeholder="email">'
//        text += '<label class="control-label">Địa chỉ</label>';
//        text += '<input type="text" name="address" class="m-wrap large" placeholder="Địa chỉ">'
//        text += '<input type="hidden" name="id" value="'+id+'">'
//        text += '</div>'
        //text += '</form>'
//        BootstrapDialog.confirm('Thông báo', '', function(result) {
//            if (result) {
//                $.ajax({
//                    type: "POST",
//                    data: {
//                        id: id,
//                        //page: page
//                    },
//                    url: 'product_edit',
//                    beforeSend: function() {
//                    },
//                    success: function(data) {
//                        alert('bạn sửa thành công');
//                    }
//                });
//            } else {
//
//            }
//        });
    });
    jQuery(document).on('click', 'table#table_user span.icon-trash', function() {
        var id = $(this).parent().attr('data-id');
        var that = $(this).parent().parent();
        var page = $('div.pagination li.active').children('a').text();
        //alert(page);
        BootstrapDialog.confirm('Thông báo', 'Bạn muốn xóa sản phẩm này', function(result) {
            if (result) {
                $.ajax({
                    type: "POST",
                    data: {
                        id: id,
                        page: page
                    },
                    url: 'product_del',
                    beforeSend: function() {
                    },
                    success: function(data) {
                        BootstrapDialog.closeAll();
                        alert('bạn xóa thành công');
                        $.ajax({
                            type:"POST",
                            url:'product',
                        });
                        //$("#content").html(data);
                    }
                });
            } else {

            }
        });
    });

</script>



