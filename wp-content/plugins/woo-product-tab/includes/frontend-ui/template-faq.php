<?php 
	echo '<div class="wt-faq">';
	if(is_array($custom_tab_options['tab_posts']))
	{
		foreach($custom_tab_options['tab_posts'] as $faq)
		{
			echo '
				<div class="wt-faqcnt animate  '.get_option('woocommerce_tab_animation_type').'-animation">
				  <div class="wt-faqtitle">'.$faq['question'].'</div>
				  <div class="wt-faqcontent">'.$faq['answer'].'</div>
			  </div>';
		}
	}
	else
	{
		echo __( 'Not available Faq' , EXTRA_WOO_TABS_TEXTDOMAN );
	}
	echo '</div>';

?>