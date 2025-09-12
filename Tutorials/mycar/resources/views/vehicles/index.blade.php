@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1 class="text-center mb-3">Moja vozila ({{count($vehicles)}}/10)</h1>
            <div class="d-lg-none d-xl-none">
                @if(count($vehicles) < 10)
                <a href="/vehicles/create">
                    <div class="btn-icon mt-2">
                        <i class="fas fa-plus align-middle fa-lg"></i>
                    </div>
                </a>
                @endif
            </div>
        </div>
        <div class="row">
            @if(count($vehicles) < 10)
            <div class="col-lg-4 mb-4 d-none d-lg-block d-xl-block">
                <a href="/vehicles/create">
                    @include('helpers.pluscard')
                </a>
            </div>
            @endif
            @foreach($vehicles as $vehicle)
                <div class="col-lg-4 mb-4">
                    <a href="/vehicles/{{$vehicle->id}}">
                        @include('helpers.card', ["make" => $vehicle->make, "model" => $vehicle->model, "registration_number" => $vehicle->registration_number])
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection