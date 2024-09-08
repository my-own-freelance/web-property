@extends('layouts.dashboard')
@section('title', $title)
@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/css/toggle-status.css') }}">
@endpush
@section('content')
    <div class="row mb-5">
        <div class="col-md-12" id="boxTable">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5 class="text-uppercase title">DATA AGEN</h5>
                    </div>
                    <div class="card-header-right">
                        <button class="btn btn-mini btn-info mr-1" onclick="return refreshData();">Refresh</button>
                        <button class="btn btn-mini btn-primary" onclick="return addData();">Tambah</button>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered nowrap dataTable" id="agenDataTable">
                            <thead>
                                <tr>
                                    <th class="all">#</th>
                                    <th class="all">Nama Agen</th>
                                    <th class="all">Username</th>
                                    <th class="all">Email</th>
                                    <th class="all">Level</th>
                                    <th class="all">Phone</th>
                                    <th class="all">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-center"><small>Tidak Ada Data</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- form --}}
        <div class="col-md-12" style="display: none" data-action="update" id="formEditable">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5 id="form-title">TAMBAH DATA AGEN</h5>
                    </div>
                    <div class="card-header-right">
                        <button class="btn btn-sm btn-warning" onclick="return closeForm(this)" id="btnCloseForm">
                            <i class="ion-android-close"></i>
                        </button>
                    </div>
                </div>
                <div class="card-block">
                    <form>
                        <div class="row">
                            <input class="form-control" id="id" type="hidden" name="id" />
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input class="form-control" id="name" type="text" name="name"
                                        placeholder="masukkan nama agen" required />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input class="form-control" id="username" type="text" name="username"
                                        placeholder="masukkan username agen" required />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" type="email" name="email"
                                        placeholder="masukkan email agen" required />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone_number">Nomor Telpon</label>
                                    <input class="form-control" id="phone_number" type="text" name="phone_number"
                                        placeholder="masukkan nomor telpon agen" required />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="masukkan password" />
                                    <small class="text-warning">Min 5 Karakter</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="position">Jabatan</label>
                                    <input class="form-control" id="position" type="text" name="position"
                                        placeholder="masukan posisi/jabatan" required />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="caption">Caption</label>
                                    <input class="form-control" id="caption" type="text" name="caption"
                                        placeholder="masukan keterangan" required />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Foto</label>
                                    <input class="form-control" id="image" type="file" name="image"
                                        placeholder="upload foto" />
                                    <small class="text-danger">Max ukuran 1MB</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city_of_birth">Kota Kelahiran</label>
                                    <input class="form-control" id="city_of_birth" type="text" name="city_of_birth"
                                        placeholder="masukan kota kelahiran" required />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="date_of_birth">Tanggal Lahir</label>
                                    <input class="form-control" id="date_of_birth" type="date" name="date_of_birth"
                                        placeholder="masukan tanggal lahir" required />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control form-control" id="gender" name="gender" required>
                                        <option value = "">Pilih Gender</option>
                                        <option value="L">Laki Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select class="form-control form-control" id="is_active" name="is_active" required>
                                        <option value = "">Pilih Status</option>
                                        <option value="Y">Aktif</option>
                                        <option value="N">Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="province_id">Provinsi</label>
                                    <select class="form-control form-control" id="province_id" name="province_id"
                                        required>
                                        <option value = "">Pilih Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="district_id">Kabupaten</label>
                                    <select class="form-control form-control" id="district_id" name="district_id"
                                        required>
                                        <option value = "">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="sub_district_id">Kecamatan</label>
                                    <select class="form-control form-control" id="sub_district_id" name="sub_district_id"
                                        required>
                                        <option value = "">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input class="form-control" id="address" type="text" name="address"
                                        placeholder="masukan alamat" required />
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="description">Dekripsi</label>
                                    <div id="summernote" name="description"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right mt-3">
                            <button class="btn btn-sm btn-primary" type="submit" id="submit">
                                <i class="ti-save"></i><span>Simpan</span>
                            </button>
                            <button class="btn btn-sm btn-default" id="reset" type="reset"
                                style="margin-left : 10px;"><span>Reset</span>
                            </button>
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
    <script src="{{ asset('/dashboard/js/plugin/summernote/summernote-bs4.min.js') }}"></script>
    <script>
         $('#summernote').summernote({
            placeholder: 'masukkan deskripsi',
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
            tabsize: 2,
            height: 300
        });

        let dTable = null;

        $('#province_id,#district_id,#sub_district_id').select2({
            theme: "bootstrap"
        });

        $(function() {
            dataTable();
        })

        function dataTable(filter) {
            let url = "/api/admin/agen/datatable";
            if (filter) url += '?' + filter;

            dTable = $("#agenDataTable").DataTable({
                searching: true,
                orderng: true,
                lengthChange: true,
                responsive: true,
                processing: true,
                serverSide: true,
                searchDelay: 1000,
                paging: true,
                lengthMenu: [5, 10, 25, 50, 100],
                ajax: url,
                columns: [{
                    data: "action"
                }, {
                    data: "name"
                }, {
                    data: "username"
                }, {
                    data: "email"
                }, {
                    data: "role"
                }, {
                    data: "phone_number"
                }, {
                    data: "is_active"
                }],
                pageLength: 10,
            });
        }

        function refreshData() {
            dTable.ajax.reload(null, false);
        }

        function addData() {
            $("#formEditable").attr('data-action', 'add').fadeIn(200, function() {
                $("#form-title").html("TAMBAH DATA AGEN")
                $("#boxTable").slideUp(200)
                $("#username").removeAttr("readonly");
                $("#image").attr("required", true);
                $("#name").focus();
            })
            getProvinces()
        }

        function closeForm() {
            $("#username").removeAttr("readonly");
            $("#formEditable").slideUp(200, function() {
                $("#boxTable").removeClass("col-md-8").addClass("col-md-12").fadeIn(200)
                $("#reset").click();
                $("#summernote").summernote('code', "");
            })
        }

        function getData(id) {
            $.ajax({
                url: `/api/admin/agen/${id}/detail`,
                method: "GET",
                dataType: "json",
                success: function(res) {
                    $("#formEditable").attr("data-action", "update").fadeIn(200, function() {
                        $("#form-title").html("EDIT DATA AGEN")
                        $("#boxTable").slideUp(200)
                        let d = res.data;
                        $("#id").val(d.id);
                        $("#name").val(d.name);
                        $("#username").val(d.username);
                        $("#username").attr("readonly", true);
                        $("#email").val(d.email);
                        $("#phone_number").val(d.phone_number);
                        $("#position").val(d.position);
                        $("#caption").val(d.caption);
                        $("#city_of_birth").val(d.city_of_birth);
                        $("#date_of_birth").val(d.date_of_birth);
                        $("#gender").val(d.gender).change();
                        $("#is_active").val(d.is_active).change();
                        $("#address").val(d.address)
                        $("#summernote").summernote('code', d.description);

                        if (d.province_id && d.district_id && d.sub_district_id) {
                            getProvinces(true, d.province_id);
                            getDistricts(d.province_id, true, d.district_id);
                            getSubDistricts(d.district_id, true, d.sub_district_id);
                        } else {
                            getProvinces();
                        }
                        $("#image").attr("required", false);

                    })
                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("warning", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message);
                }
            })
        }

        $("#formEditable form").submit(function(e) {
            e.preventDefault();
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
            formData.append("is_active", $("#is_active").val());
            formData.append("province_id", parseInt($("#province_id").val()));
            formData.append("district_id", parseInt($("#district_id").val()));
            formData.append("sub_district_id", parseInt($("#sub_district_id").val()));
            formData.append("address", $("#address").val());
            formData.append("description", $("#summernote").summernote('code'));

            saveData(formData, $("#formEditable").attr("data-action"));
            return false;
        });

        function updateStatus(id, status) {
            let c = confirm(`Anda yakin ingin mengubah status ke ${status} ?`)
            if (c) {
                let dataToSend = new FormData();
                dataToSend.append("is_active", status == "Disabled" ? "N" : "Y");
                dataToSend.append("id", id);
                updateStatusData(dataToSend);
            }
        }

        function saveData(data, action) {
            $.ajax({
                url: action == "update" ? "/api/admin/agen/update" : "/api/admin/agen/create",
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    console.log("Loading...")
                    $("#submit").attr("disabled", true)
                },
                success: function(res) {
                    $("#submit").attr("disabled", false)
                    closeForm();
                    showMessage("success", "flaticon-alarm-1", "Sukses", res.message);
                    refreshData();
                },
                error: function(err) {
                    $("#submit").attr("disabled", false)
                    console.log("error :", err);
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message);
                }
            })
        }

        function removeData(id) {
            let c = confirm("Apakah anda yakin untuk menghapus data ini ?");
            if (c) {
                $.ajax({
                    url: "/api/admin/agen/delete",
                    method: "DELETE",
                    data: {
                        id: id
                    },
                    beforeSend: function() {
                        console.log("Loading...")
                    },
                    success: function(res) {
                        refreshData();
                        showMessage("success", "flaticon-alarm-1", "Sukses", res.message);
                    },
                    error: function(err) {
                        console.log("error :", err);
                        showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                            ?.message);
                    }
                })
            }
        }

        function updateStatusData(data) {
            $.ajax({
                url: "/api/admin/agen/update-status",
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    console.log("Loading...")
                },
                success: function(res) {
                    showMessage("success", "flaticon-alarm-1", "Sukses", res.message);
                    refreshData();
                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message);
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
