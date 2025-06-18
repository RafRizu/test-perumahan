@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Referrals</h1>
        <a href="{{ route('referral') }}" class="btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Referral</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('referral.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="marketing" class="form-label">Marketing Team</label>
                        <select class="form-control" id="marketing" name="marketing_team_id" required>
                            <option value="" disabled selected>Select Marketing Team</option>
                            @foreach($marketing as $marketings)
                            <option value="{{ $marketings->id }}">{{ $marketings->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="role" value="referral">
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
