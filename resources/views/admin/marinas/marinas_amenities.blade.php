@php
$amenitiesIdsArr = $marina->amenities->pluck('id')->toArray();
@endphp
<h1 class="page-header">
  Marina Amenities
</h1>

@include('admin.marinas.marinas_tab')

<style type="text/css">
  .nav-tabs a.active{
    background: #fff;
  }
  .width_10{
    width:50px;
  }
  label.form-check-label{
    font-weight: 450!important;
  }

  

</style>

<!-- begin panel -->
<div class="panel panel-inverse">
  <div class="panel-body">
   <form id='form_user' 
   action="{{ route('admin.marina_amenities_store',['marina_id'=>$marina->id]) }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
   <div class="row  justify-content-md-center">
    <div class="col-md-12 row">
    
<div class="col-md-6">
 <label class="col-form-label">Select Amenities You Offer</label>
</div>
<div class="col-md-12 row ml-2">
  @foreach($marinaAmenities as $amenity_id=>$amenity_name)
  <div class="col-3 form-check px-3 py-2">

    <input type="checkbox" class="form-check-input" id="amenity_{{ $amenity_id }}" name="amenities_id[]" value="{{ $amenity_id }}" @if(in_array($amenity_id,$amenitiesIdsArr)) checked @endif>
    <label class="form-check-label" for="amenity_{{ $amenity_id }}">{{ $amenity_name }}</label>

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





