<section id="main">
    <div class="container_12">
         
           <div class="grid_9" id="checkout_info">              
               <h1 class="page_title">Đổi mật khẩu</h1>
               <ul class="checkout_list">
						<form class="registed" method="post" action="<?php echo base_url()?>Site/changePass"/>
							<h3>Đổi mật khẩu mới</h3>
							<?php  echo '<div><sup class="surely">'.$this->session->flashdata('message').'</sup></div>';?>
							
							<div class="password">
								<strong>Mật khẩu cũ</strong><sup class="surely">*</sup><br/>
								<input type="password" name="passw" id="passw" value="<?php if(isset($_POST['passw']) && !empty($_POST['passw'])) echo $_POST['passw'];?>" /><?php echo form_error('passw','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .password -->
                            
                            <div class="password">
								<strong>Mật khẩu mới</strong><sup class="surely">*</sup><br/>
								<input type="password" name="passnew" id="passnew" value="<?php if(isset($_POST['passnew']) && !empty($_POST['passnew'])) echo $_POST['passnew'];?>" /><?php echo form_error('passnew','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .password -->
                                                    
                            <div class="password">
								<strong>Nhập lại mật khẩu mới</strong><sup class="surely">*</sup><br/>
								<input type="password" name="passnewc" id="passnewc" value="<?php if(isset($_POST['passnewc']) && !empty($_POST['passnewc'])) echo $_POST['passnewc'];?>" /><?php echo form_error('passnewc','<div><sup class="surely">* ','</sup></div><br>'); ?>
							</div><!-- .password -->
							
							<div class="submit">										
								<input type="submit" value="Login" />
							</div><!-- .submit -->
						</form>
						<div class="clear"></div>
			</ul>
                </div><!-- .grid_9 -->
       
       <div id="sidebar" class="grid_3">
	      <aside id="checkout_progress">
				<h3><?php echo $this->session->userdata['user'];?></h3>
				<ul>
					<li>Cập nhật thông tin<a title="Edit" href="<?php echo base_url()?>Site/account">Edit</a></li>
					<li>Đổi mật khẩu<a title="Edit" href="<?php echo base_url()?>Site/changePass">Edit</a></li>
				</ul>
			</aside>

	     	      
       </div><!-- #sidebar -->

      <div class="clear"></div>

    </div><!-- .container_12 -->
  </section><!-- #main -->