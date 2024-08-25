@php
    $routename = request()->route()->getName();
    $template = \App\Models\CustomTemplate::first();
    $webTitle = $template && $template->web_title ? $template->web_title : 'Web Properti';
    $webLogo =
        $template && $template->web_logo
            ? url('/') . Storage::url($template->web_logo)
            : asset('dashboard/icon/icon.png');
    $webDesciption = $template && $template->web_description ? $template->web_description : '';
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{ $webDesciption }}" />
    <meta name="author" content="">
    <title>@yield('title')</title>
    {{-- metadata --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="title" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="keywords" content="" />
    <meta property="og:image" content="{{ $webLogo }}" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ $webLogo }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('frontpage/css/jquery-ui.css') }}">
    @stack('metadata')

    @include('partials.frontpage.styles')
    @stack('styles')
    <style>
        /* Gaya umum untuk notifikasi */
        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 30px;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            display: none;
            z-index: 100000;
            /* Pastikan notifikasi berada di atas modal */
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            /* Batasan lebar notifikasi */
            width: 100%;
            /* Mengisi lebar sesuai konten dan batasan max-width */
        }

        /* Notifikasi sukses */
        .success-notification {
            background-color: #28a745;
        }

        /* Notifikasi error */
        .error-notification {
            background-color: #dc3545;
        }

        /* Animasi fade-in dan fade-out */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s forwards;
        }

        .fade-out {
            animation: fadeOut 0.5s forwards;
        }
    </style>

</head>

<body
    class="inner-pages homepage-3 ui-elements {{ $routename != 'home' ? 'agents  hp-6 full hd-white' : 'the-search' }} ">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- START SECTION HEADINGS -->
        @include('partials.frontpage.header')

        @yield('content')

        @include('partials.frontpage.footer')

        <!--register form -->
        <div class="login-and-register-form modal">
            <!-- Notifikasi Sukses -->
            <div id="success-notification" class="notification success-notification">
                <i class="fa fa-check-circle"></i> <span id="succesMessage"></span>
            </div>

            <!-- Notifikasi Error -->
            <div id="error-notification" class="notification error-notification">
                <i class="fa fa-times-circle"></i> <span id="errMessage"></span>
            </div>

            <div class="main-overlay"></div>
            <div class="main-register-holder">
                <div class="main-register fl-wrap">
                    <div class="close-reg"><i class="fa fa-times"></i></div>
                    <h3>Welcome to <span>Find<strong>Houses</strong></span></h3>
                    <div id="tabs-container" style="margin-top: -20px!important;">
                        <div class="tab">
                            <div id="tab-1" class="tab-contents">
                                <div class="custom-form">
                                    <form id="formLogin">
                                        <label>Username * </label>
                                        <input name="username" type="text" onClick="this.select()" value=""
                                            placeholder="Enter Username">
                                        <label>Password * </label>
                                        <input name="password" type="password" onClick="this.select()" value=""
                                            placeholder="Enter Password">
                                        <button type="submit" class="log-submit-btn"><span>Log In</span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--register form end -->

        <!-- START PRELOADER -->
        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>
        <!-- END PRELOADER -->

        @include('partials.frontpage.scripts')
        @stack('scripts')

        <script>
            // SEARCH ARTICLE
            $(document).ready(function() {
                $('#search-article').on('click', function() {
                    var searchValue = $('#input-search-article').val();
                    window.location.href = window.location.origin + '/list-artikel?search=' +
                        encodeURIComponent(searchValue);
                });

                $('#search-agen').on('click', function() {
                    var searchValue = $('#input-search-agen').val();
                    window.location.href = window.location.origin + '/list-agen?search=' +
                        encodeURIComponent(searchValue);
                });

                $("#formLogin").submit(function(e) {
                    e.preventDefault();

                    let dataToSend = $(this).serialize();
                    submitAuth(dataToSend, "login");
                    return false;
                })

                function submitAuth(data, type) {
                    $.ajax({
                        url: "/api/auth/login/validate",
                        method: "POST",
                        data: data,
                        beforeSend: function() {
                            console.log("Loading...")
                        },
                        success: function(res) {
                            if (res.message == "Login Sukses") {
                                showNotification('success', res.message);
                                setTimeout(() => {
                                    window.location.href = "{{ route('dashboard') }}"
                                }, 1500)
                            }
                        },
                        error: function(err) {
                            console.log("error :", err)
                            showNotification('error', err.message || err.responseJSON?.message);
                        }
                    })
                }

                function showNotification(type, message) {
                    let notificationElement = type === 'success' ? $('#success-notification') : $(
                        '#error-notification');

                    let notifMessage = type === 'success' ? $("#succesMessage") : $("#errMessage");
                    notifMessage.html(message);

                    notificationElement.addClass('fade-in').show();

                    setTimeout(function() {
                        notificationElement.addClass('fade-out');
                        setTimeout(function() {
                            notificationElement.hide().removeClass('fade-in fade-out');
                        }, 500); // Waktu fade-out
                    }, 3000); // Waktu tampilan notifikasi sebelum menghilang
                }
            });
        </script>
    </div>
    <!-- Wrapper / End -->
</body>

</html>
