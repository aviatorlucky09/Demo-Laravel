<script type="text/javascript">
  var which = "";
  function setWhich(that){
     which =  that; 
  }
   

	function submitForm(that , e){
        for(var instanceName in CKEDITOR.instances){
            CKEDITOR.instances[instanceName].updateElement();
        }
       
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
                    if(json.hasOwnProperty('modal') && json.modal == 1  && json.hasOwnProperty('city_id')  ){
                        loadCities(json.city_id);
                    }
                    else if(json.hasOwnProperty('modal') && json.modal == 1 && json.hasOwnProperty('broker_id')  ){
                        loadBrokers(json.broker_id);
                    }
                    else if(json.hasOwnProperty('url')){
                    	if(json.url.length > 1){
                    		window.location.href = json.url;	
                    	}
                    } 
                    if(json.hasOwnProperty('data_callback') && json.data_callback.length > 5){
                         window[json.data_callback](); 
                    }
                     

                }else{
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
                    text: e.statusText,
                    icon: 'error',
                    position:'top-right',
                });
                submitBtn.removeAttr("disabled").val(submitVal);
            }
        });
 		return false; 
  }
  function deleteDTRecord(that){
            if(!confirm("Are you sure?")){
                return;
            }
            $.post($(that).attr("data-href"),{"_token":"{{ csrf_token() }}"},function(json){
                if(json.result == 'success'){
                     $.toast({
                        heading: 'Success',
                        text:  json.message ,
                        showHideTransition: 'slide',
                        hideAfter: 5000,
                        icon: 'success',
                        position:'top-right',
                    });
                    if(json.hasOwnProperty('data_callback') && json.data_callback.length > 5){
                         window[json.data_callback](); 
                    }else{
                      window.table.ajax.reload( null, false );   
                    }
                    
                }else{

                    $.toast({
                        heading: 'Error',
                        text: json.message,
                        hideAfter: 5000,
                        icon: 'error',
                        position:'top-right',
                    }); 
                }
                 
            },"json");
        }
 
$(".click").click();
function applyTelephoneMask(inputId){
    document.getElementById(inputId).addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
}


</script>