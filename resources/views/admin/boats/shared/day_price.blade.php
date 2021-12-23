<!-- Begining days_heading div -->
<div id="days_heading" class="column_heading col-md-12 row text-center">
 <div class="col-md-2"></div>
 <div class="col-md-10 row">
   <div class="col-md-2"></div>
   <div class="col-md-2"><label class="col-form-label">Price</label></div>
   <div class="col-md-2"><label class="col-form-label">Start Hours</label></div>
   <div class="col-md-2"><label class="col-form-label">End Hours</label></div>
   <div class="col-md-2"><label class="col-form-label">Turnaround</label></div> 
 </div>
</div>
<!-- Ending days_heading div-->

<!--Beginning days div  -->
<div id="days">
 @foreach(getWeekDaysArray() as $day_key=>$day)
 <!-- Beginning day div -->
 <div id="{{ $day }}" class="col-md-12 row py-2">
  <div class="col-md-2 d-flex align-items-center">
    <label class="col-form-label">{{ $day }}</label>
  </div>
  <input type="hidden" name="days" value="{{ $day_key }}"/>
  <!-- Begining col-md-10 -->
  <div class="col-md-10">
    @foreach(getBoatDayPartsArray() as $part_key=>$part)
    <div class="row">
      <div class="col-md-2">
        <div id="{{ $day_key }}_{{ $part_key }}_check_div" class="form-check">
          <input type="hidden" name="arr[{{ $day_key }}][{{ $part_key }}]" value="0"/>
          <input class="form-check-input" type="checkbox" name="arr[{{ $day_key }}][{{ $part_key }}]" id="{{ $day_key }}_{{ $part_key }}_check" @if(getAdminBoatPriceValue($prices,$day_key,$part_key) == 1) checked @endif value="1">
          <label class="form-check-label" for="{{ $day_key }}_{{ $part_key }}_check">
            {{ $part }}
          </label>
        </div>
      </div>
      <div class="col-md-2">
       <div id ="{{ $day_key }}_{{ $part_key }}_price_div" class="input-group mb-3">
         <div id="{{ $day_key }}_{{ $part_key }}_price_prepend" class="input-group-prepend">
          <span class="input-group-text text-dark">$</span>
        </div>
        @php
        $field_name = trim($part_key,"is_");
        $field_name.="_price";    
        @endphp
        <input type="text" class="form-control time pr-2" name="arr[{{ $day_key }}][{{ $field_name }}]" id="{{ $day_key }}_{{ $field_name }}" value="{{ getAdminBoatPriceValue($prices,$day_key,$field_name) }}">
      </div>
    </div>
    <div class="col-md-2">
      <div id="{{ $day_key }}_{{ $part_key }}_start_hr_div" class="input-group bootstrap-timepicker timepicker time">
        @php
        $field_name = ltrim($part_key,"is_");
        $field_name.="_start_hours";
        @endphp
        <input id="{{ $day_key }}_{{ $field_name }}" type="text" class="form-control input-small time_picker pr-2" name="arr[{{ $day_key }}][{{ $field_name }}]" value="{{ getAdminBoatPriceValue($prices,$day_key,$field_name) }}">
        <span class="input-group-addon"><i class="far fa-clock text-dark"></i></span>
      </div>
    </div>
    <div class="col-md-2">
     <div id="{{ $day_key }}_{{ $part_key }}_end_hr_div" class="input-group bootstrap-timepicker timepicker time">
       @php
       $field_name = ltrim($part_key,"is_");
       $field_name.="_end_hours";
       @endphp
       <input id="{{ $day_key }}_{{ $field_name }}" type="text" class="form-control input-small time_picker pr-2"  name="arr[{{ $day_key }}][{{ $field_name }}]" value="{{ getAdminBoatPriceValue($prices,$day_key,$field_name) }}">
       <span class="input-group-addon"><i class="far fa-clock text-dark"></i></span>
     </div>
   </div>
   <div id="{{ $day_key }}_{{ $part_key }}_turnaround_div" class="col-md-2">
     @php
     $field_name = ltrim($part_key,"is_");
     $field_name.="_end_hours";

     @endphp
     <input id="{{ $day_key }}_{{ $field_name }}" type="number" step="0.01" name="arr[{{ $day_key }}][{{ $field_name }}]" class="form-control input-smal" value="{{ getAdminBoatPriceValue($prices,$day_key,$field_name) }}">
   </div>
 </div>
 @endforeach
</div>
<!-- Ending col-md-10 -->
</div>
<!-- Ending day div -->
@endforeach
</div>
<!-- Ending days div-->