@extends('layouts.dashboard')
@section('title', $title)
@push('styles')
    <link rel="stylesheet" href="{{ asset('/dashboard/css/toggle-status.css') }}">
@endpush
@section('content')
    <div class="row mb-5">
        <div class="col-md-12" id="boxTable">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5 class="text-uppercase title">DATA OWNER</h5>
                    </div>
                    <div class="card-header-right">
                        <button class="btn btn-mini btn-info mr-1" onclick="return refreshData();">Refresh</button>
                        <button class="btn btn-mini btn-primary" onclick="return addData();">Tambah</button>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered nowrap dataTable" id="ownerDataTable">
                            <thead>
                                <tr>
                                    <th class="all">#</th>
                                    <th class="all">Nama Owner</th>
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
        <div class="col-md-4 col-sm-12" style="display: none" data-action="update" id="formEditable">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Tambah / Edit</h5>
                    </div>
                    <div class="card-header-right">
                        <button class="btn btn-sm btn-warning" onclick="return closeForm(this)" id="btnCloseForm">
                            <i class="ion-android-close"></i>
                        </button>
                    </div>
                </div>
                <div class="card-block">
                    <form>
                        <input class="form-control" id="id" type="hidden" name="id" />
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input class="form-control" id="name" type="text" name="name"
                                placeholder="masukkan nama owner" required />
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" id="username" type="text" name="username"
                                placeholder="masukkan username owner" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email"
                                placeholder="masukkan email owner" required />
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Nomor Telpon</label>
                            <input class="form-control" id="phone_number" type="text" name="phone_number"
                                placeholder="masukkan nomor telpon owner" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" id="password" type="password" name="password"
                                placeholder="masukkan password owner" />
                            <small class="text-warning">Min 5 Karakter</small>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control form-control" id="gender" name="gender" required>
                                <option value = "">Pilih Gender</option>
                                <option value="L">Laki Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select class="form-control form-control" id="is_active" name="is_active" required>
                                <option value = "">Pilih Status</option>
                                <option value="Y">Aktif</option>
                                <option value="N">Disable</option>
                            </select>
                        </div>
                        <div class="form-group">
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
    <script src="{{ asset('/dashboard/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        let dTable = null;

        $(function() {
            dataTable();
        })

        function dataTable() {
            const url = "/api/admin/owner/datatable";
            dTable = $("#ownerDataTable").DataTable({
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
            $("#username").removeAttr("readonly");
            $("#formEditable").attr('data-action', 'add').fadeIn(200);
            $("#boxTable").removeClass("col-md-12").addClass("col-md-8");
            $("#name").focus();
        }

        function closeForm() {
            $("#username").removeAttr("readonly");
            $("#formEditable").slideUp(200, function() {
                $("#boxTable").removeClass("col-md-8").addClass("col-md-12");
                $("#reset").click();
            })
        }

        function getData(id) {
            $.ajax({
                url: `/api/admin/owner/${id}/detail`,
                method: "GET",
                dataType: "json",
                success: function(res) {
                    $("#formEditable").attr("data-action", "update").fadeIn(200, function() {
                        $("#boxTable").removeClass("col-md-12").addClass("col-md-8");
                        let d = res.data;
                        $("#id").val(d.id);
                        $("#name").val(d.name);
                        $("#username").val(d.username);
                        $("#username").attr("readonly", true);
                        $("#email").val(d.email);
                        $("#phone_number").val(d.phone_number);
                        $("#password").val(d.password);
                        $("#gender").val(d.gender).change();
                        $("#is_active").val(d.is_active);
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
            formData.append("gender", $("#gender").val());
            formData.append("is_active", $("#is_active").val());

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
                url: action == "update" ? "/api/admin/owner/update" : "/api/admin/owner/create",
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    console.log("Loading...")
                },
                success: function(res) {
                    closeForm();
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

        function removeData(id) {
            let c = confirm("Apakah anda yakin untuk menghapus data ini ?");
            if (c) {
                $.ajax({
                    url: "/api/admin/owner/delete",
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
                url: "/api/admin/owner/update-status",
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
    </script>
@endpush
