@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 pt-4 d-none d-lg-block d-xl-block">
                <a href="/vehicles/{{$vehicle->id}}">
                    <div class="btn-icon mt-2">
                        <i class="fas fa-arrow-left fa-lg"></i>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12">
                <h1 class="text-center">{{$vehicle->make}} {{$vehicle->model}}</h1>
                <h2 class="text-center mb-3">{{$vehicle->registration_number}}</h3>
            </div>
        </div>
        <div>
            <div class="d-flex justify-content-between align-items-center px-2">
                <h3>
                    Delovi
                </h3>
                <a href="/vehicles/{{$vehicle->id}}/parts/create">
                    <div class="btn-icon">
                        <i class="fas fa-plus align-middle fa-lg"></i>
                    </div>
                </a>
            </div>
            <parts-table-view :vehicle-id="{{$vehicle->id}}" :part-types="{{$partTypes}}"></parts-table-view>
        </div>      
    </div>
@endsection