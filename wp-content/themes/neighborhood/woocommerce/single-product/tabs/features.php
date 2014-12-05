<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $products;

// $heading = esc_html( apply_filters('woocommerce_product_feature_heading', __( 'Caracteristicas do Produto', 'woocommerce' ) ) );
?>

<h2><?php echo 'Caracteristicas do Produto'; ?></h2>

<?php the_content(); ?>