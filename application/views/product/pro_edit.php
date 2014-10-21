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
                <div class="caption"><i class="icon-globe"></i>Sửa sản phẩm</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <?php if (!empty($product)) { ?>
                        <div class="control-group">
                            <label class="control-label">Tên sản phẩm</label>
                            <div class="controls">
                                <input name="title" type="text" class="span6 m-wrap" value="<?php if (!empty($_POST['pro_name']))
                        echo $_POST['pro_name'];
                    else
                        echo $product['pro_name']
                        ?>" >                            
                            </div>
                            <label class="control-label">Giá</label>
                            <div class="controls">
                                <input name="price" type="number" class="span6 m-wrap" value="<?php if (!empty($_POST['price']))
                        echo $_POST['price'];
                    else
                        echo $product['price']
                            ?>">                            
                            </div>
                            <label class="control-label">Giảm Giá</label>
                            <div class="controls">
                                <input name="discounts" type="number" class="span6 m-wrap" value="<?php if (!empty($_POST['discounts']))
                                   echo $_POST['discounts'];
                               else
                                   echo $product['discounts']
                                   ?>">                            
                            </div>
                            <label class="control-label">Số lượng</label>
                            <div class="controls">
                                <input name="qty" type="number" class="span6 m-wrap" value="<?php if (!empty($_POST['qty']))
                                   echo $_POST['qty'];
                               else
                                   echo $product['qty']
                                   ?>">                            
                            </div>
                            <label class="control-label">Thời gian bảo hành</label>
                            <select id="baohanh">
                                <option value="">Chọn thư mục</option>>
                                <option id="baohanh1" value="6">6 tháng</option>
                                <option id="baohanh2" value="12">12 tháng</option>
                                <option id="baohanh3" value="24">24 tháng</option>
                            </select>
    <?php if (!empty($cats)) { ?>
                                <label class="control-label">Thuộc thư mục</label>
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
                        <label>Mô tả sản phẩm</label>
                        <div class="row-fluid tab-content" id="content">
                            <textarea id="demo" name="demo"><?php echo $product['description'] ?></textarea>
                        </div>
    <?php echo $ckediter; ?>
                        <hr class="clearfix">
                        <label>Thông số kỹ thuật</label>
                        <div class="row-fluid tab-content" id="content">
                            <textarea id="demo1" name="demo1"><?php echo $product['technique'] ?></textarea>
                        </div>
    <?php echo $ckediter1; ?>
                        <hr class="clearfix"> 
                        <div id="ufile" class="btn-group">
                            <button id="ufile" name="ufile" onclick="BrowseServer()" class="btn blue"><i class="icon-plus"></i> Quản lý ảnh</button>
                        </div>
                        <hr class="clearfix">
                        <div class="row-fluid">
                            <?php if(!empty($imgs)){?>
                            <ul style="position: relative; overflow: hidden;" class="listfile isotope" id="imges">
                                <?php foreach ($imgs as $key => $value){?>
                                <li class="image isotope-item">
                                    <a class="cboxElement" data-link="<?php echo $value['file_name']?>" href="<?php  echo base_url().'media/123/_thumbs/'.$value['file_name'];?>">
                                        <img src="<?php  echo base_url().'media/123/_thumbs/'.$value['file_name'];?>" alt=""></a><span class="filename"><?php  echo $value['file_name'];?><a class="icon-trash"></a></span>
                                </li>
                                <?php }?>
                            </ul>
                            <?php }?>
                        </div>

                        <div class="form-actions">
                            <button class="btn blue" id="save" type="submit"><i class="icon-ok"></i> Save</button>
                            <button class="btn" type="button">Cancel</button>
                        </div>
<?php } ?>
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
        BootstrapDialog.confirm('Thông báo', 'Bạn muốn thêm sản phẩm này', function(result) {
            if (result) {
                var title = $("input[name='title']").val();
                var price = $("input[name='price']").val();
                var discounts = $("input[name='discounts']").val();
                var qty = $("input[name='qty']").val();
                var baohanh = $('#baohanh option:selected').val();
                var cat = $("#standard").val();
                var objEditor = CKEDITOR.instances["demo"];
                var descr = objEditor.getData();
                var objEditor1 = CKEDITOR.instances["demo1"];
                var technique = objEditor1.getData();

                //alert(technique);
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
                        price: price,
                        discounts: discounts,
                        qty: qty,
                        baohanh: baohanh,
                        technique: technique,
                        descr: descr,
                        cat: cat,
                        imgs: array_anh
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