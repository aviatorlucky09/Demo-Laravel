<div class="col-md-12 row pt-2">
  <label class="col-form-label h4 text-dark">Age Requirement</label>
</div>   
<div class="col-md-12 row">
 <hr>
</div>
<div class="col-md-12 row">
  <div class="col-md-6">
    <div class="col-md-12 row">
     <label class="col-form-label">With license ?</label>
   </div>
   <div class="col-md-12 row pl-2 d-fex justify-content-around">
    <div class="col-md-2">
      <input class="form-check-input" type="radio" name="with_license_is_age" 
      value="1" id="with_license_is_age_1" @if($boat->detail->with_license_is_age == 1) checked @endif>
      <label class="form-check-label" for="with_license_is_age_1">
       Yes  
     </label>
   </div>
   <div class="col-md-2">
    <input class="form-check-input" type="radio" name="with_license_is_age" 
    value="0" id="with_license_is_age_0" @if($boat->detail->with_license_is_age == 0) checked @endif>
    <label class="form-check-label" for="with_license_is_age_0">
     No 
   </label>
 </div>
 <div class="col-md-3">
  <input class="form-check-input" type="radio" name="with_license_is_age" 
  value="-1" id="with_license_is_age_2" @if($boat->detail->with_license_is_age == -1) checked @endif>
  <label class="form-check-label" for="with_license_is_age_2">
   Hide Section  
 </label>
</div>
</div>
<div id="with_license_div" class="col-md-12 row pt-2" style="display:none;">
  <div class="col-md-3">
   <label class="col-form-label">Select Age</label>
   <div class="input-group-append mb-3">
    <select name="age_requirement" class="form-control m-b-5 px-5" id="age_requirement">
      <option value="">Select</option>
      @foreach(getAgeArrayForLicense() as $age)
      <option value="{{ $age }}"  @if($boat->detail->age_requirement == $age) selected @endif>{{ $age }}</option>
      @endforeach
    </select>
    <div class="input-group-append">
      <span class="input-group-text"><small>years</small></span>
    </div>
  </div>
</div>
<div class="col-md-12">
  <label class="col-form-label">Notes</label>
  <textarea id="with_license_age_notes" name="with_license_age_notes" class="form-control m-b-5">{{ $boat->detail->with_license_age_notes }}</textarea>
</div>
</div>
<div class="clearfix"></div>
</div>

<div class="col-md-6">
 <div class="col-md-12 row">
   <label class="col-form-label">Without license ?</label>
 </div>
 <div class="col-md-12 row pl-2 justify-content-around">
  <div class="col-md-2">
    <input class="form-check-input" type="radio" name="without_license_is_age" 
    value="1" id="without_license_is_age_1" @if($boat->detail->without_license_is_age == 1) checked @endif>
    <label class="form-check-label" for="without_license_is_age_1">
     Yes  
   </label>
 </div>
 <div class="col-md-2">
  <input class="form-check-input" type="radio" name="without_license_is_age" 
  value="0" id="without_license_is_age_0"  @if($boat->detail->without_license_is_age == 0) checked @endif>
  <label class="form-check-label" for="without_license_is_age_0">
   No 
 </label>
</div>
<div class="col-md-3">
  <input class="form-check-input" type="radio" name="without_license_is_age" 
  value="-1" id="without_license_is_age_2"  @if($boat->detail->without_license_is_age == -1) checked @endif>
  <label class="form-check-label" for="without_license_is_age_2">
   Hide Section  
 </label>
</div>
</div>
<div id="without_license_div" class="col-md-12 row pt-2" style="display:none;">
  <div class="col-md-3">
   <label class="col-form-label">Select Age</label>
   <div class="input-group-append mb-3">
    <select name="without_license_age_requirement" class="form-control m-b-5 px-5" id="without_license_age_requirement">
      <option value="">Select</option>
      @foreach(getAgeArrayForLicense() as $age)
      <option value="{{ $age }}" @if($boat->detail->without_license_age_requirement == $age) selected @endif>{{ $age }}</option>
      @endforeach
    </select>
    <div class="input-group-append">
      <span class="input-group-text"><small>years</small></span>
    </div>
  </div>
</div>
<div class="col-md-12">
  <label class="col-form-label">Notes</label>
  <textarea id="without_license_age_notes" name="without_license_age_notes" class="form-control m-b-5">{{ $boat->detail->without_license_age_notes }}</textarea>
</div>
</div>
</div>
</div>
<script>
  $(function(){
    boat_detail = {!! json_encode($boat->detail) !!};
    with_license_is_age = boat_detail.with_license_is_age;
    without_license_is_age = boat_detail.without_license_is_age;

    if(with_license_is_age == 1){
      $("#with_license_div").show();
    }
    if(without_license_is_age == 1){
      $("#without_license_div").show();
    }



    /*With license*/
   $("#with_license_is_age_1").click(function(){
    if($('#with_license_is_age_1:checked').length) { 
      $("#with_license_div").show();
    }
 });
  $("#with_license_is_age_0,#with_license_is_age_2").click(function(){
     $("#with_license_div").hide();
    });

/*Without license*/
 $("#without_license_is_age_1").click(function(){
    if($('#without_license_is_age_1:checked').length) { 
      $("#without_license_div").show();
    }
 });
  $("#without_license_is_age_0,#without_license_is_age_2").click(function(){
     $("#without_license_div").hide();
    });
  });
</script>