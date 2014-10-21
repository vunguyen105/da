<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Shamcey - Metro Style Admin Template</title>

<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/bootstrap-fileupload.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/bootstrap-timepicker.min.css" type="text/css" />

<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.autogrow-textarea.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/charCount.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/ui.spinner.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/forms.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.ui.datepicker.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<script> 
    $(document).ready(function(){
        $("#commentForm").validate();
        var dates = $( "#date_from, #date_to" ).datepicker({
            defaultDate: "-1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onSelect: function( selectedDate ) {
                var option = this.id == "date_from" ? "minDate" : "maxDate",
                instance = $( this ).data( "datepicker" );
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });
    });        
</script> 

<div class="maincontentinner">
            
            <div class="widget">
            <h4 class="widgettitle"></h4>
                <div class="widgetcontent wc1">
                    <form id="form1" class="stdform" method="post" action="<?php echo base_url();?>dashboard/search_partner/"/>
                            <div class="par control-group">
                                    <label class="control-label" for="tranid">Mã giao dịch</label>
                                    <div class="controls"><input type="text" name="tranid" id="partnername"  value="<?php if(isset($_POST['tranid'])) echo $_POST['tranid'];?>" class="input-xlarge" /></div>
                            </div>     
                            <p class="stdformbutton">
                                    <button class="btn btn-primary">Tìm kiếm</button>
                            </p>
                </form>
                    <?php if(isset($data['transaction']->result_array[0]) != NULL){ ?>
                        <h4 class="widgettitle">Danh sách giao dịch</h4>
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
                                    <th class="head0">Mã giao dịch</th>
                                    <th class="head0">Loại giao dịch</th>
                                    <th class="head0">Tài khoản</th>
                                    <th class="head0">Đối tác</th>
                                    <th class="head0">Số tiền</th>
                                    <th class="head0">Phí</th>
                                    <th class="head0">Trạng thái</th>
                                    <th class="head1">Thời gian</th>     
                                    <th class="head1">Thời gian gửi lên</th> 
                                    <th class="head1">Thời gian trả về</th> 
                                    <th class="head1">Tài khoản đích</th> 
                                    <th class="head1">Đối tác đích</th>                                 
                                </tr>
                            </thead>
                            <tbody><?php foreach ($data['transaction']->result_array as $transaction) {?>
                                <tr class="gradeX">
                                  <td class="aligncenter"><span class="center">
                                    <input type="checkbox" />
                                  </span></td>
                                  <td><?php echo $transaction['TRANSID'];?></td>
                                    <td><?php echo $transaction['TYPE'];?></td>
                                    <td class="center"><?php echo $transaction['SOURCE_USER_ID'];?></td>
                                    <td><?php echo $transaction['PARTNERID'];?></td>
                                    <td><?php echo $transaction['AMOUNT'];?></td>
                                    <td><?php echo $transaction['FEE_AMOUNT'];?></td>  
                                    <td><?php echo $transaction['STATUS'];?></td>
                                    <td class="center"><?php echo $transaction['TRANSDATE'];?></td>
                                    <td class="center"><?php $timestamp_start = strtotime($transaction['TERMTXTDATETIME']); echo $timestamp_start;//date('Y-m-d H:i:s',$timestamp_start);?></td>
                                    <td class="center"><?php echo $transaction['RESPONSEDATE'];?></td>
                                    <td class="center"><?php echo $transaction['DEST_USER_ID'];?></td>
                                    <td><?php echo $transaction['DESTPARTNERID'];?></td>
                                </tr><?php }?>
                            </tbody>
                        </table>
                    <?php }else echo "<h4 class='widgettitle'>Không tìm thấy giao dịch</h4>"?>
                </div>                    
            </div><!--widget-->                    
            
            <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2013. Shamcey Admin Template. All Rights Reserved.</span>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="http://themepixels.com/">ThemePixels</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->



