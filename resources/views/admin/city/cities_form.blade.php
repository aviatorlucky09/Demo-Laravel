 @php

 $list_url = $carr['listing_url'];
 $update_url = route($carr['update_route_name'],['id' => $obj->id]) 

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
    <div class="row justify-content-md-center">
      <div class="col-md-6 row">
        <div class="col-md-6">
          <label class="col-form-label">Country Name</label>

          <select name="country_id" id="country_id" class="form-control" onchange="return LoadStates(this,'state_id')">
            <option value="">Select Country</option>
            @foreach(getCountries() as $country)
            <option  @if($country->id == $obj->country_id) selected @endif  value="{{ $country->id}}">{{ $country->name }}</option>
            @endforeach
          </select>


        </div>

        <div class="col-md-6">
          <label class="col-form-label">State Name</label>

          <select name="state_id" id="state_id" class="form-control">
            <option value="">Select State</option>
            @foreach(getStates($obj->country_id) as $state)
            <option  @if($state->id == $obj->state_id) selected @endif  value="{{ $state->id}}">{{ $state->name }}</option>
            @endforeach
          </select>


        </div>

        <div class="col-md-6">
          <label class="col-form-label"> 
          {{ $carr['singular_name'] }}  Name</label>
          <input name="name" type="text"  class="form-control m-b-5" value="{{ $obj->name }}" />
        </div>

        <div class="col-md-6">
          <label class="col-form-label"> 
          {{ $carr['singular_name'] }}  Sort Order</label>
          <input name="sort_order" type="number"  class="form-control m-b-5" min = "0" value="{{ $obj->sort_order }}" />
        </div>
        <div class="col-md-6">
          <label class="col-form-label">Active</label>
          <br>
          <div class="switcher">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" @if($obj->is_active) checked @endif  value="1">
            <label for="is_active"></label>
          </div>

        </div>
      </div>

    </div>


    <br>
    <br>
    <div class="row justify-content-md-center">
     <br>

     <div class="col-md-3">

      <input type="submit" class="btn btn-success start m-r-5  " value="@if($obj->id == 0) Create   @else  Update   @endif ">
      <a href="{{ $list_url  }}" data-toggle="ajax" class="btn btn-warning start m-r-5  " > Back </a>
    </div>

  </div>

</form>
</div>
</div>
<script type="text/javascript">
  $("#state_id,#country_id").select2();
  function LoadStates(that,state_id){
    var country_id = $(that).val();

    $.post("{{ route('admin.ajax_state_list') }}",{country_id:country_id,"_token":"{{ csrf_token() }}"},function(json_data){
     if(json_data.result == 'success'){
      $("#"+state_id).html("");
      $.each(json_data.states, function (index, data) {

       $("#"+state_id).append(`<option value="${data.id}"> 
         ${data.name} 
         </option>`); 
     });
      $("#"+state_id).select2();
    }
  },"json");

  }
  function LoadCities(that,city_id){
    var state_id = $(that).val();

    $.post("{{ route('admin.ajax_city_list') }}",{state_id:state_id,"_token":"{{ csrf_token() }}"},function(json_data){
     if(json_data.result == 'success'){
      $("#"+city_id).html("");
      $.each(json_data.cities, function (index, data) {

       $("#"+city_id).append(`<option value="${data.id}"> 
         ${data.city_name} 
         </option>`); 
     });
      $("#"+city_id).select2();
    }
  },"json");

  }   

</script>





