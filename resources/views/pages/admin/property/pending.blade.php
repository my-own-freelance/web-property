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
