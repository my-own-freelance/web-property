@extends('layouts.frontpage')
@section('title', $title)
<style>
    .dropdown-filter span::after,
    .inner-pages.hp-6.full .btn.btn-yellow:hover {
        color: #8731E8 !important;
    }

    #search-property {
        background-color: #8731E8 !important;
        border: 1px solid #8731E8 !important;
    }

    #search-property:hover {
        background-color: white !important;
        color: #8731E8 !important;
    }

    .button-effect a i {
        margin-top: 18px !important;
    }
</style>
@section('content')
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="properties-list featured portfolio blog">
        <div class="container">
            <section class="headings-2 pt-0 pb-0">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p><a href="{{ route('home') }}">Home </a> &nbsp;/&nbsp; <span>List Properti</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Search Form -->
            <div class="col-12 px-0 parallax-searchs">
                <div class="banner-search-wrap">
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
                                        <a class="btn btn-yellow" onclick="searchProperty()" id="search-property">Cari
                                            Sekarang</a>
                                    </div>
                                    <div class="explore__form-checkbox-list full-filter" style="margin-top: 20px">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 py-1 pr-30 pl-0">
                                                <!-- Form Property Sertiticate -->
                                                <div class="form-group certificate" id="fPropCertificate"
                                                    style="margin-bottom: 0px !important;">
                                                    <div class="nice-select form-control wide" tabindex="0">
                                                        <span class="current">
                                                            <i class="fas fa-file-contract"></i>Tipe Sertifikat
                                                        </span>
                                                        <ul class="list" id="certificate-list">
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
                                            <div class="col-lg-3 col-md-6 py-1 pr-30 pl-0 ">
                                                <!-- Form Property Warranry -->
                                                <div class="form-group warranty" id="fWarranty"
                                                    style="margin-bottom: 0px !important;">
                                                    <div class="nice-select form-control wide" tabindex="0">
                                                        <span class="current">
                                                            <i class="fas fa-shield-alt"></i>Garansi
                                                        </span>
                                                        <ul class="list" id="warranty-list">
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
                                                        <ul class="list" id="bedrooms-list">
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
                                                        <ul class="list" id="bathrooms-list">
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
                                                                <li data-value="{{ $provinsi->id }}" class="option">
                                                                    {{ $provinsi->name }}</li>
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

                                            {{-- <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld"
                                            style="visibility: hidden; height: 0px!important;" >
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
                                            <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30"style="visibility: hidden; height: 0px!important;">
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
                                            <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30"
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Search Form -->

            <div class="row">
                @forelse ($properties as $properti)
                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                        <div class="project-single">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="{{ $properti->url }}" class="homes-img">
                                        <div class="homes-tag button alt featured">
                                            {{ $properti->transaction }}
                                        </div>
                                        <div class="homes-tag button alt sale">{{ $properti->type }}</div>
                                        <img src="{{ $properti->image }}" alt="{{ $properti->short_title }}"
                                            class="img-responsive">
                                    </a>
                                </div>
                                <div class="button-effect">
                                    <a href="{{ $properti->url }}" class="btn">
                                        <i class="fa fa-link"></i>
                                    </a>
                                    @if ($properti->youtube)
                                        <a href="{{ $properti->youtube }}" class="btn popup-video popup-youtube">
                                            <i class="fas fa-video"></i>
                                        </a>
                                    @endif
                                    <a href="{{ $properti->url }}" class="img-poppu btn">
                                        <i class="fa fa-photo"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- homes content -->
                            <div class="homes-content">
                                <a href="{{ $properti->url }}" style="text-decoration: none; cursor: pointer;">
                                    <div style="height: 100px">
                                        <!-- homes address -->
                                        <h3>
                                            {{ Illuminate\Support\Str::limit(strip_tags($properti->short_title), 35) }}
                                        </h3>
                                        <p class="homes-address text-muted">
                                            <i class="fa fa-map-marker"></i>
                                            <span>&nbsp;&nbsp;{{ $properti->location }}</span>
                                            <br>
                                            <i class="fas fa-tag"></i>
                                            <span>&nbsp;{{ $properti->code }}</span>
                                        </p>
                                    </div>
                                    <hr style="margin:2px 0px !important;">
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix" style="height: 90px; padding-top: 0px !important;">
                                        <li class="the-icons">
                                            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                            <span>{{ $properti->bedrooms ? $properti->bedrooms : 0 }} K. Tidur</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                            <span>{{ $properti->bathrooms ? $properti->bathrooms : 0 }} K. Mandi</span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="fas fa-object-group " style="color: #c4c4c4;"
                                                aria-hidden="true"></i>
                                            <span>
                                                {{ $properti->land_sale_area ? $properti->land_sale_area : 0 }}
                                                m<sup>2</sup>
                                            </span>
                                        </li>
                                        <li class="the-icons">
                                            <i class="fas fa-home" style="color: #c4c4c4;" aria-hidden="true"></i>
                                            <span>
                                                {{ $properti->building_sale_area ? $properti->building_sale_area : 0 }}
                                                m<sup>2</sup>
                                            </span>
                                        </li>
                                    </ul>
                                </a>
                                <div class="price-properties footer">
                                    <h3 class="title mt-3">
                                        <a href="{{ $properti->url }}">Rp.
                                            {{ number_format($properti->price, 0, ',', '.') }}</a>
                                    </h3>
                                </div>
                                <div class="footer" style="display: flex; justify-content: space-between;">
                                    <a href="{{ $properti->agen_url }}">
                                        <img src="{{ $properti->agen_image }}" alt="" style="object-fit: cover;"
                                            class="mr-2">
                                        {{ $properti->agen }}
                                    </a>
                                    <a href="{{ $properti->whatsapp }}" class="mt-2" target="__blank">
                                        <i class="fa fa-whatsapp"></i> Hubungi Saya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
            <nav aria-label="..." class="pt-3">
                {{ $properties->links() }}
            </nav>
        </div>
    </section>
    <!-- END SECTION PROPERTIES LISTING -->
@endsection
