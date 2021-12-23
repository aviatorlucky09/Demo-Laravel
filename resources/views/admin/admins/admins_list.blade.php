

 <h1 class="page-header">  @if($deleted == 1)
        Deleted
  @endif
  {{ $carr['plural_name'] }}
<small>
    <div class="pull-right">
       <a href="{{ $carr['create_url'] }}"  data-toggle="ajax" class="btn btn-green"> Create {{ $carr['singular_name'] }}</a>
        @if($deleted == 0)
            <a href="{{ $carr['listing_url'] }}?deleted=1"   data-toggle="ajax" class="btn btn-yellow"> Deleted {{ $carr['singular_name'] }}</a>
        @else  
            <a href="{{ $carr['listing_url'] }}"  data-toggle="ajax" class="btn btn-green"> Active {{ $carr['singular_name'] }}</a>
        @endif
    </div>
    </small>

</h1>


<!-- begin panel -->
<div class="panel panel-inverse">

    <div class="panel-body">
         <table id="datatable_admins" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-nowrap text-center">ID</th>
                    <th class="text-nowrap text-center">First Name</th>
                    <th class="text-nowrap text-center">Last Name</th>
                    <th class="text-nowrap text-center">Email ID</th>
                    <th class="text-nowrap text-center">Role Name</th>
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
             window.table =  $('#datatable_admins').DataTable({
                "bSort" : false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                        "url": "{{ route('admin.admins_processing') }}",
                        "type": "POST",
                        "data": {
                              "_token":"{{ csrf_token() }}",
                              "deleted":'{{ $deleted}}',
                        }
                }
            });
        });



</script>
