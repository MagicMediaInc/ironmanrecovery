<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	
	global $post, $product, $catalog_mode;
	
	$options = get_option('sf_neighborhood_options');
	if (isset($options['enable_pb_product_pages'])) {
		$enable_pb_product_pages = $options['enable_pb_product_pages'];
	} else {
		$enable_pb_product_pages = false;
	}
	
	$product_short_description = get_post_meta($post->ID, 'sf_product_short_description', true);
	
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		
		<div class="summary-top clearfix">
			
			<p itemprop="price" class="price"><?php echo $product->get_price_html(); ?></p>
			
			<?php
				if ( comments_open() ) {
				
					$count = $wpdb->get_var("
					    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
					    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
					    WHERE meta_key = 'rating'
					    AND comment_post_ID = $post->ID
					    AND comment_approved = '1'
					    AND meta_value > 0
					");
				
					$rating = $wpdb->get_var("
				        SELECT SUM(meta_value) FROM $wpdb->commentmeta
				        LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
				        WHERE meta_key = 'rating'
				        AND comment_post_ID = $post->ID
				        AND comment_approved = '1'
				    ");
				
				    if ( $count > 0 ) {
				
				        $average = number_format($rating / $count, 2);
											
						$reviews_text = sprintf(_n('%d Review', '%d Reviews', $count, 'swiftframework'), $count);
						
				        echo '<div class="review-summary"><div class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> '.__('out of 5', 'woocommerce').'</span></div><div class="reviews-text">'.$reviews_text.'</div></div>';
				
				    }
				}
			?>
			<?php
				$has_cat = get_the_terms( $post->ID, 'product_cat' );
			?>
			<?php if (function_exists('be_previous_post_link') && $has_cat != 0) { ?>
			<div class="product-navigation">
				<div class="nav-previous"><?php be_previous_post_link( '%link', '<i class="icon-angle-right"></i>', true, '', 'product_cat' ); ?></div>
				<div class="nav-next"><?php be_next_post_link( '%link', '<i class="icon-angle-left"></i>', true, '', 'product_cat' ); ?></div>
			</div>
			<?php } ?>
		
		</div>
		
		<?php if (!$catalog_mode) { ?>
		<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
		<?php } ?>	
		
		<?php if ($product_short_description != "") { ?>
			<div class="product-short">
				<?php echo do_shortcode($product_short_description); ?>
			</div>
		<?php } ?>	
					
		<?php
			/**
			* woocommerce_single_product_summary hook
			*
			* @hooked woocommerce_template_single_title - 5
			* @hooked woocommerce_template_single_price - 10
			* @hooked woocommerce_template_single_excerpt - 20
			* @hooked woocommerce_template_single_add_to_cart - 30
			* @hooked woocommerce_template_single_meta - 40
			* @hooked woocommerce_template_single_sharing - 50
			*/		 
			
			do_action( 'woocommerce_single_product_summary' );
		?>
		<br>
		<br>
		<?php
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			if(stripos($ua,'iphone') !== false) { // && stripos($ua,'mobile') !== false) {
				?><a href="#personalizar" class="animate-iphone" style="background-color: #0093BD !important;color:#FFFFFF;border: 0 none;border-radius: 0;box-shadow: none;font-weight: bold;text-shadow: none;padding: 15px;width:250px;">Encuentra tu colchon</a> <?php
			}
			else if(stripos($ua,'android') !== false) { // && stripos($ua,'mobile') !== false) {
				?><a href="#personalizar" class="animate-android" style="background-color: #0093BD !important;color:#FFFFFF;border: 0 none;border-radius: 0;box-shadow: none;font-weight: bold;text-shadow: none;padding: 15px;width:250px;">Encuentra tu colchon</a> <?php
			}
			else{
			?><a href="#personalizar" class="animate-advisor" style="background-color: #0093BD !important;color:#FFFFFF;border: 0 none;border-radius: 0;box-shadow: none;font-weight: bold;text-shadow: none;padding: 15px;width:250px;">Encuentra tu colchon</a> <?php
			}
		?>
		
		
		
	</div><!-- .summary -->
	
	<?php if ($enable_pb_product_pages) { ?>
	
	<div id="product-display-area" class="clearfix">
		
		<?php the_content(); ?>

		
	</div>
	
	<?php } ?>

</div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>



<div class="banner-bottom-product">

	<div class="container">
	
<div class="part-left-product span5">

<div class="simbol-product"><img src="wp-content/themes/neighborhood/images/flor-product.png" alt=""></div>
	<div class="text-product-left">
		<h1><span class="strong">IRONMAN</span> <br /><span class="weak">ADVISOR</span></h1>
	</div>
</div>

<div class="part-right-product span6">

	<h5>Personaliza ya tu T24.7® <br />
y optimiza sus beneficios al máximo.</h5>

	<p>El asesor personalizado <span>IRONMANTM ADVISOR</span> te permite customizar
la superficie de recuperación T24.7® según tu fisiología y preferencias de
descanso en 4 sencillos pasos.</p>
	</div>

</div>

</div>

<div id="personalizar"></div>

<div id="personalizador-de-colchones">

	<div class="container">
		<div id="info-colchones" style="height:0px;padding-top:20px;overflow:hidden">
	    	<div> - Presión individual obtenida: <strong><span id="muestra-presion-individual">0</span> (tipo <span id="muestra-tipo-individual">A</span>)</strong></div>
	    	<div> - Presión de la pareja obtenida: <strong><span id="muestra-presion-pareja">0</span> (tipo <span id="muestra-tipo-pareja">A</span>)</strong></div>
	    	<div> - Medida del colchón elegida: <strong><span id="muestra-ancho">0</span>x<span id="muestra-alto">0</span></strong></div>
		</div>
        <div class="row">
        	<div class="span12">
        		<h4 class="titulo-seccion">¿DUERMES SÓLO O EN PAREJA?</h4>
        	</div>
        </div><!--row-->
        <div class="row">
	        <div class="span12">
	        	<ul id="titulos">
		        	<li>
				        <div id="titulo-individual" class="titulo" data-tipo="individual">
				        	Individual
			        	</div>
		        	</li>
		        	<li>
			        	<div id="titulo-pareja" class="titulo" data-tipo="pareja">
				        	En pareja
			        	</div>
			        </li>
			       </ul> <!--titulos-->
	        </div><!-span12-->
        </div><!--row-->
        <div id="personalizadores" class="row">
	        <div class="span6">
	        	<div class="personalizador" id="personalizador-individual" data-peso=0 data-altura=0 data-apoyo=0 data-presion="0">
		        	<div class="seccion-personalizador">
			        	<h5>¿CUÁNTO PESAS?</h5>
			        	<div id="slider-peso-individual" class="peso"></div>
					    <div class="valor"><span class="num">0</span><span class="tipo">kg</span></div>
			        	<div class=""></div>
		        	</div>
		        	
		        	<div class="seccion-personalizador">
			        	<h5>¿CUÁNTO MIDES?</h5>
			        	<div id="slider-altura-individual" class="altura"></div>
					    <div class="valor"><span class="num">0</span><span class="tipo">cm</span></div>
			        	<div class="rangos">
				        	<div class="rango">0</div>
				        	<div class="rango">50</div>
				        	<div class="rango">100</div>
				        	<div class="rango">150 <span style="float:right;position:relative;right:-10px">200</span></div>
			        	</div>
			        	<div class="clear"></div>
		        	</div><!--seccionPersonalizador-->
		        	<div class="seccion-personalizador">
			        	<h5 style="margin-top:30px">¿QUÉ SENSACIÓN DE APOYO PREFIERES?</h5>
			        	<div class="apoyos">
				        	<div class="apoyo-img apoyo1"></div>
				        	<div class="apoyo-img apoyo2"></div>
				        	<div class="apoyo-img apoyo3"></div>
			        	</div>
			        	<div id="slider-apoyo-individual" class="apoyo"></div>
					    <div class="valor"><span class="num texto">Normal</span></div>
		        	</div><!--seccionPersonalizador-->
	        	</div><!--personalizador-->
	        </div><!--col-->
	        <div class="span6">
	        	<div class="personalizador" id="personalizador-pareja" data-peso=0 data-altura=0 data-apoyo=0 data-presion="0">
		        	<div class="seccion-personalizador">
			        	<h5>¿Y TU PAREJA?</h5>
			        	<div id="slider-peso-individual" class="peso"></div>
					    <div class="valor"><span class="num">0</span><span class="tipo">kg</span></div>
			        	<div class=""></div>
		        	</div>
		        	
		        	<div class="seccion-personalizador">
			        	<h5>¿Y TU PAREJA?</h5>
			        	<div id="slider-altura-individual" class="altura"></div>
					    <div class="valor"><span class="num">0</span><span class="tipo">cm</span></div>
			        	<div class="rangos">
				        	<div class="rango">0</div>
				        	<div class="rango">50</div>
				        	<div class="rango">100</div>
				        	<div class="rango">150 <span style="float:right;position:relative;right:-10px">200</span></div>
			        	</div>
			        	<div class="clear"></div>
		        	</div><!--seccionPersonalizador-->
		        	<div class="seccion-personalizador">
			        	<h5 style="margin-top:30px">¿Y TU PAREJA?</h5>
			        	<div class="apoyos">
				        	<div class="apoyo-img apoyo1"></div>
				        	<div class="apoyo-img apoyo2"></div>
				        	<div class="apoyo-img apoyo3"></div>
			        	</div>
			        	<div id="slider-apoyo-individual" class="apoyo"></div>
					    <div class="valor"><span class="num texto">Normal</span></div>
		        	</div><!--seccionPersonalizador-->
	        	</div><!--personalizador-->
	        </div><!--col-->
        </div><!--row-->
    </div>

<?php 
	
	$variations = $product->get_available_variations();
	$anchuras = array();
	foreach($variations as $variation):
		$anchuras[$variation['attributes']['attribute_pa_anchura']][] = array(
			'altura' => $variation['attributes']['attribute_pa_altura'],
			'anchura' => $variation['attributes']['attribute_pa_anchura'],
			'precio' => $variation['price_html'],
			'id' => $variation['variation_id'],
		);
	endforeach;

	global $woocommerce;

	//$woocommerce->cart->add_to_cart( $product->id, 1, 381, array('Altura' => '190', 'Anchura' => '80', 'TipoFirmeza1' => 'A', 'TipoFirmeza2' => 'B') );
	
?>

    <div id="container-colchones" class="container">
        <div class="row">
	        <div class="span12">
	        	<h4 class="titulo-seccion">¿QUÉ MEDIDA PREFIERES?</h4>
	        </div>
        </div>
        <div id="colchones-individual" class="row">
	        <div class="span4">
		        <div class="seccion-tamano">
			        <img style="width:60px;margin-bottom:10px" src="<?php echo get_template_directory_uri()?>/personalizador/img/colchon-small.png" />
			        <ul>
						<?php foreach ($anchuras[80] as $colchon): ?>
				        <li data-producto=<?php echo $product->id; ?> id="<?php echo $colchon['id'] ?>" class="alto-<?php echo $colchon['altura'] ?>"><span class="ancho"><?php echo $colchon['anchura'] ?></span>x<span class="alto"><?php echo $colchon['altura'] ?></span><span class="precio"><?php echo $colchon['precio'];?></span></li>				        
				        <?php endforeach; ?>
			        </ul>
		        </div>
	        </div>
	        <div class="span4">
		        <div class="seccion-tamano">
			        <img style="width:67px;margin-bottom:5px" src="<?php echo get_template_directory_uri()?>/personalizador/img/colchon-small.png" />
			        <ul>
						<?php foreach ($anchuras[90] as $colchon): ?>
				        <li data-producto=<?php echo $product->id; ?> id="<?php echo $colchon['id'] ?>" class="alto-<?php echo $colchon['altura'] ?>"><span class="ancho"><?php echo $colchon['anchura'] ?></span>x<span class="alto"><?php echo $colchon['altura'] ?></span><span class="precio"><?php echo $colchon['precio'];?></span></li>					        
				        <?php endforeach; ?>
			        </ul>
		        </div>
	        </div>
	        <div class="span4">
		        <div class="seccion-tamano">
			        <img src="<?php echo get_template_directory_uri()?>/personalizador/img/colchon-small.png" />
			        <ul>
						<?php foreach ($anchuras[100] as $colchon): ?>
				        <li data-producto=<?php echo $product->id; ?> id="<?php echo $colchon['id'] ?>" class="alto-<?php echo $colchon['altura'] ?>"><span class="ancho"><?php echo $colchon['anchura'] ?></span>x<span class="alto"><?php echo $colchon['altura'] ?></span><span class="precio"><?php echo $colchon['precio'];?></span></li>					        
				        <?php endforeach; ?>
			        </ul>
		        </div>
	        </div>
        </div><!--row-->
        <div id="colchones-pareja" class="row">
	        <div class="span3">
		        <div class="seccion-tamano">
			        <img style="width:87px;margin-bottom:9px" src="<?php echo get_template_directory_uri()?>/personalizador/img/colchon-big.png" />
			        <ul>
						<?php foreach ($anchuras[150] as $colchon): ?>
				        <li data-producto=<?php echo $product->id; ?> id="<?php echo $colchon['id'] ?>" class="alto-<?php echo $colchon['altura'] ?>"><span class="ancho"><?php echo $colchon['anchura'] ?></span>x<span class="alto"><?php echo $colchon['altura'] ?></span><span class="precio"><?php echo $colchon['precio'];?></span></li>					        
				        <?php endforeach; ?>
			        </ul>
		        </div>
	        </div>
	        <div class="span3">
		        <div class="seccion-tamano">
			         <img style="width:91px;margin-bottom:7px" src="<?php echo get_template_directory_uri()?>/personalizador/img/colchon-big.png" />
			        <ul>
						<?php foreach ($anchuras[160] as $colchon): ?>
				        <li data-producto=<?php echo $product->id; ?> id="<?php echo $colchon['id'] ?>" class="alto-<?php echo $colchon['altura'] ?>"><span class="ancho"><?php echo $colchon['anchura'] ?></span>x<span class="alto"><?php echo $colchon['altura'] ?></span><span class="precio"><?php echo $colchon['precio'];?></span></li>					        
				        <?php endforeach; ?>
			        </ul>
		        </div>
	        </div>
	        <div class="span3">
		        <div class="seccion-tamano">
			         <img style="width:95px;margin-bottom:5px" src="<?php echo get_template_directory_uri()?>/personalizador/img/colchon-big.png" />
			        <ul>
						<?php foreach ($anchuras[180] as $colchon): ?>
				        <li data-producto=<?php echo $product->id; ?> id="<?php echo $colchon['id'] ?>" class="alto-<?php echo $colchon['altura'] ?>"><span class="ancho"><?php echo $colchon['anchura'] ?></span>x<span class="alto"><?php echo $colchon['altura'] ?></span><span class="precio"><?php echo $colchon['precio'];?></span></li>					        
				        <?php endforeach; ?>
			        </ul>
		        </div>
	        </div>
	        <div class="span3">
		        <div class="seccion-tamano">
			        <img src="<?php echo get_template_directory_uri()?>/personalizador/img/colchon-big.png" />
			        <ul>
						<?php foreach ($anchuras[200] as $colchon): ?>
				        <li data-producto=<?php echo $product->id; ?> id="<?php echo $colchon['id'] ?>" class="alto-<?php echo $colchon['altura'] ?>"><span class="ancho"><?php echo $colchon['anchura'] ?></span>x<span class="alto"><?php echo $colchon['altura'] ?></span><span class="precio"><?php echo $colchon['precio'];?></span></li>					        
				        <?php endforeach; ?>
			        </ul>
		        </div>
	        </div><!--span3-->
        </div><!--row-->
        <div class="row">
       	 <div class="span12">
	       	 <div id="restaurar-valores">
		       	 Refrescar
	       	 </div>
       	 </div>
        </div>
    </div><!--container-->
</div>

<div class="banner-bottom-img" role="main">
	<div class="row-fluid">
		<div class="container">
	
			<div class="transporte-product span4"><img src="wp-content/themes/neighborhood/images/transporte.png" alt="Transporte"></div>
			<div class="garantia-product span4"><img src="wp-content/themes/neighborhood/images/garantia.png" alt="Garantia"></div>
			<div class="informacion-product span4"><img src="wp-content/themes/neighborhood/images/informacion.png" alt="Información"></div>

		</div>
	</div>
</div>
</div>