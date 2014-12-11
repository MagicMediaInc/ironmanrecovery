<?php
	
	global $post,$woocommerce;
	$custom_tab_options = array(
		'public_fields' =>$public_field_array,
		$public_perfix.'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_type', true) : get_post_meta(get_the_ID(),$perfix.'tab_type', true ) ),
		$public_perfix.'tab_address' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_address', true) : get_post_meta(get_the_ID(),$perfix.'tab_address', true ) ),
		$public_perfix.'tab_lat' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_lat', true) : get_post_meta(get_the_ID(),$perfix.'tab_lat', true ) ),
		$public_perfix.'tab_long' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_long', true) : get_post_meta(get_the_ID(),$perfix.'tab_long', true ) ),
		$public_perfix.'tab_content' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_content', true) : get_post_meta(get_the_ID(),$perfix.'tab_content', true ) )		
	);
	
	
?>
<div id="<?php echo $perfix_tab;?>_tab" class="panel woocommerce_options_panel">
    <?php
        include("public_fields.php");
    ?>
    <div class="wt-admingeneral wt-advanced">
        <div class="wt-faqcnt ">
          <div class="wt-faqtitle expanded"><h4><?php _e('Advanced Setting',EXTRA_WOO_TABS_TEXTDOMAN);?></h4></div>
          <div class="wt-faqcontent wt-adminadvanced">
  			  
			  <?php 
					// Select
					woocommerce_wp_select( 
					array( 
						'id'      => $public_perfix.'tab_type',
						'label'   => __( 'Map Type', EXTRA_WOO_TABS_TEXTDOMAN ), 
						'description'       => __( 'Choose Map Type', EXTRA_WOO_TABS_TEXTDOMAN ),
						'value'	=>@$custom_tab_options[$public_perfix.'tab_type'],
						'desc_tip'    => 'true',
						'options' => array(
							'address'	=> __( 'Direct Address', EXTRA_WOO_TABS_TEXTDOMAN ),
							'embed'	=> __( 'Embed', EXTRA_WOO_TABS_TEXTDOMAN ),
							'location_point'	=> __( 'Location Point', EXTRA_WOO_TABS_TEXTDOMAN ),
							)
						)
					);
				?>
				
				<?php
					woocommerce_wp_text_input( 
						array( 
							'id'          => $public_perfix.'tab_address', 
							'label'       => __( 'Address', EXTRA_WOO_TABS_TEXTDOMAN ), 
							'placeholder' => '',
							'desc_tip'    => 'true',
							'description' => __( 'Enter Location Address.', EXTRA_WOO_TABS_TEXTDOMAN ) ,
							'value' 	   => @$custom_tab_options[$public_perfix.'tab_address'] 
						)
					);
					
					$dependency = array(
						'parent_id' => $public_perfix.'tab_type',
						'value'	  => 'address' 	
					);
					dependency($public_perfix.'tab_address',$dependency);
				?>
				
				<?php
					// Number Field
					woocommerce_wp_text_input( 
						array( 
							'id'                => $public_perfix.'tab_lat', 
							'label'             => __( 'Latitiude', EXTRA_WOO_TABS_TEXTDOMAN ), 
							'placeholder'       => '', 
							'description'       => __( 'Enter Latitude Point.', EXTRA_WOO_TABS_TEXTDOMAN ),
							'desc_tip'   		  => 'true',
							'value' 	  		 => @$custom_tab_options[$public_perfix.'tab_lat'],
						)
					);
					$dependency = array(
						'parent_id' => $public_perfix.'tab_type',
						'value'	  => 'location_point' 	
					);
					dependency($public_perfix.'tab_lat',$dependency);
				?>
					
				<?php
					// Number Field
					woocommerce_wp_text_input( 
						array( 
							'id'                => $public_perfix.'tab_long', 
							'label'             => __( 'Longtiude', EXTRA_WOO_TABS_TEXTDOMAN ), 
							'placeholder'       => '', 
							'desc_tip'          => 'true',
							'description'       => __( 'Enter Longtiude Point.', EXTRA_WOO_TABS_TEXTDOMAN ),
							'value' 	  		 => @$custom_tab_options[$public_perfix.'tab_long'],
						)
					);
					$dependency = array(
						'parent_id' => $public_perfix.'tab_type',
						'value'	  => 'location_point' 	
					);
					dependency($public_perfix.'tab_long',$dependency);
				?>
					
				<p class="form-field">
				<div class="options_group custom_tab_options <?php echo $public_perfix.'tab_content_field' ?>" " style="width:500px;margin-right: 5px;float:right">
					<label for="video_products_url"><?php _e('Embed Map :', EXTRA_WOO_TABS_TEXTDOMAN); ?></label>             								
					<p class="form-field product_field_type" >
						<?php
							$content =  @$custom_tab_options[$public_perfix.'tab_content'];
							$editor_id = $public_perfix.'tab_content';
							wp_editor( $content, $editor_id );
						?>
					</p>
				</div>
				</p>
				<?php
					$dependency = array(
						'parent_id' => $public_perfix.'tab_type',
						'value'	  => 'embed' 	
					);
					dependency($public_perfix.'tab_content',$dependency);
				?>
    		  <p></p>
    	  </div>
        </div>
     </div>
</div>
    

    
    
