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
        {{-- <div class="col-md-6">
          <label class="col-form-label"> 
          Select Parent Category</label>
          <select>
            <option value="">Select</option>
          @foreach($blogCategories as $blogCategory)
            <option value="{{ $blogCategory->id }}" @if($blogCategory->id == $obj->parent_category_id) selected @endif
              @if($obj->id == $blogCategory->id) disabled @endif>{{ $blogCategory->name }}</option>
          @endforeach
          </select>  
        </div> --}}


        <div class="col-md-6">
          <label class="col-form-label"> 
          Select Parent Category</label>
          <select name="parent_category_id" id="parent_category_id">
            <option value="">Select</option>
          @foreach($blogCategories as $blogCategory)
          <option value="{{ $blogCategory->id  }}" class="optionGroup" style=" font-weight: bold"
             @if($blogCategory->id == $obj->parent_category_id) selected @endif
              @if($obj->id == $blogCategory->id) disabled @endif>{{ $blogCategory->name }}</option>
            @foreach($blogCategory->childrenCategories as $childCategory)
               @include('admin.blog_categories.child_category', ['child_category' => $childCategory])
            @endforeach
          @endforeach
          </select>  
        </div>

        <div class="col-md-6">
          <label class="col-form-label"> 
          {{ $carr['singular_name'] }}  Name</label>
          <input name="name" type="text"  class="form-control m-b-5" value="{{ $obj->name }}" />
        </div>
        
        <div class="col-md-6">
          <label class="col-form-label"> 
          {{ $carr['singular_name'] }}  Sort Order</label>
          <input name="sort_order" type="number"  class="form-control m-b-5" min = "0" value="{{ $obj->sort_order }}" />
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
      <input type="submit" class="btn btn-success start m-r-5 pull-right" value="@if($obj->id == 0) Create   @else  Update   @endif">
    </div>

  </div>

</form>
</div>
</div>
<style>
  #parent_category_id{
    width:100%!important;
  }
  .optionGroup {
    font-weight: bold!important;
}
    
.optionChild {
    padding-left: 15px!important;
}
</style>
<script>
  $("#parent_category_id").select2();
</script>




