<?php
	/**
	 * The template for displaying product content within loops.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/content-product.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     1.6.4
	 */
	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	global $product, $woocommerce_loop, $catalog_mode;
	
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) )
		$woocommerce_loop['loop'] = 0;
	
	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) )
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
	// Ensure visibility
	if ( ! $product->is_visible() )
		return;
	
	// Increase loop count
	$woocommerce_loop['loop']++;
	
	// Extra post classes
	$classes = array();
	if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
		$classes[] = 'first';
	if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
		$classes[] = 'last';
	
	$options = get_option('sf_neighborhood_options');
	$product_overlay_transition = $options['product_overlay_transition'];
?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php if ($product_overlay_transition) { ?>
	<figure class="product-transition">			
	<?php } else { ?>
	<figure>
	<?php } ?>
		<?php
			
			$image_html = "";
			
			if ($product->is_on_sale()) {
				
				echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale!', 'woocommerce' ).'</span>', $post, $product);
		
			} else if (is_out_of_stock()) {
				
				echo '<span class="out-of-stock-badge">' . __( 'Out of Stock', 'swiftframework' ) . '</span>';
			
			} else if (!$product->get_price()) {
				
				echo '<span class="free-badge">' . __( 'Free', 'swiftframework' ) . '</span>';
				
			} else {
			
				$postdate 		= get_the_time( 'Y-m-d' );			// Post date
				$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
				$newness 		= 7; 	// Newness in days
	
				if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) { // If the product was published within the newness time frame display the new badge
					echo '<span class="wc-new-badge">' . __( 'New', 'swiftframework' ) . '</span>';
				}
				
			}
	
			if ( has_post_thumbnail() ) {
				$image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_single' );					
			}
		?>
		
		<a href="<?php the_permalink(); ?>">
			
			<?php
				
				if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
				
					$attachment_ids = $product->get_gallery_attachment_ids();
					
					$img_count = 0;
					
					if ($attachment_ids) {
						
						echo '<div class="product-image">'.$image_html.'</div>';	
						
						foreach ( $attachment_ids as $attachment_id ) {
							
							if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
								continue;
							
							echo '<div class="product-image">'.wp_get_attachment_image( $attachment_id, 'shop_catalog' ).'</div>';	
							
							$img_count++;
							
							if ($img_count == 1) break;
				
						}
									
					} else {
					
						echo '<div class="product-image">'.$image_html.'</div>';					
						echo '<div class="product-image">'.$image_html.'</div>';
						
					}
				
				} else {
					
					$attachments = get_posts( array(
						'post_type' 	=> 'attachment',
						'numberposts' 	=> -1,
						'post_status' 	=> null,
						'post_parent' 	=> $post->ID,
						'post__not_in'	=> array( get_post_thumbnail_id() ),
						'post_mime_type'=> 'image',
						'orderby'		=> 'menu_order',
						'order'			=> 'ASC'
					) );
					
					$img_count = 0;
				
					if ($attachments) {
				
						$loop = 0;
						$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
				
						foreach ( $attachments as $key => $attachment ) {
				
							if ( get_post_meta( $attachment->ID, '_woocommerce_exclude_image', true ) == 1 )
								continue;
				
							echo '<div class="product-image">'.wp_get_attachment_image( $attachment->ID, 'shop_catalog' ).'</div>';	
							
							$img_count++;
							
							if ($img_count == 1) break;
				
						}
				
					} else {
					
						echo '<div class="product-image">'.$image_html.'</div>';					
						echo '<div class="product-image">'.$image_html.'</div>';
						
					}
					
				}
			?>			
		</a> 
		<?php if (!$catalog_mode) { ?>
		<figcaption>
			<div class="shop-actions clearfix">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
		</figcaption>
		<?php } ?>
	</figure>
	
	<div class="product-details">
		<h3 ><a style="color:#EF3F32" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php
			$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
			//echo $product->get_categories( ', ', '<span class="posted_in">' . _n( '', '', $size, 'woocommerce' ) . ' ', '</span>' );
		?>
	</div>

	

	<?php

		//echo $product->get_price();
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */
		//echo get_locale();
		do_action( 'woocommerce_after_shop_loop_item_title' );
	?>

	<div class="clearfix" style="width:50%; margin:0px auto;"><a style="padding:5px 15px;float:left;border:1px solid #999" href="<?php the_permalink(); ?>"><img style="width:24px !important;height:auto;margin-right:5px;display:inline-block;box-shadow:none;" src="http://ironmanrecovery.com.br/wp-content/uploads/2014/10/icone-carrinho-grande-alerta1.png">Adicionar</a><a style="color:white; font-weight:700; background-color:#EF3F32; padding:6px 15px;float:right;" href="<?php the_permalink(); ?>">Saiba mais</a></div>
</li>