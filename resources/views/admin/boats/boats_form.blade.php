 @php

 $list_url = $carr['listing_url'];
 $update_url = route($carr['update_route_name'],['id' => $obj->id]);
 $active_tab = "boat";
 $boat = $obj; 


 @endphp



 <ol class="breadcrumb pull-right">
  <li class="breadcrumb-item"><a href="{{ $list_url }}" data-toggle="ajax"> {{ $carr['plural_name'] }}</a></li>
  @if($obj->id == 0)
  <li class="breadcrumb-item"> Create </li>
  @else
  <li class="breadcrumb-item"> Edit </li>
  @endif
</ol> 
<h1 class="page-header">
  @if($obj->id == 0) Create  @else  Edit  @endif {{ $carr['singular_name'] }}
</h1>
@if($obj->id)
  @include('admin.boats.tab')
@endif
<!-- begin panel -->
<div class="panel panel-inverse">
  <div class="panel-body">
    <form id='form_user' 
    action="{{ $update_url }}" 
    method="post" 
    onsubmit="return submitForm(this)" 
    enctype="multipart/form-data">
    <input name="{{ $carr['table_name'] }}_id" type="hidden" value="{{ $obj->id }}">
    @csrf
    <div class="row  justify-content-md-center">
      <div class="col-md-6 row">
       <div class="col-md-6">
        <label class="col-form-label">Boat Name</label>
        <input type="text" name="boat_name" class="form-control m-b-5" value="{{ $obj->name }}" />
      </div>
      <div class="col-md-6">
        <label class="col-form-label">Boat Listing Title</label>
        <input name="listing_title" type="text"  class="form-control m-b-5" value="{{ $obj->listing_title }}" />
      </div>
      <div class="col-md-12">
        <label class="col-form-label">Boat Description</label>
        <textarea class="form-control m-b-5" name="description">{{ $obj->description }}</textarea>
      </div>
      <div class="col-md-12">
        <label class="col-form-label">Select Marina Name</label>
         <select id="marina_id" class="form-control" name="marina_id">
          <option value="{{ $obj->marina_id }}" selected>{{ $obj->marina->name }}</option>
        </select>
      </div>
      
       <div class="col-md-6 py-2">
        <label class="col-form-label">Select State</label>
        <select name="state_id" id="state_id">
          <option value="">Select</option>
          @foreach($states as $state_id =>$state_name)
          <option value="{{  $state_id }}" @if($obj->state_id == $state_id) selected @endif>{{  $state_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6 py-2">
        <label class="col-form-label">Select City</label>
        <select name="city_id" id="city_id" class="form-control m-b-5">
          <option value="">Select</option>
          @foreach($cities as $city_id =>$city_name)
          <option value="{{ $city_id }}" @if($obj->city_id == $city_id) selected @endif>{{ $city_name }}</option>
          @endforeach
        </select>
      </div>
   

      @include('admin.boats.shared.location')
       <div class="col-md-12 map_canvas my-3" style="height:250px;"></div>
    
     @if($obj->id!=0)
    <div class="col-md-6">
        <label class="col-form-label">Select Status</label>
        <select id="status" class="form-control" name="status">
        @foreach(getBoatStatus() as $key=>$status)
          <option value="{{ $key }}" @if($obj->status == $status) selected @endif>{{ $status }}</option>
          @endforeach
        </select>
      </div>
      @endif
    </div>

  </div>

  <br>
  <br>
  <div class="row">
   <br>
   <div class="col-md-3">
   </div>
   <div class="col-md-3">
    <a href="{{ $list_url  }}" data-toggle="ajax" class="btn btn-warning start m-r-5 pull-right" > Back </a>
    <input type="submit" class="btn btn-success start m-r-5 pull-right" value="@if($obj->id == 0) Create   @else  Update   @endif ">
  </div>
</div>

</form>
</div>
</div>
<script>
  $("#status,#city_id,#state_id").select2();
 $(function() {
        $('#state_id').change(function() {

            var url = '{{ route("admin.ajax_cities_of_state", ":state_id") }}';
            url = url.replace(':state_id', $(this).val());

            $.get(url, function(data) {
                var select = $('#city_id');

                select.empty();
                //console.log(data);
                $.each(data,function(key, value) {
                    select.append('<option value=' + key + '>' + value + '</option>');
                });
            });
        });
    });
  $('#marina_id').select2({
    placeholder: 'Select Marina Name',
    ajax: {
      url: "{{ route('admin.ajax_marina') }}",
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (marina) {
            return {
              text: marina.name,
              id: marina.id,
              
            }

          })
        };
      },
      cache: true
    }
  });
   
</script>
<style>
  #marina_id,#state_id,#city_id{
    width: 100%!important;
  }

</style>



