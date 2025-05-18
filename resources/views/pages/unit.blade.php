@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1000px;">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="h3 mb-0 text-primary font-weight-bold">Modal</h4>
        </div>
        <div class="card-body">
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
                                    <a href="{{ route('customer.detail', $customer->id) }}" class="btn btn-success btn-sm"><i class="fa fas fa-search"></i> Detail</a>
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
                <a href="{{ route('unit-group.index') }}" class="btn btn-primary btn-sm"><i class="fa fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
