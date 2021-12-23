<ul class="nav justify-content-center" id="user_tab">
  <li class="nav-item">
    <a 
    	href="{{ ajaxUrl(route('admin.setting.fuel_policy')) }}" 
    	class="nav-link @if($active_tab == 'fuel') active disabled @endif ">Fuel Policy</a>
  </li>
   
   
  <li class="nav-item">
    <a
    	href="{{ ajaxUrl(route('admin.setting.cancellation_policy')) }}" 
    class="nav-link   @if($active_tab == 'cancellation') active disabled @endif ">Cancellation Policy</a>
  </li>
   <li class="nav-item">
    <a
    	href="{{ ajaxUrl(route('admin.setting.weather_policy')) }}" 
    class="nav-link   @if($active_tab == 'weather') active disabled @endif ">Weather Policy</a>
  </li>
 

</ul>
 <style type="text/css">
 	#user_tab .active{
 		background: #fff;
        font-weight: bold;
 	}
 </style>
 