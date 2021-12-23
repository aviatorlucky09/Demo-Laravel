	jQuery(function() {
	//console.log('setupsearch');
		setupsearch();
		});

function toggleSearchMask(){
	jQuery( "body.search #search-mask.mobile-search-mask" ).toggle();
	jQuery( "body.video-gallery-page #search-mask.mobile-search-mask" ).toggle();
		jQuery( ".search-mask-toggle .search-mask-toggle-off" ).toggle();
		jQuery( ".search-mask-toggle .search-mask-toggle-on" ).toggle();
}
function setupsearch() {
	//console.log('location');




	jQuery( ".search-mask-toggle" ).click(function() {
		toggleSearchMask();
	  });

	  

	jQuery( ".search-mask .nonvip" ).hide();
	



		jQuery(document).click(function(event) { 
			if(!(jQuery(event.target).closest('.search-mask .dropdown-menu').length && event.target.tagName!='A')) {
				if(jQuery('.search-mask .dropdown-menu').is(":visible")) {
					jQuery('.search-mask .dropdown-menu').hide();
				}
			}        
		});



	jQuery( ".search-mask .seemorelocations" ).on( "click", function(e) {
	jQuery( ".search-mask .seemorelocations" ).toggleClass('less');
	jQuery( ".search-mask .seemorelocations" ).toggleClass('more');
	jQuery( ".search-mask .nonvip" ).toggle();
	e.stopPropagation();
	  });
	
	
	jQuery( ".search-mask #regions-dropdown-button" ).on( "click", function(e) {
	jQuery( ".search-mask #regions-dropdown" ).toggle();
	jQuery( ".search-mask #locations-dropdown" ).hide();
	jQuery( ".search-mask #price-dropdown" ).hide();
	jQuery( ".search-mask #lifestyle-dropdown" ).hide();
	jQuery( ".search-mask #type-dropdown" ).hide();
	  });
	  
	  	jQuery( ".search-mask #locations-dropdown-button" ).on( "click", function(e) {
	  	jQuery( ".search-mask #locations-dropdown" ).toggle();
	  	jQuery( ".search-mask #regions-dropdown" ).hide();
	  	jQuery( ".search-mask #price-dropdown" ).hide();
	  	jQuery( ".search-mask #lifestyle-dropdown" ).hide();
	  	jQuery( ".search-mask #type-dropdown" ).hide();
	  
	  	  });
	  	  
	  	  jQuery( ".search-mask #type-dropdown-button" ).on( "click", function(e) {
	  	  	jQuery( ".search-mask #type-dropdown" ).toggle();
	  	  	jQuery( ".search-mask #regions-dropdown" ).hide();
	  	  	jQuery( ".search-mask #locations-dropdown" ).hide();
	  	  	jQuery( ".search-mask #price-dropdown" ).hide();
	  	  	jQuery( ".search-mask #lifestyle-dropdown" ).hide();
	  	  
	  	  	  });
	  	  	  
	  	  	  jQuery( ".search-mask #lifestyle-dropdown-button" ).on( "click", function(e) {
	  	  	  	jQuery( ".search-mask #lifestyle-dropdown" ).toggle();
	  	  	  	jQuery( ".search-mask #regions-dropdown" ).hide();
	  	  	  	jQuery( ".search-mask #locations-dropdown" ).hide();
	  	  	  	jQuery( ".search-mask #price-dropdown" ).hide();
	  	  	  		jQuery( ".search-mask #type-dropdown" ).hide();
	  	  	  
	  	  	  	  });
	  	  	  	  
	  	  	  	  
	  	  	  	  jQuery( ".search-mask #price-dropdown-button" ).on( "click", function(e) {
	  	  	  	  	jQuery( ".search-mask #price-dropdown" ).toggle();
	  	  	  	  	jQuery( ".search-mask #regions-dropdown" ).hide();
	  	  	  	  	jQuery( ".search-mask #locations-dropdown" ).hide()
	  	  	  	  	 	jQuery( ".search-mask #type-dropdown" ).hide();
	  	  	  	  	 	 	jQuery( ".search-mask #lifestyle-dropdown" ).hide()
	  	  	  	  
	  	  	  	  	  });
	  	  	  	  	  
	  	  
	  	 /* jQuery( ".standard-dropdown" ).on( "click", function(e) {
	  	  	jQuery( ".dropdown-menu.fullwidth" ).hide();
	  	  
	  	  	  });
	  	  	  
	  	  	  
	  	  	  jQuery( ".dropdown-menu a" ).on( "click", function(e) {
	  	  	    	jQuery( ".dropdown-menu.fullwidth" ).hide();
	  	  	    
	  	  	    	  });*/
	  	  	  
	  	  	  
	  	  	
	}
	
	function preselectZona(zona) {
		//console.log('preselectZona',zona);
	jQuery(function() {
	selectZona(zona);
	selectZonaMobile(zona);
		});
		}
	
	
	function selectZona(zona) {
		if(!zona){
			jQuery( "#locations-dropdown li" ).removeClass('hide');
		}
		else{

	//console.log('selectzona', zona);
	jQuery( "#locations-dropdown li.child"+zona ).removeClass('hide');
		jQuery( "#locations-dropdown li.child:not(.child"+zona+")" ).addClass('hide');
		
		jQuery( "#regions-dropdown-button #zona_label" ).html(jQuery('#parent'+zona+' a').html());
		 
		/*if(zona==undefined || jQuery( "li.nonvip.child"+zona ).length){
		jQuery( ".seemorelocations" ).show();
		jQuery( ".seemorelocations" ).addClass('more');
		jQuery( ".seemorelocations" ).removeClass('less');
		jQuery( ".nonvip" ).hide();
		}
		else{*/
		jQuery( ".seemorelocations" ).hide();
		jQuery( ".nonvip" ).show();
		//}
		}
	}
	
