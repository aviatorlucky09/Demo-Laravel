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
          {{ $carr['singular_name'] }}  Name</label>
          <input name="name" type="text"  class="form-control m-b-5" value="{{ $obj->name }}" />
        </div>
   
        <div class="col-md-6">
          <label class="col-form-label">Active</label>
          <br>
          <div class="switcher">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" @if($obj->is_active) checked @endif  value="1">
            <label for="is_active"></label>
          </div>

        </div>
        <div class="col-md-6 mt-2">
          <label class="col-form-label">Display on homepage</label>
          <br>
          <div class="switcher">
            <input type="hidden" name="display_on_homepage" value="0">
            <input type="checkbox" name="display_on_homepage" id="display_on_homepage" @if($obj->display_on_homepage) checked @endif  value="1">
            <label for="display_on_homepage"></label>
          </div>
        </div>
        
      </div>
      <div class="col-md-6 row">
        <div class="col-md-6">
           <label class="col-form-label">Upload Image</label>
           <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name="image" 
            onchange="loadImagePreview(this)">
            <label class="custom-file-label" for="image">Choose file</label>
          </div>
      </div>
      @if(!empty($obj->image))
      <div class="col-md-6">
         
        <img id="image_preview" src="{{ $obj->image_url }}" class="img-responsive" style="width:100%" />
      </div>
      @endif
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
<script type="text/javascript">
  function loadImagePreview(input, id) {
    id = id || '#image_preview';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)
                    
                    
        };
 
        reader.readAsDataURL(input.files[0]);
    }
 }
</script>






