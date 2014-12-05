<?php 
	if(is_array($custom_tab_options['tab_posts']))
	{
		$img_eff = $custom_tab_options['tab_image_effect'];
		$icon_eff = $custom_tab_options['tab_icon_effect'];
		if ($custom_tab_options['tab_type']=='grid'){
			$column_arr=array('wt_col_2_of_2'=>1,'wt_col_1_of_2'=>2,'wt_col_1_of_3'=>3,'wt_col_1_of_4'=>4);
			$post_count = count($custom_tab_options['tab_posts']);
			$column_name = $custom_tab_options['tab_column'];
			
			$counter =0;
			$i=0;
			while ($counter < $post_count){
				echo '<div class="wt_section wt_group wt-carskin-light2">';
				for ($i=0 ; $i< $column_arr[$custom_tab_options['tab_column']] ; $i++ ){
					if ( $counter < $post_count ){
						$image= wp_get_attachment_image_src( get_post_thumbnail_id($custom_tab_options['tab_posts'][$counter]) , 'medium' );
						$full_image = wp_get_attachment_image_src( get_post_thumbnail_id($custom_tab_options['tab_posts'][$counter]) , 'full' );
						if ($image[0]==''){ 
							$image=wp_get_attachment_image_src(get_option('pw_woocommerce_tabs_default_image') , 'medium'); 
							$full_image=wp_get_attachment_image_src(get_option('pw_woocommerce_tabs_default_image') , 'full');
						}
						
						$title=get_the_title($custom_tab_options['tab_posts'][$counter]);	
						$permalink = get_permalink( $custom_tab_options['tab_posts'][$counter] );
						
						$content_post = get_post($custom_tab_options['tab_posts'][$counter]);
						$content_post = $content_post->post_content;
						$content_post = apply_filters('the_content', $content_post);
						$content_post = str_replace(']]>', ']]&gt;', $content_post);
						
						global $post;  
						$save_post = $post;
						$post = get_post($custom_tab_options['tab_posts'][$counter]);
						setup_postdata( $post ); // hello
						$excerpt = excerpt(get_the_excerpt(),10);
						$post = $save_post;
						wp_reset_postdata();
						
						
						$content_post=($excerpt!='' ? $excerpt : excerpt($content_post,10));
				
						echo '
							<div class="wt_col '. $column_name .' animate  '.get_option('woocommerce_tab_animation_type').'-animation ">
								<div class="wt-itemcnt">
									<div class="wt-thumbcnt '.$img_eff.' ">
										<img src="'.$image[0].'" />
										<div class="wt-overally fadein-eff ">
											<a href="'.$full_image[0].'" class="wt-zoom-icon wt-not-alone '.$icon_eff.' example-image" data-lightbox="image-set"></a>
											<a href="'.$permalink.'" class="wt-link-icon wt-not-alone '.$icon_eff.'" ></a>
										</div><!-- wt-overally -->
									</div><!-- wt-thumbcnt -->
								</div><!--wt-itemcnt -->
								<div class="wt-detailcnt">
									<h4 class="wt-title center-txt"><a href="'.$permalink.'">'.$title.'</a></h4>
									<p class="wt-text center-txt">'.$content_post.'</p>
									<div class="wt-downlink wt-postlink center-txt"><a href="'.$permalink.'">'.__('Read More',EXTRA_WOO_TABS_TEXTDOMAN).'</a></div>
								</div>		
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
		else if($custom_tab_options['tab_type']=='list') {
			foreach($custom_tab_options['tab_posts'] as $r_post)
			{
				$image= wp_get_attachment_image_src( get_post_thumbnail_id($r_post) , 'medium' );
				$full_image = wp_get_attachment_image_src( get_post_thumbnail_id($r_post) , 'full' );
				if ($image[0]==''){ 
					$image=wp_get_attachment_image_src(get_option('pw_woocommerce_tabs_default_image') , 'medium'); 
					$full_image=wp_get_attachment_image_src(get_option('pw_woocommerce_tabs_default_image') , 'full');
				}		
				$title=get_the_title($r_post);	
				$permalink = get_permalink( $r_post );
				
				$content_post = get_post($r_post);
				$content_post = $content_post->post_content;
				$content_post = apply_filters('the_content', $content_post);
				$content_post = str_replace(']]>', ']]&gt;', $content_post);
				
				global $post;  
				$save_post = $post;
				$post = get_post($r_post);
				setup_postdata( $post ); // hello
				$excerpt = excerpt(get_the_excerpt(),30);
				$post = $save_post;
				wp_reset_postdata();
				
				
				$content_post=($excerpt!='' ? $excerpt : excerpt($content_post,10));
				echo '<div class="wt_section wt_group wt-listitem animate  '.get_option('woocommerce_tab_animation_type').'-animation">
						<div class="wt_col wt_col_2_of_6">
							<div class="wt-itemcnt">
								<div class="wt-thumbcnt '.$img_eff.'">
									<img src="'.$image[0].'" alt="'.get_the_title().'"/>
									<div class="wt-overally fadein-eff">
										<a href="'.$full_image[0].'" class="wt-zoom-icon wt-not-alone '.$icon_eff.' example-image" data-lightbox="image-set"></a>
										<a href="'.$permalink.'" class="wt-link-icon wt-not-alone '.$icon_eff.'" ></a>
									</div><!-- wt-overally -->
								</div><!-- wt-thumbcnt -->
							</div><!--wt-itemcnt -->		
						</div>
						<div class="wt_col wt_col_4_of_6">
								<div class="wt-detailcnt">
									<h4 class="wt-title left-txt">'.$title.'</h4>
									<p class="wt-text left-txt">'.$content_post.'</p>
									<div class="wt-downlink wt-postlink right-txt"><a href="'.$permalink.'">'.__('Read More',EXTRA_WOO_TABS_TEXTDOMAN),'</a></div>
								</div>
						</div>
					 </div>';
			}//end foreach
		}//end else 
	}else
	{
		echo __('Not available POST',EXTRA_WOO_TABS_TEXTDOMAN);
	}
?>