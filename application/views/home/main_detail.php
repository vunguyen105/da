<!--<script language="javascript">
	$(document).ready(function(){
            $(".bay").click(function(){
               if(confirm("Bạn muốn thêm sản phẩm này vào giỏ hàng?")){  
                var id = jQuery(this).attr("id");
                var value = $("#value").val();
                 $.ajax({
                        url : "<?php //echo base_url()?>home/shop",
                        type: "post",
                        //dataType : "json",
                        data : {"id" : id, "value" : value},
                        success : function(data){
                                $("ul#cart_nav").html(data); 
                        }
                 });
                return false;
            }});
        });
	
</script>   -->
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

                     <ul><?php if(!empty($pro_new)) foreach ($pro_new as $pros){?>
			    <li><?php $prod = get_pro($pros['proid']); //var_dump($prod);?>
				   <div class="prev">
					  <a href="<?php $prod = get_pro($pros['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>" class="prev_cart">
                                              <img src="<?php $img = get_img($pros['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
				   </div>

				   <div class="cont">
					  <a href="<?php echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>" class="prev_cart">
                                              <div class="cart_vert">
                                              <?php echo $pros['pro_name'];?></a>
					  <div class="prise"><span class="old">
                                              <?php if($pros['discounts'] != NULL && (int)$pros['discounts'] != 0) { echo (($pros['discounts'] + 100)/100*$pros['price'])?>
                                                 <?php }?></span><?php echo $pros['price']?></div>
				   </div>
			    </li>
                          <?php }?> 
		     </ul>
	      </aside><!-- #specials -->
              <aside id="specials" class="specials">
		     <h3>Sản Phẩm Bán Chạy</h3>

                <ul><?php if(!empty($top)) foreach ($top as $pros){?>
			    <li>
				   <div class="prev">
					  <a href="<?php $prod = get_pro($pros['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>">
					  <img src="<?php $img = get_img($pros['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
				   </div>
				   
				   <div class="cont">
					  <a href="<?php $prod = get_pro($pros['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>">
                                              <?php echo $pros['pro_name'];?></a>
                      <div class="prise"><span class="old">
                                              <?php if($pros['discounts'] != NULL && (int)$pros['discounts'] != 0) { echo (($pros['discounts'] + 100)/100*$pros['price'])?>
                                                 <?php }?></span><?php echo $pros['price']?></div>
				   </div>                        
			    </li>
                <?php }?> 
		     </ul>
	      </aside><!-- #specials -->
       </div><!-- .sidebar -->
       <div id="content" class="grid_9"><?php //var_dump($pro)?>
	      <h1 class="page_title">Chi Tiết Sản Phẩm</h1>
               <?php if(isset($pro[0])) {?>
		<div class="product_page">
                   
                    <div class="grid_4 img_slid" id="products">
                                <?php if($pro[0]['discounts'] != NULL && (int)$pro[0]['discounts'] != 0){?>
                                <img class="sale" src='<?php echo base_url()."Frontend/images/sale.png";?>.'/>
                                <?php }?>
				<div class="preview slides_container">
                                    <div class="prev_bg">
                                                <?php  if(!empty($image)) { ?>
						<a class="jqzoom" rel="gal1" href="<?php echo base_url().'file/'.$image[0]['file_name'];?>">        
							<img src="<?php $file = explode('.',$image[0]['file_name']); echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>"  style="width: 300px; height: 500px" title="" alt=""/>
						</a>
                                                <?php }?>
					</div>
				</div><!-- .prev -->

				<ul class="pagination clearfix" id="thumblist">					
                                        <?php foreach ($image as $im) {?>
					<li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php $file = explode('.',$im['file_name']); echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>?>',largeimage: '<?php echo base_url().'file/'.$im['file_name'];?>'}"><img src='<?php echo base_url().'file/'.$im['file_name'];?>' alt=""></a></li>
                                        <?php }?>
				</ul>

				<div class="next_prev">
					<a id="img_prev" class="arows" href="#"><span>Prev</span></a>
					<a id="img_next" class="arows" href="#"><span>Next</span></a>
				</div><!-- . -->
			</div><!-- .grid_4 -->
                        
			<div class="grid_5">
				<div class="entry_content">
                                    <h1 class="page_title"><?php echo $pro[0]['pro_name']?></h1>
					<p><?php echo truncate($pro[0]['description'],100);?></p>
                                        
					<div class="ava_price">
						<div class="availability_sku">
                                                        <?php if($pro[0]['discounts'] != NULL && (int)$pro[0]['discounts'] != 0) {?>
							<div class="availability">
								Giảm giá: <span></span>
							</div>
                                                        <?php }?>
						</div><!-- .availability_sku -->

						<div class="price">
							<div class="price_new">Giá: <?php echo $pro[0]['price']?></div>
							<?php if($pro[0]['discounts'] != NULL && (int)$pro[0]['discounts'] != 0) {?>
                                                        <div class="price_old"><?php echo (($pro[0]['discounts'] + 100)/100*$pro[0]['price'])?></div>
                                                        <?php }?>
						</div><!-- .price -->
					</div><!-- .ava_price -->

					<div class="block_cart">
						<div class="obn_like">
							<div class="obn"><a href="#" class="obn"></a></div>
						</div>

						<div class="cart">
                                                    <a id="<?php echo $pro[0]['proid']?>"href="#" class="bay">Thêm giỏ hàng</a>
                                                   <input type="text" name="value" id="value" class="number" value="1" />
                                                    <span>Số Lượng : </span>
						</div>
						<div class="clear"></div>
					</div><!-- .block_cart -->
				</div><!-- .entry_content -->

			</div><!-- .grid_5 -->
			<div class="clear"></div>
                        
			<div class="grid_9" >
				<div id="wrapper_tab" class="tab1">
					<a href="#" class="tab1 tab_link">Chi Tiết Sản Phẩm</a>                                           
					<div class="clear"></div>
                                        <div class="tab1 tab_body">
						<h4>Chi Tiết Sản Phẩm</h4>
						<p><?php echo $pro[0]['description'];?></p>

					<div class="clear"></div>
					</div><!-- .tab1 .tab_body -->
					<div class="clear"></div>
				</div><!-- #wrapper_tab -->
				<div class="clear"></div>
			</div><!-- .grid_9 -->
                     
			<div class="clear"></div>
                        <?php if(!empty($pro_detail)) {?>
			<div class="related">
				<div class="c_header">
					<div class="grid_7">
						<h2>Sản Phẩm Liên Quan</h2>
					</div><!-- .grid_7 -->

					<div class="grid_2">
						<a id="next_c1" class="next arows" href="#"><span>Next</span></a>
						<a id="prev_c1" class="prev arows" href="#"><span>Prev</span></a>
					</div><!-- .grid_2 -->
				</div><!-- .c_header -->

				<div class="list_carousel">

				<ul id="list_product" class="list_product">
                                    <?php foreach($pro_detail as $pro) {?>
					<li class="">
						<div class="grid_3 product">
                                                        <?php if($pro['discounts'] != NULL && (int)$pro['discounts'] != 0){?>
							<img class="sale" src="<?php echo base_url();?>Frontend/images/sale.png" alt="Sale"/>
                                                        <?php }?>   
							<div class="prev">
								<a href="<?php $prod = get_pro($pro['proid']);echo base_url('home/page/'.$prod[0]['page_slug'].'/'.$prod[0]['slug']).'/'.url_title(convert_accented_characters($prod[0]['proid'].'-'.$prod[0]['alias'])).'.html' ?>">
                                                                <img src="<?php $img = get_img($pro['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
							</div><!-- .prev -->
							<h3 class="title"><?php echo $pro['pro_name'];?></h3>
							<div class="cart">
								<div class="price">
									<div class="vert">
										<div class="price_new"><?php echo $pro['price']?></div>
                                                                                <?php if($pro['discounts'] != NULL && (int)$pro['discounts'] != 0) {?>
										<div class="price_old">$725.00</div>
                                                                                <?php }?>
									</div>
								</div>
								<a href="#" class="obn"></a>
								<a href="#" class="like"></a>
								<a href="#" class="bay" id="<?php echo $pro['proid']?>"></a>
                                                                <input id="value" type="hidden" value="1">
							</div><!-- .cart -->
						</div><!-- .grid_3 -->
					</li>
                                            <?php }?>
			        </ul><!-- #list_product -->
				</div><!-- .list_carousel -->
			</div><!-- .carousel -->
                        <?php }?>
		</div><!-- .product_page -->
               <?php }?>
		<div class="clear"></div>

       </div><!-- #content -->