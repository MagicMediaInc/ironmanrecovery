<?php

function show_mini_cart() {
    
    ?>
    
    <div class="mini-cart-wrap">
        <?php
        global $woocommerce;
		
        ob_start();

        $cart_count = $woocommerce->cart->cart_contents_count;
        $cart_count_text = sf_product_items_text($cart_count);

        ?>	
        <div class="parent shopping-bag-ite">
            <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('Veja o seu carrinho', 'swiftframework'); ?>"><i class="sf-cart"></i><?php echo $woocommerce->cart->get_cart_total(); ?></a>

        <ul class="sub-menu">     
        <li>                                      
        <div class="shopping-bag">

        <?php if ( sizeof($cart_count)>0 ) { ?>

        <div class="bag-header"><?php echo $cart_count_text; ?> <?php _e('na sacola de compras', 'swiftframework'); ?></div>

        <div class="bag-contents">

        <?php foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) { ?>

        <?php
        $bag_product = $cart_item['data']; 
        $product_title = $bag_product->get_title();
        ?>

        <?php if ($bag_product->exists() && $cart_item['quantity']>0) { ?>                                            

        <div class="bag-product clearfix">   	

        <figure><a class="bag-product-img" href="<?php echo get_permalink($cart_item['product_id']); ?>"><?php echo $bag_product->get_image(); ?></a></figure>                   

        <div class="bag-product-details">
                    <div class="bag-product-title">
                            <a href="<?php echo get_permalink($cart_item['product_id']); ?>">
                                    <?php echo apply_filters('woocommerce_cart_widget_product_title', $product_title, $bag_product); ?></a>
                    </div>
            <div class="bag-product-price"><?php _e("Preço Unitário:", "swiftframework"); ?> <?php echo woocommerce_price($bag_product->get_price()); ?></div>
            <div class="bag-product-quantity"><?php _e('Quantidade:', 'swiftframework'); ?> <?php echo $cart_item['quantity']; ?></div>
        </div>

        <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remover este item', 'woocommerce') ), $cart_item_key ); ?>

        </div>

        <?php } ?>

        <?php } ?>

        </div>

        <div class="bag-buttons">
        <?php
        
        $span="portugues";
        
        ?>

        <a class="sf-roll-button bag-button" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><?php _e('Ver saco de compras', 'swiftframework'); ?></span><span><?php _e('View shopping bag', 'swiftframework'); ?></span></a>

        <a class="sf-roll-button checkout-button" href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>"><span><?php _e('Fazer o pagamento', 'swiftframework'); ?></span><span><?php _e('Proceed to checkout', 'swiftframework'); ?></span></a>

        </div>

        <?php } else { ?>

        <div class="bag-header"><?php _e("0 items in the shopping bag", "swiftframework"); ?></div>

        <div class="bag-empty"><?php _e('Unfortunately, your shopping bag is empty.','swiftframework'); ?></div>                                   

        <div class="bag-buttons">

        <?php $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>

        <a class="sf-roll-button shop-button" href="<?php echo esc_url( $shop_page_url ); ?>"><span><?php _e('Go to the shop', 'swiftframework'); ?></span><span><?php _e('Go to the shop', 'swiftframework'); ?></span></a>

        </div>

        <?php } ?>

        </div>
        </li>                                                                                                    
        </ul>                                                                                                          
        </div>


        </div>     

    <?php
}
?>

