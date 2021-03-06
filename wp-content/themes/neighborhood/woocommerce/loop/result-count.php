<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );

if ( ! woocommerce_products_will_display() )
	return;
?>
<div class="woocommerce-count-wrap">
<!--
	<p class="woocommerce-result-count">
		<?php
		$paged    = max( 1, $wp_query->get( 'paged' ) );
		$per_page = $wp_query->get( 'posts_per_page' );
		$total    = $wp_query->found_posts;
		$first    = ( $per_page * $paged ) - $per_page + 1;
		$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
		
		if ( 1 == $total ) {
			_e( 'Showing the single product', 'swiftframework' );
		} elseif ( $total <= $per_page ) {
			printf( __( 'Mostrando todos %d produtos', 'swiftframework' ), $total );
		} else {
			printf( __( 'Mostrando %1$d–%2$d de %3$d produtos', 'swiftframework' ), $first, $last, $total );
		}
		?>
	</p>
	<p class="swiftframework-show-products">
		<span><?php _e("Vista", "swiftframework"); ?> </span>
		<a class="show-products-link" href="?show_products=24">24</a>/<a class="show-products-link" href="?show_products=48">48</a>/<a  class="show-products-link" href="<?php echo $shop_page_url; ?>?show_products=<?php echo $total;?>"><?php _e("Todos", "swiftframework"); ?></a>
	</p>
	-->
</div>