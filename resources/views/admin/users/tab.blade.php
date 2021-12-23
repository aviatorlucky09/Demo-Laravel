<ul class="nav justify-content-center" id="user_tab">
  <li class="nav-item">
    <a 
    	href="{{ ajaxUrl(route('admin.user_edit',['id'=>$user->id])) }}" 
    	class="nav-link @if($active_tab == 'user') active disabled @endif ">User</a>
  </li>
  @if($user->id)
   
  <li class="nav-item">
    <a
    	href="{{ ajaxUrl(route('admin.user_detail',['user_id'=>$user->id])) }}" 
    class="nav-link   @if($active_tab == 'detail') active disabled @endif ">Details</a>
  </li>
  <li class="nav-item">
    <a
    	href="{{ ajaxUrl(route('admin.user_detail',['user_id'=>$user->id])) }}" 
    class="nav-link   @if($active_tab == 'detail') active disabled @endif ">Comapny</a>
  </li>
  
  @endif

</ul>
 <style type="text/css">
 	#user_tab .active{
 		background: #fff;
    font-weight: bold;
 	}
 </style>