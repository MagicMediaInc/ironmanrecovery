<?php
	
	global $post,$woocommerce;
	$custom_tab_options = array(
		'public_fields' =>$public_field_array,
		$public_perfix.'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_posts', true) : get_post_meta(get_the_ID(),$perfix.'tab_posts', true ) ),
		$public_perfix.'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_type', true) : get_post_meta(get_the_ID(),$perfix.'tab_type', true ) ),
		$public_perfix.'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_column', true) : get_post_meta(get_the_ID(),$perfix.'tab_column', true ) ),
		$public_perfix.'tab_image_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_image_effect', true) : get_post_meta(get_the_ID(),$perfix.'tab_image_effect', true ) ),
		$public_perfix.'tab_icon_effect' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_icon_effect', true) : get_post_meta(get_the_ID(),$perfix.'tab_icon_effect', true ) )
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
   			 <p class="form-field product_field_type">
        <label for="style_with_products"><?php _e( 'Related Post', EXTRA_WOO_TABS_TEXTDOMAN ); ?></label>
        <select style="width: 350px; display: none;" multiple="" class="related-posts" tabindex="-1" data-placeholder="<?php _e( 'Search for Posts&hellip;', EXTRA_WOO_TABS_TEXTDOMAN ); ?>" name="<?php echo $public_perfix.'tab_posts[]';?>">
            <option value=""></option>
            <?php
            $args_post = array('post_type' => 'post','posts_per_page'=>-1);
            $loop_post = new WP_Query( $args_post );
            $option_data='';
            while ( $loop_post->have_posts() ) : $loop_post->the_post();
                $selected='';
                $meta=$custom_tab_options[$public_perfix.'tab_posts'];
                if(is_array($meta))
                {
                    $selected=(in_array(get_the_ID(),$meta) ? "SELECTED":"");
                }
                $option_data.='<option '.$selected.' value="'.get_the_ID().'">'.get_the_title().'</option>';
            endwhile;
            echo $option_data;
            ?>
        </select>
        <img class="help_tip" data-tip='<?php _e( 'Choose Related Post', EXTRA_WOO_TABS_TEXTDOMAN ) ?>' src="<?php echo $woocommerce->plugin_url(); ?>/assets/images/help.png" height="16" width="16" />   
    </p>
    
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
                'list'	=> __( 'List View', EXTRA_WOO_TABS_TEXTDOMAN ),
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
            'description'       => __( 'Choose Number of Column(s)', EXTRA_WOO_TABS_TEXTDOMAN ),
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
            'id'      => $public_perfix.'tab_image_effect',
            'label'   => __( 'Grid Image Effect', EXTRA_WOO_TABS_TEXTDOMAN ), 
            'description'       => __( 'Choose Grid Image Effect', EXTRA_WOO_TABS_TEXTDOMAN ),
            'value'	=>@$custom_tab_options[$public_perfix.'tab_image_effect'],
            'options' => array(
                'zoomin-eff'	 => __('Zoom In',EXTRA_WOO_TABS_TEXTDOMAN),
                'zoomout-eff'	=> __('Zoom Out',EXTRA_WOO_TABS_TEXTDOMAN),
                'roundright-eff' => __('Rotate Right',EXTRA_WOO_TABS_TEXTDOMAN),
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
                'wt-dropup'	  => __('Dropdown',EXTRA_WOO_TABS_TEXTDOMAN), 
                'wt-dropdown'	=> __('DropUp',EXTRA_WOO_TABS_TEXTDOMAN),  
                'wt-scale-eff'	=> __('Scale',EXTRA_WOO_TABS_TEXTDOMAN),  
                )
            )
        );
    ?>
   		  </div>
        </div>
     </div>
</div>
    

    
    
