<ul class="nav justify-content-center" id="boat_tab">
  <li class="nav-item">
    <a 
    	href="{{ ajaxUrl(route('admin.boat_edit',['id'=>$boat->id])) }}" 
    	class="nav-link @if($active_tab == 'boat') active disabled @endif ">Boat</a>
  </li>
  @if($boat->id)
   
   
  <li class="nav-item">
    <a
    	href="{{ ajaxUrl(route('admin.boat_description',['boat_id'=>$boat->id])) }}" 
    class="nav-link   @if($active_tab == 'description') active disabled @endif ">Description</a>
  </li>

  <li class="nav-item">
    <a 
      href="{{ ajaxUrl(route('admin.boat_image',['boat_id'=>$boat->id])) }}" 
    class="nav-link   @if($active_tab == 'image') active disabled @endif ">Images</a>
  </li>
  <li class="nav-item">
    <a 
      href="{{ ajaxUrl(route('admin.boat_amenity',['boat_id'=>$boat->id])) }}" 
    class="nav-link   @if($active_tab == 'amenity') active disabled @endif ">Amenities</a>
  </li>
  <li class="nav-item">
    <a 
      href="{{ ajaxUrl(route('admin.boat_price',['boat_id'=>$boat->id])) }}" 
    class="nav-link   @if($active_tab == 'price') active disabled @endif ">Pricing</a>
  </li>
  <li class="nav-item">
    <a 
      href="{{ ajaxUrl(route('admin.boat.change_log',['boat_id'=>$boat->id])) }}" 
    class="nav-link   @if($active_tab == 'change_log') active disabled @endif ">Change Log</a>
  </li>
  @endif
</ul>
 <style type="text/css">
 	#boat_tab .active{
 		background: #fff;
    font-weight: bold;
 	}
 </style>