<h1 class="page-header">
  Fuel Policy Data
</h1>

@include('admin.setting.policies.tab')
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
   action="{{ route('admin.setting.fuel_policy_store') }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
    <div class="row  justify-content-md-center">
    <input type="hidden" name="fuelPolicy_id" value="{{ $fuelPolicy->id }}"/>
    <div class="col-md-12 row py-2">
      <div class="col-md-5 d-flex align-items-center">
        <p class="h5 text-dark">{{ $fuelPolicy->policy_type }}</p>
      </div>
       <div class="col-md-7 row">
        <p class="float-left" style="width: 2%">$</p>
         <input type="number" id="charge_amount_{{ $fuelPolicy->id }}" 
        name="charge_amount" class="form-control borderless_input float-left"
        value="{{ $fuelPolicy->charge_amount }}" style = "width: 15%;margin-top:-12px;"/>
          <p class="float-left pl-3" style="width: 50%">charge placed on renters card.</p><br>
          <p> This is non-refundable, if a users goes over they are not charged more, and if they do not hit the above limit they are not refunded.</p>
       </div>
    </div>

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
 



