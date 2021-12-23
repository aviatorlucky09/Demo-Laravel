 // This is the first thing we add ------------------------------------------
jQuery(document).ready(function(jQuery) {
	jQuery('.ratings_stars').hover(
		// Handles the mouseover
		function() {
			var widget_id = (jQuery(this).parent().attr('id'));
			if (!(jQuery( "#"+widget_id ).hasClass( "rating_done" ))){
				/*jQuery(this).prevAll().andSelf().addClass('ratings_over');
				jQuery(this).nextAll().removeClass('ratings_vote'); */
				fill_star(widget_id, jQuery(this).attr('id'));
			}	
			//Permette di Rivotare
			else{
				jQuery("#"+widget_id).removeClass('rating_done');
				fill_star(widget_id, jQuery(this).attr('id'));
			}
			
		},
		// Handles the mouseout
		function() {
			var widget_id = (jQuery(this).parent().attr('id'));
			if (!(jQuery( "#"+widget_id ).hasClass( "rating_done" ))){
				//jQuery(this).prevAll().andSelf().removeClass('ratings_over');
				fill_star(widget_id, jQuery(this).attr('id'));
			}
		}
	);
	// This actually records the vote
	jQuery('.ratings_stars').bind('click', function() {
		var star = this;
		var widget = jQuery(this).parent();
		var clicked_on = jQuery(star).attr('class');
		var widget_id = jQuery(star).parent().attr('id');
		var id = widget_id.replace("rating", "");
		var vote = jQuery(star).attr('id');
		if (!(jQuery( "#"+widget_id ).hasClass( "rating_done" ))){
			jQuery("#rating"+id).addClass('rating_done');
			//alert("ITEM:"+id+" - VOTE:"+vote);
			make_vote(id, vote);
		}
	});
});

/*Refresh Stars*/
function refresh_widget(widget_id){
	jQuery("#"+widget_id+" .ratings_stars").removeClass('ratings_over');	
}


function fill_star(widget_id, max){
	refresh_widget(widget_id);
	for (i=1; i<=max; i++){
		jQuery("#"+widget_id+" .star_"+i).addClass('ratings_over');	
	}
}


/*Add/Rem Wishlist*/
function make_vote(id, vote){
	var serviceURL = encodeURI("?action=VOTE_RATE&id="+id+"&vote="+vote);
	//console.log(serviceURL);
	//ajax_rating(serviceURL,"",alert);
	ajax_rating(serviceURL,"", "");
}

/*Ajax Rating*/
function ajax_rating(url, params, callback){
	var xmlhttp;
	var paramstring = "";
	for (postvar in params){
		if (paramstring.length > 0) paramstring += "&";
		paramstring += postvar + "=" + escape(params[postvar]);
	}
	if (window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else if (window.ActiveXObject)
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	else
		throw new exception("XMLHTTPRequest failed to initialize.");
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//xmlhttp.setRequestHeader("Content-length", paramstring.length);
	//xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange = function (){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){//ok
			//callback(unescape(xmlhttp.responseText));
			//console.log(xmlhttp.responseText);
			//callback(unescape(xmlhttp.responseText));
		}
		else if (xmlhttp.readyState==4)
			throw new exception("XMLHTTPRequest loaded with status: " + xmlhttp.status);
	}
	xmlhttp.send(paramstring);
}