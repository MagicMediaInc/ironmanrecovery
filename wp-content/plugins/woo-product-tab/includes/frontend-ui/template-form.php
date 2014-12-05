<?php 
	$content = apply_filters( 'the_content', $custom_tab_options['content'] );
	$content = str_replace( ']]>', ']]&gt;', $content );

	echo apply_filters( 'woocommerce_custom_product_tabs_panel_form', $content, $custom_tab_options );
	
	echo do_shortcode($custom_tab_options['tab_content']);
?>