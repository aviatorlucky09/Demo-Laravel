<div class="panel panel-inverse">
    <div class="panel-body">
        <form id="new_upload" enctype="multipart/form-data" method="post" 
            action="{{ route('admin.boat_image_store',['boat_id'=>$boat->id]) }}" class="dropzone">
            @csrf
          <div class="dz-message" data-dz-message><span>Drop image/Click here to upload</span></div>
          <div class="fallback">
            <input name="file" type="file" />
            <input type="submit" name="Upload">
          </div>
        </form>
     
    </div>
</div>
<div class="panel panel-inverse" style="padding-bottom:1000px;">
    <div class="panel-body text-center" id="image_grid">
        @include('admin.boats.shared.image_grid')
    </div>

</div> 
 
 <script>
     Dropzone.autoDiscover = false;
             $("#new_upload").dropzone({
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
        $.get("{{ route('admin.boat_image_grid',['boat_id'=>$boat->id]) }}",function(data){
            
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
