<?php 
	$img_eff = $custom_tab_options['tab_image_effect'];
	$icon_eff = $custom_tab_options['tab_icon_effect'];
	$tab_id = $custom_tab_options['tab_id'];
	$rand_id = rand(1000,2000);
	
	if ($custom_tab_options['tab_type']=='slider'){
		echo '
			<div class="scroll-img-hor" id="wtslider-'.$rand_id.'">';
			foreach($custom_tab_options['tab_posts'] as $slide)
			{
				$image=wp_get_attachment_image_src( $slide , 'large' );
				//$full_image = wp_get_attachment_image_src( $slide , 'large' );
				echo '<div>
							<img src="'.$image[0].'" alt="'.get_the_title().'"/>
					 </div>';
			}			
         echo '</div>';
	?>
    	<script type='text/javascript'>
		/* <![CDATA[  */                  
			jQuery(document).ready(function() {
				jQuery('#wtslider-<?php echo $rand_id; ?>').slick({ 
					  slidesToShow: 1,
					  slidesToScroll: 1,
					  autoplay: true,
					  speed: 1000,
					  dots: true,
					  pauseOnHover:true
				});
				
				jQuery("a[href=#tab-<?php echo $tab_id; ?>]").click(function(){
					jQuery('#wtslider-<?php echo $rand_id; ?>').unslick();
					setTimeout(function(){
						jQuery('#wtslider-<?php echo $rand_id; ?>').slick({ 
							  slidesToShow: 1,
							  slidesToScroll: 1,
							  autoplay: true,
							  speed: 1000,
							  dots: true,
							  pauseOnHover:true
						});
					},100);	
				});
				
			});
			/* ]]> */
		 </script>         
	<?php
	}else
	{
	
	$column_arr=array('wt_col_2_of_2'=>1,'wt_col_1_of_2'=>2,'wt_col_1_of_3'=>3,'wt_col_1_of_4'=>4);
	$post_count = count($custom_tab_options['tab_posts']);
	$column_name = $custom_tab_options['tab_column'];
	
	$counter =0;
	$i=0;
	while ($counter < $post_count){
		echo '<div class="wt_section wt_group wt-gallerycnt">';
		for ($i=0 ; $i< $column_arr[$custom_tab_options['tab_column']] ; $i++ ){
			if ( $counter < $post_count ){
				$image=wp_get_attachment_image_src( $custom_tab_options['tab_posts'][$counter] , 'medium' );
				$full_image = wp_get_attachment_image_src( $custom_tab_options['tab_posts'][$counter] , 'full' );
				echo '
					<div class="wt_col '. $column_name .' animate  '.get_option('woocommerce_tab_animation_type').'-animation">
						<div class="wt-itemcnt">
							<div class="wt-thumbcnt '.$img_eff.' ">
								<img src="'.$image[0].'" alt="'.get_the_title().'"/>
								<div class="wt-overally fadein-eff ">
									<a href="'.$full_image[0].'" class="wt-zoom-icon '.$icon_eff.' example-image" data-lightbox="image-set"></a>
								</div><!-- wt-overally -->
							</div><!-- wt-thumbcnt -->
						</div><!--wt-itemcnt -->		
					</div>
				';
				$counter++;
			}
			else {
				break;
			}
			
		}//end for
		echo '</div><!--wt_section -->';
	}//end while
	}
?>