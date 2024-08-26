@extends('layouts.frontpage')
@section('title', $title)
@push('styles')
    <style>
        #search-agen{
            background-color: #8731E8 !important;
            border-color: #8731E8 !important;
        }
        #search-agen:hover {
            background-color: white !important;
            color: #8731E8 !important;
        }

        #search-agen:hover i {
            color: #8731E8 !important;
        }
    </style>
@endpush
@section('content')
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="properties-right featured portfolio blog pt-5">
        <div class="container">
            <section class="headings-2 pt-0 pb-55">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p class="pb-2"><a href="{{ route('home') }}">Home </a> &nbsp;/&nbsp; <span>Agen</span></p>
                            </div>
                            <h3>Daftar Agen</h3>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <div class="row">
                        @forelse ($agens as $agen)
                            <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="{{ $agen->link_property }}" class="homes-img">
                                                <div class="homes-tag button alt featured">{{ $agen->total_property }}
                                                    Listings</div>
                                                <img src="{{ $agen->image }}" alt="{{ $agen->name }}"
                                                    class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <div class="the-agents">
                                            <h3><a href="{{ $agen->url }}">{{ $agen->name }}</a></h3>
                                            <ul class="the-agents-details">
                                                <li>
                                                    <a href="{{ $agen->url }}">Code:
                                                        {{ $agen->code }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ $agen->url }}">Jabatan:
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
                                        <div class="footer text-right">
                                            <a href="{{ $agen->link_property }}" class="news-link">Lihat
                                                Properti Saya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">
                        <div class="schedule widget-boxed mt-33 mt-0">
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
            <nav aria-label="..." class="pt-55">
                {{ $agens->links() }}
            </nav>
        </div>
    </section>
    <!-- END SECTION PROPERTIES LISTING -->

@endsection
