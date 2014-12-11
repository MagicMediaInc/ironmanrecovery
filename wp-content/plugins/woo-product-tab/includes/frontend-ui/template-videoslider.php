<?php 
	$video_height = $custom_tab_options['tab_video_height'];
	$tab_id = $custom_tab_options['tab_id'];
	$rand_id = rand(1000,2000);
	
	if ($custom_tab_options['tab_type']=='slider'){
		echo '<div class="scroll-img-hor " id="wtvideoslider-'.$rand_id.'">';
               		
		foreach($custom_tab_options['tab_posts'] as $slide)
		{
			$video_type = pathinfo($slide['video']);
			$image=wp_get_attachment_image_src( $slide['thumb'] , 'large' );
			echo '<div>';
            if ($slide['embed']!='on'){        	
					echo	'<video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="100%" height="'.$custom_tab_options['tab_video_height'].'" 
                              poster="'.(isset($image[0]) ? $image[0]: '').'"
                              data-setup="{}">
                            <source src="'.$slide['video'].'" type="video/'.$video_type['extension'].'" />
                            <p class="vjs-no-js">'.__('To view this video please enable JavaScript, and consider upgrading to a web browser that',EXTRA_WOO_TABS_TEXTDOMAN).' <a href="http://videojs.com/html5-video-support/" target="_blank">'.__('supports HTML5 video',EXTRA_WOO_TABS_TEXTDOMAN).'</a></p>
                        </video>
                    ';
			}else{
				echo '<iframe id="player_1" src="'.$slide['video'].'" width="100%" height="'.$custom_tab_options['tab_video_height'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			}
			echo '</div>';
		}			
         echo '</div>';
	?>
    	<script type='text/javascript'>
		/* <![CDATA[  */                  
			jQuery(document).ready(function() {
				jQuery('#wtvideoslider-<?php echo $rand_id; ?>').slick({ 
					slidesToShow: 1,
					slidesToScroll: 1,
					autoplay: true,
					speed: 1000,
					dots: true,
					pauseOnHover:true
				});
				jQuery("a[href=#tab-<?php echo $tab_id; ?>]").click(function(){
					jQuery('#wtvideoslider-<?php echo $rand_id; ?>').unslick();
					setTimeout(function(){
						jQuery('#wtvideoslider-<?php echo $rand_id; ?>').slick({ 
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
	}
	else if ($custom_tab_options['tab_type']=='grid'){
		$column_arr=array('wt_col_2_of_2'=>1,'wt_col_1_of_2'=>2);
		$post_count = count($custom_tab_options['tab_posts']);
		$column_name = $custom_tab_options['tab_column'];
		$counter =0;
		$i=0;
		while (($counter < $post_count) && ($custom_tab_options['tab_posts']!='')){
			echo '<div class="wt_section wt_group wt-carskin-dark1 wt-videogallery">';
			for ($i=0 ; $i< $column_arr[$custom_tab_options['tab_column']] ; $i++ ){
				if ( $counter < $post_count ){
					$video_type = pathinfo($custom_tab_options['tab_posts'][$counter]['video']);
					if(isset($custom_tab_options['tab_posts'][$counter]['thumb']))
						$image=wp_get_attachment_image_src( $custom_tab_options['tab_posts'][$counter]['thumb'] , 'large' );
					echo '
						<div class="wt_col '. $column_name .' animate  '.get_option('woocommerce_tab_animation_type').'-animation">
							<div class="wt-itemcnt">
								<div class="wt-thumbcnt" style="height:'.$custom_tab_options['tab_video_height'].'px">';
								if (isset($custom_tab_options['tab_posts'][$counter]['embed']) && $custom_tab_options['tab_posts'][$counter]['embed']!='on'){ 
								  echo '<video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="100%" height="'.$custom_tab_options['tab_video_height'].'"
										  poster="'.(isset($image[0]) ? $image[0]: '').'"
										  data-setup="{}">
										<source src="'.$custom_tab_options['tab_posts'][$counter]['video'].'" type="video/'.(isset($video_type['extension']) ? $video_type['extension']:"").'" />
										<p class="vjs-no-js">'.__('To view this video please enable JavaScript, and consider upgrading to a web browser that',EXTRA_WOO_TABS_TEXTDOMAN).' <a href="http://videojs.com/html5-video-support/" target="_blank">'.__('supports HTML5 video',EXTRA_WOO_TABS_TEXTDOMAN).'</a></p>
									</video>';
								}else {
									echo '<iframe id="player_1" src="'.$custom_tab_options['tab_posts'][$counter]['video'].'" width="100%" height="'.$custom_tab_options['tab_video_height'].'"  frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
								}
							echo '</div><!-- wt-thumbcnt -->
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

	}//end else if
?>