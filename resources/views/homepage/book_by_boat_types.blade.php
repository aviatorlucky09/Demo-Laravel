@php
    $boatTypes = getCacheValue('home_boat_type_array');
@endphp
@if(sizeof($boatTypes))
<section class="mt-5 mb-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-h1">
                    <h1>Book By Boat Types</h1>
                    <hr>
                </div>
                <p class="pt-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempore incidunt ut labore et dolore magna aliqua. Ut enime ad minime veniam, quis nostrud exercitation is ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                    dolor in enderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur ccaecat cupidatat non generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on
                    the Internet.
                </p>
            </div>
        </div>
        <div class="row mt-4">
            @foreach($boatTypes as $boatType)
            <div class="col-lg-3 col-md-6">
                <div class="boat-type-div" style="background-image: url({{ $boatType['image_url'] }});">
                    <span>{{ $boatType['name'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-3 mb-2">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-danger">
		See All Boat type <i class="fal fa-arrow-alt-right ml-2"></i> 
	</button>
            </div>
        </div>
    </div>
</section>
@endif