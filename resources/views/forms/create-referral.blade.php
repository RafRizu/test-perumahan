@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Create Referral Member</h2>
    <form action="{{ route('referral.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="marketing" class="form-label">Marketing Team</label>
            <select class="form-select" id="marketing" name="marketing_team_id" required>
                <option value="" disabled selected>Select Marketing Team</option>
                @foreach($marketing as $marketings)
                    <option value="{{ $marketings->id }}">{{ $marketings->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <input type="hidden" name="role" value="referral">
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

@endsection
