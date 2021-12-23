<div class="panel panel-inverse">
  <div class="panel-body">
    <form method="get" id="state_search_form" action="{{ ajaxUrl(route('admin.rental_operator_inquiries')) }}" onsubmit="return searchInquiry(this)">
      <div class="row">
      <div class="col-md-3">
        <label class="col-form-label">Select Inquiry Status</label>
        <select class="form-control" name="status" id="status">
           <option value="">Select</option>
                @foreach($statusList as $status => $statusArr)
                 
                  <option @if($status == $_status)  selected @endif value="{{ $status}}">{{ $statusArr['label'] }} </option>
               
                @endforeach
              </select>
      </div>

      <div class="col-md-3">
       <br>
       <input style="margin-top: 15px;" type="submit" class="btn btn-primary start m-r-5" name="submit" value="Search"> 

     </div>                        
   </div>
 </form>
</div>
</div>
<style>

</style>
<script>
  $("#status").select2();

</script>
