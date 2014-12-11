<?php
	
	global $post,$woocommerce;
	$custom_tab_options = array(
		'public_fields' =>$public_field_array,		
		$public_perfix.'tab_query' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_query', true) : get_post_meta(get_the_ID(),$perfix.'tab_query', true ) ),
		$public_perfix.'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_type', true) : get_post_meta(get_the_ID(),$perfix.'tab_type', true ) ),
		$public_perfix.'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_column', true) : get_post_meta(get_the_ID(),$perfix.'tab_column', true ) ),
		$public_perfix.'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_image_effect', true) : get_post_meta(get_the_ID(),$perfix.'tab_image_effect', true ) ),
		$public_perfix.'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_icon_effect', true) : get_post_meta(get_the_ID(),$perfix.'tab_icon_effect', true ) ),
		$public_perfix.'tab_skin' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_skin', true) : get_post_meta(get_the_ID(),$perfix.'tab_skin', true ) ),
	);
	
	
?>
	<div id="<?php echo $perfix_tab;?>_tab" class="panel woocommerce_options_panel">
	<?php
        if ( in_array( 'woo-brands/main.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
    	{
    ?>
		<?php
        	include("public_fields.php");
		?>
            <div class="wt-admingeneral wt-advanced">
           		<div class="wt-faqcnt ">
            	<div class="wt-faqtitle expanded"><h4>Advanced Setting</h4></div>
            	<div class="wt-faqcontent wt-adminadvanced">
                
                <?php 
                    // Select
                    woocommerce_wp_select( 
                    array( 
                        'id'      => $public_perfix.'tab_query',
                        'label'   => __( 'Select Query', EXTRA_WOO_TABS_TEXTDOMAN ), 
                        'description'       => __( 'Choose Query', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'value'	=>@$custom_tab_options[$public_perfix.'tab_query'],
                        'options' => array(
                            'all_product_brand'	  => __( 'Display All Product from Same Brand', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'featured_product_brand'	=> __( 'Display Featured Product from Same Brand', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'all_product_category'	=> __( 'Display All Product from Same Category', EXTRA_WOO_TABS_TEXTDOMAN ),
							'featured_product_category'	=> __( 'Display Featured Product from Same Category', EXTRA_WOO_TABS_TEXTDOMAN ),
                            )
                        )
                    );
                ?>

                      
                <?php 
                    // Select
                    woocommerce_wp_select( 
                    array( 
                        'id'      => $public_perfix.'tab_type',
                        'label'   => __( 'Display Type', EXTRA_WOO_TABS_TEXTDOMAN ), 
                        'description'       => __( 'Choose Display Type', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'value'	=>@$custom_tab_options[$public_perfix.'tab_type'],
                        'options' => array(
                            'grid'	  => __( 'Grid View', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'carousel'	=> __( 'Carousel', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'list'	=> __( 'List', EXTRA_WOO_TABS_TEXTDOMAN ),
                            )
                        )
                    );
                ?>
                
                <?php 
                    // Select
                    woocommerce_wp_select( 
                    array( 
                        'id'      => $public_perfix.'tab_column',
                        'label'   => __( 'Grid Column', EXTRA_WOO_TABS_TEXTDOMAN ), 
                        'description'       => __( 'Choose Number of Column(s) of Grid', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'value'	=>@$custom_tab_options[$public_perfix.'tab_column'],
                        'options' => array(
                            'wt_col_2_of_2'	  => __( 'One Column', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'wt_col_1_of_2'	  => __( 'Two Columns', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'wt_col_1_of_3'	  => __( 'Three Columns', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'wt_col_1_of_4'	  => __( 'Four Columns', EXTRA_WOO_TABS_TEXTDOMAN ),
                            )
                        )
                    );
                    $dependency = array(
                        'parent_id' => $public_perfix.'tab_type',
                        'value'	  => 'grid' 	
                    );
                    dependency($public_perfix.'tab_column',$dependency);
                    
                ?>
                
                <?php 
                    // Select
                    woocommerce_wp_select( 
                    array( 
                        'id'      => $public_perfix.'tab_skin',
                        'label'   => __( 'Skin', 'extra_product_tab' ), 
                        'description'       => __( 'Choose Skin for Grid and Carousel Type', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'value'	=>@$custom_tab_options[$public_perfix.'tab_skin'],
                        'options' => array(
                            'wt-carskin-light1'	  => __('Light 1', EXTRA_WOO_TABS_TEXTDOMAN ), 
                            'wt-carskin-light2'	=> __('Light 2', EXTRA_WOO_TABS_TEXTDOMAN ),  
                            'wt-carskin-dark1'	=> __('Dark 1', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'wt-carskin-dark2'	=> __('Dark 2', EXTRA_WOO_TABS_TEXTDOMAN ),
                            )
                        )
                    );
                    $dependency = array(
                        'parent_id' => $public_perfix.'tab_type',
                        'value'	  => array('grid','carousel') 	
                    );
                    dependency($public_perfix.'tab_skin',$dependency);
                ?>
                
                
                <?php 
                    // Select
                    woocommerce_wp_select( 
                    array( 
                        'id'      => $public_perfix.'tab_image_effect',
                        'label'   => __( 'Grid Image Effect', EXTRA_WOO_TABS_TEXTDOMAN ), 
                        'description'       => __( 'Choose Gallery Grid Image Effect', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'value'	=>@$custom_tab_options[$public_perfix.'tab_image_effect'],
                        'options' => array(
                            'zoomin-eff'	 => __('Zoom In', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'zoomout-eff'	=> __('Zoom Out', EXTRA_WOO_TABS_TEXTDOMAN ),
                            'roundright-eff' => __('Rotate Right', EXTRA_WOO_TABS_TEXTDOMAN ),
                            )
                        )
                    );
                ?>
                
                <?php 
                    // Select
                    woocommerce_wp_select( 
                    array( 
                        'id'      => $public_perfix.'tab_icon_effect',
                        'label'   => __( 'Grid Icon Effect', EXTRA_WOO_TABS_TEXTDOMAN ), 
                        'description'       => __( 'Choose Grid Icon Effect', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'value'	=>@$custom_tab_options[$public_perfix.'tab_icon_effect'],
                        'options' => array(
                            'wt-dropup'	  => __('Dropdown', EXTRA_WOO_TABS_TEXTDOMAN ), 
                            'wt-dropdown'	=> __('DropUp', EXTRA_WOO_TABS_TEXTDOMAN ),  
                            'wt-scale-eff'	=> __('Scale', EXTRA_WOO_TABS_TEXTDOMAN ),  
                            )
                        )
                    );
                ?>
        	  </div>
            </div>
         </div>
	 <?php
		}else
		{
			echo PL_NOTACTIVE;
		}
     ?>
	</div>
    

    
    
