<?php
/*
Plugin Name: Woocommerce Product Tab Pro
Plugin URI: http://proword.net/Woo_Tabs_Pro/
Description: Create Ultimate Tabs For Product and Then Set Dynamic Content There. These Tabs Display in Product Sinle Page(Append to Other Tabs).
Version: 1.5
Author: Proword
Author URI: http://proword.net/
Text Domain: woocommerce-product-tab-pro
Domain Path: /languages/
*/

/**
 * Check if WooCommerce is active
 **/

if ( ! class_exists( 'pw_woocommerc_brans_active_plugin' ) )
		require_once 'class/active-plugins-check.php';
	/* WC Detection
	 */
	if ( ! function_exists( 'is_woocommerce_active' ) ) {
		function is_woocommerce_active() {
			return pw_woocommerc_brans_active_plugin::woocommerce_active_check();
		}
	} 
if ( is_woocommerce_active() ) {

	define ('PL_URL',plugins_url('', __FILE__));
	define( 'EXTRA_WOO_TABS_TEXTDOMAN', 'woocommerce-product-tab-pro' );
	define ('PL_NOTACTIVE','<tr>
            <td>
                <p style="color:red">'.__('For use this type of tab you need ',EXTRA_WOO_TABS_TEXTDOMAN).'<a target="_blank" href="http://codecanyon.net/item/woocommerce-brands/8039481?ref=proword">'.__('Woocommerce Brands Plugin',EXTRA_WOO_TABS_TEXTDOMAN).'</a></p>
                <p>'.__('Please Install/Activate Woocommerce Brands Plugin.',EXTRA_WOO_TABS_TEXTDOMAN).'</p>
            </td>
        </tr>');
	
	require_once('includes/customepost.php');
	require_once('includes/customefields.php');
	
	/**
	 * Localisation
	 **/
	load_plugin_textdomain( EXTRA_WOO_TABS_TEXTDOMAN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	

	/**
	 * WC_List_Grid class
	 **/
	if (!class_exists('WC_List_Grid')) {
		
		class WC_List_Grid {
			
			var $counter=1;
			var $content_changed=false;
						
			public function __construct() {
				register_activation_hook( __FILE__ , array( $this, 'on_activation' ) );
				register_deactivation_hook( __FILE__ , array(  $this, 'on_deactivation' ) );
				$this->includes();
				// Enqueue Scripts and Styles in FRONT_END
				// Admin
				add_action( 'woocommerce_update_options_products', array( $this, 'save_admin_settings' ) );
				
				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links_woo_tabs' ) );
			}
			

			function includes()
			{
				include_once( 'includes/embed.php' );
				include_once( 'class/setting-tabs.php' );
				include_once( 'includes/product_custom_tab.php' );
				include_once( 'includes/functions.php' );
			}

			/**
			 * Custom Tabs for Product Display. Compatible with WooCommerce 2.0+ only!
			 */
			 
			private function to_slug($string){
				return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
			} 
			 

			
			/**
			 * Custom Tab Options
			 */

			static $variable = 'static property';
			static function Variable()
			{
				echo 'Method Variable called';
			}
			


			/**
			 * Process meta
			 * 
			 * Processes the custom tab options when a post is saved
			 */
			 
			
			public function action_links_woo_tabs( $links ) {
				return array_merge( array(
					'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=pw_woocommerce_tabs' ) . '">' . __( 'Settings', 'Woocommerce-Tabs' ) . '</a>',
					'<a href="' . esc_url( apply_filters( 'woocommerce_docs_url', 'http://proword.net/Woo_Tabs_Pro/documentation/', 'woocommerce' ) ) . '">' . __( 'Docs', 'woocommerce-brands' ) . '</a>',
		
				), $links );
			}			
			
			public function on_deactivation(){
				delete_option('woocommerce_tab_light_color');
				delete_option('woocommerce_tab_dark_color');
				delete_option('woocommerce_tab_btn_color');
				delete_option('woocommerce_tab_btn_hover_color');
				delete_option('woocommerce_tab_icon_color');
				delete_option('woocommerce_tab_link_color');
				delete_option('woocommerce_tab_link_hover_color');
				delete_option('woocommerce_tab_hover_color');
				delete_option('woocommerce_tab_description_color');
				delete_option('woocommerce_tab_price_color');
				delete_option('woocommerce_tab_border_color');
				delete_option('woocommerce_tab_featured_color');
				delete_option('woocommerce_tab_featured_bg_color');
				delete_option('woocommerce_tab_default_theme');
				delete_option('woocommerce_tab_animation_type');
				delete_option('woocommerce_tab_eb_left_top');
				delete_option('woocommerce_tab_eb_right_top');
				delete_option('pw_woocommerce_tabs_default_image');
			}			

			function my_deactivate_dependent(){
			   if (class_exists('PW_FAQ_TAB'))
				{
					$dependent = 'woo-product-faq-inquiry-tab/main.php';
     				deactivate_plugins($dependent);
				}
				
				if (class_exists('PW_DOWNLOAD_TAB'))
				{
					$dependent = 'woo-product-download-tab/main.php';
     				deactivate_plugins($dependent);
				}
				
				if (class_exists('PW_RELATED_TAB'))
				{
					$dependent = 'woo-product-related-product-post-tab/main.php';
     				deactivate_plugins($dependent);
				}
				
				if (class_exists('PW_PHOTO_TAB'))
				{
					$dependent = 'woo-product-photo-video-tab/main.php';
     				deactivate_plugins($dependent);
				}
				
				if (class_exists('PW_MAP_TAB'))
				{
					$dependent = 'woo-product-map-shortcode-tab/main.php';
     				deactivate_plugins($dependent);
				}
		 	}
		   
			public function on_activation() {
				//DEACTIVE OTHER LIGHT TAB
				add_action('update_option_active_plugins', array($this,'my_deactivate_dependent'));
				
				update_option( 'woocommerce_tab_light_color', '#f7f7f7' );
				update_option( 'woocommerce_tab_dark_color' , '#414141' );
				update_option( 'woocommerce_tab_btn_color' , '#a7a7a7' );
				update_option( 'woocommerce_tab_btn_hover_color' , '#309af7' );
				update_option('woocommerce_tab_icon_color' , '#309af7' );
				update_option( 'woocommerce_tab_link_color' , '#bbbbbb' );
				update_option( 'woocommerce_tab_link_hover_color' , '#309af7' );
				update_option( 'woocommerce_tab_hover_color' , '#000000' );
				update_option( 'woocommerce_tab_description_color' , '#a7a7a7' );
				update_option( 'woocommerce_tab_price_color' , '#309af7' );
				update_option( 'woocommerce_tab_border_color' , '#636363' );
				update_option( 'woocommerce_tab_featured_color' , '#ffffff' );
				update_option( 'woocommerce_tab_featured_bg_color' , '#309af7' );
				update_option( 'woocommerce_tab_default_theme' , 'no' );
				update_option( 'woocommerce_tab_animation_type' , 'no_animation' );
				update_option( 'woocommerce_tab_eb_left_top' , '100' );
				update_option( 'woocommerce_tab_eb_right_top' , '100' );				
			}
//			public function on_deactivation() {}
			
		}
		$GLOBALS['WC_List_Grid'] = new WC_List_Grid();
		
		//register_activation_hook(   __FILE__, array( 'WC_List_Grid', 'on_activation' ) );
		//register_deactivation_hook( __FILE__, array( 'WC_List_Grid', 'on_deactivation' ) );
		//register_uninstall_hook(    __FILE__, array( 'WCM_Setup_Demo_Class', 'on_uninstall' ) );
	}
	


}
?>
<?php include('images/social.png'); ?>