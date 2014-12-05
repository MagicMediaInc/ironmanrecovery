<?php
class product_custom_tab {
	
	var $counter=1;
	var $content_changed=false;
	
	public function __construct() 
	{
		//SHOW CUSTOM TAB IN FRONT END
		add_filter( 'woocommerce_product_tabs', array( $this,'woocommerce_product_custom_tab') );
		//CUSTOM TAB
		add_action('woocommerce_product_write_panel_tabs', array( $this,'custom_tab_options_tab'));		
		
		add_action('woocommerce_process_product_meta', array( $this,'process_product_meta_custom_tab'), 10, 2);		
	}
	
	/**
	 * Display Tab
	 * 
	 * Display Custom Tab on Frontend of Website for WooCommerce 2.0
	 */	

	public function custom_tab_options_tab() {
		global $wpdb;
		//$save_post=$post;

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
		
		global $post;  
		$save_post = $post;
				
				
				
		$loop = new WP_Query( $args );

		while ( $loop->have_posts() ) : $loop->the_post();
			$product_type=get_post_meta(get_the_ID(),'product_tab_type', true);
			$product_icon=get_post_meta(get_the_ID(),'product_tab_icon', true);
			$perfix_tab=$product_type.'_'.get_the_ID();
			?>
				<li class="my-tabs <?php echo $perfix_tab;?>_tab"><a href="#<?php echo $perfix_tab;?>_tab"><i class="fa <?php echo $product_icon;?>"></i> <?php the_title(); ?></a></li>
			<?php
		endwhile;
		$post = $save_post;
		wp_reset_postdata();
		add_action('woocommerce_product_write_panels', array( $this,'product_tab_options') );
	?>

	<?php
	}
			
	public function product_tab_options($product_type) {
		global $wpdb;
		//$save_post = $post;
		
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
				
		global $post;  
		$save_post = $post;
		$post_id=(isset($_GET['post']) ? $_GET['post']:"");		
		$loop = new WP_Query( $args );
		//echo $loop->request;
		while ( $loop->have_posts() ) : $loop->the_post();
			$product_type=get_post_meta(get_the_ID(),'product_tab_type', true);
			$product_tab_use_all=get_post_meta(get_the_ID(),'product_tab_use_all', true);
			$public_perfix='product_'.$product_type.'_'.get_the_ID().'_';
			$perfix='product_'.$product_type.'_';
			$perfix_tab=$product_type.'_'.get_the_ID();
			
			$tab_enable_in_product=get_post_meta ( $post_id, $public_perfix.'tab_enabled', true );
			$tab_content_changed=get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true );
			
