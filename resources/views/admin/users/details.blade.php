<h1 class="page-header">
 User Detial
</h1>

@include('admin.users.tab')

<!-- begin panel -->
<style type="text/css">
  .nav-tabs a.active{
    background: #fff;
  }
  
  hr{
    border: 0!important;
    clear:both!important;
    display:block!important;
    width: 100%!important;               
    background-color:#ccc;
    height: 2px!important;
  }
  label.form-check-label{
    font-weight: 450!important;
  }

  
  #government_document_id,#operator_status{
    width: 100%!important;
  }
  

</style>

<div class="panel panel-inverse">
  <div class="panel-body">
   <form id='form_user' 
   action="{{ route('admin.user_detail_store',['user_id'=>$user->id]) }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
   <div class="row justify-content-md-center">
    <div class="col-md-6 row">
      <div class="col-md-12">
       <label class="col-form-label"> 
       About Me</label>
       <textarea name="about_me" class="form-control m-b-5" >{{ $user->detail->about_me }}</textarea>
     
     </div> 
     <div class="col-md-6">
       <label class="col-form-label"> 
       Emergency Contact No</label>
       <input name="emergency_contact" type="text"  class="form-control m-b-5" value="{{ $user->detail->emergency_contact }}" />
     </div> 
     <div class="col-md-6">
       <label class="col-form-label"> 
       Company Name</label>
       <input name="company_name" type="text"  class="form-control m-b-5" value="{{ $user->detail->company_name }}" />
     </div> 
     <div class="col-md-6">
       <label class="col-form-label"> 
       Select Govt. Document</label>
       <select id="government_document_id" name="government_document_id">
        <option value="">Select</option>
        @foreach(getAllGovtDocuments() as $doc_id=>$doc_name)
        <option value="{{  $doc_id }}" @if($user->detail->government_document_id==$doc_id) selected @endif>{{ $doc_name }}</option>
        @endforeach
      </select>
    </div> 
      <div class="col-md-12 pt-5">
    <h4>Billing Address</h4>
  </div>
  <div class="col-md-6">
   <label class="col-form-label">Street</label>
   <input name="street" type="text"  class="form-control m-b-5" value="{{ $user->detail->street }}" />
 </div>

 <div class="col-md-6">
   <label class="col-form-label">City</label>
   <input name="city" type="text"  class="form-control m-b-5" value="{{ $user->detail->city }}" />
 </div>

 <div class="col-md-6">
   <label class="col-form-label">State</label>
   <input name="state" type="text"  class="form-control m-b-5" value="{{ $user->detail->state }}" />
 </div>

 <div class="col-md-6">
   <label class="col-form-label">Zipcode</label>
   <input name="zipcode" type="text"  class="form-control m-b-5" value="{{ $user->detail->zipcode }}" />
 </div> 

<div class="col-md-6 mt-5">
  <label class="col-form-label"> 
       Select Rental Operator Status</label>
       <select id="operator_status" name="operator_status">
        <option value="">Select</option>
        @foreach(getRentalOperatorStatus() as $key=>$status)
        <option value="{{  $key }}" @if($user->detail->operator_status==$key) selected @endif>{{ $status }}</option>
        @endforeach
      </select>
</div>
 <div class="col-md-6 mt-5">
       <label class="col-form-label"> 
       Rental Operator Status Note</label>
       <textarea name="operator_status_note" class="form-control m-b-5" >{{ $user->detail->operator_status_note }}</textarea>
     </div>

</div>
<div class="col-md-6 row">
  <div class="col-md-6">
    <label class="col-form-label">Upload  Government ID</label>
   <div class="custom-file">
    <input type="file" class="custom-file-input" id="government_document" name="government_document" 
    onchange="loadPreview(this,'#ID_preview')">
    <label class="custom-file-label" for="government_document">Choose file</label>
  </div>
</div>
<div class="col-md-6">
   @php
  $path = 'storage/uploads/documents/'.$user->id."/".$user->detail->government_document;
  @endphp
  <img id="ID_preview" src="{{ url($path) }}" class="img-responsive" style="width:100%"/>
</div>

  <div class="col-md-6">
    <label class="col-form-label">Upload  Boat License</label>
   <div class="custom-file">
    <input type="file" class="custom-file-input" id="boat_license_document" name="boat_license_document"
     onchange="loadPreview(this,'#license_preview')">
    <label class="custom-file-label" for="boat_license_document">Choose file</label>
  </div>
</div>
<div class="col-md-6">
   @php
  $path = 'storage/uploads/boat_license/'.$user->id."/".$user->detail->boat_license_document;
  @endphp
  <img id="license_preview" src="{{ url($path) }}" class="img-responsive" style="width:100%"/>
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
<script>
   $("#government_document_id,#operator_status").select2();
   function loadPreview(input, id) {

   // id = id || '#ID_preview';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)         
        };
 
        reader.readAsDataURL(input.files[0]);
    }
 }

</script>



