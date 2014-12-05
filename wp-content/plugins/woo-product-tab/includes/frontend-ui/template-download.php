<?php 
	echo '<div class="wt_section wt_group wt-gallerycnt">';
	if(is_array($custom_tab_options['tab_posts']))
	{
		foreach($custom_tab_options['tab_posts'] as $link)
		{
			$file=(isset($link['link']) ? $link['link']: wp_get_attachment_url( $link['file'] ) );
			echo '<div class="wt_section wt_group wt-listitem animate '.get_option('woocommerce_tab_animation_type').'-animation " >
					<div class="wt_col wt_col_6_of_8">
						<div class="wt-detailcnt">
							<h4 class="wt-title left-txt">'.(isset($link['title']) ? $link['title']:'').'</h4>
							<p class="wt-text left-txt">'.(isset($link['description']) ? $link['description']:'').'</p>
						</div>	
					</div>
					
					<div class="wt_col wt_col_2_of_8 right-txt">
						<div class="wt-downlink right-txt"><a target="_blank" href="'.$file.'">'.__('DOWNLOAD',EXTRA_WOO_TABS_TEXTDOMAN).'</a></div>
					</div>
				 </div>';
		}
	}else
	{
		echo __( 'Download File Not available' , EXTRA_WOO_TABS_TEXTDOMAN );
	}
	echo '</div>';
?>