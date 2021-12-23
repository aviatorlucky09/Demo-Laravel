 @php

 $list_url = $carr['listing_url'];
 $update_url = route($carr['update_route_name'],['id' => $obj->id]) 

 @endphp

   
<h1 class="page-header">
  Company Users : {{ $obj->name }}
</h1>
@include('admin.companies.tabs')
<!-- begin panel -->
<div class="panel panel-inverse">
  <div class="panel-body">
         <table id="datatable_user" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-nowrap text-center">No</th>
                    <th class="text-nowrap text-center">First Name</th>
                    <th class="text-nowrap text-center">Last Name</th>
                    <th class="text-nowrap text-center">Email ID</th>
                    <th class="text-nowrap text-center">Mobile</th>
                    <th class="text-nowrap text-center">User Type</th>
                    <th class="text-nowrap text-center">Status</th>
                </tr>
            </thead>

            <tbody>
             @foreach($companyUsers as $user)
               <tr>
                  <td>{{ $user->id}}</td>
                  <td>{{ $user->first_name }}</td>
                  <td>{{ $user->last_name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->mobile }}</td>
                  <td>{{ $user->getUserType() }}</td>
                  <td>
                    @if($user->status == 1)
                    <h5><span class='badge badge-primary'>Active</span></h5>
                    @endif
                  </td>
               </tr>
            @endforeach
            </tbody>
        </table>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
             window.table =  $('#datatable_user').DataTable();    
        });
</script>





