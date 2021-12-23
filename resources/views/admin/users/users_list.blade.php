 <h1 class="page-header">  @if($deleted == 1)
        Deleted
  @endif
  {{ $carr['plural_name'] }}
<small>
    <div class="pull-right">
        <a href="{{ $carr['create_url'] }}"  data-toggle="ajax" class="btn btn-green"> Create {{ $carr['singular_name'] }}</a>
        @if($deleted == 0)
            <a href="{{ $carr['listing_url'] }}?deleted=1"  data-toggle="ajax" class="btn btn-yellow"> Deleted {{ $carr['singular_name'] }}</a>
        @else
            <a href="{{ $carr['listing_url'] }}"  data-toggle="ajax" class="btn btn-green"> Active {{ $carr['singular_name'] }}</a>
        @endif
    </div>
    </small>
    
</h1>
@include('admin.users.search_form')
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
                    <th class="text-nowrap text-center">Option</th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
    </div>
    <!-- end panel-body -->
</div>
<!-- end panel -->
 <script type="text/javascript">
         
       $(document).ready(function() {
             window.table =  $('#datatable_user').DataTable({
                "bSort" : false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                        "url": "{{ route('admin.users_processing') }}",
                        "type": "POST",
                        "data": {
                              "_token":"{{ csrf_token() }}",
                              "deleted":'{{ $deleted}}',
                              "user_type":"{{ $user_type }}"
                        }
                } 
            });    
        });
function  searchUserByType(that) {
  var url = $(that).attr("action");
  window.location.href = url + "?"+$(that).serialize();
  return false;
}

       
        
</script>

    