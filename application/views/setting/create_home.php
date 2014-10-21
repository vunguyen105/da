<script src="<?php echo base_url(); ?>assets/dialog/run_prettify.js"></script>
<link href="<?php echo base_url(); ?>assets/dialog/bootstrap-dialog.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/dialog/bootstrap-dialog.js"></script>
<script src="<?php echo base_url() ?>assets/customselect/jquery-customselect.js"></script>
<link href="<?php echo base_url() ?>assets/customselect/jquery-customselect.css" rel="stylesheet" />
<style>
    .mediamgr_content {
        margin-right: 250px;
        padding: 20px 0;
    }
    .isotope {
        transition-property: height, width;
    }
    .isotope, .isotope .isotope-item {
        transition-duration: 0.8s;
    }
    .listfile {
        list-style: none outside none;
    }
    .isotope .isotope-item {
        transition-property: transform, opacity;
    }
    .listfile li {
        background: none repeat scroll 0 0 #FCFCFC;
        border: 1px solid #DDDDDD;
        display: inline-block;
        margin: 5px 10px 5px 0;
        padding: 10px;
    }
    .isotope-item {
        z-index: 2;
    }
    .listfile li a {
        display: block;
    }
    a, a:hover, a:link, a:active, a:focus {
        color: #0866C6;
        outline: medium none;
        text-decoration: none;
    }
    .listfile li span.filename {
        display: block;
        font-size: 11px;
        margin-top: 5px;
        text-align: center;
    }
</style>
<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="icon-globe"></i>Tạo website mới</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <?php if(!empty($info)){?>        
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="control-group">
                        <div class="controls">
                            <input name="id" hidden="id" value="<?php echo $info[0]['id']?>">                            
                        </div>
                        <label class="control-label">Tên trang</label>
                        <div class="controls">
                            <input name="title" type="text" class="span6 m-wrap" value="<?php echo $info[0]['title']?>">                            
                        </div>
                        <label class="control-label">Số điện thoại</label>
                        <div class="controls">
                            <input name="phone" type="number" class="span6 m-wrap" value="<?php echo $info[0]['phone']?>">                            
                        </div>
                        <label class="control-label">Địa chỉ</label>
                        <div class="controls">
                            <input name="address" type="text" class="span6 m-wrap" value="<?php echo $info[0]['address']?>">                            
                        </div>
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="email" type="text" class="span6 m-wrap" value="<?php echo $info[0]['email']?>">                            
                        </div>
                        <label>Giới thiệu</label>
                        <div class="row-fluid tab-content" id="content" name="about">
                            <textarea id="demo" name="demo" ><?php echo $info[0]['about']?></textarea>
                        </div>
                        <?php echo $ckediter; ?>
                        <label class="control-label">Bản Đồ</label>
                        <div class="controls">
                            <input name="map" type="text" class="span6 m-wrap" value="<?php echo $info[0]['map']?>">                            
                        </div>

                        <div class="form-actions">
                            <button class="btn blue" id="save" type="submit"><i class="icon-ok"></i> Save</button>
                            <button class="btn" type="button">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>
            <?php }?>
            
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>





    <script type="text/javascript">
        function BrowseServer()
        {
            var finder = new CKFinder();
            finder.BasePath = '<?php echo site_url() ?>/ckfinder/';
            finder.SelectFunction = imageBrowse;
            finder.SelectFunctionData = 'images';
            finder.SelectThumbnailFunction = imageBrowse;
            finder.Popup();
        }

        function imageBrowse(fileUrl, data)
        {
            var n = fileUrl.split("/");
            var file = n[n.length - 1];
            var foder = n[n.length - 2];
            var length = foder.length + file.length + 1;
            var link = fileUrl.substring(0, fileUrl.length - length) + '_thumbs/' + fileUrl.substring(fileUrl.length - length, fileUrl.length);
            var html = '<li class="image isotope-item">';
            html += '<a href = "' + link + '" data-link = "' + foder + '/' + file + '"  class = "cboxElement">';
            html += '<img alt = ""src = "' + link + '"></a>';
            html += '<span class = "filename">' + file + '<a class="icon-trash"></a></li>';
            $('#imges').append(html);
            return false;
        }
    </script>
    <script type="text/javascript" src="<?php echo site_url() ?>/ckfinder/ckfinder_v1.js"></script>
    <script>
        jQuery(document).on('click', 'a.icon-trash', function() {
            $(this).parent().parent().remove();
            return  false;
        });
        jQuery(document).on('click', "#save", function() {
            BootstrapDialog.confirm('Thông báo', 'Bạn muốn thêm trang này', function(result) {
                if (result) {
                    var id = $("input[name='id']").val();
                    var title = $("input[name='title']").val();
                    var phone = $("input[name='phone']").val();
                    var address = $("input[name='address']").val();
                    var map = $("input[name='map']").val();
                    var email = $("input[name='email']").val();
                    var objEditor = CKEDITOR.instances["demo"];
                    var about = objEditor.getData();
                    var array_anh = [];
                    $('#imges').each(function() {
                        var link = '';
                        $(this).find('li').each(function() {
                            var current = $(this);
                            var link = current.children('a').attr('data-link');
                            array_anh.push(link);
                        });
                    });
                    $.ajax({
                        type: "POST",
                        data: {
                            id: id,
                            title: title,
                            phone: phone,
                            address: address,
                            email: email,
                            map: map,
                            about: about,
                            imgs: array_anh
                        },
                        url: 'setting',
                        beforeSend: function() {
                        },
                        success: function(data) {
                            BootstrapDialog.show({
                                title: 'Thông báo',
                                message: 'Tạo sản phẩm thành công',
                                buttons: [{
                                        label: 'OK',
                                        cssClass: 'btn green',
                                        hotkey: 13, // Enter.
                                        action: function() {
                                            location.href = "<?php echo base_url() ?>dashboard/setting";
                                            BootstrapDialog.closeAll();
                                            //local.href = <?php //echo  base_url().'dashboard/product_create';   ?>;
                                        }
                                    }]
                            });
                        }
                    });
                }
            });

        });
        jQuery(document).ready(function() {
            //$("#standardc").customselect();
        });

    </script>