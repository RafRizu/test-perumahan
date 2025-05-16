@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-muted mt-4">Marketing Team</h3>

<div class="d-flex justify-content-center" style="margin-top: 80px;">
    <div class="card shadow" style="width: 100%; max-width: 700px;">
        <div class="card-body">
            <h3 class="card-title text-center fw-bold mb-4">Add Marketing Team</h3>
            <form action="{{ route('marketing.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label text-muted">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text-muted">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-muted">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                </div>
                <input type="hidden" name="role" value="marketing">
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
