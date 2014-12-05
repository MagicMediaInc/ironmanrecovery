<?php
	
	global $post,$woocommerce;
	$custom_tab_options = array(
		'public_fields' =>$public_field_array,
		$public_perfix.'tab_posts' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_posts', true) : get_post_meta(get_the_ID(),$perfix.'tab_posts', true ) )
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
                    <p class="form-field">
                    <div class="custom_tab_options" >
                            <?php
                                $i = 0;
                            ?>	
                            <a class="repeatable-add-download button" href="#"><i class="fa fa-plus-square" ></i></a>
                            <ul id="custom_repeatables" class="custom_repeatable">
                            <?php
                                $meta=$custom_tab_options[$public_perfix.'tab_posts'];
                                if ($meta) {
                                    foreach($meta as $row) {  
                                        
                                        echo '<li>';
                                        echo '
                                            <div>
                                                <span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
												<a class="repeatable-remove-download button" href="#"><i class="fa fa-minus-square" ></i></a>
												<br />
                                                <p class="form-field ">
                                                    <label><abbr class="custom_download_name">'.(isset($row['file']) ? '<i class=\'fa fa-check\'></i>'.__('File Uploaded',EXTRA_WOO_TABS_TEXTDOMAN).'</label>':'<i class=\'fa fa-times\'></i>'.__('No File Uploaded',EXTRA_WOO_TABS_TEXTDOMAN).'</label>').'</abbr></label>
                                                    <input name="'.$public_perfix.'tab_posts['.$i.'][file]" id="'.$public_perfix.'tab_posts_file" type="hidden" class="custom_upload_download" value="'.(isset($row['file']) ? $row['file']:'').'" /> 
                                                <input name="btn_download['.$i.']" class="custom_upload_download_button button" type="button" value="'.__('Choose File',EXTRA_WOO_TABS_TEXTDOMAN).'" />
												<a href="#" class="custom_clear_download_button">'.__('Remove File',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
                                                </p>
                                            </div>';
                                        echo '	
                                            <div>
                                                <p class="form-field ">
													<label><abbr title="'.__('Download Link',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('<-OR->',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
													<br />
                                                    <label><abbr title="'.__('Download Link',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Download Link',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                                    <input name="'.$public_perfix.'tab_posts['.$i.'][link]" id="'.$public_perfix.'tab_posts_link" type="text" class="custom_upload_link" size="45" value="'.(isset($row['link']) ? $row['link']:'').'" />
                                                </p>
                                            </div>
                                            <div>
                                                <p class="form-field ">
                                                    <label><abbr title="'.__('Link Title',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Link Title',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                                    <input type="text" name="'.$public_perfix.'tab_posts['.$i.'][title]" id="'.$public_perfix.'tab_posts_title" size="45" class="width_170" value="'.(isset($row['title']) ? $row['title']:'').'"/>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="form-field ">
                                                    <label><abbr title="'.__('Link Title',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Download Description',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>';
                                                    echo hc_tinymce(array(
                                                            'id' 	=> $public_perfix.'tab_posts_'.rand(0,100),
                                                            'name' 	=> $public_perfix.'tab_posts['.$i.'][description]',
                                                            'value' => (isset($row['description']) ? $row['description']:''),
                                                            'rows' 	=> 15,
                                                            'class' =>'product_download_tab_description'
                                                        ));
                                                        
                                                echo '</p>
                                            </div>';
                                                echo '<hr>
                                            </li>'; 
                                                
                                        $i++;
                                    }  
                                } else {  
                                    echo '<li>';
                                    echo '
                                            <div>
                                                <span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
												<a class="repeatable-remove-download button" href="#"><i class="fa fa-minus-square" ></i></a>
												<br />
                                                <p class="form-field ">
                                                    <label><abbr class="custom_download_name"><i class=\'fa fa-times\'></i>'.__('No File Uploaded',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                                    <input name="'.$public_perfix.'tab_posts['.$i.']" id="'.$public_perfix.'tab_posts" type="hidden" class="custom_upload_download" value="" /> 
                                            <input name="btn_download['.$i.']" class="custom_upload_download_button button" type="button" value="'.__('Choose File',EXTRA_WOO_TABS_TEXTDOMAN).'" />
                                                    
                                                    <a href="#" class="custom_clear_download_button">'.__('Remove File',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
                                                </p>
                                            </div>';
                                    echo '	
                                            <div>
                                                <p class="form-field ">
													<label><abbr title="'.__('Download Link',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('<-OR->',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
													<br />
                                                    <label><abbr title="'.__('Download Link',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Download Link',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                                    <input name="'.$public_perfix.'tab_posts['.$i.'][link]" id="'.$public_perfix.'tab_posts_link" type="text" class="custom_upload_link" size="45" value="'.(isset($row['link']) ? $row['link']:'').'" />
                                                </p>
                                            </div>
                                            <div>
                                                <p class="form-field ">
                                                    <label><abbr title="'.__('Link Title',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Link Title',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
                                                    <input type="text" name="'.$public_perfix.'tab_posts['.$i.'][title]" id="'.$public_perfix.'tab_posts_title" size="45" class="width_170"/>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="form-field ">
                                                    <label><abbr title="'.__('Link Title',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Download Description',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>';
                                                    
                                                    echo hc_tinymce(array(
                                                            'id' 	=> $public_perfix.'tab_posts_'.rand(0,100),
                                                            'name' 	=> $public_perfix.'tab_posts['.$i.'][description]',
                                                            'value' => '',
                                                            'rows' 	=> 15,
                                                            'class' =>'product_download_tab_description'
                                                        ));
                                                echo '</p>
                                            </div>';
                                        echo '<hr>
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
    

    
    
