@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mx-5 mt-3 mb-3">
        <h1 class="h3 text-gray-800 mb-0">Dashboard</h1>
        {{-- <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCustomerModal">
            <i class="fas fa-plus"></i> Upload Gambar
        </button> --}}
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

            <div class="overlay" id="debug-div"
                style="position: absolute; width: 100%; max-width: 901px; height: 100%; top:0; left: 50%; transform: translateX(-50%);">
                {{-- Overlay for each unit --}}
                @foreach ($units as $unit)
                @if (!is_null($unit->top) && !is_null($unit->left))
                    @php
                        $customer = $unit->customers;
                    @endphp
                    <div class="position-absolute"
                        title="{{ $unit->name }} - {{ $customer ? 'Terisi' : 'Kosong' }}"
                        style="
                            top: {{ $unit->top }}%;
                            left: {{ $unit->left }}%;
                            width: {{ $unit->width }}px;
                            height: {{ $unit->height }}px;
                            background-color: {{ $customer ? 'red' : 'green' }};
                            border: 1px solid rgba(0,0,0,0.1);
                            z-index: 10;
                            cursor: pointer;
                            color: white;
                            transform: translate(-50%,-50%);
                            display: inline-flex;
                            justify-content: center;
                            align-items: center;
                            border-radius: 50%;
                        "
                        @if ($customer)
                            onclick="showDetailCustomerModal(
                                '{{ e($customer->name) }}',
                                '{{ e($customer->partner_name) }}',
                                '{{ e($customer->national_id) }}',
                                '{{ e($customer->partner_national_id) }}',
                                '{{ \Carbon\Carbon::parse($customer->birth_date)->age }} Tahun',
                                '{{ $customer->partner_birth_date ? \Carbon\Carbon::parse($customer->partner_birth_date)->age . ' Tahun' : '-' }}',
                                '{{ e($unit->unitGroup->name) }}',
                                '{{ e($unit->name) }}',
                                '{{ route('customers.edit', $customer->id) }}',
                                '{{ route('customers.destroy', $customer->id) }}'
                            )"
                        @else
                            onclick="showCreateCustomerModal(
                                {{ $unit->id }},
                                {{ $unit->unit_group_id }},
                                '{{ e($unit->name) }}',
                                '{{ e($unit->unitGroup->name) }}'
                            )"
                        @endif
                    >
                    </div>
                @endif
            @endforeach



            </div>
        </div>
    </div>
    @include('forms.create-customer-modal')


    @include('partials.data.customers')
    @push('scripts')
        <script>
            {{-- NOTE: INI HANYA UNTUK DEBUGING DAN MANCARI TITIK UNIT, HAPUS NANTI --}}
            const debugDiv = document.getElementById('debug-div');
            const bigArray = [];

            debugDiv.addEventListener('click', function(event) {
                // Mendapatkan ukuran elemen
                const rect = debugDiv.getBoundingClientRect();
                const divWidth = rect.width;
                const divHeight = rect.height;

                // Mendapatkan posisi klik relatif terhadap elemen
                const clickX = event.clientX - rect.left;
                const clickY = event.clientY - rect.top;

                // Menghitung persentase
                const percentageX = (clickX / divWidth) * 100;
                const percentageY = (clickY / divHeight) * 100;

                bigArray.push([percentageX, percentageY]);

                // Simpan ke clipboard
                navigator.clipboard.writeText(JSON.stringify(bigArray));

                // Menampilkan hasil
                console.log(`${percentageX.toFixed(2)}%, ${percentageY.toFixed(2)}%`);
                console.log(bigArray.length);
            });

            const customCursor = document.querySelector('#custom-cursor');

            document.addEventListener('mousemove', (e) => {
                customCursor.style.left = `${e.pageX}px`; // Set the horizontal position
                customCursor.style.top = `${e.pageY}px`; // Set the vertical position
            });
        </script>
    @endpush

@endsection

{{-- TODO: Delete Custom Cursor --}}
{{-- NOTE: INI HANYA UNTUK DEBUGING DAN MANCARI TITIK UNIT, HAPUS NANTI --}}
{{-- <div id="custom-cursor" style="width: 15px; height: 15px; background-color: brown; border-radius: 50%; position: absolute; transform: translate(-50%,-50%); z-index: 999999; pointer-events: none;"></div> --}}
