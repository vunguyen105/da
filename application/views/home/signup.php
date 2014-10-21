<div class="container_12">      
       <div id="content">
		<div class="grid_12">
			<h1 class="page_title">Đăng ký tài khoản</h1>
		</div><!-- .grid_12 -->
                
                <div class="grid_3" id="sidebar_right">
                </div><!-- #sidebar_right -->
		
		<div class="grid_9" id="checkout_info">
			<ul class="checkout_list">
						<form class="registed" method="post" action="<?php echo base_url()?>Site/signup"/>
							<h3>Đăng ký</h3>
							<p>Nếu bạn đã có tài khoản vui lòng đăng nhập.</p>
							
                                                        <div class="email">
								<strong>Họ:</strong><sup class="surely">*</sup><br/>
								<input type="text" name="firstname" class="" value="<?php echo set_value('firstname'); ?>" /><?php echo form_error('firstname','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .email -->
                                                        
                                                        <div class="email">
								<strong>Tên:</strong><sup class="surely">*</sup><br/>
								<input type="text" name="lastname" class="" value="<?php echo set_value('lastname'); ?>" /><?php echo form_error('lastname','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .email -->
                                                        
                                                        <div class="email">
								<strong>Tài khoản:</strong><sup class="surely">*</sup><br/>
								<input type="text" name="username" class="" value="<?php echo set_value('username'); ?>" /><?php echo form_error('username','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .email -->
                                                                                                                
							<div class="email">
								<strong>Email Adress:</strong><sup class="surely">*</sup><br/>
								<input type="email" name="email" class="" value="<?php echo set_value('email'); ?>" /><?php echo form_error('email','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .email -->
							
							<div class="password">
								<strong>Password:</strong><sup class="surely">*</sup><br/>
								<input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>"/><?php echo form_error('password','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .password -->
                                                        <div class="password">
								<strong>Nhập lại Password:</strong><sup class="surely">*</sup><br/>
								<input type="password" name="cpassword" id="cpassword" value="<?php echo set_value('cpassword'); ?>"/><?php echo form_error('cpassword','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .password -->
                                                        
							<div class="submit">										
								<input type="submit" value="Đăng ký" />
							</div><!-- .submit -->
						</form>
						<div class="clear"></div>
			</ul>
                </div><!-- .grid_9 -->
       </div><!-- #content -->
       
      <div class="clear"></div>
    </div><!-- .container_12 -->