			$enable='yes';
			if($product_tab_use_all!="on" && $tab_enable_in_product=='yes')
			{
				$enable='yes';
			}else if($product_tab_use_all!="on" && ($tab_enable_in_product=='no' || $tab_enable_in_product!='yes'))
			{
				$enable='no';
			}else if($product_tab_use_all=="on" && ($tab_enable_in_product=='yes' || $tab_enable_in_product!='no'))
			{
				$enable='yes';
			}else if($product_tab_use_all=="on" && ($tab_enable_in_product=='no' || $tab_enable_in_product!='yes'))
			{
				$enable='no';
			}
			
			
			$public_field_array=array(
				$public_perfix.'tab_enabled' => $enable,
				$public_perfix.'tab_title' => ($tab_enable_in_product!='' ? get_post_meta ( $post_id, $public_perfix.'tab_title', true ):get_the_title() ),
				$public_perfix.'tab_description' => ($tab_enable_in_product!='' ? get_post_meta ( $post_id, $public_perfix.'tab_description', true ) : get_the_content() ),
				$public_perfix.'tab_sticky_enabled' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_enabled', true ),
				$public_perfix.'tab_sticky_width' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_width', true ),
				$public_perfix.'tab_sticky_height' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_height', true ),
				$public_perfix.'tab_sticky_position' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_position', true ),
				$public_perfix.'tab_content_changed' => get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true ),
			);
			
			switch ( $product_type )
			{
				case "product":
					include("admin-ui/product_tab.php");
				break;
				
				case "brands_category":
					include("admin-ui/brands_category_tab.php");
				break;
				
				case "editor":
					include("admin-ui/editor_tab.php");
				break;
				
				case "video_gallery":
					include("admin-ui/video_tab.php");
				break;
				
				case "photo_gallery":
					include("admin-ui/photo_tab.php");
				break;
				
				case "map":
					include("admin-ui/map_tab.php");
				break;
				
				case "form":
					include("admin-ui/form_tab.php");
				break;
				
				case "inquire_form":
					include("admin-ui/inquire_form_tab.php");
				break;
				
				case "download":
					include("admin-ui/download_tab.php");
				break;

				case "related_post":
					include("admin-ui/related_post_tab.php");
				break;
				
				case "faq":
					include("admin-ui/faq_tab.php");
				break;
			}

		endwhile;
		$post = $save_post;
		wp_reset_postdata();
	}
			
	public function update_public_fields($public_perfix,$post_id)
	{
		
		$this->update_public_meta( $post_id, $public_perfix.'tab_enabled', ( isset ( $_POST[$public_perfix.'tab_enabled'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_enabled'] ) : 'no' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_title', ( isset ( $_POST[$public_perfix.'tab_title'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_title'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_description', ( isset ( $_POST[$public_perfix.'tab_description'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_description'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_sticky_enabled', ( isset ( $_POST[$public_perfix.'tab_sticky_enabled'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_sticky_enabled'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_sticky_width', ( isset ( $_POST[$public_perfix.'tab_sticky_width'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_sticky_width'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_sticky_height', ( isset ( $_POST[$public_perfix.'tab_sticky_height'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_sticky_height'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_sticky_position', ( isset ( $_POST[$public_perfix.'tab_sticky_position'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_sticky_position'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_content_changed', ( isset ( $_POST[$public_perfix.'tab_content_changed'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_content_changed'] ) : '' );
		
		if($this->content_changed)
		{
			$this->update_public_meta( $post_id, $public_perfix.'tab_content_changed', "yes" );
			$this->content_changed=false;
		}
	
	}
	
	public function update_public_meta ( $id, $field, $value )
	{
		$old = get_post_meta($id, $field, true);  
		$new = $value;  
		if ($new && $new != $old) {  
			update_post_meta($id, $field, $new);
		} elseif ('' == $new && $old) {  
			delete_post_meta($id, $field, $old);  
		}
	}
	 
	public function update_meta ( $id, $field, $value )
	{
		$old = get_post_meta($id, $field, true);  
		$new = $value;  
		if ($new && $new != $old) {  
			update_post_meta($id, $field, $new);
			$this->content_changed=true;
		} elseif ('' == $new && $old) {  
			delete_post_meta($id, $field, $old);  
			$this->content_changed=true;
		}
	}
	 
	public function process_product_meta_custom_tab( $post_id ) {
		
		global $wpdb;
		//$save_post=$post;

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
		global $post;  
		$save_post = $post;		
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			$product_type=get_post_meta(get_the_ID(),'product_tab_type', true);
			$product_tab_use_all=get_post_meta(get_the_ID(),'product_tab_use_all', true);
			$public_perfix='product_'.$product_type.'_'.get_the_ID().'_';
			$perfix='product_'.$product_type.'_';
		
			
			
			$tab_enable_in_product=get_post_meta ( $post_id, $public_perfix.'tab_enabled', true );
			$tab_content_changed=get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true );
			
			switch ( $product_type )
			{
				case "product":
					
					$related_posts='';
					if(isset ( $_POST[$public_perfix.'tab_posts'] ) && is_array( $_POST[$public_perfix.'tab_posts'] ) )
					{
						$ids=$_POST[$public_perfix.'tab_posts'];
						foreach ( $ids as $id )
							if ( $id && $id > 0 )
								$related_posts[] = $id;
					}
					
					
					$this->update_meta( $post_id, $public_perfix.'tab_posts', $related_posts );
					
					$this->update_meta( $post_id, $public_perfix.'tab_type', ( isset ( $_POST[$public_perfix.'tab_type'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_type'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_skin', ( isset ( $_POST[$public_perfix.'tab_skin'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_skin'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_column', ( isset ( $_POST[$public_perfix.'tab_column'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_column'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_image_effect', ( isset ( $_POST[$public_perfix.'tab_image_effect'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_image_effect'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_icon_effect', ( isset ( $_POST[$public_perfix.'tab_icon_effect'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_icon_effect'] ) : '' );
					
				break;
				
				case "brands_category":	
					$this->update_meta( $post_id, $public_perfix.'tab_query', ( isset ( $_POST[$public_perfix.'tab_query'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_query'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_type', ( isset ( $_POST[$public_perfix.'tab_type'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_type'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_skin', ( isset ( $_POST[$public_perfix.'tab_skin'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_skin'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_column', ( isset ( $_POST[$public_perfix.'tab_column'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_column'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_image_effect', ( isset ( $_POST[$public_perfix.'tab_image_effect'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_image_effect'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_icon_effect', ( isset ( $_POST[$public_perfix.'tab_icon_effect'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_icon_effect'] ) : '' );
					
				break;
				
				case "editor" :
					$this->update_meta( $post_id, $public_perfix.'tab_content', ( isset ( $_POST[$public_perfix.'tab_content'] ) ) ?  ( $_POST[$public_perfix.'tab_content'] ) : '' );
				
				break;
				
				case "video_gallery":
					//$the_posts = array_filter(array_map('array_filter', $_POST[$public_perfix.'tab_posts'])); 
					
					$related_posts='';
					if(isset ( $_POST[$public_perfix.'tab_posts'] ) && is_array( $_POST[$public_perfix.'tab_posts'] ) )
					{

						$new = array_filter(array_map('array_filter', $_POST[$public_perfix.'tab_posts']));

						$ids=$new;
						$i=0;
						foreach ( $ids as $id )
						{
							if ( $id)
							{
								$related_posts[$i]['video'] = (isset($id['video']) ? $id['video']:"");
								$related_posts[$i]['thumb'] = (isset($id['thumb']) ? $id['thumb']:"");
								$related_posts[$i]['embed'] = (isset($id['embed']) ? $id['embed']:"off");
							}
							$i++;
						}
					}
					
					
					$this->update_meta( $post_id, $public_perfix.'tab_posts', $related_posts );
					$this->update_meta( $post_id, $public_perfix.'tab_height', ( isset ( $_POST[$public_perfix.'tab_height'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_height'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_type', ( isset ( $_POST[$public_perfix.'tab_type'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_type'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_column', ( isset ( $_POST[$public_perfix.'tab_column'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_column'] ) : '' );
				break;
				
				case "photo_gallery":
					$related_posts='';
					if(isset ( $_POST[$public_perfix.'tab_posts'] ) && is_array( $_POST[$public_perfix.'tab_posts'] ) )
					{
						$ids=$_POST[$public_perfix.'tab_posts'];
						foreach ( $ids as $id )
							if ( $id && $id > 0 )
								$related_posts[] = $id;
					}
					$this->update_meta( $post_id, $public_perfix.'tab_posts', $related_posts );
					$this->update_meta( $post_id, $public_perfix.'tab_height', ( isset ( $_POST[$public_perfix.'tab_height'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_height'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_type', ( isset ( $_POST[$public_perfix.'tab_type'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_type'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_column', ( isset ( $_POST[$public_perfix.'tab_column'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_column'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_image_effect', ( isset ( $_POST[$public_perfix.'tab_image_effect'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_image_effect'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_icon_effect', ( isset ( $_POST[$public_perfix.'tab_icon_effect'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_icon_effect'] ) : '' );
				break;
				
				case "map":
					$this->update_meta( $post_id, $public_perfix.'tab_type', ( isset ( $_POST[$public_perfix.'tab_type'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_type'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_address', ( isset ( $_POST[$public_perfix.'tab_address'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_address'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_lat', ( isset ( $_POST[$public_perfix.'tab_lat'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_lat'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_long', ( isset ( $_POST[$public_perfix.'tab_long'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_long'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_content', ( isset ( $_POST[$public_perfix.'tab_content'] ) ) ?  $_POST[$public_perfix.'tab_content'] : '' );
				break;
				
				case "form" :
					$this->update_meta( $post_id, $public_perfix.'tab_content', ( isset ( $_POST[$public_perfix.'tab_content'] ) ) ?  ( $_POST[$public_perfix.'tab_content'] ) : '' );
				
				break;
				
				case "inquire_form":
				
					$inquiry_array=array($public_perfix.'tab_name',$public_perfix.'tab_email',$public_perfix.'tab_website',$public_perfix.'tab_address',$public_perfix.'tab_desc');
					foreach($inquiry_array as $fields)
					{
						delete_post_meta($post_id, $fields);  
						$new = (isset($_POST[$fields]) ? $_POST[$fields]:'');
						update_post_meta($post_id, $fields , $new); 
						$this->content_changed=true; 

					
					}
					
					
				break;
				
				case "download":
					$related_posts='';
					if(isset ( $_POST[$public_perfix.'tab_posts'] ) && is_array( $_POST[$public_perfix.'tab_posts'] ) )
					{
						$ids=$_POST[$public_perfix.'tab_posts'];
						foreach ( $ids as $id )
							if ( $id && $id > 0 )
								$related_posts[] = $id;
					}
					$this->update_meta( $post_id, $public_perfix.'tab_posts', $related_posts );

				break;
				
				case "related_post":
					$related_posts='';
					if(isset ( $_POST[$public_perfix.'tab_posts'] ) && is_array( $_POST[$public_perfix.'tab_posts'] ) )
					{
						$ids=$_POST[$public_perfix.'tab_posts'];
						foreach ( $ids as $id )
							if ( $id && $id > 0 )
								$related_posts[] = $id;
					}
					$this->update_meta( $post_id, $public_perfix.'tab_posts', $related_posts );
					$this->update_meta( $post_id, $public_perfix.'tab_type', ( isset ( $_POST[$public_perfix.'tab_type'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_type'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_column', ( isset ( $_POST[$public_perfix.'tab_column'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_column'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_image_effect', ( isset ( $_POST[$public_perfix.'tab_image_effect'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_image_effect'] ) : '' );
					$this->update_meta( $post_id, $public_perfix.'tab_icon_effect', ( isset ( $_POST[$public_perfix.'tab_icon_effect'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_icon_effect'] ) : '' );
				break;
				
				case "faq":
					$related_posts='';
					if(isset ( $_POST[$public_perfix.'tab_posts'] ) && is_array( $_POST[$public_perfix.'tab_posts'] ) )
					{
						$ids=$_POST[$public_perfix.'tab_posts'];
						$i=0;
						foreach ( $ids as $id )
						{
							if ( $id)
							{
								$related_posts[$i]['question'] = $id['question'];
								$related_posts[$i]['answer'] = $id['answer'];
							}
							$i++;
						}
					}
					$this->update_meta( $post_id, $public_perfix.'tab_posts', $related_posts );
				break;
			}
			$this->update_public_fields($public_perfix,$post_id);

		endwhile;
		$post = $save_post;
		wp_reset_postdata();
	}

	public function woocommerce_product_custom_tab( $tabs ) {
				global $post, $product,$wpdb;
				$post_id=$post->ID;
				$save_post = $post;
								
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
				//echo $loop->request;
				global $extra_number ;

				$extra_left_top = get_option('woocommerce_tab_eb_left_top');
				$extra_right_top = get_option('woocommerce_tab_eb_right_top');
				while ( $loop->have_posts() ) : $loop->the_post();

					$product_type=get_post_meta(get_the_ID(),'product_tab_type', true);
					$product_tab_use_all=get_post_meta(get_the_ID(),'product_tab_use_all', true);
					$product_tab_order=get_post_meta(get_the_ID(),'product_tab_order', true);
					$product_icon=get_post_meta(get_the_ID(),'product_tab_icon', true);
					$public_perfix='product_'.$product_type.'_'.get_the_ID().'_';
					$perfix='product_'.$product_type.'_';
					
					$tab_enable_in_product=get_post_meta ( $post_id, $public_perfix.'tab_enabled', true );
					$tab_content_changed=get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true );
					
					$enable='yes';
					if($product_tab_use_all!="on" && $tab_enable_in_product=='yes')
					{
						$enable='yes';
					}else if($product_tab_use_all!="on" && ($tab_enable_in_product=='no' || $tab_enable_in_product!='yes'))
					{
						$enable='no';
					}else if($product_tab_use_all=="on" && ($tab_enable_in_product=='yes' || $tab_enable_in_product!='no'))
					{
						$enable='yes';
					}else if($product_tab_use_all=="on" && ($tab_enable_in_product=='no' || $tab_enable_in_product!='yes'))
					{
						$enable='no';
					}
					
					
					
					$public_field_array=array(
						$public_perfix.'tab_enabled' => $enable,
						$public_perfix.'tab_title' => ( $tab_enable_in_product!='' ?  get_post_meta($post_id, $public_perfix.'tab_title', true) : get_the_title() ),
						$public_perfix.'tab_description' => ( $tab_enable_in_product!='' ?  get_post_meta($post_id, $public_perfix.'tab_description', true) : get_the_content() ),
						$public_perfix.'tab_icon' => $product_icon,
						$public_perfix.'tab_sticky_enabled' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_enabled', true ),
						$public_perfix.'tab_sticky_width' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_width', true ),
						$public_perfix.'tab_sticky_height' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_height', true ),
						$public_perfix.'tab_sticky_position' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_position', true ),
						$public_perfix.'tab_content_changed' => get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true )
					);

					switch ( $product_type )
					{
						case "product":
							$front_end_tab_options = array(
								'public_fields'	 =>$public_field_array,	
								'tab_posts' => get_post_meta( $post_id, $public_perfix.'tab_posts', true )
							);
							//print_r($front_end_tab_options);

							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] == 'yes' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-productslider.php',
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 =>$public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_skin' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_skin', true ) : get_post_meta( get_the_ID(), $perfix.'tab_skin', true ) ),
										'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_image_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_image_effect', true ) ),
										'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_icon_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_icon_effect', true ) ),
										'tab_id' => $public_perfix.'tab'
									);
									include('frontend-ui/sticky.php');
								}else {
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );
									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array($this, 'custom_product_tabs_panel_productslider' ),
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 =>$public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_skin' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_skin', true ) : get_post_meta( get_the_ID(), $perfix.'tab_skin', true ) ),
										'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_image_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_image_effect', true ) ),
										'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_icon_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_icon_effect', true ) ),
										'tab_id' => $public_perfix.'tab'
									);
								}
							}
						break;
						
						case "brands_category":
							$front_end_tab_options = array(
								'public_fields'	 =>$public_field_array,	
							);
							//print_r($front_end_tab_options);

							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] == 'yes' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-brands-category.php',
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 =>$public_field_array,
										'tab_query' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_query', true ) : get_post_meta( get_the_ID(), $perfix.'tab_query', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_skin' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_skin', true ) : get_post_meta( get_the_ID(), $perfix.'tab_skin', true ) ),
										'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_image_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_image_effect', true ) ),
										'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_icon_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_icon_effect', true ) ),
										'tab_id' => $public_perfix.'tab',
										'product_id' => $post_id,
									);
									include('frontend-ui/sticky.php');
								}else {
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );
									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array($this, 'custom_product_tabs_panel_brands_category' ),
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 =>$public_field_array,
										'tab_query' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_query', true ) : get_post_meta( get_the_ID(), $perfix.'tab_query', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_skin' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_skin', true ) : get_post_meta( get_the_ID(), $perfix.'tab_skin', true ) ),
										'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_image_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_image_effect', true ) ),
										'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_icon_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_icon_effect', true ) ),
										'tab_id' => $public_perfix.'tab',
										'product_id' => $post_id,
									);
								}
							}
						break;
							
						case "editor":
							$front_end_tab_options = array(
								'public_fields'	 => $public_field_array
							);
							
							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-editor.php',
										'content'  => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_content', true ) : get_post_meta( get_the_ID(), $perfix.'tab_content', true ) ),
										'public_fields'	 => $public_field_array,
									);
									include('frontend-ui/sticky.php');
								}
								else{
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );

									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array( $this, 'custom_product_tabs_panel_content' ),
										'content'  => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_content', true ) : get_post_meta( get_the_ID(), $perfix.'tab_content', true ) ),
										'public_fields'	 => $public_field_array,
									);
								}
							}
						break;
						
						case "video_gallery":
							$front_end_tab_options = array(
								'public_fields'	 => $public_field_array
							);
							
							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-videoslider.php',
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_video_height' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_height', true ) : get_post_meta( get_the_ID(), $perfix.'tab_height', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_id' => $public_perfix.'tab'
	
									);
									include('frontend-ui/sticky.php');
								}
								else{
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );
									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array( $this, 'custom_product_tabs_panel_videoslider' ),
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_video_height' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_height', true ) : get_post_meta( get_the_ID(), $perfix.'tab_height', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_id' => $public_perfix.'tab'
	
									);
								}
							}
						break;
						
						case "photo_gallery":
							$front_end_tab_options = array(
								'public_fields'	 => $public_field_array
							);
							
							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-gallery.php',
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_height' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_height', true ) : get_post_meta( get_the_ID(), $perfix.'tab_height', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_image_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_image_effect', true ) ),
										'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_icon_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_icon_effect', true ) ),
										'tab_id' => $public_perfix.'tab'
									);
									include('frontend-ui/sticky.php');
								}
								else{
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );
									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array( $this, 'custom_product_tabs_panel_gallery' ),
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_height' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_height', true ) : get_post_meta( get_the_ID(), $perfix.'tab_height', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_image_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_image_effect', true ) ),
										'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_icon_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_icon_effect', true ) ),
										'tab_id' => $public_perfix.'tab'
									);
								}
							}
						break;
						
						case "map":
							$front_end_tab_options = array(
								'public_fields'	 => $public_field_array,	
							);
							
							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-map.php',
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_address' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_address', true ) : get_post_meta( get_the_ID(), $perfix.'tab_address', true ) ),
										'tab_lat' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_lat', true ) : get_post_meta( get_the_ID(), $perfix.'tab_lat', true ) ),
										'tab_long' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_long', true ) : get_post_meta( get_the_ID(), $perfix.'tab_long', true ) ),
										'tab_content' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_content', true ) : get_post_meta( get_the_ID(), $perfix.'tab_content', true ) ),
										'tab_id'	=> $public_perfix.'tab'
									);
									include('frontend-ui/sticky.php');
								}else {
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );
									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array( $this, 'custom_product_tabs_panel_map' ),
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_address' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_address', true ) : get_post_meta( get_the_ID(), $perfix.'tab_address', true ) ),
										'tab_lat' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_lat', true ) : get_post_meta( get_the_ID(), $perfix.'tab_lat', true ) ),
										'tab_long' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_long', true ) : get_post_meta( get_the_ID(), $perfix.'tab_long', true ) ),
										'tab_content' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_content', true ) : get_post_meta( get_the_ID(), $perfix.'tab_content', true ) ),
										'tab_id'	=> $public_perfix.'tab'
									);
								}
							}
						break;
						
						case "form":
							$front_end_tab_options = array(
								'public_fields'	 => $public_field_array
							);
							
							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-editor.php',
										'content'  => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_content', true ) : get_post_meta( get_the_ID(), $perfix.'tab_content', true ) ),
										'public_fields'	 => $public_field_array,
									);
									include('frontend-ui/sticky.php');
								}
								else{
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );

									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array( $this, 'custom_product_tabs_panel_content' ),
										'content'  => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_content', true ) : get_post_meta( get_the_ID(), $perfix.'tab_content', true ) ),
										'public_fields'	 => $public_field_array,
									);
								}
							}
						break;
						
						case "inquire_form":
							$front_end_tab_options = array(
								'public_fields'	 => $public_field_array
							);
							
							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-inquiry.php',
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_title' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_title', true ) : get_post_meta( get_the_ID(), $perfix.'tab_title', true ) ),
										'tab_name' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_name', true ) : get_post_meta( get_the_ID(), $perfix.'tab_name', true ) ),
										'tab_email' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_email', true ) : get_post_meta( get_the_ID(), $perfix.'tab_email', true ) ),
										'tab_website' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_website', true ) : get_post_meta( get_the_ID(), $perfix.'tab_website', true ) ),
										'tab_address' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_address', true ) : get_post_meta( get_the_ID(), $perfix.'tab_address', true ) ),
										'tab_desc' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_desc', true ) : get_post_meta( get_the_ID(), $perfix.'tab_desc', true ) ),
										'post_id'=>$post_id,
										'product_name'=>$product->get_title()
									);
									include('frontend-ui/sticky.php');
								}else {
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );
									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array( $this, 'custom_product_tabs_panel_inquiry' ),
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_title' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_title', true ) : get_post_meta( get_the_ID(), $perfix.'tab_title', true ) ),
										'tab_name' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_name', true ) : get_post_meta( get_the_ID(), $perfix.'tab_name', true ) ),
										'tab_email' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_email', true ) : get_post_meta( get_the_ID(), $perfix.'tab_email', true ) ),
										'tab_website' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_website', true ) : get_post_meta( get_the_ID(), $perfix.'tab_website', true ) ),
										'tab_address' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_address', true ) : get_post_meta( get_the_ID(), $perfix.'tab_address', true ) ),
										'tab_desc' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_desc', true ) : get_post_meta( get_the_ID(), $perfix.'tab_desc', true ) ),
										'post_id'=>$post_id,
										'product_name'=>$product->get_title()
									);
								}//end else
							}
						break;
						
						case "download":
							$front_end_tab_options = array(
								'public_fields'	 => $public_field_array
							);
							
							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-download.php',
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_title' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_title', true ) : get_post_meta( get_the_ID(), $perfix.'tab_title', true ) ),
										'tab_description' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_description', true ) : get_post_meta( get_the_ID(), $perfix.'tab_description', true ) )
									);
									include('frontend-ui/sticky.php');
								}else {
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );
									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array( $this, 'custom_product_tabs_panel_download' ),
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_title' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_title', true ) : get_post_meta( get_the_ID(), $perfix.'tab_title', true ) ),
										'tab_description' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_description', true ) : get_post_meta( get_the_ID(), $perfix.'tab_description', true ) )
									);
								}//end else
							}
						break;

						case "related_post":
							$front_end_tab_options = array(
								'public_fields'	 => $public_field_array
							);
							
							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-related_post.php',
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_image_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_image_effect', true ) ),
										'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_icon_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_icon_effect', true ) )
									);
									include('frontend-ui/sticky.php');
								}
								else {
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );
									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array( $this, 'custom_product_tabs_panel_related_post' ),
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) ),
										'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_column', true ) : get_post_meta( get_the_ID(), $perfix.'tab_column', true ) ),
										'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_type', true ) : get_post_meta( get_the_ID(), $perfix.'tab_type', true ) ),
										'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_image_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_image_effect', true ) ),
										'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_icon_effect', true ) : get_post_meta( get_the_ID(), $perfix.'tab_icon_effect', true ) )
									);
								}
							}
						break;
						
						case "faq":
							$front_end_tab_options = array(
								'public_fields'	 => $public_field_array,	
								'tab_content' => get_post_meta( $post_id, $public_perfix.'tab_content', true )
							);
							
							if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
								if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
								{
									$custom_tab_options = array(
										'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
										'icon'    => '<i class="fa '.$product_icon.'"></i>',
										'priority' => $product_tab_order,
										'callback' => 'template-faq.php',
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) )
									);
									include('frontend-ui/sticky.php');
								}else
								{
									$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
									$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );
									$tabs[$public_perfix.'tab'] = array(
										'title'    => $title,
										'priority' => $product_tab_order,
										'callback' => array( $this, 'custom_product_tabs_panel_faq' ),
										'content'  => $front_end_tab_options['public_fields'][$public_perfix.'tab_description'],
										'public_fields'	 => $public_field_array,
										'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_posts', true ) : get_post_meta( get_the_ID(), $perfix.'tab_posts', true ) )
										);
								}
								
							}
						break;
					}

				endwhile;
				$post = $save_post;
				wp_reset_postdata();
				
				return $tabs;
			}
	/**
	 * Render the custom product tab panel content for the callback 'custom_product_tabs_panel_content'
	 */
	function custom_product_tabs_panel_content( $key, $custom_tab_options ) {

		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		echo apply_filters( 'woocommerce_custom_product_tabs_panel_content', $content, $custom_tab_options );
		
		//echo 'here';
		
	}
	
	function custom_product_tabs_panel_map( $key, $custom_tab_options ) {

		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['tab_content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		//echo $content;
		//echo apply_filters( 'woocommerce_custom_product_tabs_panel_map', $content, $custom_tab_options );
		
		//echo $custom_tab_options['tab_content'];
		
		include('frontend-ui/template-map.php');
	}
	
	function custom_product_tabs_panel_form( $key, $custom_tab_options ) {

		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		//echo apply_filters( 'woocommerce_custom_product_tabs_panel_form', $content, $custom_tab_options );
		echo apply_filters( 'woocommerce_custom_product_tabs_panel_form', $content, $custom_tab_options );
		//echo do_shortcode($custom_tab_options['tab_content']);
	}
	
	function custom_product_tabs_panel_gallery( $key, $custom_tab_options ) {

		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		//echo apply_filters( 'custom_product_tabs_panel_gallery', $content, $custom_tab_options );
		
		include('frontend-ui/template-gallery.php');
	}
	
	function custom_product_tabs_panel_videoslider( $key, $custom_tab_options ) {
		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		//echo apply_filters( 'custom_product_tabs_panel_videoslider', $content, $custom_tab_options );
		
		include('frontend-ui/template-videoslider.php');
	}


	

	
	function custom_product_tabs_panel_related_post( $key, $custom_tab_options ) {

		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		echo apply_filters( 'custom_product_tabs_panel_related_post', $content, $custom_tab_options );
		
		include('frontend-ui/template-related_post.php');
	}
	
	function custom_product_tabs_panel_faq( $key, $custom_tab_options ) {

		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		//echo apply_filters( 'custom_product_tabs_panel_faq', $content, $custom_tab_options );
		
		include('frontend-ui/template-faq.php');
	}
	
	
	
	function custom_product_tabs_panel_inquiry( $key, $custom_tab_options ) {

		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		//echo apply_filters( 'custom_product_tabs_panel_inquiry', $content, $custom_tab_options );
		
		include('frontend-ui/template-inquiry.php');
	}
	
	function custom_product_tabs_panel_productslider( $key, $custom_tab_options ) {
		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		//echo apply_filters( 'custom_product_tabs_panel_productslider', $content, $custom_tab_options );
		include('frontend-ui/template-productslider.php');
	}
	
	function custom_product_tabs_panel_brands_category( $key, $custom_tab_options ) {
		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		//echo apply_filters( 'custom_product_tabs_panel_productslider', $content, $custom_tab_options );
		include('frontend-ui/template-brands-category.php');
	}
	
	function custom_product_tabs_panel_download( $key, $custom_tab_options ) {

		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		//echo apply_filters( 'custom_product_tabs_panel_download', $content, $custom_tab_options );
		//echo PL.'/includes/frontend-ui/template-download.php';
		include('frontend-ui/template-download.php');
		
	}			

}
new product_custom_tab();
?>