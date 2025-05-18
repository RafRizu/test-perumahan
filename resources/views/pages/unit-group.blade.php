@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <h1 class="h3 mb-0 font-weight-bold text-primary">Data Customers</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah Unit</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$unit}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-institution fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-success text-uppercase mb-1">
                                        Booking</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customerBooked}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-danger text-uppercase mb-1">
                                        Order</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customerOrdered}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-warning text-uppercase mb-1">
                                        Tersedia</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$avalaibleUnits}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-square fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($unitGroups as $unitGroup)
                <a href="{{ route('unit.index', ['unitGroupId' => $unitGroup->id]) }}">
                    <div class="box mx-2 my-2 bg-primary p-2 d-flex align-items-center justify-content-center text-center"
                        id="unit-group-{{ $unitGroup->id }}"
                        style="width: 113px; height: 106px; border-radius: 10px; cursor: pointer;">
                        <div class="box-header text-center w-100">
                            <h3 class="box-title m-0 text-light" style="font-size: 1.5rem;">
                                {{ $unitGroup->name }}
                            </h3>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
