<div class="panel panel-inverse">
  <div class="panel-body">
    <form method="get" id="state_search_form" action="{{ ajaxUrl(route('admin.boats')) }}" onsubmit="return searchBoat(this)">
      <div class="row">
       <div class="col-md-3">
        <label class="col-form-label">Select Marina Name</label>
         <select id="marina_id" class="form-control" name="marina_id">
          <option value="{{ $marina_id }}" selected>{{ getMarinaName($marina_id) }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="col-form-label">Select Boat Type</label>
         <select id="boat_type_id" class="form-control" name="boat_type_id">
          <option value="">Select</option>
          @foreach($boatTypes as $boatType)
          <option value="{{ $boatType->id }}" @if($boatType->id == $boat_type_id) selected @endif>{{ $boatType->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3">
        <label class="col-form-label">Select Boat Status</label>
         <select id="status" class="form-control" name="status">
          <option value="">Select</option>
          @foreach(getBoatStatus() as $key=>$boat_status)
          <option value="{{ $key }}" @if($key == $status) selected @endif>{{ $boat_status }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3">
       <br>
       <input style="margin-top: 15px;" type="submit" class="btn btn-primary start m-r-5" name="submit" value="Search"> 

     </div>                        
   </div>
 </form>
</div>
</div>
<style>
  #marina_id,{
    width: 100%!important;
  }
</style>
<script>
  $("#boat_type_id,#status").select2();
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
