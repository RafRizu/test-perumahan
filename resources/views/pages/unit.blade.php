@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center" style="margin-top: 80px;">
    <div class="card shadow" style="width: 100%; max-width: 700px;">
        <div class="card-body">
            <h4 class="text-muted fw-bold">Modal</h4>
            <table class="table table-bordered text-center mt-3">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($units as $unit)
                        @forelse ($unit->customers as $customer)
                            <tr>
                                <td>{{ $no++ }}.</td>
                                <td class="fw-semibold">{{ $customer->name }}</td>
                                <td>
                                    <a href="{{ route('customer.detail', $customer->id) }}" class="btn btn-success btn-sm">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>{{ $no++ }}.</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endforelse
                    @endforeach
                </tbody>
            </table>
            <div class="text-start mt-3">
                <a href="{{ route('unit-group.index') }}" class="btn btn-primary btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
