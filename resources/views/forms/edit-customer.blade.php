@extends('layouts.app')
@section('content')
<div class="container">

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Customer</h1>
        <!-- <a href="{{ route('unit-group.index') }}" class="btn btn-sm btn-primary shadow-sm"><i -->
        <!--         class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a> -->
    </div>

    <div class="card shadow mb-4 mx-auto" style="max-width: 1000px;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Customer</h6>
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
                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name', $customer->name) }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="partner_name" class="form-label">Partner Name</label>
                            <input type="text" class="form-control" id="partner_name" name="partner_name"
                                value="{{ old('partner_name', $customer->partner_name) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="national_id" class="form-label">National ID</label>
                            <input type="text" class="form-control" id="national_id" name="national_id" required
                                value="{{ old('national_id', $customer->national_id) }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="partner_national_id" class="form-label">Partner National ID</label>
                            <input type="text" class="form-control" id="partner_national_id" name="partner_national_id"
                                value="{{ old('partner_national_id', $customer->partner_national_id) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" required
                                value="{{ old('birth_date', $customer->birth_date) }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="partner_birth_date" class="form-label">Partner Birth Date</label>
                            <input type="date" class="form-control" id="partner_birth_date" name="partner_birth_date"
                                value="{{ old('partner_birth_date', $customer->partner_birth_date) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-control" id="payment_status" name="payment_status" required>
                                <option value="">Select Status</option>
                                <option value="reject" {{ old('payment_status', $customer->payment_status) == 'reject' ?
                                    'selected' : '' }}>Reject</option>
                                <option value="qualify" {{ old('payment_status', $customer->payment_status) == 'qualify'
                                    ? 'selected' : '' }}>Qualify
                                </option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="Booked" {{ old('status', $customer->status) == 'Booked' ? 'selected' : ''
                                    }}>Booking
                                </option>
                                <option value="Order" {{ old('status', $customer->status) == 'Order' ? 'selected' : ''
                                    }}>Order
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3" id="solution_box" style="display: none;">
                        <label for="solution" class="form-label">Solution</label>
                        <select name="solution" id="solution" class="form-control">
                            <option value="">Select Solution</option>
                            <option value="Takeover Bank" {{ old('solution', $customer->solution) == 'Takeover Bank' ?
                                'selected' : '' }}>Takeover Bank
                            </option>
                            <option value="Clearing Payment" {{ old('solution', $customer->solution) == 'Clearing
                                Payment' ? 'selected' : '' }}>Clearing Payment
                            </option>
                            <option value="Change Credit Name" {{ old('solution', $customer->solution) == 'Change Credit
                                Name' ? 'selected' : '' }}>Change Credit
                                Name</option>
                            <option value="Repayment" {{ old('solution', $customer->solution) == 'Repayment' ?
                                'selected' : '' }}>
                                Repayment</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="unit_group_id" class="form-label">Unit Group</label>
                            <select class="form-control" id="unit_group_id" name="unit_group_id" required>
                                <option value="">Select Unit Group</option>
                                @foreach ($unit_groups as $group)
                                <option value="{{ $group->id }}" {{ old('unit_group_id', $customer->unit->unitGroup->id) == $group->id ? 'selected' : '' }}> {{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="unit_id" class="form-label">Unit</label>
                            <select class="form-control" id="unit_id" name="unit_id" required>
                                <option value="{{ $customer->unit->id }}">{{ $customer->unit->name }}</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="referral_id" value="{{ $customer->referral_id }}">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentStatus = document.getElementById('payment_status');
        const solutionBox = document.getElementById('solution_box');
        paymentStatus.addEventListener('change', function () {
            if (this.value === 'reject' || this.value === 'solution') {
                solutionBox.style.display = '';
            } else {
                solutionBox.style.display = 'none';
                document.getElementById('solution').value = ''; // Clear solution if not reject
            }
        });

        const unitGroup = document.getElementById('unit_group_id');
        const unitSelect = document.getElementById('unit_id');

        unitGroup.addEventListener('change', function () {
            const groupId = this.value;
            unitSelect.innerHTML = '<option value="">Loading...</option>';
            unitSelect.disabled = true;

            if (groupId) {
                fetch(`/api/unit-groups/${groupId}/units`)
                    .then(response => response.json())
                    .then(data => {
                        unitSelect.innerHTML = '<option value="">Select Unit</option>';
                        data.forEach(unit => {
                            const option = document.createElement('option');
                            option.value = unit.id;
                            option.textContent = unit.name;
                            unitSelect.appendChild(option);
                        });
                        unitSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching units:', error);
                        unitSelect.innerHTML = '<option value="">Failed to load units</option>';
                        unitSelect.disabled = false;
                    });
            } else {
                unitSelect.innerHTML = '<option value="">Select Unit</option>';
                unitSelect.disabled = false;
            }
        });

        document.getElementById('national_id').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 16);
        });

        document.getElementById('partner_national_id').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 16);
        });


    });
</script>
@endpush
@endsection
