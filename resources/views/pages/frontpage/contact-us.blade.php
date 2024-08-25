@extends('layouts.frontpage')
@section('title', $title)
@section('content')

    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Contact Us</h1>
                <h2><a href="{{ route('home') }}">Home </a> &nbsp;/&nbsp; Contact Us</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION CONTACT US -->
    <section class="contact-us">
        <div class="container">
            @if ($setting && $setting->maps_location && $setting->maps_preview)
                <div class="property-location mb-5">
                    <h3>Lokasi Kami</h3>
                    <div class="divider-fade"></div>
                    <div>{!! $setting->maps_preview !!}</div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <h3 class="mb-4">Contact Us</h3>
                    <form id="formContact">
                        <div class="form-group">
                            <input type="text" required class="form-control" id="name" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" id="subject" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control textarea-custom input-full" id="message" required rows="8" placeholder="Message"></textarea>
                        </div>
                        <button class="btn btn-primary btn-lg" type="submit">Kirim</button>
                    </form>
                </div>
                <div class="col-lg-4 col-md-12 bgc">
                    <div class="call-info">
                        <h3>Contact Details</h3>
                        <p class="mb-5">Silakan temukan rincian kontak di bawah ini dan hubungi kami hari ini!</p>
                        <ul>
                            @if ($setting)
                                @if ($setting->address)
                                    <li>
                                        <div class="info">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <p class="in-p">{{ $setting->address }}</p>
                                        </div>
                                    </li>
                                @endif
                                @if ($setting->phone_number)
                                    <li>
                                        <div class="info">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <p class="in-p">{{ $setting->phone_number }}</p>
                                        </div>
                                    </li>
                                @endif
                                @if ($setting->email)
                                    <li>
                                        <div class="info">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <p class="in-p ti">{{ $setting->email }}</p>
                                        </div>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION CONTACT US -->
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $('#formContact').submit(function(e) {
            e.preventDefault();

            let dataToSend = new FormData();
            dataToSend.append("name", $("#name").val());
            dataToSend.append("email", $("#email").val());
            dataToSend.append("subject", $("#subject").val());
            dataToSend.append("message", $("#message").val());

            saveData(dataToSend);
        });


        function saveData(data) {
            $.ajax({
                url: '/api/contact/send-message',
                data: data,
                contentType: false,
                processData: false,
                method: "POST",
                beforeSend: function() {
                    console.log("Loadig...")
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent',
                        text: 'Your message has been sent successfully.',
                        confirmButtonText: 'OK'
                    });

                    $('#formContact')[0].reset();
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to send message. Please try again later.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    </script>
@endpush
