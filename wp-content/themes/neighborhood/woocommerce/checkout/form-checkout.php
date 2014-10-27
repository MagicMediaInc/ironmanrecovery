<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; $woocommerce_checkout = $woocommerce->checkout();

$woocommerce->show_messages();

$options = get_option('sf_neighborhood_options');

$one_page_checkout = "";
if (isset($options['enable_one_page_checkout'])) {
	$one_page_checkout = $options['enable_one_page_checkout'];
} else {
	$one_page_checkout = false;
}

//do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
	if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
		echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'Você deve estar logado para checkout.', 'woocommerce' ) );
		return;
	}
} else {
	if (get_option('woocommerce_enable_signup_and_login_from_checkout')=="no" && get_option('woocommerce_enable_guest_checkout')=="no" && !is_user_logged_in()) :
		echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('Você deve estar logado para checkout.', 'woocommerce'));
		return;
	endif;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url() );

if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
	if ( $checkout->enable_signup && ! is_user_logged_in() ) { ?>
		<script type='text/javascript'>
		//<![CDATA[ 
		
		jQuery(document).ready(function() {	
			jQuery('#sign-in').show();
			jQuery('a[href="#sign-in"]').addClass('active');
			
		});
		
		//]]>  
		</script>
	<?php } else { ?>
		<script type='text/javascript'>
		//<![CDATA[ 
		
		jQuery(document).ready(function() {
			jQuery('#billing').show();
			jQuery('a[href="#billing"]').addClass('active');
		});
		
		//]]>  
		</script>
	
	<?php } ?>
<?php } else {
	if ( get_option('woocommerce_enable_signup_and_login_from_checkout')=="yes" && ! is_user_logged_in() ) { ?>
		<script type='text/javascript'>
		//<![CDATA[ 
		
		jQuery(document).ready(function() {	
			jQuery('#sign-in').show();
			jQuery('a[href="#sign-in"]').addClass('active');
			
		});
		
		//]]>  
		</script>
	<?php } else { ?>
		<script type='text/javascript'>
		//<![CDATA[ 
		
		jQuery(document).ready(function() {
			jQuery('#billing').show();
			jQuery('a[href="#billing"]').addClass('active');
		});
		
		//]]>  
		</script>
	
	<?php } ?>
<?php } ?>

<?php if ($one_page_checkout) { ?>
<script type='text/javascript'>
//<![CDATA[ 

jQuery(document).ready(function() {		
	
	jQuery('.guest-button').on('click', function() {
		jQuery('#createaccount').prop('checked', false);
		jQuery('body,html').animate({scrollTop: jQuery('#billing').offset().top - 40}, 400);
	});
	
	jQuery('.create-account-button').on('click', function() {
		jQuery('#createaccount').prop('checked', true);
	});
	
});

//]]>  
</script>
<?php } else { ?>
<script type='text/javascript'>
//<![CDATA[ 

jQuery(document).ready(function() {		
	jQuery('.checkout-process li').on('click', 'a', function(e) {
		e.preventDefault();
		
		jQuery('.checkout-process li .active').removeClass('active');
		jQuery(this).addClass('active');
		
		var targetPaneID = jQuery(this).attr('href');
		changeCheckoutPanel(targetPaneID);
	});
	
	jQuery('.continue-button').on('click', '', function(e) {
		e.preventDefault();
		var target = jQuery(this).attr('data-target');
		continueProcess(target);
	});
	
	jQuery('.guest-button').on('click', function() {
		jQuery('#createaccount').prop('checked', false);
	});
	
	jQuery('.create-account-button').on('click', function() {
		jQuery('#createaccount').prop('checked', true);
	});
	
	function continueProcess(target) {
		jQuery('.checkout-process li .active').removeClass('active');
		jQuery('.checkout-process li a[href="'+ target +'"]').addClass('active');
		changeCheckoutPanel(target);
		jQuery('body,html').animate({scrollTop: 0}, 400);
	}
	
	function changeCheckoutPanel(targetID) {
		jQuery('.checkout-pane').css('display', 'none');
		jQuery(targetID).css('display', 'block');
	}
});

//]]>  
</script>
<?php } ?>

<?php sf_woo_help_bar(); ?>

