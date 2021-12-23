@extends('layouts.guest.master')
@section('content')
<section class="section-bg-color pt-4 pb-5">
   <div class="container-fluid">
   		@include('guest\search\include\searchbar')	
   		<br><br>
   		<div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="listing-h1">8239 Boats Found</h1>
                </div>
                <div class="col-md-4 text-right ">
                    <div class="d-flex">
                        <select class="form-control">
                        <option>Sort by: Recommended </option>
                        <option>2</option>
                        <option>3</option> 
                      </select>
                        <button type="button" class="btn btn-primary blu-btn-color ml-2 mr-2"><i class="far fa-th-large"></i></button>
                        <button type="button" class="btn btn-primary white-btn-color"><i class="fas fa-bars"></i></button>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12 col-xl-12 map-col-lising">
                    <iframe class="map-listing-page" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2180591.4270035056!2d-75.76705289455545!3d40.991444042554605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1633776479553!5m2!1sen!2sin" width="100%"
                        height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-md-12 col-xl-12 boat-list-col">

                    <div class="row">

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3 ">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->

                        <div class="boat-list-div-col-3 col-sm-6 col-md-6 col-xl-3">
                            <div class="listing-main-div">
                                <div class="listing-img-div">
                                    <div id="owl-carousel" class="owl-carousel owl-theme listing-img-slider">
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-1.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-2.jpg);"></div>
                                        </div>
                                        <div class="item">
                                            <div class="listing-img" style="background-image: url(images/boats/boat-3.jpg);"></div>
                                        </div>
                                    </div>
                                    <i class="far fa-heart hart-icon"></i>
                                    <div class="noti-icon-div">-15% <i class="fas fa-bell-on"></i></div>
                                    <div class="price-tag-1">$200 - $1500</div>
                                </div>
                                <div class="listing-discript">
                                    <p class="font-size-13 text-right mb-1">
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star star-color"></i>
                                        <i class="fas fa-star-half-alt star-color"></i>
                                        <i class="far fa-star star-color"></i> (3.5) - (132)</p>
                                    <a href="#">
                                        <h1 class="mb-2 pb-1">kawasaki STX 15F Jet Ski</h1>
                                    </a>
                                    <p class="mb-2">
                                        <i class="fal fa-anchor mr-1"></i> Marina : Action Watersports
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-map-marker-alt"></i> Cape May, NJ </span>
                                        <span class="ml-3"> <i class="fal fa-users"></i> Up to 6 Passengers </span>
                                    </p>
                                    <p class="mb-2">
                                        <span> <i class="fal fa-ship"></i> Jet Ski/Without Captain </span>
                                        <span class="ml-3"> <i class="fal fa-ruler-triangle"></i> 20 ft.</span>
                                    </p>
                                    <div class="icon-bl-div">
                                        <span><i class="far fa-beer"></i></span>
                                        <span><i class="far fa-battery-half"></i></span>
                                        <span><i class="fab fa-bluetooth-b"></i></span>
                                        <span><i class="far fa-wifi"></i></span>
                                        <span><i class="fal fa-life-ring"></i></span>
                                        <span><i class="fal fa-moon"></i></span>
                                        <span><i class="fal fa-video"></i></span>
                                        <span><i class="fal fa-briefcase-medical"></i></span>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 pr-1"> <span>Hourly</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$85</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day AM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Half Day PM</span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$200</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <button type="button" class="btn  book-n-bl-btn-2 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4 pr-1"> <span>Full Day </span> </div>
                                        <div class="col-3 pl-1 pr-1 text-center"><span>$300</span></div>
                                        <div class="col-5 pl-1 text-right">
                                            <i class="fas fa-minus-circle text-danger"></i>
                                            <button type="button" class="btn  book-n-bl-btn-1 btn-sm">Book Now</button>
                                        </div>
                                    </div>
                                    <hr class="mb-2 ">
                                    <p class="text-center font-size-12 mb-0 text-danger">Free Cancellation before 15 days of journey date</p>
                                </div>
                            </div>
                        </div>
                        <!--col-md-3-->


                    </div>
                    <!--end lisiting row-->

                    <br>

                    <div class="lisitng-pagi-div">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item ">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="far fa-long-arrow-alt-left"></i> <span class="text-ori-color">Prev</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><span class="text-ori-color">Next</span> <i class="far fa-long-arrow-alt-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>


        </div>
    </section>
@endsection
@section('footer_script')
  <script>
        $(document).ready(function() {
            $(".map-toggel").click(function() {
                $(this).toggleClass("active-map-toggel");
                if ($(".map-toggel").hasClass('active-map-toggel')) {
                    $(".map-col-lising").addClass('col-md-4 col-xl-6');
                    $(".map-col-lising").removeClass('col-md-12 col-xl-12');
                    $(".boat-list-col").addClass('col-md-8 col-xl-6');
                    $(".boat-list-col").removeClass('col-md-12 col-xl-12');
                    $(".boat-list-div-col-3").addClass('col-md-6 col-xl-6');
                    $(".boat-list-div-col-3").removeClass('col-md-6 col-xl-3');
                } else {
                    $(".map-col-lising").removeClass('col-md-4 col-xl-12');
                    $(".map-col-lising").addClass('col-md-12 col-xl-6');
                    $(".boat-list-col").removeClass('col-md-8 col-xl-12');
                    $(".boat-list-col").addClass('col-md-12 col-xl-12');
                    $(".boat-list-div-col-3").removeClass('col-md-6 col-xl-6');
                    $(".boat-list-div-col-3").addClass('col-md-6 col-xl-3');
                }
            });
        });
    </script>

    <script>
        $('#check-in-date').datepicker({
            autoclose: true,
            orientation: "auto left"
        });

        $('#check-out-date').datepicker({
            autoclose: true,
            orientation: "auto left"
        });
    </script>

    <script>
        $('.listing-img-slider.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: false,
            smartSpeed: 500,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    </script>

    <script>
        const mediaQuery = window.matchMedia('(max-width: 991.98px)')
            // Check if the media query is true
        if (mediaQuery.matches) {
            $(document).ready(function() {
                $(".advanced-fiter-text").click(function() {
                    $(".filter-listing-page").toggle();
                });
            });
        }
    </script>
@endsection
