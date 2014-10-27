<?php
/**
 * Review order form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
<div id="order_review">
	<table class="shop_table">
		<thead>
			<tr>
				<th class="product-img"><?php _e( 'Item', 'swiftframework' ); ?></th>
				<th class="product-description"><?php _e( 'Descrição', 'swiftframework' ); ?></th>
				<th class="product-unitprice"><?php _e( 'Preço unitário', 'swiftframework' ); ?></th>
				<th class="product-quantity"><?php _e( 'Quantidade', 'swiftframework' ); ?></th>
				<th class="product-subtotal"><?php _e( 'Subtotal', 'swiftframework' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );

				if (sizeof($woocommerce->cart->get_cart())>0) :
					foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) :
						$_product = $values['data'];
						
						$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );
						
						$product_price = "";
						
						if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
						$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
						} else {
						$product_price = get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
						}
						
						if ($_product->exists() && $values['quantity']>0) :
							echo '<tr class="' . esc_attr( apply_filters('woocommerce_checkout_table_item_class', 'checkout_table_item', $values, $cart_item_key ) ) . '">';
							echo '<td class="product-img">';
							
							if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
								echo $thumbnail;
							else
								printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							
							echo '</td>
									<td class="product-description">';
									
									if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
										echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
									else
										printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );
	
									// Meta data
									echo $woocommerce->cart->get_item_data( $values );
	
	                   				// Backorder notification
	                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
	                   					echo '<p class="backorder_notification">' . __( 'Disponível em ordem pendente', 'woocommerce' ) . '</p>';
									
							echo '</td>';
							echo '<td class="product-unitprice">'.
									apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key ) .
									'</td>';		
							echo '<td class="product-quantity">'.
									apply_filters( 'woocommerce_checkout_item_quantity', $values['quantity'], $values, $cart_item_key ) .
									'</td>';
							echo '<td class="product-subtotal">' . apply_filters( 'woocommerce_checkout_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key ) . '</td>
								</tr>';
						endif;
					endforeach;
				endif;

				do_action( 'woocommerce_review_order_after_cart_contents' );
			?>
		</tbody>
	</table>
	
	<table class="totals_table">
		<tbody>
			<tr class="cart-subtotal">
				<th><?php _e( 'Subtotal:', 'swiftframework' ); ?></th>
				<td><?php echo $woocommerce->cart->get_cart_subtotal(); ?></td>
			</tr>

			<?php if ( $woocommerce->cart->get_discounts_before_tax() ) : ?>

			<tr class="discount">
				<th><?php _e( 'Discount:', 'swiftframework' ); ?></th>
				<td>-<?php echo $woocommerce->cart->get_discounts_before_tax(); ?></td>
			</tr>

			<?php endif; ?>

			<?php if ( $woocommerce->cart->needs_shipping() && $woocommerce->cart->show_shipping() ) : ?>

				<?php //do_action('woocommerce_review_order_before_shipping'); ?>

				<tr class="shipping">
					<th><?php _e( 'Frete:', 'swiftframework' ); ?></th>
					<td><?php 
						/*$chosen_mthd = null;
						foreach ( $available_methods as $method ):
							if($method->id == $woocommerce->session->chosen_shipping_method)
								$chosen_mthd = $method->label;
						endforeach;
						echo $chosen_mthd;*/
					//echo $woocommerce->session->chosen_shipping_method; 
						woocommerce_get_template( 'cart/shipping-methods.php', array( 'available_methods' => $available_methods ) ); ?></td>
				</tr>

				<?php //do_action('woocommerce_review_order_after_shipping'); ?>

			<?php endif; ?>

			<?php 
				if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
					foreach ( $woocommerce->cart->get_fees() as $fee ) : ?>
	
					<tr class="fee fee-<?php echo $fee->id ?>">
						<th><?php echo $fee->name ?></th>
						<td><?php
							if ( $woocommerce->cart->tax_display_cart == 'excl' )
								echo woocommerce_price( $fee->amount );
							else
								echo woocommerce_price( $fee->amount + $fee->tax );
						?></td>
					</tr>
	
			<?php 
					endforeach;
				}
			?>

			<?php
				if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
					// Show the tax row if showing prices exclusive of tax only
					if ( $woocommerce->cart->tax_display_cart == 'excl' ) {
						foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
							echo '<tr class="tax-rate tax-rate-' . $code . '">
								<th>' . $tax->label . '</th>
								<td>' . $tax->formatted_amount . '</td>
							</tr>';
						}
					}
				} else {
					if ( get_option('woocommerce_display_cart_taxes') == 'yes' && $woocommerce->cart->get_cart_tax() ) :
					
						$taxes = $woocommerce->cart->get_formatted_taxes();
	
						if (sizeof($taxes)>0) :
	
							$has_compound_tax = false;
	
							foreach ($taxes as $key => $tax) :
								if ($woocommerce->cart->tax->is_compound( $key )) : $has_compound_tax = true; continue; endif;
								?>
								<tr class="tax-rate tax-rate-<?php echo $key; ?>">
									<th>
										<?php
										if ( get_option( 'woocommerce_display_totals_excluding_tax' ) == 'no' && get_option( 'woocommerce_prices_include_tax' ) == 'yes' ) {
											_e( 'incl.&nbsp;', 'woocommerce' );
										}
										echo $woocommerce->cart->tax->get_rate_label( $key );
										?>
									</th>
									<td><?php echo $tax; ?></td>
								</tr>
								<?php
	
							endforeach;
	
							if ($has_compound_tax && !$woocommerce->cart->prices_include_tax) :
								?>
								<tr class="order-subtotal">
									<th><strong><?php _e('Subtotal', 'woocommerce'); ?></strong></th>
									<td><strong><?php echo $woocommerce->cart->get_cart_subtotal( true ); ?></strong></td>
								</tr>
								<?php
							endif;
	
							foreach ($taxes as $key => $tax) :
								if (!$woocommerce->cart->tax->is_compound( $key )) continue;
								?>
								<tr class="tax-rate tax-rate-<?php echo $key; ?>">
									<th>
										<?php
										if ( get_option( 'woocommerce_display_totals_excluding_tax' ) == 'no' && get_option( 'woocommerce_prices_include_tax' ) == 'yes' ) {
											_e( 'incl.&nbsp;', 'woocommerce' );
										}
										echo $woocommerce->cart->tax->get_rate_label( $key );
										?>
									</th>
									<td><?php echo $tax; ?></td>
								</tr>
								<?php
	
							endforeach;
	
						else :
	
							?>
							<tr class="tax">
								<th><?php _e('Imposto', 'woocommerce'); ?></th>
								<td><?php echo $woocommerce->cart->get_cart_tax(); ?></td>
							</tr>
							<?php
	
						endif;
					elseif ( get_option('woocommerce_display_cart_taxes_if_zero') == 'yes' ) :
	
						?>
						<tr class="tax">
							<th><?php _e('Imposto', 'woocommerce'); ?></th>
							<td><?php _ex( 'N/D', 'Relating to tax', 'woocommerce' ); ?></td>
						</tr>
						<?php
	
					endif;
				}
			?>

			<?php if ( $woocommerce->cart->get_discounts_after_tax() ) : ?>

			<tr class="discount">
				<th><?php _e( 'Códigos promocionais:', 'swiftframework' ); ?></th>
				<td>-<?php echo $woocommerce->cart->get_discounts_after_tax(); ?></td>
			</tr>

			<?php endif; ?>
			
			<tr class="blank">
				<th></th>
				<td></td>
			</tr>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

			<tr class="total">
				<th><?php _e( 'Total', 'swiftframework' ); ?></th>
				<td>
					<?php
						if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
							
							echo $woocommerce->cart->get_total();
	
							// If prices are tax inclusive, show taxes here
							if (  $woocommerce->cart->tax_display_cart == 'incl' ) {
								$tax_string_array = array();
	
								foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
									$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
								}
	
								if ( ! empty( $tax_string_array ) ) {
									echo '<small class="includes_tax">' . sprintf( __( '(Inclui %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) ) . '</small>';
								}
							}
						} else {
							if (get_option('woocommerce_display_cart_taxes')=='no' && !$woocommerce->cart->prices_include_tax) :
								echo $woocommerce->cart->get_total_ex_tax();
							else :
								echo $woocommerce->cart->get_total();
							endif;
						}
					?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		</tbody>
	</table>
	
	<div class="clearfix"></div>

	<div id="payment">
		<?php if ($woocommerce->cart->needs_payment()) : ?>
		<ul class="" style="display:none;">
			<?php
				$available_gateways = $woocommerce->payment_gateways->get_available_payment_gateways();
				if ( ! empty( $available_gateways ) ) {

					// Chosen Method
					if ( isset( $woocommerce->session->chosen_payment_method ) && isset( $available_gateways[ $woocommerce->session->chosen_payment_method ] ) ) {
						$available_gateways[ $woocommerce->session->chosen_payment_method ]->set_current();
					} elseif ( isset( $available_gateways[ get_option( 'woocommerce_default_gateway' ) ] ) ) {
						$available_gateways[ get_option( 'woocommerce_default_gateway' ) ]->set_current();
					} else {
						current( $available_gateways )->set_current();
					}

					foreach ( $available_gateways as $gateway ) {
						//var_dump($gateway);
						?>
						<li>
							<input style="display:none;" type="radio" id="payment_method_<?php echo $gateway->id; ?>" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> />
							<label style="display:none;"> for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?></label>
							<?php
								if ( $gateway->has_fields() || $gateway->get_description() ) :
									echo '<div style="display:none;" class=" payment_box payment_method_' . $gateway->id . '" ' . ( $gateway->chosen ? '' : 'style="display:none;"' ) . '>';
									$gateway->payment_fields();
									echo '</div>';
								endif;
							?>
						</li>
						<?php
					}
				} else {

					if ( ! $woocommerce->customer->get_country() )
						echo '<p>' . __( 'Por favor, preencha os seus dados acima para ver os métodos de pagamento disponíveis.', 'woocommerce' ) . '</p>';
					else
						echo '<p>' . __( 'Desculpe, parece que não existem métodos de pagamento disponíveis para seu estado. Entre em contato conosco se você precisar de ajuda ou quiser fazer arranjos alternativos.', 'woocommerce' ) . '</p>';

				}
			?>
		</ul>
		<?php endif; ?>
		<div >
			<?php $woocommerce->nonce_field('process_checkout')?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>
			
		</div>
		<div class="payment_methods methods " style="border-top:1px solid #dfdbdf;padding: 25px 0 5px;"><!--class="form-row place-order"-->

			<noscript><?php _e( 'Desde que seu navegador não suporta JavaScript, ou ele está desativado, por favor, certifique-se de clicar no <em>Atualizar totais</em> botão antes de colocar a sua encomenda. Você pode ser cobrado mais do que a quantidade indicada acima, se você deixar de fazê-lo.', 'woocommerce' ); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e( 'Atualizar totais', 'woocommerce' ); ?>" /></noscript>


			<?php
			$order_button_text = apply_filters('woocommerce_order_button_text', __( 'Finalizar o pagamento com', 'woocommerce' ));

			echo apply_filters('woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . $order_button_text . '" /><img src="http://ironmanrecovery.com.br/wp-content/plugins/woocommerce-pagseguro/assets/images/pagseguro.png" />' );
			?>

			<?php if (woocommerce_get_page_id('terms')>0) : ?>
			<p class="form-row terms">
				<label for="terms" class="checkbox"><?php _e( 'Eu li e aceito o', 'woocommerce' ); ?> <a href="<?php echo esc_url( get_permalink(woocommerce_get_page_id('terms')) ); ?>" target="_blank"><?php _e( 'Termos e Condições', 'woocommerce' ); ?></a></label>
				<input type="checkbox" class="input-checkbox" name="terms" <?php checked( isset( $_POST['terms'] ), true ); ?> id="terms" />
			</p>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		</div>

		<div class="clear"></div>

	</div>

</div>
