<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$customer_orders = array();

if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
	
	$customer_orders = get_posts( array(
	    'numberposts' => $order_count,
	    'meta_key'    => '_customer_user',
	    'meta_value'  => get_current_user_id(),
	    'post_type'   => 'shop_order',
	    'post_status' => 'publish'
	) );

} else {
	
	$args = array(
	    'numberposts'     => $recent_orders,
	    'meta_key'        => '_customer_user',
	    'meta_value'	  => get_current_user_id(),
	    'post_type'       => 'shop_order',
	    'post_status'     => 'publish'
	);
	$customer_orders = get_posts($args);

}

if ( $customer_orders ) : ?>

<h3><?php echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'Recent Orders', 'woocommerce' ) ); ?></h3>

<table class="shop_table my_account_orders">

	<thead>
		<tr>
			<th class="order-date"><span class="nobr"><?php _e( 'Date', 'woocommerce' ); ?></span></th>
			<th class="order-number"><span class="nobr"><?php _e( 'Order', 'woocommerce' ); ?></span></th>
			<th class="order-amount"><span class="nobr"><?php _e( 'Amount', 'swiftframework' ); ?></span></th>
			<th class="order-status"><span class="nobr"><?php _e( 'Status', 'woocommerce' ); ?></span></th>
			<th class="order-actions"><?php _e( 'Details', 'swiftframework' ); ?></th>
		</tr>
	</thead>

	<tbody><?php
		foreach ( $customer_orders as $customer_order ) {
			$order = new WC_Order();

			$order->populate( $customer_order );

			$status     = get_term_by( 'slug', $order->status, 'shop_order_status' );

			?><tr class="order">
				<td class="order-date">
					<time datetime="<?php echo date('Y-m-d', strtotime( $order->order_date ) ); ?>" title="<?php echo esc_attr( strtotime( $order->order_date ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></time>
				</td>
				<td class="order-number">
					<a href="<?php echo esc_url( add_query_arg('order', $order->id, get_permalink( woocommerce_get_page_id( 'view_order' ) ) ) ); ?>">
						<?php echo $order->get_order_number(); ?>
					</a>
				</td>
				<td class="order-amount">
					<?php echo $order->get_formatted_order_total(); ?>
				</td>
				<td class="order-status" style="text-align:left; white-space:nowrap;">
					<?php echo ucfirst( __( $status->name, 'woocommerce' ) ); ?>
				</td>
				<td class="order-actions">
					<?php
						$actions = array();

						if ( in_array( $order->status, apply_filters( 'woocommerce_valid_order_statuses_for_payment', array( 'pending', 'failed' ), $order ) ) )
							$actions['pay'] = array(
								'url'  => $order->get_checkout_payment_url(),
								'name' => __( 'Pay', 'woocommerce' )
							);

						if ( in_array( $order->status, apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array( 'pending', 'failed' ), $order ) ) )
							$actions['cancel'] = array(
								'url'  => $order->get_cancel_order_url(),
								'name' => __( 'Cancel', 'woocommerce' )
							);

						$actions['view'] = array(
							'url'  => add_query_arg( 'order', $order->id, get_permalink( woocommerce_get_page_id( 'view_order' ) ) ),
							'name' => __( 'View', 'woocommerce' )
						);

						$actions = apply_filters( 'woocommerce_my_account_my_orders_actions', $actions, $order );

						foreach( $actions as $key => $action ) {
							echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
						}
					?>
				</td>
			</tr><?php
		}
	?></tbody>

</table>
	
<?php endif; ?>
