
<!-- Modal -->
<div class="modal fade" id="bulkPricingModal" tabindex="-1" role="dialog" aria-labelledby="bulkPricingModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id='form_modal' 
      action="{{ route('admin.boat_bulk_price_store',['boat_id'=>$boat->id]) }}" 
      method="post" 
      onsubmit="return submitForm(this)" 
      enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="bulkPricingModalLabel">Bulk Pricing Upate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 row justify-content-center">
         <div class="col-md-2"></div>
         <div class="col-md-2"><label class="col-form-label">Price</label></div>
         <div class="col-md-2"><label class="col-form-label">Start Hours</label></div>
         <div class="col-md-2"><label class="col-form-label">End Hours</label></div>
         <div class="col-md-2"><label class="col-form-label">Turnaround</label></div> 
       </div>
       @foreach(getBoatDayPartsArray() as $part_key=>$part)
       <div class="col-md-12 row justify-content-center">
        <div class="col-md-2">
          <input type="hidden" name="arr[{{ $part_key }}]" value="0"/>
          <input class="form-check-input" type="checkbox" name="arr[{{ $part_key }}]" id="{{ $part_key }}_check" 
          value="1">
          <label class="form-check-label" for="{{ $part_key }}_check">{{ $part }}</label>
        </div>
        <div class="col-md-2">
          <div id ="{{ $part_key }}_price_div" class="input-group mb-3">
           <div id="{{ $part_key }}_price_prepend" class="input-group-prepend">
            <span class="input-group-text text-dark">$</span>
          </div>
          @php
          $field_name = $part_key."_price";    
          @endphp
          <input type="text" class="form-control time pr-2" name="arr[{{ $field_name }}]" id="{{ $part_key }}_{{ $field_name }}">
        </div>
      </div>
      <div class="col-md-2">
        <div id="{{ $part_key }}_start_hr_div" class="input-group bootstrap-timepicker timepicker time">
          @php
          $field_name = $part_key."_start_hours";
          @endphp
          <input id="{{ $field_name }}" type="text" class="form-control input-small time_picker pr-2 timepicker-24-hr" 
          name="arr[{{ $field_name }}]">
          <span class="input-group-addon"><i class="far fa-clock text-dark"></i></span>
        </div>
      </div>
      <div class="col-md-2">
       <div id="{{ $part_key }}_end_hr_div" class="input-group bootstrap-timepicker timepicker time">
         @php
         $field_name = $part_key."_end_hours";
         @endphp
         <input id="{{ $field_name }}" type="text" class="form-control input-small time_picker pr-2" 
          name="arr[{{ $field_name }}]">
         <span class="input-group-addon"><i class="far fa-clock text-dark"></i></span>
       </div>
     </div>
       <div id="{{ $part_key }}_turnaround_div" class="col-md-2">
         @php
         $field_name = $part_key."_turnaround";
         @endphp
         <input id="{{ $field_name }}" type="number" step="0.01" name="arr[{{ $field_name }}]" 
         class="form-control input-smal">
     </div>
   </div>
   @endforeach
 </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Save Changes</button>
</div>
</div>
</form>
</div>

</div>

