
<h1 class="page-header">
  Marina Owner
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

  #admin_status{
    width: 100%!important;
  }
  

</style>

<!-- begin panel -->
<div class="panel panel-inverse">
  <div class="panel-body">
   <form id='form_user' 
   action="{{ route('admin.marina_owner_store',['marina_id'=>$marina->id]) }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
   <div class="row  justify-content-md-center">
    <div class="col-md-6 row">
     <div class="col-md-6">
       <label class="col-form-label">Full Name</label>
       <input name="full_name" class="form-control m-b-5" value="">
     </div>
     <div class="col-md-6">
      <label class="col-form-label">Phone Number</label>
      <input name="owner_mobile" type="text"  class="form-control m-b-5" value="{{ $marina_owner->owner_mobile }}" />
    </div>
    <div class="col-md-6">
      <label class="col-form-label">E-mail ID</label>
      <input name="owner_email" type="text"  class="form-control m-b-5" value="{{ $marina_owner->owner_email }}" />
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





