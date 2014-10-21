<style type="text/css">
#wrapper {
    width: 800px;
    margin: 20px auto;

}

#nav, #nav ul {
    list-style:  none;
    position: relative;
    line-height: 1.5em;
}

#nav a:link, #nav a:active,
#nav a:visited {
    display: block;
    padding: 0px 5px;
    border: 1px solid #3883cc;
    color: white;
    text-decoration: none;
    background: #3883cc;
}

#nav a:hover {
    background: #fff;
    color: #333;
}

#nav li {
    float: left;
    position: relative;
}

#nav ul {
    position: absolute;
    width: 12em;
    top: 1.5em;
    display: none;
}

#nav li ul a {
    width: 12em;
    float: left;
}

#nav ul ul {
    top: auto;
}

#nav li ul ul {
    left: 12em;
    margin: 0px 0 0 10px;
}

#nav li:hover ul ul, 
#nav li:hover ul ul ul,
#nav li:hover ul ul ul ul {
    display: none;
}

#nav li:hover ul,
#nav li li:hover ul,
#nav li li li:hover ul,
#nav li li li li:hover ul {
    display: block;
}
</style>
<script  type="text/javascript">	

$(document).ready(function(){
    $("#nav li").hover(function(){ 

      $(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400); 
      },function(){ 
      $(this).find('ul:first').css({visibility: "hidden"}); 

    }); 
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
<div class="container_12">
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
            <li><a href="<?php echo base_url();?>Site/account">Quản Lý Tài Khoản</a></li>
		        <li class="separator">|</li>
            <li><a href="">Giỏ Hàng</a></li>
        		<li class="separator">|</li>
            <?php if(!isset($this->session->userdata['user'])) {?>
            <li><a href="<?php echo base_url();?>Site/login">Đăng Nhập</a></li>             
             <?php } else{?> 
		        <li class="separator">|</li>
            <li><a href="<?php echo base_url();?>Site/logout">Đăng Xuất</a></li>
            <?php }?>
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
          <?php  //echo $menu;?> 
        </nav><!-- .primary -->
      </div><!-- .grid_12 -->
    </div><!-- .container_12 -->
  

    <div id="wrapper">
      <?php  echo $menu;?> 
    </div>


    
  </div><!-- .block_nav_primary -->
  <div class="clear"></div>

  <div class="container_12">
    <div class="grid_12">
       <div class="breadcrumbs">
           
       </div><!-- .breadcrumbs -->
    </div><!-- .grid_12 -->
  </div><!-- .container_12 -->

  <div class="clear"></div>