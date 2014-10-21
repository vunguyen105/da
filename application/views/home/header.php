<div class="container_12">
    <div id="top">
      <div class="grid_3">
        <div class="phone_top">
          <span>Liên Hệ <?php  echo "+777 (100) 45454";?></span>
        </div><!-- .phone_top -->
      </div><!-- .grid_3 -->
    </div><!-- #top -->

    <div class="clear"></div>

    <header id="branding">
      <div class="grid_3">
        <hgroup>
            <h1 id="site_logo"><a href="/" title=""><img src="<?php echo base_url();?>Frontend/images/logo.png" alt="Online Store Theme Logo"/></a></h1>
          <h2 id="site_description"><?php echo "Tên trang web";?></h2>
        </hgroup>
      </div><!-- .grid_3 -->

      <div class="grid_3">
        <form class="search">
            <input type="hidden" name="search" class="entry_form" value="" placeholder="Search entire store here..."/>
	</form>
      </div><!-- .grid_3 -->

      <div class="grid_6">
        <ul id="cart_nav">
          <li>
            <a class="cart_li" href="/shopping_cart.html">Cart <span>$0.00</span></a>
            <ul class="cart_cont">
              <li class="no_border"><p>Recently added item(s)</p></li>
              <li>
                <a href="/product_page.html" class="prev_cart"><div class="cart_vert"><img src="<?php echo base_url();?>Frontend/images/cart_img.png" alt="" title="" /></div></a>
                <div class="cont_cart">
                  <h4>Caldrea Linen and Room Spray</h4>
                  <div class="price">1 x $399.00</div>
                </div>
                <a title="close" class="close" href="#"></a>
                <div class="clear"></div>
              </li>
              
              <li>
                <a href="/product_page.html" class="prev_cart"><div class="cart_vert"><img src="<?php echo base_url();?>Frontend/images/produkt_slid1.png" alt="" title="" /></div></a>
                <div class="cont_cart">
                  <h4>Caldrea Linen and Room Spray</h4>
                  <div class="price">1 x $399.00</div>
                </div>
                <a title="close" class="close" href="#"></a>
                <div class="clear"></div>
              </li>
	      <li class="no_border">
		<a href="/shopping_cart.html" class="view_cart">View shopping cart</a>
		<a href="/checkout.html" class="checkout">Procced to Checkout</a>
	      </li>
            </ul>
          </li>
        </ul>

        <nav class="private">
          <ul>
            <li><a href="#">My Account</a></li>
		<li class="separator">|</li>
            <li><a href="#">My Wishlist</a></li>
		<li class="separator">|</li>
            <li><a href="/login.html">Log In</a></li>
		<li class="separator">|</li>
            <li><a href="/login.html">Sign Up</a></li>
          </ul>
        </nav><!-- .private -->
      </div><!-- .grid_6 -->
    </header><!-- #branding -->
  </div><!-- .container_12 -->

  <div class="clear"></div>
  <div id="block_nav_primary">    
       
    <div class="container_12">
        
      <div class="grid_12">
        <nav class="primary">
            
          <a class="menu-select" href="#">Catalog</a>
          <ul>
             <li <?php if(active(1) == '') echo 'class="curent"'; ?>><a href="<?php echo base_url()?>">Trang Chủ</a><?php //echo get_category(2);?></li>
            <?php foreach (get_page() as $p) {?>
                <li <?php if(active(3) == $p['slug']) echo 'class="curent"';?>><a href="<?php echo base_url('home/page/'.$p['slug'])?>"><?php echo $p['name']?></a></li>
            <?php }?>  
            <!--<li><a href="<?php//echo $p['slug']?>"><?php //echo $p['name']?></a><?php //echo get_category($p['id']);?></li>-->            
          </ul>
          
          
    
          
          
          
        </nav><!-- .primary -->
      </div><!-- .grid_12 -->
    </div><!-- .container_12 -->
    
  </div><!-- .block_nav_primary -->
  <div class="clear"></div>

  <div class="container_12">
    <div class="grid_12">
       <div class="breadcrumbs">
           <?php if($this->uri->segment(3, '')){?>
           <a href="<?php echo base_url('home/page/'.$this->uri->segment(3,''))?>"><?php echo get_page_name($this->uri->segment(3, ''))?>
           </a><span>&#8250</span>
           <?php if($this->uri->segment(3, '')){?>
           <a href="<?php echo base_url('home/page/'.$this->uri->segment(3,'').'/'.$this->uri->segment(4,''));?>"><?php echo get_cat_name($this->uri->segment(4, ''))?></a>
           <?php }}?>
           <?php if(!$this->uri->segment(3, '')) {?>
           <a href="<?php echo base_url()?>">Home</a><span>&#8250</span>
           <?php }?>
       </div><!-- .breadcrumbs -->
    </div><!-- .grid_12 -->
  </div><!-- .container_12 -->

  <div class="clear"></div>