<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h5 class="text-uppercase title">Data Properti Diajukan</h5>
        </div>
        <div class="card-header-right">
            <button class="btn btn-mini btn-info mr-1" onclick="return refreshData('pending');">Refresh</button>
            @if ($user->role == 'agen')
                <button class="btn btn-mini btn-primary" onclick="return addData();">Tambah</button>
            @endif
        </div>
        <form class="navbar-left navbar-form mr-md-1 mt-3" id="formFilterPending">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="property_transaction_id">Filter Transaksi</label>
                        <select class="form-control" id="property_transaction_id" name="property_transaction_id">
                            <option value="">All</option>
                            @foreach ($transactions as $transaction)
                                <option value = "{{ $transaction->id }}">{{ $transaction->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="property_type_id">Filter Type</label>
                        <select class="form-control" id="property_type_id" name="property_type_id">
                            <option value="">All</option>
                            @foreach ($types as $type)
                                <option value = "{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="property_certificate_id">Filter Sertifikat</label>
                        <select class="form-control" id="property_certificate_id" name="property_certificate_id">
                            <option value="">All</option>
                            @foreach ($certificates as $certificate)
                                <option value = "{{ $certificate->id }}">{{ $certificate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="pt-3">
                        <button class="mt-4 btn btn-sm btn-success mr-3" type="button"
                            onclick="filterData('pending')">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-block">
        <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered nowrap dataTable" id="pendingDataTable">
                <thead>
                    <tr>
                        <th class="all">#</th>
                        <th class="all">Gambar</th>
                        <th class="all">Information</th>
                        <th class="all">Harga</th>
                        <th class="all">Spesifikasi</th>
                        <th class="all">Approval</th>
                        <th class="all">Status</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center"><small>Tidak Ada Data</small></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
