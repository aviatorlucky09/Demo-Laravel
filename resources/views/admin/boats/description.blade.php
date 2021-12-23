<h1 class="page-header">
  Boat Description
</h1>

@include('admin.boats.tab')

<!-- begin panel -->
<style type="text/css">
  .nav-tabs a.active{
    background: #fff;
  }
  
  #booking_type,#boat_type,#parent_category_id,#manufacturer,#year,#model,#without_license_age_requirement,#age_requirement{
    width: 100%!important;
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


</style>

<div class="panel panel-inverse">
  <div class="panel-body">
   <form id='form_user' 
   action="{{ route('admin.boat_description_store',['boat_id'=>$boat->id]) }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
   <div class="row justify-content-md-center">
    @include('admin.boats.shared.describe_boat')
    @include('admin.boats.shared.boat_service')
    @include('admin.boats.shared.more_about_boat')

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






