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
</script>
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
                            <th class="head0">ID của đối tác</th>
                            <th class="head0">Tên đối tác</th>
                            <th class="head0">Ngày tạo</th>
                            <th class="head0">Trạng thái</th>
                            <th class="head0">Key của đối tác</th>
                            <th class="head0">Code của đối tác</th>
                            <th class="head1">Số ngày đảo</th>                            
                            <th class="head1">Thao tác</th>     
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($partners as $partner) {  ?>
                        <tr class="gradeX">
                          <td class="aligncenter"><span class="center">
                            <input type="checkbox" />
                          </span></td>
                            <td><?php echo $partner['PARTNERID'];?></td>
                            <td><?php echo $partner['PARTNERNAME'];?></td>
                            <td class="center"><?php echo $partner['CREATE_DATE'];?></td>
                            <td class="center"><?php echo $partner['PSTATUS'];?></td>
                            <td><?php echo $partner['PARTNERKEY'];?></td>
                            <td><?php echo $partner['PARTNERCODE'];?></td>
                            <td class="center"><?php echo $partner['NUMDAYFORREVERT'];?></td>
                            <td><?php echo btn_edit('dashboard/edit_partner/'.$partner['PARTNERID']); ?></td>
                            <td><?php echo btn_delete('dashboard/delete_partner/'.$partner['PARTNERID']); ?></td>
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