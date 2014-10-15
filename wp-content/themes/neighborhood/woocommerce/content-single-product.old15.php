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
		
		<?php if ($product_short_description != "") {
			if ($post->ID==161) { 
			$contenido_frances = '<div class="info-product">
<h3>T24.7<sup>®</sup><br />
LE VRAI REPOS REVITALISANT.
</h3>
<p><span class="strong">Developed by IRONMAN<sup>&#8482</sup> ‘ACTIVE RECOVERY EQUIPMENT’</span>
<h4>
LA TECHNOLOGIE DE REPOS <br/>
LA PLUS INNOVANTE AU MONDE.
</h4>
<hr>
<p>Le matelas T24.7® améliore la circulation sanguine et les niveaux d\'oxygène, régule la température corporelle, réduit les douleurs musculaires et améliore la qualité du sommeil. </p>

<div class="accordion-product" id="product-accordion">
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
Technologie Celliant®
</a>
</div>
<div id="collapseOne" class="accordion-body collapse">
<div class="accordion-inner">
<p>Les fibres et les minéraux sensibles à la lumière absorbent et stockent l\'énergie de l\'environnement pour qu\'elle soit réabsorbée par 
le corps, accélérant ainsi les processus naturels de récupération grâce à une <span class="strong">augmentation du flux sanguin et des niveaux d\'oxygène.</span>
<br><i><b>“Celliant, Enhance Your Life”.</i></b>
</p>
<p>
<a href="http://ironmanrecovery.com/Celliant_Poster.pdf" target="_blank"><b>Télécharger le PDF</b></a>
</p>
</div>
</div>
</div>
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
Technologie Thermic®
</a>
</div>
<div id="collapseTwo" class="accordion-body collapse">
<div class="accordion-inner">
<p>Les matériaux à changement de phase garantissent des températures constantes à l\'intérieur de la zone de confort (28-30º C) en créant un 
<span class="strong">microclimat présentant un équilibre</span> température-humidité et offrant un sommeil de <span class="strong">grande qualité.</span>
<br><i><b> “Thermic, Thermal Intelligent Confort”.  </i></b> 
</p>
<p>
<a href="http://ironmanrecovery.com/engthermicipad.pdf" target="_blank"><b>Télécharger le PDF</b></a>
</p>
</div>
</div>
</div>
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
Structure ternaire
</a>
</div>
<div id="collapseThree" class="accordion-body collapse">
<div class="accordion-inner">
<p>Le T24.7® est composé de 3 parties fonctionnelles<span class="strong"> (Topping, Custom et Foundation)</span> et personnalisables en fonction de la morphologie et des 
préférences de repos, ce qui permet un alignement <span class="strong">parfait de la colonne</span> et un <span class="strong">excellent maintien progressif de chaque zone du corps.
</span></p>
</div>
</div>
</div>
</div>

</div>';
			$contenido_portugues = '<div class="info-product">

<h3>T24.7<sup>®</sup><br />
O VERDADEIRO DESCANSO REVITALIZADOR.</h3>
<p><span class="strong">Developed by IRONMAN<sup>&#8482</sup> ‘ACTIVE RECOVERY EQUIPMENT’</span>
<h4>
A TECNOLOGIA DE DESCANSO </br>MAIS INOVADORA DO MUNDO.
</h4>
<hr>
<p> O colchão T24.7® aumenta a circulação sanguínea e os níveis de oxigênio, regula a temperatura corporal, reduz a dor muscular e melhora a qualidade do sono. </p>

<div class="accordion-product" id="product-accordion">
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
Tecnologia Celliant®
</a>
</div>
<div id="collapseOne" class="accordion-body collapse">
<div class="accordion-inner">
<p>As fibras e minerais sensíveis opticamente absorvem e armazenam a energia do ambiente para ser reabsorvida pelo organismo, acelerando os processos naturais de recuperação graças a um <span class="strong">aumento do fluxo sanguíneo e dos níveis de oxigênio.</span>
<br><i><b>“Celliant, Enhance Your Life”.</i></b>
</p>
<p>
<a href="http://ironmanrecovery.com/Celliant_Poster.pdf" target="_blank"><b>Baixar PDF</b></a>
</p>
</div>
</div>
</div>
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
Tecnologia Thermic®
</a>
</div>
<div id="collapseTwo" class="accordion-body collapse">
<div class="accordion-inner">
<p>Os materiais inteligentes de mudança de estado garantem uma margem de temperaturas constante dentro da zona de conforto (28-30ºC), 
dando lugar a um <span class="strong">microclima de temperatura-umidade equilibrado</span> e oferecendo uma <span class="strong">grande qualidade de sono.</span>
<br><i><b> “Thermic, Thermal Intelligent Confort”.  </i></b>
</p>
<p>
<a href="http://ironmanrecovery.com/engthermicipad.pdf" target="_blank"><b>Baixar PDF</b></a>
</p>
</div>
</div>
</div>
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
Estrutura ternária
</a>
</div>
<div id="collapseThree" class="accordion-body collapse">
<div class="accordion-inner">
<p>O T24.7® é composto por 3 partes funcionais <span class="strong">(Topping, Custom e Foundation)</span> e personalizáveis de acordo com a fisiologia e as preferências de 
descanso, oferecendo um <span class="strong">perfeito alinhamento da coluna</span> e um <span class="strong">excelente suporte progressivo em cada região do corpo.</span></p>
</div>
</div>
</div>
</div>
</div>';
}

if ($post->ID==423) { 
			$contenido_frances = '<div class="info-product">

<h3><span class="strong-product">IRONMAN<sup>™</sup>  LOUISVILLE</span><br/>
BIO FOAM PILLOW</h3>
<p class="subtitulo">OREILLER EN MATÉRIEAU VISCOÉLASTIQUE</p>
<p><span class="strong">Developed by IRONMAN<sup>&#8482</sup> ‘ACTIVE RECOVERY EQUIPMENT’</span>
<h4>
LA TECHNOLOGIE DE REPOS <br/>
LA PLUS INNOVANTE AU MONDE.
</h4>
<hr>
<p>Toute la gamme d\'oreillers développés par nos experts est le complément parfait de nos matelas de repos actif.  </p>
<p>
Tissus contenant des particules de Celliant.<br/>
<br/>
<font style="color: #0093bd;">Noyau:</font><br/>
- Viscoélastique 45 kg/m3 respirant (500 % de plus qu\'un viscoélastique classique) et lavable à 60º. Technologie Airsense®.
<br/><br/>
<font style="color: #0093bd;">Tests passés:</font>
<br/>

- Oeko Test Standard 100 classe 2.<br/>
- Test de nettoyage UNI EN ISO 6330. <br/>
- Test de respirabilité UNI EN ISO 4638.<br/>
</p>
</div>
<div style="margin-top:50px;margin-bottom:-30px;FONT-WEIGHT:BOLD;">
Les dimensions disponibles sont les suivantes :
</div> ';
			$contenido_portugues = '
<div class="info-product">

<h3><span class="strong-product">IRONMAN<sup>™</sup>  LOUISVILLE</span><br/>
BIO FOAM PILLOW</h3>
<p class="subtitulo">TRAVESSEIRO VICOELÁSTICO</p>
<p><span class="strong">Developed by IRONMAN<sup>&#8482</sup> ‘ACTIVE RECOVERY EQUIPMENT’</span>
<h4>
A TECNOLOGIA DE DESCANSO <br/>
MAIS INOVADORA DO MUNDO.</h4>
<hr>
<p>Toda a gama de travesseiros desenvolvidos por nossos especialistas são o complemento perfeito para o nosso colchão de descanso ativo.</p>
<p>
 Tecido com partículas de Celliant.<br/>
<br/>
<font style="color: #0093bd;">Núcleo:</font><br/>
- Vicoelástico 45 kg/m3 transpirável (500% mais que um viscoelástico normal) e lavável a 60º. Tecnologia Airsense®.
<br/><br/>
<font style="color: #0093bd;">Testes passados:</font>
<br/>
 
- Oeko Test Standard 100 classe 2.<br/>
- Teste de lavagem UNI EN ISO 6330. <br/>
- Teste de transpiração UNI EN ISO 4638.<br/>
</p>
</div>
<div style="margin-top:50px;margin-bottom:-30px;FONT-WEIGHT:BOLD;">
As medidas disponíveis são as seguintes:
</div> ';
}

if ($post->ID==571) { 
			$contenido_frances = '<div class="info-product">

<h3><span class="strong-product">IRONMAN<sup>™</sup>  LANGKAWI</span><br/>
LATEX PILLOW</h3>
<p class="subtitulo">OREILLER EN LATEX</p>
<p><span class="strong">Developed by IRONMAN<sup>&#8482</sup> ‘ACTIVE RECOVERY EQUIPMENT’</span>
<h4>
LA TECHNOLOGIE DE REPOS<br/> 
LA PLUS INNOVANTE AU MONDE.
</h4>
<hr>
<p>Toute la gamme d\'oreillers développés par nos experts est le complément parfait de nos matelas de repos actif.  
  </p>
<p>
Tissus contenant des particules de Celliant.<br/>
<br/>
<font style="color: #0093bd;">Noyau:</font><br/>
- Latex semi-naturel 50/50 de 35 kg/m3.
<br/><br/>
<font style="color: #0093bd;">Tests passés:</font>
<br/>
 
- Oeko Test Standard 100 classe 2. <br/>
- Test de nettoyage UNI EN ISO 6330. <br/>
- Test de respirabilité UNI EN ISO 4638.<br/>
</p>
</div>
<div style="margin-top:50px;margin-bottom:-30px;FONT-WEIGHT:BOLD;">
Les dimensions disponibles sont les suivantes:
</div>';
			$contenido_portugues = '<div class="info-product">

<h3><span class="strong-product">IRONMAN<sup>™</sup>  LANGKAWI</span><br/>
LATEX PILLOW</h3>
<p class="subtitulo">TRAVESSEIRO DE LÁTEX</p>
<p><span class="strong">Developed by IRONMAN<sup>&#8482</sup> ‘ACTIVE RECOVERY EQUIPMENT’</span>
<h4>
A TECNOLOGIA DE DESCANSO <br/>
MAIS INOVADORA DO MUNDO.
</h4>
<hr>
<p>Toda a gama de travesseiros desenvolvidos por nossos especialistas são o complemento perfeito para o nosso colchão de descanso ativo. 
  </p>
<p>
Tecido com partículas de Celliant.<br/>
<br/>
<font style="color: #0093bd;">Núcleo:</font><br/>
- Látex seminatural 50/50 de 35 kg/m3.
<br/><br/>
<font style="color: #0093bd;">Testes passados:</font>
<br/>

- Oeko Test Standard 100 classe 2. <br/>
- Teste de lavagem UNI EN ISO 6330.<br/>
- Teste de transpiração UNI EN ISO 4638.<br/>
</p>
</div>
<div style="margin-top:50px;margin-bottom:-30px;FONT-WEIGHT:BOLD;">
As medidas disponíveis são as seguintes:
</div>';
}
			?>
			<div class="product-short">
				<?php
				$language_myqtrans = qtrans_getLanguage();
			
			switch ($language_myqtrans) {
				case "es":
					echo do_shortcode($product_short_description); //DESCRIPCION DE PRODUCTO
					break;
				case "fr":
					echo do_shortcode($contenido_frances);
					break;
				case "pt":
					echo do_shortcode($contenido_portugues);
					break;
			} 
		
				 ?>
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
		//echo "IDENTIFICADOR DEL POST: ".$post->ID;
		if ($post->ID==161) { //solo mostramos personalizador en la página del colchón t24.7
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			if(stripos($ua,'iphone') !== false) { // && stripos($ua,'mobile') !== false) {
				?><a href="#personalizar" class="animate-iphone" style="background-color: #0093BD !important;color:#FFFFFF;border: 0 none;border-radius: 0;box-shadow: none;font-weight: bold;text-shadow: none;padding: 15px;width:250px;"><?php if ($language_myqtrans == "es"){echo "Encuentra tu colchón";} if ($language_myqtrans == "fr"){echo "Trouvez votre matelas";} if ($language_myqtrans == "pt"){echo "Encontre o seu colchão";}?></a> <?php
			}
			else if(stripos($ua,'android') !== false) { // && stripos($ua,'mobile') !== false) {
				?><a href="#personalizar" class="animate-android" style="background-color: #0093BD !important;color:#FFFFFF;border: 0 none;border-radius: 0;box-shadow: none;font-weight: bold;text-shadow: none;padding: 15px;width:250px;"><?php if ($language_myqtrans == "es"){echo "Encuentra tu colchón";} if ($language_myqtrans == "fr"){echo "Trouvez votre matelas";} if ($language_myqtrans == "pt"){echo "Encontre o seu colchão";}?></a> <?php
			}
			else{
			?><a href="#personalizar" class="animate-advisor" style="background-color: #0093BD !important;color:#FFFFFF;border: 0 none;border-radius: 0;box-shadow: none;font-weight: bold;text-shadow: none;padding: 15px;width:250px;"><?php if ($language_myqtrans == "es"){echo "Encuentra tu colchón";} if ($language_myqtrans == "fr"){echo "Trouvez votre matelas";} if ($language_myqtrans == "pt"){echo "Encontre o seu colchão";}?></a> <?php
			}
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

<?php
if ($post->ID==161) { //solo mostramos personalizador en la página del colchón t24.7
?>

<div class="banner-bottom-product">

	<div class="container">
	
<div class="part-left-product span5">

<div class="simbol-product"><img src="http://ironmanrecovery.com/wp-content/themes/neighborhood/images/flor-product.png" alt=""></div>
	<div class="text-product-left">
		<h1><span class="strong">IRONMAN</span> <br /><span class="weak">ADVISOR</span></h1>
	</div>
</div>

<div class="part-right-product span6">
<?php
$language_myqtrans = qtrans_getLanguage();
if ($language_myqtrans == "es"){
?> 
	<h5>Personaliza ya tu T24.7® <br />
y optimiza sus beneficios al máximo.</h5>

	<p>El asesor personalizado <span>IRONMAN<sup>&trade;</sup> ADVISOR</span> te permite customizar
la superficie de recuperación T24.7® según tu fisiología y preferencias de
descanso en 4 sencillos pasos.</p>
	</div>
<?php
}
$language_myqtrans = qtrans_getLanguage();
if ($language_myqtrans == "fr"){
?> 
	<h5>Personnalisez dès maintenant votre T24.7® <br/>et optimisez ses bienfaits au maximum.</h5>
<p>O assessor personalizado <span>IRONMAN<sup>&trade;</sup> ADVISOR</span> permite que você customize a superfície de recuperação T24.7® de acordo com a sua fisiologia e preferências de descanso em 4 passos simples.</p>
	</div>
<?php
}
$language_myqtrans = qtrans_getLanguage();
if ($language_myqtrans == "pt"){
?> 
	<h5>Personalize já o seu T24.7® <br/> e otimize seus benefícios ao máximo.</h5>
<p>O assessor personalizado <span>IRONMAN<sup>&trade;</sup> ADVISOR</span> permite que você customize a superfície de recuperação T24.7® de acordo com a sua fisiologia e preferências de descanso em 4 passos simples.</p>
	</div>
<?php
}
?>

</div>

</div>

<div id="personalizar"></div>

<div id="personalizador-de-colchones">

	<div class="container">
        <div class="row">
        	<div class="span12">
        		<h4 class="titulo-seccion"><?php if ($language_myqtrans == "es"){echo "¿DUERMES SÓLO O EN PAREJA?";} if ($language_myqtrans == "fr"){echo "Dormez-vous seul ou en couple ?";} if ($language_myqtrans == "pt"){echo "Você dorme sozinho ou com alguém?";}?></h4>
        	</div>
        </div><!--row-->
        <div class="row">
	        <div class="span12">
	        	<ul id="titulos">
		        	<li>
				        <div id="titulo-individual" class="titulo" data-tipo="individual">
				        	<?php if ($language_myqtrans == "es"){echo "Individual";} if ($language_myqtrans == "fr"){echo "Seul";} if ($language_myqtrans == "pt"){echo "Individual";}?>
			        	</div>
		        	</li>
		        	<li>
			        	<div id="titulo-pareja" class="titulo" data-tipo="pareja">
							<?php if ($language_myqtrans == "es"){echo "En pareja";} if ($language_myqtrans == "fr"){echo "En couple";} if ($language_myqtrans == "pt"){echo "Casal";}?>
			        	</div>
			        </li>
			       </ul> <!--titulos-->
	        </div><!--span12-->
        </div><!--row-->
        <div id="personalizadores" class="row">
	        <div class="span6">
	        	<div class="personalizador" id="personalizador-individual" data-peso=40 data-altura=100 data-apoyo=0 data-presion="0">
		        	<div class="seccion-personalizador">
			        	<h5><?php if ($language_myqtrans == "es"){echo "¿CUÁNTO PESAS?";} if ($language_myqtrans == "fr"){echo "Combien pesez-vous?";} if ($language_myqtrans == "pt"){echo "Quanto você pesa?";}?></h5>
			        	<div id="slider-peso-individual" class="peso"></div>
					    <div class="valor"><span class="num num-peso">40</span><span class="tipo">kg</span></div>
			        	<div class=""></div>
		        	</div>
		        	
		        	<div class="seccion-personalizador">
			        	<h5><?php if ($language_myqtrans == "es"){echo "¿CUÁNTO MIDES?";} if ($language_myqtrans == "fr"){echo "Quelle taille faites-vous ?";} if ($language_myqtrans == "pt"){echo "Qual a sua altura?";}?></h5>
			        	<div id="slider-altura-individual" class="altura"></div>
					    <div class="valor"><span class="num num-altura">100</span><span class="tipo">cm</span></div>
			        	<div class="rangos">
				        	<div class="rango">100</div>
				        	<div class="rango">125</div>
				        	<div class="rango">150</div>
				        	<div class="rango">175 <span style="float:right;position:relative;right:-10px">200</span></div>
			        	</div>
			        	<div class="clear"></div>
		        	</div><!--seccionPersonalizador-->
		        	<div class="seccion-personalizador">
			        	<h5 style="margin-top:30px"><?php if ($language_myqtrans == "es"){echo "¿QUÉ SENSACIÓN DE APOYO PREFIERES?";} if ($language_myqtrans == "fr"){echo "Quel type de matelas préférez-vous?";} if ($language_myqtrans == "pt"){echo "Que sensação de apoio você prefere?";}?></h5>
			        	<div class="apoyos">
				        	<div class="apoyo-img apoyo1"></div>
				        	<div class="apoyo-img apoyo2"></div>
				        	<div class="apoyo-img apoyo3"></div>
			        	</div>
			        	<div id="slider-apoyo-individual" class="apoyo"></div>
					    <div class="valor"><span class="num texto"><?php if ($language_myqtrans == "es"){echo "Normal";} if ($language_myqtrans == "fr"){echo "Medium";} if ($language_myqtrans == "pt"){echo "Normal";}?></span></div>
		        	</div><!--seccionPersonalizador-->
	        	</div><!--personalizador-->
	        </div><!--col-->
	        <div class="span6">
	        	<div class="personalizador" id="personalizador-pareja" data-peso=40 data-altura=100 data-apoyo=0 data-presion="0">
		        	<div class="seccion-personalizador">
			        	<h5><?php if ($language_myqtrans == "es"){echo "¿Y TU PAREJA?";} if ($language_myqtrans == "fr"){echo "Et votre conjoint?";} if ($language_myqtrans == "pt"){echo "E a de seu(sua) companheiro(a)?";}?></h5>
			        	<div id="slider-peso-individual" class="peso"></div>
					    <div class="valor"><span class="num num-peso">40</span><span class="tipo">kg</span></div>
			        	<div class=""></div>
		        	</div>
		        	
		        	<div class="seccion-personalizador">
			        	<h5><?php if ($language_myqtrans == "es"){echo "¿Y TU PAREJA?";} if ($language_myqtrans == "fr"){echo "Et votre conjoint?";} if ($language_myqtrans == "pt"){echo "E a de seu(sua) companheiro(a)?";}?></h5>
			        	<div id="slider-altura-individual" class="altura"></div>
					    <div class="valor"><span class="num num-altura">100</span><span class="tipo">cm</span></div>
			        	<div class="rangos">
				        	<div class="rango">100</div>
				        	<div class="rango">125</div>
				        	<div class="rango">150</div>
				        	<div class="rango">175 <span style="float:right;position:relative;right:-10px">200</span></div>
			        	</div>
			        	<div class="clear"></div>
		        	</div><!--seccionPersonalizador-->
		        	<div class="seccion-personalizador">
			        	<h5 style="margin-top:30px"><?php if ($language_myqtrans == "es"){echo "¿Y TU PAREJA?";} if ($language_myqtrans == "fr"){echo "Et votre conjoint?";} if ($language_myqtrans == "pt"){echo "E a de seu(sua) companheiro(a)?";}?></h5>
			        	<div class="apoyos">
				        	<div class="apoyo-img apoyo1"></div>
				        	<div class="apoyo-img apoyo2"></div>
				        	<div class="apoyo-img apoyo3"></div>
			        	</div>
			        	<div id="slider-apoyo-individual" class="apoyo"></div>
					    <div class="valor"><span class="num texto"><?php if ($language_myqtrans == "es"){echo "Normal";} if ($language_myqtrans == "fr"){echo "Medium";} if ($language_myqtrans == "pt"){echo "Normal";}?></span></div>
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
				<div id="info-colchones" style="height:0px;padding-top:20px;overflow:hidden">
			    	<div> - Presión individual obtenida: <strong><span id="muestra-presion-individual">0</span> (tipo <span id="muestra-tipo-individual">-</span>)</strong></div>
			    	<div> - Presión de la pareja obtenida: <strong><span id="muestra-presion-pareja">0</span> (tipo <span id="muestra-tipo-pareja">-</span>)</strong></div>
			    	<div> - Medida del colchón elegida: <strong><span id="muestra-ancho">0</span>x<span id="muestra-alto">0</span></strong>
			    	</div>
				</div><!--infoColchones-->
			</div><!--span-->
		</div><!--row-->
		<div style="margin-top:20px" class="row">
			<div class="span6">
				<div class="seccion-personalizador">
				<h3><?php if ($language_myqtrans == "es"){echo "CAPA CUSTOM INDIVIDUAL: ";} if ($language_myqtrans == "fr"){echo "Couche CUSTOM individuel";} if ($language_myqtrans == "pt"){echo "CAMADA INDIVIDUAL:";}?> <span style="text-transform:uppercase" id="muestra-tipo-individual-publica"> - </span></h3>
				</div>
			</div>
			<div class="span6">
				<div id="capa-custom-pareja" class="seccion-personalizador">
				
				<h3><?php if ($language_myqtrans == "es"){echo "CAPA CUSTOM PAREJA: ";} if ($language_myqtrans == "fr"){echo "Couche CUSTOM double";} if ($language_myqtrans == "pt"){echo "CAMADA DE CASAL:";}?><span id="muestra-tipo-pareja-publica"> - </span></h3>
				</div>
			</div>
		</div>
		
        <div class="row">
	        <div class="span12">
	        	<h4 class="titulo-seccion"><?php if ($language_myqtrans == "es"){echo "¿QUÉ MEDIDA PREFIERES?";} if ($language_myqtrans == "fr"){echo "Quelle mesure préfères-tu?";} if ($language_myqtrans == "pt"){echo "QUE MEDIDA PREFERE?";}?></h4>
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
		       	 Deshacer todo
	       	 </div>
       	 </div>
        </div>
    </div><!--container-->
</div>

<?php
}
?>

<div class="banner-bottom-img" role="main">

	<div class="row-fluid">

		<div class="container">
		<?php
		if ($post->ID==161) { //solo mostramos video en la página del colchón t24.7
			
			// VIDEO EN DISTINTOS IDIOMAS
			$language_myqtrans = qtrans_getLanguage();
			if ($language_myqtrans == "es"){
			?>
			<div id="videoytemb" style="clear:both;float;none;">
			<iframe id="videoytembframe" src="//www.youtube.com/embed/IDeyxDOKuYg" frameborder="0" allowfullscreen></iframe>
			</div>
			
			<?php
			}
			
			if ($language_myqtrans == "fr"){
			?>
			<div id="videoytemb" style="clear:both;float;none;">
			<iframe id="videoytembframe" src="//www.youtube.com/embed/CTgQE8rfMiU" frameborder="0" allowfullscreen></iframe>
			</div>
			
			<?php
			}
			
			if ($language_myqtrans == "pt"){
			?>
			<div id="videoytemb" style="clear:both;float;none;">
			<iframe id="videoytembframe" src="//www.youtube.com/embed/SGhf7Cb4a_4" frameborder="0" allowfullscreen></iframe>
			</div>
			
			<?php
			}
		}
		
		// IMAGENES DE ABAJO EN DISTINTOS IDIOMAS
		$language_myqtrans = qtrans_getLanguage();
		if ($language_myqtrans == "es"){
		?>
			<div class="transporte-product span4"><img src="http://ironmanrecovery.com/wp-content/themes/neighborhood/images/transporte.png" alt="Transporte"></div>
			<div class="garantia-product span4"><img src="http://ironmanrecovery.com/wp-content/themes/neighborhood/images/garantia.png" alt="Garantia"></div>
			<div class="informacion-product span4"><img src="http://ironmanrecovery.com/wp-content/themes/neighborhood/images/informacion.png" alt="Información"></div>
		<?php
		}
		$language_myqtrans = qtrans_getLanguage();
		if ($language_myqtrans == "fr"){
		?>
			<div class="transporte-product span4"><img src="http://ironmanrecovery.com/wp-content/uploads/imgs_fr/SHOP/Banner%20shop%20franc%C3%A9s-01.png" alt="Transporte"></div>
			<div class="garantia-product span4"><img src="http://ironmanrecovery.com/wp-content/uploads/imgs_fr/SHOP/Banner%20shop%20franc%C3%A9s-02.png" alt="Garantia"></div>
			<div class="informacion-product span4"><img src="http://ironmanrecovery.com/wp-content/uploads/imgs_fr/SHOP/Banner%20shop%20franc%C3%A9s-03.png" alt="Información"></div>
		<?php
		}
		$language_myqtrans = qtrans_getLanguage();
		if ($language_myqtrans == "pt"){
		?>
			<div class="transporte-product span4"><img src="http://ironmanrecovery.com/wp-content/uploads/imgs_pt/SHOP/BANNERS/Banner%20Shop%20Portugues-01.png" alt="Transporte"></div>
			<div class="garantia-product span4"><img src="http://ironmanrecovery.com/wp-content/uploads/imgs_pt/SHOP/BANNERS/Banner%20Shop%20Portugues-02.png" alt="Garantia"></div>
			<div class="informacion-product span4"><img src="http://ironmanrecovery.com/wp-content/uploads/imgs_pt/SHOP/BANNERS/Banner%20Shop%20Portugues-03.png" alt="Información"></div>
		<?php
		}
		?>
		</div>
	</div>
</div>
</div>
