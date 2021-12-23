
<h1 class="page-header">
 My Info
</h1>
<div class="panel panel-inverse">
    <div class="panel-body">
        <form id='form_user' 
              action="{{ route('admin.update_my_info') }}" 
              method="post" 
              onsubmit="return submitForm(this)" 
              enctype="multipart/form-data">
            <input name="{{ $carr['table_name'] }}_id" type="hidden" value="{{ $obj->id }}">
                    @csrf
                    <div class="row  justify-content-md-center">
                        <div class="col-md-6 row">
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
                            
                            <div class="col-md-6">
                              <label class="col-form-label"> 
                            {{ $carr['singular_name'] }} Password</label>
                            <input name="password" type="password"  class="form-control m-b-5" />
                            
                            <div class="form-check">
                                <input type="checkbox" name="change_pwd" class="form-check-input" id="change_pwd">
                                <label class="form-check-label" for="change_pwd">Change Password ?</label>
                            </div>
                             
                            </div>
                        </div>
                        <div class="col-md-6 row">
                          <div class="col-md-12">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5 class="font-size-15">Permissions:</h5>
                                </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-md-12">

                                    @if($obj->id == 1)
                                      <div class="alert alert-success fade show">
                                            You are logged in as <b>Super Admin</b>. You have all the permissions
                                        </div>
                                    @else
                                      @php
                                          $pArr = $obj->permissionWithRoleNameArr();
                                      @endphp
                                      @foreach($pArr as $pname => $val)
                                         <code>{{ ucwords(str_replace("_"," ",$pname)) }}</code> &nbsp; ,  &nbsp;
                                      @endforeach
                                      

                                    @endif
                              </div>
                            </div>
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
                            <a href="{{ ajaxUrl(route('admin.dashboard'))}}" data-toggle="ajax" class="btn btn-warning start m-r-5 pull-right" > Back </a>
                            <input type="submit" class="btn btn-success start m-r-5 pull-right" value="Update My Info">
                        </div>
                         
                    </div>
                     
                   </form>
    </div>
</div>