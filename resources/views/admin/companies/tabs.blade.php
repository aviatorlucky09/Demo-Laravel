@php
    if($active_tab == "company" or $active_tab == "users"){
       $company = $obj;
    }
   
    $edit_link =  ajaxUrl(route($carr['edit_route_name'],['id'=>$company->id]));  
    if(!isset($active_tab)){
        $active_tab = "company";
    } 

@endphp
<ul class="nav justify-content-center" id="company_tab">
  <li class="nav-item">
    <a 
    	href="{{ $edit_link }}" 
    	class="nav-link @if($active_tab == 'company') active disabled @endif ">Company</a>
  </li>
  @if($company->id)
  <li class="nav-item">
    <a href="{{ ajaxUrl(route('admin.company_users',['id'=>$company->id])) }}" class="nav-link @if($active_tab == 'users') active disabled @endif ">Users</a>
  </li>

  @endif
  <li class="nav-item">
    <a 
      href="{{ ajaxUrl(route('admin.company.change_log',['company_id'=>$company->id])) }}" 
    class="nav-link   @if($active_tab == 'change_log') active disabled @endif ">Change Log</a>
  </li>
</ul>
 <style type="text/css">
 	#company_tab .active{
 		background: #fff;
    font-weight: bold;
 	}
 </style>