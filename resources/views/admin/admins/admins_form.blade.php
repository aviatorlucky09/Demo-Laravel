 @php
  $list_url = $carr['listing_url'];
  $update_url = route($carr['update_route_name'],['id' => $obj->id]);

   $rolePermissionArr = array();
    if(!$allowDepartmentChange){
        $role = Auth::guard('admin')->user()->role;
        $rolePermissionArr =  $role->permissionNameArr();
    }

@endphp
<ol class="breadcrumb pull-right">
    <li class="breadcrumb-item"><a href="{{ $list_url }}" data-toggle="ajax">{{ $carr['plural_name'] }}</a></li>
    @if($obj->id == 0)
    <li class="breadcrumb-item"> Create </li>
    @else
    <li class="breadcrumb-item"> Edit </li>
    @endif
</ol>
<h1 class="page-header">@if($obj->id == 0) Create  @else  Edit  @endif {{ $carr['singular_name'] }}</h1>
@if($obj->id)
    @include('admin.admins.tab')
@endif
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
                        <div class="col-md-6  row">
                            <div class="col-md-6">
                              <label class="col-form-label">
                              {{ $carr['singular_name'] }} First Name</label>
                            <input name="first_name" type="text"  class="form-control m-b-5" value="{{ $obj->first_name }}" />
                            </div>
                            <div class="col-md-6">
                              <label class="col-form-label">
                             {{ $carr['singular_name'] }} Last Name</label>
                            <input name="last_name" type="text"  class="form-control m-b-5" value="{{ $obj->last_name }}" />
                            </div>
                            <div class="col-md-6">
                              <label class="col-form-label">
                             {{ $carr['singular_name'] }} Email ID</label>
                            <input name="email" type="text"  class="form-control m-b-5" value="{{ $obj->email }}" />
                            </div>
                            @if($allowDepartmentChange)
                             <div class="col-md-6">
                                <label class="col-form-label">Admin Role</label>
                                <select class="form-control"  name="role_id" id="role_id">
                                    <option value="">Select</option>
                                    @foreach($adminRoles as $role)
                                        <option @if( $role->id == $obj->role_id) selected @endif value="{{ $role->id  }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                                 <div class="col-md-3">
                                    <label class="col-form-label">User Department</label>
                                    <input type="text" class="form-control"  readonly="true" placeholder="" value="{{ Auth::guard('admin')->user()->role->name  }}" />
                                </div>   
                            @endif
                            <div class="col-md-6">
                                <label class="col-form-label">
                                    Password</label>
                                <input name="password" type="password"  class="form-control m-b-5" />
                                @if($obj->id!=0)
                                    <div class="form-check">
                                        <input type="checkbox" name="change_pwd" class="form-check-input" id="change_pwd">
                                        <label class="form-check-label" for="change_pwd">Change Password ?</label>
                                    </div>
                                @endif
                            </div>

                        </div>
                         
                        <br><br>

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
 <script>
     $("#role_id").select2();
 </script>


