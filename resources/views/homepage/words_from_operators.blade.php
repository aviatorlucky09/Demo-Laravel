@php
	$testimonials = getCacheValue('home_testimonial_array');
@endphp
@if($testimonials and is_array($testimonials))
<section class="mt-5 pb-5 pt-5 operators-section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-h1">
					<h1>Words from our valuable Rental Operators</h1>
					<hr>
				</div>
				<p class="pt-3">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempore incidunt ut labore et dolore magna aliqua. Ut enime ad minime veniam, quis nostrud exercitation is  ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in enderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur ccaecat cupidatat non generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
				</p>
			</div>
		</div>


		<div class="row mt-4">
			<div class="col-md-12">

				  <div id="owl-carousel" class="owl-carousel owl-theme operators-slider">
					@foreach($testimonials as $testimonial)
						<div class="item">
						<div class="oprator-slider-div">
									<img alt="{{ $testimonial['full_name'] }}<" src1="{{ $testimonial['image_url'] }}" class="lazy" data-original="{{ $testimonial['image_url'] }}">
									<p>{{ $testimonial['description'] }}</p>
									<h1>{{ $testimonial['full_name'] }}</h1>
									<h5>{{ $testimonial['designation'] }}</h5>
									<button type="button" class="btn btn-warning">Via {{ $testimonial['via'] }}</button>
								</div>
						</div> 
					@endforeach
				  </div>
			</div>
		</div>

	</div>
</section>
@endif