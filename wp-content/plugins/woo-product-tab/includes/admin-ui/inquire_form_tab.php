<?php
	
	global $post,$woocommerce;
	$custom_tab_options = array(
		'public_fields' =>$public_field_array,
		$public_perfix.'tab_name' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_name', true) : get_post_meta(get_the_ID(),$perfix.'tab_name', true ) ),
		$public_perfix.'tab_email' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_email', true) : get_post_meta(get_the_ID(),$perfix.'tab_email', true ) ),
		$public_perfix.'tab_website' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_website', true) : get_post_meta(get_the_ID(),$perfix.'tab_website', true ) ),
		$public_perfix.'tab_address' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_address', true) : get_post_meta(get_the_ID(),$perfix.'tab_address', true ) ),
		$public_perfix.'tab_desc' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_desc', true) : get_post_meta(get_the_ID(),$perfix.'tab_desc', true ) ),
		
	);
	
	//die(print_r($custom_tab_options));
	
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
                if(get_post_meta($post_id, $public_perfix.'tab_name', true)=='sds')
                {
            ?>
             
            <p class="form-field">  
                <label ><?php _e('INQUIRY FORM FIELDS',EXTRA_WOO_TABS_TEXTDOMAN);?></label>
                <?php
                    if($custom_tab_options[$public_perfix.'tab_name']=='')
                    {
                        echo '<i class="fa fa-times"></i> '.__('"Name" Field Don`t Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                    else
                    {
                        echo '<i class="fa fa-check"></i> '.__('"Name" Field Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                ?>
            </p>
            
            <p class="form-field">  
                <?php
                    if($custom_tab_options[$public_perfix.'tab_name']=='')
                    {
                        echo '<i class="fa fa-times"></i> '.__('"Email" Field Don`t Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                    else
                    {
                        echo '<i class="fa fa-check"></i> '.__('"Email" Field Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                ?>
            </p>
            
            <p class="form-field">  
                <?php
                    if($custom_tab_options[$public_perfix.'tab_website']=='')
                    {
                        echo '<i class="fa fa-times"></i> '.__('"Website" Field Don`t Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                    else
                    {
                        echo '<i class="fa fa-check"></i> '.__('"Website" Field Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                ?>
            </p>
            
            <p class="form-field">  
                <?php
                    if($custom_tab_options[$public_perfix.'tab_address']=='')
                    {
                        echo '<i class="fa fa-times"></i> '.__('"Address" Field Don`t Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                    else
                    {
                        echo '<i class="fa fa-check"></i> '.__('"Address" Field Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                ?>
            </p>
            
            <p class="form-field">  
                <?php
                    if($custom_tab_options[$public_perfix.'tab_description']=='')
                    {
                        echo '<i class="fa fa-times"></i> '.__('"Description" Field Don`t Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                    else
                    {
                        echo '<i class="fa fa-check"></i> '.__('"Description" Field Display in Form', EXTRA_WOO_TABS_TEXTDOMAN );
                    }
                ?>
            </p>
            <?php 
                }
                else
                {
            ?>
            <p class="form-field">
            <?php 
               
			    woocommerce_wp_checkbox( 
				array( 
					'id'            => $public_perfix.'tab_name', 
					'wrapper_class' => 'show_if_simple', 
					'label'         => __('Name Field', EXTRA_WOO_TABS_TEXTDOMAN ), 
                    'description'   => __( 'Add Name Field to Form.', EXTRA_WOO_TABS_TEXTDOMAN ),
					'value' =>  $custom_tab_options[$public_perfix.'tab_name'], 
                    'cbvalue' => 'yes',
					)
				);
			   
			    woocommerce_wp_checkbox( 
				array( 
					'id'            => $public_perfix.'tab_email', 
					'wrapper_class' => 'show_if_simple', 
					'label'         => __('Email Field', EXTRA_WOO_TABS_TEXTDOMAN ), 
                    'description'   => __( 'Add Email Field to Form.', EXTRA_WOO_TABS_TEXTDOMAN ) ,
					'value' =>  $custom_tab_options[$public_perfix.'tab_email'], 
                    'cbvalue' => 'yes',
					)
				);
			   
			   
                
                woocommerce_wp_checkbox( 
				array( 
					'id'            => $public_perfix.'tab_website', 
					'wrapper_class' => 'show_if_simple', 
					'label'         => __('Website Field', EXTRA_WOO_TABS_TEXTDOMAN ), 
                    'description'   => __( 'Add Website Url Field to Form.', EXTRA_WOO_TABS_TEXTDOMAN ) ,
					'value' =>  $custom_tab_options[$public_perfix.'tab_website'], 
                    'cbvalue' => 'yes',
					)
				);
			   
    
                
                woocommerce_wp_checkbox( 
				array( 
					'id'            => $public_perfix.'tab_address', 
					'wrapper_class' => 'show_if_simple', 
					'label'         => __('Address Field', EXTRA_WOO_TABS_TEXTDOMAN ), 
                    'description'   => __( 'Add Address Field to Form.', EXTRA_WOO_TABS_TEXTDOMAN ) ,
					'value' =>  $custom_tab_options[$public_perfix.'tab_address'], 
                    'cbvalue' => 'yes',
					)
				);
			   
                
                woocommerce_wp_checkbox( 
				array( 
					'id'            => $public_perfix.'tab_desc', 
					'wrapper_class' => 'show_if_simple', 
					'label'         => __('Description Field', EXTRA_WOO_TABS_TEXTDOMAN ), 
                    'description'   => __( 'Add Description Field to Form.', EXTRA_WOO_TABS_TEXTDOMAN ) ,
					'value' =>  $custom_tab_options[$public_perfix.'tab_desc'], 
                    'cbvalue' => 'yes',
					)
				);

             
            ?>
            </p>
            <?php }?>
          </div>
        </div>
     </div>
</div>