<div id="sidebar" class="grid_3">
	      <aside id="categories_nav">
		     <h3>Categories</h3>

		     <nav class="left_menu">
                         <ul><?php if(isset($cats)) {?>
                                <?php foreach ($cats as $cat){?>
                             <li><a href="<?php echo base_url('home/page/'.$this->uri->segment(3)).'/'.$cat['slug'] ?>"><?php echo $cat['name'] ?><span>(<?php echo get_count_cat($cat['id'])?>)</span></a>
                                </li>
                         <?php }}?>   
			    </ul>
		     </nav><!-- .left_menu -->
	      </aside><!-- #categories_nav -->

	      <aside id="specials" class="specials">
		     <h3>Specials</h3>

		     <ul>
			    <li>
				   <div class="prev">
					  <a href="#"><img src="<?php echo base_url();?>Frontend/images/special1.png" alt="" title="" /></a>
				   </div>

				   <div class="cont">
					  <a href="#">Honeysuckle Flameless Luminary Refill</a>
					  <div class="prise"><span class="old">$177.00</span>$75.00</div>
				   </div>
			    </li>

			    <li>
				   <div class="prev">
					  <a href="#"><img src="<?php echo base_url();?>Frontend/images/special2.png" alt="" title="" /></a>
				   </div>

				   <div class="cont">
					  <a href="#">Honeysuckle Flameless Luminary Refill</a>
					  <div class="prise"><span class="old">$177.00</span>$75.00</div>
				   </div>
			    </li>
		     </ul>
	      </aside><!-- #specials -->

	      <aside id="newsletter_signup">
		     <h3>Newsletter Signup</h3>
		     <p>Phasellus vel ultricies felis. Duis
		     rhoncus risus eu urna pretium.</p>

		     <form class="newsletter">
			    <input type="email" name="newsletter" class="your_email" value="" placeholder="Enter your email address..."/>
			    <input type="submit" id="submit" value="Subscribe" />
		     </form>
	      </aside><!-- #newsletter_signup -->

	      <aside id="banners">
		<a id="ban_next" class="next arows" href="#"><span>Next</span></a>
		<a id="ban_prev" class="prev arows" href="#"><span>Prev</span></a>

		<h3>Banners</h3>

		<div class="list_carousel">
			<ul id="list_banners">
				<li class="banner"><a href="#">
					<div class="prev">
						<img src="<?php echo base_url();?>Frontend/images/banner.png" alt="" title="" />
					</div><!-- .prev -->

					<h2>New smells</h2>

					<p>in the next series</p>
 			        </a></li>

				<li class="banner"><a href="#">
					<div class="prev">
						<img src="<?php echo base_url();?>Frontend/images/banner.png" alt="" title="" />
					</div><!-- .prev -->

					<h2>New smells</h2>

					<p>in the next series</p>
 			        </a></li>

				<li class="banner"><a href="#">
					<div class="prev">
						<img src="<?php echo base_url();?>Frontend/images/banner.png" alt="" title="" />
					</div><!-- .prev -->

					<h2>New smells</h2>

					<p>in the next series</p>
 			        </a></li>

			</ul>
		</div><!-- .list_carousel -->
	      </aside><!-- #banners -->

	      <aside id="tags">
		     <h3>Tags</h3>
		     <a class="t1" href="">california</a>
		     <a class="t2" href="">canada</a>
		     <a class="t3" href="">canon</a>
		     <a class="t4" href="">cat</a>
		     <a class="t5" href="">chicago</a>
		     <a class="t6" href="">christmas</a>
		     <a class="t7" href="">mars</a>
		     <a class="t8" href="">church</a>
		     <a class="t9" href="">city</a>
		     <a class="t10" href="">clouds</a>
		     <a class="t11" href="">color</a>
		     <a class="t12" href="">concert</a>
		     <a class="t13" href="">dance</a>
		     <a class="t14" href="">day</a>
		     <a class="t15" href="">dog</a>
		     <a class="t16" href="">england</a>
		     <a class="t17" href="">europe</a>
	      </aside><!-- #community_poll -->
       </div><!-- .sidebar -->