function choose_element(id, value, label_id, label_value, hide_id, element, parent){
console.log('choose_element',id, value, label_id, label_value, hide_id, element, parent);
	jQuery("#"+label_id).html(label_value);
	jQuery("#"+id).val(value);
	jQuery("#"+hide_id).hide();
	
	jQuery(".dropdown-menu.fullwidth li").removeClass('selected');	
	jQuery(".dropdown-menu.fullwidth li#"+element).addClass('selected');
	

	//console.log('choose',id, value, label_id, label_value, hide_id, parent);

	if(value=='italy'){
		jQuery( ".seemorelocations" ).show();
		jQuery( ".seemorelocations" ).addClass('more');
		jQuery( ".seemorelocations" ).removeClass('less');
		jQuery( ".nonvip" ).hide();
	}
	if(id!='f_zona_sec'){
	selectZona(parent)	;	
	if (label_id=='zona_label' && parent && jQuery("#f_zona_sec_parent").val()!=parent){
	//SE COME ZONA SECONDARIA E' SELEZIONATA UNA ZONA NON NELLA REGIONE CLICCATA, SELECT ALL
	jQuery("#zona_label_sec").html('ALL');
	jQuery("#f_zona_sec").val('');
	jQuery("#f_zona_sec_parent").val('');
	}
	}else{
	//jQuery( "#locations-dropdown li.child" ).removeClass('hide');
		}
		
		if(id=='f_zona_sec' && parent){
		jQuery("#f_zona_sec_parent").val(parent);
		}
		
		
}

function selectZonaMobile(zona) {
	if(!zona){
		jQuery( "#locations-select option"  ).each(function() {
			if( (jQuery(this).parent().is('span')) ) jQuery(this).unwrap();
		  });
		  jQuery( "#locations-select option.child" ).removeClass('hide');
	}
	else{
	//console.log('selectzona', zona);
	jQuery( "#locations-select option.child"+zona ).removeClass('hide');
	jQuery( "#locations-select option.child:not(.child"+zona+")" ).addClass('hide');
		
	jQuery( "#locations-select option.child:not(.child"+zona+")" ).each(function() {
		if( !(jQuery(this).parent().is('span')) ) jQuery(this).wrap('<span>');
	  });

	  jQuery( "#locations-select option.child"+zona  ).each(function() {
		if( (jQuery(this).parent().is('span')) ) jQuery(this).unwrap();
	  });
	
	  


	jQuery( "#regionsselect" ).val(jQuery('#parent'+zona+' a').html());

	jQuery('#regionsselect option').filter(function() { 
		return (jQuery(this).hasClass('parent'+zona)); 
	}).prop('selected', true);


	
	}
	}

function choose_element_mobile(value){
	console.log('choose_element_mobile', value);
	// id, value, label_id, label_value, hide_id, element, parent
	var select = value.split(',');

	var id = select[0] || false;
	var value = select[1] || false;
	var label_id = select[2] || false;
	var label_value = select[3] || false;
	var hide_id = select[4] || false;
	var element = select[5] || false;
	var parent = parseInt(select[6]) || false;

	jQuery("#"+label_id).html(label_value);
	jQuery("#"+id).val(value);


	if(id!='f_zona_sec'){
	selectZonaMobile(parent);
	if (label_id=='zona_label' && parent && jQuery("#f_zona_sec_parent").val()!=parent){
	//SE COME ZONA SECONDARIA E' SELEZIONATA UNA ZONA NON NELLA REGIONE CLICCATA, SELECT ALL
	jQuery("#locations-select").val(jQuery("#locations-select option:first").val());
	jQuery("#f_zona_sec").val('');
	jQuery("#f_zona_sec_parent").val('');
	}
	}else{
	//jQuery( "#locations-dropdown li.child" ).removeClass('hide');
		}
		
		if(id=='f_zona_sec' && parent){
		jQuery("#f_zona_sec_parent").val(parent);
		}
		
		
}

/*Update 07/04/2014: Costruzione del percorso*/
function make_search(){
	//console.log('search');
	var url = jQuery("#search_multi_level_url").val();
	var f_typology = jQuery("#f_tipologia").val();
	var f_zone = jQuery("#f_zona").val();
	var f_zone_sec = jQuery("#f_zona_sec").val();
	var f_price = jQuery("#f_prezzo").val();
	 
	var f_lifestyle = jQuery("#f_lifestyle").val();
	  
	 
	
	url = url+"?zone="+  f_zone + "&location=" + f_zone_sec;
	url = url+"&lifestyle="+ f_lifestyle;
	url = url+"&type="+ f_typology;
	url = url+"&price="+ f_price;
	 
	 
	 
	//console.log(url);
	 window.location.href = url;
}