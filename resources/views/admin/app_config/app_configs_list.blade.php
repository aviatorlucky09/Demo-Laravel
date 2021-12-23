 @php
$categories_url = ajaxUrl(route('admin.app_configs.categories'));
 @endphp
 <h1 class="page-header">  @if($deleted == 1)
        Deleted
  @endif
  App Config : {{ $category }}
<small>
     <div class="pull-right">
       <a href="{{ $categories_url }}" class="btn btn-warning">Back</a>
     </div>
    </small>
    
</h1>

<!-- begin panel -->
<div class="panel panel-inverse">
    
    <div class="panel-body">
         <table id="datatable_vendor" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-nowrap text-center">No</th>
                    <th class="text-nowrap text-center">Config Name</th>
                    <th class="text-nowrap text-center">Value</th>
                     
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
 <script   >
         
       $(document).ready(function() {
             window.table =  $('#datatable_vendor').DataTable({
                "bSort" : false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                        "url": "{{ route('admin.app_configs_processing') }}",
                        "type": "POST",
                        "data": {
                              "_token":"{{ csrf_token() }}",
                              "deleted":'{{ $deleted}}',
                              "category" : '{{ $category }}'
                        }
                } 
            });    
        });

       
        
</script>

    