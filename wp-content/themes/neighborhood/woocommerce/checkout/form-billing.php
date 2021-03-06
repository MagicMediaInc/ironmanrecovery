<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php if ( $woocommerce->cart->ship_to_billing_address_only() && $woocommerce->cart->needs_shipping() ) : ?>

	<h4 class="lined-heading"><span><?php _e( 'Endereço de Faturamento', 'woocommerce' ); ?></span></h4>

<?php else : ?>

	<h4 class="lined-heading"><span><?php _e( 'Endereço de Faturamento', 'woocommerce' ); ?></span></h4>

<?php endif; ?>

<?php do_action('woocommerce_before_checkout_billing_form', $checkout ); ?>

<?php foreach ($checkout->checkout_fields['billing'] as $key => $field) : ?>

	<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

<?php endforeach; ?>

<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

	<?php if ( $checkout->enable_guest_checkout ) : ?>

		<p class="form-row form-row-wide" style="display: none;">
			<input class="input-checkbox" id="createaccount" <?php checked($checkout->get_value('createaccount'), true) ?> type="checkbox" name="createaccount" value="1" checked /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
		</p>

	<?php endif; ?>

<?php endif; ?>