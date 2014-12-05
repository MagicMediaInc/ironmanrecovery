<?php
	//include "WP-ROOT-PATH/wp-config.php";
	include( dirname( dirname ( __FILE__ ) )."/wp-config.php" );
	global $wpdb;
	$args = array( 
				'post_type' => 'extra_product_tab',
				'meta_key' => 'product_tab_order',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'product_tab_enable_all',
						'value' => 'yes',
						'compare' => '='
					)
				)
			);
	$loop = new WP_Query( $args );
	$data=array();
	while ( $loop->have_posts() ) : $loop->the_post();
		$product_type=get_post_meta(get_the_ID(),'product_tab_type', true);
		$data[]=$product_type;
	endwhile;	
	$data=implode(',',$data);
	echo $data;
?>