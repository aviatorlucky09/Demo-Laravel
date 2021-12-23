 @php

 $list_url = $carr['listing_url'];
 $update_url = route($carr['update_route_name'],['id' => $obj->id]);

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
@include('admin.companies.tabs')
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
    <div class="row">
    <div class="col-md-6">
      <div class=" row">
        <div class="col-md-6">
          <label class="col-form-label">{{ $carr['singular_name'] }}  Name</label>
          <input name="company_name" type="text"  class="form-control m-b-5" value="{{ $obj->name }}" />
        </div>
         
        <div class="col-md-6">
          <label class="col-form-label">Commission Percentage</label>
            <div class="input-group-append mb-3">
              <input name="commission_percentage" type="number" step="0.1" min="0" max="40" class="form-control " value="{{ $obj->commission_percentage }}" />
              <div class="input-group-append">
                <span class="input-group-text"><small>%</small></span>
              </div>
            </div>
          </div>
        

          <div class="col-md-12">
          <label class="col-form-label">About company</label>
          <textarea class="form-control" name="about_company">{{ $obj->about_company }}</textarea>
        </div>
      </div>
  

  </div>
    <div class="col-md-6  ">
      @include('admin.companies.location')
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





