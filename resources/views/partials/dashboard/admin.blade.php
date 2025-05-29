<div class="card shadow-sm mb-4">
    <div class="card-header font-weight-bold text-primary">Data Customer</div>
    <div class="card-body p-3 table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Unit</th>
                    <th>Unit Group</th>
                    <th>Status</th>
                    <th>Approval Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dummy data -->
                <tr>
                    <td>1</td>
                    <td>Andi Saputra</td>
                    <td>07</td>
                    <td>A1</td>
                    <td><span class="badge badge-warning">ORDER</span></td>
                    <td><span class="badge badge-success">Approve</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                            data-target="#detailCustomerModal">Detail</a>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Change
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">BOOKING</a>
                                <a class="dropdown-item" href="#">DP</a>
                                <a class="dropdown-item" href="#">AKAD</a>
                            </div>
                        </div>
                        <a href="#" class="btn btn-success btn-sm">Approval</a>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Andi Saputra</td>
                    <td>07</td>
                    <td>A1</td>
                    <td><span class="badge badge-warning">ORDER</span></td>
                    <td><span class="badge badge-success">Approve</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                            data-target="#detailCustomerModal">Detail</a>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Change
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">BOOKING</a>
                                <a class="dropdown-item" href="#">DP</a>
                                <a class="dropdown-item" href="#">AKAD</a>
                            </div>
                        </div>
                        <a href="#" class="btn btn-success btn-sm">Approval</a>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- End of PageContent -->

<!-- Modal Detail Customer -->
<div class="modal fade" id="detailCustomerModal" tabindex="-1" role="dialog" aria-labelledby="detailCustomerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="detailCustomerModalLabel">Detail Customer</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th>Nama</th>
                        <td>Andi Saputra</td>
                    </tr>
                    <tr>
                        <th>Nama Pasangan</th>
                        <td>Siti Nurhaliza</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>1234567890123456</td>
                    </tr>
                    <tr>
                        <th>NIK Pasangan</th>
                        <td>6543210987654321</td>
                    </tr>
                    <tr>
                        <th>Usia</th>
                        <td>30 tahun</td>
                    </tr>
                    <tr>
                        <th>Usia Pasangan</th>
                        <td>28 tahun</td>
                    </tr>
                    <tr>
                        <th>Unit Group</th>
                        <td>A1</td>
                    </tr>
                    <tr>
                        <th>Unit</th>
                        <td>07</td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning btn-sm"><i class="fas fa-pen"></i> Edit</button>
                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                <button class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
</div>