<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

	<!--// OPEN HEAD //-->
	<head>
		<script>
			var url_home = "<?php echo get_home_url(); ?>";		
		</script>
		<?php
			$options = get_option('sf_neighborhood_options');
			$enable_responsive = $options['enable_responsive'];
			$is_responsive = "responsive-fluid";
			if (!$enable_responsive) {
				$is_responsive = "responsive-fixed";
			}
			$header_layout = $options['header_layout'];
			$page_layout = $options['page_layout'];
			
			$enable_logo_fade = $options['enable_logo_fade'];
			$enable_page_shadow = $options['enable_page_shadow'];
			$enable_top_bar = $options['enable_tb'];
			
			$enable_mini_header = $options['enable_mini_header'];
			
			$enable_header_shadow = $options['enable_header_shadow'];
			$header_overlay = $options['header_overlay'];
			$enable_promo_bar = $options['enable_promo_bar'];
			
			$page_class = $logo_class = $ss_enable = "";
			
			global $catalog_mode;
			
			if (isset($options['enable_catalog_mode'])) {
				$enable_catalog_mode = $options['enable_catalog_mode'];
				if ($enable_catalog_mode) {
					$catalog_mode = true;
					$page_class = "catalog-mode ";
				}
			}
			
			
			if ($enable_page_shadow) { 
			$page_class .= "page-shadow ";
			}
			
			if ($enable_header_shadow) {
			$page_class .= "header-shadow ";
			}
			
			if ($header_overlay) {
			$page_class .= "header-overlay ";
			}
			
			if ($enable_promo_bar) {
			$page_class .= "has-promo-bar ";
			}
			
			if ($enable_logo_fade) {
			$logo_class = "logo-fade";
			}

			if (isset($_GET['layout'])) {
				$page_layout = $_GET['layout'];
			}
			
			if (isset($options['ss_enable'])) {
				$ss_enable = $options['ss_enable'];
			} else {
				$ss_enable = true;
			}
			
			global $post;
			$extra_page_class = "";
			if ($post) {
			// $extra_page_class = get_post_meta($post->ID, 'sf_extra_page_class', true);
			}
		?>
		
		<!--// SITE TITLE //-->
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		
		
		<!--// SITE META //-->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />	
		<?php if ($enable_responsive) { ?><meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"><?php } ?>
		
		
		<!--// PINGBACK & FAVICON //-->
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php if (isset($options['custom_favicon'])) { ?><link rel="shortcut icon" href="<?php echo $options['custom_favicon']; ?>" /><?php } ?>
		
		<?php
			$custom_fonts = $google_font_one = $google_font_two = $google_font_three = "";

			$body_font_option = $options['body_font_option'];
			if (isset($options['google_standard_font'])) {
			$google_standard_font = explode(':', $options['google_standard_font']);
			$google_font_one = str_replace("+", " ", $google_standard_font[0]);
			}
			$headings_font_option = $options['headings_font_option'];
			if (isset($options['google_heading_font'])) {
			$google_heading_font = explode(':', $options['google_heading_font']);
			$google_font_two = str_replace("+", " ", $google_heading_font[0]);
			}
			
			$menu_font_option = $options['menu_font_option'];
			if (isset($options['google_menu_font'])) {
			$google_menu_font = explode(':', $options['google_menu_font']);
			$google_font_three = str_replace("+", " ", $google_menu_font[0]);
			}
			
			    
			if ($body_font_option == "google" && $google_font_one != "") {
				$custom_fonts .= "'".$google_font_one."', ";
			}
			if ($headings_font_option == "google" && $google_font_two != "") {
				$custom_fonts .= "'".$google_font_two."', ";
			}
			if ($menu_font_option == "google" && $google_font_three != "") {
				$custom_fonts .= "'".$google_font_three."', ";
			}
			
			$fontdeck_js = $options['fontdeck_js'];
		?>
		<?php if (($body_font_option == "google") || ($headings_font_option == "google") || ($menu_font_option == "google")) { ?>
		<!--// GOOGLE FONT LOADER //-->
		<script>
			var html = document.getElementsByTagName('html')[0];
			html.className += '  wf-loading';
			setTimeout(function() {
			  html.className = html.className.replace(' wf-loading', '');
			}, 3000);
			
			WebFontConfig = {
			    google: { families: [<?php echo $custom_fonts; ?> 'Vidaloka'] }
			};
			
			(function() {
				document.getElementsByTagName("html")[0].setAttribute("class","wf-loading")
				//  NEEDED to push the wf-loading class to your head
				document.getElementsByTagName("html")[0].setAttribute("className","wf-loading")
				// for IE…
			
			var wf = document.createElement('script');
				wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				 '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'false';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
			})();			
		</script>
		<?php } ?>
		<?php if (($body_font_option == "fontdeck") || ($headings_font_option == "fontdeck") || ($menu_font_option == "fontdeck")) { ?>
		<!--// FONTDECK LOADER //-->
		<?php echo $fontdeck_js; ?>
		<?php } ?>
		
			<!--// LEGACY HTML5 SUPPORT //-->
			<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/excanvas.compiled.js"></script>
		<![endif]-->
		
		<!--// WORDPRESS HEAD HOOK //-->
		<?php wp_head(); ?>
	
	<!--// CLOSE HEAD //-->
	</head>
	
	<!--// OPEN BODY //-->
	<body <?php body_class($page_class.' '.$is_responsive.' '.$extra_page_class); ?>>
		<input type="hidden" name="languague" id="lang" value="pt"/>
		<!--// NO JS ALERT //-->
		<noscript>
			<div class="no-js-alert"><?php _e("Please enable JavaScript to view this website.", "swiftframework"); ?></div>
		</noscript>	
		
		<!--// OPEN #container //-->
		<?php if ($page_layout == "fullwidth") { ?>
		<div id="container">
		<?php } else { ?>
		<div id="container" class="boxed-layout">
		<?php } ?>
			
			<?php
				if ($ss_enable) { 
					// echo sf_super_search();
				}
			?>
			
			<!--// HEADER //-->
			<div class="header-wrap">
				
				<?php if ($enable_top_bar) { ?>
					<!--// TOP BAR //-->
					<?php echo sf_top_bar(); ?>
				<?php } ?>	
					
				<div id="header-section" class="<?php echo $header_layout; ?> <?php echo $logo_class; ?>">
				<?php echo sf_header(); ?>
                                <?php show_mini_cart(); ?>
				</div>
				<?php if ($enable_promo_bar) { ?>
					<!--// OPEN #promo-bar //-->
					<div id="promo-bar">
						<div class="container">
							<?php echo $options['promo_bar_text']; ?>
						</div>
					</div>
					
				<?php } ?>
			</div>
			
			<?php if ($enable_mini_header) { ?>
			<div id="mini-header">
                                
				<?php echo sf_mini_header(); ?>
                                <?php show_mini_cart(); ?>
                                </div>
			
			<?php } ?>
				
			<!--// OPEN #main-container //-->
			<div id="main-container" class="clearfix">
				
				<?php if (is_page()) {
						$show_posts_slider = get_post_meta($post->ID, 'sf_posts_slider', true);
						$rev_slider_alias = get_post_meta($post->ID, 'sf_rev_slider_alias', true);
						if ($show_posts_slider) {
							sf_swift_slider();
						} else if ($rev_slider_alias != "") { ?>
							<div class="home-slider-wrap">
								<?php
									
										putRevSlider("sliderHomePortugues");
								 ?>
							</div>
				<?php }
					}
				?>
				
				<!--// OPEN .container //-->
				<div class="container">
				
					<!--// OPEN #page-wrap //-->
					<div id="page-wrap">
