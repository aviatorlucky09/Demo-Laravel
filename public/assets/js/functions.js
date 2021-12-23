function alertDialog(type,message){

	var alert_label = '';
	
	if(type == 'success'){
		type = 'alert-success';
		alert_label = 'Success';
	}
	else if(type == 'error'){
		type = 'alert-danger';
		alert_label = 'Error';
	}
	else if(type == 'warning'){
		type = 'alert-warning';
		alert_label = 'Warning';
	}

	var alert_dialog = '<div class="alert ' + type + ' fade show m-b-0"><span class="close" data-dismiss="alert">×</span><strong>'+ alert_label +'!<br></strong> '+ message +'</div><br>';
	return alert_dialog;
}