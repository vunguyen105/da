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
                        <label class="control-label">Tên sản phẩm</label>
                        <div class="controls">
                            <input id="title" name="title" type="text" class="span6 m-wrap">
                        </div>
                        <?php if (!empty($cats)) { ?>
                            <label class="control-label">Thư mục</label>
                            <div class="controls">
                                <select id='standard' name='cat' class='custom-selectx'>
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
                    <div id="nguyen" class="btn-group">
                        <button id="create_user" onclick="BrowseServer()" class="btn blue"><i class="icon-plus"></i> Quản lý ảnh</button>
                    </div>
                    <hr class="clearfix">
                    <div class="row-fluid">
                        <ul id="imges" class="listfile isotope" id="medialist" style="position: relative; overflow: hidden;">
                        </ul>
                    </div>
                    <div class="form-actions">
                        <button id ="submit" class="btn blue" type="submit"><i class="icon-ok"></i> Create</button>
                        <button id="cancel" class="btn" type="button">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>





<script type="text/javascript">
                            $(function() {
                                $("#standard").customselect();
                            });
                            function BrowseServer()
                            {
                                var finder = new CKFinder();
                                finder.BasePath = '<?php echo site_url() ?>/ckfinder/';
                                finder.SelectFunction = imageBrowse;
                                finder.SelectFunctionData = 'images';
                                finder.SelectThumbnailFunction = tuan;
                                finder.Popup();
                            }

                            function tuan(){
                                alert('tao la tuan');
                            }
                            function imageBrowse(fileUrl, data)
                            {
                                var n = fileUrl.split("/");
                                var file = n[n.length - 1];
                                var foder = n[n.length - 2];
                                alert(file);
                                var length = foder.length + file.length + 1;
                                var link = fileUrl.substring(0, fileUrl.length - length) + '_thumbs/' + fileUrl.substring(fileUrl.length - length, fileUrl.length);
                                var html = '<li class="image isotope-item">';
                                html += '<a href = "' + link + '" class = "cboxElement">';
                                html += '<img alt = "" src = "' + link + '"></a>';
                                html += '<span class = "filename">' + file + '<a class="icon-trash"></a></li>';
                                $('#imges').append(html);
                                return false;
                            }

                            function SetFileField(fileUrl, data)
                            {
                                //alert('Bạn đã chọn file: ' + fileUrl);
                                document.getElementById("image").setAttribute("value", fileUrl);
                            }

</script>
<script type="text/javascript" src="<?php echo site_url() ?>/ckfinder/ckfinder_v1.js"></script>
<script>
    jQuery(document).on('click', 'a.icon-trash', function() {
        $(this).parent().parent().remove();
        return  false;
    });

    jQuery(document).on('click', '#submit', function() {
        var title = $("input[name='title']").val();
        var cat = $("input[name='cat']").val();
        var content = $(textarea#demo).val(); alert(content);


        $.ajax({
         type: "POST",
          url: "dashboard/product_create",
          data: title,
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function (msg) {
             var str = msg.d;
             var substr = str.split('|||');

             $('#ContentPlaceHolder_hfContentSectionID').val(substr[0]);
             $('.txtAlias').val(substr[1]);
             $('.txtBrowserTitle').val(substr[2]);
             $('.txtMetaDescription').val(substr[3]);
             $('.txtMetaKeywords').val(substr[4]);
             $('#ContentPlaceHolder_taBody').val(substr[5]);
          }
        });
       
    });

</script>
<!--đưa sản phẩm vào cơ sở dữ liệu, một bảng product và 1 bảng images-->
