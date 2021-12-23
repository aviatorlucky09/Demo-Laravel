 @php
  $list_url = $carr['listing_url'];
  $update_url = route($carr['update_route_name'],['id' => $obj->id]);

$rolePermissionArr = array();
$role = $obj->role;
$rolePermissionArr =  $role->permissionNameArr();
    // if(!$allowDepartmentChange){
       
    // }
   
    
   

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
@include('admin.admins.tab')
<!-- begin panel -->
<div class="panel panel-inverse">
    <div class="panel-body">
        <form id='form_user_permission'
              action="{{ $update_url }}"
              method="post"
              onsubmit="return submitForm(this)"
              enctype="multipart/form-data">
            <input name="{{ $carr['table_name'] }}_id" type="hidden" value="{{ $obj->id }}">
                    @csrf
                    <input name="permission_tab" value="1" type="hidden">
                    <div class="row  justify-content-md-center">
                         
                         <div class="col-md-6  row">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5 class="font-size-15">User Permission Assign:</h5>
                                </div>
                            </div>
                            @php
                                $pArr = $obj->permissionArr();
                            @endphp
                            <br>
                             
                            <div class="table-responsive  ">
                            <table class="table" id="permission_table">
                                <thead>
                                <tr>
                                    <th>Module Name</th>
                                    <th>Permission</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $pArr = $obj->permissionArr();
                                @endphp
                                @foreach($roleModules as $mkey => $roleModule)
                                <tr>
                                    <td>{{ $roleModule['label']  }}</td>
                                    <td>
                                        @foreach($roleModule['option'] as $option)
                                        <div class="checkbox">
                                            @if($allowDepartmentChange)
                                                @if(isset($rolePermissionArr[$mkey."_".$option]))
                                                    <input  id="r_{{$mkey}}_{{$option}}" type="checkbox"  value="1" checked disabled >
                                                    <label for="r_{{$mkey}}_{{$option}}" class="font-size-14 text-dark"> {{ $roleModule['label'] }} {{  ucfirst(str_replace("_"," ",$option)) }}</label> </label>
                                                @else
                                                    <input  id="r_{{$mkey}}_{{$option}}" type="checkbox" name="r[{{$mkey}}][{{$option}}]" value="1" @if(isset($pArr[$mkey]) and isset($pArr[$mkey][$option])) checked @endif >
                                                    <label for="r_{{$mkey}}_{{$option}}" class="font-size-14 text-dark"> {{ $roleModule['label'] }} {{  ucfirst(str_replace("_"," ",$option)) }}</label> </label>
                                                @endif

                                                
                                            @else
                                                 @if(isset($rolePermissionArr[$mkey."_".$option]))
                                                   <input  id="r_{{$mkey}}_{{$option}}" type="checkbox"  value="1" checked disabled >
                                                    <label for="r_{{$mkey}}_{{$option}}" class="font-size-14 text-dark"> {{ $roleModule['label'] }} {{  ucfirst(str_replace("_"," ",$option)) }}</label> </label>
                                                 @endif
                                            @endif
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
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
      $(document).ready(function() {
             window.table =  $('#permission_table').DataTable({ "paging":   false,
        "ordering": false,
        "info":     false});
        });
 </script>


