@extends('layouts.frontpage')
@section('title', $title)
@push('metadata')
    <meta property="og:image" content="{{ $property->image }}" />
    <meta property="og:title" content="{{ $property->short_title }}" />
    <meta property="og:keywords" content="{{ $property->short_title }}" />
    <meta name="keywords" content="{{ $property->short_title }}" />
@endpush
@push('styles')
    <style>
        h5::after {
            background-color: #8731E8 !important;
        }

        span.category-tag {
            background-color: #8731E8 !important;
            color: white !important;
        }

        .listing-title-bar>h4,
        span>i {
            color: #8731E8 !important;
        }
    </style>
@endpush
@section('content')
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="single-proper blog details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="headings-2 pt-0">
                                <div class="pro-wrapper">
                                    <div class="row">
                                        <div class="col-md-7 col-12 ">
                                            <div class="detail-wrapper-body">
                                                <div class="listing-title-bar">
                                                    <h3>{{ $property->short_title }} <span
                                                            class="mrg-l-5 category-tag">{{ $property->property_transaction }}</span>
                                                    </h3>
                                                    <div class="mt-0">
                                                        <a href="#" class="listing-address">
                                                            <i class="fa fa-map-marker pr-2 ti-location-pin mrg-r-5"></i>
                                                            {{ $property->location }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-12 mt-3 mt-md-0">
                                            <div class="single text-right mr-2">
                                                <div class="detail-wrapper-body">
                                                    <div class="listing-title-bar">
                                                        <h4>Rp. {{ number_format($property->price, 0, ',', '.') }}</h4>
                                                        @if ($property->price_per_meter && $property->price_per_meter != 0)
                                                            <div class="mt-0">
                                                                <a href="" class="listing-address">
                                                                    <p>Rp.
                                                                        {{ number_format($property->price_per_meter, 0, ',', '.') }}
                                                                        / m<sup>2</sup></p>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- main slider carousel items -->
                            <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30">
                                <h5 class="mb-4">Gallery</h5>
                                <div class="carousel-inner">
                                    @forelse ($property->PropertyImages as $propImg)
                                        <div class="{{ $loop->index == 0 ? 'active' : '' }} item carousel-item"
                                            data-slide-number="{{ $loop->index }}">
                                            <img src="{{ $propImg->image }}" class="img-fluid"
                                                style="width: 100%; height: 400px!important; object-fit:cover"
                                                alt="slider-listing">
                                        </div>
                                    @empty
                                    @endforelse
                                    <a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev"><i
                                            class="fa fa-angle-left"></i></a>
                                    <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next"><i
                                            class="fa fa-angle-right"></i></a>

                                </div>
                                <!-- main slider carousel nav controls -->
                                <ul class="carousel-indicators smail-listing list-inline">
                                    @forelse ($property->PropertyImages as $propImg)
                                        <li class="list-inline-item active">
                                            <a id="carousel-selector-{{ $loop->index }}" class="selected"
                                                data-slide-to="{{ $loop->index }}" data-target="#listingDetailsSlider">
                                                <img src="{{ $propImg->image }}" class="img-fluid"
                                                    style="width: 100%; height: 80px !important; object-fit:cover"
                                                    alt="listing-small">
                                            </a>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                                <!-- main slider carousel items -->
                            </div>
                        </div>
                    </div>
                    <div class="single homes-content details mb-30">
                        <!-- title -->
                        <h5 class="mb-4">Detail Properti</h5>
                        <ul class="homes-list clearfix">
                            <li>
                                <span class="font-weight-bold mr-1">Status:</span>
                                <span
                                    class="text-white badge {{ $property->is_available == 'Y' ? 'badge-success' : 'badge-danger' }}">
                                    {{ $property->is_available == 'Y' ? 'Tersedia' : 'Tidak Tersedia' }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Kode:</span>
                                <span class="det">{{ $property->code }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Tipe Properti:</span>
                                <span class="det">{{ $property->property_type }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Tipe Transaksi:</span>
                                <span class="det">{{ $property->property_transaction }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Tipe Sertifikat:</span>
                                <span class="det">{{ $property->property_certificate }}</span>
                            </li>
                            @if ($property->bedrooms)
                                <li>
                                    <span class="font-weight-bold mr-1">K. Mandi:</span>
                                    <span class="det">{{ $property->bedrooms }}</span>
                                </li>
                            @endif
                            @if ($property->bathrooms)
                                <li>
                                    <span class="font-weight-bold mr-1">K. Tidur:</span>
                                    <span class="det">{{ $property->bathrooms }}</span>
                                </li>
                            @endif
                            @if ($property->land_sale_area)
                                <li>
                                    <span class="font-weight-bold mr-1">L. Tanah:</span>
                                    <span class="det">{{ $property->land_sale_area }} m<sup>2</sup></span>
                                </li>
                            @endif
                            @if ($property->building_sale_area)
                                <li>
                                    <span class="font-weight-bold mr-1">L. Bangunan:</span>
                                    <span class="det">{{ $property->building_sale_area }} m<sup>2</sup></span>
                                </li>
                            @endif
                            @if ($property->electricity)
                                <li>
                                    <span class="font-weight-bold mr-1">Listrik:</span>
                                    <span class="det">{{ $property->electricity }}</span>
                                </li>
                            @endif
                            @if ($property->warranty)
                                <li>
                                    <span class="font-weight-bold mr-1">Garansi:</span>
                                    <span class="det">{{ $property->warranty == 'Y' ? 'Ya' : 'Tidak' }}</span>
                                </li>
                            @endif
                            @if ($property->floor_material)
                                <li>
                                    <span class="font-weight-bold mr-1">Material Lantai:</span>
                                    <span class="det">{{ $property->floor_material }}</span>
                                </li>
                            @endif
                            @if ($property->building_material)
                                <li>
                                    <span class="font-weight-bold mr-1">Material Bangunan:</span>
                                    <span class="det">{{ $property->building_material }}</span>
                                </li>
                            @endif
                            @if ($property->water)
                                <li>
                                    <span class="font-weight-bold mr-1">Sumber Air:</span>
                                    <span class="det">{{ $property->water }}</span>
                                </li>
                            @endif
                            @if ($property->orientation)
                                <li>
                                    <span class="font-weight-bold mr-1">Hadap:</span>
                                    <span class="det">{{ $property->orientation }}</span>
                                </li>
                            @endif
                            @if ($property->listed_on)
                                <li>
                                    <span class="font-weight-bold mr-1">Terdaftar:</span>
                                    <span class="det">{{ $property->listed_on }}</span>
                                </li>
                            @endif
                        </ul>
                        @if ($property->facilities)
                            <hr>
                            <span class="font-weight-bold mr-1">Fasilitas:</span>
                            <span class="det">{{ $property->facilities }}</span>
                        @endif
                    </div>
                    <div class="blog-info details mb-30">
                        <h5 class="mb-4">Deskripsi</h5>
                        {!! $property->description !!}
                    </div>


                    @if ($property->youtube_code && $property->youtube_code != '')
                        <div class="floor-plan property wprt-image-video w50 pro">
                            <h5>Video Properti</h5>
                            <iframe width="100%" height="400"
                                src="https://www.youtube.com/embed/{{ $property->youtube_code }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @endif
                    @if ($property->maps_location && $property->maps_preview)
                        <div class="property-location map">
                            <h5>Lokasi Properti</h5>
                            <div class="divider-fade"></div>
                            <div>
                                {!! $property->maps_preview !!}
                            </div>
                        </div>
                    @endif
                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">
                        <!-- end author-verified-badge -->
                        <div class="sidebar">
                            <div class="widget-boxed">
                                <div class="widget-boxed-header">
                                    <h4>Informasi Agen</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="sidebar-widget author-widget2">
                                        <div class="author-box clearfix">
                                            <a href="{{ $property->Agen->url }}" style="text-decoration: none">
                                                <img src="{{ $property->Agen->image }}" alt="author-image"
                                                    class="author__img">
                                                <h4 class="author__title">{{ $property->Agen->name }}</h4>
                                                <p class="author__meta">{{ $property->Agen->position }}</p>
                                            </a>
                                        </div>
                                        <ul class="author__contact">
                                            <li>
                                                <span class="la la-map-marker">
                                                    <i class="fa fa-map-marker"></i>
                                                </span>
                                                {{ $property->agen_location }},
                                            </li>
                                            <li>
                                                <span class="la la-phone">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </span>
                                                <a
                                                    href="{{ $property->contact_agen }}">{{ $property->Agen->phone_number }}</a>
                                            </li>
                                            <li>
                                                <span class="la la-envelope-o">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                </span>
                                                <a
                                                    href="mailto:?body={{ $property->Agen->email }}">{{ $property->Agen->email }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="main-search-field-2">
                                <div class="widget-boxed mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Properti Terbaru</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">
                                            @forelse ($recentProperties as $recentProp)
                                                <div class="recent-main">
                                                    <div class="recent-img">
                                                        <a href="{{ $recentProp->url }}">
                                                            <img src="{{ $recentProp->image }}"
                                                                style="max-width: 90px!important;max-height: 50px!important; object-fit:cover"
                                                                alt="{{ $recentProp->short_title }}">
                                                        </a>
                                                    </div>
                                                    <div class="info-img">
                                                        <a href="{{ $recentProp->url }}">
                                                            <h6>{{ $recentProp->short_title }}</h6>
                                                        </a>
                                                        <p>Rp.
                                                            {{ number_format($recentProp->price, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <!-- START SIMILAR PROPERTIES -->
            <section class="similar-property featured portfolio p-0 bg-white-inner">
                <div class="container">
                    <h5>Properti Serupa</h5>
                    <div class="row portfolio-items">
                        @forelse ($similarProperties as $simProp)
                            <div class="item col-lg-4 col-md-6 col-xs-12 landscapes">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="single-property-1.html" class="homes-img">
                                                <div class="homes-tag button alt featured">{{ $simProp->type }}</div>
                                                <div class="homes-tag button alt sale">{{ $simProp->transaction }}</div>
                                                <img src="{{ $simProp->image }}" alt="{{ $simProp->short_title }}"
                                                    class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="{{ $simProp->url }}" class="btn"><i class="fa fa-link"></i></a>
                                            @if ($simProp->youtube)
                                                <a href="{{ $simProp->youtube }}"
                                                    class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                            @endif
                                            <a href="{{ $simProp->url }}" class="img-poppu btn">
                                                <i class="fa fa-photo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a href="single-property-1.html">{{ $simProp->short_title }}</a></h3>
                                        <p class="homes-address mb-3">
                                            <a href="single-property-1.html">
                                                <i class="fa fa-map-marker"></i>
                                                <span> &nbsp;&nbsp;{{ $simProp->location }}</span>
                                            </a>
                                        </p>
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix">
                                            @if ($simProp->bedrooms)
                                                <li class="the-icons">
                                                    <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                    <span>{{ $simProp->bedrooms }} K. Tidur</span>
                                                </li>
                                            @endif

                                            @if ($simProp->bathrooms)
                                                <li class="the-icons">
                                                    <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                    <span>{{ $simProp->bathrooms }} K. Mandi</span>
                                                </li>
                                            @endif

                                            @if ($simProp->land_sale_area)
                                                <li class="the-icons">
                                                    <i class="fas fa-object-group " style="color: #c4c4c4;"
                                                        aria-hidden="true"></i>
                                                    <span>{{ $simProp->land_sale_area }}m<sup>2</sup></span>
                                                </li>
                                            @endif

                                            @if ($simProp->building_sale_area)
                                                <li class="the-icons">
                                                    <i class="fas fa-home" style="color: #c4c4c4;"
                                                        aria-hidden="true"></i>
                                                    <span>{{ $simProp->building_sale_area }}m<sup>2</sup></span>
                                                </li>
                                            @endif
                                        </ul>
                                        <div class="price-properties footer" style="padding-top: 0px !important;">
                                            <h3 class="title mt-3">
                                                <a href="{{ $simProp->url }}">Rp.
                                                    {{ number_format($simProp->price, 0, ',', '.') }}</a>
                                            </h3>
                                        </div>
                                        <div class="footer" style="display: flex; justify-content: space-between;">
                                            <a href="#">
                                                <img src="{{ $simProp->agen_image }}" alt="" class="mr-2">
                                                {{ $simProp->agen }}
                                            </a>
                                            <a href="{{ $simProp->whatsapp }}" class="mt-2" target="__blank">
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
    </section>
    <!-- END SIMILAR PROPERTIES -->
    </div>
    </section>
    <!-- END SECTION PROPERTIES LISTING -->

@endsection
