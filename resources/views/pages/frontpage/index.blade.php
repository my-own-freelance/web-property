@extends('layouts.frontpage')
@section('title', $title)
@section('content')
    <!-- STAR HEADER SEARCH -->
    <section id="home" class="parallax-searchs section welcome-area overlay">
        <div class="hero-main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="banner-inner" data-aos="zoom-in">
                            <h1 class="title text-center">Find Your Dream Home</h1>
                            <h5 class="sub-title text-center">We Have Over Million Properties For You</h5>
                        </div>
                    </div>
                    <!-- Search Form -->
                    <div class="col-12">
                        <div class="banner-search-wrap" data-aos="zoom-in">
                            <ul class="nav nav-tabs rld-banner-tab">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs_1">For Sale</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs_2">For Rent</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tabs_1">
                                    <div class="rld-main-search">
                                        <div class="row">
                                            <div class="rld-single-input">
                                                <input type="text" placeholder="Enter Keyword...">
                                            </div>
                                            <div class="rld-single-select ml-22">
                                                <select class="select single-select">
                                                    <option value="1">Property Type</option>
                                                    <option value="2">Family House</option>
                                                    <option value="3">Apartment</option>
                                                    <option value="3">Condo</option>
                                                </select>
                                            </div>
                                            <div class="rld-single-select">
                                                <select class="select single-select mr-0">
                                                    <option value="1">Location</option>
                                                    <option value="2">Los Angeles</option>
                                                    <option value="3">Chicago</option>
                                                    <option value="3">Philadelphia</option>
                                                    <option value="3">San Francisco</option>
                                                    <option value="3">Miami</option>
                                                    <option value="3">Houston</option>
                                                </select>
                                            </div>
                                            <div class="dropdown-filter"><span>Advanced Search</span></div>
                                            <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                <a class="btn btn-yellow" href="#">Search Now</a>
                                            </div>
                                            <div class="explore__form-checkbox-list full-filter">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
                                                        <!-- Form Property Status -->
                                                        <div class="form-group categories">
                                                            <div class="nice-select form-control wide" tabindex="0"><span
                                                                    class="current"><i class="fa fa-home"></i>Property
                                                                    Status</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option selected ">
                                                                        For Sale</li>
                                                                    <li data-value="2" class="option">For Rent
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Property Status -->
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">
                                                        <!-- Form Bedrooms -->
                                                        <div class="form-group beds">
                                                            <div class="nice-select form-control wide" tabindex="0"><span
                                                                    class="current"><i class="fa fa-bed"
                                                                        aria-hidden="true"></i>
                                                                    Bedrooms</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option selected">1
                                                                    </li>
                                                                    <li data-value="2" class="option">2</li>
                                                                    <li data-value="3" class="option">3</li>
                                                                    <li data-value="3" class="option">4</li>
                                                                    <li data-value="3" class="option">5</li>
                                                                    <li data-value="3" class="option">6</li>
                                                                    <li data-value="3" class="option">7</li>
                                                                    <li data-value="3" class="option">8</li>
                                                                    <li data-value="3" class="option">9</li>
                                                                    <li data-value="3" class="option">10</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Bedrooms -->
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
                                                        <!-- Form Bathrooms -->
                                                        <div class="form-group bath">
                                                            <div class="nice-select form-control wide" tabindex="0"><span
                                                                    class="current"><i class="fa fa-bath"
                                                                        aria-hidden="true"></i>
                                                                    Bathrooms</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option selected">1
                                                                    </li>
                                                                    <li data-value="2" class="option">2</li>
                                                                    <li data-value="3" class="option">3</li>
                                                                    <li data-value="3" class="option">4</li>
                                                                    <li data-value="3" class="option">5</li>
                                                                    <li data-value="3" class="option">6</li>
                                                                    <li data-value="3" class="option">7</li>
                                                                    <li data-value="3" class="option">8</li>
                                                                    <li data-value="3" class="option">9</li>
                                                                    <li data-value="3" class="option">10</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Bathrooms -->
                                                    </div>
                                                    <div
                                                        class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld d-none d-lg-none d-xl-flex">
                                                        <!-- Price Fields -->
                                                        <div class="main-search-field-2">
                                                            <!-- Area Range -->
                                                            <div class="range-slider">
                                                                <label>Area Size</label>
                                                                <div id="area-range" data-min="0" data-max="1300"
                                                                    data-unit="sq ft"></div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <br>
                                                            <!-- Price Range -->
                                                            <div class="range-slider">
                                                                <label>Price Range</label>
                                                                <div id="price-range" data-min="0" data-max="600000"
                                                                    data-unit="$"></div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 d-none d-lg-none d-xl-flex">
                                                        <!-- Checkboxes -->
                                                        <div class="checkboxes one-in-row margin-bottom-10 ch-1">
                                                            <input id="check-2" type="checkbox" name="check">
                                                            <label for="check-2">Air Conditioning</label>
                                                            <input id="check-3" type="checkbox" name="check">
                                                            <label for="check-3">Swimming Pool</label>
                                                            <input id="check-4" type="checkbox" name="check">
                                                            <label for="check-4">Central Heating</label>
                                                            <input id="check-5" type="checkbox" name="check">
                                                            <label for="check-5">Laundry Room</label>
                                                            <input id="check-6" type="checkbox" name="check">
                                                            <label for="check-6">Gym</label>
                                                            <input id="check-7" type="checkbox" name="check">
                                                            <label for="check-7">Alarm</label>
                                                            <input id="check-8" type="checkbox" name="check">
                                                            <label for="check-8">Window Covering</label>
                                                        </div>
                                                        <!-- Checkboxes / End -->
                                                    </div>
                                                    <div
                                                        class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 d-none d-lg-none d-xl-flex">
                                                        <!-- Checkboxes -->
                                                        <div class="checkboxes one-in-row margin-bottom-10 ch-2">
                                                            <input id="check-9" type="checkbox" name="check">
                                                            <label for="check-9">WiFi</label>
                                                            <input id="check-10" type="checkbox" name="check">
                                                            <label for="check-10">TV Cable</label>
                                                            <input id="check-11" type="checkbox" name="check">
                                                            <label for="check-11">Dryer</label>
                                                            <input id="check-12" type="checkbox" name="check">
                                                            <label for="check-12">Microwave</label>
                                                            <input id="check-13" type="checkbox" name="check">
                                                            <label for="check-13">Washer</label>
                                                            <input id="check-14" type="checkbox" name="check">
                                                            <label for="check-14">Refrigerator</label>
                                                            <input id="check-15" type="checkbox" name="check">
                                                            <label for="check-15">Outdoor Shower</label>
                                                        </div>
                                                        <!-- Checkboxes / End -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabs_2">
                                    <div class="rld-main-search">
                                        <div class="row">
                                            <div class="rld-single-input">
                                                <input type="text" placeholder="Enter Keyword...">
                                            </div>
                                            <div class="rld-single-select ml-22">
                                                <select class="select single-select">
                                                    <option value="1">Property Type</option>
                                                    <option value="2">Family House</option>
                                                    <option value="3">Apartment</option>
                                                    <option value="3">Condo</option>
                                                </select>
                                            </div>
                                            <div class="rld-single-select">
                                                <select class="select single-select mr-0">
                                                    <option value="1">Location</option>
                                                    <option value="2">Los Angeles</option>
                                                    <option value="3">Chicago</option>
                                                    <option value="3">Philadelphia</option>
                                                    <option value="3">San Francisco</option>
                                                    <option value="3">Miami</option>
                                                    <option value="3">Houston</option>
                                                </select>
                                            </div>
                                            <div class="dropdown-filter"><span>Advanced Search</span></div>
                                            <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                <a class="btn btn-yellow" href="#">Search Now</a>
                                            </div>
                                            <div class="explore__form-checkbox-list full-filter">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
                                                        <!-- Form Property Status -->
                                                        <div class="form-group categories">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current"><i class="fa fa-home"></i>Property
                                                                    Status</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option selected ">
                                                                        For Sale</li>
                                                                    <li data-value="2" class="option">For Rent
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Property Status -->
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">
                                                        <!-- Form Bedrooms -->
                                                        <div class="form-group beds">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current"><i class="fa fa-bed"
                                                                        aria-hidden="true"></i>
                                                                    Bedrooms</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option selected">1
                                                                    </li>
                                                                    <li data-value="2" class="option">2</li>
                                                                    <li data-value="3" class="option">3</li>
                                                                    <li data-value="3" class="option">4</li>
                                                                    <li data-value="3" class="option">5</li>
                                                                    <li data-value="3" class="option">6</li>
                                                                    <li data-value="3" class="option">7</li>
                                                                    <li data-value="3" class="option">8</li>
                                                                    <li data-value="3" class="option">9</li>
                                                                    <li data-value="3" class="option">10</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Bedrooms -->
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 py-1 pl-0 pr-0">
                                                        <!-- Form Bathrooms -->
                                                        <div class="form-group bath">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current"><i class="fa fa-bath"
                                                                        aria-hidden="true"></i>
                                                                    Bathrooms</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option selected">1
                                                                    </li>
                                                                    <li data-value="2" class="option">2</li>
                                                                    <li data-value="3" class="option">3</li>
                                                                    <li data-value="3" class="option">4</li>
                                                                    <li data-value="3" class="option">5</li>
                                                                    <li data-value="3" class="option">6</li>
                                                                    <li data-value="3" class="option">7</li>
                                                                    <li data-value="3" class="option">8</li>
                                                                    <li data-value="3" class="option">9</li>
                                                                    <li data-value="3" class="option">10</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Bathrooms -->
                                                    </div>
                                                    <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld">
                                                        <!-- Price Fields -->
                                                        <div class="main-search-field-2">
                                                            <!-- Area Range -->
                                                            <div class="range-slider">
                                                                <label>Area Size</label>
                                                                <div id="area-range-rent" data-min="0" data-max="1300"
                                                                    data-unit="sq ft"></div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <br>
                                                            <!-- Price Range -->
                                                            <div class="range-slider">
                                                                <label>Price Range</label>
                                                                <div id="price-range-rent" data-min="0"
                                                                    data-max="600000" data-unit="$"></div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                        <!-- Checkboxes -->
                                                        <div class="checkboxes one-in-row margin-bottom-10 ch-1">
                                                            <input id="check-16" type="checkbox" name="check">
                                                            <label for="check-16">Air Conditioning</label>
                                                            <input id="check-17" type="checkbox" name="check">
                                                            <label for="check-17">Swimming Pool</label>
                                                            <input id="check-18" type="checkbox" name="check">
                                                            <label for="check-18">Central Heating</label>
                                                            <input id="check-19" type="checkbox" name="check">
                                                            <label for="check-19">Laundry Room</label>
                                                            <input id="check-20" type="checkbox" name="check">
                                                            <label for="check-20">Gym</label>
                                                            <input id="check-21" type="checkbox" name="check">
                                                            <label for="check-21">Alarm</label>
                                                            <input id="check-22" type="checkbox" name="check">
                                                            <label for="check-22">Window Covering</label>
                                                        </div>
                                                        <!-- Checkboxes / End -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                        <!-- Checkboxes -->
                                                        <div class="checkboxes one-in-row margin-bottom-10 ch-2">
                                                            <input id="check-23" type="checkbox" name="check">
                                                            <label for="check-23">WiFi</label>
                                                            <input id="check-24" type="checkbox" name="check">
                                                            <label for="check-24">TV Cable</label>
                                                            <input id="check-25" type="checkbox" name="check">
                                                            <label for="check-25">Dryer</label>
                                                            <input id="check-26" type="checkbox" name="check">
                                                            <label for="check-26">Microwave</label>
                                                            <input id="check-27" type="checkbox" name="check">
                                                            <label for="check-27">Washer</label>
                                                            <input id="check-28" type="checkbox" name="check">
                                                            <label for="check-28">Refrigerator</label>
                                                            <input id="check-29" type="checkbox" name="check">
                                                            <label for="check-29">Outdoor Shower</label>
                                                        </div>
                                                        <!-- Checkboxes / End -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Search Form -->
                </div>
            </div>
        </div>
    </section>
    <!-- END HEADER SEARCH -->

    <!-- START SECTION PROPERTIES FOR SALE -->
    <section class="featured portfolio bg-white-2 rec-pro">
        <div class="container-fluid">
            <div class="sec-title">
                <h2><span>Properties for </span>Sale</h2>
                <p>We provide full service at every step.</p>
            </div>
            <div class="portfolio col-xl-12">
                <div class="slick-lancers2">
                    <div class="agents-grid" data-aos="fade-up" data-aos-delay="150">
                        <div class="landscapes">
                            <div class="project-single">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt featured">Featured</div>
                                            <div class="homes-tag button alt sale">For Sale</div>
                                            <img src="{{ asset('frontpage/images/blog/b-11.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 350,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people">
                            <div class="project-single" data-aos="fade-up" data-aos-delay="250">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt sale">For Sale</div>
                                            <img src="{{ asset('frontpage/images/blog/b-12.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 350,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people landscapes no-pb pbp-3">
                            <div class="project-single" data-aos="fade-up" data-aos-delay="350">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt sale">For Sale</div>
                                            <img src="{{ asset('frontpage/images/blog/b-1.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 350,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="landscapes">
                            <div class="project-single no-mb" data-aos="fade-up" data-aos-delay="450">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt featured">Featured</div>
                                            <div class="homes-tag button alt sale">For Sale</div>
                                            <img src="{{ asset('frontpage/images/feature-properties/fp-10.jpg') }}"
                                                alt="home-1" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="properties-details.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 350,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people">
                            <div class="project-single no-mb" data-aos="fade-up" data-aos-delay="550">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt sale">For Sale</div>
                                            <img src="{{ asset('frontpage/images/feature-properties/fp-11.jpg') }}"
                                                alt="home-1" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 350,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people landscapes no-pb pbp-3">
                            <div class="project-single no-mb last" data-aos="fade-up">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt sale">For Sale</div>
                                            <img src="{{ asset('frontpage/images/feature-properties/fp-12.jpg') }}"
                                                alt="home-1" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 350,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="landscapes">
                            <div class="project-single" data-aos="fade-up">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt featured">Featured</div>
                                            <div class="homes-tag button alt sale">For Sale</div>
                                            <img src="{{ asset('frontpage/images/blog/b-11.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 350,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people">
                            <div class="project-single" data-aos="fade-up">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt sale">For Sale</div>
                                            <img src="{{ asset('frontpage/images/blog/b-12.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 350,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION PROPERTIES FOR SALE -->

    <!-- START SECTION WHY CHOOSE US -->
    <section class="how-it-works bg-white">
        <div class="container">
            <div class="sec-title">
                <h2><span>Why </span>Choose Us</h2>
                <p>We provide full service at every step.</p>
            </div>
            <div class="row service-1">
                <article class="col-lg-4 col-md-6 col-xs-12 serv" data-aos="zoom-in" data-aos-delay="150">
                    <div class="serv-flex">
                        <div class="art-1 img-13">
                            <img src="{{ asset('frontpage/images/icons/icon-12.svg') }}" alt="">
                            <h3>Wide Renge Of Properties</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">lorem ipsum dolor sit amet, consectetur pro adipisici
                                consectetur debits adipisicing lacus consectetur Business Directory.</p>
                        </div>
                    </div>
                </article>
                <article class="col-lg-4 col-md-6 col-xs-12 serv" data-aos="zoom-in" data-aos-delay="250">
                    <div class="serv-flex">
                        <div class="art-1 img-14">
                            <img src="{{ asset('frontpage/images/icons/icon-13.svg') }}" alt="">
                            <h3>Trusted by thousands</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">lorem ipsum dolor sit amet, consectetur pro adipisici
                                consectetur debits adipisicing lacus consectetur Business Directory.</p>
                        </div>
                    </div>
                </article>
                <article class="col-lg-4 col-md-6 col-xs-12 serv mb-0 pt" data-aos="zoom-in" data-aos-delay="350">
                    <div class="serv-flex arrow">
                        <div class="art-1 img-15">
                            <img src="{{ asset('frontpage/images/icons/icon-14.svg') }}" alt="">
                            <h3>Financing made easy</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">lorem ipsum dolor sit amet, consectetur pro adipisici
                                consectetur debits adipisicing lacus consectetur Business Directory.</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <!-- END SECTION WHY CHOOSE US -->

    <!-- START SECTION PROPERTIES FOR RENT -->
    <section class="featured portfolio bg-white-2 rec-pro">
        <div class="container-fluid">
            <div class="sec-title">
                <h2><span>Properties for </span>Rent</h2>
                <p>We provide full service at every step.</p>
            </div>
            <div class="portfolio col-xl-12">
                <div class="slick-lancers">
                    <div class="agents-grid" data-aos="fade-up" data-aos-delay="150">
                        <div class="landscapes">
                            <div class="project-single">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt featured">Featured</div>
                                            <div class="homes-tag button sale rent">For Rent</div>
                                            <img src="{{ asset('frontpage/images/blog/b-5.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 120,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people">
                            <div class="project-single" data-aos="fade-up" data-aos-delay="250">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button sale rent">For Rent</div>
                                            <img src="{{ asset('frontpage/images/blog/b-6.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 120,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people landscapes no-pb pbp-3">
                            <div class="project-single" data-aos="fade-up" data-aos-delay="350">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button sale rent">For Rent</div>
                                            <img src="{{ asset('frontpage/images/blog/b-7.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 120,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="landscapes">
                            <div class="project-single no-mb" data-aos="fade-up" data-aos-delay="450">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt featured">Featured</div>
                                            <div class="homes-tag button sale rent">For Rent</div>
                                            <img src="{{ asset('frontpage/images/feature-properties/fp-8.jpg') }}"
                                                alt="home-1" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="properties-details.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 120,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people">
                            <div class="project-single no-mb" data-aos="fade-up">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button sale rent">For Rent</div>
                                            <img src="{{ asset('frontpage/images/feature-properties/fp-11.jpg') }}"
                                                alt="home-1" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 120,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people landscapes no-pb pbp-3">
                            <div class="project-single no-mb last" data-aos="fade-up">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button sale rent">For Rent</div>
                                            <img src="{{ asset('frontpage/images/feature-properties/fp-12.jpg') }}"
                                                alt="home-1" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 120,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="landscapes">
                            <div class="project-single" data-aos="fade-up">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt featured">Featured</div>
                                            <div class="homes-tag button sale rent">For Rent</div>
                                            <img src="{{ asset('frontpage/images/blog/b-11.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 120,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-grid">
                        <div class="people">
                            <div class="project-single" data-aos="fade-up">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button sale rent">For Rent</div>
                                            <img src="{{ asset('frontpage/images/blog/b-12.jpg') }}" alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                            class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="single-property-1.html">
                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South,
                                                NYC</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>6 Beds</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>3 Baths</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-square" aria-hidden="true"></i>
                                            <span>720 sq ft</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="single-property-1.html">$ 120,000</a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Compare">
                                                <i class="flaticon-compare"></i>
                                            </a>
                                            <a href="#" title="Share">
                                                <i class="flaticon-share"></i>
                                            </a>
                                            <a href="#" title="Favorites">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION PROPERTIES FOR RENT -->

    <!-- START SECTION POPULAR PLACES -->
    <section class="popular-places bg-white">
        <div class="container">
            <div class="sec-title">
                <h2><span>Popular </span>Places</h2>
                <p>Properties In Most Popular Places.</p>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 col-xl-4" data-aos="zoom-in" data-aos-delay="150">
                    <!-- Image Box -->
                    <a href="properties-map.html" class="img-box hover-effect">
                        <img src="{{ asset('frontpage/images/popular-places/12.jpg') }}" class="img-responsive"
                            alt="">
                        <!-- Badge -->
                        <div class="listing-badges">
                            <span class="featured">Featured</span>
                        </div>
                        <div class="img-box-content visible">
                            <h4>New York City </h4>
                            <span>203 Properties</span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4" data-aos="zoom-in" data-aos-delay="250">
                    <!-- Image Box -->
                    <a href="properties-map.html" class="img-box hover-effect">
                        <img src="{{ asset('frontpage/images/popular-places/13.jpg') }}" class="img-responsive"
                            alt="">
                        <div class="img-box-content visible">
                            <h4>Los Angeles</h4>
                            <span>307 Properties</span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4" data-aos="zoom-in" data-aos-delay="350">
                    <!-- Image Box -->
                    <a href="properties-map.html" class="img-box hover-effect">
                        <img src="{{ asset('frontpage/images/popular-places/14.jpg') }}" class="img-responsive"
                            alt="">
                        <div class="img-box-content visible">
                            <h4>San Francisco </h4>
                            <span>409 Properties</span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4" data-aos="zoom-in" data-aos-delay="150">
                    <!-- Image Box -->
                    <a href="properties-map.html" class="img-box hover-effect">
                        <img src="{{ asset('frontpage/images/popular-places/15.jpg') }}" class="img-responsive"
                            alt="">
                        <div class="img-box-content visible">
                            <h4>Miami </h4>
                            <span>145 Properties</span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4" data-aos="zoom-in" data-aos-delay="250">
                    <!-- Image Box -->
                    <a href="properties-map.html" class="img-box hover-effect no-mb">
                        <img src="{{ asset('frontpage/images/popular-places/10.jpg') }}" class="img-responsive"
                            alt="">
                        <div class="img-box-content visible">
                            <h4>Chicago</h4>
                            <span>276 Properties</span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4" data-aos="zoom-in" data-aos-delay="350">
                    <!-- Image Box -->
                    <a href="properties-map.html" class="img-box hover-effect no-mb x3">
                        <img src="{{ asset('frontpage/images/popular-places/5.jpg') }}" class="img-responsive"
                            alt="">
                        <!-- Badge -->
                        <div class="listing-badges">
                            <span class="featured">Featured</span>
                        </div>
                        <div class="img-box-content visible">
                            <h4>Houston </h4>
                            <span>321 Properties</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION POPULAR PLACES -->

    <!-- START SECTION INFO-HELP -->
    <section class="info-help h17">
        <div class="container">
            <div class="row info-head">
                <div class="col-lg-6 col-md-8 col-xs-8" data-aos="fade-right">
                    <div class="info-text">
                        <h3>Apartment for rent</h3>
                        <h5 class="mt-3">$6,400/month</h5>
                        <p class="pt-2">We Help you find the best places and offer near you. Bring to the table
                            win-win survival strategies to ensure proactive domination going forward.</p>
                        <div class="inf-btn pro">
                            <a href="contact-us.html" class="btn btn-pro btn-secondary btn-lg">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-3"></div>
            </div>
        </div>
    </section>
    <!-- END SECTION INFO-HELP -->

    <!-- START SECTION TESTIMONIALS -->
    <section class="testimonials bg-white-2">
        <div class="container">
            <div class="sec-title">
                <h2><span>Clients </span>Testimonials</h2>
                <p>We collect reviews from our customers.</p>
            </div>
            <div class="owl-carousel job_clientSlide">
                <div class="singleJobClinet" data-aos="fade-right">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore gna a. Ut enim ad minim veniam,
                    </p>
                    <div class="detailJC">
                        <span><img src="{{ asset('frontpage/images/testimonials/ts-1.jpg') }}" alt="" /></span>
                        <h5>Lisa Smith</h5>
                        <p>New York</p>
                    </div>
                </div>
                <div class="singleJobClinet" data-aos="fade-left">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore gna a. Ut enim ad minim veniam,
                    </p>
                    <div class="detailJC">
                        <span><img src="{{ asset('frontpage/images/testimonials/ts-2.jpg') }}" alt="" /></span>
                        <h5>Jhon Morris</h5>
                        <p>Los Angeles</p>
                    </div>
                </div>
                <div class="singleJobClinet">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore gna a. Ut enim ad minim veniam,
                    </p>
                    <div class="detailJC">
                        <span><img src="{{ asset('frontpage/images/testimonials/ts-3.jpg') }}" alt="" /></span>
                        <h5>Mary Deshaw</h5>
                        <p>Chicago</p>
                    </div>
                </div>
                <div class="singleJobClinet">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore gna a. Ut enim ad minim veniam,
                    </p>
                    <div class="detailJC">
                        <span><img src="{{ asset('frontpage/images/testimonials/ts-4.jpg') }}" alt="" /></span>
                        <h5>Gary Steven</h5>
                        <p>Philadelphia</p>
                    </div>
                </div>
                <div class="singleJobClinet">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore gna a. Ut enim ad minim veniam,
                    </p>
                    <div class="detailJC">
                        <span><img src="{{ asset('frontpage/images/testimonials/ts-5.jpg') }}" alt="" /></span>
                        <h5>Cristy Mayer</h5>
                        <p>San Francisco</p>
                    </div>
                </div>
                <div class="singleJobClinet">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore gna a. Ut enim ad minim veniam,
                    </p>
                    <div class="detailJC">
                        <span><img src="{{ asset('frontpage/images/testimonials/ts-6.jpg') }}" alt="" /></span>
                        <h5>Ichiro Tasaka</h5>
                        <p>Houston</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION TESTIMONIALS -->

    <!-- START SECTION BLOG -->
    <section class="blog-section bg-white">
        <div class="container">
            <div class="sec-title">
                <h2><span>Articles &amp; </span>Tips</h2>
                <p>Read the latest news from our blog.</p>
            </div>
            <div class="news-wrap">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-xs-12">
                        <div class="news-item" data-aos="fade-up" data-aos-delay="200">
                            <a href="blog-details.html" class="news-img-link">
                                <div class="news-item-img">
                                    <img class="img-responsive" src="{{ asset('frontpage/images/blog/b-10.jpg') }}"
                                        alt="blog image">
                                </div>
                            </a>
                            <div class="news-item-text">
                                <a href="blog-details.html">
                                    <h3>Explore The World</h3>
                                </a>
                                <div class="dates">
                                    <span class="date">April 11, 2020 &nbsp;/</span>
                                    <ul class="action-list pl-0">
                                        <li class="action-item pl-2"><i class="fa fa-heart"></i>
                                            <span>306</span>
                                        </li>
                                        <li class="action-item"><i class="fa fa-comment"></i> <span>34</span>
                                        </li>
                                        <li class="action-item"><i class="fa fa-share-alt"></i> <span>122</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="news-item-descr big-news">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua ipsum dolor sit amet,
                                        consectetur.</p>
                                </div>
                                <div class="news-item-bottom">
                                    <a href="blog-details.html" class="news-link">Read more...</a>
                                    <div class="admin">
                                        <p>By, Karl Smith</p>
                                        <img src="{{ asset('frontpage/images/testimonials/ts-6.jpg') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-xs-12">
                        <div class="news-item" data-aos="fade-up" data-aos-delay="300">
                            <a href="blog-details.html" class="news-img-link">
                                <div class="news-item-img">
                                    <img class="img-responsive" src="{{ asset('frontpage/images/blog/b-11.jpg') }}"
                                        alt="blog image">
                                </div>
                            </a>
                            <div class="news-item-text">
                                <a href="blog-details.html">
                                    <h3>Find Good Places</h3>
                                </a>
                                <div class="dates">
                                    <span class="date">May 20, 2020 &nbsp;/</span>
                                    <ul class="action-list pl-0">
                                        <li class="action-item pl-2"><i class="fa fa-heart"></i>
                                            <span>306</span>
                                        </li>
                                        <li class="action-item"><i class="fa fa-comment"></i> <span>34</span>
                                        </li>
                                        <li class="action-item"><i class="fa fa-share-alt"></i> <span>122</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="news-item-descr big-news">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua ipsum dolor sit amet,
                                        consectetur.</p>
                                </div>
                                <div class="news-item-bottom">
                                    <a href="blog-details.html" class="news-link">Read more...</a>
                                    <div class="admin">
                                        <p>By, Lis Jhonson</p>
                                        <img src="{{ asset('frontpage/images/testimonials/ts-5.jpg') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-xs-12">
                        <div class="news-item no-mb" data-aos="fade-up" data-aos-delay="400">
                            <a href="blog-details.html" class="news-img-link">
                                <div class="news-item-img">
                                    <img class="img-responsive" src="{{ asset('frontpage/images/blog/b-12.jpg') }}"
                                        alt="blog image">
                                </div>
                            </a>
                            <div class="news-item-text">
                                <a href="blog-details.html">
                                    <h3>All Places In Town</h3>
                                </a>
                                <div class="dates">
                                    <span class="date">Jun 30, 2020 &nbsp;/</span>
                                    <ul class="action-list pl-0">
                                        <li class="action-item pl-2"><i class="fa fa-heart"></i>
                                            <span>306</span>
                                        </li>
                                        <li class="action-item"><i class="fa fa-comment"></i> <span>34</span>
                                        </li>
                                        <li class="action-item"><i class="fa fa-share-alt"></i> <span>122</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="news-item-descr big-news">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua ipsum dolor sit amet,
                                        consectetur.</p>
                                </div>
                                <div class="news-item-bottom">
                                    <a href="blog-details.html" class="news-link">Read more...</a>
                                    <div class="admin">
                                        <p>By, Ted Willians</p>
                                        <img src="{{ asset('frontpage/images/testimonials/ts-4.jpg') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION BLOG -->

    <!-- STAR SECTION PARTNERS -->
    <div class="partners bg-white">
        <div class="container">
            <div class="sec-title">
                <h2><span>Our </span>Partners</h2>
                <p>The Companies That Represent Us.</p>
            </div>
            <div class="owl-carousel style2">
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/11.jpg') }}"
                        alt="">
                </div>
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/12.jpg') }}"
                        alt="">
                </div>
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/13.jpg') }}"
                        alt="">
                </div>
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/14.jpg') }}"
                        alt="">
                </div>
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/15.jpg') }}"
                        alt="">
                </div>
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/16.jpg') }}"
                        alt="">
                </div>
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/17.jpg') }}"
                        alt="">
                </div>
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/11.jpg') }}"
                        alt="">
                </div>
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/12.jpg') }}"
                        alt="">
                </div>
                <div class="owl-item" data-aos="fade-up"><img src="{{ asset('frontpage/images/partners/13.jpg') }}"
                        alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION PARTNERS -->
@endsection
