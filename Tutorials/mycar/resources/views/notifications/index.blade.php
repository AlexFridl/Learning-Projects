@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 pt-4 d-none d-lg-block d-xl-block">
                <a href="/">
                    <div class="btn-icon mt-2">
                        <i class="fas fa-arrow-left fa-lg"></i>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12">
                <h1 class="text-center">Obaveštenja</h1>
            </div>
        </div>
        <div>
            <notifications-table-view></notifications-table-view>
        </div>      
    </div>
@endsection