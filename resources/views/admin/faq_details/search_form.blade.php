
<div class="panel panel-inverse">
  <div class="panel-body">
    <form method="get" id="state_search_form" action="{{ ajaxUrl(route('admin.faq_details')) }}" 
    onsubmit="return searchFAQDetail(this)">
      <div class="row">
       
  <div class="col-2">
     <label class="col-form-label">Select FAQ Category</label>
    <select name="faq_category_id" id="faq_category_id">
      <option value="">Select</option>
     @foreach($faqCategories as $faqCategory)
       <option value="{{  $faqCategory->id }}" @if($faqCategory->id == $faq_category_id) selected @endif>{{ $faqCategory->name }}</option>
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
  #faq_category_id{
    width: 100%!important;
  }
</style>
<script>
  $(function(){
    $("#faq_category_id").select2();
  });
 
</script>
