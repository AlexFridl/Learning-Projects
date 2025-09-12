@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 pt-4 d-none d-lg-block d-xl-block">
                <a href="/vehicles">
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
                    Podsetnici
                </h3>
                <a href="/vehicles/{{$vehicle->id}}/reminders/create">
                    <div class="btn-icon">
                        <i class="fas fa-plus align-middle fa-lg"></i>
                    </div>
                </a>
            </div>
            <div class="custom-table mt-3">
                @forelse($reminders as $reminder)
                    <a href="/vehicles/{{$vehicle->id}}/reminders/{{$reminder->id}}">
                    @include('helpers.tablerow', 
                    [
                        "topLeft" => '',
                        "bottomLeft" => $reminder->description,
                        "topRight" => $reminder->formattedDate,
                        "bottomRight" => $reminder->formattedPrice,
                        "special" => $reminder->expiresSoon,
                        "expired" => $reminder->expired
                    ])
                    </a>
                @empty 
                <h5>Trenutno nemate nijedan podsetnik unet.</h5>
                @endforelse
                @if(count($reminders) != 0)
                <a href="/vehicles/{{$vehicle->id}}/reminders" class="btn btn-warning mt-1 w-100">
                    Svi podsetnici
                </a>
                @endif
            </div>
        </div>
        <div class="mt-5">
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
            <div class="custom-table mt-3">
                @forelse($parts as $part)
                    <a href="/vehicles/{{$vehicle->id}}/parts/{{$part->id}}">
                    @include('helpers.tablerow', 
                    [
                        "topLeft" => $part->partType->name,
                        "bottomLeft" => $part->name,
                        "topRight" => $part->formattedDate,
                        "bottomRight" => $part->formattedMileage,
                        "special" => $part->change,
                        "expired" => false
                    ])
                    </a>
                @empty 
                <h5>Trenutno nemate nijedan deo unet.</h5>
                @endforelse
                @if(count($parts) != 0)
                <a href="/vehicles/{{$vehicle->id}}/parts" class="btn btn-warning mt-1 w-100">
                    Svi delovi
                </a>
                @endif
            </div>
        </div>
        <div class="row mt-5">
            <div class="form-group col-lg-6 offset-lg-3">
                <a href="/vehicles/{{$vehicle->id}}/edit" class="btn btn-secondary w-100">Izmena vozila</a>
            </div>
        </div>      
    </div>
@endsection