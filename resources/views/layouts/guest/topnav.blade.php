 <header>
	<nav class="navbar navbar-expand-lg " id="desktop-nav">
		<div class="container-fluid">
			  <a class="navbar-brand" href="{{ route('homepage') }}"> 
			  	<img class="logo" src="images/logo.svg"  alt="{{config('app.name')}}" />
			  </a>
			  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon">
			    	<span class="line-1"></span>
			    	<span class="line-2"></span>
			    	<span class="line-3"></span>
			    </span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav m-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="#home">Home </a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Destination</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Top Rentals</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">FAQ</a>
			      </li> 
			    </ul> 
			    <div class="header-btn">
					<a href="{{ route('operator-inquiry') }}" class="btn btn-danger">operator-inquiry</a>
			    	<button type="button" class="btn btn-danger">List Your Boat</button>
			    	<div class="btn-group">
				    	<button type="button" class="btn btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    		<i class="fas fa-bars"></i>
				    		<i class="fal fa-user"></i>
				    	</button>
				    	<div class="dropdown-menu dropdown-menu-right">
                @auth('web')
                  <a class="dropdown-item" type="button"  href="{{ route('logout') }}"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @else
                  @if (Route::has('login'))
                    <li class="nav-item dropdown-item">
                      <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                  @endif
                     @if (Route::has('register'))
                      <li class="nav-item dropdown-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
                @endauth
                 
						  </div>
						</div>
          </div>
			  </div>
		</div>
	</nav>
</header>

 