@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex w-100 justify-content-center pt-lg-5 flex-column">
        <div class="row pt-lg-5">
            <div class="col-lg-6 mb-4">
                <a href="/vehicles">
                    @include('helpers.homecard', ["title" => 'Vozila', "subtitle" => "Unesite delove i bitne podsetnike za svoja vozila.", "icon" => 'car'])
                </a>
            </div>
            <div class="col-lg-6 mb-4">
                <a href="/nearby">
                    @include('helpers.homecard', ["title" => 'Mapa', "subtitle" => "Pronađite najbliže pumpe i auto servise.", "icon" => 'map'])
                </a>
            </div>
            <div class="col-lg-6 mb-4">
                <a href="/notifications">
                    @include('helpers.homecard', ["title" => 'Obaveštenja', "subtitle" => "Automatska obaveštenja o podsetnicima čiji rok se bliži.", "icon" => 'bell'])
                </a>
            </div>
            <div class="col-lg-6 mb-4">
                <a href="/profile">
                    @include('helpers.homecard', ["title" => 'Profil', "subtitle" => "Izmenite svoju email adresu ili lozinku.", "icon" => 'user'])
                </a>
            </div>
        </div>
        @admin
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <a href="/admin">
                    @include('helpers.homecard', ["title" => 'Statistike', "subtitle" => "Pogledajte statistike aplikacije.", "icon" => 'chart-line'])
                </a>
            </div>
        </div>
        @endadmin
    </div>
</div>
@endsection
