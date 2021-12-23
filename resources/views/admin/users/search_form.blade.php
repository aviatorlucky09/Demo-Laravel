<div class="panel panel-inverse">
  <div class="panel-body">
    <form method="get" id="state_search_form" action="{{ ajaxUrl(route('admin.users')) }}" onsubmit="return searchUserByType(this)">
      <div class="row">

       <div class="col-md-3">
         <label class="col-form-label"> 
         Select User Type</label>
         <select id="user_type" name="user_type">
          <option value="">Select</option>
          @foreach($userTypes as $type_key=>$type)
          <option value="{{ strtolower(str_replace(" ","_",$type)) }}" @if($user_type==strtolower(str_replace(" ","_",$type))) selected @endif>{{ $type }}</option>
          @endforeach
        </select>  

      </div>

      <div class="col-md-4">
       <br>
       <input style="margin-top: 15px;" type="submit" class="btn btn-primary start m-r-5" name="submit" value="Search"> 

     </div>                        
   </div>
 </form>
</div>
</div>
<style>
  #user_type{
    width: 100%!important;
  }
</style>
<script>
  $(function(){
    $("#user_type").select2();
  });
</script>
