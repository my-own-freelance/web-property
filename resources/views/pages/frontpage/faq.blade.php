@extends('layouts.frontpage')
@section('title', $title)
@push('styles')
    <style>
        .ui-elements .accordion-1 .active .title {
            background: #8731E8 !important;
            color: #fff;
        }
    </style>
@endpush
@section('content')
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>FAQ’S</h1>
                <h2><a href="{{ route('home') }}">Home </a> &nbsp;/&nbsp; FAQ’S</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION FAQ -->
    <section class="faq service-details bg-white">
        <div class="container">
            <h3 class="mb-5">PERTANYAAN YANG SERING DITANYAKAN</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <ul class="accordion accordion-1 one-open">
                        @forelse ($faqs as $faq)
                            <li class="{{ $loop->iteration == 1 ? 'active' : '' }}">
                                <div class="title">
                                    <span>{{ $faq->question }}</span>
                                </div>
                                <div class="content">
                                    <p>
                                        {{ $faq->answer }}
                                    </p>
                                </div>
                            </li>
                        @empty
                        @endforelse
                        <!--end of accordion-->
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION FAQ -->
@endsection
@push('scripts')
    <script>
        $(".accordion li").click(function() {
            $(this).closest(".accordion").hasClass("one-open") ? ($(this).closest(".accordion").find("li")
                    .removeClass("active"), $(this).addClass("active")) : $(this).toggleClass("active"),
                "undefined" != typeof window.mr_parallax && setTimeout(mr_parallax.windowLoad, 500)
        });
    </script>
@endpush
