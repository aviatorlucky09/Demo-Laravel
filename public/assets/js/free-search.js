function free_search(input_id, form_id){
	var search_key = jQuery("#"+input_id).val().trim();
	
	if (search_key==""){
		
		jQuery("#"+input_id).focus();
	}
	else{
		facebookTrack('search', search_key);
		var serviceURL = encodeURI("?action=FREE_SEARCH&search_key="+search_key);
		ajax_free_search(serviceURL,"",process_free_search_result, input_id, form_id);
	}
}

function process_free_search_result(result, input_id, form_id){
	if (result=="OK"){
		jQuery("#"+form_id).submit();
	}
	if (result=="KO"){
		jQuery("#"+input_id).css("border", "1px solid red");
	}
	/*Update Agosto 2015: Token di Ricerca: costruzione degli URL di ricerca*/
	if (result!="" && result!="OK" && result!="KO"){
		//alert(result);
		var url = jQuery("#search_multi_level_url").val();
		//var f_typology = jQuery("#f_tipologia").val();
		var f_typology = jQuery("#default-typology-token").val();
		url = url + f_typology + "/" + result;
		window.location.href = url;
	}
}

/*Ajax Wishlist*/
function ajax_free_search(url, params, callback, input_id, form_id){
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
			callback(unescape(xmlhttp.responseText.trim()), input_id, form_id);
		}
		else if (xmlhttp.readyState==4)
			throw new exception("XMLHTTPRequest loaded with status: " + xmlhttp.status);
	}
	xmlhttp.send(paramstring);
}