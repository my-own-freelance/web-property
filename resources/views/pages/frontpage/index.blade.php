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
                            <h1 class="title text-center">Temukan Properti Impianmu</h1>
                            <h5 class="sub-title text-center">Kami Memiliki Lebih dari Jutaan Properti Untuk Anda</h5>
                        </div>
                    </div>
                    <!-- Search Form -->
                    <div class="col-12">
                        <div class="banner-search-wrap" data-aos="zoom-in">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tabs_1">
                                    <div class="rld-main-search">
                                        <div class="row">
                                            <div class="rld-single-input">
                                                <input type="text" id="fSearch" placeholder="Masukan Kata Kunci...">
                                            </div>
                                            <div class="rld-single-select ml-22">
                                                <select class="select single-select" id="fPropTransaction">
                                                    <option value="">Tipe Transaksi</option>
                                                    @forelse ($transactions as $propTrx)
                                                        <option value="{{ $propTrx->id }}">{{ $propTrx->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="rld-single-select">
                                                <select class="select single-select mr-0" id="fPropType">
                                                    <option value="">Tipe Properti</option>
                                                    @forelse ($types as $propType)
                                                        <option value="{{ $propType->id }}">{{ $propType->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="dropdown-filter"><span>Filter Tambahan</span></div>
                                            <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                <a class="btn btn-yellow" onclick="searchProperty()">Cari Sekarang</a>
                                            </div>
                                            <div class="explore__form-checkbox-list full-filter">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 py-1 pr-30 pl-0">
                                                        <!-- Form Property Sertiticate -->
                                                        <div class="form-group certificate" id="fPropCertificate"
                                                            style="margin-bottom: 0px !important;">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current">
                                                                    <i class="fas fa-file-contract"></i>Tipe Sertifikat
                                                                </span>
                                                                <ul class="list scrollable-list" id="certificate-list">
                                                                    @forelse ($certificates as $crt)
                                                                        <li data-value="{{ $crt->id }}" class="option">
                                                                            {{ $crt->name }}</li>
                                                                    @empty
                                                                    @endforelse
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Property Sertiticate -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 py-1 pr-30 pl-0">
                                                        <!-- Form Property Warranry -->
                                                        <div class="form-group warranty" id="fWarranty"
                                                            style="margin-bottom: 0px !important;">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current">
                                                                    <i class="fas fa-shield-alt"></i>Garansi
                                                                </span>
                                                                <ul class="list scrollable-list" id="warranty-list">
                                                                    <li data-value="Y" class="option">Ya</li>
                                                                    <li data-value="N" class="option">Tidak</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Property Warranty -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 py-1 pr-30 pl-0 ">
                                                        <!-- Form Bedrooms -->
                                                        <div class="form-group bedrooms" if="fBedRooms"
                                                            style="margin-bottom: 0px !important;">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current">
                                                                    <i class="fa fa-bed" aria-hidden="true"></i>Kamar Tidur
                                                                </span>
                                                                <ul class="list scrollable-list" id="bedrooms-list">
                                                                    <li data-value="1" class="option">1</li>
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
                                                    <div class="col-lg-3 col-md-6 py-1 pr-30 pl-0">
                                                        <!-- Form Bathrooms -->
                                                        <div class="form-group bathrooms" id="fBathRooms"
                                                            style="margin-bottom: 0px !important;">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current">
                                                                    <i class="fa fa-bath" aria-hidden="true"></i>Kamar
                                                                    Mandi
                                                                </span>
                                                                <ul class="list scrollable-list" id="bathrooms-list">
                                                                    <li data-value="1" class="option">1
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

                                                    <div class="col-lg-3 col-md-6 py-1 pr-30 pl-0">
                                                        <!-- Form Property Province -->
                                                        <div class="form-group warranty" id="province_id"
                                                            style="margin-bottom: 0px !important;">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current">
                                                                    <i class="fas fa-map-marked-alt"></i>Provinsi
                                                                </span>
                                                                <ul class="list scrollable-list" id="province-list">
                                                                    @forelse ($provinces as $provinsi)
                                                                        <li data-value="{{ $provinsi->id }}"
                                                                            class="option">{{ $provinsi->name }}</li>
                                                                    @empty
                                                                    @endforelse
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Property Province -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 py-1 pr-30 pl-0">
                                                        <!-- Form Property District -->
                                                        <div class="form-group warranty" id="district_id"
                                                            style="margin-bottom: 0px !important;">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current">
                                                                    <i class="fas fa-city"></i>Kota/Kabupaten
                                                                </span>
                                                                <ul class="list scrollable-list" id="district-list">

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Property District -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 py-1 pr-30 pl-0">
                                                        <!-- Form Property Sub District -->
                                                        <div class="form-group warranty" id="sub_district_id"
                                                            style="margin-bottom: 0px !important;">
                                                            <div class="nice-select form-control wide" tabindex="0">
                                                                <span class="current">
                                                                    <i class="fas fa-map-pin"></i>Kecamatan
                                                                </span>
                                                                <ul class="list scrollable-list" id="sub-district-list">

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--/ End Form Property Sub District -->
                                                    </div>

                                                    {{--   VIEW DI HIDDEN KARENA TIDAK BISA DI HAPUS --}}
                                                    {{-- <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld d-xl-flex "
                                                        style="visibility: hidden; height: 0px!important;">
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
                                                    <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 d-xl-flex"
                                                        style="visibility: hidden; height: 0px!important;">
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
                                                    </div> --}}
                                                    <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 d-xl-flex"
                                                        style="visibility: hidden; height: 0px!important;">
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

                                                    {{--   END VIEW DI HIDDEN KARENA TIDAK BISA DI HAPUS --}}

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
                <h2><span>Properti </span>Terpopuler</h2>
                <p>Kami memberikan layanan penuh di setiap langkah..</p>
            </div>
            <div class="portfolio col-xl-12">
                <div class="slick-lancers2">
                    @forelse ($popularProperties as $popProp)
                        <div class="agents-grid" data-aos="fade-up" data-aos-delay="150">
                            <div class="landscapes">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="{{ $popProp->url }}" class="homes-img">
                                                <div class="homes-tag button alt featured">{{ $popProp->transaction }}
                                                </div>
                                                <div class="homes-tag button alt sale">{{ $popProp->type }}</div>
                                                <img src="{{ $popProp->image }}" alt="{{ $popProp->short_title }}"
                                                    class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="{{ $popProp->url }}" class="btn"><i class="fa fa-link"></i></a>
                                            @if ($popProp->youtube)
                                                <a href="{{ $popProp->youtube }}" class="btn popup-video popup-youtube">
                                                    <i class="fas fa-video"></i>
                                                </a>
                                            @endif
                                            <a href="{{ $popProp->url }}" class="img-poppu btn">
                                                <i class="fa fa-photo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <a href="{{ $popProp->url }}" style="text-decoration: none; cursor: pointer;">
                                            <div style="height: 100px">
                                                <!-- homes address -->
                                                <h3>
                                                    {{ Illuminate\Support\Str::limit(strip_tags($popProp->short_title), 35) }}
                                                </h3>
                                                <p class="homes-address text-muted">
                                                    <i class="fa fa-map-marker"></i>
                                                    <span>&nbsp;&nbsp;{{ $popProp->location }}</span>
                                                    <br>
                                                    <i class="fas fa-tag"></i>
                                                    <span>&nbsp;{{ $popProp->code }}</span>
                                                </p>
                                            </div>
                                            <hr style="margin: 2px 0px !important;">
                                            <!-- homes List -->
                                            <ul class="homes-list clearfix"
                                                style="height: 90px; padding-top: 0px !important;">
                                                <li class="the-icons">
                                                    <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                    <span>
                                                        {{ $popProp->bedrooms ? $popProp->bedrooms : 0 }} K. Tidur
                                                    </span>
                                                </li>
                                                <li class="the-icons">
                                                    <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                    <span>
                                                        {{ $popProp->bathrooms ? $popProp->bathrooms : 0 }} K.
                                                        Mandi
                                                    </span>
                                                </li>
                                                <li class="the-icons">
                                                    <i class="fas fa-object-group " style="color: #c4c4c4;"
                                                        aria-hidden="true"></i>
                                                    <span>
                                                        {{ $popProp->land_sale_area ? $popProp->land_sale_area : 0 }}
                                                        m<sup>2</sup>
                                                    </span>
                                                </li>

                                                <li class="the-icons">
                                                    <i class="fas fa-home" style="color: #c4c4c4;"
                                                        aria-hidden="true"></i>
                                                    <span>
                                                        {{ $popProp->building_sale_area ? $popProp->building_sale_area : 0 }}
                                                        m<sup>2</sup>
                                                    </span>
                                                </li>
                                            </ul>
                                        </a>
                                        <div class="price-properties footer" style="padding-top: 0px !important;">
                                            <h3 class="title mt-3">
                                                <a href="{{ $popProp->url }}">Rp.
                                                    {{ number_format($popProp->price, 0, ',', '.') }}</a>
                                            </h3>
                                        </div>
                                        <div class="footer" style="display: flex; justify-content: space-between;">
                                            <a href="{{ $popProp->agen_url }}">
                                                <img src="{{ $popProp->agen_image }}" style="object-fit: cover;"
                                                    alt="" class="mr-2">
                                                {{ $popProp->agen }}
                                            </a>
                                            <a href="{{ $popProp->whatsapp }}" class="mt-2" target="__blank">
                                                <i class="fa fa-whatsapp"></i> Hubungi Saya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION PROPERTIES FOR SALE -->

    <!-- START SECTION WHY CHOOSE US -->
    <section class="how-it-works bg-white">
        <div class="container">
            <div class="sec-title">
                <h2><span>Kenapa </span>Memilih Kami</h2>
                <p>Kami memberikan layanan penuh di setiap langkah.</p>
            </div>
            <div class="row service-1">
                @forelse ($reasonToChooseUs as $reason)
                    <article class="col-lg-4 col-md-6 col-xs-12 serv" data-aos="zoom-in" data-aos-delay="150">
                        <div class="serv-flex">
                            <div class="art-1 img-13">
                                <img src="{{ $reason->icon }}" alt="{{ $reason->title }}">
                                <h3>{{ $reason->title }}</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">{{ $reason->description }}</p>
                            </div>
                        </div>
                    </article>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <!-- END SECTION WHY CHOOSE US -->

    <!-- START SECTION PROPERTIES FOR RENT -->
    <section class="featured portfolio bg-white-2 rec-pro">
        @forelse ($propertiesByTrx as $propByTrx)
            <div class="container-fluid" style="margin-bottom: 50px !important;">
                <div class="sec-title">
                    <h2><span>Properti </span>{{ $propByTrx->transaction }}</h2>
                    <p>Kami memberikan layanan penuh di setiap langkah..</p>
                </div>
                <div class="portfolio col-xl-12">
                    <div class="slick-lancers">
                        @forelse ($propByTrx->data as $propData)
                            <div class="agents-grid" data-aos="fade-up" data-aos-delay="150">
                                <div class="landscapes">
                                    <div class="project-single">
                                        <div class="project-inner project-head">
                                            <div class="homes">
                                                <!-- homes img -->
                                                <a href="{{ $propData->url }}" class="homes-img">
                                                    <div class="homes-tag button alt featured">
                                                        {{ $propByTrx->transaction }}
                                                    </div>
                                                    <div class="homes-tag button alt sale">{{ $propData->type }}</div>
                                                    <img src="{{ $propData->image }}" alt="{{ $propData->short_title }}"
                                                        class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="button-effect">
                                                <a href="{{ $propData->url }}" class="btn">
                                                    <i class="fa fa-link"></i>
                                                </a>
                                                @if ($propData->youtube)
                                                    <a href="{{ $propData->youtube }}"
                                                        class="btn popup-video popup-youtube">
                                                        <i class="fas fa-video"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ $propData->url }}" class="img-poppu btn">
                                                    <i class="fa fa-photo"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- homes content -->
                                        <div class="homes-content">
                                            <a href="{{ $propData->url }}"
                                                style="text-decoration: none; cursor: pointer;">
                                                <div style="height: 100px">
                                                    <!-- homes address -->
                                                    <h3>
                                                        {{ Illuminate\Support\Str::limit(strip_tags($propData->short_title), 35) }}
                                                    </h3>
                                                    <p class="homes-address text-muted">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span>&nbsp;&nbsp;{{ $propData->location }}</span>
                                                        <br>
                                                        <i class="fas fa-tag"></i>
                                                        <span>&nbsp;{{ $propData->code }}</span>
                                                    </p>
                                                    {{-- </a> --}}
                                                </div>
                                                <hr style="margin:2px 0px !important;">
                                                <!-- homes List -->
                                                <ul class="homes-list clearfix"
                                                    style="height: 90px; padding-top: 0px !important;">
                                                    <li class="the-icons">
                                                        <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                        <span>
                                                            {{ $propData->bedrooms ? $propData->bedrooms : 0 }} K. Tidur
                                                        </span>
                                                    </li>
                                                    <li class="the-icons">
                                                        <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                        <span>
                                                            {{ $propData->bathrooms ? $propData->bathrooms : 0 }} K. Mandi
                                                        </span>
                                                    </li>
                                                    <li class="the-icons">
                                                        <i class="fas fa-object-group " style="color: #c4c4c4;"
                                                            aria-hidden="true"></i>
                                                        <span>
                                                            {{ $propData->land_sale_area ? $propData->land_sale_area : 0 }}
                                                            m<sup>2</sup>
                                                        </span>
                                                    </li>
                                                    <li class="the-icons">
                                                        <i class="fas fa-home" style="color: #c4c4c4;"
                                                            aria-hidden="true"></i>
                                                        <span>
                                                            {{ $propData->building_sale_area ? $propData->building_sale_area : 0 }}
                                                            m<sup>2</sup>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </a>
                                            <div class="price-properties footer" style="padding-top: 0px !important;">
                                                <h3 class="title mt-3">
                                                    <a href="{{ $propData->url }}">Rp.
                                                        {{ number_format($propData->price, 0, ',', '.') }}</a>
                                                </h3>
                                            </div>
                                            <div class="footer" style="display: flex; justify-content: space-between;">
                                                <a href="{{ $propData->agen_url }}">
                                                    <img src="{{ $propData->agen_image }}" alt=""
                                                        style="object-fit: cover;" class="mr-2">
                                                    {{ $propData->agen }}
                                                </a>
                                                <a href="{{ $propData->whatsapp }}" class="mt-2" target="__blank">
                                                    <i class="fa fa-whatsapp"></i> Hubungi Saya
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-yellow" href="{{ route('property.list') }}">Semua Properti</a>
                </div>
            </div>
        @empty

        @endforelse
    </section>
    <!-- END SECTION PROPERTIES FOR RENT -->

    <!-- START SECTION POPULAR PLACES -->
    <section class="popular-places bg-white">
        <div class="container">
            <div class="sec-title">
                <h2><span>Tempat </span>Populer</h2>
                <p>Properti Di Tempat Paling Populer.</p>
            </div>
            <div class="row">
                @forelse ($topDistricts as $topDst)
                    <div class="col-sm-6 col-lg-4 col-xl-4" data-aos="zoom-in" data-aos-delay="150">
                        <!-- Image Box -->
                        <a href="{{ $topDst->url }}" class="img-box hover-effect">
                            <img src="{{ asset('frontpage/images/popular-places/' . $loop->iteration . '.jpg') }}"
                                class="img-responsive">
                            <div class="img-box-content visible">
                                <h4>{{ $topDst->name }} </h4>
                                <span>{{ $topDst->total_property }} Properti</span>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <!-- END SECTION POPULAR PLACES -->

    <!-- START SECTION TESTIMONIALS -->
    <section class="testimonials bg-white-2">
        <div class="container">
            <div class="sec-title">
                <h2><span>Testimoni </span>Pelanggan</h2>
                <p>Kami mengumpulkan ulasan dari pelanggan kami.</p>
            </div>
            <div class="owl-carousel job_clientSlide">
                @forelse ($reviews as $review)
                    <div class="singleJobClinet" data-aos="fade-right">
                        <p>
                            {{ $review->review }}
                        </p>
                        <div class="detailJC">
                            <span><img src="{{ $review->image }}" style="object-fit: cover;" alt="review" /></span>
                            <h5>{{ $review->name }}</h5>
                            <p>{{ $review->address }}</p>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <!-- END SECTION TESTIMONIALS -->

    <!-- START SECTION BLOG -->
    <section class="blog-section bg-white">
        <div class="container">
            <div class="sec-title">
                <h2><span>Artikel &amp; </span>Tips</h2>
                <p>Baca berita terbaru dari blog kami.</p>
            </div>
            <div class="news-wrap">
                <div class="row">
                    @forelse ($articles as $article)
                        <div class="col-xl-4 col-md-6 col-xs-12">
                            <div class="news-item" data-aos="fade-up" data-aos-delay="200">
                                <a href="{{ $article->url }}" class="news-img-link">
                                    <div class="news-item-img">
                                        <img class="img-responsive" src="{{ $article->image }}" alt="blog image">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href="{{ $article->url }}">
                                        <h3>{{ Illuminate\Support\Str::limit(strip_tags($article->title), 35) }}</h3>
                                    </a>
                                    <div class="dates">
                                        <span class="date">{{ $article->date }} &nbsp;/</span>
                                        <ul class="action-list pl-0">
                                            <li class="action-item pl-2">
                                                <span>{{ $article->views }}x dilihat</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="news-item-descr big-news">
                                        <p>{{ $article->excerpt }}</p>
                                    </div>
                                    <div class="news-item-bottom">
                                        <a href="{{ $article->url }}" class="news-link">Selengkapnya...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION BLOG -->

    <!-- STAR SECTION PARTNERS -->
    <div class="partners bg-white">
        <div class="container">
            <div class="sec-title">
                <h2><span>Partner</span> Kami</h2>
                <p>Perusahaan Partnet Kami</p>
            </div>
            <div class="owl-carousel style2">
                @forelse ($partnerships as $partner)
                    <div class="owl-item" data-aos="fade-up">
                        <img src="{{ $partner->image }}" alt="{{ $partner->name }}">
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <!-- END SECTION PARTNERS -->
@endsection