<ul class="checkout-process clearfix">
	<li><a href="#sign-in"><?php _e("1. Assinar em", "swiftframework"); ?></a></li>
	<li><a href="#billing"><?php _e("2. Faturamento e Expedição", "swiftframework"); ?></a></li>
	<li><a href="#review"><?php _e("3. Comente e Pagamentos", "swiftframework"); ?></a></li>
	<li><p><?php _e("4. Confirmação", "swiftframework"); ?></p></li>
</ul>


<div class="checkout-pane active" id="sign-in" style="display: none;">
	
	<div class="col2-set" id="account_details">
	
		<?php if (!is_user_logged_in()) { ?>
		
		<div class="col-1 login">
			<h4 class="lined-heading"><span><?php _e("Já tenho uma conta", "swiftframework"); ?></span></h4>
			<?php
				echo woocommerce_checkout_login_form(
					array(
						'message'  => '',
						'redirect' => get_permalink( woocommerce_get_page_id( 'checkout') ),
						'hidden'   => false
					)
				);
			?>
		</div>
	
		<div class="col-2">
			<h4 class="lined-heading"><span><?php _e("Eu sou novo aqui", "swiftframework"); ?></span></h4>
			<div class="new-here-text">
				<?php echo $options['checkout_new_account_text']; ?>
			</div>
			<div class="bag-buttons">
				<a id="checkout-create-account" class="sf-roll-button create-account-button" href="#create-account" data-toggle="modal"><span><?php _e('Criar uma conta', 'swiftframework'); ?></span><span><?php _e('Criar uma conta', 'swiftframework'); ?></span></a>
				
				<?php if (get_option('woocommerce_enable_guest_checkout') == "yes") { ?>
				<a class="sf-roll-button guest-button continue-button" href="#" data-target="#billing"><span ><?php _e('Caixa como convidado', 'swiftframework'); ?></span><span><?php _e('Caixa como convidado', 'swiftframework'); ?></span></a>
				<?php } ?>
			</div>
		</div>
		
		<?php } else { ?>
		
		<div class="already-logged-in">
			<p><?php _e("Você já está logado, por favor, continue para a próxima etapa.", "swiftframework"); ?></p>
			<a class="sf-roll-button alt-button continue-button" href="#" data-target="#billing"><span ><?php _e('Continuar', 'swiftframework'); ?></span><span><?php _e('Continuar', 'swiftframework'); ?></span></a>
		</div>
		
		<?php } ?>
			
	</div>
	
</div>
		
<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">
	
	<div class="checkout-pane" id="billing" style="display: none;">
	
		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		
		<div class="col2-set" id="customer_details">
	
			<div class="col-1">
	
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
	
			</div>
	
			<div class="col-2">
	
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
	
			</div>
	
		</div>
		
		<div class="proceed clearfix">
			<a class="sf-roll-button alt-button continue-button" href="#" data-target="#review"><span ><?php _e('Prosseguir com a compra', 'swiftframework'); ?></span><span><?php _e('Proceed with purchase', 'swiftframework'); ?></span></a>
		</div>
	
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
	
	</div>
	
	<div class="checkout-pane" id="review" style="display: none;">
		  	
		<h4 id="order_review_heading" class="lined-heading"><span><?php _e( 'O resumo do pedido', 'swiftframework' ); ?></span></h4>
		
		<?php //do_action( 'woocommerce_checkout_order_review' ); ?>

		<?php $available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>

<!-- NEW TEMPLATE -->
<div id="el-cono-de-tu-madre">
	<table class="ahora-no-eres-shop_table">
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
	<!--
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

				<?php do_action('woocommerce_review_order_before_shipping'); ?>

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

				<?php do_action('woocommerce_review_order_after_shipping'); ?>

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
	-->
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
	
	</div>
	
	<div id="create-account" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="create-account-modal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="create-account-modal"><?php _e("Cadastre-se", "swiftframework"); ?></h3>
		</div>
		<div class="modal-body">
			<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>
		
			<div class="create-account">
						
				<?php foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>
		
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
		
				<?php endforeach; ?>
		
				<div class="clear"></div>
		
			</div>
		
			<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
			
			<a class="sf-roll-button alt-button continue-button" href="" data-dismiss="modal" data-target="#billing"><span ><?php _e("E nós terminamos!", "swiftframework"); ?></span><span><?php _e('Continuar', 'swiftframework'); ?></span></a>
	
		</div>
	</div>

</form>

<?php do_action('woocommerce_after_checkout_form'); ?>