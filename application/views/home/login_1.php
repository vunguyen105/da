<div class="container_12">      
       <div id="content">
		<div class="grid_12">
			<h1 class="page_title">Đăng ký tài khoản</h1>
		</div><!-- .grid_12 -->
		
		<div class="grid_6 new_customers">
			<h2>Đăng ký tài khoản</h2>
			<p>Đăng ký tài khoản để đăng nhập và đặt hàng trực tuyến.</p>
			<div class="clear"></div>
                        <div class="submit">										
					<a href="<?php echo base_url()?>Site/signup">Tạo tài khoản mới</a>
                        </div>
                </div><!-- .grid_6 -->
		
		<div class="grid_6">
                    <form class="registed" method="post" action="<?php echo base_url()?>Site/login"/>
				<h2>Đăng nhập</h2>
							
				<p>Nếu bạn đã có tài khoản vui lòng đăng nhập.</p>
				<?php  echo '<div><sup class="surely">'.$this->session->flashdata('message').'</sup></div>';?>			
				<div class="email">
					<strong>Tài khoản:</strong><sup class="surely">*</sup><br/>
                                        <input type="text" name="username" id="username"class="" value="<?php echo set_value('username'); ?>" />
				</div><!-- .email -->
							
				<div class="password">
					<strong>Mật khẩu:</strong><sup class="surely">*</sup><br/>
                                        <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>"/>
				</div><!-- .password -->
				
				<div class="remember">
					<input class="niceCheck" type="checkbox" name="Remember_password" />
					<span class="rem">Ghi nhớ mật tài khoản</span>
				</div><!-- .remember -->
				<?php echo validation_errors('<div><sup class="surely">* ','</sup></div>'); ?>
				<div class="submit">										
					<input type="submit" value="Đăng nhập" />
				</div><!-- .submit -->
			</form><!-- .registed -->
                        
                </div><!-- .grid_6 -->
       </div><!-- #content -->
       
      <div class="clear"></div>
    </div><!-- .container_12 -->