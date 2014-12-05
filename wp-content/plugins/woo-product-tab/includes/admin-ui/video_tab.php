<?php
	
	global $post,$woocommerce;
	$custom_tab_options = array(
		'public_fields' =>$public_field_array,
		$public_perfix.'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_posts', true) : get_post_meta(get_the_ID(),$perfix.'tab_posts', true ) ),
		$public_perfix.'tab_height' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_height', true) : get_post_meta(get_the_ID(),$perfix.'tab_height', true ) ),
		$public_perfix.'tab_type' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_type', true) : get_post_meta(get_the_ID(),$perfix.'tab_type', true ) ),
		$public_perfix.'tab_column' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_column', true) : get_post_meta(get_the_ID(),$perfix.'tab_column', true ) )
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
        // Number Field
        woocommerce_wp_text_input( 
            array( 
                'id'                => $public_perfix.'tab_height', 
                'label'             => __( 'Grid/Silder Height (Pixel)', EXTRA_WOO_TABS_TEXTDOMAN ), 
                'placeholder'       => '', 
                'description'       => __( 'Enter Video Grid/Slider Height.', EXTRA_WOO_TABS_TEXTDOMAN ),
                'type'              => 'number', 
                'desc_tip'   		  => 'true',
                'value' 	  		 => @$custom_tab_options[$public_perfix.'tab_height'],
                'custom_attributes' => array(
                        'step' 	=> 'any',
                        'min'	=> '0'
                    ) 
            )
        );

    ?>

    
    <p class="form-field">
        <div class="custom_tab_options" >
                <?php
                    $i = 0;
					$image = PL_URL.'/images/image.png'; 
                ?>	
                <a class="repeatable-add-video button" href="#"><i class="fa fa-plus-square" ></i></a>
                <ul id="custom_repeatables" class="custom_repeatable"><?php
                    $meta=$custom_tab_options[$public_perfix.'tab_posts'];
                    if ($meta) {
                        foreach($meta as $row) {  
                            
                            echo '<li>';
                    
                            if (isset($row['thumb'])) { $image = wp_get_attachment_image_src($row['thumb'], array(100, 100)); $image = $image[0]; }
                            echo '			
                                <div>
                                    <span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
									<a class="repeatable-remove-video button" href="#"><i class="fa fa-minus-square" ></i></a>
									<br />
                                    <p class="form-field ">
                                        <label><abbr>'.__( 'Upload' , EXTRA_WOO_TABS_TEXTDOMAN ).'</abbr></label>
                                        <input name="'.$public_perfix.'tab_posts['.$i.'][thumb]" id="video_thumb" type="hidden" class="custom_upload_video_thumb" value="'.(isset($row['thumb']) ? $row['thumb']:'').'" /> 
                                <input name="btn_video['.$i.']" class="custom_upload_video_thumb_button button" type="button" value="'.__('Choose Video Thumb' , EXTRA_WOO_TABS_TEXTDOMAN ).'" />
                                        
                                        <a href="#" class="custom_clear_video_thumbnail_button">'.__('Remove Image',EXTRA_WOO_TABS_TEXTDOMAN ).'</a>
                                    </p>
                                </div>
                                <div>
                                    <p class="form-field ">
                                        <label><abbr>'.__('Upload Image', EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                        <img src="'.$image.'" class="custom_preview_video_thumb" alt="" />
                                    </p>
                                </div>';
                            echo '	
                                <div>
                                    <p class="form-field ">
                                        <input type="checkbox" class="video-embed-checkbox" name="'.$public_perfix.'tab_posts['.$i.'][embed]" id="'.$public_perfix.'tab_posts_embed" '.checked( (isset($row['embed']) ? $row['embed']:''), "on" ,0).' value="on"/>
                                        '.__('Check this if you want enter the embed video Youtube.',  EXTRA_WOO_TABS_TEXTDOMAN ).'
                                    </p>
                                    <p class="form-field ">
                                        <label><abbr >'.__('Video Url',  EXTRA_WOO_TABS_TEXTDOMAN ).'</abbr></label>
                                        <input name="'.$public_perfix.'tab_posts['.$i.'][video]" id="video" type="text" class="custom_upload_video" size="63" value="'.(isset($row['video']) ? $row['video']:'').'" />
                                    </p>
                                </div>
                                <hr></li>'; 
                                    
                            $i++;
                        }  
                    }else
                    {
                        echo '<li>
                            <div>
                                <span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
								<a class="repeatable-remove-video button" href="#"><i class="fa fa-minus-square" ></i></a>
								<br />
                                <p class="form-field ">
                                    <label><abbr>'.__('Upload', EXTRA_WOO_TABS_TEXTDOMAN ).'</abbr></label>
                                    <input name="'.$public_perfix.'tab_posts['.$i.'][thumb]" id="custom_video_thumb" type="hidden" class="custom_upload_video_thumb" value="" /> 
                                <input name="btn_video['.$i.']" class="custom_upload_video_thumb_button button" type="button" value="'.__('Choose Video Thumb','extra_product_tab').'" />
                                    
                                    <a href="#" class="custom_clear_video_thumbnail_button">'.__('Remove Image', EXTRA_WOO_TABS_TEXTDOMAN ).'</a>
                                </p>
                            </div>
                            <div>
                                <p class="form-field ">
                                    <label><abbr>'.__('Upload Image', EXTRA_WOO_TABS_TEXTDOMAN ).'</abbr></label>
                                    <img   class="custom_preview_video_thumb" alt=""  />
                                </p>
                            </div>';	
                            
                            echo '	
                            <div>
                                <p class="form-field ">
                                    <input type="checkbox" class="video-embed-checkbox" name="'.$public_perfix.'tab_posts['.$i.'][embed]" id="'.$public_perfix.'tab_posts_embed" value="on"/>
                                    '.__('Check this if you want enter the embed video Youtube.',  EXTRA_WOO_TABS_TEXTDOMAN ).'
                                </p>
                                <p class="form-field ">
                                    <label><abbr >'.__('Video Url', EXTRA_WOO_TABS_TEXTDOMAN ).'</abbr></label>
                                    <input name="'.$public_perfix.'tab_posts['.$i.'][video]" id="custom_video" type="text" class="custom_upload_video" size="63" value="" />
                                </p>
                            </div>
                            <hr></li>'; 
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
    

    
    
