@extends('layouts.dashboard')
@section('title', $title)
@section('content')
    <div class="row mb-5">
        <div class="col-md-6" id="boxTable">
            <div class="card card-with-nav">
                <div class="card-header">
                    <div class="card-header-left my-3">
                        <h5 class="text-uppercase title">Management Account</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formCountInformation">
                        <div class="avatar avatar-xxl mb-3" id="imageProfile">
                            <img src="{{ asset('dashboard/img/jm_denis.jpg') }}" alt="..."
                                class="avatar-img rounded-circle">
                        </div>
                        <input type="hidden" name="id" id="id">
                        <div class="tab-pane active" id="countinformation" (role="tabpanel")>
                            <div class="form-group form-group-default">
                                <label>Nama</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="nama">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Username</label>
                                <input type="text" class="form-control" id="username" name="username" disabled
                                    placeholder="username">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="email">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Password</label>
                                <input type="text" class="form-control" id="password" name="password"
                                    placeholder="ubah password">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Nomor Telpon</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="nama">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" id="position" name="position"
                                    placeholder="jabatan">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Caption</label>
                                <input type="text" class="form-control" id="caption" name="caption"
                                    placeholder="caption">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Kota Kelahitan</label>
                                <input type="text" class="form-control" id="city_of_birth" name="city_of_birth"
                                    placeholder="kota kelahiran">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    placeholder="tanggal lahir">
                            </div>
                            <div class="form-group form-group-default">
                                <label for="gender">Gender</label>
                                <select class="form-control form-control" id="gender" name="gender" required>
                                    <option value = "">Pilih Gender</option>
                                    <option value="L">Laki Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group form-group-default">
                                <label>Foto Pengguna</label>
                                <input class="form-control" id="image" type="file" name="image"
                                    placeholder="upload gambar" />
                                <small class="text-danger">Max ukuran 1MB</small>
                            </div>
                            <div class="form-group form-group-default">
                                <label for="province_id">Provinsi</label>
                                <select class="form-control form-control" id="province_id" name="province_id" required>
                                    <option value = "">Pilih Provinsi</option>
                                </select>
                            </div>
                            <div class="form-group form-group-default">
                                <label for="district_id">Kabupaten</label>
                                <select class="form-control form-control" id="district_id" name="district_id" required>
                                    <option value = "">Pilih Kabupaten</option>
                                </select>
                            </div>
                            <div class="form-group form-group-default">
                                <label for="sub_district_id">Kecamatan</label>
                                <select class="form-control form-control" id="sub_district_id" name="sub_district_id"
                                    required>
                                    <option value = "">Pilih Kecamatan</option>
                                </select>
                            </div>
                            <div class="form-group form-group-default">
                                <label for="address">Alamat</label>
                                <input class="form-control" id="address" type="text" name="address"
                                    placeholder="masukan alamat" required />
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
    <script src="{{ asset('dashboard/js/plugin/select2/select2.full.min.js') }}"></script>
    <script>
        $('#gender,#province_id,#district_id,#sub_district_id').select2({
            theme: "bootstrap"
        });

        $(function() {
            getData()
        })

        $("#formCountInformation").submit(function(e) {
            e.preventDefault()

            let formData = new FormData();
            formData.append("id", parseInt($("#id").val()));
            formData.append("name", $("#name").val());
            formData.append("username", $("#username").val());
            formData.append("email", $("#email").val());
            formData.append("phone_number", $("#phone_number").val());
            formData.append("password", $("#password").val());
            formData.append("position", $("#position").val());
            formData.append("caption", $("#caption").val());
            formData.append("image", document.getElementById("image").files[0]);
            formData.append("city_of_birth", $("#city_of_birth").val());
            formData.append("date_of_birth", $("#date_of_birth").val());
            formData.append("gender", $("#gender").val());
            formData.append("province_id", parseInt($("#province_id").val()));
            formData.append("district_id", parseInt($("#district_id").val()));
            formData.append("sub_district_id", parseInt($("#sub_district_id").val()));
            formData.append("address", $("#address").val());

            update(formData);
            return false;
        });

        function getData() {
            $.ajax({
                url: "/api/admin/account/detail",
                dataType: "json",
                success: function(data) {
                    let d = data.data;
                    $("#id").val(d.id);
                    $("#name").val(d.name);
                    $("#email").val(d.email);
                    $("#username").val(d.username);
                    $("#phone_number").val(d.phone_number);
                    $("#position").val(d.position);
                    $("#caption").val(d.caption);
                    $("#city_of_birth").val(d.city_of_birth);
                    $("#date_of_birth").val(d.date_of_birth);
                    $("#gender").val(d.gender).change();

                    $("#address").val(d.address);

                    if (d.image) {
                        $('#imageProfile img').attr('src', d.image);
                    }

                    if (d.province_id && d.district_id && d.sub_district_id) {
                        getProvinces(true, d.province_id);
                        getDistricts(d.province_id, true, d.district_id);
                        getSubDistricts(d.district_id, true, d.sub_district_id);
                    } else {
                        getProvinces();
                    }
                },
                error: function(err) {
                    console.log("error :", err)
                }

            })
        }

        function update(data) {
            $.ajax({
                url: "/api/admin/account/update-agen",
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    console.log("Loading...")
                },
                success: function(res) {
                    getData()
                    showMessage("success", "flaticon-alarm-1", "Sukses", res.message);
                },
                error: function(err) {
                    console.log("error :", err)
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message)
                }
            })
        }

        function getProvinces(onDetail = false, province_id = null) {
            $.ajax({
                url: `/api/dropdown/location/provinces`,
                method: "GET",
                header: {
                    "Content-Type": "application/json"
                },
                beforeSend: function() {
                    console.log("Sending data...!")
                },
                success: function(res) {
                    // update input form
                    $("#province_id").empty();
                    $('#province_id').append("<option value =''>Pilih Provinsi</option > ");
                    $.each(res.data, function(index, r) {
                        $('#province_id').append("<option value = '" + r.id + "' > " + r
                            .name + " </option > ");
                    })

                    if (onDetail) {
                        $("#province_id").val(province_id)
                    }
                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err
                        .responseJSON
                        ?.message);
                }
            })
        }

        $("#province_id").change(function() {
            let province_id = $(this).val();
            getDistricts(province_id);
            // reset sub district
            $("#sub_district_id").empty();
            $('#sub_district_id').append("<option value =''>Pilih Kecamatan</option > ");
        })

        function getDistricts(province_id, onDetail = false, district_id = null) {
            $.ajax({
                url: `/api/dropdown/location/districts/${province_id}`,
                method: "GET",
                header: {
                    "Content-Type": "application/json"
                },
                beforeSend: function() {
                    console.log("Sending data...!")
                },
                success: function(res) {
                    // update input form
                    $("#district_id").empty();
                    $('#district_id').append("<option value =''>Pilih Kabupaten</option > ");
                    $.each(res.data, function(index, r) {
                        $('#district_id').append("<option value = '" + r.id + "' > " + r
                            .name + " </option > ");
                    })

                    if (onDetail) {
                        $("#district_id").val(district_id)
                    }
                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err
                        .responseJSON
                        ?.message);
                }
            })
        }

        $("#district_id").change(function() {
            let district_id = $(this).val();
            getSubDistricts(district_id);
        })

        function getSubDistricts(district_id, onDetail = false, sub_district_id = null) {
            $.ajax({
                url: `/api/dropdown/location/sub-districts/${district_id}`,
                method: "GET",
                header: {
                    "Content-Type": "application/json"
                },
                beforeSend: function() {
                    console.log("Sending data...!")
                },
                success: function(res) {
                    // update input form
                    $("#sub_district_id").empty();
                    $('#sub_district_id').append("<option value =''>Pilih Kecamatan</option > ");
                    $.each(res.data, function(index, r) {
                        $('#sub_district_id').append("<option value = '" + r.id + "' > " + r
                            .name + " </option > ");
                    })

                    if (onDetail) {
                        $("#sub_district_id").val(sub_district_id);
                    }
                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err
                        .responseJSON
                        ?.message);
                }
            })
        }
    </script>
@endpush
