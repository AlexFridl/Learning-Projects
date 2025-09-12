@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 pt-4 d-none d-lg-block d-xl-block">
                <a href="/vehicles/{{$vehicle->id}}/reminders">
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
        {{-- <div>
            <div class="row mt-4">
                <div class="col-lg-4 mb-4">
                    @include('helpers.infocard', ["title" => $part->partType->name, "smallText" => "Vrsta"])
                </div>
                <div class="col-lg-4 mb-4">
                    @include('helpers.infocard', ["title" => $part->formattedDate, "smallText" => "Datum"])

                </div>
                <div class="col-lg-4 mb-4">
                    @include('helpers.infocard', ["title" => $part->formattedMileage, "smallText" => "Kilometraža"])
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-4">
                    @include('helpers.infocard', ["title" => $part->name, "smallText" => "Naziv"])
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="info-card">
                        <div>
                            <div>
                                <h2>Menjanje</h2>
                            </div>
                            <div>
                                <h4>Obeležite deo kojem je potrebna zamena.</h4>
                            </div>
                        </div>
                        <div>
                            <input type="checkbox" id="change">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 mb-0">
                    <button class="btn btn-danger w-100">BRISANJE</button>
                </div>
            </div>
        </div>       --}}
        <reminder-info-view :reminder="{{$reminder}}"></reminder-info-view>
    </div>
@endsection