 @php

$list_url = $carr['listing_url'];
$update_url = route($carr['update_route_name'],['id' => $obj->id]);
$active_tab = "user"; 
$user = $obj;
 @endphp

 <ol class="breadcrumb pull-right">
  <li class="breadcrumb-item"><a href="{{ $list_url }}" data-toggle="ajax"> {{ $carr['plural_name'] }}</a></li>
  @if($obj->id == 0)
  <li class="breadcrumb-item"> Create </li>
  @else
  <li class="breadcrumb-item"> Edit </li>
  @endif
</ol> 
<h1 class="page-header">
  @if($obj->id == 0) Create  @else  Edit @endif {{ $carr['singular_name'] }} :  {{ $obj->getUserType() }}
</h1>

@include('admin.users.tab')
<!-- begin panel -->
<div class="panel panel-inverse">
  <div class="panel-body">
    <form id='form_user' 
    action="{{ $update_url }}" 
    method="post" 
    onsubmit="return submitForm(this)" 
    enctype="multipart/form-data">
    <input name="{{ $carr['table_name'] }}_id" type="hidden" value="{{ $obj->id }}">
    @csrf
    <div class="row  justify-content-md-center">
      <div class="col-md-6 row">
        <div class="col-md-6">
          <label class="col-form-label"> 
          {{ $carr['singular_name'] }}  First Name</label>
          <input name="first_name" type="text"  class="form-control m-b-5" value="{{ $obj->first_name }}" />

        </div>
        <div class="col-md-6">
         <label class="col-form-label"> 
         {{ $carr['singular_name'] }}  Last Name</label>
         <input name="last_name" type="text"  class="form-control m-b-5" value="{{ $obj->last_name }}" />

       </div>

       <div class="col-md-6">
        <label class="col-form-label"> 
        {{ $carr['singular_name'] }}  Gender</label><br>
        <select name="gender" id="gender">
          <option value="">Select</option>
          @foreach($genderTypes as $type_key=>$type)
          <option value="{{ $type_key }}" @if($obj->gender==$type_key) selected @endif>{{ $type }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="col-form-label"> 
        {{ $carr['singular_name'] }}  Birth Date</label>
        <input autocomplete="off" id="birth_date" name="birth_date" type="text"  class="form-control m-b-5"
         value="{{ visibleDateFormat($obj->birth_date) }}" />
      </div>
      <div class="col-md-6">
        <label class="col-form-label"> 
        {{ $carr['singular_name'] }}  Email</label>
        <input  name="email" type="text"  class="form-control m-b-5" value="{{ $obj->email }}" />
      </div>
      <div class="col-md-6 change">
        <label class="col-form-label"> 
        {{ $carr['singular_name'] }}  Phone</label><br>
        <div class="input-group mb-3">
          <div class="input-group-prepend" style="width:75px">
            <select id="country_code" class="form-control" name="country_code">
              <option value=""></option>
              @foreach(getCountryCodes() as $code_key=>$code)
              <option value="{{  $code_key }}" @if($code_key==$obj->country_code) selected @endif>{{ $code }}</option>
              @endforeach
            </select>
          </div>
          <input id="mobile" name="mobile" type="text"  class="form-control m-b-5" value="{{ $obj->mobile_str }}" aria-describedby="basic-addon1">
        </div>

      </div>
      
      @if(0)
      <div class="col-md-6">
        <label class="col-form-label"> 
         User Type</label>
        <select id="user_type" name="user_type" disabled>
          <option value="">Select</option>
          @foreach($userTypes as $type_key=>$type)
          <option value="{{  $type_key }}" @if($obj->user_type==$type_key) selected @endif>{{ $type }}</option>
          @endforeach
        </select>
      </div>
      @endif
      <div class="col-md-6">
          <label class="col-form-label">
              Password</label>
          <input name="password" type="password"  class="form-control m-b-5" />
          @if($obj->id!=0)
              <div class="form-check">
                  <input type="checkbox" name="change_pwd" class="form-check-input" id="change_pwd">
                  <label class="form-check-label" for="change_pwd">Change Password ?</label>
              </div>
          @endif
      </div>
       @if($obj->id == 0)
        <div class="col-md-6">
          <div id="company_wap" style="display:none">
          <label class="col-form-label">Company / Operator Name</label>
          <input name="operator_name" type="text"  class="form-control m-b-5" value="" />
          </div>
        </div>
      @endif  
  <div class="col-md-6">
    <label class="col-form-label">Active</label>
    <br>
    <div class="switcher">
      <input type="hidden" name="status" value="0">
      <input type="checkbox" name="status" id="status" @if($obj->status) checked @endif  value="1">
      <label for="status"></label>
    </div>
  </div>
  <div class="col-md-6">
    <label class="col-form-label">Block User</label>
    <br>
    <div class="switcher">
      <input type="hidden" name="is_block" value="0">
      <input type="checkbox" name="is_block" id="is_block" @if($obj->is_block) checked @endif  value="1">
      <label for="is_block"></label>
    </div>
  </div>

</div>
<div class="col-md-6 row">
<div class="col-md-6">
   <label class="col-form-label">Upload Profile Photo</label>
   <div class="custom-file">
    <input type="file" class="custom-file-input" id="customFile" name="profile_picture" 
    onchange="loadProfilePreview(this)">
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
</div>
<div class="col-md-6">
  @php
  $path = 'storage/uploads/user_profile/'.$obj->id."/".$obj->profile_picture;
  @endphp
  <img id="profile_preview" src="{{ url($path) }}" class="img-responsive" style="width:100%" />
</div>
</div>

</div>

<br>
<br>
<div class="row">
 <br>
 <div class="col-md-3">
 </div>
 <div class="col-md-3">
  <a href="{{ $list_url  }}" data-toggle="ajax" class="btn btn-warning start m-r-5 pull-right" > Back </a>
  <input type="submit" class="btn btn-success start m-r-5 pull-right" value="@if($obj->id == 0) Create   @else  Update   @endif ">
</div>

</div>

</form>
</div>
</div>

<script type="text/javascript">
  $("#country_code,#gender,#goverment_document_id").select2();
  $( "#birth_date" ).datepicker({
    dateFormat: "dd-mm-yy",
    weekStart: 0,
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    rtl: true,
    orientation: "auto",
    changeMonth: true, 
    changeYear: true,
    yearRange: "-90:+00"
  });
  
   function loadProfilePreview(input, id) {
    id = id || '#profile_preview';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)
                    
                    
        };
 
        reader.readAsDataURL(input.files[0]);
    }
 }

 $("#user_type").on("change",function(){
    if($(this).val() == 1){
      $("#company_wap").show();
    }else{
      $("#company_wap").hide();
    }
 });
 applyTelephoneMask("mobile");
</script>
<style>
  
  #gender,#goverment_document_id,#user_type{
    width: 100%!important;
  }
  
</style>


