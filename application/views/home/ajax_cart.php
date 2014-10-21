<?php
echo '<li>';
           if ($cart = $this->cart->contents()): 
              echo '<a class="cart_li" href="">Cart <span>';
              echo $this->cart->total_items();
            echo '</span></a>';
            echo '<ul class="cart_cont">             
              <li class="no_border"><p>Giỏ hàng :';
              echo  number_format($this->cart->total());
              echo ' VNĐ</p></li>';
              $count = 0; foreach ($cart as $item): 
              echo '<li>
                <a href="" class="prev_cart"><div class="cart_vert"><img src="';
               $img = get_img($item['id']); $file = explode('.',$img['file_name']);  if ($img != FALSE) echo base_url().'file/'.$file[0].'_thumb.'.$file[1];
               echo '"alt="" title="" /></div></a>
                <div class="cont_cart">
                  <h4>';
                  $prod = get_pro($item['id']); echo $prod[0]['pro_name'];
                  echo '</h4>
                  <div class="price">';
                  echo $item['qty'].' x '.$item['subtotal'];
                echo '</div>
                </div>
                <a title="close" id="';
                echo $item['rowid'];
                echo '"class="close" href="#"></a>
                <div class="clear"></div>
              </li>';
               endforeach;
	      echo '<li class="no_border">
		<a href="';
               echo base_url();
               echo 'shop/shopping_detail" class="view_cart">Xem giỏ hàng</a>
		<a href="';
               echo base_url();
               echo 'shop/destroy" class="checkout">Hủy giỏ hàng</a>
	      </li>
            </ul>';
              endif;
          echo '</li>';
?>
