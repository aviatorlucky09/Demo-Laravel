
@php
$list_url =  $carr['listing_url'];
@endphp

<div class="container">
    <h1 class="page-header">{{ $carr['plural_name'] }} Position
        <small>
            <div class="pull-right">
             <a href="{{  $list_url }}"  data-toggle="ajax" class="btn btn-warning">Back</a>
         </div>
     </small>

 </h1>
 
 <!-- begin panel -->
 <div class="panel panel-inverse">
    <div class="panel-body">
        <div class="row d-flex justify-content-center">
      <ul id="boat_type_sortable">
        @foreach($boatTypes as $boatTypeId=>$boatType)
          <li class="ui-state-default" data-id="{{ $boatTypeId }}">{{ $boatType }}</li>
        @endforeach
      </ul>
  </div>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->
</div>
<script type="text/javascript">

 $( function() {
    $( "#boat_type_sortable" ).sortable();
    $( "#boat_type_sortable" ).disableSelection();
  } );
 $( function() {
  var pos_arr=[];
      var url = "{{ route('admin.boat_type.position.update') }}";
      $("#boat_type_sortable").sortable({
        placeholder: "ui-state-highlight",
        stop: function(e, ui) {
        ($(this).find('li')).each(function(){

            pos_arr.push([$(this).attr('data-id'),($(this).index()+1)]);

          });
           
              $.post(url,{"_token": "{{ csrf_token() }}",pos_arr:pos_arr},function(json){
                if(json.result == 'success'){
                     $.toast({
                        heading: 'Success',
                        text:  json.message ,
                        showHideTransition: 'slide',
                        hideAfter: 5000,
                        icon: 'success',
                        position:'top-right',
                    });
                }
              },"json");
          }

      });
     
});


     

</script>
<style>
    #boat_type_sortable { list-style-type: none; margin: 0; padding: 0; width: 60%;cursor:move }
  #boat_type_sortable li { margin: 0 3px 3px 3px;  padding-left: 1.5em; font-size: 1.4em; height: 28px; }
  #boat_type_sortable li span { position: absolute; margin-left: -1.3em; }
</style>



