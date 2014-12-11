<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	
	global $post, $product, $catalog_mode;
	
	$options = get_option('sf_neighborhood_options');
	if (isset($options['enable_pb_product_pages'])) {
		$enable_pb_product_pages = $options['enable_pb_product_pages'];
	} else {
		$enable_pb_product_pages = false;
	}
	
	$product_short_description = get_post_meta($post->ID, 'sf_product_short_description', true);
	
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		
		<div class="summary-top clearfix">
			
			<p itemprop="price" class="price"><?php echo $product->get_price_html(); ?></p>
			
			<?php
				if ( comments_open() ) {
				
					$count = $wpdb->get_var("
					    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
					    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
					    WHERE meta_key = 'rating'
					    AND comment_post_ID = $post->ID
					    AND comment_approved = '1'
					    AND meta_value > 0
					");
				
					$rating = $wpdb->get_var("
				        SELECT SUM(meta_value) FROM $wpdb->commentmeta
				        LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
				        WHERE meta_key = 'rating'
				        AND comment_post_ID = $post->ID
				        AND comment_approved = '1'
				    ");
				
				    if ( $count > 0 ) {
				
				        $average = number_format($rating / $count, 2);
											
						$reviews_text = sprintf(_n('%d Review', '%d Reviews', $count, 'swiftframework'), $count);
						
				        echo '<div class="review-summary"><div class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> '.__('out of 5', 'woocommerce').'</span></div><div class="reviews-text">'.$reviews_text.'</div></div>';
				
				    }
				}
			?>
			<?php
				$has_cat = get_the_terms( $post->ID, 'product_cat' );
			?>
			<?php if (function_exists('be_previous_post_link') && $has_cat != 0) { ?>
			<!--
			<div class="product-navigation">
				<div class="nav-previous"><?php be_previous_post_link( '%link', '<i class="icon-angle-right"></i>', true, '', 'product_cat' ); ?></div>
				<div class="nav-next"><?php be_next_post_link( '%link', '<i class="icon-angle-left"></i>', true, '', 'product_cat' ); ?></div>
			</div>
			-->
			<?php } ?>
		
		</div>
		
		<?php if (!$catalog_mode) { ?>
		<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
		<?php } ?>	
		
		<?php if ($product_short_description != "") { ?>
			<div class="product-short">
				<?php 
					echo $post->post_excerpt;
				//echo do_shortcode($product_short_description); ?>
			</div>
		<?php } ?>			
		<?php
			/**
			* woocommerce_single_product_summary hook
			*
			* @hooked woocommerce_template_single_title - 5
			* @hooked woocommerce_template_single_price - 10
			* @hooked woocommerce_template_single_excerpt - 20
			* @hooked woocommerce_template_single_add_to_cart - 30
			* @hooked woocommerce_template_single_meta - 40
			* @hooked woocommerce_template_single_sharing - 50
			*/		 
			
			do_action( 'woocommerce_single_product_summary' );
		?>
		
	</div><!-- .summary -->
	
	<?php if ($enable_pb_product_pages) { ?>
	
	<div id="product-display-area" class="clearfix">

		<?php
		
		$tabs = apply_filters( 'woocommerce_product_tabs', array() );
		// var_dump($tabs);
		if ( ! empty( $tabs ) ) : ?>

			<div class="woocommerce-tabs">
				<ul class="tabs">
					<?php foreach ( $tabs as $key => $tab ) : ?>

						<li class="<?php echo $key ?>_tab">
							<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
						</li>

					<?php endforeach; ?>
				</ul>
				<?php foreach ( $tabs as $key => $tab ) : ?>

					<div class="panel entry-content" id="tab-<?php echo $key ?>">
						<?php call_user_func( $tab['callback'], $key, $tab ) ?>
					</div>

				<?php endforeach; ?>
			</div>

		<?php endif; ?>
		
		<?php //the_content(); ?>
		
	</div>
	
	<?php } ?>
	
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>