<h1 class="page-header">
  Weather Policy
</h1>
@include('admin.setting.policies.tab')

<!-- begin panel -->
 <style>
    .borderless_input{
    border-top:none;
    border-left:none;
    border-right:none;
  }

 </style>
<div class="panel panel-inverse">
  <div class="panel-body">
   <form id='form_user' 
   action="{{ route('admin.setting.weather_policy_store') }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
   <div class="row  justify-content-md-center">
    @foreach($weatherPolicies as $weatherPolicy)
    <div class="col-md-12 row py-2">
      <div class="col-md-2 d-flex align-items-center">
        <p class="h5 text-dark">{{ $weatherPolicy->policy_type }}</p>
      </div>
       <div class="col-md-10 row">
         @if($weatherPolicy->id !== 3)
         <p class="float-left" style="width: 21%">Renter will be charged a minimum of</p>
         <select name="arr[{{ $weatherPolicy->id }}][min_charge_hours]" id="min_charge_hours_{{ $weatherPolicy->id }}" class="hour float-left @if($weatherPolicy->id===3) d-none @endif" style="width: 10%">
          <option value="">Select</option>
          @foreach(getHoursArrayForPolicy() as $hour)
          <option value="{{ $hour }}" @if($weatherPolicy->min_charge_hours == $hour) selected @endif>{{ $hour }}</option>
          @endforeach
        </select>
         <p class="float-left ml-2" style="width: 40%">hour and refunded for their time remaining.</p> 
        @endif
        @if($weatherPolicy->id==3)
        <p class="float-left" style="width: 5%">Issue</p>
        <input type="number" id="remaining_refund_percantage_{{ $weatherPolicy->id }}" 
        name="arr[{{ $weatherPolicy->id }}][remaining_refund_percantage]" class="form-control borderless_input float-left"
        value="{{ $weatherPolicy->remaining_refund_percantage }}" style = "width: 10%;margin-top:-12px;"/>
         <p class="float-left" style="width: 30%"> % refund of time remaining.</p>
        @endif
       </div>
</div>
@endforeach
</div>
    <div class="col-md-12 row">
      <div class="col-md-4"></div>
      <div class="col-md-4 text-left">
       <br><br>
       <input type="submit" class="btn btn-success start m-r-5 w-50" value="Update">
     </div>
     <div class="col-md-4"></div>
    </div>

 </div>

</form>
</div>
</div>
 
<script>
  $(".hour").select2();
</script>



