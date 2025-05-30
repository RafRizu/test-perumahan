@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="d-flex justify-content-between align-items-center mx-5 mt-3 mb-3">
    <h1 class="h3 text-gray-800 mb-0">Dashboard</h1>
    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCustomerModal">
        <i class="fas fa-plus"></i> Upload Gambar
    </button>
</div>
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
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

    <!-- content -->
  <div class="card shadow-sm border-top-primary rounded mb-4 mx-auto d-flex justify-content-center align-items-center">
    <div class="text-center w-100">
        <picture>
            <!-- Gambar untuk mobile (potrait) -->
            <source media="(max-width: 768px)" srcset="{{ asset('assets/images/siteplan2.jpg') }}">

            <!-- Gambar default (desktop, landscape) -->
            <img class="img-fluid" src="{{ asset('assets/images/siteplan.jpg') }}" alt="Siteplan">
        </picture>
    </div>
</div>

@include('partials.data.customers')

@endsection
