<section id="main">
    <div class="container_12">
         
           <div class="grid_9" id="checkout_info">              
               <h1 class="page_title">Cập nhật thông tin tài khoản</h1>
               <ul class="checkout_list"><?php //var_dump($acc)?>
						<form class="registed" method="post" action="<?php echo base_url()?>Site/account"/>
							<h3>Thông tin tài khoản</h3>
							<?php  echo '<div><sup class="surely">'.$this->session->flashdata('message').'</sup></div>';?>
							<?php foreach ($acc as $ac) {?>
                                                        <div class="email">
							<strong>Họ:</strong><sup class="surely">*</sup><br/>
                             <input type="text" name="firstname" class="" value="<?php if(isset($_POST['firstname']) && !empty($_POST['firstname'])) echo $_POST['firstname']; else echo $ac['firstname']?>" /><?php echo form_error('firstname','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .email -->
                                                        
                            <div class="">
								<strong>Tên:</strong><sup class="surely">*</sup><br/>
								<input type="text" name="lastname" class="" value="<?php if(isset($_POST['lastname']) && !empty($_POST['lastname'])) echo $_POST['lastname']; else echo $ac['lastname']?>" /><?php echo form_error('lastname','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .email -->
                                                                                                                
							<div class="">
								<strong>Email Adress:</strong><sup class="surely">*</sup><br/>
								<input type="email" name="email" class="" value="<?php if(isset($_POST['email']) && !empty($_POST['email'])) echo $_POST['email']; else echo $ac['email']?>" /><?php echo form_error('email','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .email -->
							
							
                                                        
                                                        <div class="password">
								<strong>Địa chỉ:</strong><br/>
								<input type="text" name="address" id="address" value="<?php if(isset($_POST['address']) && !empty($_POST['address'])) echo $_POST['address']; else echo $ac['address']?>" />
							</div><!-- .password -->
                                                        
							<div class="submit">										
								<input type="submit" value="Cập nhật" />
							</div><!-- .submit -->
                             <?php }?>
						</form>
						<div class="clear"></div>
			</ul>
                </div><!-- .grid_9 -->
       
       <div class="grid_3" id="sidebar_right">
			<aside id="checkout_progress">
				<h3><?php echo $this->session->userdata['user'];?></h3>
				<ul>
					<li>Cập nhật thông tin<a title="Edit" href="<?php echo base_url()?>Site/account">Edit</a></li>
					<li>Đổi mật khẩu<a title="Edit" href="<?php echo base_url()?>Site/changePass">Edit</a></li>
				</ul>
			</aside>
                </div><!-- #sidebar_right -->         

      <div class="clear"></div>

    </div><!-- .container_12 -->
  </section><!-- #main -->