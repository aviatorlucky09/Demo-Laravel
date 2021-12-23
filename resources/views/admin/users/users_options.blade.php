@php
	$edit_link =  ajaxUrl(route($carr['edit_route_name'],['id'=>$obj->id]));   
	$delete_link =  route($carr['delete_route_name'],['id'=>$obj->id,'restore'=>$deleted]);  

@endphp
@if(Auth::guard('admin')->user()->hasAccess('user_modify'))
	@if($deleted == 0)  
	<a class="btn btn-primary" href="{{ $edit_link}}">
		<i class="fas fa-edit" aria-hidden="true"></i>
	</a>
	@endif
@endif
@if(Auth::guard('admin')->user()->hasAccess('user_delete'))
<a class="btn btn-danger" style="color:#fff" onclick="window.delete_id={{$obj->id }};return deleteDTRecord(this); " data-href="{{ $delete_link}}">
    
	@if($deleted == 1)
		Restore
	@else
		<i class="fas fa-trash font_white" aria-hidden="true"></i>
	@endif
</a>
@endif 
@if(Auth::guard('admin')->user()->hasAccess('user_login_as_user'))
<a class="btn btn-primary" target="_blank" href="{{ route('admin.login_as_user',['user_id'=>$obj->id]) }}">
   Login as a User
</a>
@endif


    