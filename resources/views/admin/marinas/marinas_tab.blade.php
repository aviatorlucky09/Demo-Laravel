<ul class="nav justify-content-center" id="marina_tab">
  <li class="nav-item">
    <a 
    	href="{{ ajaxUrl(route('admin.marina_edit',['id'=>$marina->id])) }}" 
    	class="nav-link @if($active_tab == 'marina') active disabled @endif ">Marina</a>
  </li>
  @if($marina->id)
   
  <li class="nav-item">
    <a
    	href="{{ ajaxUrl(route('admin.marina_description',['marina_id'=>$marina->id])) }}" 
    class="nav-link   @if($active_tab == 'description') active disabled @endif ">Description</a>
  </li>
<li class="nav-item">
  <a
      href="{{ ajaxUrl(route('admin.marina_amenities_tab',['marina_id'=>$marina->id])) }}" 
    class="nav-link   @if($active_tab == 'amenities') active disabled @endif ">Amenities</a>
  </li>
  <li class="nav-item">
    <a 
      href="{{ ajaxUrl(route('admin.marina_image',['marina_id'=>$marina->id])) }}" 
    class="nav-link   @if($active_tab == 'image') active disabled @endif ">Images</a>
  </li>
  <li class="nav-item">
    <a 
      href="{{ ajaxUrl(route('admin.marina_owner',['marina_id'=>$marina->id])) }}" 
    class="nav-link   @if($active_tab == 'owner') active disabled @endif ">Owner</a>
  </li>
 {{-- <li class="nav-item">
    <a 
      href="{{ ajaxUrl(route('admin.marina_price',['marina_id'=>$marina->id])) }}" 
    class="nav-link   @if($active_tab == 'price') active disabled @endif ">Pricing</a>
  </li> --}}
 
  @endif 
</ul>
 <style type="text/css">
 	#marina_tab .active{
 		background: #fff;
    font-weight: bold;
 	}
 </style>