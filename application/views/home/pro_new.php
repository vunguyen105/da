<div id="sidebar" class="grid_3">
	      <aside id="categories_nav">
		     <h3>Danh Mục Sản Phẩm</h3>

		     <nav class="left_menu">
                         <ul><?php if(isset($cats)) {?>
                                <?php foreach ($cats as $cat){?>
                             <li><a href="<?php echo base_url('home/page/'.$this->uri->segment(3)).'/'.$cat['slug'] ?>"><?php echo $cat['name'] ?><span> (<?php echo get_count_cat($cat['id'])?>)</span></a>
                                </li>
                         <?php }}?>   
			    </ul>
		     </nav><!-- .left_menu -->
	      </aside><!-- #categories_nav -->

	      <aside id="specials" class="specials">
		     <h3>Sản Phẩm Mới</h3>

                <ul><?php if(!empty($pro_new)) foreach ($pro_new as $pro){?>
			    <li>
				   <div class="prev">
					  <a href="<?php $prod = get_pro($pro['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>">
					  <img src="<?php $img = get_img($pro['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
				   </div>
				   
				   <div class="cont">
					  <a href="<?php $prod = get_pro($pro['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>">
                                              <?php echo $pro['pro_name'];?></a>
                      <div class="prise"><span class="old">
                                              <?php if($pro['discounts'] != NULL && (int)$pro['discounts'] != 0) { echo (($pro['discounts'] + 100)/100*$pro['price'])?>
                                                 <?php }?></span><?php echo $pro['price']?></div>
				   </div>                        
			    </li>
                <?php }?> 
		     </ul>
	      </aside><!-- #specials -->
              
              <aside id="specials" class="specials">
		     <h3>Sản Phẩm Bán Chạy</h3>

                <ul><?php if(!empty($top)) foreach ($top as $pro){?>
			    <li>
				   <div class="prev">
					  <a href="<?php $prod = get_pro($pro['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>">
					  <img src="<?php $img = get_img($pro['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
				   </div>
				   
				   <div class="cont">
					  <a href="<?php $prod = get_pro($pro['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>">
                                              <?php echo $pro['pro_name'];?></a>
                      <div class="prise"><span class="old">
                                              <?php if($pro['discounts'] != NULL && (int)$pro['discounts'] != 0) { echo (($pro['discounts'] + 100)/100*$pro['price'])?>
                                                 <?php }?></span><?php echo $pro['price']?></div>
				   </div>                        
			    </li>
                <?php }?> 
		     </ul>
	      </aside><!-- #specials -->
              
       </div><!-- .sidebar -->
       <div class="container_12">     
         <?php  if(!empty($tops)){?>
       <div id="content" class="grid_9">
	      <h1 class="page_title">Sản phẩm mới</h1>	    
              <div class="grid_product">
                  
		 
                  <?php foreach ($tops as $pro) { ?><?php //var_dump($pro)?>
                  <div class="grid_3 product">
                      <?php if($pro['discounts'] != NULL && (int)$pro['discounts'] != 0){?>
                      <img class="sale" src="<?php echo base_url();?>Frontend/images/sale.png" alt="Sale"/>
                      <?php }?>
                      <div class="prev">
                          <a href="<?php $prod = get_pro($pro['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>"><img width="210" height="210" src="<?php $img = get_img($pro['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
			    </div><!-- .prev -->
                            <h3 class="title"><?php echo $pro['pro_name'];?></h3>
			    <div class="cart">
				   <div class="price">
					  <div class="vert">
						 <div class="price_new"><?php echo $pro['price']?></div>
						 <?php if($pro['discounts'] != NULL && (int)$pro['discounts'] != 0) {?>
                                                        <div class="price_old"><?php echo (($pro['discounts'] + 100)/100*$pro['price'])?></div>
                                                 <?php }?>
					  </div>
				   </div>
				   <a href="#" class="obn"></a>
				   <a href="#" class="like"></a>
                                   <a href="#" class="bay" id="<?php echo $pro['proid']?>"></a>
                                   <input id="value" type="hidden" value="1">
			    </div><!-- .cart -->
		     </div><!-- .grid_3 -->	     
                     <?php }?>	
	       <div class="clear"></div>
	      </div><!-- .listing_product -->
	      <?php echo $this->pagination->create_links();?>   
	      <div class="clear"></div>      
              <?php }?>	
       </div><!-- #content -->
      <div class="clear"></div>
      
    </div><!-- .container_12 -->