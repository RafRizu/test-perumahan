@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> {{ $error }}
    </div>
    @endforeach
    @endif

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{ session()->get('success') }}
    </div>
    @endif


    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers</h1>
        <a href="{{ route('customer.create') }}" class="btn btn-sm btn-success shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Customers</a>
    </div>

    <div class="card shadow mb-4">
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
                    @php
                    $no = 1
                    @endphp
                    @foreach ($customers as $c)
                    <tr class="">
                        <td>{{ $no++ }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->unit->name }}</td>
                        <td>{{ $c->unit->unitGroup->name }}</td>
                        <td>
                            <span @class([
                                'text-uppercase',
                                'badge',
                                'badge-warning'=> $c->status == "ordered",
                                'badge-success' => $c->status == "booked",
                                'badge-info' => $c->status == "dp",
                                ])>
                                {{ $c->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span @class([
                                'text-uppercase',
                                'badge',
                                'badge-success' => $c->approval_status == "approved",
                                'badge-secondary' => $c->approval_status == "pending",
                                'badge-danger' => $c->approval_status == "rejected",
                                ])>
                                {{ $c->approval_status }}
                            </span>
                        </td>
                        <td class="d-flex align-items-center justify-content-center text-nowrap" style="gap: .75rem;">
                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Detail</a>

                            @if (in_array($user->role, ["admin", "superadmin"] ))
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-exchange"></i> Change
                                </button>
                                <div class="dropdown-menu dropdown-menu-right text-uppercase">
                                    <a class="dropdown-item" href="#">booked</a>
                                    <a class="dropdown-item" href="#">dp</a>
                                    <a class="dropdown-item" href="#">akad</a>
                                </div>
                            </div>
                            @endif

                            @if ($user->role == "superadmin")
                            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Approval</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End of PageContent -->

    <!-- Modal Detail Customer -->
    <div class="modal fade" id="detailCustomerModal" tabindex="-1" role="dialog"
        aria-labelledby="detailCustomerModalLabel" aria-hidden="true">
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

    <!-- Content Row -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> -->
@endsection
