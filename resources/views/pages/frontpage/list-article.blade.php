@extends('layouts.frontpage')
@section('title', $title)
@push('styles')
    <style>
        #search-article {
            background-color: #8731E8 !important;
            border-color: #8731E8 !important;
        }

        #search-article:hover {
            background-color: white !important;
            color: #8731E8 !important;
        }
    </style>
@endpush
@section('content')

    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Artikel</h1>
                <h2><a href="{{ route('home') }}">Home </a> &nbsp;/&nbsp; Artikel</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION BLOG -->
    <section class="blog blog-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-xs-12">
                    <div class="row">
                        @forelse ($articles as $article)
                            <div class="col-md-6 col-xs-12 mb-4">
                                <div class="news-item nomb">
                                    <a href="{{ $article->url }}" class="news-img-link">
                                        <div class="news-item-img">
                                            <img class="img-responsive" src="{{ $article->image }}"
                                                alt="{{ $article->title }}">
                                        </div>
                                    </a>
                                    <div class="news-item-text">
                                        <a href="{{ $article->url }}">
                                            <h3>{{ $article->title }}</h3>
                                        </a>
                                        <div class="dates">
                                            <span class="date">{{ $article->date }} &nbsp;/</span>
                                            <ul class="action-list pl-0">
                                                <li class="action-item pl-2">
                                                    <span>{{ $article->views }}x dilihat</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="news-item-descr big-news mb-3">
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
                <aside class="col-lg-3 col-md-12">
                    <div class="widget">
                        <h5 class="font-weight-bold mb-4">Cari Artikel</h5>
                        <div class="input-group">
                            <input type="text" class="form-control" id="input-search-article"
                                placeholder="Cari berdasarkan judul...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="search-article">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                        <div class="recent-post pt-5">
                            <h5 class="font-weight-bold mb-4">Artikel Populer</h5>
                            @forelse ($popular as $pop)
                                <div class="recent-main">
                                    <div class="recent-img">
                                        <a href="{{ $pop->url }}">
                                            <img src="{{ $pop->image }}"
                                                style="max-width: 90px!important;max-height: 50px!important; object-fit:cover"
                                                alt="{{ $pop->title }}">
                                        </a>
                                    </div>
                                    <div class="info-img">
                                        <a href="{{ $pop->url }}">
                                            <h6>{{ $pop->title }}</h6>
                                        </a>
                                        <p>{{ $pop->date }}</p>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </aside>
            </div>
            <nav aria-label="..." class="pt-5">
                {{ $articles->links() }}
            </nav>
        </div>
    </section>
    <!-- END SECTION BLOG -->
@endsection
