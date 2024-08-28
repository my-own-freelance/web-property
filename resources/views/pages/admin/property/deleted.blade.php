<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h5 class="text-uppercase title">Data Properti Dihapus</h5>
        </div>
        <div class="card-header-right">
            <button class="btn btn-mini btn-info mr-1" onclick="return refreshData('deleted');">Refresh</button>
        </div>
        <form class="navbar-left navbar-form mr-md-1 mt-3" id="formFilterDeleted">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="trx_id">Filter Transaksi</label>
                        <select class="form-control" id="trx_id" name="trx_id">
                            <option value="">All</option>
                            @foreach ($transactions as $transaction)
                                <option value = "{{ $transaction->id }}">{{ $transaction->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="type_id">Filter Type</label>
                        <select class="form-control" id="type_id" name="type_id">
                            <option value="">All</option>
                            @foreach ($types as $type)
                                <option value = "{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="crt_id">Filter Sertifikat</label>
                        <select class="form-control" id="crt_id" name="crt_id">
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
                            onclick="filterData('deleted')">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-block">
        <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered nowrap dataTable" id="deletedDataTable">
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
