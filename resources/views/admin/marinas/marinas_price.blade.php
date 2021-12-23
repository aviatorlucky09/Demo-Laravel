<h1 class="page-header">
  Marina Pricing
</h1>

@include('super_admin.marinas.marinas_tab')

<!-- begin panel -->
<style type="text/css">
  .nav-tabs a.active{
    background: #fff;
  }
  label.form-check-label{
    font-weight: 450!important;
  }
  hr{
    border: 0!important;
    clear:both!important;
    display:block!important;
    width: 100%!important;               
    background-color:#ccc;
    height: 2px!important;
  }
  .input-group-text{
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: none!important;
    background-color: #fff!important;
    padding: 4px 12px!important;
  }

</style>
<script>

</script>
<div class="panel panel-inverse">
  <div class="panel-body">
   <form id='form_user' 
   action="{{ route('super_admin.marina_price_store',['marina_id'=>$marina->id]) }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
   <div class="row  justify-content-md-center">
    <div class="col-md-12 row">
      <div class="col-md-12 row">
        <label class="col-form-label h4 text-dark">Marina Fees</label>
      </div>   
      <div class="col-md-12 row">
       <hr>
     </div>  
     <!-- Marina Fees -->
     <div class="col-md-12 row">
      @foreach($marinaFees as $marinaFee)
      <div class="col-md-4 py-2">
        <div class="row">
          <label class="col-form-label">{{  $marinaFee->name  }}</label>
        </div>
        <div class="row d-flex justify-content-around py-2 pl-2">
         <div class="col-md-3">
          <input class="form-check-input" type="radio" name="marina_fees[{{ $marinaFee->id }}][fee_apply_type]" 
          value="1" id="marina_fees_type_{{ $marinaFee->id }}_1" @if(getAdminMarinaPriceValue($prices,$marinaFee->id,"fee_apply_type") == 1) checked @endif>
          <label class="form-check-label" for="marina_fees_type_{{ $marinaFee->id }}_1">
           Yes  
         </label>
      </div>
      <div class="col-md-3">
        <input class="form-check-input" type="radio" name="marina_fees[{{ $marinaFee->id }}][fee_apply_type]" 
        value="0" id="marina_fees_type_{{ $marinaFee->id }}_0" @if(getAdminMarinaPriceValue($prices,$marinaFee->id,'fee_apply_type') == 0) checked @endif>
        <label class="form-check-label" for="marina_fees_type_{{ $marinaFee->id }}_0">
         No
       </label>
     </div>
     <div class="col-md-3">
      <input class="form-check-input" type="radio" name="marina_fees[{{ $marinaFee->id }}][fee_apply_type]" 
      value="2" id="marina_fees_type_{{ $marinaFee->name }}_2" @if(getAdminMarinaPriceValue($prices,$marinaFee->id,"fee_apply_type") == 2) checked @endif> 
      <label class="form-check-label" for="marina_fees_type_{{ $marinaFee->name }}_2">
       N/A
     </label>
   </div>
 </div>
 <div class="row d-flex justify-content-start">
   <div class="col-md-9 pt-2">
     <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">$</span>
          </div>
          <input type="text" class="form-control" name="marina_fees[{{ $marinaFee->id }}][fees]"
           value="{{ getAdminMarinaPriceValue($prices,$marinaFee->id,'fees')}}">
        </div>
   </div>
 </div>
</div>
@endforeach
</div> 

<!-- Rental Fees -->
<div class="col-md-12 row pt-5">
  <label class="col-form-label h4 text-dark">Marina Rental Fees</label>
</div>   
<div class="col-md-12 row">
 <hr>
</div>
<div class="col-md-12 row">
  @foreach($marinaRentalFees as $marinaRental)
  <div class="col-md-4 py-2">
    <div class="row">
      <label class="col-form-label">{{  $marinaRental->name  }}</label>
    </div>
    <div class="row d-flex justify-content-around py-2 pl-2">
     <div class="col-md-3">
      <input class="form-check-input" type="radio" name="marina_fees[{{ $marinaRental->id }}][fee_apply_type]" 
      value="1" id="marina_fees_type_{{ $marinaRental->name }}_1"
       @if(getAdminMarinaPriceValue($prices,$marinaRental->id,'fee_apply_type') == 1) checked @endif>
      <label class="form-check-label" for="marina_fees_type_{{ $marinaRental->name }}_1">
       Yes  
     </label>
   </div>
   <div class="col-md-3">
    <input class="form-check-input" type="radio" name="marina_fees[{{ $marinaRental->id }}][fee_apply_type]" 
    value="0" id="marina_fees_type_{{ $marinaRental->name }}_0" 
    @if(getAdminMarinaPriceValue($prices,$marinaRental->id,'fee_apply_type') == 0) checked @endif>
    <label class="form-check-label" for="marina_fees_type_{{ $marinaRental->name }}_0">
     No
   </label>
 </div>
 <div class="col-md-3">
  <input class="form-check-input" type="radio" name="marina_fees[{{ $marinaRental->id }}][fee_apply_type]" 
  value="2" id="marina_fees_type_{{ $marinaRental->name }}_2" 
  @if(getAdminMarinaPriceValue($prices,$marinaRental->id,'fee_apply_type') == 2) checked @endif>
  <label class="form-check-label" for="marina_fees_type_{ $marinaRental->name }}_2">
   N/A
 </label>
</div>
</div>
 <div class="row d-flex justify-content-start">
   <div class="col-md-9 pt-2">
     <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">$</span>
          </div>
          <input type="text" class="form-control" name="marina_fees[{{ $marinaRental->id }}][fees]"
          value="{{ getAdminMarinaPriceValue($prices,$marinaRental->id,'fees')}}">
        </div>
   </div>
 </div>
</div>
@endforeach
</div>
</div>
</div>
<div class="row">

  <div class="col-md-3">
  </div>
  <div class="col-md-3">
   <br><br>
   <input type="submit" class="btn btn-success start m-r-5 pull-right" value="Update">
 </div>

</div>



</form>
</div>
</div>





