/*Mostra/Nascondi DIV*/
function switchvis(objid){
	var elemento = document.getElementById(objid);
	if (elemento.style.display == 'none' || elemento.style.display == "") {
		elemento.style.display = 'block';
	}
	else {
		elemento.style.display = 'none';
	}
}

function switchvis_show(objid){
	var elemento = document.getElementById(objid);
		elemento.style.display = 'block';
}
function switchvis_hide(objid){
	var elemento = document.getElementById(objid);
	elemento.style.display = 'none';
}

/*Ajax Wishlist*/
function ajax_wishlist(url, params, callback, id, refresh){
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
			callback(unescape(xmlhttp.responseText.trim()), id, refresh);
		}
		else if (xmlhttp.readyState==4)
			throw new exception("XMLHTTPRequest loaded with status: " + xmlhttp.status);
	}
	xmlhttp.send(paramstring);
}

/*Update GUI*/
function manage_wish_label(result, id, refresh){
	//console.log('manage_wish_label', result, id);
	switch(result){
		case "ADD":
			//Aggiunta sul Menu in Alto della classe per mostrare che nella wishlist c'ï¿½ almeno un elemento
			jQuery("#wishlist-menu").addClass("wishlist_not_empty");
			jQuery("#wishlistcountp").show();

			jQuery("#wishlist-menu-mobile").addClass("wishlist_not_empty");
			jQuery("#wishlistcountp-mobile").show();

			if(jQuery("#wishlistmenucount").length && parseInt(jQuery("#wishlistmenucount").html())!==undefined){
				jQuery("#wishlistmenucount").html(parseInt(jQuery("#wishlistmenucount").html())+1);
			}


			if(jQuery("#wishlistmenucount-mobile").length && parseInt(jQuery("#wishlistmenucount-mobile").html())!==undefined){
				jQuery("#wishlistmenucount-mobile").html(parseInt(jQuery("#wishlistmenucount-mobile").html())+1);
			}


			if(jQuery("#wishlistmenucountvp").length && parseInt(jQuery("#wishlistmenucountvp").html())!==undefined){
				jQuery("#wishlistmenucountvp").html(parseInt(jQuery("#wishlistmenucountvp").html())+1);
			}

			if(jQuery(".wishlistcount").length && parseInt(jQuery(".wishlistcount").html())!==undefined){
				jQuery(".wishlistcount").html(parseInt(jQuery(".wishlistcount").html())+1);
			}



			//console.log(".wishlist_add"+id);
			jQuery(".wishlist_add"+id).hide();
			jQuery(".wishlist_rem"+id).show();
			jQuery("#wishlist_add"+id).hide();
			jQuery("#wishlist_rem"+id).show();
			
			jQuery(".mobile-product-head .wishlist_add"+id).hide();
			jQuery(".mobile-product-head .wishlist_rem"+id).show();
			
			jQuery(".mobile .wishlist_add"+id).hide();
			jQuery(".mobile .wishlist_rem"+id).show();
			
			jQuery(".desktop .wishlist_add"+id).hide();
			jQuery(".desktop .wishlist_rem"+id).show();
			
			jQuery(".wishlist_add-barra"+id).hide();
			jQuery(".wishlist_rem-barra"+id).show();
			
			/*
			if (false && jQuery(".barra-scomparsa").length){
				jQuery(".barra-scomparsa .stella img").attr('src','/images/pref_on.png');
				var action=jQuery(".barra-scomparsa .stella").attr('onclick');
				
				var newaction=action.replace('add_to_wishlist', 'remove_from_wishlist');
				
				jQuery(".barra-scomparsa .stella").attr('onclick',newaction);
			}
			*/
			break;
		case "REM":


		if(jQuery("#wishlistmenucount").length && parseInt(jQuery("#wishlistmenucount").html()) && parseInt(jQuery("#wishlistmenucount").html())!=0){

			jQuery("#wishlistmenucount").html(parseInt(jQuery("#wishlistmenucount").html())-1);
			if(jQuery("#wishlistmenucount").html()=='0')
			{
				jQuery("#wishlistcountp").hide();

			}
		}

		if(jQuery("#wishlistmenucount-mobile").length && parseInt(jQuery("#wishlistmenucount-mobile").html()) && parseInt(jQuery("#wishlistmenucount-mobile").html())!=0){

			jQuery("#wishlistmenucount-mobile").html(parseInt(jQuery("#wishlistmenucount-mobile").html())-1);
			if(jQuery("#wishlistmenucount-mobile").html()=='0')
			{
				jQuery("#wishlistcountp").hide();

			}
		}

		if(jQuery("#wishlistmenucountvp").length && parseInt(jQuery("#wishlistmenucountvp").html()) && parseInt(jQuery("#wishlistmenucountvp").html())!=0){

				jQuery("#wishlistmenucountvp").html(parseInt(jQuery("#wishlistmenucountvp").html())-1);
				if(jQuery("#wishlistmenucountvp").html()=='0')
				{
					jQuery("#wishlistcountpvp").hide();
				}
			}


		if(jQuery(".wishlistcount").length && parseInt(jQuery(".wishlistcount").html()) && parseInt(jQuery(".wishlistcount").html())!=0){

			jQuery(".wishlistcount").html(parseInt(jQuery(".wishlistcount").html())-1);
		}


			jQuery(".wishlist_rem"+id).hide();
			jQuery(".wishlist_add"+id).show();
			jQuery("#wishlist_rem"+id).hide();
			jQuery("#wishlist_add"+id).show();
			
			jQuery(".wishlist_add-barra"+id).show();
			jQuery(".wishlist_rem-barra"+id).hide();
			
			jQuery(".mobile .wishlist_add"+id).show();
			jQuery(".mobile .wishlist_rem"+id).hide();
			
			jQuery(".desktop .wishlist_add"+id).show();
			jQuery(".desktop .wishlist_rem"+id).hide();
			
			
			jQuery(".mobile-product-head .wishlist_add"+id).show();
			jQuery(".mobile-product-head .wishlist_rem"+id).hide();
			
			
			if ( jQuery( "#wishlist-element-"+id ).length ) {
				jQuery( "#wishlist-element-"+id ).remove();
			}	
			/*
			if (false && jQuery(".barra-scomparsa").length){
			
				jQuery(".barra-scomparsa .stella img").attr('src','/images/pref.png');
				var action=jQuery(".barra-scomparsa .stella").attr('onclick');
				var newaction=action.replace('remove_from_wishlist', 'add_to_wishlist');
				jQuery(".barra-scomparsa .stella").attr('onclick',newaction);
			}
			*/
			break;
		default:
			break;
	}
	
	if(refresh){
	location.reload();
	}
	/*var serviceURL = encodeURI("index.php?action=PNT_WISH&id=-1");
	ajax_wishlist(serviceURL,"",print_wishlist, -1);*/
}

