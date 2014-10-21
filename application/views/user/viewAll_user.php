<title>Shamcey - Metro Style Admin Template</title>
<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/style.default.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/responsive-tables.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>prettify/prettify.js"></script>



<script type="text/javascript">
    jQuery(document).ready(function(){
        // dynamic table
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
        });
        
        jQuery('#dyntable2').dataTable( {
            "bScrollInfinite": true,
            "bScrollCollapse": true,
            "sScrollY": "300px"
        });
        
    });
    if(jQuery('.deleterow').length > 0) {
        jQuery('.deleterow').click(function(){
            var conf = confirm('Continue delete?');
	    if(conf)
                jQuery(this).parents('tr').fadeOut(function(){
		jQuery(this).remove();
		// do some other stuff here
	    });
	    return false;
	});	
    }
    jQuery(document).ready(function(){
    
    prettyPrint();
    
    // check all checkboxes in table
    if(jQuery('.checkall').length > 0) {
	jQuery('.checkall').click(function(){
            var parentTable = jQuery(this).parents('table');										   
            var ch = parentTable.find('tbody input[type=checkbox]');										 
            if(jQuery(this).is(':checked')) {
			
                //check all rows in table
                ch.each(function(){ 
                    jQuery(this).attr('checked',true);
                    jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
                    jQuery(this).parents('tr').addClass('selected'); // to highlight row as selected
                });
			
            } else {
				
		//uncheck all rows in table
		ch.each(function(){ 
                    jQuery(this).attr('checked',false); 
                    jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
                    jQuery(this).parents('tr').removeClass('selected');
		});	
				
	    }
	});
    }
    
    // delete row in a table
    if(jQuery('.deleterow').length > 0) {
        jQuery('.deleterow').click(function(){
            var conf = confirm('Continue delete?');
	    if(conf)
                jQuery(this).parents('tr').fadeOut(function(){
		jQuery(this).remove();
		// do some other stuff here
	    });
	    return false;
	});	
    }
        
});


</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

            <div class="maincontentinner">    
             
            <h4 class="widgettitle">Danh sách tài khoản</h4>
                <table id="dyntable" class="table table-bordered">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                         <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                            <th class="head0">Tài khoản</th>
                            <th class="head1">Tên</th>
                            <th class="head0">Email</th>
                            <th class="head1">Ngày tạo</th>
                            <th class="head0">Quyền</th>
                            <th class="head0">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) {  ?>
                        <tr class="gradeX">
                          <td class="aligncenter"><span class="center">
                            <input type="checkbox" />
                          </span></td>
                            <td><?php echo $user['USRNM'];?></td>
                            <td><?php echo $user['FULL_NAME'];?></td>
                            <td><?php echo $user['EMAIL'];?></td>
                            <td class="center"><?php echo $user['CREATE_USR'];?></td>
                            <td class="center"><?php echo $user['ROLE_ID'];?></td>
                            <td><?php echo btn_edit('dashboard/edit_user/' .$user['USRID']); ?></td>
                            <td><?php echo btn_delete('dashboard/delete_user/' .$user['USRID']); ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            
            
            
            
           
            
            
           
            
            <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2013. Shamcey Admin Template. All Rights Reserved.</span>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="http://themepixels.com/">ThemePixels</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
        
