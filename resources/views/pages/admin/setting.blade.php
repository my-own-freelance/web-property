@extends('layouts.dashboard')
@section('title', $title)
@section('content')
    <div class="row mb-5">
        <div class="col-md-6" id="boxTable">
            <div class="card card-with-nav">
                <div class="card-header">
                    <div class="card-header-left my-3">
                        <h5 class="text-uppercase title">Management Application</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formCountInformation">
                        <div class="avatar avatar-xxl mb-3" id="imageProfile">
                            <img src="{{ asset('dashboard/icon/icon.png') }}" alt="..."
                                class="avatar-img rounded-circle">
                        </div>
                        <input type="hidden" name="id" id="id">
                        <div class="tab-pane active" id="countinformation" (role="tabpanel")>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>Judul Web/Aplikasi</label>
                                        <input type="text" class="form-control" id="web_title" name="web_title"
                                            placeholder="Judul Website">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>Nomor Telpon</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                            placeholder="Nomor Telpon">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Alamat">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>Logo Web/Aplikasi</label>
                                        <input class="form-control" id="web_logo" type="file" name="web_logo"
                                            placeholder="upload gambar" />
                                        <small class="text-danger">Max ukuran 1MB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>Deskripsi Web/Aplikasi</label>
                                        <textarea name="web_description" id="web_description" cols="70" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label for="location">Link Embed Google Maps (hanya masukan link https saja)</label>
                                        <textarea class="form-control" id="maps_location" name="maps_location" placeholder="https://www.google.com/maps/embed?"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default" id="maps_preview">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-3 mb-3">
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('dashboard/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(function() {
            getData()
        })

        $("#formCountInformation").submit(function(e) {
            e.preventDefault()

            let formData = new FormData();
            formData.append("id", parseInt($("#id").val()));
            formData.append("web_title", $("#web_title").val());
            formData.append("phone_number", $("#phone_number").val());
            formData.append("email", $("#email").val());
            formData.append("address", $("#address").val());
            formData.append("web_description", $("#web_description").val());
            formData.append("maps_location", $("#maps_location").val());
            formData.append("web_logo", document.getElementById("web_logo").files[0]);

            createAndUpdate(formData);
            return false;
        });

        function getData() {
            $.ajax({
                url: "/api/custom-template/detail",
                dataType: "json",
                success: function(data) {
                    let d = data.data;
                    $("#id").val(d.id);
                    $("#web_title").val(d.web_title);
                    $("#phone_number").val(d.phone_number);
                    $("#email").val(d.email);
                    $("#address").val(d.address);
                    $("#web_description").val(d.web_description);
                    $("#maps_location").val(d.maps_location);
                    if (d.maps_location && d.maps_preview) {
                        $("#maps_preview").empty().append(d.maps_preview);
                    }

                    if (d.web_logo) {
                        $('#imageProfile img').attr('src', d.web_logo);
                    }

                },
                error: function(err) {
                    console.log("error :", err)
                }

            })
        }

        function createAndUpdate(data) {
            $.ajax({
                url: "/api/admin/custom-template/create-update",
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    console.log("Loading...")
                },
                success: function(res) {
                    showMessage("success", "flaticon-alarm-1", "Sukses", res.message);
                    setTimeout(() => {
                        window.location.reload()
                    }, 800);
                },
                error: function(err) {
                    console.log("error :", err)
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message)
                }
            })
        }
    </script>
@endpush
