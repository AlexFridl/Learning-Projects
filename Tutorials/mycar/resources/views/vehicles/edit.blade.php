@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 pt-4 d-none d-lg-block d-xl-block">
                <a href="/vehicles/{{$vehicle->id}}/parts">
                    <div class="btn-icon mt-2">
                        <i class="fas fa-arrow-left fa-lg"></i>
                    </div>
                </a>
            </div>
        </div>
        <vehicle-info-view :vehicle="{{$vehicle}}"></vehicle-info-view>
    </div>
@endsection