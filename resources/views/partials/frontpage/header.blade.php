<?php
$routename = request()->route()->getName();
$propTransactions = \App\Models\PropertyTransaction::all();
$propTypes = \App\Models\PropertyType::all();
$propCertificates = \App\Models\PropertyCertificate::all();
?>
<!-- Header Container
        ================================================== -->
<header id="header-container" class="header {{ $routename == 'home' ? 'head-tr' : '' }}">
    <!-- Header -->
    <div id="header" class="{{ $routename == 'home' ? 'head-tr' : '' }} bottom">
        <div class="container container-header">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ $routename == 'home' ? asset('frontpage/images/logo-white-1.svg') : asset('frontpage/images/logo-purple.svg') }}"
                            data-sticky-logo="{{ asset('frontpage/images/logo-purple.svg') }}" alt="">
                    </a>
                </div>
                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
                <!-- Main Navigation -->
                <nav id="navigation" class="style-1 {{ $routename == 'home' ? 'head-tr' : '' }}">
                    <ul id="responsive">
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li><a href="#">Property</a>
                            <ul>
                                <li><a href="{{ route('property.list') }}">Properti</a></li>
                                <li><a href="#">Tipe Transaksi</a>
                                    <ul>
                                        @forelse ($propTransactions as $propTransac)
                                        <li><a
                                                href="{{ route('property.list', ['trx_id' => $propTransac->id]) }}">{{ $propTransac->name }}</a>
                                        </li>
                                    @empty
                                    @endforelse
                                    </ul>
                                </li>
                                <li><a href="#">Tipe Properti</a>
                                    <ul>
                                        @forelse ($propTypes as $propType)
                                        <li><a
                                                href="{{ route('property.list', ['type_id' => $propType->id]) }}">{{ $propType->name }}</a>
                                        </li>
                                    @empty
                                    @endforelse
                                    </ul>
                                </li>
                                <li><a href="#">Tipe Sertifikat</a>
                                    <ul>
                                        @forelse ($propCertificates as $propCertif)
                                        <li><a
                                                href="{{ route('property.list', ['crt_id' => $propCertif->id]) }}">{{ $propCertif->name }}</a>
                                        </li>
                                    @empty
                                    @endforelse
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">Pages</a>
                            <ul>
                                <li>
                                    <a href="{{ route('agen.list') }}">Agen</a>
                                </li>
                                <li>
                                    <a href="{{ route('article.list') }}">Artikel</a>
                                </li>
                                <li>
                                    <a href="#">Faq</a>
                                </li>
                            </ul>
                        </li>

                        <li><a href="contact-us.html">Contact</a></li>
                        <li class="d-none d-xl-none d-block d-lg-block"><a href="{{route('login')}}">Login</a></li>
                        </li>
                    </ul>
                </nav>
                <!-- Main Navigation / End -->
            </div>
            <!-- Left Side Content / End -->

            <!-- Right Side Content / End -->
            @auth
                <div class="header-user-menu user-menu add">
                    <div class="header-user-name">
                        <span><img src="{{ Storage::url(auth()->user()->image) }}" alt=""></span>Hi,
                        {{ auth()->user()->name }}
                    </div>
                    <ul>
                        <li><a href="{{ route('account') }}"> Edit profile</a></li>
                        <li><a href="{{ route('property') }}"> Add Property</a></li>
                        <li><a href="{{ route('account') }}"> Change Password</a></li>
                        <li><a href="{{ route('logout') }}">Log Out</a></li>
                    </ul>
                </div>
            @endauth
            <!-- Right Side Content / End -->

            @guest
                <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                    <!-- Header Widget -->
                    <div class="header-widget sign-in">
                        <div class="show-reg-form modal-open"><a href="#">Sign In</a></div>
                    </div>
                    <!-- Header Widget / End -->
                </div>
            @endguest
            <!-- Right Side Content / End -->
        </div>
    </div>
    <!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->
