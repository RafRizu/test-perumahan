@extends('layouts.app')

@section('content')

    <div class="container d-flex flex-wrap">
        @foreach ($unitGroups as $unitGroup)
        <a href="{{route('unit.index',['unitGroupId'=>$unitGroup->id])}}">

            <div class="box mx-2 my-2 bg-primary p-2 d-flex align-items-center justify-content-center text-center"
                 id="unit-group-{{ $unitGroup->id }}"
                 style="width: 113px; height: 106px;border-radius: 10px; cursor: pointer;">
                <div class="box-header text-center w-100">
                    <h3 class="box-title m-0 text-light" style="font-size: 1.5rem;">{{ $unitGroup->name }}</h3>
                </div>
            </div>
        </a>
        @endforeach
    </div>
@endsection
