@extends('layouts.dashboard')
@section('title', $title)
@push('styles')
    <link rel="stylesheet" href="{{ asset('/dashboard/css/toggle-status.css') }}">
    <style>
        .wrap-text {
            max-width: 500px;
            word-wrap: break-word;
            white-space: normal;
        }
    </style>
@endpush
@section('content')
    <div class="row mb-5 mt--5">
        <div class="col-md-12" id="boxTable">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active text-uppercase" id="tabPending" data-toggle="tab"
                        href="#request" role="tab">DIAJUKAN</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item"><a class="nav-link text-uppercase" id="tabApproved" data-toggle="tab"
                        href="#objection" role="tab">DISETUJUI</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item"><a class="nav-link text-uppercase" id="tabRejected" data-toggle="tab"
                        href="#complaint" role="tab">DITOLAK</a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="tab-content card-block" style="padding: 0px; padding-top: 1.25em">
                <div class="tab-pane active" id="pending" role="tabpanel">
                    <center>
                        <h5>Loading ....</h5>
                    </center>
                </div>
                <div class="tab-pane" id="approved">
                    <center>
                        <h5>Loading ....</h5>
                    </center>
                </div>
                <div class="tab-pane" id="rejected">
                    <center>
                        <h5>Loading .... </h5>
                    </center>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('/dashboard/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        let pendingTable = null;
        let approvedTable = null;
        let rejectedTable = null;


        $(function() {
            $("#pending").load("/admin/property/pending", function() {
                pendingDataTable()
            })
            $("#approved").load("/admin/property/approved", function() {
                approvedDataTable()
            })
            $("#rejected").load("/admin/property/rejected", function() {
                rejectedDataTable()
            })

            $(".tab-pane").hide()
            $("#pending").show()


            $("#tabPending").click(function() {
                showTab("pending")
            })

            $("#tabApproved").click(function() {
                showTab("approved")
            })

            $("#tabRejected").click(function() {
                showTab("rejected")
            })
        })


        function showTab(tabName) {
            $(".tab-pane").hide();
            $('#' + tabName).show();
        }

        function getData(id) {
            $.ajax({
                url: `/api/admin/property/${id}/detail`,
                method: "GET",
                dataType: "json",
                success: function(res) {
                    let d = res.data
                    if (d.type == "request") {
                        showRequestModal(d)
                    }

                    if (d.type == "objection") {
                        showObjectionModal(d)
                    }

                    if (d.type == "complaint") {
                        showComplaintModal(d)
                    }

                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("warning", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message);
                }
            })
        }

        function refreshData(tableName) {
            if (tableName == "pending") {
                pendingTable.ajax.reload(null, false);
            } else if (tableName == "approved") {
                approvedTable.ajax.reload(null, false);
            } else if (tableName == "rejected") {
                rejectedTable.ajax.reload(null, false);
            }
        }

        function pendingDataTable() {
            const url = "/api/admin/property/datatable?admin_approval=pending";
            pendingTable = $("#pendingDataTable").DataTable({
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
                    data: "image"
                }, {
                    data: "custom_title"
                }, {
                    data: "custom_price"
                }, {
                    data: "custom_spec"
                }, {
                    data: "status_approval"
                }, {
                    data: "custom_status"
                }, {
                    $data: "views"
                }],
                pageLength: 25,
            });
        }

        function approvedDataTable() {
            const url = "/api/admin/property/datatable?admin_approval=approved";
            approvedTable = $("#approvedDataTable").DataTable({
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
                    data: "image"
                }, {
                    data: "custom_title"
                }, {
                    data: "custom_price"
                }, {
                    data: "custom_spec"
                }, {
                    data: "status_approval"
                }, {
                    data: "custom_status"
                }, {
                    $data: "views"
                }],
                pageLength: 25,
            });
        }


        function rejectedDataTable() {
            const url = "/api/admin/property/datatable?admin_approval=rejected";
            rejectedTable = $("#rejectedDataTable").DataTable({
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
                    data: "image"
                }, {
                    data: "custom_title"
                }, {
                    data: "custom_price"
                }, {
                    data: "custom_spec"
                }, {
                    data: "status_approval"
                }, {
                    data: "custom_status"
                }, {
                    $data: "views"
                }],
                pageLength: 25,
            });
        }


        function removeData(id, type) {
            let c = confirm("Apakah anda yakin untuk menghapus data ini ?");
            if (c) {
                $.ajax({
                    url: "/api/admin/property/delete",
                    method: "DELETE",
                    data: {
                        id: id
                    },
                    beforeSend: function() {
                        console.log("Loading...")
                    },
                    success: function(res) {
                        refreshData(type);
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
    </script>
@endpush
