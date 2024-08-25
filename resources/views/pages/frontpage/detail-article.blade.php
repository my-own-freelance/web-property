@extends('layouts.frontpage')
@section('title', $title)
@push('metadata')
    <meta property="og:image" content="{{ $article->image }}" />
    <meta property="og:title" content="{{ $article->title }}" />
    <meta property="og:keywords" content="{{ $article->title }}" />
    <meta name="keywords" content="{{ $article->title }}" />
    <meta property="og:description" content="{{ Illuminate\Support\Str::limit(strip_tags($article->description), 200) }}" />
    <meta name="description" content="{{ Illuminate\Support\Str::limit(strip_tags($article->excerpt), 200) }}" />
    <meta name="excerpt" content="{{ Illuminate\Support\Str::limit(strip_tags($article->excerpt), 200) }}" />
@endpush
@section('content')

    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Detail Artikel</h1>
                <h2><a href="{{ route('home') }}">Home </a> &nbsp;/&nbsp; Detail Artikel</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION BLOG -->
    <section class="blog blog-section bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 blog-pots">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="news-item details no-mb2">
                                <a href="blog-details.html" class="news-img-link">
                                    <div class="news-item-img">
                                        <img class="img-responsive" src="{{ $article->image }}" alt="{{ $article->title }}">
                                    </div>
                                </a>
                                <div class="news-item-text details pb-0">
                                    <a href="blog-details.html">
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
                                    <div class="news-item-descr big-news details visib mb-0">
                                        {!! $article->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="col-lg-3 col-md-12">
                    <div class="widget">
                        <h5 class="font-weight-bold mb-4">Cari Artikel</h5>
                        <div class="input-group">
                            <input type="text" class="form-control" id="input-search-article" placeholder="Cari berdasarkan judul...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="search-article">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                        <div class="recent-post pt-5">
                            <h5 class="font-weight-bold mb-4">Artikel Terbaru</h5>
                            @forelse ($recentPosts as $recent)
                                <div class="recent-main">
                                    <div class="recent-img">
                                        <a href="{{ $recent->url }}">
                                            <img src="{{ $recent->image }}"
                                            style="max-width: 90px!important;max-height: 50px!important; object-fit:cover"
                                            alt="{{ $recent->title }}">
                                        </a>
                                    </div>
                                    <div class="info-img">
                                        <a href="{{ $recent->url }}">
                                            <h6>{{ $recent->title }}</h6>
                                        </a>
                                        <p>{{ $recent->date }}</p>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- END SECTION BLOG -->
@endsection
