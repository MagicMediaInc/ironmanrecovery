<?php 

$size = 'shop_catalog';
				$arr_id=(apply_filters( 'woocommerce_custom_product_tabs_panel_content',  $custom_tab_options['tab_posts'] , $custom_tab_options ));
			if(!empty($custom_tab_options['tab_posts'])){
				$query_args = array(
    				'post_status'    => 'publish', 
    				'post_type'      => 'product', 
    				'post__in'       => $arr_id, 
    				'orderby'        => 'rand'
    				);

				// Add meta_query to query args
				$query_args['meta_query'] = array();

				// Create a new query
				$products = new WP_Query($query_args);
			
				// If query return results
				if ( $products->have_posts() ) : ?>
			 		
					<?php 
					if(get_option('woocommerce_tab_default_theme')=='yes')
					{	
						woocommerce_product_loop_start();
					}
					
					if(get_option('woocommerce_tab_default_theme')=='yes')
					{
						
						while ( $products->have_posts() ) :
							$products->the_post();
					 		woocommerce_get_template_part( 'content', 'product' );
						endwhile; // end of the loop. 
                   	}
					else 
					{ 						
						$img_eff = $custom_tab_options['tab_image_effect'];
						$icon_eff = $custom_tab_options['tab_icon_effect'];
						$column_arr=array('wt_col_2_of_2'=>1,'wt_col_1_of_2'=>2,'wt_col_1_of_3'=>3,'wt_col_1_of_4'=>4);
						$post_count = count($custom_tab_options['tab_posts']);
						$column_name = $custom_tab_options['tab_column'];
						$skin = $custom_tab_options['tab_skin'];
						$tab_id = $custom_tab_options['tab_id'];
						$rand_id = rand(0,1000);
						if ( $custom_tab_options['tab_type']=='carousel'){
						echo '<div class="scroll-img-hor '. $skin .' wt-productgrid " id="wtcar-'.$rand_id.'">';
									while ( $products->have_posts() ) :
										$products->the_post();
										global $product;
										/* Image */
										$id = get_the_ID();
										$src = wp_get_attachment_image_src(get_post_thumbnail_id($id),'medium');
										$sale=dp_get_sale_flasha();
										$pr=$product->get_price_html();										
										$featured='';
										if($product->is_featured())
											$featured = '<div class="wt-notify">'.__('Featured',EXTRA_WOO_TABS_TEXTDOMAN).'</div>';										
										echo '<div><div class=" wt-itemcnt">
													<div class="wt-thumbcnt '.$img_eff.'">
														'.($src[0]=='' ? woocommerce_placeholder_img():'<img src="'.$src[0].'" />').'
														<div class="wt-overally fadein-eff">
															<a href="' . get_permalink() . '" class="wt-link-icon '.$icon_eff.'" title="' . get_the_title() . '"></a>
															'.$featured.$sale.'
														</div><!-- wt-overally -->
													</div><!-- wt-thumbcnt -->
												
													<div class="wt-detailcnt">
														<h4 class="wt-title center-txt"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h4>';
									   if ($pr!='') echo '<div class="wt-price-vis center-txt">'.$pr.'</div>';
									   echo			   '<p class="wt-text center-txt">'.excerpt(get_the_content(),20).'</p>
														
														<div class="wt-button center-txt"><div class="wt-downlink">' . dp_add_to_carta() . '</div></div>
													</div>
												</div><!--wt-itemcnt --></div>';
										 
									endwhile; // end of the loop. 
							echo '</div>
							';
							?>
                        	<script type='text/javascript'>
							/* <![CDATA[  */ 
							                 
								jQuery(document).ready(function() {
									jQuery('#wtcar-<?php echo $rand_id; ?>').slick({ 
										azyLoad: 'ondemand',
										slidesToShow: 3,
										slidesToScroll: 1,
										autoplay: true,
										speed: 1000,
										dots: true
									});	
									
									jQuery("a[href=#tab-<?php echo $tab_id; ?>]").click(function(){
										jQuery('#wtcar-<?php echo $rand_id; ?>').unslick();
										setTimeout(function(){
											jQuery('#wtcar-<?php echo $rand_id; ?>').slick({ 
												azyLoad: 'ondemand',
												slidesToShow: 3,
												slidesToScroll: 1,
												autoplay: true,
												speed: 1000,
												dots: true
											});	
										},100);
										
									});
								}); 
								/* ]]> */
							 </script>         
						<?php	
						}//end if carousel
						
						//GRID VIEW
						else if ($custom_tab_options['tab_type']=='grid'){
							$i=0;
							$counter = 0 ;
							$count = $products->found_posts;
							
							while ( $counter < $count ) :								
								echo '<div class="wt_section wt_group '.$skin.' wt-productgrid">';
								for ($i=0 ; $i < ($column_arr[$column_name])  ; $i++){
									if ($counter < $count){
										$products->the_post();
										global $product;
										/* Image */
										$id = get_the_ID();
										$src = wp_get_attachment_image_src(get_post_thumbnail_id($id),'medium');
										/* Link For Click */
										$sale=dp_get_sale_flasha();
										/* Price */
										$pr="";
										$pr=$product->get_price_html();
										/* featuerd */
										$featured='';
										if($product->is_featured())											
											$featured = '<div class="wt-notify">'.__('Featured',EXTRA_WOO_TABS_TEXTDOMAN).'</div>';
										echo '<div class="wt_col '.$column_name.' animate  '.get_option('woocommerce_tab_animation_type').'-animation">
												<div class="wt-itemcnt">
													<div class="wt-thumbcnt '.$img_eff.'">
														'.($src[0]=='' ? woocommerce_placeholder_img():'<img src="'.$src[0].'" />').'
														<div class="wt-overally fadein-eff">
															<a href="' . get_permalink() . '" class="wt-link-icon '.$icon_eff.'" title="' . get_the_title() . '"></a>
															'.$featured . $sale .'
														</div><!-- wt-overally -->
													</div><!-- wt-thumbcnt -->
												
													<div class="wt-detailcnt">
														<h4 class="wt-title center-txt"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h4>';
										 if ($pr!='') echo '<div class="wt-price-vis center-txt">'.$pr.'</div>';
										 echo		   '<p class="wt-text center-txt">'.excerpt(get_the_content(),20).'</p>
														<div class="wt-button center-txt"><div class="wt-downlink ">' . dp_add_to_carta() . '</div></div>
													</div>
												</div><!--wt-itemcnt -->		
											</div>';
									$counter++;
									}else {
										break;
									}
								}//end for
								echo '</div>';		 
							endwhile; // end of the loop. 
							
						}//end if grid view
						
						else if ( $custom_tab_options['tab_type']=='list'){
								while ( $products->have_posts() ) :
										echo '<div class="wt_section wt_group wt-listitem animate  '.get_option('woocommerce_tab_animation_type').'-animation ">';
										$products->the_post();
										global $product;
										/* Image */
										$id = get_the_ID();
										$src = wp_get_attachment_image_src(get_post_thumbnail_id($id));
										$sale=dp_get_sale_flasha();
										$pr="";
										$pr=$product->get_price_html();
										/* featuerd */
										$featured='';
										if($product->is_featured())
											$featured = '<div class="wt-notify">'.__('Featured',EXTRA_WOO_TABS_TEXTDOMAN).'</div>';
										echo '
											<div class="wt_col wt_col_1_of_5">
											<div class="wt-itemcnt">
												<div class="wt-thumbcnt '.$img_eff.'">
													'.($src[0]=='' ? woocommerce_placeholder_img():'<img src="'.$src[0].'" />').'
													<div class="wt-overally fadein-eff">
														<a href="' . get_permalink() . '" class="wt-link-icon '.$icon_eff.'" title="' . get_the_title() . '"></a>
														'.$featured.$sale.'
													</div><!-- wt-overally -->
												</div><!-- wt-thumbcnt -->
											
												
											</div><!--wt-itemcnt -->		
										</div>
										<div class="wt_col wt_col_3_of_5">
												<div class="wt-detailcnt">
													<h4 class="wt-title left-txt"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h4>
													<p class="wt-text left-txt">'.excerpt(get_the_content(),20).'</p>
												</div>
										</div>
										<div class="wt_col wt_col_1_of_5">
												<div class="wt-detailcnt">';
											if ($pr!='') echo '<div class="wt-price-vis center-txt">'.$pr.'</div>';
											echo '
													<div class="wt-button center-txt"><div class="wt-downlink">' . dp_add_to_carta() . '</div></div>
												</div>
										</div>';
									echo '</div><!--end section -->'; 
								endwhile; // end of the loop. 
							
						}//end if carousel
						
						
					}//end else
					if(get_option('woocommerce_tab_default_theme')=='yes')
					{	
						woocommerce_product_loop_end(); 
					}
				
				endif;
				
				}
				else
				{
					echo '<div>'.__('Product Not Found',EXTRA_WOO_TABS_TEXTDOMAN).'</div>';
				}
				?>