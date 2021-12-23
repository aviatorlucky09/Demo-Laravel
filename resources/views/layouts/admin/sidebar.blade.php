<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">

		<!-- begin sidebar nav -->
		<ul class="nav active">
			<li class="nav-header"></li>
			<!-- Dashboard -->
			<li>
				<a href="{{ ajaxUrl(route('admin.dashboard')) }}" data-toggle="ajax">
					<i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ ajaxUrl(route('admin.rental_operator_inquiries')) }}" data-toggle="ajax">
					<i class="fas fa-info"></i><span>Ooperator Inquiries</span>
				</a>
			</li>

			<li>
				<a href="{{ ajaxUrl(route('admin.companies')) }}" data-toggle="ajax">
					<i class="fas fa-info"></i><span>Companies</span>
				</a>
			</li>

			


			<!-- Govt. Document -->
			<li>
				<a href="{{ ajaxUrl(route('admin.government_documents')) }}" data-toggle="ajax">
					<i class="fas fa-id-card"></i><span>Govt Documents</span>
				</a>
			</li>
			@if(Auth::guard('admin')->user()->hasAccessByArray(['user_view','user_create','user_modify','user_delete']))
			<!-- Users -->
			<li>
				<a href="{{ ajaxUrl(route('admin.users')) }}" data-toggle="ajax">
					<i class="fas fa-users"></i><span>Users</span>
				</a>
			</li>
			@endif
			@if(Auth::guard('admin')->user()->hasAccessByArray(['sub_user_view','admin_user_view','admin_user_create','admin_user_modify','admin_user_delete']))
			<!-- Admins -->
			<li>
				<a href="{{ ajaxUrl(route('admin.admins')) }}" data-toggle="ajax">
					<i class="fas fa-user-tie"></i><span>Admins</span>
				</a>
			</li>
			@endif
            @if(Auth::guard('admin')->user()->hasAccessByArray(['admin_role_view','admin_role_create','admin_role_modify','admin_role_delete']))
			<!-- Admins Roles -->
			<li>
                <a href="{{ ajaxUrl(route('admin.admin_roles')) }}" data-toggle="ajax">
                    <i class="fas fa-user-tie"></i><span>Admin Roles</span>
                </a>
            </li>
			@endif
			<!-- Fleets -->
			<li class="has-sub closed">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-ship" aria-hidden="true"></i>
					<span>Fleet</span>
				</a>
				<ul class="sub-menu">
					@if(Auth::guard('admin')->user()->hasAccessByArray(['fleet_view','fleet_create','fleet_modify','fleet_delete']))
					<li><a href="{{ ajaxUrl(route('admin.boats')) }}" data-toggle="ajax">Boats</a></li>
					@endif
					
					<li><a href="{{ ajaxUrl(route('admin.boat_types')) }}" data-toggle="ajax">Boat Types</a></li>
					<li><a href="{{ ajaxUrl(route('admin.boat_amenities')) }}" data-toggle="ajax">Boat Amenities</a></li>
					<li><a href="{{ ajaxUrl(route('admin.boat_manufacturers')) }}" data-toggle="ajax">Boat Manufacturers</a></li>
				</ul>
			</li>
			<!-- Boatyard -->
			<li class="has-sub closed">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-anchor"></i>
					<span>Boatyard</span>
				</a>
				<ul class="sub-menu">
					<li><a href="{{ ajaxUrl(route('admin.marinas')) }}" data-toggle="ajax">Marinas</a></li>
					<li><a href="{{ ajaxUrl(route('admin.marina_amenities')) }}" data-toggle="ajax">Marina Amenities</a></li>
					<li><a href="{{ ajaxUrl(route('admin.body_of_waters')) }}" data-toggle="ajax">Body Of Waters</a></li>

				</ul>
			</li>

			<!-- FAQ -->
			<li class="has-sub closed">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-clipboard-list"></i>
					<span>FAQs</span>
				</a>
				<ul class="sub-menu">
					<li><a href="{{ ajaxUrl(route('admin.faq_categories')) }}" data-toggle="ajax">FAQ Categories</a></li>
					<li><a href="{{ ajaxUrl(route('admin.faq_details')) }}" data-toggle="ajax">FAQ Details</a></li>

				</ul>
			</li>

			<!-- Blog -->
			<li class="has-sub closed">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fas fa-blog"></i>
					<span>Blogs</span>
				</a>
				<ul class="sub-menu">
					<li><a href="{{ ajaxUrl(route('admin.blog_categories')) }}" data-toggle="ajax">Blog Categories</a></li>
					<li><a href="{{ ajaxUrl(route('admin.blog_details')) }}" data-toggle="ajax">Blog Details</a></li>

				</ul>
			</li>
			<!-- Settings -->
			<li class="has-sub closed">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-cog"></i>
					<span>Settings</span>
				</a>
				<ul class="sub-menu">
					<li><a href="{{ ajaxUrl(route('admin.setting.cancellation_policy')) }}" data-toggle="ajax">Policies</a></li>


				</ul>
			</li>

			<!-- Master -->
			 <li class="has-sub closed">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-th-large"></i>
					<span>Masters</span>
				</a>
				<ul class="sub-menu">
					<li><a href="{{ ajaxUrl(route('admin.cities')) }}" data-toggle="ajax">Cities</a></li>
					<li><a href="{{ ajaxUrl(route('admin.states')) }}" data-toggle="ajax">States</a></li>
					<li><a href="{{ ajaxUrl(route('admin.countries')) }}" data-toggle="ajax">Countries</a></li>
				    <li><a href="{{ ajaxUrl(route('admin.app_configs.categories')) }}" data-toggle="ajax">App Configs</a></li>
				     <li><a href="{{ ajaxUrl(route('admin.app_langs.pages')) }}" data-toggle="ajax">App Languages</a></li>
				    <li><a href="{{ ajaxUrl(route('admin.change_logs')) }}" data-toggle="ajax">Change Logs</a></li>
				    <li><a href="{{ ajaxUrl(route('admin.deposite_reasons')) }}" data-toggle="ajax">Deposite Reasons</a></li>
				</ul>
			</li>
			<!-- Master -->
			 <li class="has-sub closed">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-th-large"></i>
					<span>Home Page</span>
				</a>
				<ul class="sub-menu">
					<li><a href="{{ ajaxUrl(route('admin.home_destinations')) }}" data-toggle="ajax">Destinations</a></li>
					<li><a href="{{ ajaxUrl(route('admin.home_testimonials')) }}" data-toggle="ajax">Testimonials</a></li>
					
				</ul>
			</li>
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>


		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
<style>

	#sidebar li{
		height:100%!important;
	}


</style>

