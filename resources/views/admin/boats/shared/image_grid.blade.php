
<div class="row">
  <ul id="image_sortable" style="width: 100%">
    @foreach($images as $image)
    <li data_id="{{ $image->id }}" class="col-md-4 col-xl-3">
      <form class="pull-right" method="post" 
      action="{{ route('admin.boat_image_delete',['boat_id'=>$boat->id,'image_id'=>$image->id]) }}" 
      onsubmit="return deleteImage(this)">
      @csrf
      <button class="btn btn-danger mt-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </form>
     <div class="switcher pull-left pt-2">
      <input type="checkbox" name="status" id="status_{{ $image->id }}" onclick="return updateImageStatus(this)"
       data-url = "{{ route('admin.boat_image_status_store',['boat_id'=>$boat->id,'image_id'=>$image->id])}}" @if($image->status == 1) checked @endif  value="1" >
      <label for="status_{{ $image->id }}"></label>
    </div>
    <br /><br />
    @php
    $path = "storage/uploads/boat/".$boat->id."/".$image->image;
    @endphp
    <img src="{{ url($path) }}" class="img-responsive img-fluid p-5" style="width: 100%;">

    <br /><br/>

  </li>
  @endforeach

</ul>       
</div>

<script>
  $( function() {
    var pos_arr = [];
    var url = "{{ route('admin.boat_image_position_update',['boat_id'=>$boat->id]) }}";
    $( "#image_sortable" ).sortable({
      placeholder: "ui-state-highlight",
      stop: function(e, ui) {

          ($(this).find('li')).each(function(){

              pos_arr[$(this).attr('data_id')] = ($(this).index()+1);

            });
            //console.log(pos_arr);
               /* console.log($.map($(this).find('li'), function(el) {
                  
                  return $(el).attr('data_id') + ' = ' + ($(el).index()+1);
                   
                }));*/

               $.post(url,{pos_arr:pos_arr,_token:'{{ csrf_token() }}'},function(jsonData){

               },"json");
            }
        
    });

    $( "#image_sortable" ).disableSelection();
  } );
</script> 
<style type="text/css">
  .ui-state-highlight{
   /* padding: 10px;*//* width:24%;*/border:1px solid;list-style: none;float: left;cursor: move;max-height: 500px;height: 100%;
 }
 #image_sortable li{
   /* padding: 5px;*/
   border:1px solid #ccc;
   /*border-right: 0;*/
   list-style: none;
   float: left;
   max-height: 200px;
   /* cursor: move; */

 }
</style>