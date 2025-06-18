@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Marketing Team</h1>
        <a href="{{ route('marketing') }}" class="btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Marketing</h6>
        </div>
        <div class="card-body">
            <div class="container">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> {{ $error }}
                </div>
                @endforeach
                @endif
                <form action="{{ route('marketing.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Masukan Username" value="{{ old('username') }}" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukan Nama"
                                required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukan Password" required>
                    </div>
                    <input type="hidden" name="role" value="marketing">
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
