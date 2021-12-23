<div class="col-md-12 row">
  <label class="col-form-label h4 text-dark">Describe Your Boat</label>
</div>   
<div class="col-md-12 row">
 <hr>
</div>
<div class="col-md-12 row">  

  <div class="col-md-2">
   <label class="col-form-label">Boat Manufacturer</label>
   <select name="manufacturer_id" id="manufacturer_id">
    <option value="">Select</option>
    @foreach($boatManufacturers as $boatManufacturer)
    <option value="{{ $boatManufacturer->id }}" @if($boat->detail->manufacturer_id == $boatManufacturer->id) selected @endif>{{ $boatManufacturer->name }}</option>
    @endforeach
  </select>
</div>
<div class="col-md-2">
 <label class="col-form-label">Select Boat Type</label>
 <select name="boat_type_id" id="boat_type">
  <option value="">Select</option>
  @foreach($boatTypes as $boatType)
  <option value="{{ $boatType->id }}" @if($boat->boat_type_id == $boatType->id) selected @endif>{{ $boatType->name }}</option>
  @endforeach
</select>
</div>

<div class="col-md-2">
 <label class="col-form-label">Lenght</label>
 <input type="number" id ="length" name="length" class="form-control m-b-5" value="{{ $boat->detail->length }}" min="0"/>
</div>
<div class="col-md-2">
 <label class="col-form-label">Passenger Limit</label>
 <input type="number" id="passenger_limit" name="passenger_limit" class="form-control m-b-5" value="{{ $boat->passenger_limit }}" min="0"/>
</div>
<div class="col-md-2">
 <label class="col-form-label">Engine</label>
 <input type="text" id="engine_make" name="engine_make" class="form-control m-b-5" value="{{ $boat->detail->engine_make }}"/>
</div>
<div class="col-md-2">
 <label class="col-form-label">Horsepower</label>
 <input type="text" id="horsepower" name="horsepower" class="form-control m-b-5" value="{{ $boat->detail->horsepower }}"/>
</div>
<div class="col-md-3">
 <label class="col-form-label">Model</label>
 <input type="text" id="model" name="model" class="form-control m-b-5" value="{{ $boat->detail->model }}"/>
</div>

<div class="col-md-2">
 <label class="col-form-label">Select Minimum Age</label>
 <div class="input-group-append mb-3">
  <select name="min_age" class="form-control m-b-5 px-5" id="min_age">
    <option value="">Select</option>
    @for($i=0; $i<=100; $i++)
    <option value="{{ $i }}"  @if($boat->min_age == $i) selected @endif>{{ $i }}</option>
    @endfor
  </select>
  <div class="input-group-append">
    <span class="input-group-text"><small>years</small></span>
  </div>
</div>
</div>

<div class="col-md-2">
 <label class="col-form-label">Select Year</label>
 <div class="input-group-append mb-3">
  <select name="year" class="form-control m-b-5 px-5" id="year">
    <option value="">Select</option>
    @foreach(getYearRangeForBoat() as $year)
    <option value="{{ $year }}"  @if($boat->detail->year == $year) selected @endif>{{ $year }}</option>
    @endforeach
  </select>
  <div class="input-group-append">
    <span class="input-group-text"><small>years</small></span>
  </div>
</div>
</div>

  <div class="col-md-2">
  <label class="col-form-label">Security Deposite</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
  <input type="number" class="form-control" name="security_deposit" value="{{ $boat->detail->security_deposit }}" 
  step="0.001" min="0">
</div>
</div>

<div class="col-md-2">
<label class="col-form-label">Online Bookable</label>
<br>
<div class="switcher">
  <input type="hidden" name="bookable_online" value="0">
  <input type="checkbox" name="bookable_online" id="bookable_online" @if($boat->bookable_online) checked @endif  value="1">
  <label for="bookable_online"></label>
</div>
</div>



</div>

<script>
  $(function(){
   $("#boat_type,#manufacturer_id,#year,#min_age,#year").select2();
 });
</script>