@php
    $template = \App\Models\CustomTemplate::first();
    $logoColor = $template && $template->logo_header_color ? $template->logo_header_color : 'blue';
    $topbarColor = $template && $template->topbar_color ? $template->topbar_color : 'blue2';
    $sidebarColor = $template && $template->sidebar_color ? $template->sidebar_color : 'white';
    $bgColor = $template && $template->bd_color ? $template->bd_color : 'bg1';
    $webTitle = $template && $template->web_title ? $template->web_title : 'Web Properti';
    $webLogo =
        $template && $template->web_logo
            ? url('/') . Storage::url($template->web_logo)
            : asset('dashboard/icon/icon.png');
    $webDesciption = $template && $template->web_description ? $template->web_description : '';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ $webLogo }}" type="image/x-icon" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="{{ $webDesciption }}" />
    @include('partials.dashboard.styles')
    <title>@yield('title')</title>
    @stack('styles')
</head>

<body data-background-color="{{ $bgColor }}">
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="{{ $logoColor }}">
                <a href="{{ route('dashboard') }}" class="logo">
                    <h4 class="text-white mt-3" style="font-weight: 800!important">WEB PROPERTI</h4>
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            {{-- navbar header --}}
            @include('partials.dashboard.navbar')
            {{-- end navbar header --}}
        </div>

        @include('partials.dashboard.sidebar')

        <div class="main-panel">
            <div class="container">
                <div class="page-inner mt-5">
                    @yield('content')
                </div>
            </div>
            @include('partials.dashboard.footer')
        </div>
        @include('partials.dashboard.custom-template')
    </div>
    @include('partials.dashboard.scripts')
    @stack('scripts')
</body>

</html>
