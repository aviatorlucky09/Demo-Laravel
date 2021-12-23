



 <div class="row">
     <div class="col-md-6">
         <h3 class="page-header mb-4">  @if($deleted == 1) Deleted @endif {{ $carr['plural_name'] }} </h3>
     </div>
     <div class="col-md-6 text-left">
         &nbsp;&nbsp;
         @if($deleted == 0)
             <a href="{{ $carr['listing_url'] }}?deleted=1"    class="btn btn-warning float-right"> Deleted {{ $carr['singular_name'] }}</a>
         @else
             <a href="{{ $carr['listing_url'] }}"    class="btn btn-primary  float-right"> Active {{ $carr['singular_name'] }}</a>
         @endif
         &nbsp;&nbsp;
         <a href="{{ $carr['create_url'] }}"   class="btn btn-primary float-right mr-1"> Create {{ $carr['singular_name'] }}</a> &nbsp;&nbsp;
     </div>
 </div>

<!-- begin panel -->
<div class="panel panel-inverse">

    <div class="panel-body">
         <table id="datatable_roles" class="table   table-bordered">
            <thead>
                <tr>
                    <th class="text-nowrap text-center">ID</th>
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

 <script type="text/javascript">

       $(document).ready(function() {
             window.table =  $('#datatable_roles').DataTable({
                "bSort" : false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                        "url": "{{ route($carr['processing_route_name']) }}",
                        "type": "POST",
                        "data": {
                              "_token":"{{ csrf_token() }}",
                              "deleted":'{{ $deleted}}',
                        }
                }
            });
        });



</script>

