<?php

	echo '<div id="inquiry-result"></div>';
	echo '<form role="search" method="post" id="send_inquiry">';
	echo '
			<div class="wt_section wt_group animate  '.get_option('woocommerce_tab_animation_type').'-animation">
				<div class="wt_col wt_col_2_of_8">
					<label>
							<span>'.__('Product Name :',EXTRA_WOO_TABS_TEXTDOMAN).'</span>
					</label>
				</div>
				<div class="wt_col wt_col_5_of_8">
					<input type="search" class="search-field" readonly="readonly" value="'.$custom_tab_options['product_name'].'" name="inquiry_pname" title="'.__('Product Name',EXTRA_WOO_TABS_TEXTDOMAN).'">
				</div>
			</div>		
				';
	if($custom_tab_options['tab_name'])
	{
		echo '
			<div class="wt_section wt_group animate  '.get_option('woocommerce_tab_animation_type').'-animation">
				<div class="wt_col wt_col_2_of_8">
					<label>
							<span>'.__('Name:',EXTRA_WOO_TABS_TEXTDOMAN).'</span>
					</label>
				</div>
				<div class="wt_col wt_col_5_of_8">
					<input type="search" class="search-field" placeholder="'.__('Name ...',EXTRA_WOO_TABS_TEXTDOMAN).'" value="" name="inquiry_name" title="'.__('Your Name',EXTRA_WOO_TABS_TEXTDOMAN).'" required="required">
				</div>
			</div>		
				';
	}
	
	if($custom_tab_options['tab_email'])
	{
		echo '
			<div class="wt_section wt_group animate  '.get_option('woocommerce_tab_animation_type').'-animation">
				<div class="wt_col wt_col_2_of_8">
					<label>
							<span >'.__('Email:',EXTRA_WOO_TABS_TEXTDOMAN).'</span>
					</label>
				</div>
				<div class="wt_col wt_col_5_of_8">
					<input type="search" class="search-field" placeholder="'.__('Email ...',EXTRA_WOO_TABS_TEXTDOMAN).'" value="" name="inquiry_email" title="'.__('Your Email',EXTRA_WOO_TABS_TEXTDOMAN).'" required="required" >
				</div>
			</div>
			';

	}
	
	if($custom_tab_options['tab_website'])
	{
		echo '
			<div class="wt_section wt_group animate '.get_option('woocommerce_tab_animation_type').'-animation">
				<div class="wt_col wt_col_2_of_8">
					<label>
							<span >'.__('Website:',EXTRA_WOO_TABS_TEXTDOMAN).'</span>
					</label>
				</div>
				<div class="wt_col wt_col_5_of_8">
					<input type="search" class="search-field" placeholder="'.__('Website ...',EXTRA_WOO_TABS_TEXTDOMAN).'" value="" name="inquiry_website" title="'.__('Your Website',EXTRA_WOO_TABS_TEXTDOMAN).'">
				</div>
			</div>
			';

	}
	
	if($custom_tab_options['tab_address'])
	{
		echo '
			<div class="wt_section wt_group animate '.get_option('woocommerce_tab_animation_type').'-animation">
				<div class="wt_col wt_col_2_of_8">
					<label>
							<span >'.__('Address:',EXTRA_WOO_TABS_TEXTDOMAN).'</span>
					</label>
				</div>
				<div class="wt_col wt_col_5_of_8">
					<input type="search" class="search-field" placeholder="'.__('Address ...',EXTRA_WOO_TABS_TEXTDOMAN).'" value="" name="inquiry_address" title="'.__('Your Address',EXTRA_WOO_TABS_TEXTDOMAN).'">
				</div>
			</div>
			';

	}
	
	if($custom_tab_options['tab_desc'])
	{
		echo '
			<div class="wt_section wt_group animate '.get_option('woocommerce_tab_animation_type').'-animation">
				<div class="wt_col wt_col_2_of_8">
					<label>
							<span >'.__('Description:',EXTRA_WOO_TABS_TEXTDOMAN).'</span>
					</label>
				</div>
				<div class="wt_col wt_col_5_of_8">
					<textarea cols="34" class="search-field" placeholder="'.__('Description ...',EXTRA_WOO_TABS_TEXTDOMAN).'" name="inquiry_description" title="'.__('Your Deacription',EXTRA_WOO_TABS_TEXTDOMAN).'"></textarea>
				</div>
			</div>
			';

	}
	
	
	require_once('recaptchalib.php');
	echo '
			<div class="wt_section wt_group animate '.get_option('woocommerce_tab_animation_type').'-animation">
				<div class="wt_col wt_col_2_of_8">
					<label>
							<span >'.__('Enter Captcha',EXTRA_WOO_TABS_TEXTDOMAN).'</span>
					</label>
				</div>
				<div class="wt_col wt_col_5_of_8" id="captcha_key">
					';
					echo recaptcha_get_html(get_option('woocommerce_tab_public_key'));
				echo '</div>
			</div>
			';
	
	
	echo '
		<div class="wt_section wt_group animate '.get_option('woocommerce_tab_animation_type').'-animation">
			<div class="wt_col wt_col_2_of_8">
			</div>
			<div class="wt_col wt_col_5_of_8 right-txt">
				<input type="hidden" name="id_product"  value="'.$custom_tab_options['post_id'].'" />
				<input type="hidden" name="post_hidden"  value="Y" />
				<input type="submit" class="search-submit" value="'.__('Send',EXTRA_WOO_TABS_TEXTDOMAN).'">
			</div>
		</div>
	</form>';
	
	add_action('wp_footer','footer_add_scripts');
	function footer_add_scripts()
	{
		?>
        <script>
				jQuery(document).ready(function(){
					jQuery("#send_inquiry").submit(function(e){
						e.preventDefault() 
						jQuery('.search-submit').val('<?php _e('Sending...',EXTRA_WOO_TABS_TEXTDOMAN);?>');
						jQuery('#inquiry-result').html('<i class="fa fa-refresh fa-spin"></i> <?php _e('Please Wait...',EXTRA_WOO_TABS_TEXTDOMAN);?>');
						var params=jQuery("#send_inquiry").serialize();
						jQuery.ajax ({
							type: "POST",
							url: "<?php echo admin_url( 'admin-ajax.php' )?>",
							data: params+"&action=sendmail",
							success: function(response) {
								jQuery('#inquiry-result').html(response); 
								Recaptcha.reload(); 
								jQuery('.search-submit').val('<?php _e('Send',EXTRA_WOO_TABS_TEXTDOMAN);?>');
								jQuery("#send_inquiry").get(0).reset()                 
							}
						});
					});
				});
			</script>
        <?php    
	}
	?>
