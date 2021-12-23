@php
	$edit_link =  ajaxUrl(route($carr['edit_route_name'],['id'=>$obj->id]));   
	$delete_link =  route($carr['delete_route_name'],['id'=>$obj->id,'restore'=>$deleted]);  

@endphp
@if($deleted == 0)  
<a class="btn btn-primary" href="{{ $edit_link}}">
    <i class="fas fa-edit" aria-hidden="true"></i>
</a>
@endif
<a class="btn btn-danger" style="color:#fff" onclick="window.delete_id={{$obj->id }};return deleteDTRecord(this); " data-href="{{ $delete_link}}">
    
	@if($deleted == 1)
		Restore
	@else
		<i class="fas fa-trash font_white" aria-hidden="true"></i>
	@endif
</a> 


    