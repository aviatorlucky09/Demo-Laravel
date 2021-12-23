
<h1 class="page-header">
  Marina Description
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
   action="{{ route('admin.marina_description_store',['marina_id'=>$marina->id]) }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
   <div class="row  justify-content-md-center">
    <div class="col-md-12 row">
     <div class="col-md-10">
       <label class="col-form-label">Marina Description</label>
       <textarea name="description" class="form-control m-b-5">{{ $marina->description }}</textarea>
     </div>
     <div class="col-md-3">
      <label class="col-form-label">Rental Operation Phone Number</label>
      <input name="mobile" type="text"  class="form-control m-b-5" value="{{ $marina->mobile }}" />
    </div>
    <div class="col-md-3">
      <label class="col-form-label">Rental Operation E-mail</label>
      <input name="email" type="text"  class="form-control m-b-5" value="{{ $marina->email }}" />
    </div>
    <div class="col-md-4">
      <label class="col-form-label">Your Website Url</label>
      <input name="website" type="text"  class="form-control m-b-5" value="{{ $marina->website }}" />
    </div>
    <div class="col-md-10">
       <label class="col-form-label">Service you offer</label>
       <textarea name="what_they_offer" class="form-control m-b-5">{{ $marina->what_they_offer }}</textarea>
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
<script>
 $("#admin_status").select2();
</script>





