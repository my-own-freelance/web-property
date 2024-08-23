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
                                    placeholder="nomor telpon">
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
        $(function() {
            getData()
        })

        $('#gender').select2({
            theme: "bootstrap"
        });

        $("#formCountInformation").submit(function(e) {
            e.preventDefault()

            let formData = new FormData();
            formData.append("id", parseInt($("#id").val()));
            formData.append("name", $("#name").val());
            formData.append("email", $("#email").val());
            formData.append("password", $("#password").val());
            formData.append("phone_number", $("#phone_number").val());
            formData.append("gender", $("#gender").val());
            formData.append("image", document.getElementById("image").files[0]);

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
                    $("#gender").val(d.gender).change();

                    if (d.image) {
                        $('#imageProfile img').attr('src', d.image);
                    }

                },
                error: function(err) {
                    console.log("error :", err)
                }

            })
        }

        function update(data) {
            $.ajax({
                url: "/api/admin/account/update-owner",
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
    </script>
@endpush
