<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="{{ ajaxUrl(route('admin.dashboard')) }}" data-toggle="ajax" class="navbar-brand">
					<b>{{ getAppConfig('website_name','Website Name') }} </b>
				</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header -->
			
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				 
				 <li>
						<a href="" data-toggle="ajax">
							<span></span>
						</a>
				</li>
			 
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle click" data-toggle="dropdown">
						<div class="image image-icon bg-black text-grey-darker">
							<img src="">
							<!-- <i class="fa fa-user"></i> -->
						</div>
						<span class="d-none d-md-inline">{{ Auth::user()->first_name }}</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						 
                        <a class="dropdown-item" href="{{ ajaxUrl(route('admin.get_my_info')) }}" data-toggle="ajax">
                            My Info
                        </a>
                        
                        <a href="{{ route('logout',['locale'=>'en']) }}" 
						   onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();"
                           class="dropdown-item">{{ __('Logout') }}</a>

                        <form id="logout-form" action="{{ route('admin.logout',['locale'=>'en']) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
					</div>
				</li>
			</ul>
		</div>
		<!-- end #header -->