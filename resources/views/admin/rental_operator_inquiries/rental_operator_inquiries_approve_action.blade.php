@php
  $list_url = $carr['listing_url'];
  $update_url = route('admin.rental_operator_inquiry_saveAction',['id' => $obj->id,'action'=>'approve']) ;
  $hideAction = 0;
@endphp
 
<h1 class="page-header">
  @if($obj->status == "approved")
    Inquery company and company user : {{ $obj->status  }}
  @else
    Approve Inquery and create company and company user : {{ $obj->status  }}
  @endif


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
            @if($obj->company)
              <div class="col-md-6">
                 <label class="col-form-label"><a href="{{ ajaxUrl(route('admin.company_edit',['id'=>$obj->company->id])) }}" target="_blank">Company</a>
                 </label>
                 
              </div>
              @php
                $hideAction = 1;
              @endphp
            @endif
             @if($obj->user)
              <div class="col-md-6">
                 <label class="col-form-label"><a href="{{ ajaxUrl(route('admin.company_users',['id'=>$obj->user->id])) }}" target="_blank">Company User</a></label>
                 
              </div>
            @endif
            <div class="col-md-6">
              <label class="col-form-label">Company / Operator Name</label>
              <input readonly name="company_name" type="text"  class="form-control m-b-5" value="{{ $obj->company_name }}" />
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Email id</label>
              <input readonly name="email_id" type="text"  class="form-control m-b-5" value="{{ $obj->email_id }}" />
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Contact Number</label>
              <input readonly autocomplete="off" name="contact_number" id="contact_number" type="text"  class="form-control m-b-5" value="{{ $obj->contact_number_str }}" />
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Address</label>
              <input readonly name="address" type="text"  class="form-control m-b-5" value="{{ $obj->address }}" />
            </div>
            @if($hideAction == 0) 
            <div class="col-md-6">
              <label class="col-form-label">Update Note</label>
              <textarea class="form-control" name="update_note"></textarea>
            </div>
            @endif
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
        <a href="{{ $list_url  }}" data-toggle="ajax" class="btn btn-warning start m-r-5 pull-right" > Back </a>
        @if($hideAction  == 0)
        <input type="submit" class="btn btn-success start m-r-5 pull-right" value="Approve and create operator">
        @endif
        

      </div>
    </div>

</form>
</div>
</div>
<script>
 
</script>






