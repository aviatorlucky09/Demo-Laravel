<h1 class="page-header">
  Cancellation Policy
</h1>
@include('admin.setting.policies.tab')
<style>
  .borderless_input{
    border-top:none;
    border-left:none;
    border-right:none;
  }
</style>
<!-- begin panel -->
 
<div class="panel panel-inverse">
  <div class="panel-body">
   <form id='form_user' 
   action="{{ route('admin.setting.cancellation_policy_store') }}" 
   method="post" 
   onsubmit="return submitForm(this)" 
   enctype="multipart/form-data">
   @csrf
      <div class="row  justify-content-md-center">
    @foreach($cancellationPolicies as $cancellationPolicy)
    <div class="col-md-12 row py-2">
      <div class="col-md-2 d-flex align-items-center">
        <p class="h5 text-dark">{{ $cancellationPolicy->policy_type }}</p>
      </div>
      <div class="col-md-10 row">  
        <p class="line1" style = "float:left; width: 21%;">Renters who cancel at least</p>
        <input id="{{ $cancellationPolicy->id }}_time" type="number" name="arr[{{ $cancellationPolicy->id }}][time]" class="form-control borderless_input" style = "float:left; width: 10%;margin-top:-12px;" value="{{ $cancellationPolicy->time }}"/>

        <select name="arr[{{ $cancellationPolicy->id }}][time_type]" id="time_type_{{ $cancellationPolicy->id }}" class="time_type_class" style = "float:left; width: 15%">
          <option value="">Select</option>
          @foreach($timeArray as $time_type)
          <option value="{{ $time_type }}"@if($cancellationPolicy->time_type == $time_type) selected @endif>{{ $time_type }}</option>
          @endforeach
        </select>      
        <p class="line2" style = "float:left; width: 22%;padding-left:6px;">before check-in will get back</p>
        <input type="number" id="{{ $cancellationPolicy->id }}_refund_pr" 
        name="arr[{{ $cancellationPolicy->id }}][refund_percentage]" class="form-control borderless_input" 
        value="{{ $cancellationPolicy->refund_percentage }}"style = "float:left; width: 10%;margin-top:-12px;"/> 
        <p class="line3" style = "float:left; width: 22%;">% of the amount they've paid.</p>
        <div style="clear:both"></div>
      </div>
    </div>
    <div style="clear:both"></div>
    @endforeach
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
<script>
  $(function(){
    $(".time_type_class").select2();
  });
 
</script>
 



