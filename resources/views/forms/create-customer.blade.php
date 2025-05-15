@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="partner_name" class="form-label">Partner Name</label>
                <input type="text" class="form-control" id="partner_name" name="partner_name">
            </div>
            <div class="mb-3">
                <label for="national_id" class="form-label">National ID</label>
                <input type="text" class="form-control" id="national_id" name="national_id" required>
            </div>
            <div class="mb-3">
                <label for="partner_national_id" class="form-label">Partner National ID</label>
                <input type="text" class="form-control" id="partner_national_id" name="partner_national_id">
            </div>
            <div class="mb-3">
                <label for="birth_date" class="form-label">Birth Date</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
            </div>
            <div class="mb-3">
                <label for="partner_birth_date" class="form-label">Partner Birth Date</label>
                <input type="date" class="form-control" id="partner_birth_date" name="partner_birth_date">
            </div>
            <div class="mb-3">
                <label for="payment_status" class="form-label">Payment Status</label>
                <select class="form-select" id="payment_status" name="payment_status" required>
                    <option value="">Select Status</option>
                    <option value="reject">Reject</option>
                    <option value="solution">Solution</option>
                    <option value="qualify">Qualify</option>
                </select>
            </div>
            <div class="mb-3" id="solution_box" style="display: none;">
                <label for="solution" class="form-label">Solution</label>
                <textarea class="form-control" id="solution" name="solution"></textarea>
            </div>
            <div class="mb-3">
                <label for="unit_group_id" class="form-label">Unit Group</label>
                <select class="form-select" id="unit_group_id" name="unit_group_id" required>
                    <option value="">Select Unit Group</option>
                    @foreach ($unit_groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="unit_id" class="form-label">Unit</label>
                <select class="form-select" id="unit_id" name="unit_id" required>
                    <option value="">Select Unit</option>
                </select>
            </div>
            <input type="hidden" name="referral_id" value="{{Auth::user()->referral->id}}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const paymentStatus = document.getElementById('payment_status');
                const solutionBox = document.getElementById('solution_box');
                paymentStatus.addEventListener('change', function() {
                    if (this.value === 'reject' || this.value === 'solution') {
                        solutionBox.style.display = '';
                    } else {
                        solutionBox.style.display = 'none';
                    }
                });

                const unitGroup = document.getElementById('unit_group_id');
                const unitSelect = document.getElementById('unit_id');

                unitGroup.addEventListener('change', function() {
                    const groupId = this.value;

                    // Show loading option
                    unitSelect.innerHTML = '<option value="">Loading...</option>';
                    unitSelect.disabled = true;

                    if (groupId) {
                        fetch(`/api/unit-groups/${groupId}/units`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                // Clear existing options
                                unitSelect.innerHTML = '<option value="">Select Unit</option>';

                                if (data.length > 0) {
                                    data.forEach(unit => {
                                        const option = document.createElement('option');
                                        option.value = unit.id;
                                        option.textContent = unit.name;
                                        unitSelect.appendChild(option);
                                    });
                                } else {
                                    const option = document.createElement('option');
                                    option.value = '';
                                    option.textContent = 'No units available';
                                    unitSelect.appendChild(option);
                                }

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
                document.getElementById('national_id').addEventListener('input', function(e) {
                    this.value = this.value.replace(/\D/g, '').slice(0, 16);
                });
                document.getElementById('partner_national_id').addEventListener('input', function(e) {
                    this.value = this.value.replace(/\D/g, '').slice(0, 16);
                });
            });
        </script>
    @endpush
@endsection
