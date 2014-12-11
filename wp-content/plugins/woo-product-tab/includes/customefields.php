<?php

	
	//include_once 'metaboxes/wpalchemy/MetaBox.php';
	function add_custom_meta_box_product_tab() {  
		add_meta_box(  
			'general_setting', // $id  
			'<i class="fa fa-th-list"></i> '.__('Product Tabs General Setting',EXTRA_WOO_TABS_TEXTDOMAN), // $title   
			'show_custom_product_tab', // $callback  
			'extra_product_tab', // $page  
			'normal', // $context  
			'high');
			
		add_meta_box( 
			'product_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Products :: Display for all Products',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');
		
		add_meta_box( 
			'brands_category_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Brands & Category :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_brands_category_setting_area',
			'extra_product_tab',
			'normal',
			'high');
		
		add_meta_box( 
			'editor_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Editor :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_editor_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
		'faq_setting_area', 
		'<i class="fa fa-clipboard"></i> '.__('Faq :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
		'show_faq_setting_area',
		'extra_product_tab',
		'normal',
		'high');
		
		add_meta_box( 
			'form_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Shortcodes :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_form_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'video_gallery_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Video Gallery :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_video_gallery_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'photo_gallery_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Photo Gallerty :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_photo_gallery_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'map_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Map :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_map_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'inquire_form_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Inquiry Form :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_inquire_form_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'download_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Download :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_download_setting_area',
			'extra_product_tab',
			'normal',
			'high');		
		
		add_meta_box( 
			'related_post_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Related Posts :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_related_post_setting_area',
			'extra_product_tab',
			'normal',
			'high');		
			
		add_meta_box( 
			'faq_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('FAQ :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_faq_setting_area',
			'extra_product_tab',
			'normal',
			'high');							
				
	}  
	add_action('add_meta_boxes', 'add_custom_meta_box_product_tab');  
	
	$prefix = 'product_';  
	$custom_fields_product_tab = array(  
		array(  
			'label' => '<strong>'.__('Type',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Tab Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_type',
			'type'  => 'select',  
			'options' => array (  
				
				'one' => array (

					'label' => __('Brands & Category',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'brands_category'  
				),
				'two' => array (

					'label' => __('Editor',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'editor'  
				),
				'three' => array (  
					'label' => __('Download',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'download'  
				),  
				'four' => array (  
					'label' => __('FAQ',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'faq'  
				),
				'five' => array (  
					'label' => __('Inquiry Form',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'inquire_form'  
				),  
				'six' => array (  
					'label' => __('Map',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'map'  
				),  
				'seven' => array ( 

					'label' => __('Photo Gallery',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'photo_gallery'  
				),
				'eight' => array (  
					'label' => __('Products',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'product'  
				),      
				'nine' => array (  
					'label' => __('Related Posts',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'related_post'  
				),  
				'ten' => array (  
					'label' => __('Shortcodes',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'form'  
				),   
				'eleven' => array (  

					'label' => __('Video Gallery',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'video_gallery'  
				)
			)  
		),
		array(  
			'label' => '<strong>'.__('Order',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Enter Tab Order.',EXTRA_WOO_TABS_TEXTDOMAN).'<br /><strong>'.__('Note:',EXTRA_WOO_TABS_TEXTDOMAN).' </strong>'.__('The woocommerce reserved order 10, 20 and 30',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_order',
			'type'  => 'numeric'  
		),
		array(  
			'label' => '<strong>'.__('Tab Status',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Tab Status,',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_enable_all',
			'type'  => 'radio' ,
			'options' => array (  
				'yes' => array (  
					'label' => __('Enable',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'yes',
					'checked'=> 'checked' 
				),  
				'no' => array (  
					'label' => __('Disable',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'no',
					'checked'=> ''   
				) 
			)   
		),
		array(  
			'label' => '<strong>'.__('Icon',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Icon for Tab or Sticky Button',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_icon',
			'type'  => 'icon_type'  
		),
		array(  
			'label' => '<strong>'.__('Use For All',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('If Checked,You can Enter Content for This Tab here and the Content Will be Displayed in All Products Page',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_use_all',
			'type'  => 'checkbox'  
		)
	);	
	
	$prefix = 'product_';  
	$fields_product_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Display Type',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Display Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'product_tab_type',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (
					'label' => __('Grid',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'grid'  
				),
				'two' => array (

					'label' => __('Carousel',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'carousel'  
				),
				'three' => array (

					'label' => __('List',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'list'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid Column',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Number of Column(s)',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'product_tab_column',
			'type'  => 'select',
			'dependency' => array(
				'parent_id' => $prefix.'product_tab_type',
				'value'	  => 'grid' 	
			),  
			'options' => array (  
				'one' => array (

					'label' => __('One Column',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_2_of_2'  
				),
				'two' => array (

					'label' => __('Two Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_2'  
				),
				'three' => array (

					'label' => __('Three Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_3'  
				),
				'four' => array (

					'label' => __('Four Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_4'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Skin',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Skin for Grid and Carousel Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'product_tab_skin',
			'type'  => 'select',  
			'dependency' => array(
				'parent_id' => $prefix.'product_tab_type',
				'value'	  => array('grid','carousel') 	
			),
			'options' => array (  
				'one' => array (

					'label' => __('Light 1',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-carskin-light1'  
				),
				'two' => array (

					'label' => __('Light 2',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-carskin-light2'  
				),
				'three' => array (

					'label' => __('Dark 1',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-carskin-dark1'  
				),
				'four' => array (

					'label' => __('Dark 2',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-carskin-dark2'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Image Effect',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Image Effect',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'product_tab_image_effect',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (
					'label' => __('Zoom In',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'zoomin-eff'  
				),
				'two' => array (
					'label' => __('Zoom Out',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'zoomout-eff'  
				),
				'three' => array (
					'label' => __('Rotate Right',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'roundright-eff'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Icon Effect',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Icon Effect',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'product_tab_icon_effect',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (

					'label' => __('Dropdown',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-dropup'  
				),
				'two' => array (

					'label' => __('DropUp',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-dropdown'  
				),
				'three' => array (

					'label' => __('Scale',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-scale-eff'  
				)
			)
		)
	);
	
	$prefix = 'product_';  
	$fields_brands_category_setting_area = array(  

		array(  
			'label' => '<strong>'.__('Select Query',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Query',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'brands_category_tab_query',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (
					'label' => __('Display All Product from Same Brand',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'all_product_brand'  
				),
				'two' => array (

					'label' => __('Display Featured Product from Same Brand',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'featured_product_brand'  
				),
				'three' => array (

					'label' => __('Display All Product from Same Category',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'all_product_category'  
				),
				'four' => array (

					'label' => __('Display Featured Product from Same Category',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'featured_product_category'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Display Type',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Display Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'brands_category_tab_type',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (
					'label' => __('Grid',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'grid'  
				),
				'two' => array (

					'label' => __('Carousel',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'carousel'  
				),
				'three' => array (

					'label' => __('List',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'list'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid Column',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Number of Column(s) of Grid',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'brands_category_tab_column',
			'type'  => 'select',
			'dependency' => array(
				'parent_id' => $prefix.'brands_category_tab_type',
				'value'	  => 'grid' 	
			),  
			'options' => array (  
				'one' => array (

					'label' => __('One Column',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_2_of_2'  
				),
				'two' => array (

					'label' => __('Two Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_2'  
				),
				'three' => array (

					'label' => __('Three Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_3'  
				),
				'four' => array (

					'label' => __('Four Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_4'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Skin',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Skin for Grid and Carousel Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'brands_category_tab_skin',
			'type'  => 'select',  
			'dependency' => array(
				'parent_id' => $prefix.'brands_category_tab_type',
				'value'	  => array('grid','carousel') 	
			),
			'options' => array (  
				'one' => array (

					'label' => __('Light 1',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-carskin-light1'  
				),
				'two' => array (

					'label' => __('Light 2',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-carskin-light2'  
				),
				'three' => array (

					'label' => __('Dark 1',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-carskin-dark1'  
				),
				'four' => array (

					'label' => __('Dark 2',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-carskin-dark2'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Image Effect',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Image Effect',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'brands_category_tab_image_effect',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (
					'label' => __('Zoom In',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'zoomin-eff'  
				),
				'two' => array (
					'label' => __('Zoom Out',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'zoomout-eff'  
				),
				'three' => array (
					'label' => __('Rotate Right',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'roundright-eff'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Icon Effect',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Icon Effect',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'brands_category_tab_icon_effect',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (

					'label' => __('Dropdown',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-dropup'  
				),
				'two' => array (

					'label' => __('DropUp',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-dropdown'  
				),
				'three' => array (

					'label' => __('Scale',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-scale-eff'  
				)
			)
		)
	);
	
	$prefix = 'product_';  
	$fields_editor_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Editor',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => '',
			'id'    => $prefix.'editor_tab_content',
			'type'  => 'editor'  
		)
	);
	
	$prefix = 'product_';  
	$fields_form_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Editor',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('You can enter any shortcodes.',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'form_tab_content',
			'type'  => 'editor'  
		)
	);
	
	$prefix = 'product_';  
	$fields_map_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Map Type',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Map Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'map_tab_type',
			'type'  => 'select',  
			'options' => array (
				'one' => array (

					'label' => __('Direct Address',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'address'  
				),  
				'two' => array (

					'label' => __('Embed',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'embed'  
				),
				'three' => array (

					'label' => __('Location Point',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'location_point'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Address',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Enter Direct Address',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'map_tab_address',
			'type'  => 'textbox',
			'dependency' => array(
				'parent_id' => $prefix.'map_tab_type',
				'value'	  => 'address' 	
			),	  
		),
		array(  
			'label' => '<strong>'.__('Latitude',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Enter Latitude Point',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'map_tab_lat',
			'type'  => 'textbox',
			'dependency' => array(
				'parent_id' => $prefix.'map_tab_type',
				'value'	  => 'location_point' 	
			),	  
		),
		array(  
			'label' => '<strong>'.__('Longtiude',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Enter Longtiude Point',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'map_tab_long',
			'type'  => 'textbox' , 
			'dependency' => array(
				'parent_id' => $prefix.'map_tab_type',
				'value'	  => 'location_point' 	
			),	
		),
		array(  
			'label' => '<strong>'.__('Embed Map',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => '',
			'id'    => $prefix.'map_tab_content',
			'type'  => 'editor' ,
			'dependency' => array(
				'parent_id' => $prefix.'map_tab_type',
				'value'	  => 'embed' 	
			), 
		)
	);
	
	$prefix = 'product_';  
	$fields_related_post_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Choose Posts',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Enter Editor Content',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'related_post_tab_posts',
			'type'  => 'products'  
		),
		array(  
			'label' => '<strong>'.__('Display Type',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Display Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'related_post_tab_type',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (
					'label' => __('Grid',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'grid'  
				),
				'two' => array (

					'label' => __('List',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'list'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid Column',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Number of Column(s)',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'related_post_tab_column',
			'type'  => 'select',
			'dependency' => array(
				'parent_id' => $prefix.'related_post_tab_type',
				'value'	  => 'grid' 	
			),    
			'options' => array (  
				'one' => array (

					'label' => __('One Column',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_2_of_2'  
				),
				'two' => array (

					'label' => __('Two Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_2'  
				),
				'three' => array (

					'label' => __('Three Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_3'  
				),
				'four' => array (

					'label' => __('Four Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_4'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid Image Effect',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Grid Image Effect',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'related_post_tab_image_effect',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (
					'label' => __('Zoom In',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'zoomin-eff'  
				),
				'two' => array (
					'label' => __('Zoom Out',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'zoomout-eff'  
				),
				'three' => array (
					'label' => __('Rotate Right',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'roundright-eff'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid Icon Effect',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Grid Icon Effect',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'related_post_tab_icon_effect',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (

					'label' => __('Dropdown',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-dropup'  
				),
				'two' => array (

					'label' => __('DropUp',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-dropdown'  
				),
				'three' => array (

					'label' => __('Scale',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-scale-eff'  
				)
			)
		)
	);
	
	$prefix = 'product_';  
	$fields_inquire_form_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Name Field',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Add Name Field to Form.',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'inquire_form_tab_name',
			'type'  => 'checkbox'  
		),
		array(  
			'label' => '<strong>'.__('Email Field',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Add Email Field to Form.',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'inquire_form_tab_email',
			'type'  => 'checkbox'  
		),
		array(  
			'label' => '<strong>'.__('Website Field',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Add Website Field to Form.',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'inquire_form_tab_website',
			'type'  => 'checkbox'  
		),
		array(  
			'label' => '<strong>'.__('Address Field',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Add Address Field to Form.',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'inquire_form_tab_address',
			'type'  => 'checkbox'  
		),
		array(  
			'label' => '<strong>'.__('Description Field',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Add Description Field to Form.',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'inquire_form_tab_desc',
			'type'  => 'checkbox'  
		)
	);
	
	$prefix = 'product_';  
	$fields_faq_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Add FAQ',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Add FAQ',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'faq_tab_posts',
			'type'  => 'repeatable_faq'  
		)
	);
	
	$prefix = 'product_';  
	$fields_video_gallery_setting_area = array(  

		array(  
			'label' => '<strong>'.__('Gallery Type',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Video Gallery Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'video_gallery_tab_type',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (

					'label' => __('Grid',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'grid'  
				),
				'two' => array (

					'label' => __('Slider',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'slider'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid Column',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Number of Column(s)',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'video_gallery_tab_column',
			'type'  => 'select',
			'dependency' => array(
				'parent_id' => $prefix.'video_gallery_tab_type',
				'value'	  => 'grid' 	
			),  
			'options' => array (  
				'one' => array (

					'label' => __('One Column',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_2_of_2'  
				),
				'two' => array (

					'label' => __('Two Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_2'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid/Slider Height',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Enter Video Grid/Slider Height',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'video_gallery_tab_height',
			'type'  => 'numeric',
			
		),
		array(  
			'label' => '<strong>'.__('Add Video',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Add Video',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'video_gallery_tab_posts',
			'type'  => 'repeatable_video'  
		)
	);
	
	$prefix = 'product_';  
	$fields_photo_gallery_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Gallery Type',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Photo Gallery Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'photo_gallery_tab_type',
			'type'  => 'select',  
			'options' => array (  
				'one' => array (

					'label' => __('Grid',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'grid'  
				),
				'two' => array (

					'label' => __('Slider',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'slider'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid Column',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Number of Column(s)',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'photo_gallery_tab_column',
			'type'  => 'select',
			'dependency' => array(
				'parent_id' => $prefix.'photo_gallery_tab_type',
				'value'	  => 'grid' 	
			),	
			'options' => array (  
				'one' => array (

					'label' => __('One Column',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_2_of_2'  
				),
				'two' => array (

					'label' => __('Two Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_2'  
				),
				'three' => array (

					'label' => __('Three Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_3'  
				),
				'four' => array (

					'label' => __('Four Columns',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt_col_1_of_4'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid Image Effect',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Photo Gallery Grid Image Effect',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'photo_gallery_tab_image_effect',
			'type'  => 'select',  
			'dependency' => array(
				'parent_id' => $prefix.'photo_gallery_tab_type',
				'value'	  => 'grid' 	
			),	
			'options' => array (  
				'one' => array (
					'label' => __('Zoom In',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'zoomin-eff'  
				),
				'two' => array (
					'label' => __('Zoom Out',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'zoomout-eff'  
				),
				'three' => array (
					'label' => __('Rotate Right',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'roundright-eff'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Grid Icon Effect',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Photo Gallery Grid Icon Effect',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'photo_gallery_tab_icon_effect',
			'type'  => 'select',  
			'dependency' => array(
				'parent_id' => $prefix.'photo_gallery_tab_type',
				'value'	  => 'grid' 	
			),
			'options' => array (  
				'one' => array (

					'label' => __('Dropdown',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-dropup'  
				),
				'two' => array (

					'label' => __('DropUp',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-dropdown'  
				),
				'three' => array (

					'label' => __('Scale',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'wt-scale-eff'  
				)
			)
		),
		array(  
			'label' => '<strong>'.__('Slider Height',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Enter Photo Slider Height',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'photo_gallery_tab_height',
			'type'  => 'numeric', 
			'dependency' => array(
				'parent_id' => $prefix.'photo_gallery_tab_type',
				'value'	  => 'slider' 	
			),
		),
		array(  
			'label' => '<strong>'.__('Add Photo',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Add Photo',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'photo_gallery_tab_posts',
			'type'  => 'repeatable_photo'  
		)	
	);
	
	$prefix = 'product_';  
	$fields_download_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Add File',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Add File',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'download_tab_posts',
			'type'  => 'repeatable_download'  
		)
	);
	
	function show_custom_product_tab() {  
		global $custom_fields_product_tab, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($custom_fields_product_tab as $field) {  
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with  
				echo '<tr> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							
							case 'text':  
	
								echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />
								<br /><span class="description">'.$field['desc'].'</span>	';  
							break; 
							
							case 'radio':  
								foreach ( $field['options'] as $option ) {
									echo '<input type="radio" name="'.$field['id'].'" value="'.$option['value'].'" '.checked( $meta, $option['value'] ,0).' '.$option['checked'].' /> 
											<label for="'.$option['value'].'">'.$option['label'].'</label><br><br>';  
								}  
							break;
							
							case 'select':  
								echo '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
								foreach ($field['options'] as $option) {  
									echo '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
								}  
								echo '</select><br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
							break;
							
							case 'numeric':  
								echo '
								<input type="number" name="'.$field['id'].'" id="'.$field['id'].'" value="'.($meta=='' ? "1":$meta).'" size="30" class="width_170" min="1" pattern="[-+]?[0-9]*[.,]?[0-9]+" value="1" title="Only Digits!" class="input-text qty text" />
	';
								echo '
									<br /><span class="description">'.$field['desc'].'</span>';  
							break;
							
							case 'checkbox':  
								echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" '.checked( $meta, "on" ,0).'"/> 
									<br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
							break;  
							
							case 'icon_type':  
								echo '<input type="hidden" id="font_icon" name="'.$field['id'].'" value="'.$meta.'"/>';
								echo '<div class="pw_iconpicker" id="benefit_image_icon">';
								include(plugin_dir_path( __FILE__ ) .'../class/font-awesome.php');
								echo '</div>';
							break; 
							
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_product_setting_area() {  
		global $fields_product_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_product_setting_area as $field) {  
			
				if(isset($field['dependency']))  
				{
					dependency($field['id'],$field['dependency']);	
				}
				
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with  
				echo '<tr class="'.$field['id'].'_field"> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  

							case 'select':  
								echo '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
								foreach ($field['options'] as $option) {  
									echo '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
								}  
								echo '</select><br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
							break;
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_brands_category_setting_area() {
		$disable='disabled="disabled"';
		if ( in_array( 'woo-brands/main.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
		{
			$disable=""; 
		}else
		{
			echo PL_NOTACTIVE;
		}
		
		global $fields_brands_category_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
		// Begin the field table and loop  
		echo '<table class="form-table">';  
		foreach ($fields_brands_category_setting_area as $field) {  
		
			if(isset($field['dependency']))  
			{
				dependency($field['id'],$field['dependency']);	
			}
			
			// get value of this field if it exists for this post  
			$meta = get_post_meta($post->ID, $field['id'], true);  
			// begin a table row with  
			echo '<tr class="'.$field['id'].'_field"> 

					<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
					<td>';  
					switch($field['type']) {  

						case 'select':  
							echo '<select '.$disable.' name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
							foreach ($field['options'] as $option) {  
								echo '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
							}  
							echo '</select><br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
						break;

					} //end switch  
			echo '</td></tr>';  
		} // end foreach  
		echo '</table>'; // end table  
		
	}
	
	function show_editor_setting_area() {  
		global $fields_editor_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_editor_setting_area as $field) {  
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true); 
				// begin a table row with 
				echo '<tr> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							
							case 'editor':
									echo '
										<p><span class="description">'.$field['desc'].'</span></p>
										<p class="form-field product_field_type" >';
										$editor_id =$field['id'];
										wp_editor( $meta, $editor_id );
										echo '</p>';
							break; 
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_form_setting_area() {  
		global $fields_form_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_form_setting_area as $field) {  
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with  
				echo '<tr> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							case 'editor':
									echo '
										<p><span class="description">'.$field['desc'].'</span></p>
										<p class="form-field product_field_type" >';
										$editor_id =$field['id'];
										wp_editor( $meta, $editor_id );
										echo '</p>';
							break; 
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_map_setting_area() {  
		global $fields_map_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_map_setting_area as $field) {  
			
				if(isset($field['dependency']))  
				{
					dependency($field['id'],$field['dependency']);	
				}
			
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with  
				echo '<tr class="'.$field['id'].'_field"> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							
							case 'select':  
								echo '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
								foreach ($field['options'] as $option) {  
									echo '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
								}  
								echo '</select><br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
							break;
							
							case 'textbox':  
								echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" class="width_170"/> 
									<br /><span class="description">'.$field['desc'].'</span>';  
							break; 
							
							case 'editor':
									echo '
										<p><span class="description">'.$field['desc'].'</span></p>
										<p class="form-field product_field_type" >';
										$editor_id =$field['id'];
										wp_editor( $meta, $editor_id );
										echo '</p>';
							break; 
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_related_post_setting_area() {  
		global $fields_related_post_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			$save_post = $post;
			foreach ($fields_related_post_setting_area as $field) {  
				
				if(isset($field['dependency']))  
				{
					dependency($field['id'],$field['dependency']);	
				}
			
				// get value of this field if it exists for this post
				$meta = get_post_meta($post->ID, $field['id'], true);  

				// begin a table row with  
				echo '<tr class="'.$field['id'].'_field"> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							
							case 'select':  
								
								echo '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
								foreach ($field['options'] as $option) {  
									echo '<option '. selected( $meta , $option['value'],1 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
								}  
								echo '</select><br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
							break;
							
							case 'products':
									
									echo '<select name="'.$field['id'].'[]" id="'.$field['id'].'" style="width: 350px; display: none;" multiple class="related-post" tabindex="-1" data-placeholder="'.__('Select Related Posts',EXTRA_WOO_TABS_TEXTDOMAN).'">
											<option value=""></option>';
											global $wpbd;
											$args_post = array('post_type' => 'post','posts_per_page'=>-1);
											$loop_post = new WP_Query( $args_post );
											$option_data='';
											while ( $loop_post->have_posts() ) : $loop_post->the_post();
												$selected='';
												if(is_array($meta))
												{
													$selected=(in_array(get_the_ID(),$meta) ? "SELECTED":"");
												}
												$option_data.='<option '.$selected.' value="'.get_the_ID().'">'.get_the_title().'</option>';
											endwhile;
											$post = $save_post;
											wp_reset_postdata();
											echo $option_data;
									echo '</select>';
							break; 
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_faq_setting_area() {  
		global $fields_faq_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_faq_setting_area as $field) {  
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true); 
				// begin a table row with 
				echo '<tr> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							
							case 'editor':
									echo '
										<p><span class="description">'.$field['desc'].'</span></p>
										<p class="form-field product_field_type" >';
										$editor_id =$field['id'];
										wp_editor( $meta, $editor_id );
										echo '</p>';
							break; 
							
							case 'repeatable_faq':  
								echo '<a class="custom-repeatable-add-faq button" href="#"><i class="fa fa-plus-square" ></i></a> 
								<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';  
								$i = 0;
								if ($meta) {
									
									foreach($meta as $row) {  
										
										echo '<li>';
										echo '	
											<div>
												<span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span><br />
												<p class="form-field" style="margin-top:10px">
													<label><abbr title="Question">'.__('Question',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
													<br />
													<input type="text" name="'.$field['id'].'['.$i.'][question]" id="product_faq_tab_posts_question" size="30" class="width_170" value="'.(isset($row['question']) ? $row['question']:'').'"/> 
													<a class="repeatable-remove-faq button" href="#"><i class="fa fa-minus-square" ></i></a>
												</p>
											</div>
											
											<div>
												<p class="form-field ">
													<label><abbr title="Answer">'.__('Answer',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
													<br />
												</p>
											</div><hr>';
										echo hc_tinymce(array(
														'id' 	=> $field['id'].'_'.rand(0,100),
														'name' 	=> $field['id'].'['.$i.'][answer]',
														'value' => (isset($row['answer']) ? $row['answer']:''),
														'rows' 	=> 15,
														'class' =>'product_faq_tab_answer'
													));
										echo '</li>'; 
										
										$i++;
									}  
								} else {  
									echo '<li>';
									echo '	
										<div>
											<span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span><br />
											<p class="form-field" style="margin-top:10px">
												<label><abbr title="Question">'.__('Question',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
												<br />
												<input type="text" name="'.$field['id'].'['.$i.'][question]" id="'.$field['id'].'_question" size="30" class="width_170"/> 
												<a class="repeatable-remove-faq button" href="#"><i class="fa fa-minus-square" ></i></a>
											</p>
										</div>
										
										<div>
											<p class="form-field ">
												<label><abbr title="Answer">'.__('Answer',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
												<br />
											</p>
										</div>';
									/*$editor_id =$field['id'].'_editor';
									$settings = array( 
													'textarea_name' => $field['id'].'['.$i.'][editor]',
													'editor_class'  => $field['id'].'_editor',
												 );
									wp_editor( $meta, $editor_id, $settings );*/
									echo '<hr>';
									echo hc_tinymce(array(
											'id' 	=> $field['id'].'_'.rand(0,100),
											'name' 	=> $field['id'].'['.$i.'][answer]',
											'value' => '',
											'rows' 	=> 15,
											'class' =>'product_faq_tab_answer'
										));
									echo '</li>';  
											
									$image='';
											
								}  
								echo '</ul>';
								
							break;
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_inquire_form_setting_area() {  
		global $fields_inquire_form_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_inquire_form_setting_area as $field) {  
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with  
				echo '<tr> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							case 'checkbox':  
								echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" '.checked( @$meta,'yes',false).' value="yes" /> 
								<label for="'.$field['id'].'">'.$field['desc'].'</label>';  
							break;   
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_video_gallery_setting_area() {  
		global $fields_video_gallery_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_video_gallery_setting_area as $field) {  
				
				if(isset($field['dependency']))  
				{
					dependency($field['id'],$field['dependency']);	
				}
				
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with  
				echo '<tr class="'.$field['id'].'_field"> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							
							case 'numeric':  
								echo '<input type="number" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" class="width_170" pattern="[-+]?[0-9]*[.,]?[0-9]+" value="1" title="Only Digits!" class="input-text qty text" />
	';
								echo '
									<br /><span class="description">'.$field['desc'].'</span>';  
							break;
						
							case 'select':  
								echo '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
								foreach ($field['options'] as $option) {  
									echo '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
								}  
								echo '</select><br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
							break;
						
							case 'repeatable_video':  
								$image = PL_URL.'/images/image.png'; 
								echo '<a class="custom-repeatable-add-video button" href="#"><i class="fa fa-plus-square" ></i></a> 
										<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';  
								$i = 0;
								if ($meta) {
									  
									foreach($meta as $row) {  
										echo '<li>';
						
										if (isset($row['thumb'])) { $image = wp_get_attachment_image_src($row['thumb'], array(100, 100)); $image = $image[0]; }
										echo '			
											<div>
												<span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
												<a class="repeatable-remove-video button" href="#"><i class="fa fa-minus-square" ></i></a>
												<br />
												<p class="form-field" style="margin-top:10px">
													<input name="'.$field['id'].'['.$i.'][thumb]" id="video_thumb" type="hidden" class="custom_upload_video_thumb" value="'.(isset($row['thumb']) ? $row['thumb']:'').'" /> 
											<input name="btn_video['.$i.']" class="custom_upload_video_thumb_button button" type="button" value="'.__('Choose Video Thumb',EXTRA_WOO_TABS_TEXTDOMAN).'" />
													
													<a href="#" class="custom_clear_video_thumbnail_button">'.__('Remove Image',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
												</p>
											</div>
											<div>
												<p class="form-field ">
													<label><abbr>'.__('Upload Image',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
													<br />
													<img src="'.$image.'" class="custom_preview_video_thumb" alt="" />
												</p>
											</div>';
										echo '	
											<div>
												<p class="form-field ">
													<input type="checkbox" class="video-embed-checkbox" name="'.$field['id'].'['.$i.'][embed]" id="'.$field['id'].'_embed" '. checked((isset($row['embed']) ? $row['embed']:'') , 'on',0 ).' value="on"/>
													'.__('Check this if you want enter the embed video Youtube.',  EXTRA_WOO_TABS_TEXTDOMAN ).'
												</p>
												<p class="form-field ">
													<label><abbr >'.__('Video Url',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
													<input name="'.$field['id'].'['.$i.'][video]" id="video" type="text" class="custom_upload_video" size="63" value="'.(isset($row['video']) ? $row['video']:'').'" />
												</p>
											</div>
											<hr></li>';	
									$i++;
								}  
							} else {  
								echo '<li>';
								echo '			
									<div>
										<span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
										<a class="repeatable-remove-video button" href="#"><i class="fa fa-minus-square" ></i></a>
										<br />
										<p class="form-field" style="margin-top:10px">
											<input name="'.$field['id'].'['.$i.'][thumb]" id="video_thumb" type="hidden" class="custom_upload_video_thumb" /> 
									<input name="btn_video['.$i.']" class="custom_upload_video_thumb_button button" type="button" value="'.__('Choose Video Thumb',EXTRA_WOO_TABS_TEXTDOMAN).'" />
											
											<a href="#" class="custom_clear_video_thumbnail_button">'.__('Remove Image',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
										</p>
									</div>
									<div>
										
										<p class="form-field ">
											<label><abbr>'.__('Upload Image',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
											<br />
											<img src="" class="custom_preview_video_thumb" alt="" />
										</p>
										<p class="form-field ">
											<input type="checkbox" class="video-embed-checkbox" name="'.$field['id'].'['.$i.'][embed]" id="'.$field['id'].'_embed" value="on"/>
											'.__('Check this if you want enter the embed video Youtube.',  EXTRA_WOO_TABS_TEXTDOMAN ).'
										</p>
									</div>';
								echo '	
									<div>
										<p class="form-field ">
											<label><abbr >'.__('Video Url',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
											<input name="'.$field['id'].'['.$i.'][video]" id="video" type="text" class="custom_upload_video" size="63" />
										</p>
									</div>
									<hr></li>';
										
										$image='';
										
							}  
							echo '</ul>';
								
							break;   
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_photo_gallery_setting_area() {  
		global $fields_photo_gallery_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_photo_gallery_setting_area as $field) {
				
				if(isset($field['dependency']))  
				{
					dependency($field['id'],$field['dependency']);	
				}
				
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with  
				echo '<tr class="'.$field['id'].'_field"> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							
							case 'numeric':  
								echo '<input type="number" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" class="width_170" pattern="[-+]?[0-9]*[.,]?[0-9]+" value="1" title="Only Digits!" class="input-text qty text" />
	';
								echo '
									<br /><span class="description">'.$field['desc'].'</span>';  
							break;
						
							case 'select':  
								echo '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
								foreach ($field['options'] as $option) {  
									echo '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
								}  
								echo '</select><br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
							break;
						
							case 'repeatable_photo':  
								$image = PL_URL.'/images/image.png'; 
								echo '<a class="custom-repeatable-add-image button" href="#"><i class="fa fa-plus-square" ></i></a> 
								<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';  
								$i = 0;
								if ($meta) {
									
									foreach($meta as $row) {  
										echo '<li>';
								
										if ($row) { $image = wp_get_attachment_image_src($row, array(100, 100)); $image = $image[0]; }
											echo '
												<div>
													<span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
													<a class="repeatable-remove-image button" href="#"><i class="fa fa-minus-square" ></i></a>
													<br />
													<p class="form-field" style="margin-top:10px">
														<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.(isset($row) ? $row:'').'" /> 
												<input name="btn_'.$field['id'].'['.$i.']" class="custom_upload_image_button button" type="button" value="'.__('Choose Image',EXTRA_WOO_TABS_TEXTDOMAN).'" />
														<a href="#" class="custom_clear_image_button">'.__('Remove Image',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
													</p>
												</div>
												<div class="preview-img">
													<p class="form-field ">
														<label><abbr title="Uploaded Image">'.__('Uploaded Image',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
														<br />
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
											<p class="form-field" style="margin-top:10px">
												<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" /> 
										<input name="btn_'.$field['id'].'['.$i.']" class="custom_upload_image_button button" type="button" value="'.__('Choose Image',EXTRA_WOO_TABS_TEXTDOMAN).'" />
												
												<a href="#" class="custom_clear_image_button">'.__('Remove Image',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
											</p>
										</div>
										<div class="preview-img">
											<p class="form-field ">
												<label><abbr title="Uploaded Image">'.__('Uploaded Image',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
												<br />
												<img src="" class="custom_preview_image" alt="" />
											</p>
										</div>';
									echo '<hr>
									</li>'; 
								
								$image='';
										
							}  
							echo '</ul>'; 
								
							break;   
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_download_setting_area() {  
		global $fields_download_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_download_setting_area as $field) {  
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with  
				echo '<tr> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
						
							case 'repeatable_download':  
								echo '<a class="custom-repeatable-add-download button" href="#"><i class="fa fa-plus-square" ></i></a> 
										<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';  
								$i = 0;
								if ($meta) {
									
									foreach($meta as $row) {  
										
										echo '<li>';
										echo '
											<div>
												<span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
												<a class="repeatable-remove-download button" href="#"><i class="fa fa-minus-square" ></i></a>
												<br />
												<p class="form-field" style="margin-top:10px;">
													<label><abbr class="custom_download_name">'.(isset($row['file']) ? '<i class=\'fa fa-check\'></i>'.__('File Uploaded',EXTRA_WOO_TABS_TEXTDOMAN).'</label>':'<i class=\'fa fa-times\'></i>'.__('No File Uploaded',EXTRA_WOO_TABS_TEXTDOMAN).'</label>').'</abbr></label>
													<input name="'.$field['id'].'['.$i.'][file]" id="'.$field['id'].'_file" type="hidden" class="custom_upload_download" value="'.(isset($row['file']) ? $row['file']:'').'" /> 
												<input name="btn_download['.$i.']" class="custom_upload_download_button button" type="button" value="'.__('Choose File',EXTRA_WOO_TABS_TEXTDOMAN).'" />	 <a href="#" class="custom_clear_download_button">'.__('Remove File',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
												</p>
											</div>';
										echo '	
											<div>
												<p class="form-field ">
													<label><abbr title="Download Link">'.__('Download Link',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
													<input name="'.$field['id'].'['.$i.'][link]" id="'.$field['id'].'tab_posts_link" type="text" class="custom_upload_link" size="45" value="'.(isset($row['link']) ? $row['link']:'').'" />
												</p>
											</div>
											<div>
												<p class="form-field ">
													<label><abbr title="Download Link">'.__('<-OR->',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
													<br />
													<label><abbr title="Link Title">'.__('Link Title',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
													<input type="text" name="'.$field['id'].'['.$i.'][title]" id="'.$field['id'].'tab_posts_title" size="45" class="width_170" value="'.(isset($row['title']) ? $row['title']:'').'"/>
												</p>
											</div>
											<div>
												<p class="form-field ">
													<label><abbr title="Link Title">'.__('Download Description',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
												</p>
											</div>';
												/*$editor_id =$field['id'].'_editor';
												$settings = array( 
																'textarea_name' => $field['id'].'['.$i.'][editor]',
																'editor_class'  => $field['id'].'_editor',
															 );
												wp_editor( $meta, $editor_id, $settings );*/
												echo '<hr>';
												echo hc_tinymce(array(
													'id' 	=> $field['id'].'_'.rand(0,100),
													'name' 	=> $field['id'].'['.$i.'][description]',
													'value' => (isset($row['description']) ? $row['description']:''),
													'rows' 	=> 15,
													'class' =>'product_download_tab_description'
												));
											echo '<hr></li>'; 
												
										$i++;

									}  
								} else {  
									echo '<li>';
									echo '
										<div>
											<span class="sort hndle sort-line"><i class="fa fa-arrows" ></i></span>
											<a class="repeatable-remove-download button" href="#"><i class="fa fa-minus-square" ></i></a>
											<br />
											<p class="form-field" style="margin-top:10px;">
												<label><abbr class="custom_download_name"><i class=\'fa fa-times\'></i>'.__('No File Uploaded',EXTRA_WOO_TABS_TEXTDOMAN).'</label></abbr></label>
												<input name="'.$field['id'].'['.$i.'][file]" id="'.$field['id'].'_file" type="hidden" class="custom_upload_download" /> 
											<input name="btn_download['.$i.']" class="custom_upload_download_button button" type="button" value="'.__('Choose File',EXTRA_WOO_TABS_TEXTDOMAN).'" />
											<a href="#" class="custom_clear_download_button">'.__('Remove File',EXTRA_WOO_TABS_TEXTDOMAN).'</a>
											</p>
										</div>';
									echo '	
										<div>
											<p class="form-field ">
												<label><abbr title="Download Link">'.__('Download Link',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
												<input name="'.$field['id'].'['.$i.'][link]" id="'.$field['id'].'tab_posts_link" type="text" class="custom_upload_link" size="45" />
											</p>
										</div>
										<div>
											<p class="form-field ">
												<label><abbr title="Download Link">'.__('<-OR->',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
												<br />
												<label><abbr title="Link Title">'.__('Link Title',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
												<input type="text" name="'.$field['id'].'['.$i.'][title]" id="'.$field['id'].'tab_posts_title" size="45" class="width_170" />
											</p>
										</div>
										<div>
											<p class="form-field ">
												<label><abbr title="Link Title">'.__('Download Description',EXTRA_WOO_TABS_TEXTDOMAN).'</abbr></label>
											</p>
										</div>';
											echo '<hr>';
											echo hc_tinymce(array(
												'id' 	=> $field['id'].'_'.rand(0,100),
												'name' 	=> $field['id'].'['.$i.'][description]',
												'value' => '',
												'rows' 	=> 15,
												'class' =>'product_download_tab_description'
											));
										echo '<hr></li>'; 
										
										$image='';
											
								}  
								echo '</ul>'; 
								
							break;   
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	
	
	function save_custom_meta_product_tab ($post_id) {  
		global $fields_product_setting_area,$custom_fields_product_tab,$fields_editor_setting_area,$fields_form_setting_area,$fields_map_setting_area,$fields_related_post_setting_area,$fields_faq_setting_area,$fields_inquire_form_setting_area,$fields_video_gallery_setting_area,$fields_photo_gallery_setting_area,$fields_download_setting_area,$fields_brands_category_setting_area;
		// verify nonce
		if(isset($_POST) && !empty($_POST)){
			if (isset($_POST['show_custom_meta_box_extra_product_tab_nonce']) && !wp_verify_nonce($_POST['show_custom_meta_box_extra_product_tab_nonce'], basename(__FILE__)))
				return $post_id;
		// check autosave  
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
				return $post_id;  
			// check permissions  
			if ('page' == $_POST['post_type']) {  
				if (!current_user_can('edit_page', $post_id))  
					return $post_id;  
				} elseif (!current_user_can('edit_post', $post_id)) {  
					return $post_id;  
			}  
			
			$tab_type='product';
			if(isset($_POST) && !empty($_POST)){
				if (isset($_POST['product_tab_type'])){
					$tab_type=esc_attr(($_POST['product_tab_type']));
				}
			}
	
			foreach ($custom_fields_product_tab as $field) { 
				if(!isset($_POST[$field['id']])){
					delete_post_meta($post_id, $field['id']);  
					continue;
				}
				
				$post = get_post($post_id);
				$category = $_POST[$field['id']];  
				wp_set_post_terms( $post_id, $category, $field['id'],false );

				$old = get_post_meta($post_id, $field['id'], true);  
				$new = $_POST[$field['id']];  
				if ($new && $new != $old) {  
					update_post_meta($post_id, $field['id'], $new);  
				} elseif ('' == $new && $old) {  
					delete_post_meta($post_id, $field['id'], $old);  
				}
	
			} // end foreach  
			
			
			if($tab_type=='product')
			{
				foreach ($fields_product_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
					
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			
			if($tab_type=='brands_category')
			{
				foreach ($fields_brands_category_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
					
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			
			if($tab_type=='editor')
			{
				foreach ($fields_editor_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
					
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			
			if($tab_type=='form')
			{
				foreach ($fields_form_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
				
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			if($tab_type=='map')
			{
			
				foreach ($fields_map_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
				
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			if($tab_type=='related_post')
			{
			
				foreach ($fields_related_post_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
				
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			if($tab_type=='faq')
			{
				foreach ($fields_faq_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
					
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			if($tab_type=='inquire_form')
			{
				foreach ($fields_inquire_form_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
				
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			if($tab_type=='video_gallery')
			{
			
				foreach ($fields_video_gallery_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
				
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];
					
					if( $field['id']=='product_video_gallery_tab_posts')
					{
						$new = array_filter(array_map('array_filter', $new)); 
					} 
					  
					  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			if($tab_type=='photo_gallery')
			{
				foreach ($fields_photo_gallery_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
				
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];
					
					
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			if($tab_type=='download')
			{
				foreach ($fields_download_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
				
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];
					if( $field['id']=='product_download_tab_posts')
					{
						$new = array_filter(array_map('array_filter', $new)); 
					} 
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
		}		
	
		
	} 
	 
	add_action('save_post', 'save_custom_meta_product_tab');  
	
	
	
?>