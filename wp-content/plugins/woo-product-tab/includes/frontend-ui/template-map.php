 <?php
	if($custom_tab_options['tab_type']=='location_point')
	{
?>		

    <div id="map-canvas" data-type="<?php echo $custom_tab_options['tab_type']; ?>" data-lat="<?php echo ($custom_tab_options['tab_lat']) ?>" data-long="<?php echo $custom_tab_options['tab_long'] ?>" data-address="<?php echo $custom_tab_options['tab_address'] ?>"></div>

	<?php }
	else if($custom_tab_options['tab_type']=='address')
	{
	?>		

    <div id="map-canvas" data-type="<?php echo $custom_tab_options['tab_type']; ?>" data-lat="<?php echo ($custom_tab_options['tab_lat']) ?>" data-long="<?php echo $custom_tab_options['tab_long'] ?>" data-address="<?php echo $custom_tab_options['tab_address'] ?>"></div>

	<?php
	} 
	else if($custom_tab_options['tab_type']=='embed')
	{
		echo $content;
	} 
	?>
	
    <script type="text/javascript">
    	jQuery(document).ready(function(){
			
			jQuery("a[href=#tab-<?php echo $custom_tab_options['tab_id'] ?>]").click(function(){
				if (jQuery('html').find('#map-canvas').length) {
					jQuery('#map-canvas').html(''); 
					if(jQuery('#map-canvas').attr('data-type')=="address")
					{
						var my_address=jQuery('#map-canvas').attr('data-address');
						var map='';	// Google map object
	
						// Initialize and display a google map
				
						// Map options for how to display the Google map
						var mapOptions = { zoom: 12};
						
						map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
						
					
						var geocoder = new google.maps.Geocoder();    // instantiate a geocoder object
						
						var address = my_address;
					
						// Make asynchronous call to Google geocoding API
						geocoder.geocode( { "address": address }, function(results, status) {
							var addr_type = results[0].types[0];	// type of address inputted that was geocoded
							if ( status == google.maps.GeocoderStatus.OK ) 
								ShowLocation( results[0].geometry.location, address, addr_type );
							else     
								alert("Geocode was not successful for the following reason: " + status);        
						});
							
						
						// Show the location (address) on the map.
						function ShowLocation( latlng, address, addr_type )
						{
							// Center the map at the specified location
							map.setCenter( latlng );
							
							// Set the zoom level according to the address level of detail the user specified
							var zoom = 12;
							switch ( addr_type )
							{
							case "administrative_area_level_1"	: zoom = 6; break;		// user specified a state
							case "locality"						: zoom = 10; break;		// user specified a city/town
							case "street_address"				: zoom = 15; break;		// user specified a street address
							}
							map.setZoom( zoom );
							
							// Place a Google Marker at the same location as the map center 
							// When you hover over the marker, it will display the title
							var marker = new google.maps.Marker( { 
								position: latlng,     
								map: map,      
								title: address
							});
				
						}
					}else if(jQuery('#map-canvas').attr('data-type')=="location_point")
					{
						var lat=jQuery('#map-canvas').attr('data-lat');
						var long=jQuery('#map-canvas').attr('data-long');
	
						var my_address=jQuery('#map-canvas').attr('data-address');
						var map='';	// Google map object
	
						// Initialize and display a google map
						function initialize() {
							var mapOptions = {
							  center: new google.maps.LatLng( lat , long ),
							  zoom: 6
							};
							var map = new google.maps.Map(document.getElementById("map-canvas"),
							mapOptions);
							var address = my_address;
							var marker = new google.maps.Marker( { 
								position: new google.maps.LatLng(lat , long), 
								map: map,      
								title: address
							});
						}
						initialize();
					}
				}	
			});
		});
    </script>