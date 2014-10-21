<div class="leftpanel">
        
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Navigation</li>
                <li class="active"><a href=""><span class="iconfa-laptop"></span> Bảng Điều Khiển</a></li>
                <li class="dropdown"><a href=""><span class="iconfa-pencil"></span> Quản Lý Tài Khoản Quản Trị</a>
                	<ul>
                    	<li><a href="<?php echo base_url();?>dashboard/create_user">Tạo Tài Khoản Quản Trị Mới</a></li>
                        <li><a href="<?php echo base_url();?>dashboard/viewAll_user">Thống Kê Tài Khoản Quản Trị</a></li>
                    </ul>
                </li>
                
                <li class="dropdown"><a href=""><span class="iconfa-pencil"></span> Quản Lý Partner</a>
                	<ul>
                    	<li><a href="<?php echo base_url();?>dashboard/create_partner">Tạo Tài Khoản Partner Mới</a></li>
                        <li><a href="<?php echo base_url();?>dashboard/viewAll_partner">Thống Kê Partner</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href=""><span class="iconfa-briefcase"></span> Tìm kiếm giao dịch</a>
                	<ul>
                    	<li><a href="<?php echo base_url();?>dashboard/search_partner">Tìm kiếm theo ID</a></li>
                        <li><a href="<?php echo base_url();?>dashboard/search_partner_date">Tìm kiếm theo thời gian</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->