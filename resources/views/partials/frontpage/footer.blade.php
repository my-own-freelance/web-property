        <!-- START FOOTER -->
        <footer class="first-footer">
            <div class="top-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="netabout">
                                <a href="{{ route('home') }}" class="logo">
                                    <img src="{{ $webLogoWhite }}" style="width: 80px!important;" alt="netcom">
                                </a>
                                <p>Properti Ideal untuk Setiap Kebutuhan, Temukan dengan Mudah Bersama Kami!</p>
                            </div>
                            <div class="contactus">
                                @if ($template)
                                    <ul>
                                        @if ($template->address)
                                            <li>
                                                <div class="info">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <p class="in-p">{{ $template->address }}</p>
                                                </div>
                                            </li>
                                        @endif
                                        @if ($template->phone_number)
                                            <li>
                                                <div class="info">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                    <p class="in-p">{{ $template->phone_number }}</p>
                                                </div>
                                            </li>
                                        @endif
                                        @if ($template->email)
                                            <li>
                                                <div class="info">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    <p class="in-p ti">{{ $template->email }}</p>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="navigation">
                                <h3>Navigation</h3>
                                <div class="nav-footer">
                                    <ul>
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('property.list') }}">Properti</a></li>
                                        <li><a href="{{ route('agen.list') }}">Agen</a></li>

                                    </ul>
                                    <ul class="nav-right">
                                        <li><a href="{{ route('article.list') }}">Artikel</a></li>
                                        <li><a href="{{ route('faq.list') }}">Faq</a></li>
                                        <li><a href="{{ route('contact.view') }}">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="second-footer">
                <div class="container">
                    <p>2024 © Copyright - All Rights Reserved.</p>
                    <ul class="netsocials">
                        @if ($template)
                            @if ($template->facebook)
                                <li>
                                    <a href="{{ $template->facebook }}" target="__blank">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($template->twitter)
                                <li>
                                    <a href="{{ $template->twitter }}" target="__blank">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($template->instagram)
                                <li>
                                    <a href="{{ $template->instagram }}" target="__blank">
                                        <i class="fab fa-instagram"></i></a>
                                </li>
                            @endif
                            @if ($template->youtube)
                                <li>
                                    <a href="{{ $template->youtube }}" target="__blank">
                                        <i class="fa fa-youtube" aria-hidden="true"></i>
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </footer>

        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        <!-- END FOOTER -->
