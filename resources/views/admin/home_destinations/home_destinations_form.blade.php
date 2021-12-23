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
      <div class="col-md-6  ">
        <div class="col-md-12">
          <label class="col-form-label">Title</label>
          <input name="title" type="title"  class="form-control m-b-5" value="{{ $obj->title }}" />
        </div>
        

        <div class="col-md-12">
          <label class="col-form-label">Description</label>
          <textarea name="description" class="form-control">{{ $obj->description }}</textarea>
        </div>

         <div class="col-md-12">
          <label class="col-form-label">Link</label>
          <input name="link" type="text"  class="form-control m-b-5" value="{{ $obj->link }}" />
        </div>
      </div>
       <div class="col-md-6 row ">
         <div class="col-md-6">
          <label class="col-form-label">Upload Background Image</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="image" 
            onchange="loadProfilePreview(this)">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
         </div>
          <div class="col-md-6">
            @php
             $path = upload_image_url($obj->image);
            @endphp
            <img id="profile_preview" src="{{  $path  }}" class="img-responsive" style="width:100%" />
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
  #faq_category_id{
    width:100%!important;
  }
</style>
<script type="text/javascript">
  
     function loadProfilePreview(input, id) {
        id = id || '#profile_preview';
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




