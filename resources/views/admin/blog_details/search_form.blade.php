
<div class="panel panel-inverse">
  <div class="panel-body">
    <form method="get" id="state_search_form" action="{{ ajaxUrl(route('admin.blog_details')) }}" 
    onsubmit="return searchBlogDetail(this)">
      <div class="row">
       
  <div class="col-2">
     <label class="col-form-label">Select FAQ Category</label>
    <select name="category_id" id="category_id">
      <option value="">Select</option>
     @foreach($blogCategories as $blogCategory)
       <option value="{{  $blogCategory->id }}" @if($blogCategory->id == $category_id) selected @endif>{{ $blogCategory->name }}</option>
     @endforeach
    </select>
  </div>

  

<div class="col-4">
 <br>
 <input style="margin-top: 15px;" type="submit" class="btn btn-primary start m-r-5" name="submit" value="Search"> 

</div>                        
</div>
</form>
</div>
</div>
<style>
  #category_id{
    width: 100%!important;
  }
</style>
<script>
  $(function(){
    $("#category_id").select2();
  });
 
</script>
