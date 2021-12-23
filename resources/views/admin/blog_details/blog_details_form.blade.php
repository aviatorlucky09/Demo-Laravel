 @php

 $list_url = $carr['listing_url'];
 $update_url = route($carr['update_route_name'],['id' => $obj->id]) 

 @endphp

 <ol class="breadcrumb pull-right">
  <li class="breadcrumb-item"><a href="{{ $list_url }}" data-toggle="ajax"> {{ $carr['plural_name'] }}</a></li>
  @if($obj->id == 0)
  <li class="breadcrumb-item"> Create </li>
  @else
  <li class="breadcrumb-item"> Edit </li>
  @endif
</ol> 
<h1 class="page-header">
  @if($obj->id == 0) Create  @else  Edit  @endif {{ $carr['singular_name'] }}
</h1>

<!-- begin panel -->
<div class="panel panel-inverse">
  <div class="panel-body">
    <form id='form_user' 
    action="{{ $update_url }}" 
    method="post" 
    onsubmit="return submitForm(this)" 
    enctype="multipart/form-data">
    <input name="{{ $carr['table_name'] }}_id" type="hidden" value="{{ $obj->id }}">
    @csrf
    <div class="row  justify-content-md-center">
      <div class="col-md-6 row">
         <div class="col-md-6">
          <label class="col-form-label"> 
          Select Blog Category</label>
          <select name="category_id" id="category_id">
            <option value="">Select</option>
            @foreach($blogCategories as $blogCategory)
            <option value="{{ $blogCategory->id }}" @if($blogCategory->id == $obj->category_id) selected @endif>
              {{ $blogCategory->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-12">
          <label class="col-form-label"> 
          Title</label>
          <input name="title" type="text"  class="form-control m-b-5" value="{{ $obj->title }}" />
        </div>


        <div class="col-md-12">
          <label class="col-form-label"> 
       Details</label>
          <textarea name="details" id="details">{{ $obj->details }}</textarea>
        </div>
        
      </div>

    </div>

    <br>
    <br>
    <div class="row">
     <br>
     <div class="col-md-3">
     </div>
     <div class="col-md-3">
      <a href="{{ $list_url  }}" data-toggle="ajax" class="btn btn-warning start m-r-5 pull-right" > Back </a>
      <input type="submit" class="btn btn-success start m-r-5 pull-right" value="@if($obj->id == 0) Create   @else  Update   @endif ">
    </div>

  </div>

</form>
</div>
</div>
<style>
  #category_id{
    width:100%!important;
  }
</style>
<script type="text/javascript">
  CKEDITOR.replace('details');
  $(function(){
    $("#category_id").select2();
  });
</script>




