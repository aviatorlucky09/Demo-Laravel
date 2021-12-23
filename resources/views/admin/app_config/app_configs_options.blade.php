@php
	$edit_link =  ajaxUrl(route($carr['edit_route_name'],['id'=>$obj->id,'category'=>$obj->category]));   
	 

@endphp
@if($deleted == 0)  
<a class="btn btn-primary" href="{{ $edit_link}}">
    <i class="fas fa-edit" aria-hidden="true"></i>
</a>
@endif
 



    