@extends('layouts.app')
@section('content')
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                    <tr>
                        <td>{{ $unit->name }}</td>
                        @forelse ($unit->customers as $customer)
                            <td>{{ $customer->name }}</td>
                        @empty
                            <td>Kosong</td>
                        @endforelse


                        @if (isset($customer->id))
                        <td>
                            <a href="{{ route('customer.detail', $customer->id) }}" class="btn btn-primary">Detail</a>
                        </td>
                        @else
                            <td>
                                <a href="{{ route('customer.create') }}" class="btn btn-sm btn-primary">Add Customer</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
            </tr>
        </table>
        <a href="{{ route('unit-group.index') }}" class="btn btn-sm btn-primary">Kembali</a>
    </div>
@endsection
