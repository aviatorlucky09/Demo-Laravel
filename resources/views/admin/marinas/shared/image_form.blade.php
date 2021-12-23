
        <form id="marina_upload" enctype="multipart/form-data" method="post" 
            action="{{ route('admin.marina_image_store',['marina_id'=>$marina->id]) }}" class="dropzone">
            @csrf
          <div class="dz-message" data-dz-message><span>Drop image/Click here to upload</span></div>
          <div class="fallback">
            <input name="file" type="file" />
            <input type="submit" name="Upload">
          </div>
        </form>
      <br><br>
      <div id="image_grid">
      @include('admin.marinas.shared.image_grid')
    </div>
    

    
 <script>
     Dropzone.autoDiscover = false;
             $("#marina_upload").dropzone({
                addRemoveLinks: true,
                success: function(file, response){
                      $("#reload_button").show();
                      $(file.previewTemplate).find('.dz-remove').attr('id', response.fileID);
                      $(file.previewElement).addClass("dz-success");
                      loadImages();
                      
                    },
                });
     function deleteImage(that){
        if(!confirm("Are you sure?")){
            return false;
        }
        $.post($(that).attr("action"),$(that).serialize())
            .done(function(response) {
            
                loadImages();
              
             
        });
        return false;      
     }
     function rotateImage(that){
        
        $.post($(that).attr("action"),$(that).serialize())
            .done(function(response) {
             
            loadImages();
        });
        return false;      
     }

     function loadImages(){
        $.get("{{ route('admin.marina_image_grid',['marina_id'=>$marina->id]) }}",function(data){
            
              $("#image_grid").html(data);
            

        })

     }
     function updateImageStatus(that){
      if($(that).is(':checked')) {
        var status = 1;
      }else{
        var status = 0;
      }
      $.post($(that).attr('data-url'),{"_token": "{{ csrf_token() }}",status:status},function(jsonData){

      },"json");
       return true;  
    }
     
     
 </script>
