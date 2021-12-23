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
  : {{ $obj->status  }}
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
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">Company / Operator Name</label>
              <input name="company_name" type="text"  class="form-control m-b-5" value="{{ $obj->company_name }}" />
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Email id</label>
              <input name="email_id" type="text"  class="form-control m-b-5" value="{{ $obj->email_id }}" />
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Contact Number</label>
              <input autocomplete="off" name="contact_number" id="contact_number" type="text"  class="form-control m-b-5" value="{{ $obj->contact_number_str }}" />
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Address</label>
              <input name="address" type="text"  class="form-control m-b-5" value="{{ $obj->address }}" />
            </div>
            <div class="col-md-6">
              
              <label class="col-form-label">Status</label>
              <select class="form-control" name="status" id="status">
                @foreach($statusList as $status => $statusArr)
                  @if($status != "approved")
                  <option @if( $status == $obj->status )  selected @endif value="{{ $status}}">{{ $statusArr['label'] }} </option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Update Note</label>
              <textarea class="form-control" name="update_note"></textarea>
            </div>
          </div>
        </div>  
        <div class="col-md-6">
          <div class="col-md-12">
            @include('admin.rental_operator_inquiries.rental_operator_inquiries_history')
          </div>
        </div>
      </div>
     <br>
     <br>
      <div class="row">
      <br>
      <div class="col-md-3">
      </div>
      <div class="col-md-5">
        <a href="{{ ajaxUrl(route('admin.rental_operator_inquiry_action',['id'=>$obj->id,'action'=>'approve'])) }}"  data-toggle="ajax" class="btn btn-primary start m-r-5 pull-right" >Approve and create operator</a>
        <a href="{{ $list_url  }}" data-toggle="ajax" class="btn btn-warning start m-r-5 pull-right" > Back </a>
        <input type="submit" class="btn btn-success start m-r-5 pull-right" value="@if($obj->id == 0) Create   @else  Update   @endif ">
        
       

      </div>
    </div>

</form>
</div>
</div>
<script>
applyTelephoneMask("contact_number");
</script>






