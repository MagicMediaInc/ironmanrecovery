<?php
/**
 * Lightbox checkout.
 *
 * @author  Claudio_Sanches
 * @package WooCommerce_PagSeguro/Templates
 * @version 2.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<p id="browser-has-javascript" style="display: none;"><?php _e( 'Obrigado por sua ordem, por favor, aguarde alguns segundos para fazer o pagamento com PagSeguro.', 'woocommerce-pagseguro' ); ?></p>

<p id="browser-no-has-javascript"><?php _e( 'Obrigado por sua ordem, por favor clique no botão abaixo para pagar com PagSeguro.', 'woocommerce-pagseguro' ); ?></p>

<a class="button cancel" id="cancel-payment" href="<?php echo esc_url( $cancel_order_url ); ?>"><?php _e( 'Cancel order &amp; restore cart', 'woocommerce-pagseguro' ); ?></a> <a id="submit-payment" class="button alt" href="<?php esc_url_raw( $payment_url ); ?>"><?php _e( 'Pagar com PagSeguro', 'woocommerce-pagseguro' ); ?></a>

<script type="text/javascript" src="<?php echo $lightbox_script_url; ?>"></script>
