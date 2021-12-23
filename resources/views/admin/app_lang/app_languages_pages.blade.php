<h1 class="page-header">
   App Language Pages
</h1>

<div class="panel panel-inverse">
    <div class="panel-body">
    	<div class="row text-center pt-3" style="min-height:300px;">
		@foreach($pages as $key=>$page)
		<div class="col-lg-4 col-md-6">
				<h5><a href="{{ ajaxUrl(route('admin.app_langs',['page'=>$key])) }}">{{ $page }}</a></h5>
		</div>
		@endforeach
		</div>
    </div>
</div>
