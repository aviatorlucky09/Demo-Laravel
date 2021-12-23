window.which = "";
window.setWhich = function(that){
    window.which  =  that; 
}
window.submitForm = function (that, e) {
    $(".invalid-feedback").html('');
    $(that).find("input.is-invalid").removeClass('is-invalid');
        if( typeof window.which == "string"){
          var submitBtn  = $("input[type=submit]",that);  
        }else{
          var submitBtn  = $(window.which);
        }
        window.which = "";
        
        var submitVal = submitBtn.val();
        var newsubmitVal = "Loading...";
        if($.trim(submitVal) == "Update"){
            var newsubmitVal = "Updating...";
        }
         if($.trim(submitVal) == "Create"){
            var newsubmitVal = "Creating...";
        }
        submitBtn.attr("disabled", true).val(newsubmitVal);
        /*if( typeof(CKEDITOR) !== "undefined" ){
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }*/
        var data = new FormData(that);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: $(that).attr("action"),
            data: data,
            dataType: "json",
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (json) {
                 submitBtn.removeAttr("disabled").val(submitVal);
                if(json.result == 'success'){
                     $.toast({
                        heading: 'Success',
                        text:  json.message ,
                        showHideTransition: 'slide',
                        hideAfter: 5000,
                        icon: 'success',
                        position:'top-right',
                    });
                    if(json.hasOwnProperty('url')){
                    	if(json.url.length > 1){
                    		window.location.href = json.url;	
                    	}
                    } 
                    if(json.hasOwnProperty('callback') && json.callback.length > 5){
                         window[json.callback](); 
                    }
                     

                } else {
                    if(json.hasOwnProperty('error_list')){
                        $.each(json.error_list, function (key, msg) {
                            $("input."+key).addClass('is-invalid');
                            $("."+key+"_group .invalid-feedback").html(msg[0]).show();
                        });
                    }
                    $.toast({
                        heading: 'Error',
                        text: json.message,
                        hideAfter: 5000,
                        icon: 'error',
                        position:'top-right',
                    }); 
                }
               
                
            },
            error: function (e) {
                 $.toast({
                    heading: 'Error',
                    text: "Server Error",
                    icon: 'error',
                    position:'top-right',
                })
            }
        });
 		return false; 
}
window.reloadPage = function () {
    location.reload();
}
