 <section class="home-banner">
        <img class="banner-img" src="images/banners/home-1.jpg" width="100%">
        <div class="img-overly"></div>
        <div class="home-search">
            <div class="container ">
                <div class="row ">
                    <div class="col-md-12 ">
                        <h1>A New Wave in Boat Rental Industry</h1>
                    </div>
                </div>

                <div class="col-md-10 m-auto">
                    <form method="get" action="{{ route('search') }}">
                    <div class="row search-row ">
                        <div class="col-md-3 col-7">
                            <label>Location</label>
                            <input type="text" class="form-control" name="" placeholder="Your Destination">
                        </div>
                        <div class="col-md-3">
                            <label>Single</label>
                            <input type="text" class="form-control" name="" id="check-in-date" placeholder="Add dates">
                        </div>
                        <div class="col-md-3 ">
                            <label>Guests</label>
                            <input type="text" class="form-control" name="" placeholder="Add guests">
                        </div>
                        <div class="col-md-3 col-5 col pt-0">
                            <button   class="btn btn-danger"> 
								<i class="fas fa-search "></i> <span> Search </span>
							</button>
                            
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </section>