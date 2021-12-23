<h1 class="page-header">
  Boat Pricing
</h1>

@include('admin.boats.tab')

<!-- begin panel -->
<style type="text/css">
  .nav-tabs a.active{
    background: #fff;
  }
  .width_10{
    width:50px;
  }
  .input-group-addon{
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;
    border-left: none!important;
    background-color: #fff!important;
    padding: 4px 4px!important;

  }
  .time_picker{
    border-right: none!important;
  }
  .input-group-text{
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: none!important;
    background-color: #fff!important;
    padding: 4px 12px!important;
  }
  .time{
   border-left: none!important;
 }
 label.form-check-label{
  font-weight: 450!important;
}

.modal-dialog {
    max-width: 800px!important;
    margin: 1.75rem auto;
}

</style>

<div class="panel panel-inverse">
  <div class="panel-body">
   <form id='form_user' 
   action="{{ route('admin.boat_price_store',['boat_id'=>$boat->id]) }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
   <div class="row  justify-content-md-center">
    <div class="row col-md-12">
      <div class="col-md-6">
         <label class="col-form-label">How much do you want to charge ?</label> 
      </div>
      <div class="col-md-6">
        <div class="pull-right"><a class="btn btn-primary text-white" data-toggle="modal" data-target="#bulkPricingModal">
        Bulk pricing update
      </a></div>
      </div>
     
    </div>
    </div>

    @include('admin.boats.shared.day_hourly_price')
    
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
@include('admin.boats.shared.bulk_price_modal')
<script>
  $(function(){
  $('.time_picker').timepicker();

 });
  function reloadPage(){
    $("#bulkPricingModal").modal('hide');
    window.location.reload();
  }


</script>





