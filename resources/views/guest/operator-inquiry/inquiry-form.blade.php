@extends('layouts.guest.master')

@section('content')
  <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-6">
        <div class="contact-infographic">
          <h1 class="mb-5">{{ __('inquiry.thanks_for_your_interest_in_docklyne') }}</h1>
           
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-12 col-lg-6">
        <div class="contact-inquiry-form inquiry-form-bg">
          <h3 class="inquiry-form-title">
            {{ __('inquiry.rental_operator_inquiry_form') }}
          </h3>
          @if (session()->has('message'))
              <p class="alert alert-success">{{ session('message') }}</p>
              {!!  session()->forget('message') !!}
          @endif
          @if($inquiry and $inquiry->status == "in-review") 
          <div class="alert alert-warning" role="alert">
              Your Boat rental operator inquiry is in review.
          </div>
          @endif

          <form  onsubmit="return submitForm(this)" class="inquiry-form" method="post" action="{{route('operator-inquiry')}}" >
            @csrf
            <label class="font-size-20 my-3">{{ __('inquiry.rental_operator_information') }}</label>
            <div class="row">
               <div class="col-sm-12 col-lg-6">
                        <div class="form-group company_name_group">
                          <label class="col-form-label">Company / Operator name </label>
                          <input type="text" class="form-control company_name" name="company_name"
                           placeholder="Company Name" value="{{ $inquiry->company_name }}">
                           <div class="invalid-feedback"></div>
                        </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group email_id_group">
                        <label class="col-form-label">Email id</label>
                        <input type="email" class="form-control email_id" name="email_id"
                           placeholder="Company Email id" value="{{ $inquiry->email_id }}">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group contact_number_group">
                        <label class="col-form-label">Contact Number</label>
                        <input id="contact_number" type="text" class="form-control contact_number" name="contact_number"
                           placeholder="Contact Number" value="{{ $inquiry->contact_number }}">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

   
              
               
            </div>
            <div class="row">
               <div class="col-sm-12 col-lg-12">
                    <div class="form-group address_group">
                      <input type="hidden" name="latitude" id="latitude"/>
	                    <input type="hidden" name="longitude" id="longitude"/>
                      <label class="col-form-label">Business Address</label>
                      <input id="autoaddress" type="text" class="form-control address" name="address"
                           placeholder="Business Address" value="{{ $inquiry->address }}">
                      <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div id="map_canvas"></div>
                <div class="col-sm-12 col-lg-12">
                  <div class="form-group about_company_group">
                        <label class="col-form-label">Abount Company</label>
                         <textarea 
                            class="form-control about_company" 
                            placeholder="Abount Company" rows="3" name="about_company">{{ $inquiry->about_company }}</textarea>
                
                        <div class="invalid-feedback"></div>
                   </div>  
                   
                </div>
               
            </div>
           
            <div class="row mt-3">
              <div class="col-12">
                <button class="font-size-14 btn btn-primary btn-lg float-right submit-btn">{{ __('inquiry.submit') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
@section('footer_script')
@include('layouts.scripts.geocomplete')

<script>
  window.applyTelephoneMask("contact_number");  
  $(document).ready(function(){
    	$("#autoaddress").geocomplete({
        map: "#map_canvas",
        details: "form",
        markerOptions: {
          draggable: true,
          zoom: 14,
        }
      });
      $("#autoaddress").bind("geocode:result", function(event, results){
        $("#latitude").val(results.geometry.location.lat());
        $("#longitude").val(results.geometry.location.lng());
		  });
      $("#autoaddress").bind("geocode:dragged", function(event, latLng){
        $("#latitude").val(latLng.lat());
        $("#longitude").val(latLng.lng());
      });
  });
  

</script>
@endsection
