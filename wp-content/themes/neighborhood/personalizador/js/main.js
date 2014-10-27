jQuery(document).ready(function(){
	

	var alturaObtenida = 0;
	var presion = 0;
	var anchuraColchonElegida = 0;
	var alturaColchonElegida = 0;
	var tipo = 'Soft';
	var personalizadorDeColchones = jQuery('#personalizador-de-colchones');
	var personalizadores = jQuery('#personalizadores');
	var personalizadorIndividual = jQuery('#personalizador-individual');
	var personalizadorPareja = jQuery('#personalizador-pareja');
	var restaurarValores = jQuery('#restaurar-valores');
        
        
        jQuery('.cart-contents').hover(function(){
            jQuery('.cart-contents').css("background", "url('images/pico.png') no-repeat 50% 100%");
            jQuery('.shopping-bag').fadeIn(300);
        });
        jQuery('.shopping-bag').mouseleave(function(){
            jQuery('.cart-contents').css("background", "url('')");
            jQuery('.shopping-bag').fadeOut(300);
        });
        jQuery('.mini-cart-wrap').mouseleave(function(){
            jQuery('.cart-contents').css("background", "url('')");
            jQuery('.shopping-bag').fadeOut(300);
        });
        
        var lang=jQuery('#lang').val();
        
        jQuery('.posted_in a').click(function(){
            var href=jQuery('.posted_in a').attr("href");
            var res = href.replace("categorie-produit","categoria-producto");
            jQuery('.posted_in a').attr("href", res);
        });
 
            
        if (lang == "es"){
            
        
            
        }else if (lang =="fr") {
            jQuery('.shipping td').html("Envoi gratuit");
            
            jQuery('.variation dt').each(function() {
                if (jQuery(this).html() == "Altura:"){
                    jQuery(this).html('Longueur:')
                }else if (jQuery(this).html() == "Anchura:"){
                    jQuery(this).html('Largeur')
                }else if (jQuery(this).html() == "Capa custom principal:"){
                    jQuery(this).html('Coutil de matelas principal:')
                }else if (jQuery(this).html() == "Capa custom pareja:"){
                    jQuery(this).html('Coutil de matelas couple:')
                }else if (jQuery(this).html() == "Medida:"){
                    jQuery(this).html('Mesure:')
                }
                
            
            });
            
        }else if (lang =="pt") {
            /*jQuery('.shipping td').html("Frete grátis");
            
            jQuery('.variation dt').each(function() {
                if (jQuery(this).html() == "Altura:"){
                    jQuery(this).html('Altura:')
                }else if (jQuery(this).html() == "Anchura:"){
                    jQuery(this).html('Largura')
                }else if (jQuery(this).html() == "Capa custom principal:"){
                    jQuery(this).html('Camada custom principal:')
                }else if (jQuery(this).html() == "Capa custom pareja:"){
                    jQuery(this).html('Camada custom casal:')
                }else if (jQuery(this).html() == "Medida:"){
                    jQuery(this).html('Medida:')
                }
                
            
            });*/
            
        }

/*****************************

Función que recibe como parámetros los dos tipos firmeza,
la altura y la anchura del colchón, y añade el producto al carrito

*****************************/
	
    
    
	function anadir_carrito(idColchon,firmezaA,firmezaB,altura,anchura,identificador){
		 jQuery.ajax({
	        type: 'POST',
	        //async: false,
	        url: sesionajax.ajaxurl,
	        data: {
	            action: 'anadir_colchon',
	            id_colchon: idColchon,
	            firmeza1: firmezaA,
	            firmeza2: firmezaB,
	            alto: altura,
	            ancho: anchura,
	            identificador_producto: identificador
	        },
	        success: function(data, textStatus, XMLHttpRequest) {
		        window.location.href = url_home+'/?page_id=6';
			},
	        error: function(MLHttpRequest, textStatus, errorThrown) {
	            //alert(errorThrown);
	        }
	    });
	}


/****************************

Función que comprueba si se han introducido los valores correspondientes de cualquier personalizador

*****************************/

function compruebaPresion(){
	if( parseInt(jQuery('#muestra-presion-pareja').text()) != 0 ){
		
		jQuery('#container-colchones').addClass('activo');
		jQuery('#colchones-individual').removeClass('activo');
		jQuery('#colchones-pareja').addClass('activo');
		
	}
	
	else if (parseInt(jQuery('#muestra-presion-individual').text()) != 0 ){
		
		jQuery('#container-colchones').addClass('activo');
		jQuery('#colchones-individual').addClass('activo');
		jQuery('#colchones-pareja').addClass('activo');
	}
	else{
		
		jQuery('#container-colchones').removeClass('activo');
		jQuery('#colchones-individual').removeClass('activo');
		jQuery('#colchones-pareja').removeClass('activo');
	}
}


/****************************

Función que, dado un personalizador, lo resetea

*****************************/


function resetPersonalizador(personalizador){
	
	personalizador.find('.peso').slider({
		value:40
	});
	personalizador.find(' .altura').slider({
		value:100
	});
	personalizador.find(' .apoyo').slider({
		value:2
	});
	personalizador.attr('data-peso',40);
	personalizador.attr('data-altura',100);
	personalizador.attr('data-apoyo',0);
	personalizador.find('.valor .num-peso').text('40');
	personalizador.find('.valor .num-altura').text('100');
	personalizador.find('.valor .num.texto').text('Normal');
	calculaPresion(personalizador);
}
/****************************

/****************************

Función que restaura los personalizadores a su valor inicial

*****************************/


	restaurarValores.click(function(){
		jQuery.scrollTo(personalizadorDeColchones,1200,{'axis':'y'});
		personalizadores.removeClass('activo');
		jQuery('#titulo-individual').removeClass('activo');
		jQuery('#titulo-pareja').removeClass('activo');
		resetPersonalizador(personalizadorIndividual);
		resetPersonalizador(personalizadorPareja);
	});

/****************************

Función que calcula la presión del personalizador (individual o pareja) y
que se ejecuta con cada movimiento de los sliders. Recibe como parámetro
el tipo de personalizador sobre el que calcularle la presión

*****************************/
	
	function calculaPresion(personalizador){
	    peso = personalizador.attr('data-peso');
	    altura = personalizador.attr('data-altura');
	    apoyo = personalizador.attr('data-apoyo');
	    if  ((peso == 40 ) && (altura == 100)){
		    presion = 0
	    }
	    else{
		    presion =  10*peso/Math.sqrt((peso*altura)/3600);
		    if (isFinite(presion)){
			    presion = presion + parseInt(apoyo);
		    }
		    else{
			    presion = 0 /*+ parseInt(apoyo)*/;
		    }
		 }
	    personalizador.attr('data-presion',presion);
	   	setTipo(presion);
	    
	    if(personalizador.attr('id')==('personalizador-individual')){
	   	 jQuery('#muestra-presion-individual').text(presion);
	   	jQuery('#muestra-tipo-individual').text(tipo);
	   	jQuery('#muestra-tipo-individual-publica').text(tipo);
	   	}
	   	else{
	   	 jQuery('#muestra-presion-pareja').text(presion);
	   	jQuery('#muestra-tipo-pareja').text(tipo);
	   	jQuery('#muestra-tipo-pareja-publica').text(tipo);
	   	}
	   	compruebaPresion();
    }
    
/****************************

Función que recibe como parámetro la presión y le asigna el tipo al que pertenece

*****************************/
    
    function setTipo(cantidad){
	    if(cantidad >= 496){
		    tipo = 'Extra Hard';
	    }
	    else if ( (cantidad < 496) && (cantidad >= 436) ){
		    tipo = 'Hard';
	    }
	    else if ( (cantidad < 436) && (cantidad >= 361) ){
		    tipo = 'Medium';
	    }
	    else{
		    tipo = 'Soft';
	    }
    }
    
    

    
/*****************************

Función que genera la medida en alto de los colchones y que se ejecuta cada vez que
el usuario modifica su altura o la de su pareja. Para calcular dicha medida, toma
como referencia la mayor de las alturas obtenidas entre los dos tipos de personalizadores.

*****************************/
    
    function calculaAlturaColchon(){
    	
    	alturaIndividual = parseInt(jQuery('#personalizador-individual').attr('data-altura'));
    	alturaPareja = parseInt(jQuery('#personalizador-pareja').attr('data-altura'));
    	
    	/*if (alturaIndividual > alturaPareja){
	    	alturaPersona = alturaIndividual;
    	}
    	else if(alturaPareja > alturaIndividual){
	    	alturaPersona = alturaPareja;
    	}
	    alturaObtenida =  ( ( alturaPersona / 10 ).toFixed(0))*10;
	    jQuery('.alto.alto1').text(alturaObtenida+10);
	    jQuery('.alto.alto2').text(alturaObtenida+20);
	    jQuery('.alto.alto3').text(alturaObtenida+30);*/
	    
	    if ( ( alturaIndividual >= 200) || (alturaPareja >= 200) ){
		    jQuery('.seccion-tamano ul li.alto-200').css('display','none');
		    jQuery('.seccion-tamano ul li.alto-190').css('display','none');
	    }
	    else if ( ( alturaIndividual >= 190) || (alturaPareja >= 190) ){
		    jQuery('.seccion-tamano ul li.alto-200').css('display','inline');
		    jQuery('.seccion-tamano ul li.alto-190').css('display','none');
	    }
	    else{
		    jQuery('.seccion-tamano ul li.alto-200').css('display','inline');
		    jQuery('.seccion-tamano ul li.alto-190').css('display','inline');
	    }
    }
 

/*****************************

Eventos de los sliders para el peso, altura y apoyo

*****************************/

	jQuery( '.peso' ).slider({
		value:40,
		min: 40,
		max: 150,
		step: 1,
    	slide: function( event, ui ) {
    		var tipoPersonalizador =  jQuery(this).parent().parent();
    		if(tipoPersonalizador.hasClass('activo')){
		    	jQuery(this).parent().find('.valor .num').text(ui.value );
	       		tipoPersonalizador.attr('data-peso',ui.value);
	       		calculaPresion(tipoPersonalizador);
	       	}
	       	else{
		       	event.preventDefault();
	       	}
	    }
	});
	jQuery('.altura' ).slider({
		value:100,
		min: 100,
		max: 200,
		step: 1,
    	slide: function( event, ui ) {
    		var tipoPersonalizador =  jQuery(this).parent().parent();
    		if(tipoPersonalizador.hasClass('activo')){
		    	jQuery(this).parent().find('.valor .num').text(ui.value );
	       		tipoPersonalizador.attr('data-altura',ui.value);
	       		calculaPresion(tipoPersonalizador);
	       		calculaAlturaColchon();
	       	}
	       	else{
		       	event.preventDefault();
	       	}
	    }
	});
    jQuery( '.apoyo' ).slider({
      value:2,
      min: 1,
      max: 3,
      step: 1,
      slide: function( event, ui ) {
      	var tipoPersonalizador =  jQuery(this).parent().parent();
      	if(tipoPersonalizador.hasClass('activo')){
	      	if(ui.value == 1){
	       		jQuery(this).parent().find('.valor .num').text("Blanda");
	       		tipoPersonalizador.attr('data-apoyo',-50);
	        }
	        else if(ui.value == 2){
	       		jQuery(this).parent().find('.valor .num').text("Normal" );
		        tipoPersonalizador.attr('data-apoyo',0);
	        }
	        else{
	       		jQuery(this).parent().find('.valor .num').text("Firme");
	       		tipoPersonalizador.attr('data-apoyo',+50);
	        }
	       	calculaPresion(tipoPersonalizador);
	     }
	     else{
		 	event.preventDefault();
	     }
      }
    });

/*****************************

Evento que selecciona el tipo de personalizador activo

*****************************/

    jQuery('#titulo-individual').click(function(){
    	jQuery.scrollTo(personalizadores,1000,{'axis':'y'});
    	jQuery('#personalizadores').addClass('activo');
    	jQuery(this).addClass('activo');
	    jQuery('#personalizador-individual').addClass('activo');
	    jQuery('#personalizador-pareja').removeClass('activo');
	    jQuery('#titulo-pareja').removeClass('activo');
	    jQuery('#capa-custom-pareja').fadeOut();
	    resetPersonalizador(personalizadorPareja);
    });
    jQuery('#titulo-pareja').click(function(){
    	/*if(jQuery(this).hasClass('activo')){
	    	jQuery('#personalizador-pareja').removeClass('activo');
		    jQuery('#titulo-individual').addClass('activo');
		    jQuery(this).removeClass('activo');
    	}
    	else{*/
    		jQuery.scrollTo(personalizadores,1000,{'axis':'y'});
    		jQuery('#personalizadores').addClass('activo');
		    jQuery('#personalizador-individual').addClass('activo');
		    jQuery('#personalizador-pareja').addClass('activo');
		    jQuery(this).addClass('activo');
		    jQuery('#titulo-individual').removeClass('activo');
		    jQuery('#colchones-individual').removeClass('activo');
		    jQuery('#capa-custom-pareja').fadeIn();
    	/*}*/
    });
    

/*****************************

Evento que selecciona el tipo de medida de colchón escogido, actualizando las
variables alutraColchonElegida y anchuraColchonElegida

*****************************/
    
    jQuery('.seccion-tamano ul li').click(function(){
    	jQuery('.seccion-tamano ul li').removeClass('activo');
	    jQuery(this).addClass('activo');
	    var alturaColchonElegida = parseInt(jQuery(this).find('.alto').text());
	    var anchuraColchonElegida = parseInt(jQuery(this).find('.ancho').text());
	    var tipoFirmeza1 = jQuery('#muestra-tipo-individual').text();
	    var tipoFirmeza2 = jQuery('#muestra-tipo-pareja').text();
	    if(jQuery('#titulo-individual').hasClass('activo')){
		    tipoFirmeza2= '-';
	    }
	    var idColchon = jQuery(this).attr('id');
	    var identificadorProducto = jQuery(this).attr('data-producto');
	    
	    jQuery('#muestra-ancho').text(anchuraColchonElegida);
	    jQuery('#muestra-alto').text(alturaColchonElegida);
	    
	    
	    anadir_carrito(idColchon,tipoFirmeza1,tipoFirmeza2,alturaColchonElegida,anchuraColchonElegida,identificadorProducto);
	    
    });
    
/*****************************

Evento que selecciona el tipo de apoyo necesario pinchando en las imágenes
de cada uno de los tipos

*****************************/
    
    jQuery('.apoyos .apoyo-img').click(function(){
    	var tipoPersonalizador =  jQuery(this).parent().parent().parent();
      	if(tipoPersonalizador.hasClass('activo')){
		    if(jQuery(this).hasClass('apoyo1')){
			    jQuery(this).parent().parent().find('.apoyo').slider({
				    value:1
			    });
			    jQuery(this).parent().parent().find('.valor .num').text("Blanda");
	       		tipoPersonalizador.attr('data-apoyo',-50);
		    }
		     else if(jQuery(this).hasClass('apoyo2')){
			    jQuery(this).parent().parent().find('.apoyo').slider({
				    value:2
			    });
			    jQuery(this).parent().parent().find('.valor .num').text("Normal");
	       		tipoPersonalizador.attr('data-apoyo',0);
		    }
		     else{
			    jQuery(this).parent().parent().find('.apoyo').slider({
				    value:3
			    });
			    jQuery(this).parent().parent().find('.valor .num').text("Firme");
	       		tipoPersonalizador.attr('data-apoyo',50);
		    }
		    calculaPresion(tipoPersonalizador);
		 }
		 else{
		 	event.preventDefault();
	     }
    });
    

});