@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($customer))
        <div class="card">
            <div class="card-header">
                <h4 class="h4 mb-0 text-primary font-weight-bold text-uppercase">Detail Customer</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Nama Pasangan</th>
                        <td>{{ $customer->partner_name }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $customer->national_id }}</td>
                    </tr>
                    <tr>
                        <th>NIK Pasangan</th>
                        <td>{{ $customer->partner_national_id }}</td>
                    </tr>
                    <tr>
                        <th>Usia</th>
                        <td>
                            @if($customer->birth_date)
                                {{ \Carbon\Carbon::parse($customer->birth_date)->age }} tahun
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Usia Pasangan</th>
                        <td>
                            @if($customer->partner_birth_date)
                                {{ \Carbon\Carbon::parse($customer->partner_birth_date)->age }} tahun
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Unit Group</th>
                        <td>{{ $unit_group->name }}</td>
                    </tr>
                    <tr>
                        <th>Unit</th>
                        <td>{{ $unit->name }}</td>
                    </tr>
                </table>

                <div class="mt-4">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning"><i class="fa fas fa-pen"></i> Edit</a>

                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa fas fa-trash"></i> Hapus</button>
                    </form>

                    <a href="{{ route('unit.index',$unit_group->id) }}" class="btn btn-secondary"><i class="fa fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    @else
        <!-- WARNING: Not Working because the Controller -->
        <div class="alert alert-warning">
            Data customer tidak ditemukan.
        </div>
        <a href="{{ route('unit.index',$unit_group->id) }}" class="btn btn-secondary mt-3">Kembali</a>
    @endif
</div>
@endsection
