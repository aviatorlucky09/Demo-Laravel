

<!-- Begining hourly_heading div -->
<div id="hourly_heading" class="column_heading col-md-12 row text-left">
 <div class="col-md-2"></div>
 <div class="col-md-2"><label class="col-form-label">Price</label></div>
 <div class="col-md-2"><label class="col-form-label">Start Hours</label></div>
 <div class="col-md-2"><label class="col-form-label">End Hours</label></div>
 <div class="col-md-2"><label class="col-form-label">Turnaround</label></div>  
</div>
<!-- Ending hourly_heading div-->

<!-- Begining hourly div -->
<div id="hourly" class="col-md-12 row">
  @foreach(getWeekDaysArray() as $day_key=>$day)
  <!-- Beginning hourly_day div -->
  <div id="hourly_{{ $day }}" class="col-md-12 row py-2">
    <div class="col-md-2 d-flex align-items-start">
      <label class="col-form-label">{{ $day }}</label>
    </div> 
    <div class="col-md-2">
     <div id="{{ $day_key }}_price_div" class="input-group mb-3">
       <div class="input-group-prepend">
        <span class="input-group-text text-dark">$</span>
      </div>
      <input id="{{ $day_key }}_price" type="text" class="form-control time" name="arr[{{ $day_key }}][full_day_price]" value="{{getAdminBoatPriceValue($prices,$day_key,'full_day_price')}}">

    </div>
  </div>
  <div class="col-md-2">
    <div id="{{ $day_key }}_start_hr_div" class="input-group bootstrap-timepicker timepicker">
      <input id="{{ $day_key }}_start_hr" type="text" class="form-control input-small time_picker" name="arr[{{ $day_key }}][full_day_start_hours]" value="{{getAdminBoatPriceValue($prices,$day_key,'full_day_start_hours')}}">
      <span class="input-group-addon"><i class="far fa-clock text-dark"></i></span>
    </div>
  </div>
  <div class="col-md-2">
   <div id="{{ $day_key }}_end_hr_div" class="input-group bootstrap-timepicker timepicker">
    <input id="{{ $day_key }}_end_hr" type="text" class="form-control input-small time_picker" name="arr[{{ $day_key }}][full_day_end_hours]" value="{{getAdminBoatPriceValue($prices,$day_key,'full_day_end_hours')}}">
    <span class="input-group-addon"><i class="far fa-clock text-dark"></i></span>
  </div>
</div>
<div id="{{ $day_key }}_turnaround_div" class="col-md-2">
<input id="{{ $day_key }}_turnaround" type="number" step="0.01" class="form-control" name="arr[{{ $day_key }}][full_day_turnaround]" value="{{getAdminBoatPriceValue($prices,$day_key,'full_day_turnaround')}}">
</div>
</div>
<!-- Ending hourly_day div -->
@endforeach
</div>
<!-- Ending hourly div  -->

