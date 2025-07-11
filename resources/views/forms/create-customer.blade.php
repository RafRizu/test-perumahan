@extends('layouts.app')
@section('content')
<div class="container">

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Customer</h1>
        <!-- <a href="{{ route('unit-group.index') }}" class="btn btn-sm btn-primary shadow-sm"><i -->
        <!--         class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a> -->
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Customer</h6>
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
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="partner_name" class="form-label">Partner Name</label>
                            <input type="text" class="form-control" id="partner_name" name="partner_name" value="{{ old('partner_name') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="national_id" class="form-label">National ID</label>
                            <input type="text" class="form-control" id="national_id" name="national_id" value="{{ old('national_id') }}" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="partner_national_id" class="form-label">Partner National ID</label>
                            <input type="text" class="form-control" id="partner_national_id" name="partner_national_id" value="{{ old('partner_national_id') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="partner_birth_date" class="form-label">Partner Birth Date</label>
                            <input type="date" class="form-control" id="partner_birth_date" name="partner_birth_date" value="{{ old('partner_birth_date') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-control" id="payment_status" name="payment_status" required>
                                <option value="">Select Status</option>
                                <option value="reject">Reject</option>
                                <option value="qualify">Qualify</option>
                            </select>
                        </div>
                        {{-- <div class="col-12 col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="booked">Booking</option>
                                <option value="ordered">Order</option>
                            </select>
                        </div> --}}
                        <div class="col-12 col-md-6 mb-3" id="solution_box">
                            <label for="solution" class="form-label">Solution</label>
                            <select name="solution" id="solution" class="form-control" disabled>
                                <option value="">Select Solution</option>
                                <option value="Takeover Bank">Takeover Bank</option>
                                <option value="Clearing Payment">Clearing Payment</option>
                                <option value="Change Credit Name">Change Credit Name</option>
                                <option value="Repayment">Repayment</option>
                            </select>
                        </div>
                        <input type="hidden" name="status" value="ordered">
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="unit_group_id" class="form-label">Unit Group</label>
                            <select class="form-control" id="unit_group_id" name="unit_group_id" required>
                                <option value="">Select Unit Group</option>
                                @foreach ($unit_groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="unit_id" class="form-label">Unit</label>
                            <select class="form-control" id="unit_id" name="unit_id" required>
                                <option value="">Select Unit</option>
                            </select>
                        </div>
                    </div>
                    {{-- TODO: Fix this? --}}
                    {{-- <input type="hidden" name="referral_id" value="{{Auth::user()->referral->id}}"> --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')

@endpush
@endsection
