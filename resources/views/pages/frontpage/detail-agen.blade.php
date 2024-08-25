@extends('layouts.frontpage')
@section('title', $title)
@push('metadata')
    <meta property="og:image" content="{{ $agen->image }}" />
    <meta property="og:title" content="{{ $agen->name }}" />
    <meta property="og:keywords" content="{{ $agen->name }}" />
    <meta property="og:keywords" content="{{ $agen->caption }}" />
    <meta name="keywords" content="{{ $agen->name }}" />
    <meta name="keywords" content="{{ $agen->caption }}" />
@endpush
@section('content')
    <!-- START SECTION AGENTS DETAILS -->
    <section class="blog blog-section portfolio single-proper details mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <section class="headings-2 pt-0 hee">
                                <div class="pro-wrapper">
                                    <div class="detail-wrapper-body">
                                        <div class="listing-title-bar">
                                            <div class="text-heading text-left">
                                                <p>
                                                    <a href="{{ route('home') }}">Home </a> &nbsp;/&nbsp;
                                                    <span>Detail Agen</span>
                                                </p>
                                            </div>
                                            <h3>{{ $agen->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="news-item news-item-sm">
                                <a href="agent-details.html" class="news-img-link">
                                    <div class="news-item-img homes">
                                        <div class="homes-tag button alt featured">{{ $agen->properties_count }} Listings
                                        </div>
                                        <img class="resp-img" src="{{ $agen->image }}" alt="{{ $agen->name }}">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href="agent-details.html">
                                        <h3>{{ $agen->name }}</h3>
                                    </a>
                                    <div class="the-agents">
                                        <ul class="the-agents-details">
                                            <li>
                                                <a href="{{ $agen->url }}" target="__blank">Code:
                                                    {{ $agen->code }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ $agen->url }}" target="__blank">Jabatan:
                                                    {{ $agen->position ? $agen->position : '-' }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ $agen->whatsapp }}" target="__blank">Phone:
                                                    {{ $agen->phone_number }}</a>
                                            </li>
                                            <li>
                                                <a href="mailto:?body={{ $agen->email }}">Email:
                                                    {{ $agen->email }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="news-item-bottom">
                                        <a href="{{ $agen->link_property }}" class="news-link">Lihat Property Saya</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-pots py-0">
                        <div class="blog-info details mb-30">
                            <h5 class="mb-4">Deskripsi</h5>
                            {!! $agen->desctiption !!}
                        </div>
                        <!-- START SIMILAR PROPERTIES -->
                        <section class="similar-property featured portfolio bshd p-0 bg-white">
                            <div class="container">
                                <h5>Properti Terbaru oleh {{ $agen->name }}</h5>
                                <div class="row">
                                    @forelse ($recenAgenProperty as $agenProp)
                                        <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                            <div class="project-single">
                                                <div class="project-inner project-head">
                                                    <div class="homes">
                                                        <!-- homes img -->
                                                        <a href="{{ $agenProp->url }}" class="homes-img">
                                                            <div class="homes-tag button alt featured">
                                                                {{ $agenProp->type }}
                                                            </div>
                                                            <div class="homes-tag button alt sale">
                                                                {{ $agenProp->transaction }}
                                                            </div>
                                                            <img src="{{ $agenProp->image }}"
                                                                alt="{{ $agenProp->short_title }}" class="img-responsive">
                                                        </a>
                                                    </div>
                                                    <div class="button-effect">
                                                        <a href="{{ $agenProp->url }}" class="btn"><i
                                                                class="fa fa-link"></i></a>
                                                        @if ($agenProp->youtube)
                                                            <a href="{{ $agenProp->youtube }}"
                                                                class="btn popup-video popup-youtube"><i
                                                                    class="fas fa-video"></i></a>
                                                        @endif
                                                        <a href="{{ $agenProp->url }}" class="img-poppu btn"><i
                                                                class="fa fa-photo"></i></a>
                                                    </div>
                                                </div>
                                                <!-- homes content -->
                                                <div class="homes-content">
                                                    <!-- homes address -->
                                                    <h3>
                                                        <a href="{{ $agenProp->url }}">{{ $agenProp->short_title }}</a>
                                                        </h4>
                                                        <p class="homes-address">
                                                            <i
                                                                class="fa fa-map-marker"></i><span>&nbsp;&nbsp;{{ $agenProp->location }}</span>
                                                        </p>
                                                        <!-- homes List -->
                                                        <ul class="homes-list clearfix">
                                                            @if ($agenProp->bedrooms)
                                                                <li class="the-icons">
                                                                    <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                                    <span>{{ $agenProp->bedrooms }} K. Tidur</span>
                                                                </li>
                                                            @endif

                                                            @if ($agenProp->bathrooms)
                                                                <li class="the-icons">
                                                                    <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                                    <span>{{ $agenProp->bathrooms }} K. Mandi</span>
                                                                </li>
                                                            @endif

                                                            @if ($agenProp->land_sale_area)
                                                                <li class="the-icons">
                                                                    <i class="fas fa-object-group " style="color: #c4c4c4;"
                                                                        aria-hidden="true"></i>
                                                                    <span>{{ $agenProp->land_sale_area }}m<sup>2</sup></span>
                                                                </li>
                                                            @endif

                                                            @if ($agenProp->building_sale_area)
                                                                <li class="the-icons">
                                                                    <i class="fas fa-home" style="color: #c4c4c4;"
                                                                        aria-hidden="true"></i>
                                                                    <span>{{ $agenProp->building_sale_area }}m<sup>2</sup></span>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                        <div class="price-agenPropes footer"
                                                            style="padding-top: 0px !important;">
                                                            <h3 class="title mt-3">
                                                                <a href="{{ $agenProp->url }}">Rp.
                                                                    {{ number_format($agenProp->price, 0, ',', '.') }}</a>
                                                            </h3>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">
                        <div class="schedule widget-boxed mt-33 mt-0" style="margin-top: 130px !important;">
                            <div class="widget-boxed-header">
                                <h4><i class="fa fa-search pr-3 padd-r-10"></i>Cari Agen</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="input-search-agen"
                                        placeholder="Cari berdasarkan nama/code...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="search-agen">
                                            <i class="fa fa-search text-white" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar">
                            <div class="main-search-field-2">
                                <div class="widget-boxed mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Properti Terbaru</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">
                                            @forelse ($recentProperties as $property)
                                                <div class="recent-main">
                                                    <div class="recent-img">
                                                        <a href="{{ $property->url }}">
                                                            <img src="{{ $property->image }}"
                                                                style="max-width: 90px!important;max-height: 50px!important; object-fit:cover"
                                                                alt="{{ $property->short_title }}">
                                                        </a>
                                                    </div>
                                                    <div class="info-img">
                                                        <a href="{{ $property->url }}">
                                                            <h6>{{ $property->short_title }}</h6>
                                                        </a>
                                                        <p>Rp.
                                                            {{ number_format($property->price, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-boxed mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Artikel Terbaru</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">
                                            @forelse ($recentArticles as $article)
                                                <div class="recent-main">
                                                    <div class="recent-img">
                                                        <a href="{{ $article->url }}">
                                                            <img src="{{ $article->image }}"
                                                                style="max-width: 90px!important;max-height: 50px!important; object-fit:cover"
                                                                alt="{{ $article->title }}">
                                                        </a>
                                                    </div>
                                                    <div class="info-img">
                                                        <a href="{{ $article->url }}">
                                                            <h6>{{ $article->title }}</h6>
                                                        </a>
                                                        <p>{{ $article->date }}</p>
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
        </div>
    </section>
    <!-- END SECTION AGENTS DETAILS -->
@endsection