function manage_wish_label2(result, id, refresh){
	//console.log('manage_wish_label', result, id);
	switch(result){
		case "ADD":
			//Aggiunta sul Menu in Alto della classe per mostrare che nella wishlist c'ï¿½ almeno un elemento
			jQuery("#wishlist-menu").addClass("wishlist_not_empty");
			//console.log(".wishlist_add"+id);
			jQuery(".wishlist_add"+id).hide();
			jQuery(".wishlist_rem"+id).show();
			jQuery("#wishlist_add"+id).hide();
			jQuery("#wishlist_rem"+id).show();
			
			jQuery(".mobile-product-head .wishlist_add"+id).hide();
			jQuery(".mobile-product-head .wishlist_rem"+id).show();
			
			
			jQuery(".mobile .wishlist_add"+id).hide();
			jQuery(".mobile .wishlist_rem"+id).show();
			
			jQuery(".desktop .wishlist_add"+id).hide();
			jQuery(".desktop .wishlist_rem"+id).show();
			
			
			jQuery(".wishlist_add-barra"+id).hide();
			jQuery(".wishlist_rem-barra"+id).show();
			
			
			
			/*
			if (false && jQuery(".barra-scomparsa").length){
				jQuery(".barra-scomparsa .stella img").attr('src','/images/pref_on.png');
				var action=jQuery(".barra-scomparsa .stella").attr('onclick');
				
				var newaction=action.replace('add_to_wishlist', 'remove_from_wishlist');
				
				jQuery(".barra-scomparsa .stella").attr('onclick',newaction);
			}
			*/
			break;
		case "REM":

			if(jQuery("#wishlistmenucount").length && parseInt(jQuery("#wishlistmenucount").html()) && parseInt(jQuery("#wishlistmenucount").html())!=0){

				jQuery("#wishlistmenucount").html(parseInt(jQuery("#wishlistmenucount").html())-1);
				if(jQuery("#wishlistmenucount").html()=='0')
				{
					jQuery("#wishlistcountp").hide();
				}
			}

			if(jQuery("#wishlistmenucountvp").length && parseInt(jQuery("#wishlistmenucountvp").html()) && parseInt(jQuery("#wishlistmenucountvp").html())!=0){

				jQuery("#wishlistmenucountvp").html(parseInt(jQuery("#wishlistmenucountvp").html())-1);
				if(jQuery("#wishlistmenucountvp").html()=='0')
				{
					jQuery("#wishlistcountpvp").hide();
				}
			}

			if(jQuery(".wishlistcount").length && parseInt(jQuery(".wishlistcount").html()) && parseInt(jQuery(".wishlistcount").html())!=0){
				jQuery(".wishlistcount").html(parseInt(jQuery(".wishlistcount").html())-1);
			}


			jQuery(".wishlist_rem"+id).hide();
			jQuery(".wishlist_add"+id).show();
			
			jQuery("#wishlist_rem"+id).hide();
			jQuery("#wishlist_add"+id).show();
			
			jQuery(".wishlist_add-barra"+id).show();
			jQuery(".wishlist_rem-barra"+id).hide();
			
			jQuery(".mobile .wishlist_add"+id).show();
			jQuery(".mobile .wishlist_rem"+id).hide();
			
			jQuery(".desktop .wishlist_add"+id).show();
			jQuery(".desktop .wishlist_rem"+id).hide();
			
			
			jQuery(".mobile-product-head .wishlist_add"+id).show();
			jQuery(".mobile-product-head .wishlist_rem"+id).hide();
			
			/*
			if (false && jQuery(".barra-scomparsa").length){
			
				jQuery(".barra-scomparsa .stella img").attr('src','/images/pref.png');
				var action=jQuery(".barra-scomparsa .stella").attr('onclick');
				var newaction=action.replace('remove_from_wishlist', 'add_to_wishlist');
				jQuery(".barra-scomparsa .stella").attr('onclick',newaction);
			}
			*/
			break;
		default:
			break;
	}
	
	if(refresh){
	location.reload();
	}
	/*var serviceURL = encodeURI("index.php?action=PNT_WISH&id=-1");
	ajax_wishlist(serviceURL,"",print_wishlist, -1);*/
}

function print_wishlist(wishlist){
	//alert(wishlist);
	jQuery("#wishlist").html("");
	jQuery("#wishlist").append(wishlist);
	
}


/*Add/Rem Wishlist*/
function add_to_wishlist(id, refresh){
	facebookTrack('wishlist', id);
	var serviceURL = encodeURI("prestigious_real_estate_in_italy.html?action=ADD_WISH&id="+id);
	//console.log(serviceURL);
	ajax_wishlist(serviceURL,"",manage_wish_label, id, refresh);
}

function remove_from_wishlist(id){
	var serviceURL = encodeURI("prestigious_real_estate_in_italy.html?action=REM_WISH&id="+id);
	//console.log(serviceURL);
	ajax_wishlist(serviceURL,"",manage_wish_label, id);
}

function remove_from_wishlist_lastseen(id){
	var serviceURL = encodeURI("prestigious_real_estate_in_italy.html?action=REM_WISH&id="+id);
	//console.log(serviceURL);
	ajax_wishlist(serviceURL,"",manage_wish_label2, id);
}