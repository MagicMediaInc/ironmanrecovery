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
            <div class="custom_tab_options">
                	<?php
                    	$i = 0;
					?>	
					<a class="repeatable-add-faq button" href="#"><i class="fa fa-plus-square" ></i></a>
                    <ul id="custom_repeatables" class="custom_repeatable">
					<?php
						$meta=$custom_tab_options[$public_perfix.'tab_posts'];
						if ($meta) {
									
							foreach($meta as $row) {  
								
								echo '<li>';
								echo '	
									<div>
										<span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span><br />
										<p class="form-field ">
											<label><abbr title="'.__('Question',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Question',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
											<input type="text" name="'.$public_perfix.'tab_posts['.$i.'][question]" id="'.$public_perfix.'tab_posts_question" size="30" class="width_170" value="'.(isset($row['question']) ? $row['question']:'').'"/> 
											<a class="repeatable-remove-faq button" href="#"><i class="fa fa-minus-square" ></i></a>
										</p>
									</div>
									
									<div>
										<p class="form-field ">
											<label><abbr title="'.__('Answer',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Answer',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>';
											echo hc_tinymce(array(
													'id' 	=> $public_perfix.'tab_posts_'.rand(0,100),
													'name' 	=> $public_perfix.'tab_posts['.$i.'][answer]',
													'value' => (isset($row['answer']) ? $row['answer']:''),
													'rows' 	=> 15,
													'class' =>'product_faq_tab_answer'
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
										<span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span><br />
										<p class="form-field ">
											<label><abbr title="'.__('Question',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Question',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
											<input type="text" name="'.$public_perfix.'tab_posts['.$i.'][question]" id="'.$public_perfix.'tab_posts_question" size="30" class="width_170" /> 
											<a class="repeatable-remove-faq button" href="#"><i class="fa fa-minus-square" ></i></a>
										</p>
									</div>
									
									<div>
										<p class="form-field ">
											<label><abbr title="'.__('Answer',EXTRA_WOO_TABS_TEXTDOMAN).'">'.__('Answer',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>';
											echo hc_tinymce(array(
												'id' 	=> $public_perfix.'tab_posts_'.rand(0,100),
												'name' 	=> $public_perfix.'tab_posts['.$i.'][answer]',
												'value' => '',
												'rows' 	=> 15,
												'class' =>'product_faq_tab_answer'
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