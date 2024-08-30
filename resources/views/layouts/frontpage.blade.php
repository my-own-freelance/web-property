@php
    $routename = request()->route()->getName();
    $template = \App\Models\CustomTemplate::first();
    $webTitle = $template && $template->web_title ? $template->web_title : 'Web Properti';
    $webLogo =
        $template && $template->web_logo
            ? url('/') . Storage::url($template->web_logo)
            : asset('frontpage/images/logo-purple.svg');
    $webLogoWhite =
        $template && $template->web_logo_white
            ? url('/') . Storage::url($template->web_logo_white)
            : asset('frontpage/images/logo-white-1.svg');
    $webDesciption = $template && $template->web_description ? $template->web_description : '';
    $propTransactions = \App\Models\PropertyTransaction::all();
    $propTypes = \App\Models\PropertyType::all();
    $propCertificates = \App\Models\PropertyCertificate::all();
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    {{-- metadata --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="title" content="{{ $webTitle }}" />
    <meta name="description" content="{{ $webDesciption }}" />
    <meta name="keywords" content="{{ $webTitle }}" />
    <meta property="og:image" content="{{ asset('frontpage/images/mockup-depan.jpg') }}" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="{{ $webTitle }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ $webLogo }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('frontpage/css/jquery-ui.css') }}">
    @stack('metadata')

    @include('partials.frontpage.styles')
    @stack('styles')
    <style>
        .btn-yellow,
        .log-submit-btn,
        .close-reg {
            background: #8731E8 !important;
        }

        .news-link {
            color: #8731E8 !important;
        }

        .widget h5::after {
            background-color: #8731E8 !important;

        }

        .page-item.active .page-link {
            background: #8731E8 !important;
            border-color: #8731E8 !important;
        }

        .page-item .page-link:hover {
            background: #8731E8 !important;
            color: white !important;
            border-color: #8731E8 !important;
        }

        .homepage-3 .portfolio .homes-tag.sale {
            background: #18ba60 !important;
        }

        .homes-img {
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .homes-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* article */
        .news-item-img {
            width: 100%;
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .news-item-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .inner-pages .blog-section .news-item-descr.big-news {
            height: 80px !important;
            overflow: hidden;
            position: relative;
        }

        /* end article */

        /* user profile dropdown */
        .header-user-menu.user-menu.add.active ul li a:hover {
            color: #8731E8 !important;
        }

        /* end user profile dropdown */

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
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
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

        .scrollable-list {
            max-height: 300px;
            overflow-y: auto !important;
            border: 1px solid #ddd;
        }
    </style>

</head>

<body
    class="inner-pages homepage-3 {{ $routename != 'home' ? 'agents  hp-6 full hd-white ' : 'the-search' }} {{ $routename == 'faq.list' ? 'ui-elements' : '' }} ">
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
            // $(document).ready(function() {
            // FILTER SEARCH PROPERTY
            let crtId = null;
            let warranty = null;
            let bedrooms = null;
            let bathrooms = null;
            let provinceId = null;
            let districtId = null;
            let subDistrictId = null;

            $('#certificate-list').on('click', 'li', function() {
                crtId = $(this).data('value');
            });

            $('#warranty-list').on('click', 'li', function() {
                warranty = $(this).data('value');
            });

            $('#bedrooms-list').on('click', 'li', function() {
                bedrooms = $(this).data('value');
            });

            $('#bathrooms-list').on('click', 'li', function() {
                bathrooms = $(this).data('value');
            });

            $('#province-list').on('click', 'li', function() {
                provinceId = $(this).data('value');
                $("#sub-district-list").empty();
                $("#district-list").empty();

                $.ajax({
                    url: `/api/dropdown/location/districts/${provinceId}`,
                    type: 'GET',
                    success: function(response) {
                        response.data.forEach((district) => {
                            $("#district-list").append(
                                `<li data-value="${district.id}" class="option">${district.name}</li>`
                            );
                        })
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $("#district-list").append(
                            '<li class="option">Data Kabupaten/Kota tidak tersedia</li>'
                        )
                    }
                });
            });

            $('#district-list').on('click', 'li', function() {
                districtId = $(this).data('value');

                $.ajax({
                    url: `/api/dropdown/location/sub-districts/${districtId}`,
                    type: 'GET',
                    success: function(response) {
                        $("#sub-district-list").empty()
                        response.data.forEach((subDistrict) => {
                            $("#sub-district-list").append(
                                `<li data-value="${subDistrict.id}" class="option">${subDistrict.name}</li>`
                            );
                        })
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $("#sub-district-list").append(
                            '<li class="option">Data Kecamatan tidak tersedia</li>'
                        )
                    }
                });
            });

            $('#sub-district-list').on('click', 'li', function() {
                subDistrictId = $(this).data('value');
            });

            function searchProperty() {
                let queryParams = [];

                let search = $("#fSearch").val();
                let trxId = $("#fPropTransaction").val();
                let typeId = $("#fPropType").val();
                if (search != "") queryParams.push(`search=${encodeURIComponent(search)}`);
                if (trxId != "") queryParams.push(`trx_id=${trxId}`)
                if (typeId != "") queryParams.push(`type_id=${typeId}`)
                if (crtId) queryParams.push(`crt_id=${crtId}`)
                if (warranty) queryParams.push(`warranty=${warranty}`)
                if (bedrooms) queryParams.push(`bedrooms=${bedrooms}`)
                if (bathrooms) queryParams.push(`bathrooms=${bathrooms}`)
                if (provinceId) queryParams.push(`province_id=${provinceId}`)
                if (districtId) queryParams.push(`district_id=${districtId}`)
                if (subDistrictId) queryParams.push(`sub_district_id=${subDistrictId}`)

                let queryString = queryParams.length ? '?' + queryParams.join('&') : '';
                let url = `{{ route('property.list') }}` + queryString;

                window.location.href = url;
            }

            // END FILTER SEARCH PROPERTY

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
            // });
        </script>
    </div>
    <!-- Wrapper / End -->
</body>

</html>
