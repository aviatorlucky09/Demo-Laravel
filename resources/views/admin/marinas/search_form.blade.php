
<div class="panel panel-inverse">
  <div class="panel-body">
    <form method="get" id="state_search_form" action="{{ ajaxUrl(route('admin.marinas')) }}" 
    onsubmit="return searchMarina(this)">
      <div class="row">
       
    <div class="col-2">
     <label class="col-form-label">Select State</label>
     <select name="state" id="state_id">
      <option value="">Select</option>
      @foreach($states as $state)
      <option value="{{ $state->id }}" @if($state->id == ($selectedState?$selectedState->id:"")) selected @endif >{{ $state->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-2">
     <label class="col-form-label">Select City</label>
    <select name="city" id="city_id">
      <option value="">Select</option>
      @if($selectedState)
      @foreach($selectedState->cities as $city)
      <option @if($city->id == ($selectedCity?$selectedCity->id:"")) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
      @endforeach
      @endif
    </select>
  </div>

    <div class="col-2">
     <label class="col-form-label">Select Status</label>
    <select name="status" id="status">
      <option value="">Select</option>
      @foreach(getMarinaStatus() as $key=>$marina_status)
      <option value="{{ $key }}" @if($status == $key) selected @endif>{{ $marina_status }}</option>
      @endforeach
    </select>
  </div>
  


<div class="col-4">
 <br>
 <input style="margin-top: 15px;" type="submit" class="btn btn-primary start m-r-5" name="submit" value="Search"> 

</div>                        
</div>
</form>
</div>
</div>
<style>
  #status,#state_id,#city_id{
    width: 100%!important;
  }
</style>
<script>
  $(function(){
    $("#state_id,#city_id,#status").select2();
  });
  $("#state_id,#city_id,#body_of_water_id,#status").select2();

    $(function() {
        $('#state_id').change(function() {

            var url = '{{ route("admin.ajax_cities_of_state", ":state_id") }}';
            url = url.replace(':state_id', $(this).val());

            $.get(url, function(data) {
                var select = $('#city_id');

                select.empty();
                console.log(data);
                $.each(data,function(key, value) {
                    select.append('<option value=' + key + '>' + value + '</option>');
                });
            });
        });
    });
    
</script>
