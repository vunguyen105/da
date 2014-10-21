<div class="container_12">
    <?php if(!empty($slide)){?>
    <div class="grid_12">
        <div class="slidprev"><span>Prev</span></div>
        <div class="slidnext"><span>Next</span></div>
              
        <div id="slider">
        <?php foreach ($slide as $s){?> 
         <div class="slide">
            <img src="<?php echo base_url().'file/'.$s['file_name'];?>" alt="" title="" />
            <div class="slid_text">
              <?php if(!empty($s['title'])) {?><h3 class="slid_title"><span><?php echo $s['title']?></span></h3><?php }?>
              <?php if(!empty($s['text1'])) {?><p><span><?php echo $s['text1']?></span></p><?php }?>
              <?php if(!empty($s['text2'])) {?><p><span><?php echo $s['text2']?></span></p><?php }?>
              <?php if(!empty($s['text3'])) {?><p><span><?php echo $s['text3']?></span></p><?php }?>
            </div>
          </div>
          <?php }?>  
        </div><!-- .slider -->
        <div class="clear"></div>
        
        <div id="myController">
          <div class="control"><span>1</span></div>
          <div class="control"><span>2</span></div>
          <div class="control"><span>3</span></div>
        </div>
        
    </div><!-- .grid_12 -->
    <?php }?>
</div><!-- .container_12 -->

  <div class="clear"></div>

  <section id="main" class="home">
    <div class="container_12">
      <div id="top_button">
        <div class="grid_4">
          <a id="" href="<?php echo base_url();?>Site/best_price" class="button_block best_price">
              <img  src="<?php echo base_url();?>Frontend/images/banner1.png" alt="Giảm giá"/>
          </a><!-- .best_price -->
        </div><!-- .grid_4 -->

        <div class="grid_4">
          <a id="" href="<?php echo base_url();?>Site/pro_new" class="button_block new_smells">
            <img src="<?php echo base_url();?>Frontend/images/banner2.png" alt="New"/>
          </a><!-- .new smells -->
        </div><!-- .grid_4 -->

        <div class="grid_4">
          <a id="" href="<?php echo base_url();?>Site/pro_hot" class="button_block only_natural">
            <img src="<?php echo base_url();?>Frontend/images/banner3.png" alt="Bán chạy"/>
          </a><!-- .only_natural -->
        </div><!-- .grid_4 -->

        <div class="clear" ></div>
      </div><!-- #top_button -->
<!--            <div class="clear"></div>-->

      <div id="best_price" class="carousel">
        <?php if(!empty($pro_price)) {?>
        <div class="c_header">
          <div class="grid_10">
            <h2>Sản phẩm khuyến mại</h2>
          </div><!-- .grid_10 -->

          <div class="grid_2">
            <a id="next_c1" class="next arows" href="#"><span>Next</span></a>
            <a id="prev_c1" class="prev arows" href="#"><span>Prev</span></a>
           </div><!-- .grid_2 -->
        </div><!-- .c_header -->

        <div class="list_carousel">

        <ul id="list_product" class="list_product">
          <?php foreach($pro_price as $pro) {?>  
          <li class="">
            <div class="grid_3 product">
              <img class="sale" src="<?php echo base_url();?>Frontend/images/sale.png" alt="Sale"/>
              <div class="prev">
                <a href="<?php echo base_url('home/page/'.$pro['page_slug'].'/'.$pro['slug']).'/'.url_title(convert_accented_characters($pro['proid'].'-'.$pro['alias'])).'.html' ?>"><img src="<?php $img = get_img($pro['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
              </div><!-- .prev -->
              <h3 class="title"><?php echo $pro['pro_name']?></h3>
              <div class="cart">
                <div class="price">
                <div class="vert">
                  <div class="price_new"><?php echo $pro['price']?></div>
                  <div class="price_old"><?php echo (($pro['discounts'] + 100)/100*$pro['price'])?></div>
                </div>
                </div>
                <a href="#" class="obn"></a>
                <a href="#" class="like"></a>
                <a href="#" class="bay" id="<?php echo $pro['proid']?>"></a>
              </div><!-- .cart -->
            </div><!-- .grid_3 -->
          </li>
          <?php }?>
        </ul><!-- #list_product -->
        </div><!-- .list_carousel -->
        <?php }?> 
      </div><!-- .carousel -->      
      <?php if(!empty($pro_new)) {?>
      <div id="new_smells" class="carousel" style="margin-top : -61px;">
        <div class="c_header">
          <div class="grid_10">
            <h2>Sản phẩm mới nhất</h2>
          </div><!-- .grid_10 -->
          <div class="grid_2">
            <a id="next_c2" class="next arows" href="#"><span>Next</span></a>
            <a id="prev_c2" class="prev arows" href="#"><span>Prev</span></a>
          </div><!-- .grid_2 -->
        </div><!-- .c_header -->

        <div class="list_carousel">
        <ul id="list_product2" class="list_product">
          
          <?php foreach($pro_new as $pro){ //echo "<pre>"; var_dump($pro);die;?>  
          <li class="">
            <div class="grid_3 product">
              <?php if($pro['discounts'] != NULL && (int)$pro['discounts'] != 0){?>  
              <img class="sale" src="<?php echo base_url();?>Frontend/images/sale.png" alt="Sale"/>
              <?php }?>
              <div class="prev">
                <a href="<?php echo base_url('home/page/'.$pro['page_slug'].'/'.$pro['slug']).'/'.url_title(convert_accented_characters($pro['proid'].'-'.$pro['alias'])).'.html' ?>"><img src="<?php $img = get_img($pro['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
              </div><!-- .prev -->
              <h3 class="title"><?php echo $pro['pro_name']?></h3>
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
              </div><!-- .cart -->
            </div><!-- .grid_3 -->
          </li>
          <?php }?>
        </ul><!-- #list_product2 -->
        </div><!-- .list_carousel -->
      </div><!-- .carousel -->
      <?php }?>    
      <?php if(!empty($top))  {?>
      <div id="new_smells" class="carousel"style="margin-top : -61px;">
        <div class="c_header">
          <div class="grid_10">
            <h2>Sản phẩm bán chạy</h2>
          </div><!-- .grid_10 -->

          <div class="grid_2">
            <a id="next_c3" class="next arows" href="#"><span>Next</span></a>
            <a id="prev_c3" class="prev arows" href="#"><span>Prev</span></a>
          </div><!-- .grid_2 -->
        </div><!-- .c_header -->

        <div class="list_carousel">
        <ul id="list_product3" class="list_product">
          
          <?php foreach($top as $pro){?>  
          <li class="">
            <div class="grid_3 product">
              <?php if($pro['discounts'] != NULL && (int)$pro['discounts'] != 0){?>  
              <img class="sale" src="<?php echo base_url();?>Frontend/images/sale.png" alt="Sale"/>
              <?php }?>
              <div class="prev">
                <a href="<?php echo base_url('home/page/'.$pro['page_slug'].'/'.$pro['category_slug']).'/'.url_title(convert_accented_characters($pro['proid'].'-'.$pro['alias'])).'.html' ?>"><img src="<?php $img = get_img($pro['proid']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];?>" alt="" title="" /></a>
              </div><!-- .prev -->
              <h3 class="title"><?php echo $pro['pro_name']?></h3>
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
              </div><!-- .cart -->
            </div><!-- .grid_3 -->
          </li>
          <?php }?>
        </ul><!-- #list_product2 -->
        </div><!-- .list_carousel -->
      </div><!-- .carousel -->
      <?php }?>
      <div class="clear"></div>

    </div><!-- .container_12 -->
  </section><!-- #main -->