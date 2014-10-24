<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<h4><?php _e( 'Seu Carrinho de Compras está vazio', 'swiftframework' ) ?></h4>

<p class="no-items"><?php _e( 'Você atualmente não tem itens no seu carrinho de compras.', 'swiftframework' ) ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<a class="continue-shopping" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e( 'Continuar com sua compra', 'swiftframework' ) ?></a>