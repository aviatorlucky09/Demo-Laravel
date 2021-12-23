<h1 class="page-header">Dashboard</h1>
<div class="row">
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>USERS</h4>
				<p>{{ $userCount }}</p>	
			</div>
			<div class="stats-link">
				<a href="{{ ajaxUrl(route('admin.users')) }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-success">
			<div class="stats-icon"><i class="fa fa-ship"></i></div>
			<div class="stats-info">
				<h4>BOATS</h4>
				<p>{{ $boatCount }}</p>	
			</div>
			<div class="stats-link">
				<a href="{{ ajaxUrl(route('admin.boats')) }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fas fa-anchor"></i></div>
			<div class="stats-info">
				<h4>RENTAL OPERATORS</h4>
				<p>{{ $rentalOperatorCount }}</p>	
			</div>
			<div class="stats-link">
				<a href="{{ ajaxUrl(route('admin.users',['user_type'=>'rental_operator'])) }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-black-lighter">
			<div class="stats-icon"><i class="fa fa-clock"></i></div>
			<div class="stats-info">
				<h4>BOOKINGS</h4>
				<p>00:12:23</p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
</div>
<div class="row">
	<div class="col-lg-3 col-md-6">
		<a onclick="return confirm('Are you sure?')" target="_blank" href="{{ route('admin.command',['name'=>'migrate-seed']) }}" class="btn btn-danger"> Database Migration And Seeder</a>
	</div>
</div>