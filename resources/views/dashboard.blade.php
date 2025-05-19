@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i -->
        <!--         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
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
<!-- End of PageContent -->

@endsection
