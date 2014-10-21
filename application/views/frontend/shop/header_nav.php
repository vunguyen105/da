<script  type="text/javascript">	

$(document).ready(function(){
            $('.close').live('click', function(e) {
               e.preventDefault();
               if(confirm("Bạn muốn xóa sản phẩm này khỏi giỏ hàng?")){  
                var id = jQuery(this).attr("id");
                //alert(id);
                 $.ajax({
                        url : "<?php echo base_url()?>home/remove",
                        type: "post",
                        //dataType : "json",
                        data : {"id" : id},
                        success : function(data){
                                $("ul#cart_nav").html(data); 
                        }
                 });
                return false;
            }});
       $(".bay").click(function(){
               if(confirm("Bạn muốn thêm sản phẩm này vào giỏ hàng?")){  
                var id = jQuery(this).attr("id");
                var value = 1;
                
                if($("#value").val() != '') var value = $("#value").val();
                if(value == undefined) value = 1;
                //alert(value);
                 $.ajax({
                        url : "<?php echo base_url()?>home/shop",
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
</script>
<div class="container_12"><?php //var_dump($data);?>
    <header id="branding">
      <div id="cart" class="grid_6">
        <ul id="cart_nav">
            <li>
              <a class="cart_li" href="">Cart <span></span></a>
            <ul class="cart_cont">
             
                <li class="no_border"><p>Giỏ hàng: VNĐ</p></li>
          
              <li>
                  <a href="" class="prev_cart"><div class="cart_vert"><img src="" alt="" title="" /></div></a>
                <div class="cont_cart">
                  <h4></h4>
                  <div class="price"></div>
                </div>
                <a title="close" id="" class="close" href="#"></a>
                <div class="clear"></div>
              </li>
              
	      <li class="no_border">
                  <a href="" class="view_cart">Xem giỏ hàng</a>
		<a href="" class="checkout">Hủy giỏ hàng</a>
	      </li>
            </ul>
             
          </li>
        </ul>

        <nav class="private">
          <ul>
            <li><a href="">Quản Lý Tài Khoản</a></li>
		<li class="separator">|</li>
                
            <li><a href="">Giỏ Hàng</a></li>
            		<li class="separator">|</li>
                <li><a href="">Đăng Nhập</a></li>             
              
		<li class="separator">|</li>
            <li><a href="">Đăng Xuất</a></li>
            
          </ul>
        </nav><!-- .private -->
      </div><!-- .grid_6 -->
    </header><!-- #branding -->
  </div><!-- .container_12 -->
<?php //$check_cart = check_cart(47);echo "<pre>";var_dump($check_cart);?>
  <div class="clear"></div>
  <div id="block_nav_primary">    
       
    <div class="container_12">
        
      <div class="grid_12">
        <nav class="primary">
            
          <a class="menu-select" href="#">Catalog</a>
          <ul>
             <li><a href="">Trang Chủ</a></li>
             <li><a href=""></a></li>
<!--            <li><a href="<?php //echo $p['slug']?>"><?php //echo $p['name']?></a><?php //echo get_category($p['id']);?></li>            -->
          </ul>                                                  
        </nav><!-- .primary -->
      </div><!-- .grid_12 -->
    </div><!-- .container_12 -->
    
  </div><!-- .block_nav_primary -->
  <div class="clear"></div>

  <div class="container_12">
    <div class="grid_12">
       <div class="breadcrumbs">
           
       </div><!-- .breadcrumbs -->
    </div><!-- .grid_12 -->
  </div><!-- .container_12 -->

  <div class="clear"></div>