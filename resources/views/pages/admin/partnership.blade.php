@extends('layouts.dashboard')
@section('title', $title)
@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/css/toggle-status.css') }}">
    <style>
        .wrap-text {
            max-width: 400px;
            word-wrap: break-word;
            white-space: normal;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-5">
        <div class="col-md-12" id="boxTable">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5 class="text-uppercase title">partnership</h5>

                    </div>
                    <div class="card-header-right">
                        <button class="btn btn-mini btn-info mr-1" onclick="return refreshData();">Refresh</button>
                        <button class="btn btn-mini btn-primary" onclick="return addData();">Tambah Data</button>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered nowrap dataTable" id="partnershipTable">
                            <thead>
                                <tr>
                                    <th class="all">#</th>
                                    <th class="all">Nama</th>
                                    <th class="all">Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-center"><small>Tidak Ada Data</small></td>
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
                        <h5>Tambah / Edit Data</h5>
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
                                placeholder="nama partner" required />
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar Partnership</label>
                            <input class="form-control" id="image" type="file" name="image"
                                placeholder="upload gambar" required />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit">
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
    <script>
        let dTable = null;

        $(function() {
            dataTable();
        });

        function dataTable() {
            const url = "/api/admin/partnership/datatable";
            dTable = $('#partnershipTable').DataTable({
                searching: true,
                ordering: true,
                lengthChange: true,
                responsive: true,
                processing: true,
                serverSide: true,
                searchDelay: 1000,
                paging: true,
                lengthMenu: [5, 10, 25, 50, 100],
                ajax: url,
                columns: [{
                    data: 'action',
                }, {
                    data: 'name',
                }, {
                    data: 'image',
                }],
                pageLength: 10,
            });
        }

        function refreshData() {
            dTable.ajax.reload(null, false);
        }

        function addData() {
            $("#formEditable").attr('data-action', 'add').fadeIn(200);
            $("#boxTable").removeClass("col-md-12").addClass("col-md-8");
            $("#name").focus();
            $("#image").attr("required", true);
        }

        function closeForm() {
            $("#image").attr("required", true);
            $("#formEditable").slideUp(200, function() {
                $("#boxTable").removeClass("col-md-8").addClass("col-md-12");
                $("#reset").click();
            })
        }

        function getData(id) {
            $.ajax({
                url: `/api/admin/partnership/${id}/detail`,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    $("#formEditable").attr("data-action", "update").fadeIn(200, function() {
                        $(this).attr('data-action', 'update');
                        $("#boxTable").removeClass("col-md-12").addClass("col-md-8");
                        let d = response.data;
                        $("#image").removeAttr("required");
                        $("#id").val(d.id);
                        $("#name").val(d.name);
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
            let image = document.getElementById("image").files[0];

            let dataToSend = new FormData()
            dataToSend.append("id", parseInt($("#id").val()));
            dataToSend.append("name", $("#name").val());
            dataToSend.append("image", image);

            saveData(dataToSend, $("#formEditable").attr("data-action"));
            return false;
        });

        function saveData(data, action) {
            $.ajax({
                url: action == "update" ? "/api/admin/partnership/update" : "/api/admin/partnership/create",
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    console.log("Loadig...")
                },
                success: function(data) {
                    closeForm();
                    dTable.ajax.reload(null, false);
                    $("#image").attr("required", true);
                    showMessage('success', 'flaticon-alarm-1', 'Sukses', data.message);
                },
                error: function(err) {
                    console.log('error :', err);
                    showMessage('danger', 'flaticon-error', 'Peringatan', err.message || err.responseJSON
                        ?.message);
                }
            })
        }

        function removeData(id) {
            let c = confirm("Anda yakin ingin menghapus data ini ?")
            if (c) {
                $.ajax({
                    url: '/api/admin/partnership/delete',
                    data: {
                        id: id,
                    },
                    method: "DELETE",
                    beforeSend: function() {
                        console.log("Loading...")
                    },
                    success: function(data) {
                        dTable.ajax.reload(null, false);
                        showMessage("success", "flaticon-alarm-1", "Sukses", data.message);
                    },
                    error: function(err) {
                        console.log("error :", err);
                        showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                            ?.message);
                    }
                })
            }
        }
    </script>
@endpush
