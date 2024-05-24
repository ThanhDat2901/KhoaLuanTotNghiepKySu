<div class="header_bottom">
		<div class="header_bottom">
		<div class="clear"></div>
		</div>
			 <div class="header_bottom_images">
		   <!-- FlexSlider -->
			<section class="slider" style="width: 100%;">
				  <div class="flexslider">
					<ul class="slides">
						<?php
						$get_slider = $product->show_slider();
						if($get_slider){
							while($result_slider = $get_slider->fetch_assoc()){
						 ?>
						<li><img src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt="<?php echo $result_slider['sliderName'] ?>"/></li>
						<?php
							}
						}
						 ?>
				    </ul>
				  </div>
	      </section> 
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
 </div>