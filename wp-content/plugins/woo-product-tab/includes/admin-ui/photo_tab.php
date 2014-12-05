<?php
	
	global $post,$woocommerce;
	$custom_tab_options = array(
		'public_fields' =>$public_field_array,		
		$public_perfix.'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_posts', true) : get_post_meta(get_the_ID(),$perfix.'tab_posts', true ) ),
		$public_perfix.'tab_height' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_height', true) : get_post_meta(get_the_ID(),$perfix.'tab_height', true ) ),
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
  			  <?php 
        // Select
        woocommerce_wp_select( 
        array( 
            'id'      => $public_perfix.'tab_type',
            'label'   => __( 'Gallery Type', EXTRA_WOO_TABS_TEXTDOMAN ), 
            'description'       => __( 'Choose Gallery Type', EXTRA_WOO_TABS_TEXTDOMAN ),
            'value'	=>@$custom_tab_options[$public_perfix.'tab_type'],
            'options' => array(
                'grid'	  => __( 'Grid View', EXTRA_WOO_TABS_TEXTDOMAN ),
                'slider'	=> __( 'Slider', EXTRA_WOO_TABS_TEXTDOMAN ),
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
            'description'       => __( 'Choose Gallery Grid Image Effect', EXTRA_WOO_TABS_TEXTDOMAN ),
            'value'	=>@$custom_tab_options[$public_perfix.'tab_image_effect'],
            'options' => array(
                'zoomin-eff'	 => __('Zoom In',EXTRA_WOO_TABS_TEXTDOMAN),
                'zoomout-eff'	=> __('Zoom Out',EXTRA_WOO_TABS_TEXTDOMAN),
                'roundright-eff' => __('Rotate Right',EXTRA_WOO_TABS_TEXTDOMAN),
                )
            )
        );
        $dependency = array(
            'parent_id' => $public_perfix.'tab_type',
            'value'	  => 'grid' 	
        );
        dependency($public_perfix.'tab_image_effect',$dependency);
    ?>
    
    <?php 
        // Select
        woocommerce_wp_select( 
        array( 
            'id'      => $public_perfix.'tab_icon_effect',
            'label'   => __( 'Grid Icon Effect', EXTRA_WOO_TABS_TEXTDOMAN ), 
            'description'       => __( 'Choose Gallery Grid Icon Effect', EXTRA_WOO_TABS_TEXTDOMAN ),
            'value'	=>@$custom_tab_options[$public_perfix.'tab_icon_effect'],
            'options' => array(
                'wt-dropup'	  => __('Dropdown',EXTRA_WOO_TABS_TEXTDOMAN), 
                'wt-dropdown'	=> __('DropUp',EXTRA_WOO_TABS_TEXTDOMAN),  
                'wt-scale-eff'	=> __('Scale',EXTRA_WOO_TABS_TEXTDOMAN),  
                )
            )
        );
        $dependency = array(
            'parent_id' => $public_perfix.'tab_type',
            'value'	  => 'grid' 	
        );
        dependency($public_perfix.'tab_icon_effect',$dependency);
    ?>
    
    <?php
        // Number Field
        woocommerce_wp_text_input( 
            array( 
                'id'                => $public_perfix.'tab_height', 
                'label'             => __( 'Slider Height (Pixel)', EXTRA_WOO_TABS_TEXTDOMAN ), 
                'placeholder'       => '', 
                'description'       => __( 'Enter Photo Slider Height.', EXTRA_WOO_TABS_TEXTDOMAN ),
                'type'              => 'number', 
                'desc_tip'   		  => 'true',
                'value' 	  		 => @$custom_tab_options[$public_perfix.'tab_height'],
                'custom_attributes' => array(
                        'step' 	=> 'any',
                        'min'	=> '0'
                    ) 
            )
        );
        $dependency = array(
            'parent_id' => $public_perfix.'tab_type',
            'value'	  => 'slider' 	
        );
        dependency($public_perfix.'tab_height',$dependency);
    ?>
    
    
    <p class="form-field">
        <div class="custom_tab_options" >
                <?php
                    $i = 0;
					$image = PL_URL.'/images/image.png'; 
                ?>	
                <a class="repeatable-add-image button" href="#"><i class="fa fa-plus-square" ></i></a>
                <ul id="custom_repeatables" class="custom_repeatable"><?php
                    $meta=$custom_tab_options[$public_perfix.'tab_posts'];
                    if ($meta) {
                        foreach($meta as $row) {  
                            echo '<li>';
                    
                            if ($row) { $image = wp_get_attachment_image_src($row, array(100, 100)); $image = $image[0]; }
                                echo '
                                    <div>
                                        <span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
										<a class="repeatable-remove-image button" href="#"><i class="fa fa-minus-square" ></i></a>
										<br />
                                        <p class="form-field ">
                                            <label><abbr title="'.__('Upload',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Upload',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                            <input name="'.$public_perfix.'tab_posts['.$i.']" id="'.$public_perfix.'tab_posts" type="hidden" class="custom_upload_image" value="'.(isset($row) ? $row:'').'" /> 
                                    <input name="btn_photo['.$i.']" class="custom_upload_image_button button" type="button" value="'.__('Choose Image',EXTRA_WOO_TABS_TEXTDOMAN).'" />
                                            
                                            <a href="#" class="custom_clear_image_button">'.__('Remove Image',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
                                        </p>
                                    </div>
                                    <div class="preview-img">
                                        <p class="form-field ">
                                            <label><abbr title="'.__('Uploaded Image',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Uploaded Image',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                            <img src="'.$image.'" class="custom_preview_image" alt="" />
                                        </p>
                                    </div>';
                                echo '<hr>
                                </li>'; 
                                        
                                $i++;
                            } //end foreach 
                        } else {  
                            echo '<li>
                                <div>
                                    <span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
									<a class="repeatable-remove-image button" href="#"><i class="fa fa-minus-square" ></i></a>
									<br />
                                    <p class="form-field ">
                                        <label><abbr title="'.__('Upload',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Upload',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                        <input name="'.$public_perfix.'tab_posts['.$i.']" id="'.$public_perfix.'tab_posts" type="hidden" class="custom_upload_image" value="" /> 
                                        <input name="btn_photo['.$i.']" class="custom_upload_image_button button" type="button" value="'.__('Choose Image',EXTRA_WOO_TABS_TEXTDOMAN).'" />
                                        
                                        <a href="#" class="custom_clear_image_button">'.__('Remove Image',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
                                    </p>
                                </div>
                                <div class="preview-img">
                                    <p class="form-field ">
                                        <label><abbr title="'.__('Uploaded Image',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Uploaded Image',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                        <img src="'.$image.'" class="custom_preview_image" alt="" />
                                    </p>
                                </div>
                                    
                                    ';	
                                    echo ' <hr>
                                    </li>';  
                                    
                                    $image='';
                                        
                            }
                        ?>
                </ul>
        </div>
    </p>
    	  </div>
        </div>
     </div>
</div>




