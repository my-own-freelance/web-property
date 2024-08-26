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

        /* PROPERTY IMAGE */
        .image-wrapper {
            position: relative !important;
            max-width: 300px;
            height: 300px;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #767676;
            box-sizing: border-box;
        }

        .delete-button i {
            color: white;
        }

        /* END PROPERTY IMAGE */

        /* OWL CAROUSEL */
        col-carousel {
            margin: 70px 0;
        }

        /* owl nav */
        .owl-prev span,
        .owl-next span {
            color: #FFF;
        }

        .owl-prev span:hover,
        .owl-next span:hover {
            color: #8199A3;
        }

        .owl-prev,
        .owl-next {
            position: absolute;
            top: 0;
            height: 100%;
        }

        .owl-prev {
            left: 7px;
        }

        .owl-next {
            right: 7px;
        }

        /* END OWL CAROUSEL */


        /* WRAPPER */
        .info-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: start;
        }

        .info-box {
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            width: 150px;
            text-align: center;
        }

        .info-title {
            font-weight: bold;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 18px;
            color: #000;
        }

        /* END WRAPPER */

        /* INFO DETAIL WRAPPER */
        .info-detail-wrapper {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .info-detail {
            display: flex;
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: bold;
            font-size: 14px;
            color: #333;
            margin-right: 10px;
            white-space: nowrap;
            min-width: 150px;
        }

        .info-value {
            font-size: 14px;
            color: #555;
        }

        /* END INFO DETAIL WRAPPER */


        /* CARD AGEN */
        .card-agen {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        /* END CARD AGEN */
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
                <li class="nav-item"><a class="nav-link text-uppercase" id="tabApproved" data-toggle="tab" href="#objection"
                        role="tab">DISETUJUI</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item"><a class="nav-link text-uppercase" id="tabRejected" data-toggle="tab" href="#complaint"
                        role="tab">DITOLAK</a>
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

        {{-- form pengajuan properti --}}
        <div class="col-md-12" style="display: none" data-action="update" id="formEditable">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5 id="form-title">TAMBAH PENGAJUAN</h5>
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
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="short_title">Judul <span class="text-danger">*</span></label>
                                    <input class="form-control" id="short_title" type="text" name="short_title"
                                        placeholder="masukkan judul properti" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-lg-6">
                                <div class="form-group">
                                    <label for="long_title">Judul Panjang <span class="text-danger">*</span></label>
                                    <input class="form-control" id="long_title" type="text" name="long_title"
                                        placeholder="masukkan judul lengkap properti" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="price">Harga <span class="text-danger">*</span></label>
                                    <input class="form-control" id="price" type="number" min="1" name="price"
                                        placeholder="masukkan harga" required />
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="price_per_meter">Harga/M<sup>2</sup></label>
                                    <input class="form-control" id="price_per_meter" type="number" name="price_per_meter"
                                        placeholder="masukkan harga per meter" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="bedrooms">Kamar Tidur</label>
                                    <input class="form-control" id="bedrooms" type="number" name="bedrooms"
                                        placeholder="jumlah kamar tidur" />
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="bathrooms">Kamar Mandi</label>
                                    <input class="form-control" id="bathrooms" type="number" name="bathrooms"
                                        placeholder="jumlah kamar mandi" />
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="land_sale_area">L. Tanah m<sup>2</sup></label>
                                    <input class="form-control" id="land_sale_area" type="number" name="land_sale_area"
                                        placeholder="luas tanah" />
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="building_sale_area">L. Bangunan m<sup>2</sup></label>
                                    <input class="form-control" id="building_sale_area" type="number"
                                        name="building_sale_area" placeholder="luas bangunan" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="electricity">Listrik (Watt)</label>
                                    <input class="form-control" id="electricity" type="number" name="electricity"
                                        placeholder="masukkan daya listrik" />
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="water">Sumber Air</label>
                                    <select class="form-control form-control" id="water" name="water">
                                        <option value= "">Pilih</option>
                                        <option value="PDAM">PDAM</option>
                                        <option value="SUMUR">SUMUR</option>
                                        <option value="SUMUR BOR">SUMUR BOR</option>
                                        <option value="OTHER">LAIN NYA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="warranty">Garansi</label>
                                    <select class="form-control form-control" id="warranty" name="warranty">
                                        <option value="">Pilih</option>
                                        <option value="Y">Ya</option>
                                        <option value="N">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="facilities">Fasilitas</label>
                                    <input class="form-control" id="facilities" type="text" name="facilities"
                                        placeholder="masukan fasilitas" />
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="youtube">Link Video</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                id="link-addon">https://www.youtube.com/watch?v=</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="kode" aria-label="link"
                                            aria-describedby="link-addon" id="youtube_code" name="youtube_code">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="floor_material">Material Lantai</label>
                                    <input class="form-control" id="floor_material" type="text" name="floor_material"
                                        placeholder="masukan material lantai" />
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="building_material">Material Bangunan</label>
                                    <input class="form-control" id="building_material" type="text"
                                        name="building_material" placeholder="masukan material bangunan" />
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="orientation">Hadap</label>
                                    <input class="form-control" id="orientation" type="text" name="orientation"
                                        placeholder="masukan arah hadap bangunan" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="property_transaction_id">Tipe Transaksi <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-control" id="property_transaction_id"
                                        name="property_transaction_id" required>
                                        <option value = "">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="property_type_id">Tipe Properti <span class="text-danger">*</span></label>
                                    <select class="form-control form-control" id="property_type_id"
                                        name="property_type_id" required>
                                        <option value = "">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="property_certificate_id">Tipe Sertifikat <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-control" id="property_certificate_id"
                                        name="property_certificate_id" required>
                                        <option value = "">Pilih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="province_id">Provinsi <span class="text-danger">*</span></label>
                                    <select class="form-control form-control" id="province_id" name="province_id"
                                        required>
                                        <option value = "">Pilih Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="district_id">Kabupaten <span class="text-danger">*</span></label>
                                    <select class="form-control form-control" id="district_id" name="district_id"
                                        required>
                                        <option value = "">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="sub_district_id">Kecamatan <span class="text-danger">*</span></label>
                                    <select class="form-control form-control" id="sub_district_id" name="sub_district_id"
                                        required>
                                        <option value = "">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input class="form-control" id="address" type="text" name="address"
                                        placeholder="masukan alamat" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-file input-file-image">
                                        <img class="img-upload-preview" width="300" src="http://placehold.it/150x150"
                                            alt="preview">
                                        <input type="file" class="form-control form-control-file" id="uploadImg2"
                                            name="uploadImg2" accept="image/*">
                                        <label for="uploadImg2" class="  label-input-file btn btn-black btn-round">
                                            <span class="btn-label">
                                                <i class="fa fa-file-image"></i>
                                            </span>
                                            Upload Gambar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group form-group-default">
                                    <label for="location">Link Embed Google Maps (hanya masukan link https saja)</label>
                                    <textarea class="form-control" id="maps_location" name="maps_location"
                                        placeholder="https://www.google.com/maps/embed?" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-9">
                                <div class="form-group form-group-default" id="maps_preview">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
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

        {{-- form gallery properry --}}
        <div class="col-md-12" style="display: none" id="formPropertyImage">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>GALLERY PROPERTY</h5>
                    </div>
                    <div class="card-header-right">
                        <button class="btn btn-sm btn-primary" onclick="return addFormImage()">
                            <i class="icon-plus text-white"></i>
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="return closeForm(this)">
                            <i class="ion-android-close"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="boxPropertyImage">
                            <div class="row" id="propertyImage">
                                {{-- rendered image list --}}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12" style="display: none" data-action="update" id="formAddImage">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-header-left">
                                        <h5>Tambah</h5>
                                    </div>
                                    <div class="card-header-right">
                                        <button class="btn btn-sm btn-warning" onclick="return closeFormImage(this)"
                                            id="btnCloseForm">
                                            <i class="ion-android-close"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <form>
                                        <input class="form-control" id="property_id" type="hidden" name="id" />
                                        <div class="form-group">
                                            <label for="property_image">Gambar</label>
                                            <input class="form-control" id="property_image" type="file"
                                                name="property_image" placeholder="upload gambar" required />
                                            <small class="text-danger">Max ukuran 1MB</small>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-primary" type="submit" id="submit">
                                                <i class="ti-save"></i><span>Simpan</span>
                                            </button>
                                            <button class="btn btn-sm btn-default" id="resetImage" type="reset"
                                                style="margin-left : 10px;"><span>Reset</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- box detail --}}
        <div class="col-md-12" style="display: none" id="boxDetail">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>DETAIL PROPERTY</h5>
                    </div>
                    <div class="card-header-right">
                        <button class="btn btn-sm btn-warning" onclick="return closeForm(this)">
                            <i class="ion-android-close"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- carousel --}}
                    <div id="owl-demo3" class="owl-carousel owl-theme owl-img-responsive owl-loaded owl-drag">
                    </div>

                    {{-- title --}}
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h1 id="det-short-title" class="font-weight-bold"></h1>
                            <h2 id="det-price"></h2>
                            <h3 id="det-price-per-meter"></h3>
                            <h2 id="det-long-title"></h2>
                            <div class="info-wrapper d-flex flex-wrap mt-3">
                                {{-- rendered general information --}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h4 class="font-weight-bold">Detail Property</h4>
                            <div class="info-detail-wrapper">
                                {{-- rendered detail information --}}
                            </div>
                        </div>
                    </div>

                    {{-- maps optional view --}}
                    <div class="wrapper-maps">
                    </div>

                    {{-- youtube optional view --}}
                    <div class="wrapper-youtube">

                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold">Deskripsi</h4>
                            <div class="description-wrapper">
                                {{-- rendered description --}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card card-agen">
                                <div class="card-body d-flex flex-column flex-md-row align-items-center">
                                    <div class="d-flex align-items-center mb-3 mb-md-0">
                                        <img src="{{ asset('/dashboard/img/jm_denis.jpg') }}" alt="Agen Image"
                                            class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;"
                                            id="agen-image">
                                        <div class="ml-3">
                                            <h5 class="mb-0 font-weight-bold" id="agen-name"></h5>
                                            <p class="text-muted my-0 py-0" id="agen-position"></p>
                                            <p class="text-muted mb-0 py-0" id="agen-address"></p>
                                        </div>
                                    </div>

                                    <div class="ml-md-auto">
                                        <a href="https://wa.me/NOMOR_WA_AGEN" id="agen-contact" target="_blank"
                                            class="btn btn-success">
                                            <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('/dashboard/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/dashboard/js/plugin/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('/dashboard/js/plugin/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/dashboard/js/plugin/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('/dashboard/js/plugin/owl-carousel/owl.carousel.min.js') }}"></script>

    <script>
        // CKEDITOR
        $('#summernote').summernote({
            placeholder: 'masukkan deskripsi',
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
            tabsize: 2,
            height: 300
        });

        // SELECT SEARCH
        $('#water,#warranty,#property_transaction_id,#property_type_id,#property_certificate_id,#province_id,#district_id,#sub_district_id')
            .select2({
                theme: "bootstrap"
            });

        // owl carousel
        $(document).ready(function() {
            $('#owl-demo3').owlCarousel({
                center: true,
                items: 2,
                loop: true,
                dots: true,
                margin: 10,
                responsive: {
                    600: {
                        items: 4
                    }
                }
            });
        })

        function formatToRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(amount);
        }

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

        function refreshData(tableName) {
            if (tableName == "pending") {
                $("#summernote").summernote('code', "");
                pendingTable.ajax.reload(null, false);
            } else if (tableName == "approved") {
                approvedTable.ajax.reload(null, false);
            } else if (tableName == "rejected") {
                rejectedTable.ajax.reload(null, false);
            }
        }

        // DATA TABLE LOADED
        function pendingDataTable(filter) {
            let url = "/api/admin/property/datatable?admin_approval=pending";
            if (filter) url += '&' + filter;
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
                    data: "custom_info"
                }, {
                    data: "custom_price"
                }, {
                    data: "custom_spec"
                }, {
                    data: "status_approval"
                }, {
                    data: "custom_status"
                }, {
                    data: "views"
                }],
                pageLength: 25,
            });
        }

        function approvedDataTable(filter) {
            let url = "/api/admin/property/datatable?admin_approval=approved";
            if (filter) url += '&' + filter;
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
                    data: "custom_info"
                }, {
                    data: "custom_price"
                }, {
                    data: "custom_spec"
                }, {
                    data: "status_approval"
                }, {
                    data: "custom_status"
                }, {
                    data: "views"
                }],
                pageLength: 25,
            });
        }

        function rejectedDataTable(filter) {
            let url = "/api/admin/property/datatable?admin_approval=rejected";
            if (filter) url += '&' + filter;
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
                    data: "custom_info"
                }, {
                    data: "custom_price"
                }, {
                    data: "custom_spec"
                }, {
                    data: "status_approval"
                }, {
                    data: "custom_status"
                }, {
                    data: "views"
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

        function filterData(tableName) {
            if (tableName == "pending") {
                let dataFilter = {}
                let inputFilter = $("#formFilterPending").serializeArray();
                $.each(inputFilter, function(i, field) {
                    dataFilter[field.name] = field.value;
                });
                pendingTable.clear();
                pendingTable.destroy();
                pendingDataTable($.param(dataFilter))
            } else if (tableName == "approved") {
                let dataFilter = {};
                let inputFilter = $("#formFilterApproved").serializeArray();
                $.each(inputFilter, function(i, field) {
                    dataFilter[field.name] = field.value;
                });
                approvedTable.clear();
                approvedTable.destroy();
                approvedDataTable($.param(dataFilter))
            } else if (tableName == "rejected") {
                let dataFilter = {};
                let inputFilter = $("#formFilterRejected").serializeArray();
                $.each(inputFilter, function(i, field) {
                    dataFilter[field.name] = field.value;
                });
                rejectedTable.clear();
                rejectedTable.destroy();
                rejectedDataTable($.param(dataFilter))
            }
        }
        // END DATA TABLE LOADED


        // CRUD DATA PROPERTY
        function addData() {
            $(".img-upload-preview").attr("src", "");
            $("#formEditable").attr('data-action', 'add').fadeIn(200, function() {
                $("#form-title").html("TAMBAH PENGAJUAN")
                $("#uploadImg2").attr("required", true);
                $("#boxTable").slideUp(200)
            })
            getProvinces()
            getPropTransaction()
            getPropType()
            getPropCertificate()
        }

        function closeForm() {
            $(".img-upload-preview").attr("src", "");
            $("#reset").click();
            $("#formEditable").slideUp(200, function() {
                $("#boxTable").addClass("col-md-12").fadeIn(200);
                $("#summernote").summernote('code', "");
            })

            $("#formPropertyImage").slideUp(200);

            // reset owl carousel
            for (var i = 0; i < $('.owl-item').length; i++) {
                $("#owl-demo3").trigger('remove.owl.carousel', [i])
                    .trigger('refresh.owl.carousel');
            }
            // end reset owl carousel
            $("#boxDetail").slideUp(200);
        }

        function getData(id, action) {
            $.ajax({
                url: `/api/admin/property/${id}/detail`,
                method: "GET",
                dataType: "json",
                success: function(res) {
                    let d = res.data;
                    if (action == "edit") {
                        loadUpdate(d)
                    }

                    if (action == "detail") {
                        loadDetail(d)
                    }

                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("warning", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message);
                }
            })
        }

        function loadUpdate(d) {
            $("#formEditable").attr('data-action', 'update').fadeIn(200, function() {
                $("#form-title").html("TAMBAH PENGAJUAN")
                $("#boxTable").slideUp(200)

                $("#id").val(d.id);
                $("#short_title").val(d.short_title);
                $("#long_title").val(d.long_title);
                $("#price").val(d.price);
                $("#price_per_meter").val(d.price_per_meter);
                $("#bedrooms").val(d.bedrooms);
                $("#bathrooms").val(d.bathrooms);
                $("#land_sale_area").val(d.land_sale_area);
                $("#building_sale_area").val(d.building_sale_area);
                $("#electricity").val(d.electricity);
                $("#water").val(d.water).change();
                $("#warranty").val(d.warranty).change();
                $("#facilities").val(d.facilities);
                $("#youtube_code").val(d.youtube_code);
                $("#floor_material").val(d.floor_material);
                $("#building_material").val(d.building_material);
                $("#orientation").val(d.orientation);
                $("#address").val(d.address);
                $("#summernote").summernote('code', d.description);
                $("#maps_location").val(d.maps_location);
                if (d.maps_location && d.maps_preview) {
                    $("#maps_preview").empty().append(d.maps_preview);
                }

                getPropTransaction(true, d.property_transaction_id)
                getPropType(true, d.property_type_id)
                getPropCertificate(true, d.property_certificate_id)

                if (d.province_id && d.district_id && d.sub_district_id) {
                    getProvinces(true, d.province_id);
                    getDistricts(d.province_id, true, d.district_id);
                    getSubDistricts(d.district_id, true, d.sub_district_id);
                } else {
                    getProvinces();
                }
                $("#uploadImg2").attr("required", false);
                $(".img-upload-preview").attr("src", d.image);
            })
        }

        function loadDetail(data) {
            $("#boxDetail").fadeIn(200, function() {
                $("#boxTable").slideUp(200);
                // reset rendered element
                $(".info-wrapper").empty();
                $(".info-detail-wrapper").empty();
                $(".wrapper-maps").empty()
                $(".wrapper-youtube").empty();
                $(".description-wrapper").empty();
                // end reset

                // load owl carousel
                const mainElImage = $(` <div class="item">
                                            <img class="img-fluid" src="${data.image}" alt="Owl Image">
                                        </div>`);
                $("#owl-demo3").owlCarousel('add', mainElImage).owlCarousel('update');

                $.each(data.property_images, function(index, item) {
                    const elImage = $(`<div class="item">
                                            <img class="img-fluid" src="${item.image}" alt="Owl Image">
                                        </div> `);
                    $("#owl-demo3").owlCarousel('add', elImage).owlCarousel('update');
                })

                // load title
                $("#det-short-title").html(data.short_title);
                $("#det-price").html(formatToRupiah(data.price));
                if (data.price_per_meter) {
                    $("#det-price-per-meter").html(`${formatToRupiah(data.price_per_meter)}/m<sup>2</sup>`);
                }
                $("#det-long-title").html(data.long_title);

                // general information
                if (data.bedrooms) {
                    $(".info-wrapper").append(generateInfoBox("K. Tidur", data.bedrooms));
                }

                if (data.bathrooms) {
                    $(".info-wrapper").append(generateInfoBox("K. Mandi", data.bathrooms));
                }

                if (data.land_sale_area) {
                    $(".info-wrapper").append(generateInfoBox("L. Tanah", `${data.land_sale_area} m<sup>2</sup>`));
                }

                if (data.building_sale_area) {
                    $(".info-wrapper").append(generateInfoBox("L. Bangunan",
                        `${data.building_sale_area} m<sup>2</sup>`));
                }

                //DETAIL PROPERTY
                const availableStatus = data.is_available == "Y" ?
                    '<div class="badge badge-success">Tersedia</div>' :
                    '<div class="badge badge-danger">Tidak Tersedia</div>'

                if (data.is_available) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Status", availableStatus));
                }

                if (data.address) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Alamat", data.address));
                }
                const lokasi = `${data.province}, ${data.district}, ${data.sub_district}`;
                $(".info-detail-wrapper").append(generateInfoDetail("Lokasi", lokasi));

                if (data.property_type) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Tipe", data.property_type));
                }

                if (data.property_transaction) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Transaksi", data.property_transaction));
                }

                if (data.property_certificate) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Sertifikat", data.property_certificate));
                }

                if (data.land_sale_area) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Luas Tanah",
                        `${data.land_sale_area} m<sup>2</sup>`));
                }

                if (data.building_sale_area) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Luas Bangunan",
                        `${data.building_sale_area} m<sup>2</sup>`));
                }

                if (data.electricity) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Listrik", `${data.electricity} Watt`));
                }

                if (data.warranty) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Garansi",
                        `${data.warranty == "Y" ? "Ya" : "Tidak"}`));
                }

                if (data.floor_material) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Material Lantai",
                        `${data.floor_material}`));
                }

                if (data.building_material) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Material Bangunan",
                        `${data.building_material}`));
                }

                if (data.facilities) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Fasilitas", `${data.facilities}`));
                }

                if (data.water) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Sumber Air", `${data.water}`));
                }

                if (data.orientation) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Hadap", `${data.orientation}`));
                }

                if (data.listed_on) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Terdaftar Pada",
                        `${moment(data.listed_on).format('DD MMMM YYYY')}`));
                }

                if (data.code) {
                    $(".info-detail-wrapper").append(generateInfoDetail("Kode Property", `${data.code}`));
                }

                // MAPS PROPERTY
                if (data.maps_location && data.maps_preview) {
                    console.log("ada nih")
                    $(".wrapper-maps").append(`
                            <hr>
                            <div class="col-md-6">
                                <h4 class="font-weight-bold">Maps Properti</h4>
                                <div class="form-group form-group-default" id="maps_preview">
                                    ${data.maps_preview}
                                </div>
                            </div>
                        `);
                }
                // VIDEO YOUTUBE VIEW
                if (data.youtube_code && data.youtube_code != "") {
                    $(".wrapper-youtube").append(`
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold">Video Properti</h4>
                            <div style="max-width: 560px;">
                                <iframe 
                                    width="560" 
                                    height="315" 
                                    src="https://www.youtube.com/embed/${data.youtube_code}" 
                                    title="YouTube video player" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                    `)
                }
                // DESCRIPTION PROPERTY
                $(".description-wrapper").append(data.description);

                // AGEN PROPERTY
                if (data.agen?.image) {
                    $("#agen-image").attr("src", data.agen.image);
                }

                $("#agen-name").html(data.agen?.name);
                $("#agen-position").html(data.agen?.position);
                $("#agen-address").html(data.agen?.address);
                $("#agen-contact").attr("href", data.contact_agen)

            })
        }

        function generateInfoBox(label, value) {
            return $(`<div class="info-box">
                        <div class="info-title">${label}</div>
                        <div class="info-value">${value}</div>
                    </div>`)
        }

        function generateInfoDetail(label, value) {
            return $(`<div class="info-detail">
                        <div class="info-label">${label}</div>
                        <div class="info-value">${value}</div>
                    </div>`)
        }

        $("#formEditable form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append("id", parseInt($("#id").val()));
            formData.append("short_title", $("#short_title").val());
            formData.append("long_title", $("#long_title").val());
            formData.append("price", parseInt($("#price").val()));

            if (!isNaN(parseInt($("#price_per_meter").val()))) {
                formData.append("price_per_meter", parseInt($("#price_per_meter").val()));
            }
            if (!isNaN(parseInt($("#bedrooms").val()))) {
                formData.append("bedrooms", parseInt($("#bedrooms").val()));
            }
            if (!isNaN(parseInt($("#bathrooms").val()))) {
                formData.append("bathrooms", parseInt($("#bathrooms").val()));
            }
            if (!isNaN(parseInt($("#land_sale_area").val()))) {
                formData.append("land_sale_area", parseInt($("#land_sale_area").val()));
            }
            if (!isNaN(parseInt($("#building_sale_area").val()))) {
                formData.append("building_sale_area", parseInt($("#building_sale_area").val()));
            }
            if (!isNaN(parseInt($("#electricity").val()))) {
                formData.append("electricity", parseInt($("#electricity").val()));
            }

            formData.append("water", $("#water").val());
            formData.append("warranty", $("#warranty").val());
            formData.append("facilities", $("#facilities").val());
            formData.append("youtube_code", $("#youtube_code").val());
            formData.append("floor_material", $("#floor_material").val());
            formData.append("building_material", $("#building_material").val());
            formData.append("orientation", $("#orientation").val());

            formData.append("property_transaction_id", parseInt($("#property_transaction_id").val()));
            formData.append("property_type_id", parseInt($("#property_type_id").val()));
            formData.append("property_certificate_id", parseInt($("#property_certificate_id").val()));

            formData.append("province_id", parseInt($("#province_id").val()));
            formData.append("district_id", parseInt($("#district_id").val()));
            formData.append("sub_district_id", parseInt($("#sub_district_id").val()));
            formData.append("address", $("#address").val());
            formData.append("image", document.getElementById("uploadImg2").files[0]);
            formData.append("maps_location", $("#maps_location").val());

            formData.append("description", $("#summernote").summernote('code'));

            saveData(formData, $("#formEditable").attr("data-action"));
            return false;
        });

        function saveData(data, action) {
            $.ajax({
                url: action == "update" ? "/api/admin/property/update" : "/api/admin/property/create",
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
                    if (action == "update") {
                        refreshData("pending");
                        refreshData("approved");
                        refreshData("rejected");
                    } else {
                        refreshData("pending")
                    }

                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message);
                }
            })
        }

        function updateStatus(id, status, tabStatus) {
            let c = confirm(`Anda yakin ingin mengubah status ke ${status} ?`)
            if (c) {
                let dataToSend = new FormData();
                dataToSend.append("id", id);
                if (["Draft", "Publish"].includes(status)) {
                    dataToSend.append("is_publish", status == "Draft" ? "N" : "Y");
                } else if (["Sold", "ForSale"].includes(status)) {
                    dataToSend.append("is_available", status == "Sold" ? "N" : "Y");
                }
                updateStatusData(dataToSend, tabStatus);
            }
        }

        function updateStatusData(data, tabStatus) {
            $.ajax({
                url: "/api/admin/property/update-status",
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    console.log("Loading...")
                },
                success: function(res) {
                    showMessage("success", "flaticon-alarm-1", "Sukses", res.message);
                    refreshData(`${tabStatus.toLowerCase()}`);
                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message);
                }
            })
        }

        function updateApproval(id, oldStatus, newStatus) {
            let c = confirm(`Anda yakin ingin mengubah approval ke ${newStatus.toUpperCase()} ?`)

            if (c) {
                let dataToSend = new FormData();
                dataToSend.append("id", id);
                dataToSend.append("admin_approval", newStatus);

                $.ajax({
                    url: "/api/admin/property/approve-status",
                    contentType: false,
                    processData: false,
                    method: "POST",
                    data: dataToSend,
                    beforeSend: function() {
                        console.log("Loading...")
                    },
                    success: function(res) {
                        showMessage("success", "flaticon-alarm-1", "Sukses", res.message);
                        refreshData(oldStatus);
                        refreshData(newStatus);
                    },
                    error: function(err) {
                        console.log("error :", err);
                        showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                            ?.message);
                    }
                })
            }
        }
        // END CRUD DATA PROPERTY



        // CRUD GALLERY IMAGE PROPERTY
        function addGallery(property_id) {
            $("#formPropertyImage").fadeIn(200, function() {
                $("#boxTable").slideUp(200);
                galleryList(property_id)
            })
        }

        function addFormImage() {
            $("#formAddImage").fadeIn(200, function() {
                $("#boxPropertyImage").removeClass("col-md-12").addClass("col-md-8")
            })
        }

        function closeFormImage() {
            $("#formAddImage").slideUp(200, function() {
                $("#boxPropertyImage").removeClass("col-md-8").addClass("col-md-12");
                $("#resetImage").click();
            })
        }

        $("#formAddImage form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append("property_id", $("#property_id").val());
            formData.append("image", document.getElementById("property_image").files[0]);
            savePropertyImage(formData);
            return false;
        });

        function savePropertyImage(data, action) {
            $.ajax({
                url: "/api/admin/property-image/create",
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    console.log("Loading...")
                },
                success: function(res) {
                    closeFormImage();
                    showMessage("success", "flaticon-alarm-1", "Sukses", res.message);
                    galleryList($("#property_id").val());
                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message);
                }
            })
        }

        function removeProperyImage(id) {
            let c = confirm("Apakah anda yakin untuk menghapus data ini ?");
            if (c) {
                $.ajax({
                    url: "/api/admin/property-image/delete",
                    method: "DELETE",
                    data: {
                        id: id
                    },
                    beforeSend: function() {
                        console.log("Loading...")
                    },
                    success: function(res) {
                        galleryList($("#property_id").val());
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

        function galleryList(property_id) {
            $.ajax({
                url: `/api/admin/property-image/${property_id}/list`,
                header: {
                    "Content-Type": "application/json",
                },
                method: "GET",
                success: function(res) {
                    $("#propertyImage").empty();
                    $("#title").html(res.title);
                    $("#property_id").val(property_id);
                    $.each(res.data, function(index, item) {
                        const elImage = $(`
                            <div class='col col-md-3 col-sm-6 col-12'>
                                <div class='image-wrapper mb-3 border' style='padding:5px!important;'>
                                    <img src='${item.image}' alt='Gambar 1' class='img-fluid'>
                                    <button class='btn delete-button' onclick='return removeProperyImage("${item.id}")' href='javascript:void(0);'>
                                        <i class='fas fa-trash ml-1'></i>
                                    </button>
                                </div>
                            </div>
                        `);
                        $("#propertyImage").append(elImage);
                    });
                },
                error: function(err) {
                    console.log("error :", err);
                    showMessage("danger", "flaticon-danger", "Peringatan", err.message || err.responseJSON
                        ?.message);
                    $("#propertyImage").empty();
                }

            })
        }
        // END CRUD GALLERY IMAGE PROPERTY


        // FUNCTION DROPDOWN DATA
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

        function getPropTransaction(onDetail = false, id = null) {
            $.ajax({
                url: `/api/dropdown/property-transaction`,
                method: "GET",
                header: {
                    "Content-Type": "application/json"
                },
                beforeSend: function() {
                    console.log("Sending data...!")
                },
                success: function(res) {
                    // update input form
                    $("#property_transaction_id").empty();
                    $('#property_transaction_id').append("<option value =''>Pilih</option > ");
                    $.each(res.data, function(index, r) {
                        $('#property_transaction_id').append("<option value = '" + r.id + "' > " + r
                            .name + " </option > ");
                    })

                    if (onDetail) {
                        $("#property_transaction_id").val(id);
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

        function getPropType(onDetail = false, id = null) {
            $.ajax({
                url: `/api/dropdown/property-type`,
                method: "GET",
                header: {
                    "Content-Type": "application/json"
                },
                beforeSend: function() {
                    console.log("Sending data...!")
                },
                success: function(res) {
                    // update input form
                    $("#property_type_id").empty();
                    $('#property_type_id').append("<option value =''>Pilih</option > ");
                    $.each(res.data, function(index, r) {
                        $('#property_type_id').append("<option value = '" + r.id + "' > " + r
                            .name + " </option > ");
                    })

                    if (onDetail) {
                        $("#property_type_id").val(id);
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

        function getPropCertificate(onDetail = false, id = null) {
            $.ajax({
                url: `/api/dropdown/property-certificate`,
                method: "GET",
                header: {
                    "Content-Type": "application/json"
                },
                beforeSend: function() {
                    console.log("Sending data...!")
                },
                success: function(res) {
                    // update input form
                    $("#property_certificate_id").empty();
                    $('#property_certificate_id').append("<option value =''>Pilih</option > ");
                    $.each(res.data, function(index, r) {
                        $('#property_certificate_id').append("<option value = '" + r.id + "' > " + r
                            .name + " </option > ");
                    })

                    if (onDetail) {
                        $("#property_certificate_id").val(id);
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
        // END FUNCTION DROPDOWN DATA
    </script>
@endpush
