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
                <div class="caption"><i class="icon-globe"></i>Tạo sản phẩm mới</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="control-group">
                        <label class="control-label">Tiêu đề</label>
                        <div class="controls">
                            <input name="title" type="text" class="span6 m-wrap">                            
                        </div>
                        <?php if (!empty($cats)) { ?>
                        <label class="control-label">Thư mục</label>
                        <div class="controls">
                            <select id='standard' name='cat' class='custom-select'>
                                <option value=''>Chọn thư mục</option>
                                    <?php foreach ($cats as $key => $value) { ?>
                                <option value='<?php echo $value['id']; ?>'><?php echo $value['name']; ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                            <?php } ?>
                    </div>
                    <div class="row-fluid tab-content" id="content">
                        <textarea id="demo" name="demo"></textarea>
                    </div>
                    <?php echo $ckediter; ?>
                    <hr class="clearfix">
                    <div id="ufile" class="btn-group">
                        <button id="ufile" name="ufile" onclick="BrowseServer()" class="btn blue"><i class="icon-plus"></i> Quản lý ảnh</button>
                    </div>
                    <hr class="clearfix">
                    <div class="row-fluid">
                        <ul id="imges" class="listfile isotope" id="medialist" style="position: relative; overflow: hidden;">
                        </ul>
                    </div>
                    <div class="form-actions">
                        <button class="btn blue" id="save" type="submit"><i class="icon-ok"></i> Save</button>
                        <button class="btn" type="button">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
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
        BootstrapDialog.confirm('Thông báo', '', function(result) {
            if (result) {
                var title = $("input[name='title']").val();
                var cat = $("#standard").val();
                var objEditor = CKEDITOR.instances["demo"];
                var descr = objEditor.getData();
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
                        title: title,
                        descr: descr,
                        cat: cat,
                        imgs : array_anh
                    },
                    url: 'product_create',
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
                                        BootstrapDialog.closeAll();
                                        //local.href = <?php //echo  base_url().'dashboard/product_create'; ?>;
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