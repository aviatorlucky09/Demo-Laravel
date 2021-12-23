<div class="panel panel-inverse">
  <div class="panel-body">
<form method="get" id="state_search_form" action="{{ ajaxUrl(route('admin.cities')) }}" onsubmit="return searchStateWiseCity(this)">
      <div class="row">
      
         <div class="col-md-3">
             <label class="col-form-label">Select State</label>
                <select name="state_id" id="state_id" class="form-control">
                    <option value="">Select</option>
                    @foreach(getAllStates() as $state)
                        <option value="{{ $state->id }}" @if($state_id==$state->id)selected @endif>{{ $state->name }}</option>
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
<script>
    $(function(){
        $("#state_id").select2();
    });
</script>