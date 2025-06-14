@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mx-5 mt-3 mb-3">
    <h1 class="h3 text-gray-800 mb-0">Dashboard</h1>
    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCustomerModal">
        <i class="fas fa-plus"></i> Upload Gambar
    </button>
</div>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> {{ $error }}
        </div>
    @endforeach
@endif

@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> {{ session()->get('error') }}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{ session()->get('success') }}
    </div>
@endif

<!-- Siteplan Display -->
<div class="card shadow-sm border-top-primary rounded mb-4 mx-auto d-flex justify-content-center align-items-center">
    <div class="text-center position-relative" style="width: 1000px; max-width: 100%;">
        <img src="{{ asset('assets/images/siteplan2.jpg') }}" alt="Siteplan" class="img-fluid">

        {{-- Overlay for each unit --}}
        @foreach ($units as $unit)
            @if (!is_null($unit->top) && !is_null($unit->left))
                <div
                    class="position-absolute"
                    title="Unit {{ $unit->name }} - {{ $unit->customers ? 'Terisi' : 'Kosong' }}"
                    style="
                        top: {{ $unit->top }}px;
                        left: {{ $unit->left }}px;
                        width: {{ $unit->width }}px;
                        height: {{ $unit->height }}px;
                        background-color: {{ $unit->customers ? 'green ' : 'grey' }};
                        border: 1px solid rgba(0,0,0,0.1);
                        z-index: 10;
                        cursor: pointer;
                        border-radius: 50%;
                    ">
                </div>
            @endif
        @endforeach
    </div>
</div>

@include('partials.data.customers')
@endsection
