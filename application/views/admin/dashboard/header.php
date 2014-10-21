<div class="header"><?php //var_dump($data);?>
        <div class="logo">
            <a href=""><img src="" alt="" /></a>
        </div>
        <div class="headerinner">
            <ul class="headmenu">
                <li class="odd">
                    <a class="dropdown-toggle" href="<?php echo base_url();?>/dashboard/create_partner">
                        <span class="head-icon head-partner"></span>
                        <span class="headmenu-label">New Partner</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-toggle" href="<?php echo base_url();?>/dashboard/create_user">
                    <span class="head-icon head-users"></span>
                    <span class="headmenu-label">New Users</span>
                    </a>
                    <ul class="dropdown-menu newusers">
                        <li class="nav-header">New Users</li>
                    </ul>
                </li>
                <li class="odd">
                    <a class="dropdown-toggle" href="<?php echo base_url();?>/dashboard/search_partner_date">
                    <span class="head-icon head-bar"></span>
                    <span class="headmenu-label">Search</span>
                    </a>
                </li>
                <li class="right">
                    <div class="userloggedinfo">
                        <img src="<?php echo base_url();?>/public_html/images/photos/SonGoku-kid.gif" alt="" />
                        <div class="userinfo">
                            <h5><?php echo $this->session->userdata['full_name'];?><small>-<?php echo $this->session->userdata['email'];?></small></h5>
                            <ul>
                                <li><a href="editprofile.html">Chỉnh sửa trang cá nhân</a></li>
                                <li><a href="">Thiết lập tài khoản</a></li>
                                <li><a href="<?php echo base_url();?>home_page/logout/create_partner">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!--headmenu-->
        </div>
    </div>