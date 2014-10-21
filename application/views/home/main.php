<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script  type="text/javascript">	
	
//	$(document).ready(function(){
//            $(".bay").click(function(){
//               if(confirm("Bạn muốn thêm sản phẩm này vào giỏ hàng?")){  
//                var id = jQuery(this).attr("id");
//                 $.ajax({
//                        url : "<?php //echo base_url()?>home/shop",
//                        type: "post",
//                        //dataType : "json",
//                        data : {"id" : id, "value" : 1},
//                        success : function(data){
//                                $("ul#cart_nav").html(data); 
//                        }
//                 });
//                return false;
//            }});
//        });
$("div.pagination>ul>li>a").click().addClass('curent');
</script>
<div id="sidebar" class="grid_3">
	      <aside id="categories_nav">
		     <h3>Danh Mục Sản Phẩm</h3>

		      <nav class="left_menu">
                         <ul><?php if(isset($cats)) {?>
                                <?php foreach ($cats as $cat){?>
                             <li <?php if($this->uri->segment(4) == $cat['slug']) echo "class = 'act'";?>><a href="<?php echo base_url('home/page/'.$this->uri->segment(3)).'/'.$cat['slug'] ?>"><?php echo $cat['name'] ?><span> (<?php echo get_count_cat($cat['id'])?>)</span></a>
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
         <?php  if(!empty($pros)){?>
       <div id="content" class="grid_9">
	      <h1 class="page_title">Danh Sách Sản Phẩm</h1>	    
              <div class="grid_product">
                  
		 
                  <?php foreach ($pros as $pro) { ?><?php //var_dump($pro)?>
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
	       <?php echo $create_links;?>     
	      <div class="clear"></div>      
              <?php }?>	
       </div><!-- #content -->
       <?php if(!empty($pro_page) && $this->uri->segment(4, '') == '') {?>
       <div id="content" class="grid_9">
	      <h1 class="page_title">Danh Sách Sản Phẩm</h1>
	     	      
	      <div class="listing_product"> <?php //var_dump($create_links)?>
			
			<?php foreach ($pro_page as $pro) {?>
                  <div class="product_li">
				<div class="grid_3">
                                        <?php if($pro['discounts'] !== NULL || (int)$pro['discounts'] !== 0){?>
					<img class="sale" src="<?php echo base_url();?>Frontend/images/sale.png" alt="Sale"/>
                                        <?php }?>
                                        <?php  if(!empty($imgs)) { ?>
					<div class="prev">
                                            <a href="<?php $prod = get_pro($pro['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>"><img width="210" height="210" src="<?php $img = get_img($pro['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
					</div><!-- .prev -->
                                        <?php }?>
				</div><!-- .grid_3 -->
				
				<div class="grid_4">
					<div class="entry_content">
						<a href="<?php $prod = get_pro($pro['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>"><h3 class="title"><?php echo $pro['pro_name']?></h3></a>
						<p><?php echo $pro['description'];?></p>
					</div><!-- .entry_content -->
				</div><!-- .grid_4 -->
				
				<div class="grid_2">
					<div class="cart">
						<div class="price">
							<div class="price_new"><?php echo $pro['price']?></div>
                                                        <?php if($pro['discounts'] != NULL && (int)$pro['discounts'] != 0) {?>
                                                        <div class="price_old"><?php echo (($pro['discounts'] + 100)/100*$pro['price'])?></div>
                                                 <?php }?>
						</div>
                                                
						<a href="#" class="bay" id="<?php echo $pro['proid']?>">Thêm Vào Giỏ Hàng</a>
                                                <input id="value" type="hidden" value="1">
						<a href="#" class="obn"></a>
						<a href="#" class="like"></a>
					</div><!-- .cart -->
				</div><!-- .grid_2 -->
				
				<div class="clear"></div>
			</div><!-- .article -->
                        <?php }?>
	    
	      <div class="clear"></div>
	      </div><!-- .listing_product -->
	       <?php echo $create_links;?>     
	      <div class="clear"></div>
	     
       </div><!-- #content -->
       <?php }?> 
      <div class="clear"></div>
      
    </div><!-- .container_12 -->