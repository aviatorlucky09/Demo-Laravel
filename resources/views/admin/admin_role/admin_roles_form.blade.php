
 @php
   $list_url = $carr['listing_url'];
   $update_url = route($carr['update_route_name'],['id' => $obj->id])

 @endphp
<div class="container">
    <h3 class="mb-4">@if($obj->id == 0) Create  @else  Edit  @endif {{ $carr['singular_name'] }}</h3>
    <div class="panel panel-inverse">
        <div class="panel-body">
    <form id='form_user'
          action="{{ $update_url }}"
          method="post"
          onsubmit="return submitForm(this)"
          enctype="multipart/form-data">
        <input name="{{ $carr['table_name'] }}_id" type="hidden" value="{{ $obj->id }}">
        @csrf
        <div class="row  ">
            <div class="col-md-3">
                <label class="col-form-label">
                    {{ $carr['singular_name'] }} Name</label>
                <input type="text" class="form-control"  name="name" placeholder="Role Name" value="{{ $obj->name }}">
            </div>
        </div>
        <br>
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
                            <input  id="r_{{$mkey}}_{{$option}}" type="checkbox" name="r[{{$mkey}}][{{$option}}]" value="1" @if(isset($pArr[$mkey]) and isset($pArr[$mkey][$option])) checked @endif >
                            <label for="r_{{$mkey}}_{{$option}}" class="font-size-14 text-dark"> {{ $roleModule['label'] }} {{  ucfirst(str_replace("_"," ",$option)) }}</label> </label>
                        </div>
                        @endforeach
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
   <div class="row user-role-text-box">
   </div>
    <br><br>
    <div class="row">

        <div class="col-md-6">
            <input type="submit" class="btn btn-primary  start m-r-5 pull-right" value="@if($obj->id == 0) Create   @else  Update   @endif ">
            <a href="{{ $list_url  }}" data-toggle="ajax" class="btn btn-outline-primary start m-r-5 pull-right" > Back </a>
        </div>
    </div>
     </form>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
             window.table =  $('#permission_table').DataTable({ "paging":   false,
        "ordering": false,
        "info":     false});
        });

</script>



