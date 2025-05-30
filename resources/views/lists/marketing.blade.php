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
        <h1 class="h3 mb-0 text-gray-800">Marketing</h1>
        <button class="btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#addMarketingModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Marketing
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Marketing Team</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive overflow-auto">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <th>1</th>
                            <th>Heru</th>
                            <th>MARKETING 1</th>
                            <th>1234567</th>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>

    <!-- Add Marketing Modal -->
    <div class="modal fade" id="addMarketingModal" tabindex="-1" role="dialog" aria-labelledby="addMarketingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('marketing.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="addMarketingModalLabel">Add Marketing Team</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- End Container -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@endsection
