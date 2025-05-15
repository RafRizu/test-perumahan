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
                        @if (isset($unit->customer->name))

                        <td>{{ $unit->customer->name }}</td>
                        @else
                        <td>-</td>
                        @endif
                        <td>
                            <a href="" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </tr>
        </table>
        <a href="{{route('unit-group.index')}}" class="btn btn-sm btn-primary">Kembali</a>
    </div>
@endsection
