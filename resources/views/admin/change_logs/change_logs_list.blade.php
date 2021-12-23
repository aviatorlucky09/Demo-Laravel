 <h1 class="page-header"> 
  {{ $carr['plural_name'] }}
</h1>
 
<!-- begin panel -->
<div class="panel panel-inverse">
    
    <div class="panel-body">
         <table id="datatable_vendor" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-nowrap text-center">ID</th>
                    <th class="text-nowrap text-center">User Name</th>
                    <th class="text-nowrap text-center">Admin Name</th>
                    <th class="text-nowrap text-center">Model name</th>
                    <th class="text-nowrap text-center">Field Name</th>
                    <th class="text-nowrap text-center">Old Value</th>
                    <th class="text-nowrap text-center">New Value</th>
                    <th class="text-nowrap text-center">Flag</th>
                    <th class="text-nowrap text-center">Created At</th>    
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
    <!-- end panel-body -->
</div>
<!-- end panel -->
 <script>
         
       $(document).ready(function() {
             window.table =  $('#datatable_vendor').DataTable({
                "bSort" : false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                        "url": "{{ route('admin.change_logs_processing') }}",
                        "type": "POST",
                        "data": {
                              "_token":"{{ csrf_token() }}"
                              
                        }
                } 
            });    
        });

       
        
</script>

    