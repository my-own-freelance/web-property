@extends('layouts.dashboard')
@section('title', $title)
@section('content')
    <div class="row">
        @if ($user->role == 'owner')
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="{{ route('article') }}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-interface-6 text-secondary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Artikel</p>
                                        <h4 class="card-title">{{ $articles }}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="{{ route('faq') }}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-round text-info"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Faq</p>
                                        <h4 class="card-title">{{ $faqs }}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="{{ route('review') }}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-chat-5 text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Review</p>
                                        <h4 class="card-title">{{ $reviews }}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="{{ route('contact') }}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-envelope-1 text-secondary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Contact</p>
                                        <h4 class="card-title">{{ $contacts }}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="{{ route('agen') }}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-user-5 text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Agen</p>
                                        <h4 class="card-title">{{ $agens }}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="{{ route('property-transaction') }}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-chain text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Tipe Transaksi</p>
                                        <h4 class="card-title">{{ $propTransactions }}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="{{ route('property-type') }}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-warning">
                                        <i class="flaticon-technology-1 text-info"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Tipe Properti</p>
                                        <h4 class="card-title">{{ $propTypes }}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="{{ route('property-certificate') }}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-secondary">
                                        <i class="flaticon-file-1 text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Tipe Sertifikat</p>
                                        <h4 class="card-title">{{ $propCertificates }}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-6 col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <a href="{{ route('property') }}">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-graph-2 text-secondary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Properti</p>
                                    <h4 class="card-title">{{ $propAll }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <a href="{{ route('property') }}">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-envelope text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Properti Diajukan</p>
                                    <h4 class="card-title">{{ $propPending }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <a href="{{ route('property') }}">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-graph text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Properti DiSetujui</p>
                                    <h4 class="card-title">{{ $propApproved }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <a href="{{ route('property') }}">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-graph-1 text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Properti Ditolak</p>
                                    <h4 class="card-title">{{ $propRejected }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
