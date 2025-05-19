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
        <h1 class="h3 mb-0 text-gray-800">Referrals</h1>
        <a href="{{ route('referral.create') }}" class="btn btn-sm btn-success shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Referral</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Referrals</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive overflow-auto">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-nowarp">
                        <tr class="text-nowarp">
                            <th>No</th>
                            <th>Nama</th>
                            <th class="text-nowarp">Marketing Team</th>
                            <th>User_id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="text-nowarp">
                            <th>No</th>
                            <th>Nama</th>
                            <th class="text-nowarp">Marketing Team</th>
                            <th>User_id</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $no = 1
                        @endphp
                        @foreach ($referrals as $r)
                        <tr class="">
                            <td>{{ $no++ }}</td>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->marketing_team_id }}</td>
                            <td>{{ $r->user_id }}</td>
                            <td class="d-flex align-items-center justify-content-center text-nowrap">
                                <a href="#" class="btn btn-primary"><i class="fas fa-search"></i> Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
